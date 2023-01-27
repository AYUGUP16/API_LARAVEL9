<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/admin-assets/css/style.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
    <a><b>Administrator</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card card-outline card-primary"> 
    <div class="card-body">
      <p class="login-box-msg">Sign in</p>

	    <form action="{{url('/admin/user_login')}}" method="post">
	      	@csrf

	      	
	        <div class="input-group mb-3">
	          <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-envelope"></span>
	            </div>
	          </div>	        
		        @error('email')
		      		<div class="form-valid-error">{{ $message }}</div>
		      	@enderror
		      </div>
	        
	        <div class="input-group mb-3">
	          <input type="password" class="form-control" placeholder="Password" name="password" >
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-lock"></span>
	            </div>
	          </div>	        
		        @error('password')
		      		<div class="form-valid-error">{{ $message }}</div>
		      	@enderror
		      </div>
	        <div class="row">
	          <!-- <div class="col-8">
	            <div class="icheck-primary">
	              <input type="checkbox" id="remember">
	              <label for="remember">
	                Remember Me
	              </label>
	            </div>
	          </div> -->
	          <!-- /.col -->
	          <div class="col-4">
	            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
	          </div>
	          <div class="col-8">
            	<p class="text-right mt-1">
              	<a href="{{url('admin/forgot-password')}}">Forgot Password ?</a>
            	</p>
          	</div>
	          <!-- /.col -->
	        </div>
	    </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="{{url('admin/forgot-password')}}">forgot password</a>
      </p> -->

      <!-- <p class="mb-0">
        <a href="{{route('signup')}}" class="text-center">Register</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>

</body>
</html>
