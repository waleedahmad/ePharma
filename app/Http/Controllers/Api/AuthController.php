<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Mail\VerifyUser;
use App\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;

class AuthController extends Controller
{

	
	/**
     * Returns registeration view
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	
    public function getRegister()
    {
		return view('auth.register');
    }
	
	/**
     * Handle registration form submit
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|',
        ]);
        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =bcrypt($request->password);
            $user->verified = 0;
            $user->verification_token = str_random(10);
            $user->type = 'user';
            if ($user->save()) {
                Mail::to($user)->queue(new VerifyUser($user));
                return response()->json($user, 201);
            }
        }else{
            return response()->json([
                'errors'    => $validator->errors()
            ], 400);
        }
    }
	
	/**
	 * Verify a new user, after a user clicks on a link sent
	 * via a verification email.
	 * @param Request $request
	 * @param $token
	 * @param $email
	 * @return string
	 */
    public function verifyUser(Request $request, $token, $email){
        $user = User::where('email', $email)->where('verification_token', $token);
        
        if($user->count()){
            $user = $user->first();
            $user->verification_token = '';
			$user->verified = true;
	
			if($user->save()){
				$request->session()->flash('message', 'Your account has been verified');
				return redirect('/login');
			}
        }else {
			$request->session()->flash('messages', 'Invalid password recovery link');
			return redirect('/login');
		}
    }
	
	
	/**
     * Returns an authentication or Login form view.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function getLogin(){
        return view('auth.login');
    }
    
	/**
     * Handle submission of authentication form
     * or
     * Login a user
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function authenticateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required'
        ]);
        
        if($validator->passes()){
            if(Auth::attempt([
                'email' =>  $request->email,
                'password'  =>  $request->password,
                'verified'  =>  1
            ])){
                return response()->json([
                    'errors'    => [],
                    'token' =>  $this->refreshAndGetUserApiToken($request->email)
                ], 202);
            }else{
                if($this->userIsVerified($request->email)){
                    return response()->json([
                        'errors'    => ['Invalid email or password']
                    ], 401);
                }else{
                    return response()->json([
                        'errors'    => ['Invalid email, password or unverified account']
                    ], 401);
                }
            }
        }else{
            return response()->json([
                'errors'    => $validator->errors()
            ], 400);
        }
    }

    protected function refreshAndGetUserApiToken($email){
        $user = User::where('email','=', $email)->first();
        $user->api_token = str_random(60);
        return $user->save() ? $user->api_token : null;
    }
	
	protected function userIsVerified($email){
		return User::where('email','=', $email)->where('verified', 1)->count();
	}

	/**
     * Logout a user
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
	
	
	/**
     * return forget password view
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View*
	 */
    public function forgotPassword(){
        return view('auth.recover_password');
    }
    
    public function recoverPassword(Request $request){
        $email = $request->email;
        
        if($this->resetRequestExistThenGetToken($email)){
            $token = $this->resetRequestExistThenGetToken($email);
            if($this->sendRecoveryEmail($email, $token)){
                $request->session()->flash('message', 'Recover mail sent, please check your email.');
				return redirect('/forgot/password');
            }
        }else{
            $token = str_random(20);
            $reset = new ResetPassword();
            $reset->email = $email;
            $reset->token = $token;
            if($reset->save()){
				if($this->sendRecoveryEmail($email, $token)){
					$request->session()->flash('message', 'Recover mail sent, please check your email.');
					return redirect('/forgot/password');
				}
            }
        }
    }
    
    public function sendRecoveryEmail($email, $token){
		Mail::to($this->getUser($email))->send(new ResetPasswordMail($this->getUser($email), $token));
		
		if(Mail::failures()){
		    return false;
        }
        return true;
    }
    
    public function getUser($email){
        return User::where('email','=', $email)->first();
    }
    
    public function resetRequestExistThenGetToken($email){
        $reset = ResetPassword::where('email','=',$email);
        
        if($reset->count()){
            return $reset->first()->token;
        }
        return false;
    }
    
    public function validResetPasswordRequest($token, $email){
        return ResetPassword::where('email',$email)->where('token', $token)->count();
    }

    public function getResetForm(Request $request, $email, $token){
        if($this->validResetPasswordRequest($token, $email)){
            return view('auth.reset_password')->with('token', $token)->with('email', $email);
        }else{
			$request->session()->flash('message', 'Invalid password recovery link.');
			return redirect('/login');
        }
    }

	/**
     * sending mail and after click on the link the password change form is shown
	 * @param Request $request
	 * @return mixed
	 */
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
           'password'   =>  'required',
            'confirm_password'  =>  'required|same:password'
        ]);
        if($validator->passes()){
			$email = $request->email;
			$token = $request->token;
			$password = $request->password;
			$reset = ResetPassword::where('email', '=', $email)->where('token', '=', $token);
            $user = User::where('email','=', $email)->first();
            $user->password = bcrypt($password);
            if($user->save() && $reset->delete()){
                $request->session()->flash('message', 'Password Successfully changed.');
                return redirect('/login');
            }
        }else{
                $request->session()->flash('message','Password not changed.');
                return redirect('/forgot/password');
        }
        
    }
}