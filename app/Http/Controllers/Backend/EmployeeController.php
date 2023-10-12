<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Employee;
use Hash;

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
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if($valid->fails()){
            $fail = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('all.employee')->with($fail);
        }else{

            $input['email'] = $request->email;
            //specific column name and table
            $rules = array('email' => 'unique:users,email');

            $existEmail = Validator::make($input, $rules);

            if($existEmail->fails()){
                $notif = array(
                    'message' => 'Error, Email Already Exist',
                    'alert-type' => 'error',
                );
                return redirect()->route('all.employee')->with($notif);
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

                DB::table('users')->insert([
                    'emp_id' => $request->emp_id,
                    'name' => $request->firstname,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'user',
                    'status' => 'active',
                ]);
                $notif = array(
                    'message' => 'New Employee Successfully',
                    'alert-type' => 'success',
                );

                return redirect()->route('all.employee')->with($notif);
            }
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