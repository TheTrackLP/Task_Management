<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Projects;
use App\Models\Employee;

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
        $prjData = Projects::findorfail($id);
        return  view('backend.projects.view_projects', compact('prjData'));
    }

    public function StoreProjects(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manager' => 'required',
            'members' => 'required',
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
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'manager' => $request->manager,
                'members' => $request->team_members,
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
        $projectData = Projects::findorfail($id);
        return view('backend.projects.edit_projects', compact('projectData'));
    }

    public function UpdateProjects(Request $request){
        $prj_id = $request->id;

        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'manager' => 'required',
            'members' => 'required',
            'description' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again.',
                'alert-type' => 'error',
            );

            return redirect()->route('all.projects')->with($fail);
        } else{
            Projects::findorfail($prj_id)->update([
                'name' => $request->name,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'manager' => $request->manager,
                'members' => $request->team_members,
                'description' => $request->description,
            ]);

            $notif = array(
                'message' => 'Project Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('all.projects')->with($notif);
        }
    }

    public function DeleteProjects($id){
        Projects::findorfail($id)->delete();

        $delete = array(
            'message' => 'Project Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.projects')->with($delete);  
    }
}