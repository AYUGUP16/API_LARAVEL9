<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;


use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ImageController extends Controller
{
    public function index()
    {
        return view('admin.slider.slider');
      
    }
    public function addimage(Request $request)
    {
       
       
        $request->validate([
            'image' => 'required',

        ]);
        $imageName = time() . '.' . $request->image->extension();

        $url =asset('public/images/'.$imageName);
       $img = $request->image->move(public_path('images'), $url);
        $data = Slider::insert([
            'images' => $url,
        ]);
        return redirect()->route('slider')->with('status', 'image Added Successfully');

        
    }
    
}
