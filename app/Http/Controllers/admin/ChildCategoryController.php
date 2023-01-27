<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildCategoryModel;
use App\Models\ParentCategoryModel;
use App\Traits\Common_trait;

class ChildCategoryController extends Controller
{
    //
    use Common_trait;

    public function get_child_categories_list(){
        
        // $parent_category_list = ParentCategoryModel::where('cat_status', 'active')->get();
        $parent_category_list = ParentCategoryModel::all();

        //$child_category_list = ChildCategoryModel::all();  
        $child_category_list = ChildCategoryModel::with('ParentCat')->get();
        //dd($child_category_list);

        $category_list = array('parent' => $parent_category_list, 'child' => $child_category_list);        

        return view('admin.category.child-category-list', compact('child_category_list', 'parent_category_list'));
    }

    public function insert_child_cat(Request $request){
        
        $formdata = $request->all();
        //dd($formdata);     

        //////////////Store Image////////////////
        $file = $request->file('child_cat_icon');
        //dd($file);
        /*
        $request->validate([
          'child_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */
        $child_slug = $this->create_unique_slug($formdata['child_cat_name'], 'child_category_models', 'child_slug');
        //dd($child_slug);

        //Get uploaded file information
        if ($request->file('child_cat_icon')) {
            
            $originalname = $request->file('child_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('child_cat_icon')->extension(); 
            $Newfilename = $child_slug.'.'.$fileextension;
            //$path = $request->file('child_cat_icon')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $childpath = public_path('admin-assets/img/category_img/'.'child');
            /*
            if(!File::isDirectory($childpath)){
                File::makeDirectory($childpath, 0777, true, true);
            }
            */
            $destinationPath = public_path().'admin-assets/img/category_img' ;
            $childpath = $request->file('child_cat_icon')->move($childpath,$Newfilename);
                  
        }   

        //////////////Insert Data////////////////
        $chil_category = new ChildCategoryModel; 
        $chil_category->child_name = $formdata['child_cat_name'];        
        $chil_category->child_slug = $child_slug;   
        $chil_category->parent_cat = $formdata['parent_id'];     
        $chil_category->child_icon = $child_slug.'.'.$fileextension;
        $chil_category->child_status = $formdata['child_status'];                  
        $chil_category->save();
        //Last inserted ID
        if($chil_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Added Child Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }

    public function edit_childcat(Request $request){

        $formdata = $request->all();
        $hidden_child_id = $formdata['hidden_child_id'];
        $edit_child_category = ChildCategoryModel::find($hidden_child_id);
        //dd($formdata);

        //////////////Store Image////////////////
        $file = $request->file('child_cat_icon');
        //dd($file);
        /*
        $request->validate([
          'child_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */

        ///////Check if title is changed then change the slug also////////
        if($edit_child_category->child_name != $formdata['child_cat_name']){
            $child_slug = $this->create_unique_slug($formdata['child_cat_name'], 'child_category_models', 'child_slug');
           
        } else {
            $child_slug = $edit_child_category->child_slug;             
        }
        

        //Get uploaded file information
        if ($request->file('child_cat_icon')) {
            
            $originalname = $request->file('child_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('child_cat_icon')->extension(); 
            $Newfilename = $child_slug.'.'.$fileextension;           

            //Create directory if not exist
            $childpath = public_path('admin-assets/img/category_img/'.'child');
            /*
            if(!File::isDirectory($childpath)){
                File::makeDirectory($childpath, 0777, true, true);
            }
            */
            if(file_exists($childpath.'/'.$edit_child_category->child_icon)){ 
                unlink($childpath.'/'.$edit_child_category->child_icon);
            }

            $destinationPath = public_path().'admin-assets/img/category_img';
            $childpath = $request->file('child_cat_icon')->move($childpath,$Newfilename);
            //Create Custom File Name
            $edited_filename = $child_slug.'.'.$fileextension;
                  
        } else {

            //$edited_filename = $edit_child_category->child_icon;

            ////Rename Image Name according to New Title or Slug
            $img = $edit_child_category->child_icon;
            $get_extension = explode(".", $img); 
            $dir = public_path('admin-assets/img/category_img/'.'child');
            $oldfile_name = $dir.'/'.$edit_child_category->child_icon;
            $newfile_name = $dir.'/'.$child_slug.'.'.$get_extension[1];
            rename($oldfile_name, $newfile_name);
            //Create Custom File Name
            $edited_filename = $child_slug.'.'.$get_extension[1];

        } 

        //////////////Update Data////////////////        
        // $edit_child_category = ParentCategoryModel::find($hidden_cat_id);
        $edit_child_category->child_name = $formdata['child_cat_name'];        
        $edit_child_category->child_slug = $child_slug;     
        $edit_child_category->parent_cat = $formdata['parent_id'];  
        $edit_child_category->child_icon = $edited_filename;
        $edit_child_category->child_status = $formdata['child_status'];                  
        $edit_child_category->save();
        //Last inserted ID
        if($edit_child_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Edit Child Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }


}
