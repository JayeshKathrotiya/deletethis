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
                            <p class="text-break">{{$class->address ? $class->address."," : ""}} {{$class->area_name}}, {{$class->city_name}}, {{$class->state_name}}, {{$class->country_name}}</p>
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
                            <button type="button" class="btn btn-submit float-right" id="btn_addcat" name="btn_addcat" value="Add Advertise" data-toggle="modal" data-target="#addvertise" onclick="setNull()"><i class="fa fa-plus mr-2"> </i> Add Advertise</button>
                            <h4 class="text-center">Advertise List</h4>

                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Slider</th>
                                      <th>Main Course</th>
                                      <th>Sub Course</th>
                                      <th>Child Course</th>
                                      <!-- <th>Class Name</th> -->
                                      <!-- <th>Mobile</th> -->
                                      <th>Status</th>
                                      <th>Date</th>
                                      <th class="action-group no-sort">Action</th>
                                  </tr>
                                  </thead>
                                <tbody>
                                  @if(!empty($add)) 
                                    @foreach ($add as $key => $value)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->slider_name ? $value->slider_name : "-"}}</td>
                                    <td>{{$value->main_course_name ? $value->main_course_name : "N/A"}}</td>
                                    <td>{{$value->sub_course_name ? $value->sub_course_name : "N/A"}}</td>
                                    <td>{{$value->child_course_name ? $value->child_course_name : "N/A"}}</td>
                                    <!-- <td>{{$value->class_name ? $value->class_name : "-"}}</td> -->
                                    <!-- <td>{{$value->mobile ? $value->mobile : "-"}}</td> -->
                                    <td>
                                      @if($value->isapprove==0)
                                        <span class="badge badge-warning">Requested</span>
                                      @elseif($value->isapprove==1)
                                        <span class="badge badge-primary">Approved</span>
                                      @elseif($value->isapprove==2)
                                        <span class="badge badge-danger">Declined</span>
                                      @endif
                                    </td>
                                    <td>{{$value->date ? date('d-m-Y g:i A',strtotime($value->date)) : "-"}}</td>
                                    <td> 
                                          <a href="javascript:deleteRequest({{$value->id}})" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                  </tr>
                                    @endforeach
                                  @endif
                              </tbody>
                            </table>
                        </div>
                      </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>

<!-- model -->
<div class="modal fade" id="addvertise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cat_countryel">Add Advertise</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/add/addadvertise" method="POST" id="advertise" name="advertise">
             @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 col-md-6 col-sm-12">
                      <div class="form-group">
                        <input type="hidden" name="class_id" id="class_id" value="{{$class->id}}">
                        <input type="hidden" name="city_id" id="city_id" value="{{$class->city_id}}">  
                          <label>Select Slider</label> <span class="req-star text-danger"> *</span>
                          <select class="form-control" id="slider" name="slider" onchange="getSliterSlot(this)">
                              <option value="">Select</option>
                              <option value="1">Exclusive</option>
                              <option value="3">Feature</option>
                              <option value="2">Promoter</option>
                              <option value="4">Newly Arrived</option>
                              <option value="5">Sponsored</option>
                              <option value="6">Popular</option>
                          </select>
                      </div>
                  </div> 
              <div class="col-md-12 hidden advertise_sponser_group">
                <div class="form-group">
                  <label>Select Main Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="maincourse" id="maincourse" class="form-control" onchange="fetch_sub_course(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div>    
              <div class="col-md-12 hidden advertise_sponser_group">
                <div class="form-group">
                  <label>Select Sub Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="subcourse" id="subcourse" class="form-control" onchange="fetch_child_course(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div> 
              <div class="col-md-12 hidden advertise_sponser_group" id="child">
                <div class="form-group">
                  <label>Select Child Course Name</label> <span class="req-star text-danger"> *</span>
                  <select name="childcourse" id="childcourse" class="form-control" onchange="fetch_course_id(this)">
                    <option value="">Selct</option>
                  </select>
                </div>
              </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" id="btn_submit" class="btn btn-submit">Submit</button>
            <button type="button" class="btn btn-save" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
