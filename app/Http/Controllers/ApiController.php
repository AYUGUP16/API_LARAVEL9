<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Plan;
use App\Models\Home;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use AmrShawky\LaravelCurrency\Facade\Currency;
// use Symfony\Bundle\FrameworkBundle\Controller;

class ApiController extends Controller
{
    public function create(Request $request)
    {

        $validatorssss = Validator::make($request->all(), [
            'cust_id' => 'bail|required|unique:students',
            'fname' => 'required',
            'mob_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:10|unique:students',
        ]);
        $errors = it $validator->errors();
        //fsfsfsfsf

        // dd("ok");
        $curr=Currency::convert()
        ->from('ALL')
        ->to('USD')
        ->amount(150)
        ->get();
        dd($curr);

        // i am ayush gupta54654




//         $validator = Validator::make($request->all(), [
//             'cust_id' => 'required|unique:students',
//             'fname' => 'required',
//             'mob_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:10|unique:students',
//         ]);
//         $errors=$validator->errors()->all();
//         dd($errors);
//         $custerr=$errors['cust_id'][0];
//         $nameerr=$errors['fname'][0];
//         $moberr=$errors['mob_no'][0];
// // dd($errors);
//         $fnameerror = $moberror=$custerror="";

//         if ($validator->fails()) {
//             // return response()->json($validator->errors()->all());

//             if ($errors->has('cust_id')) {
//                 if ($errors->get('cust_id', 'unique')) {
//                     $custerror=$custerr;
//                     // return response()->json(['status' => 'Failed', 'message' => $errors->first()]);
//                 } else {
//                    $custerror=$custerr;
//                     // return response()->json(['status' => 'Failed', 'message' => $errors->first()]);
//                }
//            } elseif ($errors->has('fname')) {
//                $fnameerror=$nameerr;
//                 // return response()->json(['status' => 'Failed', 'message' => $errors->first()]);
//            } elseif ($errors->get('mob_no')) {
//             if ($errors->has('mob_no', 'unique')) {
//                $moberror=$moberr;
//                     // return response()->json(['status' => 'Failed', 'message' => $errors->first()]);
//            } else {
//                $moberror=$moberr;

//                     // return response()->json(['status' => 'Failed', 'message' => $errors->first()]);
//            }
//        }
//    }
//    $det= array("cust_id"=>$custerror,"fname"=>$fnameerror,"mob_no"=>$moberror);
//    echo json_encode($det);

//    // return response()->json(['message' => $det]);

//    $title = $request->input('cust_id');
//    $fname = $request->input('fname');
//    $mob_no = $request->input('mob_no');

//    $students = new Student();
//    $students->cust_id = $title;
//    $students->fname = $fname;
//    $students->mob_no = $mob_no;

//    $students->save();
//    return response()->json([
//     'status' => 'Success',
//     'message' => 'User Register Successfuly',
//     'data' => $students,
// ]);
}
public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'mob_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
    ]);
    if ($validator->fails()) {
>>>>>>> 21eab9e7e997ec9cc77b8be748d5d8f6aeeae7ac


        return response()->json(['status' => 'Failed', 'message' => $validator->errors()->all()]);
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
public function getplans()
{
    $getplan = Plan::all();
    return  response()->json(['status' => 'Success', 'all_plans' => $getplan]);
}
public function getdetails($id)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://185.85.152.58:8082/ejbi/client/id/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
        // dd($id);


    curl_close($curl);
    $data = json_decode($response);
        // dd($data);
    $home = new Home();
    $home->plan_id = $data->id;
    $home->username = $data->username;
    $home->service = $data->service;
    $home->payment = $data->payment;
        // $home->plan = $data->plan;

    $home->save();
    return response()->json([
        'status' => 'Success',
        'message' => 'Plan details!!!',
        'data' => array('my_plan' => array('plan_id' => $home->id, 'amount' => $home->payment), 'due_payment' => $home->payment, 'services' => array('first' => $home->service)),
    ]);
}
public function getimage()
{
    $getimage = Slider::all()->toArray();
        // dd($getimage);
    $data = [];
    foreach ($getimage as $i) {
        $data[] = $i['images'];
    }
    return response()->json(['Slider_images' => $data]);
}

}
