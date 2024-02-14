<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use DB;
use Auth;
use Validator;
use Hash;

class UserController extends Controller
{
    public function AllUsers(){
        $users = User::where('role', 'user')->get();
        $employees = Employee::select('*')
                                ->selectRaw("CONCAT(lastname, ', ', firstname, ' ', middlename) as name")
                                ->get();
        return view('backend.users.users.all_users', compact('users', 'employees'));
    }

    public function GetUsers($id)
    {
        $data = Employee::findorfail($id);
        return response()->json([
            'status'=>200,
            'data'=>$data,
        ]);
    }

    public function StoreUser(Request $request){
        $valid = Validator::make($request->all(), [
            'user_id' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );
            return redirect()->route('all.users')->with($fails);
        } else {
            $users = User::insert([
                'emp_id' => $request->user_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'emp_id' => $request->emp_id,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            $success = array(
                'message' => 'Successfully Added User Account',
                'alert-type' => 'success',
            );

            return redirect()->route('all.users')->with($success);
        }
    }

    public function UserDashboard(){
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

        return view('users.user_dashboard', compact('profileData', 'partProject', 'myTask'));
    }

    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}