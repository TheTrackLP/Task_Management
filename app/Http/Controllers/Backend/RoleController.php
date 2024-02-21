<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;
use Validator;

class RoleController extends Controller
{
    public function AllRoles(){
        $roles = Role::all();
        return view('backend.role.roles', compact('roles'));
    }

    public function AddRoles(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('all.roles')->with($fails);
        } else {
            Role::create([
                'name' => $request->name,
            ]);

            $success = [
                'message' => 'Role Added Successfully',
                'alert-type' > 'success',
            ];

            return redirect()->route('all.roles')->with($success);
        }
    }

    public function EditRoles($id){
        $role = Role::findorfail($id);
        return response()->json([
            'status'=>200,
            'role'=>$role,
        ]);
    }

    public function DeleteRoles($id){

        Role::findorfail($id)->delete();

        $delete = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.roles')->with($delete);
    }

    public function AllPermissions(){
        $permissions = Permission::all();
        return view('backend.permission.permissions', compact('permissions'));
    }

    public function AddPermissions(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'group_name' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
            return redirect()->route('all.permissions')->with($fails);
        } else {
            Permission::create([
                'name' => $request->name,
                'group_name' => $request->group_name,
            ]);

            $success = array(
                'message' => 'Added Permission Successfully',
                'alert-type' => 'success',
            );
            
            return redirect()->route('all.permissions')->with($success);
        }
    }

    public function DeletePermission($id){

        Permission::findorfail($id)->delete();

        $delete = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.permissions')->with($delete);
    }

    public function AllRolesNPermissions(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permi_groups = User::getPermissionGroups();
        return view('backend.rolesetup.all_roles_permission', compact('roles', 'permissions', 'permi_groups'));
    }

    public function AddRolesNPermissions(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $value) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $value;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles.permissions')->with($notification);
    }

    public function EditRolePermission($id){
        $role = Role::findorfail($id);
        $permission = Permission::all();
        $permi_groups = User::getPermissionGroups();
        return view('backend.rolesetup.edit_roles_permission', compact('role', 'permission', 'permi_groups'));   
    }
}