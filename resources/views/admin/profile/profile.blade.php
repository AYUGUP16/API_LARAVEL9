@extends('admin/index')
@section('title','Profile')
@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Profile</h1>
      </div>          
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline admin_edit_profile_image">
          <div class="card-body box-profile">            
            <form method="post" action="{{route('uploadimage')}}" id="upload-image-form" enctype="multipart/form-data">
            @csrf
              <div class="avatar-upload">
                  <div class="avatar-edit">
                      <input type='file' name="image" id="adminimageUpload" accept=".png, .jpg, .jpeg" onchange="readURL(this);"/>
                      <label for="adminimageUpload"></label>
                  </div>
                  <div class="avatar-preview">
                      <div id="imagePreview" style="background-image: url({{ asset('/admin-assets/img/profile_img/user_1/') }}/{{$data->pro_img}});">
                      </div>
                  </div>
              </div>
            </form>            
            <h3 class="profile-username text-center">Nina Mcintire</h3>
            <p class="text-muted text-center">Administrator</p>

          </div>
        </div>
        <!-- /.Profile Image -->          
      </div>
      
      <div class="col-md-9">
        <div class="card">
          <!------Tab-------->
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Info</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
          </div>
          <!-----/.Tab----->

          <!------Tab Content-------->
          <div class="card-body">
            <div class="tab-content">                	
              
            	<!------Information Tab-------->
              <div class="tab-pane active" id="information">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">UserName : </label>
                  <div class="col-sm-10 ">{{$data->username}}</div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Email : </label>
                  <div class="col-sm-10">{{$data->email}}</div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Mobile : </label>
                  <div class="col-sm-10">{{$data->mobile}}</div>
                </div>
              </div>
              
              	<!------Setting Tab-------->
              	<div class="tab-pane" id="settings">

                    <form class="form-horizontal" action="{{url('admin/admin_general_info')}}" method="post" name="general_info" id="general_info">
                    @csrf
                   
                    	<div class="form-group row">
	                        <label for="inputName" class="col-sm-2 col-form-label">UserName</label>
	                        <div class="col-sm-10">
                          	@error('username')
                            	<div class="form-valid-error">{{ $message }}</div>
                          	@enderror
	                          <input type="text" class="form-control" id="username" name="username" placeholder="User Name" value="{{$data->username}}">
	                        </div>
	                    </div>	                    

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          @error('email')
                            <div class="form-valid-error">{{ $message }}</div>
                          @enderror
                          	<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$data->email}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                            @error('mobile')
                              <div class="form-valid-error">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{$data->mobile}}">
                        </div>
                      </div>

                    	<div class="form-group row">
                      	<div class="offset-sm-2 col-sm-10">
                        		<button type="submit" class="btn btn-danger">Submit</button>
                      	</div>
                    	</div>

                    </form>

                  <form class="form-horizontal" action="{{url('admin/admin_update_pass')}}" method="post" name="password_info" id="password_info">
                    @csrf

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                          @error('current_password')
                            <div class="form-valid-error">{{ $message }}</div>
                          @enderror
                          <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          @error('password')
                            <div class="form-valid-error">{{ $message }}</div>
                          @enderror
                          <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          @error('confirm_password')
                            <div class="form-valid-error">{{ $message }}</div>
                          @enderror
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>

                  </form>

                </div>

              

            </div>
            <!-- /.tab-content -->
          </div>
          <!------/. Tab Content-------->
        </div>        
      </div>      
    </div>
    
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->



<script type="text/javascript">
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
 

$('#adminimageUpload').change(function(e){
  e.preventDefault();
  $('#upload-image-form').submit();
});

$('#upload-image-form').submit(function(e) {
         e.preventDefault();
         //alert('fsf');

         let formData = new FormData(this);
         // Append data 
         //formData.append('file',files[0]);
         //formData.append('_token',CSRF_TOKEN);
         $.ajax({
            type:'POST',
            url: "{{route('uploadimage') }}",
            data: formData,
            //data : {},
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: (response) => {
               if (response) {
                 this.reset();
                 //alert('Image has been updated successfully');
                 toastr.success('Image has been updated successfully');
               }
             },
             error: function(response){
                console.log(response);
                  $('#image-input-error').text(response.responseJSON.errors.file);
             }
         });
});



</script>

@endsection