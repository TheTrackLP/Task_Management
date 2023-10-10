<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function ShowAttendance(){
        return view('backend.attendance.all_attendance');
    }
}