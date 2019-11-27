<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowDashboard(){
        return view('back.dashboard.dashboard-content');
    }
    public function RegisterStaffs(){
        return view('back.Staffs.register-users');
    }

    protected function newStaffs(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $users=new User();
        $users->name = $request['name'];
        $users->email = $request['email'];
        $users->password= Hash::make($request['password']);
        $users->role= $request['role'];
        $users->access = 0;
        $users->save();

        return redirect('staffs');




    }
    public function allStaffs(){
        $staffs=User::where('role','!=',1)->get();
        return view('back.Staffs.staffs-view',['staffs'=>$staffs]);
    }
    public function inactiveStaffInfo($id){
        $staffById = User::find($id);
        $staffById->access = 0;
        $staffById->save();
        return redirect('/staffs')->with('message', 'Staff info Inactive successfully');
    }
    public function activeStaffInfo($id){
        $staffById = User::find($id);
        $staffById->access = 1;
        $staffById->save();
        return redirect('/staffs')->with('message', 'Staff info Activated successfully');
    }
}
