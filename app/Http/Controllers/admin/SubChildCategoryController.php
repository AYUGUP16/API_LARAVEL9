<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubChildCategoryModel;
use App\Models\ParentCategoryModel;
use App\Models\ChildCategoryModel;
use App\Traits\Common_trait;

class SubChildCategoryController extends Controller
{
    use Common_trait;

    function get_subchild_categories_list(){

        // $subchild_category_list = SubChildCategoryModel::all();
        $subchild_category_list = SubChildCategoryModel::with(['Subchild_With_Childcat', 'Subchild_With_Parentcat'])->get();
        //dd($subchild_category_list);
        $parent_category_list = ParentCategoryModel::all();
        return view('admin.category.subchild-category-list', compact('subchild_category_list', 'parent_category_list'));

    }

    function insert_subchild_cat(Request $request){

        $formdata = $request->all();
        //dd($formdata);  
        
        //////////////Store Image////////////////
        //$file = $request->file('child_cat_icon');  
        /*
        $request->validate([
          'child_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */
        $subchild_slug = $this->create_unique_slug($formdata['subchild_cat_name'], 'sub_child_category_models', 'subchild_slug');
        // dd($subchild_slug);

        //Get uploaded file information
        if ($request->file('subchild_cat_icon')) {
            
            $originalname = $request->file('subchild_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('subchild_cat_icon')->extension(); 
            $Newfilename = $subchild_slug.'.'.$fileextension;
            //$path = $request->file('subchild_cat_icon')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $subchildpath = public_path('admin-assets/img/category_img/'.'subchild');
            /*
            if(!File::isDirectory($subchildpath)){
                File::makeDirectory($subchildpath, 0777, true, true);
            }
            */
            $destinationPath = public_path().'admin-assets/img/category_img' ;
            $subchildpath = $request->file('subchild_cat_icon')->move($subchildpath,$Newfilename);
                  
        } 

        //////////////Insert Data////////////////
        $subchil_category = new SubChildCategoryModel; 
        $subchil_category->subchild_name = $formdata['subchild_cat_name'];        
        $subchil_category->subchild_slug = $subchild_slug;   
        $subchil_category->subchild_child_id = $formdata['subchild_child_id'];
        $subchil_category->subchild_parent_id = $formdata['subchild_parent_id'];     
        $subchil_category->subchild_icon = $subchild_slug.'.'.$fileextension;
        $subchil_category->subchild_status = $formdata['subchild_status'];                  
        $subchil_category->save();
        //Last inserted ID
        if($subchil_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Added Sub-Child Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }

    function get_child_acc_to_parent(Request $request){
        
        $parent_id = $request->parent_id;
        $get_child_lists = ChildCategoryModel::where('parent_cat', $parent_id)->get();
        //pre($get_child_lists);
        if($get_child_lists){
            //return response()->json(['status'=>'Got Simple Ajax Request.', 'data'=>$get_child_lists]);
            return json_encode(array('status'=>'success','datas'=>$get_child_lists)); 
        } else {
            return json_encode(array('status'=>'failed','data'=>'empty'));;
        }
        
        //return view('admin.category.subchild-cat', compact('get_child_lists'));

    }

    function edit_subchildcat(Request $request){

        $formdata = $request->all();
        //dd($formdata);
        $hidden_child_id = $formdata['hidden_subchild_id'];
        $edit_subchild_category = SubChildCategoryModel::find($hidden_child_id);
        //dd($edit_subchild_category);

        //////////////Store Image////////////////
        //$file = $request->file('subchild_cat_icon');
        //dd($file);
        /*
        $request->validate([
          'subchild_cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        */

        ///////Check if title is changed then change the slug also////////
        if($edit_subchild_category->subchild_name != $formdata['subchild_cat_name']){
            $subchild_slug = $this->create_unique_slug($formdata['subchild_cat_name'], 'sub_child_category_models', 'subchild_slug');
        } else {
            $subchild_slug = $edit_subchild_category->subchild_slug; 
        }


        //Get uploaded file information
        if ($request->file('subchild_cat_icon')) {
            
            $originalname = $request->file('subchild_cat_icon')->getClientOriginalName();               
            $fileextension = $request->file('subchild_cat_icon')->extension(); 
            $Newfilename = $subchild_slug.'.'.$fileextension;
            //$path = $request->file('subchild_cat_icon')->storeAs('profile_img', $originalname);

            //Create directory if not exist
            $subchildpath = public_path('admin-assets/img/category_img/'.'subchild');
            /*
            if(!File::isDirectory($subchildpath)){
                File::makeDirectory($subchildpath, 0777, true, true);
            }
            */
            if(file_exists($subchildpath.'/'.$edit_subchild_category->subchild_icon)){ 
                unlink($subchildpath.'/'.$edit_subchild_category->subchild_icon);
            }

            $destinationPath = public_path().'admin-assets/img/category_img' ;
            $subchildpath = $request->file('subchild_cat_icon')->move($subchildpath,$Newfilename);
            $edited_filename = $subchild_slug.'.'.$fileextension;
                  
        } else {

            //$edited_filename = $edit_subchild_category->subchild_icon;

            $img = $edit_subchild_category->subchild_icon;
            $get_extension = explode(".", $img); 
            $dir = public_path('admin-assets/img/category_img/'.'subchild');
            $oldfile_name = $dir.'/'.$edit_subchild_category->subchild_icon;
            $newfile_name = $dir.'/'.$subchild_slug.'.'.$get_extension[1];
            rename($oldfile_name, $newfile_name);
            //Create Custom File Name
            $edited_filename = $subchild_slug.'.'.$get_extension[1];

        }

        //////////////Update Data////////////////
        $edit_subchild_category->subchild_name = $formdata['subchild_cat_name'];        
        $edit_subchild_category->subchild_slug = $subchild_slug;  
        $edit_subchild_category->subchild_child_id = $formdata['subchild_child_id'];     
        $edit_subchild_category->subchild_parent_id = $formdata['subchild_parent_id'];  
        $edit_subchild_category->subchild_icon = $edited_filename;
        $edit_subchild_category->subchild_status = $formdata['subchild_status'];                  
        $edit_subchild_category->save();
        //Last inserted ID
        if($edit_subchild_category->id > 0){
            return back()->with('flash-success', 'You Have Successfully Edit Sub-Child Category.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }

}
