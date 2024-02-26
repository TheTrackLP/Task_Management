<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Validator;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $task_count = Task::count();
        $emp_count = Employee::count();
        $prj_count = Project::count();

        $prj_id = DB::table('projects')->first();
        

        $prjs = DB::table('projects')
                    ->select('projects.*')
                    ->selectRaw("COUNT(CASE WHEN tasks.status = 2 THEN 1 ELSE NULL END) as doneTask")
                    ->selectRaw("COUNT(CASE WHEN tasks.status = 0 or tasks.status = 1 THEN 1 ELSE NULL END) AS leftTask")
                    ->join('tasks','tasks.prj_id','=','projects.id')
                    ->groupBy('projects.id')
                    ->get();

        return view('admin.admin_dashboard', compact('task_count', 'emp_count', 'prj_count', 'prjs'));
    }

    public function AllAdmin(){
        $emps = DB::table('employees')
                    ->select('employees.*')
                    ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name")
                    ->selectRaw("CONCAT(positions.position) as occupation")
                    ->join('positions', 'positions.id', '=', 'employees.position_id')
                    ->get();
        $accts = User::select('*')
                        ->orderBy('role', 'asc')
                        ->get();
        $roless = Role::all();
    return view('backend.accounts.all_accounts', compact('emps', 'accts', 'roless'));
    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function getEmpData($id){
        $employee = Employee::findorfail($id);
        return response()->json([
            'status'=>200,
            'employee'=>$employee,
        ]);
    }
    
    public function AddAccount(Request $request){
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if($valid->fails()){
            $fails = [
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            ];

            return redirect()->route('all.admins')->with($fails);
        } else {
            $accts = User::create([
                'username' => $request->username,
                'emp_id' => $request->emp_id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'active',
            ]);

            if($request->roles){
                $accts->assignRole($request->roles);
            }

            $success = [
                'message' => 'Created Account Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.admins')->with($success);
        }
    }

    public function EditAccount($id){
        $acct = DB::table('users')
        ->select('users.*')
        ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name")
        ->selectRaw("employees.id as empp_id, roles.id as role_id")
        ->join('employees', 'employees.emp_id', '=', 'users.emp_id')
        ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->where('users.id', $id)
        ->first();
        return response()->json([
            'status'=>200,
            'acct'=>$acct,
        ]);
    }

    public function UpdateAccount(Request $request){
        $user_id = $request->id;
        $valid = Validator::make($request->all(), [
            'username' => 'required',
            'role' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
        } else {
            $user = User::findorfail($user_id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->status = 'active';
            $user->role = $request->role;
            $user->save();
            
            $user->roles()->detach();
            if($request->roles){
                $user->assignRole($request->roles);
            }

            
        $notification = array(
            'message' => 'Account Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.admins')->with($notification);
        }
    }

    public function DeleteAccount($id){
        User::findorfail($id)->delete();
                    
        $notification = array(
            'message' => 'Account Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.admins')->with($notification);
    }
}