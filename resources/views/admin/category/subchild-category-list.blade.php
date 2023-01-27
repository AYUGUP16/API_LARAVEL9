@extends('admin/index')
@section('title', 'Child Category')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sub-child Catgories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Subchild Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">   
        
            {{-- $subchild_category_list --}}  
            {{-- $parent_category_list --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">   
                    <div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add SubChild Category</button>
                    </div>              
                    <div class="card-body"> 
                        <table id="subchildcategorylisting" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>S.no</th>
                                <th>Category name</th>
                                <th>Slug</th>
                                <th>Child Category</th>
                                <th>Parent Category</th>                                
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                     
                                @foreach($subchild_category_list as $subchild_category)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$subchild_category->subchild_name}}</td>
                                    <td>{{$subchild_category->subchild_slug}}</td>
                                    <!-- <td>{{$subchild_category->subchild_child_id}}</td> -->
                                    <td>{{$subchild_category->Subchild_With_Childcat->child_name}}</td>
                                    <td>{{$subchild_category->Subchild_With_Parentcat->parent_name}}</td>
                                    <td><img src="{{asset('/admin-assets/img/category_img/subchild')}}/{{$subchild_category->subchild_icon}}"></td>
                                    <td>{{ucfirst($subchild_category->subchild_status)}}</td>
                                    <td>
                                        <a href="" class="edit_subchildcat admin_edit_categories" cat_type="subchild" subchild_id="{{ $subchild_category->id}}" subchild_name="{{ $subchild_category->subchild_name}}" subchild_parent_id="{{ $subchild_category->subchild_parent_id}}"  subchild_child_id="{{ $subchild_category->subchild_child_id}}" icon_path="{{asset('/admin-assets/img/category_img/subchild')}}" subchild_icon="{{ $subchild_category->subchild_icon}}" subchild_status="{{ $subchild_category->subchild_status}}">Edit</a>
                                    </td>
                                    </tr>             
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>Category name</th>
                                <th>Slug</th>
                                <th>Child Category</th>
                                <th>Parent Category</th>                                
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>                    
                    </div>                    
                </div>               
            </div>

            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add SubChild Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_subchild_form" action="{{url('admin/insert-subchildcat')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group upload_caticon_outer">
                                        <div class="containers">      
                                            <div class="imageWrapper">
                                                <img class="image show_cat_icon" src="">
                                            </div>
                                        </div>
                                        <button class="file-upload">            
                                            <input type="file" name="subchild_cat_icon" class="cat-file-input" value="">Choose File
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Select Parent Category</label>
                                        <select class="form-control" name="subchild_parent_id" id="subchild_parent_id">
                                            <option value="">Select Parent Category</option>
                                            @foreach($parent_category_list as $parent_category)
                                                <option value="{{$parent_category->id}}">{{$parent_category->parent_name}}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Select Child Category</label>
                                        <select class="form-control" name="subchild_child_id" id="subchild_child_id">
                                            <option value="">Select Child Category</option>                                            
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Inputchildcat_name">SubChild Category Name</label>
                                        <input type="text" name="subchild_cat_name" class="form-control subchild_cat_name" id="" placeholder="Enter Category Name">
                                    </div>  
                                    
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" name="subchild_status" id="subchild_status_active" class="form-check-input subchild_status_active" value="active">
                                            <label class="form-check-label" for="subchild_status_active">Active</label>
                                        </div>  
                                        <div class="form-check">
                                        <input type="radio" name="subchild_status" id="subchild_status_inactive" class="form-check-input subchild_status_inactive" value="inactive">
                                            <label class="form-check-label" for="subchild_status_inactive">Inactive</label>
                                        </div> 
                                    </div>                                   
                                </div>                
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>            
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>      
                        
            
        
        </div>

    </section>
    
    

@stop