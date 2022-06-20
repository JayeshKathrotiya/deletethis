@extends('edifygoclass.layout')
@section('contents')

<section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</section>

<section class="registeration">
    <div class="container">
        <form action="/student/update_profile" id="valid_update_profile" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-112 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Fill Up Your Details</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <input type="hidden" name="hdstudent_id" id="hdstudent_id" value="{{$student->id}}">
                                    <label>First Name</label> <span class="req-star text-danger"> *</span>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" value="{{$student->firstname}}" maxlength="20">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Last Name</label> <span class="req-star text-danger"> *</span>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" value="{{$student->lastname}}" maxlength="20">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>School Name</label>
                                    <input type="text" name="schoolname" id="schoolname" class="form-control" placeholder="School Name" value="{{$student->schoolname}}" maxlength="200">
                                </div>
                            </div>
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Address</label> <span class="req-star text-danger"> *</span>
                                    <textarea name="address" rows="5" id="address" class="form-control resize" maxlength="200">{{$student->address}}</textarea>
                                </div>
                            </div> -->
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
    $('#valid_update_profile').validate({
        rules:
        {
            firstname:
            {
                required:true,
                validname:true,
                space:true,
                minlength:3,
                maxlength:20
            },
            lastname:
            {
                required:true,
                validname:true,
                space:true,
                minlength:3,
                maxlength:20
            },
            schoolname:
            {
                schoolspace:true,
                minlength:3,
                maxlength:200
            },
            /*address:
            {
                required:true,
                space:true,
                minlength:3,
                maxlength:200
            }*/
        },
        messages:
        {
          firstname:
          {
            validname:'Invalid firstname.'
          },
          lastname:
          {
            validname:'Invalid lastname.'
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
});
</script>
@endsection