<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use DB;
use Validator;
use App\Models\Tasks;

class TaskController extends Controller
{
    public function ShowTasks(){
        $employees = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get(0);
        $allTasks = DB::table('tasks')
        ->select('tasks.*', DB::raw("CONCAT(projects.name) as prj_name"))
        ->join('projects', 'projects.id', '=', 'tasks.prj_id')
        ->get();

        return view('backend.tasks.all_tasks', compact('employees', 'allTasks'));

    }

    public function StoreTasks(Request $request){
        $valid = Validator::make($request->all(), [
            'emp_id' => 'required',
            'task_name' => 'required',
            'task_desc' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again!.',
                'alert-type' => 'error',
            );

            return redirect()->route('all.tasks')->with($fail);
        }else{
            DB::table('tasks')->insert([
                'emp_id' => $request->emp_id,
                'prj_id' => $request->prj_id,
                'task_name' => $request->task_name,
                'task_desc' => $request->task_desc,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            $notif = array(
                'message' => 'Task Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.tasks')->with($notif);
        }
    }

    public function ViewTask($id){
        $taskData = Tasks::findorfail($id);
        return view('backend.tasks.view_tasks', compact('taskData'));
    }
}