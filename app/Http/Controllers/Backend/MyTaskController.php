<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Tasks;
use Auth;
use Validator;

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

    public function EditMyTask($id){
        $taskData = DB::table('tasks')
        ->select('tasks.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name, employees.position"))
        ->join('employees', 'employees.emp_id', '=', 'tasks.emp_id')
        ->where('tasks.id', '=', $id)
        ->first();

        return view('backend.mytask.edit_mytask', compact('taskData'));
    }

    public function UpdateMyTask(Request $request){
        $taskId = $request->id;

        $valid = Validator::make($request->all (), [
            'emp_id' => 'required',
            'task_name' => 'required',
            'task_desc' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
        } else {
            $taskId = $request->id;

            Tasks::findorfail($taskId)->update([
                'emp_id' => $request->emp_id,
                'task_name' => $request->task_name,
                'task_desc' => $request->tasks_desc,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => $request->status,
            ]);

            $notif = array(
                'message' => 'Task Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('my.tasks')->with($notif);
        }
    }
}