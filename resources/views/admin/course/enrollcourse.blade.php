@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">List All Enroll Course</h5>
          </div>

          <div class="card-body">
            <form id="filer_frm" method="POST" action="/filter_enroll">
            @csrf
             <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <select class="form-control" id="city" name="city" onchange="javascript:getFilterArea(0,0,0)">
                      <option value="">Select City</option>
                      @if(!empty($city))
                        @foreach ($city as $value)
                          <option value="{{ $value->id }}" {{ session('admin_city_session')==$value->id ? 'selected=selected':''}}>{{ $value->city_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <select class="form-control" id="area" name="area">
                      <option value="">Select Area</option>
                      @if(!empty($area))
                        @foreach ($area as $value)
                          <option value="{{ $value->id }}" {{ session('admin_area_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }}</option>
                          <!-- <option value="{{ $value->id }}" {{ session('admin_area_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }},{{ $value->city_name }}</option> -->
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                  <select class="form-control" id="maincourse_id" name="maincourse_id" onchange="javascript:getFilterSubcourse(0,0,0)">
                    <option value="">Select Main Course</option>
                    @if(!empty($course))
                        @foreach ($course as $value)
                          <option value="{{ $value->id }}" {{ session('admin_maincourse_session')==$value->id ? 'selected=selected':''}}>{{ $value->name }}</option>
                        @endforeach
                      @endif
                  </select>
                </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group hidden" id="sub_course_dv">
                  <select class="form-control" id="subcourse_id" name="subcourse_id" onchange="javascript:getFilterchildcourse(0,0,0)">
                    <option value="">Select Sub Course</option>
                  </select>
                </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group hidden" id="child_course_dv">
                  <select class="form-control" id="childcourse_id" name="childcourse_id">
                    <option value="">Select Child Course</option>
                  </select>
                </div>
                </div>

                <div class="col-md-1">
                  <div class="form-group">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Filter" class="btn btn-info">  
                  </div>
                </div>
            </div>
            </form>
            <div class="table-responsive">
              <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                  <thead>
                      <tr>
                              <th>#</th>
                              <th data-toggle="tooltip" data-placement="top" title="Student Name">SN</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Country</th>
                              <th>State</th>
                              <th>City</th>
                              <th>Area</th>
                              <th data-toggle="tooltip" data-placement="top" title="Class Name">CN</th>
                              <th data-toggle="tooltip" data-placement="top" title="Main Course">MC</th>
                              <th data-toggle="tooltip" data-placement="top" title="Sub Course">SC</th>
                              <th data-toggle="tooltip" data-placement="top" title="Child Course">CC</th>
                              <th data-toggle="tooltip" data-placement="top" title="Start Date">SD</th>
                              <th data-toggle="tooltip" data-placement="top" title="End Date">ED</th>
                              <th data-toggle="tooltip" data-placement="top" title="Start Time">ST</th>
                              <th data-toggle="tooltip" data-placement="top" title="End Time">ETime</th>
                              <th data-toggle="tooltip" data-placement="top" title="Enroll Type">EType</th>
                              <th>Price</th>
                              <th data-toggle="tooltip" data-placement="top" title="Owner Charge(%)">OC(%)</th>
                              <th data-toggle="tooltip" data-placement="top" title="Owner Charge">OC</th>
                              <th data-toggle="tooltip" data-placement="top" title="Client Discount(%)">CD(%)</th>
                              <th data-toggle="tooltip" data-placement="top" title="Client Discount">CD</th>
                              <th data-toggle="tooltip" data-placement="top" title="Admission Fees">AF</th>
                              <th>Enroll</th>
                              <th data-toggle="tooltip" data-placement="top" title="Final Owner Charge">FOC</th>
                              <th data-toggle="tooltip" data-placement="top" title="Paid To Class">PTC</th>
                          </tr>
                      </thead>
                    <tbody>
                      @if(!empty($enrolls)) 
                        @foreach ($enrolls as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="text-break width250">{{ $value->firstname }} {{ $value->lastname }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->mobile }}</td>
                        <td>{{ $value->country_name }}</td>
                        <td>{{ $value->state_name }}</td>
                        <td>{{ $value->city_name }}</td>
                        <td>{{ $value->area_name }}</td>
                        <td class="width170">{{ $value->class_name }}</td>
                        <td>{{ $value->main_course_name }}</td>
                        <td class="width170">{{ $value->sub_course_name }}</td>
                        <td>{{ $value->child_course_name ? $value->child_course_name : "N/A" }}</td>
                        <td class="width100">{{ $value->start_date }}</td>
                        <td class="width100">{{ $value->end_date }}</td>
                        <td class="width100">{{ $value->start_time }}</td>
                        <td class="width100">{{ $value->end_time }}</td>
                        <td>{{ $value->istrial==0 ? "Regular" : "Trial" }}</td>
                        <td>{{ $value->istrial==0 ? "₹".$value->price : "N/A" }}</td>
                        <td>{{ $value->istrial==0 ? $value->owner_service_charge_owner_discount_per : "N/A" }}</td>
                        <td>{{ $value->istrial==0 ? "₹".$value->owner_service_charge_owner_discount_value : "N/A" }}</td>
                        <td>{{ $value->istrial==0 ? $value->student_original_discount_per : "N/A" }}</td>
                        <td>{{ $value->istrial==0 ? "₹".$value->student_original_discount_value : "N/A" }}</td>
                        <td>{{ $value->istrial==0 ? "₹".$value->final_price : "N/A" }}</td>
                        <td>{{ "₹".$value->enroll_amount }}</td>
                        <td>{{ $value->istrial==0 ? "₹".$value->final_owner_charge : "N/A" }}</td>
                        <td>
                              @if($value->istrial==0)
                                {{"₹".($value->enroll_amount - $value->final_owner_charge)}}
                              @else
                                {{"N/A"}}
                              @endif
                            
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

  <!-- Edit Class Model -->
<div class="modal fade" id="editclass_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_cityel">Edit Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="/update_Adminclass" method="POST" id="editclass_valid" name="editclass_valid">
     @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <input type="hidden" name="hdclass_id" id="hdclass_id">
              <label>Mobile</label> <span class="req-star text-danger"> *</span>
              <input type="text" name="editmobile" id="editmobile" class="form-control" placeholder="Mobile No*" maxlength="10">
            </div>
          </div>        
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label> <span class="req-star text-danger"> *</span>
              <input type="email" name="editemail" id="editemail" class="form-control" placeholder="Email Address*" maxlength="50">
            </div>
          </div>        
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn_update" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
$('#editclass_valid').validate({
        rules:
        {
            editmobile:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditMobileExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     mobile: function(){ return $("#editmobile").val(); }
                   }
                },
                number:true,
                minlength:10,
                maxlength:10
            },
            editemail:
            {
                required:true,
                remote:{
                   url:"{{route('admin.checkEditEmailExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     class_id: function(){ return $("#hdclass_id").val(); },
                     email: function(){ return $("#editemail").val(); }
                   }
                },
                email:true,
                space:true,
                minlength:3,
                maxlength:50
            }
        },
        messages:
        {
          editmobile:
          {
            remote:"Mobile already exists."
          },
          editemail:
          {
            remote:"Email already exists."
          }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_update').attr('disabled', 'disabled');
        }

    });
  });

function isApproveClass(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isApproveClass')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function isSubscribe(id)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isSubscribe')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function isPopular(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('admin.isPopular')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        location.reload();
      }
    });
  }
}

