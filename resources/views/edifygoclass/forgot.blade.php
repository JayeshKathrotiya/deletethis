@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="breadcrumb-title">Forgot Password</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="registeration">
        <div class="container">
            <form action="/forgotlink" method="POST" id="forgot_frm" name="forgot_frm">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Forgot Password</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="hidden" name="user_type" id="user_type" value="0">
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email*" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <!-- <button class="btn btn-submit">Submit</button> -->
                                    <input class="btn btn-submit" type="submit" name="btn_submit" id="btn_submit" value="Submit">
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

$('#forgot_frm').validate({
      rules:
      {
          email:
          {
              required:true,
              email:true,
              space:true,
              minlength:1,
              maxlength:50
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