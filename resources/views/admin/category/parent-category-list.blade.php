@extends('admin/index')
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add Parent Category</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">All Parent Category</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">  	
  	
    {{-- $parent_category_list --}}  
    <div class="row">
          <div class="col-12">
            <div class="card">  
               <div class="card-header">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add Parent Category</button>
                </div>             
              <div class="card-body">
                <table id="parentcategorylisting" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Category name</th>
                      <!-- <th>slug</th> -->
                      <th>icon</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>                     
                    @foreach($parent_category_list as $parent_category)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$parent_category->parent_name}}</td>
                        <!-- <td>{{$parent_category->parent_slug}}</td> -->
                        <td><img src="{{asset('/admin-assets/img/category_img/parent')}}/{{$parent_category->parent_icon}}"></td>
                        <td>{{ucfirst($parent_category->parent_status)}}</td>                        
                        <td>
                            <a href="" class="edit_parentcat admin_edit_categories" cat_type="parent" cat_id="{{ $parent_category->id}}" cat_name="{{ $parent_category->parent_name}}" icon_path="{{asset('/admin-assets/img/category_img/parent')}}" cat_icon="{{ $parent_category->parent_icon}}" cat_status="{{ $parent_category->parent_status}}">Edit</a>
                            
                        </td>
                      </tr>             
                    @endforeach
                </tbody>
                    <tfoot>
                      <tr>
                        <th>S.no</th>
                        <th>Category name</th>
                        <!-- <th>slug</th> -->
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
                    <h4 class="modal-title">Add Parent Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_new_parentcat_form" action="{{url('admin/insert-parentcat')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group upload_caticon_outer">
                                <div class="containers">      
                                    <div class="imageWrapper">
                                        <img class="image show_cat_icon" src="">
                                    </div>
                                </div>
                                <button class="file-upload">            
                                    <input type="file" name="parent_cat_icon" class="cat-file-input" value="">Choose File
                                </button>
                            </div>

                            <div class="form-group">
                                <label for="Inputparentcat_name">Parent-Category Name</label>
                                <input type="text" name="parent_cat_name" class="form-control parent_cat_name" id="" placeholder="Enter Category Name">
                            </div>              
                            <!-- <div class="form-group">
                                <label for="Inputparentcat_icon">Category Icon</label>
                                <input type="file" name="parent_cat_icon" class="form-control" id="Inputparentcat_icon" >
                            </div>           -->
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="radio" name="cat_status" id="cat_status_active" class="form-check-input cat_status_active" value="active">
                                    <label class="form-check-label" for="cat_status_active">Active</label>
                                </div>  
                                <div class="form-check">
                                <input type="radio" name="cat_status" id="cat_status_inactive" class="form-check-input cat_status_inactive" value="inactive">
                                    <label class="form-check-label" for="cat_status_inactive">Inactive</label>
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
    


    <!-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Parent Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="add_new_parentcat_form" action="{{url('admin/insert-parentcat')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="form-group upload_caticon_outer">
                      <div class="containers">      
                          <div class="imageWrapper">
                              <img class="image show_cat_icon" src="">
                          </div>
                      </div>
                      <button class="file-upload">            
                          <input type="file" name="parent_cat_icon" class="cat-file-input" value="">Choose File
                      </button>
                  </div>


                  <div class="form-group">
                      <label for="Inputparentcat_name">Parent-Category Name</label>
                        <input type="text" name="parent_cat_name" class="form-control" id="Inputparentcat_name" placeholder="Enter Category Name">
                    </div>   
                  
                  <div class="form-group">
                      <div class="form-check">
                          <input type="radio" name="cat_status" id="cat_status_active" class="form-check-input cat_status_active" value="active">
                          <label class="form-check-label" for="cat_status_active">Active</label>
                      </div>  
                      <div class="form-check">
                      <input type="radio" name="cat_status" id="cat_status_inactive" class="form-check-input cat_status_inactive" value="inactive">
                          <label class="form-check-label" for="cat_status_inactive">Inactive</label>
                      </div> 
                  </div>   
                  
                </div>                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>            
          </div>         
        </div>       
    </div> -->



  </div>
</section>
<!-- /. Main content -->
<!-- <script>
  $(function () {
    // $.validator.setDefaults({
    //   submitHandler: function () {
    //     alert( "Form successful submitted!" );
    //   }
    // });
    $('#add_new_parentcat_form').validate({
      rules: {

        parent_cat_name: {
          required: true,
          // minlength: 5         
        },
        parent_cat_icon:{
          required: true          
        },
        cat_status: {
          required :true
        }
        
      },
      messages: {
        parent_cat_name: {
          required: "Please enter Category"          
        },
        parent_cat_icon: {
          required: "Please choose a category image."          
        },
        cat_status: {
          required: "Please Select Status."          
        }
        
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function () {
      $("#parentcategorylisting").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#parentcategorylisting_wrapper .col-md-6:eq(0)');
      
  });

</script>
 -->

@endsection