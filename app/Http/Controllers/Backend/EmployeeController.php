<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function AllEmployees(){
        $employees = Employee::select('*')
        ->selectRaw("CONCAT(lastname, ', ',firstname, ' ',middlename) as name")
        ->get();
        return view('backend.employees.all_employees', compact('employees'));
    }
    
    public function AddEmployee(Request $request){
        $valid = Validator::make($request->all(), [
            'emp_id' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('all.employees')->with($fails);

        } else {
            $date = date('Y-m-d');
            $employee = Employee::insert([
                'emp_id' => $request->emp_id,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
                'position' => $request->position,
                'status' => 'inactive',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'created_at' => $date,
            ]);
        
            $success = array(
                'message' => 'Successfully Employee Added',
                'alert-type' => 'success',
            );

            return redirect()->route('all.employees')->with($success);
        }

    }
    public function EditEmployee($id){
        $employees = Employee::findorfail($id);

        return response()->json([
            'status'=>200,
            'employees'=>$employees,
        ]);
    }

    public function UpdateEmployee(Request $request){
        $emp_id = $request->id;

        $valid = Validator::make($request->all(), [
            'emp_id' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('all.employees')->with($fails);

        } else {
            $date = date('Y-m-d');
            $employee = Employee::findorfail($emp_id)->update([
                'emp_id' => $request->emp_id,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
                'position' => $request->position,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => $date,
            ]);
        
            $success = array(
                'message' => 'Successfully Employee Updated',
                'alert-type' => 'success',
            );

            return redirect()->route('all.employees')->with($success);
        }
    }

    public function DeleteEmployee($id){
        Employee::findorfail($id)->delete();
        $delete = array(
            'message' => 'Successfully Employee Deleted',
            'alert-type' => 'warning',
        );

        return redirect()->route('all.employees')->with($delete);
    }
}