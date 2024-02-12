<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.admin_dashboard');
    }

    public function AllAdmin(){
        $admins = User::where('role', 'admin')->get();
        return view('backend.users.admins.all_admins', compact('admins'));
    }
}