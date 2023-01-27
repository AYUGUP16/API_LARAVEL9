@extends('admin/index')
@section('title', 'Child Category')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Child Catgories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Child Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">   
        
            {{-- $child_category_list --}}  
            {{-- $parent_category_list --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">   
                    <div class="card-header">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add Child Category</button>
                    </div>              
                    <div class="card-body"> 
                        <table id="childcategorylisting" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>S.no</th>
                                <th>Category name</th>
                                <th>slug</th>
                                <th>Parent Category</th>
                                <th>icon</th>
                                <th>status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                     
                                @foreach($child_category_list as $child_category)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$child_category->child_name}}</td>
                                    <td>{{$child_category->child_slug}}</td>
                                    <td>{{$child_category->ParentCat->parent_name}}</td>                                    
                                    <!-- <td>{{$child_category->child_icon}}</td> -->
                                    <td><img src="{{asset('/admin-assets/img/category_img/child')}}/{{$child_category->child_icon}}"></td>
                                    <td>{{ucfirst($child_category->child_status)}}</td>
                                    <td>
                                        <a href="" class="edit_childcat admin_edit_categories" cat_type="child" child_id="{{ $child_category->id}}" child_name="{{ $child_category->child_name}}" parent_id="{{ $child_category->parent_cat}}" icon_path="{{asset('/admin-assets/img/category_img/child')}}" child_icon="{{ $child_category->child_icon}}" child_status="{{ $child_category->child_status}}">Edit</a>                                        
                                    </td>
                                    </tr>             
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>S.no</th>
                                <th>Category name</th>
                                <th>slug</th>
                                <th>Parent Category</th>
                                <th>icon</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>  
        
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Child Category</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add_new_childcat_form" action="{{url('admin/insert-childcat')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group upload_caticon_outer">
                                        <div class="containers">      
                                            <div class="imageWrapper">
                                                <img class="image show_cat_icon" src="">
                                            </div>
                                        </div>
                                        <button class="file-upload">            
                                            <input type="file" name="child_cat_icon" class="cat-file-input" value="">Choose File
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <label for="Inputchildcat_name">Select Parent Category</label>
                                        <select class="form-control" name="parent_id" id="parent_id">
                                            <option value="">Select Parent Category</option>
                                            @foreach($parent_category_list as $parent_category)
                                                <option value="{{$parent_category->id}}">{{$parent_category->parent_name}}</option>                                            
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Inputchildcat_name">Child-Category Name</label>
                                        <input type="text" name="child_cat_name" class="form-control child_cat_name" id="" placeholder="Enter Category Name">
                                    </div>      
                                           
                                    
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" name="child_status" id="child_status_active" class="form-check-input child_status_active" value="active">
                                            <label class="form-check-label" for="child_status_active">Active</label>
                                        </div>  
                                        <div class="form-check">
                                        <input type="radio" name="child_status" id="child_status_inactive" class="form-check-input child_status_inactive" value="inactive">
                                            <label class="form-check-label" for="child_status_inactive">Inactive</label>
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