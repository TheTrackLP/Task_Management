<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use A

class SettingsController extends Controller
{
    public function Settings(){
        return view('backend.settings.settings');
    }

    public function StorePosition(Request $request){

    }
}