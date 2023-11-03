<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Employee;
use App\Models\Tasks;
use App\Models\Projects;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $numEmployees = Employee::count();
        $numTasks = Tasks::count();
        $numPrj = Projects::count();

        $projects = Projects::all();
        return view('admin.admin_dashboard', compact('numEmployees', 'numTasks', 'numPrj', 'projects'));
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}