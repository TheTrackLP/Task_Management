<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Employee;
use App\Models\Position;

class EmployeeController extends Controller
{
    public function AllEmployees(){
        $employees = DB::table('employees')
                        ->select('employees.*')
                        ->selectRaw("CONCAT(employees.lastname, ', ',employees.firstname, ' ',employees.middlename) as name, CONCAT(positions.position) as position")
                        ->leftjoin('positions', 'positions.id', 'employees.position_id')
                        ->get();

        $positions = Position::all();
        return view('backend.employees.all_employees', compact('employees', 'positions'));
    }
    
    public function AddEmployee(Request $request){
        $valid = Validator::make($request->all(), [
            'emp_id' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'position_id' => 'required',
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
                'position_id' => $request->position_id,
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
            'position_id' => 'required',
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
                'position_id' => $request->position_id,
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