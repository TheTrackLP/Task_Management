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
        $accts = User::all();
        $roles = Role::all();
    return view('backend.accounts.all_accounts', compact('emps', 'accts', 'roles'));
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
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'emp_id' => $request->emp_id,
                'email' => $request->email,
                'status' => $request->status,
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

}