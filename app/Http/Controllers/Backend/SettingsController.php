<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Position;
use App\Models\Leave;

class SettingsController extends Controller
{
    public function Settings(){
        $positions = Position::all();
        $leaves = Leave::all();
    return view('backend.settings.settings', compact('positions', 'leaves'));
    }

    public function StorePosition(Request $request){
        $valid = Validator::make($request->all(), [
            'position' => 'required',
        ]);

        if($valid->fails()){
            $fails = array(
                'message' => 'Error, Try Again!',
                'alert-type' => 'error',
            );

            return redirect()->route('settings')->with($fails);
        } else {
            $position = Position::insert([
                'position' => $request->position,
            ]);

            $success = array(
                'message' => 'Position Added Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('settings')->with($success);
        }
    }

    public function DeletePosition($id){
        Position::findorfail($id)->delete();
        $delete = array(
            'message' => 'Position Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('settings')->with($delete);
    }

    public function StoreLeave(Request $request){
        $valid = Validator::make($request->all(), [
            'type_leave' => 'required',
        ]);

        if($valid->fails()) {
            $fails = array(
                'message' => 'Error, Try Again',
                'alert-type' => 'error',
            );
            return redirect()->route('seetings')->with($fails);
        } else {
            $leaves = Leave::insert([
                'type_leave' => $request->type_leave,
            ]);
            $success = array(
                'message' => 'Successfully Added Type of Leave',
                'alert-type' => 'success',
            );
            return redirect()->route('settings')->with($success);
        }
    }

    public function DeleteLeave($id){
        Leave::findorfail($id)->delete();
        $delete = array(
            'message' => 'Type of Leave Deleted Successfully',
            'alert-type' => 'warning',
        );

        return redirect()->route('settings')->with($delete);   
    }
}