</div>

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(document).ready(function(){
  $('#advertise').validate({
    rules:
    {
      slider:
      {
        required:true
      },
      maincourse:
      {
        required:true
      },
      subcourse:
      {
        required:true
      },
      childcourse:
      {
        required:true
      }
    },
    messages:
    {

    },
    submitHandler:function(form)
    {
      form.submit();
      $('#btn_submit').attr('disabled','true');
    }
  });
});

function getSliterSlot(slider)
{
  $('.advertise_sponser_group').addClass('hidden');
  var slider_id = slider.value;
  var city_id = $('#city_id').val();
  if (slider_id==5)
  {
    $('.advertise_sponser_group').removeClass('hidden');
    fetch_main_course();
  }
}

function deleteRequest(id)
{
  $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this Slider Advertise?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('add.deleteRequest')}}',
              method:'POST',
              dataType:'JSON',
              data:{id:id},
              success:function(data)
              {
                window.location.reload();
              }
            });
        },
        Cancel:function(){

        }
      }
    });
}

function setNull()
{
  $('.advertise_sponser_group').addClass('hidden');
  $('#slider-error').html('');
  $('#maincourse-error').html('');
  $('#subcourse-error').html('');
  $('#childcourse-error').html('');
    $.each($("#slider option:selected"), function () {
          $(this).prop('selected', false);
    });
}


function fetch_main_course()
{
  $('#child').addClass('hidden');
  $('#maincourse').html('');
  $('<option/>').val('').html('Select').appendTo('#maincourse');
  $('#subcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse');
  $('#clss_course_id').val('');

    $.ajax({
      url:'{{ route('add.getMainCourse')}}',
      dataType:'JSON',
      method:'post',
      success:function(data)
      {
        if(data != false) {
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['maincourse_id']).html(data[i]['main_course_name']).appendTo('#maincourse');
            }
          }
        }
      }
    }); 
}

function fetch_sub_course(argument)
{
  $('#child').addClass('hidden');
  $('#subcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse');
  $('#childcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse');
  $('#clss_course_id').val('');
  if(argument.value != "") {
    var main_course_id = argument.value;
    $.ajax({
      url:'{{ route('add.getSubCourse')}}',
      dataType:'JSON',
      method:'post',
      data:{main_course_id:main_course_id},
      success:function(data)
      {
        // console.log(data);
        if(data != false) {
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['subcourse_id']).html(data[i]['sub_course_name']).appendTo('#subcourse');
            }
          }
        }
      }
    }); 
  }
}

function fetch_child_course(argument)
{
  $('#child').addClass('hidden');
  $('#childcourse').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse');
  $('#clss_course_id').val('');
  if(argument.value != "") {
    var main_course_id = $('#maincourse').val();
    var sub_course_id = argument.value;
    $.ajax({
      url:'{{ route('add.getChildCourse')}}',
      dataType:'JSON',
      method:'post',
      data:{main_course_id:main_course_id,sub_course_id:sub_course_id},
      success:function(data)
      {
        if(typeof(data) == 'object') {          
          $('#child').removeClass('hidden');
          var length = data.length;
          if(length > 0) {
            for (var i = 0; i < length; i++) {
              $('<option/>').val(data[i]['childcourse_id']).html(data[i]['child_course_name']).appendTo('#childcourse');
            }
          }
        }else {
          $('#clss_course_id').val(data);
          $('#child').addClass('hidden');
        }
      }
    }); 
  }
}

function fetch_course_id(argument) {
  if(argument.value != "") {
    var class_id = $('#name').val();
    var main_course_id = $('#maincourse').val();
    var sub_course_id = $('#subcourse').val();
    var child_course_id = argument.value;

    $.ajax({
      url:'{{ route('sponsored_slider.fetch_course_id')}}',
      dataType:'JSON',
      method:'post',
      data:{class_id:class_id,main_course_id:main_course_id,sub_course_id:sub_course_id,child_course_id:child_course_id},
      success:function(data)
      {
        if(data != false) {
          $('#clss_course_id').val(data);
        }
      }
    }); 

  }
}
</script>
@endsection