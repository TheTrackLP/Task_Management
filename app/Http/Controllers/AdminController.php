<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Project;
use DB;
use Validator;
use Auth;

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
        $admins = User::where('role', 'admin')->get();
        return view('backend.users.admins.all_admins', compact('admins'));
    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}