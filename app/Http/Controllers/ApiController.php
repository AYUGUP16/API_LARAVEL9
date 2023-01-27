<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\plans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;
use Hash;

class ApiController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cust_id' => 'required',
            'fname' => 'required',
            'mob_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:10|unique:students',
        ]);
        $errors = $validator->errors();

        // if(Student::where('mob_no',$request->mob_no)->exists()){
        //     return response()->json(['status' => 'Failed', 'error_message'=>'mobile no. already taken']);

        // }
        if ($validator->fails()) {
            if ($errors->has('mob_no', 'unique')) {
                return response()->json(['status' => 'Failed', 'error_message' => 'mobile no. already taken']);
            }
            return response()->json(['status' => 'Failed', 'error message' =>$errors->all()]);
        }


        $title = $request->input('cust_id');
        $fname = $request->input('fname');
        $mob_no = $request->input('mob_no');


        $students = new Student();
        $students->cust_id = $title;
        $students->fname = $fname;
        $students->mob_no = $mob_no;

        $students->save();
        return response()->json([
            'status' => 'Success',
            'data' => $students,
        ]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mob_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'Failed', 'error message', $validator->errors()]);
        }
        $students = Student::where('mob_no', $request->mob_no)->first();

        if ($students) {
            return response()->json([
                'status' => 'Success',
                'message' => 'mobile no. exist',
                'data' => $students,
            ]);
        } else {
            return response()->json([
                'status' => 'Failed',
                'message' => 'mobile no. not exist',
            ]);
        }
    }
    public function plans(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mrp' => 'required',
            'validity' => 'required',
            'total_data' => 'required',
            'speed' => 'required',
            'voice' => 'required',
            'sms' => 'required',
            'other_addon' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'Failed', 'error_message' => $validator->errors()]);
        }
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
        return response()->json([
            'status' => 'Success',
            'data' => $plans,
        ]);
    }























    // public function show($id)
    // {
    //     $show = Student::find($id);
    //     if ($show) {
    //         return response()->json($show);
    //     }
    //     return "sorry no record found";
    // }
    // public function delete($id)
    // {
    //     $delete = Student::find($id);
    //     $delete->delete();
    //     if ($delete) {
    //         return "record delete successfully";
    //     }
    //     return "sorry no record found";
    // }
}
