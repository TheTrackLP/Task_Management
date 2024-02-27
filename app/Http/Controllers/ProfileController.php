<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use DB;
use Validator;

class ProfileController extends Controller
{
    public function MyProfile(){
        $id = Auth::user()->emp_id;
        $profileData = DB::table('users')
                            ->select('users.*')
                            ->selectRaw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name")
                            ->selectRaw("CONCAT(positions.position) as occu")
                            ->selectRaw("employees.address, employees.contact, employees.position_id")
                            ->join('employees', 'employees.emp_id', '=', 'users.emp_id')
                            ->join('positions', 'positions.id', '=', 'employees.position_id')
                            ->where('users.emp_id', $id)
                            ->first();
                            
        $partProject = DB::table('projects')
                            ->select('projects.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as manager"))
                            ->join('employees','employees.id','=','projects.leader_empid')
                            ->join('prj_members','prj_members.prj_id','=','projects.id')
                            ->where('prj_members.emp_id','=', $id)
                            ->first();
        
        $myTask = DB::table('tasks')
                            ->where('emp_id', $id)
                            ->get();

        return view('admin.profile.profile', compact('profileData', 'partProject', 'myTask'));
    }
}