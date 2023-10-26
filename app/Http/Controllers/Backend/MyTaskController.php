<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Tasks;
use Auth;

class MyTaskController extends Controller
{
    public function MyTasks(){
        #$myTask = DB::table('tasks')->get();
        $id = Auth::user()->emp_id;
        $myTask = DB::table('tasks')
        ->select('tasks.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name"))
        ->join('employees', 'employees.emp_id', '=', 'tasks.emp_id')
        ->join('users', 'users.emp_id', '=', 'tasks.emp_id')
        ->where('users.emp_id', $id)
        ->get();
        
        return view('backend.mytask.my_task', compact('myTask'));

    }
}