<?php

namespace App\Http\Controllers;

use App\Branch;
use App\City;
use App\Company;
use App\Town;
use App\User;
use Illuminate\View\Compilers\Concerns\CompilesAuthorizations;
use Validator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getCompanies(){
        $companies = Company::all();
        return view('admin.companies')->with('companies', $companies);
    }

    public function getAddCompany(){
        return view('admin.companies.add');
    }

    public function getEditCompany($id){
        $company = Company::find($id);
        return view('admin.companies.edit')->with('company', $company);
    }

    public function addCompany(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:11',
            'address' => 'required',
        ]);

        if($validator->passes()){
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;

            if($company->save()){
                return redirect('/admin/companies');
            }
        }else{
            return redirect('/admin/company/add')->withErrors($validator)->withInput();
        }
    }

    public function updateCompany(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|unique:companies,name,'.$request->id,
            'email' => 'required|email',
            'phone' => 'required|numeric|min:11',
            'address' => 'required',
        ]);

        if($validator->passes()){
            $company = Company::find($request->id);

            $company->name = $request->name;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;

            if($company->save()){
                return redirect('/admin/companies');
            }
        }else{
            return redirect('/admin/company/edit/'.$request->id)->withErrors($validator)->withInput();
        }
    }

    public function deleteCompany(Request $request){

        $company = Company::find($request->id);

        if($company->delete()){
            return response()->json(true);
        }
    }

    public function getBranches(){
        $branches = Branch::all();
        return view('admin.branches')->with('branches', $branches);
    }

    public function getAddBranch(){
        $companies = Company::all();
        $cities = City::all();
        return view('admin.branches.add')->with('companies', $companies)->with('cities', $cities);
    }

    public function addBranch(Request $request){
        $validator = Validator::make($request->all(), [
            'company'   =>  'required',
            'email' =>  'required|email|unique:users,email',
            'password'  =>  'required|min:6',
            'name' => 'required|min:5',
            'phone' => 'required|numeric|min:11',
            'city'  =>  'required',
            'town'  =>  'required',
            'address' => 'required',
            'open_hours'    =>  'required',
            'close_hours'   =>  'required'
        ]);

        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->verified = 1;
            $user->verification_token = '';
            $user->type = 'b_admin';

            if($user->save()){
                $branch = new Branch();
                $branch->company_id = $request->company;
                $branch->manager_id = $user->id;
                $branch->address = $request->address;
                $branch->phone = $request->phone;
                $branch->open_hours = $request->open_hours;
                $branch->close_hours = $request->close_hours;
                $branch->location = $this->getLocationId($request->city, $request->town);

                if($branch->save()){
                    return redirect('/admin/branches');
                }
            }

        }else{
            return redirect('/admin/branch/add')->withErrors($validator)->withInput();
        }
    }

    private function getLocationId($city, $town)
    {
        $location = Town::where('city_id','=', $city)->where('name', 'like', $town);
        if($location->count()){
            return $location->first()->id;
        }else{
            $location = new Town();
            $location->city_id = $city;
            $location->name = $town;
            if($location->save()){
                return $location->id;
            }
        }
    }

    public function getEditBranch($id){
        $branch = Branch::where('id','=', $id)->first();
        $companies = Company::all();
        $cities = City::all();
        return view('admin.branches.edit')->with('branch', $branch)->with('companies', $companies)->with('cities', $cities);
    }


    public function updateBranch(Request $request){
        $branch = Branch::find($request->branch_id);
        $validator = Validator::make($request->all(), [
            'company'   =>  'required',
            'email' =>  'required|email|unique:users,email,'.$branch->manager->id,
            'name' => 'required|min:5',
            'phone' => 'required|numeric|min:11',
            'city'  =>  'required',
            'town'  =>  'required',
            'address' => 'required',
            'open_hours'    =>  'required',
            'close_hours'   =>  'required'
        ]);

        if($validator->passes()){
            $user = User::find($branch->manager_id);
            $user->email = $request->email;
            $user->name = $request->name;

            if($user->save()){
                $branch->company_id = $request->company;
                $branch->address = $request->address;
                $branch->phone = $request->phone;
                $branch->open_hours = $request->open_hours;
                $branch->close_hours = $request->close_hours;
                $branch->location = $this->getLocationId($request->city, $request->town);

                if($branch->save()){
                    return redirect('/admin/branches');
                }
            }
        }else{
            return redirect('/admin/branch/edit/'.$branch->id)->withErrors($validator)->withInput();
        }
    }

    public function deleteBranch(Request $request){
        $id = $request->id;
        $branch = Branch::find($id);
        $user = User::find($branch->manager_id);

        if($user->delete()){
            return response()->json(true);
        }
    }


    public function getUsers(){
        return view('admin.users');
    }

    public function getAddUser(){
        return view('admin.users.add');
    }

    public function addUser(){

    }

    public function deleteUser(){

    }
}
