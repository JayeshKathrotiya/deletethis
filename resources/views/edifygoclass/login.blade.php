@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="breadcrumb-title">Join Us</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="registeration">
        <div class="container">
            <form action="/class/check_login" method="POST" id="valid_login_class" name="valid_login_class">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Login</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email or Mobile</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Email Or Mobile*" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                              <a href="/forgot" class="text-blue">Forgot Password</a></label>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New to OKTAT ? <a href="/class/registration" class="text-blue">
                                    Sign Up</a></label>
                                </div>
                              </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <!-- <button class="btn btn-submit">Submit</button> -->
                                    <input class="btn btn-submit" type="submit" name="btn_submit" id="btn_submit" value="Login">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

<script type="text/javascript">


 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){

$('#valid_login_class').validate({
      rules:
      {
          username:
          {
              required:true,
              space:true,
              minlength:1,
              maxlength:50,
          },
          password:
          {
              required:true,
              space:true,
              minlength:8,
              maxlength:10
          }
      },
      messages:
      {
        
      },
      submitHandler: function(form) {
        form.submit();
        $('#btn_submit').attr('disabled', 'disabled');
      }

    });
});

</script>
@endsection