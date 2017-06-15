Hi {{$user->name}}!
Thank you for using our service, please click on link below to verify your account!
<br>
<a href="{{URL::to('verify/user/' . $user->verification_token . '/' . $user->email)}}">Verify Account</a>