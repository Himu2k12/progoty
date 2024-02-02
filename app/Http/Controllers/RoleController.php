<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewRole(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roles=Role::all();

        return view('Backend.SuperAdmin.role.add-role',['roles'=>$roles]);
    }
    public function addRole(Request $request){
        $this->validate($request, [
            'role'=>'required|min:2|max:50',
            ]);

        $roles= new Role();
        $roles->role=$request->role;
        $roles->access=1;
        $roles->save();

        return back()->with('message','Role Stored Successfully');

    }
    public function inactiveRoleInfo($id){
        $roleById = Role::find($id);
        $roleById->access = 0;
        $roleById->save();
        return redirect('/add-role')->with('message', 'Role info Inactive successfully');
    }
    public function activeRoleInfo($id){
        $roleById = Role::find($id);
        $roleById->access = 1;
        $roleById->save();
        return redirect('/add-role')->with('message', 'Role info Active successfully');
    }
    public function editRoleInfo($id) {
        $editById = Role::find($id);
        return view('Backend.SuperAdmin.role.edit-role', ['editById'=>$editById]);
    }

    public function updateRoleInfo(Request $request){
        $this->validate($request, [
            'role'=>'required|min:2|max:50',
            'access'=>'required',
        ]);
        $updateRoleById = Role::find($request->id);
        $updateRoleById->role=$request->role;
        $updateRoleById->access=$request->access;
        $updateRoleById->save();
        return redirect('/add-role')->with('message', 'Role info Updated successfully');
    }
}
