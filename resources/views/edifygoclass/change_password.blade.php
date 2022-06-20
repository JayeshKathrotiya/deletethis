@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="breadcrumb-title">Course Class</h2> -->
                    <div class="banner-inner">
                        <div class="cls-image">
                            @if($class->class_logo)
                                <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" alt="Image not available">
                            @else
                                <img src="{{ asset('edifygo_assets')}}/image/classes-logo.png" alt="Image not available">
                            @endif
                        </div>
                        <div class="cls-details">
                            <h3 class="text-break">{{$class->name}}</h3>
                            <p class="text-break">{{$class->address ? $class->address.",":""}}, {{$class->area_name}}, {{$class->city_name}}, {{$class->state_name}}, {{$class->country_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="registeration">
    <div class="container">
        <form action="/update_password" id="valid_password" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Change Password</h4>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="hdclass_id" id="hdclass_id" value="{{$class->id}}">
                                    <label>New Password</label> <span class="req-star text-danger"> *</span>
                                    <input type="password" name="new_passwd" id="new_passwd" class="form-control" placeholder="New Password" minlength="8" maxlength="10">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12  col-sm-12">
                                <div class="form-group">
                                    <label>Confirm New Password</label> <span class="req-star text-danger"> *</span>
                                    <input type="password" name="c_new_passwd" id="c_new_passwd" class="form-control" placeholder="Confirm New Password" minlength="8" maxlength="10">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center">
                                    <button class="btn btn-save" type="submit" id="btn_update">Update</button>
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
$('#valid_password').validate({
        rules:
        {
            new_passwd:
            {
                required:true,
                space:true,
                passwdspace:true,
                minlength:8,
                maxlength:10
            },
            c_new_passwd:
            {
                required:true,
                passwdspace:true,
                equalTo:'#new_passwd'
            },
        },
        messages:
        {

        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }
    });
});
</script>
@endsection