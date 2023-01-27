<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentCategoryModel;
use App\Traits\Common_trait;

class ParentCategoryController extends Controller
{
    use Common_trait;
    //
    public function get_parent_categories_list(){

        $parent_category_list = ParentCategoryModel::all();
        // dd($parent_category_list);
        return view('admin/category/parent-category-list', compact('parent_category_list'));
    }

    public function insert_parent_cat(Request $request){

        $formdata = $request->all();
        //dd($formdata);        

        //////////////Store Image////////////////
        $file = $request->file('parent_cat_icon');
        //dd($file);
        /*
        $request->validate([
          'parent_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */

        $cat_slug = $this->create_unique_slug($formdata['parent_cat_name'], 'parent_category_models', 'parent_slug');
        //dd($cat_slug);

        //Get uploaded file information
        if ($request->file('parent_cat_icon')) {
            
            $originalname = $request->file('parent_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('parent_cat_icon')->extension(); 
            $Newfilename = $cat_slug.'.'.$fileextension;
            //$path = $request->file('parent_cat_icon')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $path = public_path('admin-assets/img/category_img/'.'parent');
            /*
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            */
            $destinationPath = public_path().'admin-assets/img/category_img' ;
            $path = $request->file('parent_cat_icon')->move($path,$Newfilename);
                  
        }     
        

        //////////////Insert Data////////////////
        $parent_category = new ParentCategoryModel; 
        $parent_category->parent_name = $formdata['parent_cat_name'];        
        $parent_category->parent_slug = $cat_slug;       
        $parent_category->parent_icon = $cat_slug.'.'.$fileextension;
        $parent_category->parent_status = $formdata['cat_status'];                  
        $parent_category->save();
        //Last inserted ID
        if($parent_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Added New Parent Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }        

    }


    public function edit_parent_cat(Request $request){

        $formdata = $request->all();
        $hidden_cat_id = $formdata['hidden_cat_id'];
        $edit_parent_category = ParentCategoryModel::find($hidden_cat_id);        
        //dd($edit_parent_category);               
        
        //////////////Store Image////////////////
        $file = $request->file('parent_cat_icon');
        //dd($file);
        /*
        $request->validate([
          'parent_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */

        /////////Check if title is changed then chnage the slug also///////////
        if($edit_parent_category->parent_name != $formdata['parent_cat_name']){
            $cat_slug = $this->create_unique_slug($formdata['parent_cat_name'], 'parent_category_models', 'parent_slug');
            //dd($cat_slug);
        } else {
            $cat_slug = $edit_parent_category->parent_slug;
            //dd($cat_slug);  
        }

        //Get uploaded file information
        if ($request->file('parent_cat_icon')) {            
            
            $originalname = $request->file('parent_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('parent_cat_icon')->extension(); 
            $Newfilename = $cat_slug.'.'.$fileextension;
            //$path = $request->file('parent_cat_icon')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $path = public_path('admin-assets/img/category_img/'.'parent');
            /*
            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            */
            if(file_exists($path.'/'.$edit_parent_category->parent_icon)){ 
                unlink($path.'/'.$edit_parent_category->parent_icon);
            }
            
            $destinationPath = public_path().'admin-assets/img/category_img' ;
            $path = $request->file('parent_cat_icon')->move($path,$Newfilename);
            //Create Custom File Name
            $edited_filename = $cat_slug.'.'.$fileextension;
                  
        } else {

            // $edited_filename = $edit_parent_category->parent_icon;

            ////Rename Image Name according to New Title or Slug
            $img = $edit_parent_category->parent_icon;
            $get_extension = explode(".", $img); 
            $dir = public_path('admin-assets/img/category_img/'.'parent');
            $oldfile_name = $dir.'/'.$edit_parent_category->parent_icon;
            $newfile_name = $dir.'/'.$cat_slug.'.'.$get_extension[1];
            rename($oldfile_name, $newfile_name);
            //Create Custom File Name
            $edited_filename = $cat_slug.'.'.$get_extension[1];

        } 
        

        //////////////Update Data////////////////        
        // $edit_parent_category = ParentCategoryModel::find($hidden_cat_id);
        $edit_parent_category->parent_name = $formdata['parent_cat_name'];        
        $edit_parent_category->parent_slug = $cat_slug;       
        $edit_parent_category->parent_icon = $edited_filename;
        $edit_parent_category->parent_status = $formdata['cat_status'];                  
        $edit_parent_category->save();
        //Last inserted ID
        if($edit_parent_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Edit Parent Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }


   
}
