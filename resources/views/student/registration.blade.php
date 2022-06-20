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
            <form action="/student/add_registration" method="POST" id="valid_reg" name="valid_reg">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-sm-12">
                    <div class="reg-form-box">
                        <h4 class="text-center">Fill Up Your Details</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="country_id" name="country_id" onchange="fetch_state(this)">
                                        <option value="">Select</option>
                                        @if(!empty($country))
                                          @foreach ($country as $value)
                                            <option id="country_{{ $value->id }}" value="{{ $value->id }}">{{ $value->country_name }}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="state_id" name="state_id" onchange="fetch_city(this)">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="city_id" name="city_id" onchange="fetch_area(this)">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Area</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="area_id" name="area_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name*" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name*" maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label> <span class="req-star text-danger"> *</span>
                                    <textarea name="address" rows="2" id="address" class="form-control resize" maxlength="200"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address*" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No*" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password*" minlength="8" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password*" minlength="8" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="schoolname" id="schoolname" class="form-control" placeholder="School Name" maxlength="200">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>How Did You Know About Us?</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="know_us" name="know_us">
                                        <option value="">Select</option>
                                        @if(!empty($know_us))
                                          @foreach ($know_us as $value)
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group ml-4">
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="stud_terms" name="stud_terms" value="1">
                                        <label for="stud_terms">I Accept Oktat <a target="_blank" href="/student-terms">Terms and Conditions</a> , By clicking Submit, you indicate that you have read and agree to the Terms of use.</label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group">
                                      <input type="checkbox" id="stud_terms" name="stud_terms" value="1">
                                      I Accept Oktat <a  class="text-blue" href="javascript:openStudTermsMdl()">Terms and Conditions</a> , By clicking Submit, you indicate that you have read and agree to the Terms of use and <a  class="text-blue" href="javascript:openPolicyMdl()">Privacy Policy</a> and <a  class="text-blue" href="javascript:openStudRefundMdl()">Refund Policy</a>
                                   <!-- and <a target="_blank" href="https://spree.com.mx/Spree/privacy">Privacy Policy.</a> -->
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

$('#country_1').attr('selected', 'selected');
fetch_state(1);

fetch_city(1);

$('#valid_reg').validate({
        rules:
        {
            country_id:
            {
                required:true
            },
            state_id:
            {
                required:true
            },
            city_id:
            {
                required:true
            },
            area_id:
            {
                required:true
            },
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
            address:
            {
                required:true,
                space:true,
                minlength:3,
                maxlength:200
            },
            email:
            {
                required:true,
                remote:{
                   url:"{{route('stud.checkAddEmailExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     email: function(){ return $("#email").val(); }
                   }
                },
                email:true,
                space:true,
                minlength:3,
                maxlength:50
            },
            mobile:
            {
                required:true,
                remote:{
                   url:"{{route('stud.checkAddMobileExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     mobile: function(){ return $("#mobile").val(); }
                   }
                },
                number:true,
                minlength:10,
                maxlength:10
            },
            password:
            {
                required:true,
                space:true,
                passwdspace:true,
                minlength:8,
                maxlength:10
            },
            confirm_password:
            {
                required:true,
                passwdspace:true,
                equalTo:'#password'
            },
            schoolname:
            {
                schoolspace:true,
                minlength:3,
                maxlength:200
            },
            know_us:
            {
                required:true
            },
            stud_terms:
            {
              required:true
            }
        },
        messages:
        {
          email:
          {
            remote:"Email already exists."
          },
          firstname:
          {
            validname:'Invalid firstname.'
          },
          lastname:
          {
            validname:'Invalid lastname.'
          },
          mobile:
          {
            remote:"Mobile already exists."
          },
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled', 'disabled');
        }

    });
});

function fetch_state(id)
{
  var id = id.value ? id.value : id;
  $('#state_id').html('');
  $('<option/>').val('').html('Select').appendTo('#state_id');
  if(id != "") {
    $.ajax({
          url:'{{route('class.fetch_state')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['state_name']).attr('id','state_'+data[i]['id']).appendTo('#state_id');    
                }
            }

            if (typeof(id) =='number')
            {
              $('#state_1').attr('selected', 'selected');
            }
          }
        });
  }
}

function fetch_city(data)
{
  var id = data.value ? data.value : data;
  $('#city_id').html('');
  $('<option/>').val('').html('Select').appendTo('#city_id');
  if(id != "") {
    $.ajax({
          url:'{{route('class.fetch_city')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            console.log(data);
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['city_name']).appendTo('#city_id');    
                }
            }
          }
        });
  }
}

function fetch_area(data)
{
  var id = data.value;
  $('#area_id').html('');
  $('<option/>').val('').html('Select').appendTo('#area_id');
  if(id != "") {
    $.ajax({
          url:'{{route('class.fetch_area')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['area_name']).appendTo('#area_id');    
                }
            }
          }
        });
  }
}
</script>
@endsection