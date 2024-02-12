<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Position;

class SettingsController extends Controller
{
    public function Settings(){
        $positions = Position::all();
    return view('backend.settings.settings', compact('positions'));
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
}