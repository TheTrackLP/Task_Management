<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function AllLeave(){
        $allLeave = DB::table('leaves')
        ->select('leaves.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name"))
        ->join('employees', 'employees.emp_id','=', 'leaves.emp_id')
        ->get();
        return view('backend.leave.all_leave', compact('allLeave'));
    }
}