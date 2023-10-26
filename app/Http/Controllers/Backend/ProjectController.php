<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Projects;
use App\Models\Employee;
use App\Models\Tasks;
use App\Models\prj_members;


class ProjectController extends Controller
{
    public function ShowProjects(){
        $allProjects = DB::table('projects')->get();
        return view('backend.projects.all_projects', compact('allProjects'));
    }
    
    public function AddProjetcs(){
        $employees = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get(); 
        return view('backend.projects.add_projects', compact('employees'));
    }

    public function ViewProjects($id){
        $prjData = DB::table('projects')
        ->select('projects.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as manager"))
        ->join('employees','employees.emp_id','=','projects.emp_id')
        ->first();

        $taskData = DB::table('tasks')
        ->select('tasks.*',DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name"))
        ->join('employees', 'employees.emp_id', '=', 'tasks.emp_id')
        ->get();

        $prjTask = DB::table('tasks')->get();

        $employees = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get();

        $members = DB::table('prj_members')
        ->select('prj_members.*',DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name, employees.position"))
        ->join('employees', 'employees.emp_id', '=', 'prj_members.emp_id')
        ->get();

        return  view('backend.projects.view_projects', compact('prjData', 'taskData', 'employees', 'prjTask', 'members'));
    }

    public function StoreProjects(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'emp_id' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again',
                'alert-type' => 'error',
            );

            return redirect()->route('all.projects')->with($fail);
        } else{
            DB::table('projects')->insert([
                'name' => $request->name,
                'emp_id' => $request->emp_id,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
            ]);

            $notif = array(
                'message' => 'New Project Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.projects')->with($notif);
        }
    }
    
    public function EditProjects($id){
        $projectData = DB::table('projects')
        ->select('projects.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as manager, employees.position"))
        ->join('employees', 'employees.emp_id', '=', 'projects.emp_id')
        ->where('projects.id', '=', $id)
        ->first();

        $employees = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get();
        
        return view('backend.projects.edit_projects', compact('projectData', 'employees'));
    }

    public function UpdateProjects(Request $request){
        $prj_id = $request->id;

        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'emp_id' => 'required',
            'description' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again.',
                'alert-type' => 'error',
            );

            return redirect()->route('all.projects')->with($fail);
        } else{
            $prj_id = $request->id;

            Projects::findorfail($prj_id)->update([
                'name' => $request->name,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'emp_id' => $request->emp_id,
                'description' => $request->description,
            ]);

            $notif = array(
                'message' => 'Project Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('all.projects')->with($notif);
        }
    }

    public function AddPrjMember(Request $request){

        DB::table('prj_members')->insert([
            'prj_id' => $request->prj_id,
            'emp_id' => $request->emp_id,
        ]);

        $notif = array(
            'message' => 'Added Member Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.projects')->with($notif);
    }

    public function DeleteProjects($id){
        Projects::findorfail($id)->delete();

        $delete = array(
            'message' => 'Project Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.projects')->with($delete);  
    }

    public function DeleteMember($id){
        prj_members::findorfail($id)->delete();

        $delete = array(
            'message' => 'Member Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.projects')->with($delete);  
    }
}