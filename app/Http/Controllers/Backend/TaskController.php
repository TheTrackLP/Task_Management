<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Employee;
use App\Models\Task;

class TaskController extends Controller
{
    public function AllTasks(){
        $emps = Employee::select('*')
                            ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
                            ->get();
        $tasks = DB::table('tasks')
                    ->select('tasks.*')
                    ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as assigned")
                    ->selectRaw("CONCAT(projects.prj_name) as project")
                    ->join('employees', 'employees.emp_id', '=', 'tasks.emp_id')
                    ->leftJoin('projects', 'projects.id', '=', 'tasks.prj_id')
                    ->get();
        return view('backend.tasks.all_tasks', compact('emps', 'tasks'));
    }

    public function AddTasks(Request $request){
        $valid = Validator::make($request->all(), [
            'emp_id' => 'required',
            'task_name' => 'required',
            'task_desc' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
            return redirect()->route('all.tasks')->with($fails);
        } else {
            $date = date('Y-m-d');
            $tasks = Task::insert([
                'prj_id' => $request->prj_id,
                'emp_id' => $request->emp_id,
                'task_name' => $request->task_name,
                'task_desc' => $request->task_desc,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => '0',
                'created_at' => $date,
            ]);

            $success = array(
                'message' => 'Task Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.tasks')->with($success);
        }
    }

    public function EditTasks($id){
        $task_id = $id;
        $tasks = DB::table('tasks')
        ->select('tasks.*')
        ->selectRaw("CONCAT(projects.prj_name) as project")
        ->leftJoin('projects', 'projects.id', '=', 'tasks.prj_id')
        ->where('tasks.id', $task_id)
        ->first();
        return response()->json([
            'status'=>200,
            'tasks'=>$tasks,
        ]);
    }

    public function UpdateTasks(Request $request){
        $task_id = $request->id;

        $valid = Validator::make($request->all(), [
            'task_name' => 'required',
            'emp_id' => 'required',
            'task_desc' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
            'status' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
            return redirect()->route('all.tasks')->with($fails);
        } else {
            $date = date('Y-m-d');
            $tasks = Task::findorfail($task_id)->update([
                'prj_id' => $request->prj_id,
                'emp_id' => $request->emp_id,
                'task_name' => $request->task_name,
                'task_desc' => $request->task_desc,
                'start_date' => $request->start_date,
                'due_date' => $request->due_date,
                'status' => $request->status,
                'updated_at' => $date,
            ]);

            $success = array(
                'message' => 'Task Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.tasks')->with($success);
        }
    }

    public function DeleteTask($id){
        Task::findorfail($id)->delete();
        $deleted = array(
            'message' => 'Task Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.tasks')->with($deleted);        
    }
}