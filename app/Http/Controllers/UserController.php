<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserController extends Controller
{
    public function AllUsers(){
        $users = User::where('role', 'user')->get();
        return view('backend.users.users.all_users', compact('users'));
    }
}