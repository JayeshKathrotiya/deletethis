<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from dreamguys.co.in/demo/ventura/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 04:31:44 GMT -->
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>OKTAT - The Admission App</title>
    
    <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon.png">

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    
    <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
    
    <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    
    <!--[if lt IE 9]>
      <script src="{{ asset('assets') }}/js/html5shiv.min.js"></script>
      <script src="{{ asset('assets') }}/js/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
  
    <!-- Main Wrapper -->
<div class="main-wrapper login-body">
    <div class="login-wrapper">
      <div class="container">
        <div class="loginbox">
          <div class="login-left">
            <img class="img-fluid" src="{{ asset('assets') }}/img/white-logo.png" alt="Logo">
          </div>
          <div class="login-right">
            <div class="login-right-wrap">
              <h1>Login</h1>
              <p class="account-subtitle">Access to our dashboard</p>
              
              <!-- Form -->
              <form class="form-signin" method="post" id="admin_login" name="admin_login" action="/login">
                @csrf
                <div class="form-group">
                  <input class="form-control" type="text" placeholder="Email" id="email" name="email" maxlength="50">
                </div>
                <div class="form-group">
                  <input class="form-control" type="password" placeholder="Password" id="password" name="password" maxlength="50">
                </div>
                <div class="form-group">
                  <button class="btn btn-primary btn-block" type="submit">Login</button>
                </div>
              </form>
              <!-- /Form -->
            </div>
          </div>
        </div>
      </div>
    </div>

        <div class="col-md-12">
          <div class="error-msg-box">
            @if(session('success-msg'))
              <div class="alert alert-success close-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('success-msg') }}
              </div>
            @endif

            @if(session('error-msg'))
            <div class="alert alert-danger close-alert" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session('error-msg') }}
              </div>
            @endif
          </div>
        </div>
</div>
    <!-- /Main Wrapper -->
    
    <!-- jQuery -->
        <script src="{{ asset('assets') }}/js/jquery-3.2.1.min.js"></script>

    <!-- JQuery Validation -->
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/jquery.validate.js"></script>
    <script src="{{ asset('assets') }}/library/jquery-validate/dist/additional-methods.min.js"></script>
    
    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets') }}/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets') }}/js/script.js"></script>
    
<script type="text/javascript">
$(document).ready(function(){

  $("#admin_login").validate
  ({
    rules:
    {
       email:
       {
            required:true,
            email:true       
       },
       password: 
       {
          required:true
       }
    },
    messages:
    {

    }
  });

  });

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 3000);
  </script>
</body>

<!-- Mirrored from dreamguys.co.in/demo/ventura/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Aug 2019 04:31:44 GMT -->
</html>