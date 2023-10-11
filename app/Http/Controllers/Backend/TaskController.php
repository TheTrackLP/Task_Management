<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use DB;

class TaskController extends Controller
{
    public function ShowTasks(){
        $employee = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get(0);
        return view('backend.tasks.all_tasks', compact('employee'));
    }
}