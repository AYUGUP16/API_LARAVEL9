<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use App\Models\User;
use File;

class Admincontroller extends Controller
{
    // function index(){
    	
    // 	return view('admin/login');
    // }

    public function user_login_func(Request $request){

    	$credentials = $request->validate([            
            'email' => 'required|email',
            'password' => 'required'
        ]);  
    	
    	if (Auth::attempt($credentials)) {
    		$request->session()->regenerate();    		
            return redirect('/admin/dashboard');
        }  		
        return back()->withErrors(['email' => 'Login details are not valid']);
    	
    }

    public function signOut() {

        //Session::flush();
        Auth::logout();
  
        return Redirect('admin/login');
    }

    public function recover_password_func(Request $request){

        $data = $request->all();
        $email = $data['email'];
        //dd($email);
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);

    }


    public function reset_password_func(Request $request){
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);        
    

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }
    

    /*
    public function user_registration_func(Request $request){

    	$this->validate($request, [
            'full_name' => 'required',
            'email' => 'required|email|max:255',
            'user_password' => 'min:6|same:confirm_pass',            
			'confirm_pass' => 'required|min:6',
			'terms' => 'required',
        ]);        

        $inserted = DB::table('all_users')->insertGetId([
					    'username' => $request->full_name,
					    'email' => $request->email,	
                        'mobile' => "",	
                        'pro_img' => "",    			   
					    'password' => Hash::make($request->user_password)
					]);

        if($inserted > 0){
        	return back()->with('success', 'You Have Successfully Created Your Profile.');
        } else{
        	return back()->with('fail', 'something went wrong.');
        }
    	
    }
    */


    public function get_admin_generalinfo(){

        //$GetData['data'] = User::find(1);
        $GetData['data'] = Auth::user();
        //return $GetData;        
        return view('admin/profile/profile', $GetData);
    }


    public function update_admin_generalinfo(Request $request){

        //$formdata = $request->all();
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:10'
        ]);
        
        $User = User::find(1);        
        $User->username = $request->username;
        $User->email = $request->email;
        $User->mobile = $request->mobile;

        $User->save();

        return back()->with('flash-success', 'You Have Successfully Update Your Profile.');

    }


    public function storeImage(Request $request)
    {

        $file = $request->file('image');
        //dd($file);
        
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);  
                
        //Get uploaded file information
        if ($request->file('image')) {
            
            $originalname = $request->file('image')->getClientOriginalName(); 
            //dd($originalname);     
            $fileextension = $request->file('image')->extension();   
            //dd($fileextension);
            $filenewname = 'user_1'.'.'.$fileextension;
            //$path = $request->file('image')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $path = public_path('/admin-assets/img/profile_img/'.'user_1');
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $destinationPath = public_path().'/admin-assets/img/profile_img' ;
            $path = $request->file('image')->move($path,$filenewname);
                  
        }
       
        $User = User::find(1);   
        $User->pro_img = $filenewname;        
        $User->save();
 
        

        return response()->json($path);
        
    }

    



}