function deleteClass(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this class?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admin.deleteClass')}}',
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
}

function editClass(id) 
{
  $('#editmobile-error').html('');
  $('#editemail-error').html('');
  if (id) {
  $('#hdclass_id').val(id);
    $.ajax({
          url:'{{route('admin.getEditClass')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              $('#editclass_model').modal('show');
              $('#editmobile').val(data.mobile);
              $('#editemail').val(data.email);
            }
          }
        });
  }
}

$(window).bind("load", function() {

    $('#sub_course_dv').addClass('hidden');
    $('#child_course_dv').addClass('hidden');

    var maincourse_session ='{{ session('admin_maincourse_session')}}';
    var subcourse_session ='{{ session('admin_subcourse_session')}}';
    var childcourse_session ='{{ session('admin_childcourse_session')}}';

    //locations
    var city_session ='{{ session('admin_city_session')}}';
    var area_session ='{{ session('admin_area_session')}}';

    if (maincourse_session)
    {
        getFilterSubcourse(maincourse_session,subcourse_session,1)
    }

    if (subcourse_session)
    {
        getFilterchildcourse(subcourse_session,childcourse_session,1)
    }

    //locations
    if (city_session)
    {
        getFilterArea(city_session,area_session,1)
    }
});

function getFilterSubcourse(id,sub_id,type)
{
  if (type==0)
  {
    id = $('#maincourse_id').val();

  }

  $('#sub_course_dv').addClass('hidden');
  $('#child_course_dv').addClass('hidden');

  $('#subcourse_id').html('');
  $('<option/>').val('').html('Select Sub Course').appendTo('#subcourse_id');

  $('#childcourse_id').html('');
  $('<option/>').val('').html('Select Child Course').appendTo('#childcourse_id');

  if(id != "") {
    $.ajax({
          url:'{{route('admin.getFilterSubcourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
                $('#sub_course_dv').removeClass('hidden');
                //for mobile
                $('#sub_course_dv1').removeClass('hidden');
              var len=data.length;
              for (var i =0; i<len; i++) {
                    if (sub_id==data[i]['id'])
                    {
                        $('<option/>').val(data[i]['id']).html(data[i]['name']).attr('selected',true).appendTo('#subcourse_id');    
                        //for mobile
                        $('<option/>').val(data[i]['id']).html(data[i]['name']).attr('selected',true).appendTo('#subcourse_id1');    
                    }else
                    {
                        $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#subcourse_id');
                        //for mobile    
                        $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#subcourse_id1');    
                    }
              }
            }
          }
        });
  }
}


