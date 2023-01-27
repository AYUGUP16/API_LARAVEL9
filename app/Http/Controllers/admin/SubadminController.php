<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\SubadminModel;
use Mail;
use App\Mail\SubadminNotification;

class SubadminController extends Controller
{
    //
    public function get_subadmins_list(){
        
        $subadmin_list = SubadminModel::all();
        return view('admin/subadmin/subadmin-list', compact('subadmin_list'));
    }

    public function insert_subadmin(Request $request){

        $formdata = $request->all();
        //dd($formdata['username']);
        //dd($formdata);


        $subadmin = new SubadminModel; 
        $subadmin->username = $formdata['username'];        
        $subadmin->email = $formdata['email'];
        $subadmin->password = Hash::make($formdata['password']);
        $subadmin->mobile = $formdata['phoneNumber'];                  
        $subadmin->save();
        
        //Last inserted ID
        if($subadmin->id > 0){
            ////Send Mail to Subadmin Email////      
            Mail::to($formdata['email'])->send(new SubadminNotification($formdata));

            return back()->with('flash-success', 'You Have Successfully Added New Subadmin Account.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }

    public function check_user_existance(Request $request){

        //dd($request);
        //echo $request['username'];
        if ($request['existance_type'] == 'uname'){ 

            $subadmins = SubadminModel::where('username', '=', $request['username'])->count();                               
            if($subadmins == 0){
                 echo "true";  //good to register
            } else {
                echo "false"; //already registered
            }  

        } elseif($request['existance_type'] == 'uemail'){

            $subadmins = SubadminModel::where('email', '=', $request['useremail'])->count();                               
            if($subadmins == 0){
                 echo "true";  //good to register
            } else {
                echo "false"; //already registered
            }  

        }
               

    }

    /*
    public function get_single_subadmin($id){        
        $subadmin = Subadmin::find($id); //dd($subadmin);
        return view('admin/subadmin/edit_subadmin', compact('subadmin'));    
    }
    */


    public function edit_subadmin(Request $request){

        $formdata = $request->all();
        
        $hidden_subadmin_id = $formdata['hidden_subadmin_id'];
        $get_subadmin = SubadminModel::find($hidden_subadmin_id);

        //////////////Update Subadmin////////////////
        $get_subadmin->username = $formdata['username']; 
        $get_subadmin->email = $formdata['email'];     
        $get_subadmin->mobile = $formdata['phoneNumber'];
        $get_subadmin->status = $formdata['subadmin_status'];                  
        $get_subadmin->save();
        //Last inserted ID
        if($get_subadmin->id > 0){
            return back()->with('flash-success', 'You Have Successfully Edit Subadmin.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }

}
