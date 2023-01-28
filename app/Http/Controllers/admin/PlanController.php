<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\plans;

class PlanController extends Controller
{
    public function index()
    {
        return view('admin.plans.add_plan');
    }
    public function create(Request $request)
    {
       $request->validate([
             'mrp' => 'required',
            'validity' => 'required',
            'total_data' => 'required',
            'speed' => 'required',
            'voice' => 'required',
            'sms' => 'required',
            'other_addon' => 'required',
       ]);
        
        $mrp = $request->input('mrp');
        $validity = $request->input('validity');
        $total_data = $request->input('total_data');
        $speed = $request->input('speed');
        $voice = $request->input('voice');
        $sms = $request->input('sms');
        $other_addon = $request->input('other_addon');


        $plans = new plans();
        $plans->mrp =  $mrp;
        $plans->validity = $validity;
        $plans->total_data = $total_data;
        $plans->speed = $speed;
        $plans->voice = $voice;
        $plans->sms = $sms;
        $plans->other_addon = $other_addon;

        $plans->save();
        return redirect()->route('add_plans')->with('status', 'Plan Added Successfully');

    }
}