function getFilterArea(id,area_id,type)
{
  if (type==0)
  {
    id = $('#city').val();

  }

  $('#area').html('');
  $('<option/>').val('').html('Select Area').appendTo('#area');

  if(id != "") {
    $.ajax({
          url:'{{route('admin.getFilterArea')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            // console.log(data);
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                    if (area_id==data[i]['id'])
                    {
                        $('<option/>').val(data[i]['id']).html(data[i]['area_name']).attr('selected',true).appendTo('#area');     
                    }else
                    {
                        $('<option/>').val(data[i]['id']).html(data[i]['area_name']).appendTo('#area'); 
                    }
              }
            }
          }
        });
  }
}

function getFilterchildcourse(id,child,type)
{
  if (type==0)
  {
    id = $('#subcourse_id').val();

  }
  $('#childcourse_id').html('');
  $('<option/>').val('').html('Select Child Course').appendTo('#childcourse_id');
  if(id != "") {
    $.ajax({
          url:'{{route('admin.getchildCourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
                if ($('#maincourse_id').val()!="")
                {
                    $('#child_course_dv').removeClass('hidden'); 
                }
              var len=data.length;
              for (var i =0; i<len; i++) {
                    if (child==data[i]['id'])
                    {
                      $('<option/>').val(data[i]['id']).html(data[i]['name']).attr('selected',true).appendTo('#childcourse_id');
                      //for mobile    
                      $('<option/>').val(data[i]['id']).html(data[i]['name']).attr('selected',true).appendTo('#childcourse_id1');    
                    }else
                    {
                      $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#childcourse_id');  
                      //for mobile  
                      $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#childcourse_id1');    
                    }
              }
            }
          }
        });
  }
}
</script>
@endsection