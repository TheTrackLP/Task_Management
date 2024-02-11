<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function AllLeaves(){
        return view('backend.leaves.all_leaves');
    }
}