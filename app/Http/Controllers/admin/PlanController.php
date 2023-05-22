<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\plans;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;


class PlanController extends Controller
{
    public function index()
    {
       $plans=plans::get();

       dd($plans->subscription());


        return view('admin.plans.add_plan',compact('plans','subscription'));
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
    public function show()
    {
        // dd('ok');
        $plans = plans::all();
        $response['data'] = $plans;

        return response()->json(['data'=>$response]);
        // return view('admin.plans.plan_list', compact('plans'));
    }
    public function deleteplan($id)
    {
        // dd('ok');
        // dd($id);
        plans::find($id)->delete();
        return redirect()->route('show_plans')
            ->with('success', 'Plan deleted successfully');
    }
    public function updateplan($id)
    {

        $plans =  plans::find($id);
        return view('admin.plans.update_plan', compact('plans'));
    }
    public function update(Request $request, $id)
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
        $plans = plans::find($id);
        $plans->update($request->all());
        return redirect()->route('show_plans')->with('status', 'plan has been updated successfully.');
    }
    public function subscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subscription' => 'required',
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return response()->json([$errors]);
        }
        $Subscription = $request->input('subscription');
        $subs = new Subscription();
        $subs->subscriptions = $Subscription;

        $subs->save();
        return response()->json([
            'status' => 'Success',
            'message' => 'subscription added Successfully',
            'data' => $subs,
        ]);
    }
    public function statusupdate(Request $request){
        $query=DB::table('plans')->where('id',$request->id)->update(['status'=> $request->status]);
        $data=plans::where('id',$request->id)->pluck('status');
        return $data;

    }
    }
