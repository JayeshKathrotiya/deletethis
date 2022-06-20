@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="breadcrumb-title">Course Class</h2> -->
                    <div class="banner-inner">
                        <div class="cls-image">
                            <img src="{{asset('edifygo_assets')}}/image/user-image.png">
                        </div>
                        <div class="cls-details">
                            <h3>{{$class->name}}</h3>
                            <p>{{$class->address}} {{$class->area_name}} {{$class->city_name}} {{$class->state_name}} {{$class->country_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="registeration">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-112 col-sm-12">
                    <div class="reg-form-box">
                        <!-- <div class="form-header"> -->
                            <h4 class="text-center">Fill Up Your Details</h4>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Select Main Course</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="maincourse_id" name="maincourse_id" onchange="getSubcourse(this)">
                                        <option value="">Select</option>
                                        @if(!empty($main_courses))
                                          @foreach ($main_courses as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                          @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Select Sub Course</label> <span class="req-star text-danger"> *</span>
                                    <select class="form-control" id="subcourse_id" name="subcourse_id" onchange="getchildcourse(this)">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Select Sub Child Course</label>
                                    <select class="form-control" id="childcourse_id" name="childcourse_id">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Select Batch Type</label>
                                    <br>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label for="inlineCheckbox1"> Regular </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox2" value="option1" checked="">
                                        <label for="inlineCheckbox2"> Trial </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox3" value="option1">
                                        <label for="inlineCheckbox3"> NA </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Batch For</label>
                                    <br>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox4" value="option1">
                                        <label for="inlineCheckbox4"> Female </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox5" value="option1">
                                        <label for="inlineCheckbox5"> Male </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox19" value="option1">
                                        <label for="inlineCheckbox19"> NA </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control resize textarea100" placeholder="Description about the course"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Material Provided</label>
                                    <br>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox6" value="option1">
                                        <label for="inlineCheckbox6"> Yes </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox7" value="option1" checked="">
                                        <label for="inlineCheckbox7"> No </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox8" value="option1">
                                        <label for="inlineCheckbox8"> NA </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Certification Provided</label>
                                    <br>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox9" value="option1">
                                        <label for="inlineCheckbox9"> Yes </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox10" value="option1" checked="">
                                        <label for="inlineCheckbox10"> No </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox11" value="option1">
                                        <label for="inlineCheckbox11"> NA </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row datetime-grid">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" placeholder="End Date">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label>Start Timing</label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label>End Timing</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Start Timing">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="End Timing">
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-12">
                                            <button class="btn btn-add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Start Timing">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="End Timing">
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-12">
                                            <button class="btn btn-remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="datetime-grid-button">
                                <button class="btn btn-add">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row datetime-grid">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" placeholder="Start Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" placeholder="End Date">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label>Start Timing</label>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label>End Timing</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Start Timing">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="End Timing">
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-12">
                                            <button class="btn btn-add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Start Timing">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="End Timing">
                                        </div>
                                        <div class="col-lg-2 col-md-6 col-sm-12">
                                            <button class="btn btn-remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="datetime-grid-button">
                                <button class="btn btn-remove">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Seat Available</label>
                                    <br>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox12" value="option1">
                                        <label for="inlineCheckbox12"> Yes </label>
                                    </div>
                                    <div class="checkbox checkbox-primary checkbox-inline">
                                        <input type="checkbox" id="inlineCheckbox13" value="option1" checked="">
                                        <label for="inlineCheckbox13"> No </label>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group position-relative calc-dash">
                                    <label>Price</label>
                                    <input type="text" class="form-control" placeholder="Net Price">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group text-center position-relative calc-dash">
                                    <label>Owner Service Charges</label>
                                    <br>                                    
                                    <label class="mt-10">Calculated Price</label>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Client Discount (Optional)</label>
                                    <input type="text" class="form-control" placeholder="Final Price">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="form-group position-relative calc-equal">
                                    <label>Final Price</label>
                                    <br>
                                    <label class="mt-10">Calculated Price</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Admission Fees Selection</label>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <select class="form-control">
                                                <option>Select</option>
                                                <option>Option 1</option>
                                                <option>Option 2</option>
                                                <option>Option 3</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-9 col-md-6 col-sm-12">
                                            <div class="checkbox checkbox-primary checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox14" value="option1">
                                                <label for="inlineCheckbox14"> 25% </label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox15" value="option1" checked="">
                                                <label for="inlineCheckbox15"> 35% </label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox16" value="option1" checked="">
                                                <label for="inlineCheckbox16"> 50% </label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox17" value="option1" checked="">
                                                <label for="inlineCheckbox17"> 65% </label>
                                            </div>
                                            <div class="checkbox checkbox-primary checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox18" value="option1" checked="">
                                                <label for="inlineCheckbox18"> 100% </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="notes">Select either fixed money structure of percentage</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label>Upload Files</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 col-sm-12">
                                            <button class="btn btn-file">
                                                Browse
                                                <input type="file">
                                            </button>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <button class="btn btn-add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-4 col-sm-12">
                                            <button class="btn btn-file">
                                                Browse
                                                <input type="file">
                                            </button>
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <button class="btn btn-remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="notes">Only PDF Files, Max 5 Files</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label>Upload Youtube Videos</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter URL">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <button class="btn btn-add">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter URL">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Title">
                                        </div>
                                        <div class="col-lg-3 col-md-6 col-sm-12">
                                            <button class="btn btn-remove">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="notes">Max 5 URls</p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Course Image Selection</label>
                                    <br>
                                    <button class="btn btn-file">
                                        Browse
                                        <input type="file">
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button class="btn btn-submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">


 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){

$('#valid_reg').validate({
        rules:
        {
            name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:50,
                remote:{
                   url:"{{route('cl.checkAddClassExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#name").val(); }
                   }
                 }
            },
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
                space:true,
                minlength:3,
                maxlength:20
            },
            lastname:
            {
                required:true,
                space:true,
                minlength:3,
                maxlength:20
            },
            email:
            {
                required:true,
                remote:{
                   url:"{{route('cl.checkAddEmailExists')}}",
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
                   url:"{{route('cl.checkAddMobileExists')}}",
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
                minlength:6,
                maxlength:10
            },
            confirm_password:
            {
                required:true,
                equalTo:'#password'
            },
            know_us:
            {
                required:true
            }
        },
        messages:
        {
          name:
          {
            remote:"Class name already exists."
          },
          email:
          {
            remote:"Email already exists."
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

function getSubcourse(data)
{
  var id = data.value;
  $('#subcourse_id').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse_id');
  if(id != "") {
    $.ajax({
          url:'{{route('class.getSubcourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['state_name']).appendTo('#subcourse_id');    
                }
            }
          }
        });
  }
}

function fetch_city(data)
{
  var id = data.value;
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