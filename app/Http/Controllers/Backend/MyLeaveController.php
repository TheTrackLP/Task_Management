<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use DB;
use App\Models\Leave;

class MyLeaveController extends Controller
{
    public function MyLeave(){
        $id = Auth::user()->emp_id;
        $userId = DB::table('users')
        ->select('*')
        ->where('emp_id', $id)
        ->first();

        $myLeave = DB::table('leaves')
        ->select('leaves.*', DB::raw("CONCAT(employees.lastname, ', ', employees.firstname, ' ', employees.middlename) as name"))
        ->join('employees', 'employees.emp_id', '=', 'leaves.emp_id')
        ->join('users', 'users.emp_id', '=', 'leaves.emp_id')
        ->where('users.emp_id', $id)
        ->get();


        return view('backend.leave.request_leave', compact('userId', 'myLeave'));
    }

    public function StoreMyLeave(Request $request){
        $valid = Validator::make($request->all(),[
            'emp_id' => 'required',
            'leave_name' => 'required',
            'leave_reason' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again',
                'alert-type' => 'error',
            );

            return redirect()->route('my.leave')->with($fail);
        } else{
            DB::table('leaves')->insert([
                'emp_id' => $request->emp_id,
                'leave_name' => $request->leave_name,
                'leave_reason' => $request->leave_reason,
                'status' => $request->status,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            ]);
            $notif = array(
                'message' => 'Request Submitted Successfully!',
                'alert-type' => 'success',
            );

            return redirect()->route('my.leave')->with($notif);
        }
    }

    public function DeleteMyleave($id){
        Leave::findorfail($id)->delete();

        $notif = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('my.leave')->with($notif);

    }
}