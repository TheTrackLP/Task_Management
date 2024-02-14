<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Task;
use App\Models\PrjMember;
use Validator;
use DB;

class ProjectController extends Controller
{
    public function AllProjects(){
        $prjs = DB::table('projects')
                    ->select('projects.*')
                    ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as manager")
                    ->join('employees', 'employees.id', '=', 'projects.leader_empid')
                    ->get();
        return view('backend.projects.all_projects', compact('prjs'));
    }

    public function AddProjects(){
        $emps = DB::table('employees')
                    ->select('employees.*')
                    ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name")
                    ->selectRaw("CONCAT(positions.position) as occu")
                    ->join('positions', 'positions.id', '=', 'employees.position_id')
                    ->get();
                    
        return view('backend.projects.add_projects', compact('emps'));
    }

    public function StoreProjects(Request $request){
        $valid = Validator::make($request->all(), [
             'prj_name' => 'required',
             'leader_empid' => 'required',
             'start_date' => 'required',
             'end_date' => 'required',
             'prj_description' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again',
                'alert-type' => 'error',
            );

            return redirect()->route('all.projects')->with($fails);
        } else {
            $date = date('Y-m-d');
            //insertGetId it will take the newly inserted ID and you can you it as a foreign key
            $project = Project::insertGetId([
                'prj_name' => $request->prj_name,
                'leader_empid' => $request->leader_empid,
                'status' => '0',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'prj_description' => $request->prj_description,
                'created_at' => $date,
            ]);
            
            $data = array();
            $members = $request->emp_id;
            $date = date('Y-m-d');

            foreach ($members as $value) {
                $data['prj_id'] = $project;
                $data['added_on'] = $date;
                $data['emp_id'] = $value;
                DB::table('prj_members')->insert($data);
            }

            $success = array(
                'message' => 'Successfully Project Added',
                'alert-type' => 'success',
            );

            return redirect()->route('all.projects')->with($success);
        }
    }

    public function ViewProjects($id){
        $projects = DB::table('projects')
        ->select('projects.*')
        ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as manager")
        ->join('employees', 'employees.id', '=', 'projects.leader_empid')
        ->where('projects.id',$id)
        ->first();

        $taskPrj = DB::table('tasks')
                    ->where('prj_id', $id)
                    ->get();

        $members = DB::table('prj_members')
                        ->select('prj_members.*')
                        ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name, CONCAT(positions.position) as occupation")
                        ->join('employees', 'employees.emp_id', '=', 'prj_members.emp_id')
                        ->join('positions', 'positions.id', '=', 'employees.position_id')
                        ->where('prj_members.prj_id', $id)
                        ->get();


        return view('backend.projects.view_projects', compact('projects', 'taskPrj', 'members'));
    }

    public function EditProjects($id){
        $projects = Project::findorfail($id);
        $emps = Employee::select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get();

        return view('backend.projects.edit_projects', compact('projects', 'emps'));
    }

    public function UpdateProjects(Request $request){
        $prj_id = $request->id;

        $valid = Validator::make($request->all(), [
            'prj_name' => 'required',
            'leader_empid' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'prj_description' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again',
                'alert-type' => 'error',
            );

            return redirect()->route('all.projects')->with($fails);
        } else {
            $date = date('Y-m-d');

            $projects = Project::findorfail($prj_id)->update([
                'prj_name' => $request->prj_name,
                'leader_empid' => $request->leader_empid,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'prj_description' => $request->prj_description,
                'updated_at' => $date,
            ]);

            $success = array(
                'message' => 'Successfully Project Updated',
                'alert-type' => 'success',
            );

            return redirect()->route('all.projects')->with($success);
        }
    }

    public function DeleteProjects($id){
        Project::findorfail($id)->delete();

        $success = array(
            'message' => 'Successfully Project Deleted',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.projects')->with($success);
    }

    public function DeleteMember($id){
        PrjMember::findorfail($id)->delete();
        $success = array(
            'message' => 'Successfully Deleted a Member',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.projects')->with($success);
    }
}