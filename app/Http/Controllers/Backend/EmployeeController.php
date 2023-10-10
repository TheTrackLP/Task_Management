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
        $allEmployees = DB::table('employees')
        ->select('*')
        ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
        ->get();
        return view('backend.all_employee', compact('allEmployees'));
    }

    public function AddEmployee(Request $request){
        $valid = Validator::make($request->all(),[
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('all.employee')->with($fail);
        }else{
            DB::table('employees')->insert([
                'emp_id' => $request->emp_id,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'contact' => $request->contact,
                'email' => $request->email,
                'position' => $request->position,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'address' => $request->address,
            ]);

            $notif = array(
                'message' => 'New Employee Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.employee')->with($notif);
        }
    }

    public function EditEmployee($id){
        $employeeData = Employee::findorfail($id);
        return view('backend.edit_employee', compact('employeeData'));
    }

    public function UpdateEmployee(Request $request){
        
        $empp_id = $request->id;

        $valid = Validator::make($request->all(),[
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if($valid->fails()){
            $fail = array(
                'message' => 'Error Update, Try Again',
                'alert-type' => 'error',
            );

            return redirect()->route('all.employee')->with($fail);
        }else{
            $empp_id = $request->id;

            Employee::findorfail($empp_id)->update([
                'emp_id' => $request->emp_id,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'contact' => $request->contact,
                'email' => $request->email,
                'position' => $request->position,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'address' => $request->address,
            ]);

            $notif = array(
                'message' => 'Employee Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.employee')->with($notif);
        }
        
    }

    public function DeleteEmployee($id){
        Employee::findorfail($id)->delete();

        $delete = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('all.employee')->with($delete);
    }
}