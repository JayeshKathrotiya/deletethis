@extends('admin.layout')
@section('content')      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title mb-0">List All Course</h5>
            <?php
            /*echo "<pre>";
            print_r($course);*/
            ?>
          </div>
          <div class="card-body">
            <form id="filer_frm" method="POST" action="/filter_courselist">
            @csrf
             <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <select class="form-control" id="city" name="city" onchange="javascript:getFilterArea(0,0,0)">
                      <option value="">Select City</option>
                      @if(!empty($city))
                        @foreach ($city as $value)
                          <option value="{{ $value->id }}" {{ session('admin_city_courselist_session')==$value->id ? 'selected=selected':''}}>{{ $value->city_name }}</option>
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
                          <option value="{{ $value->id }}" {{ session('admin_area_courselist_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }}</option>
                          <!-- <option value="{{ $value->id }}" {{ session('admin_area_courselist_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }},{{ $value->city_name }}</option> -->
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
                          <option value="{{ $value->id }}" {{ session('admin_maincourse_courselist_session')==$value->id ? 'selected=selected':''}}>{{ $value->name }}</option>
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
                          <th>Class Name</th>
                          <th>Country</th>
                          <th>State</th>
                          <th>City</th>
                          <th>Area</th>
                          <th data-toggle="tooltip" data-placement="top" title="Main Course">MC</th>
                          <th data-toggle="tooltip" data-placement="top" title="Sub Course">SC</th>
                          <th data-toggle="tooltip" data-placement="top" title="Child Course">CC</th>
                          <th>Price</th>
                          <th data-toggle="tooltip" data-placement="top" title="Enroll Amount">EA</th>
                          <th data-toggle="tooltip" data-placement="top" title="Total Student Discount">TSD</th>
                          <th data-toggle="tooltip" data-placement="top" title="Final Price">FP</th>
                          <th class="action-group no-sort">Action</th>
                      </tr>
                      </thead>
                    <tbody>
                      @if(!empty($class_course)) 
                        @foreach ($class_course as $key => $value)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td class="width170">{{ $value->class_name }}</td>
                        <td>{{ $value->country_name }}</td>
                        <td>{{ $value->state_name }}</td>
                        <td>{{ $value->city_name }}</td>
                        <td class="width250">{{ $value->area_name }}</td>
                        <td class="width170">{{ $value->maincourse_name }}</td>
                        <td class="width170">{{ $value->subcourse_name }}</td>
                        <td class="width170">{{ $value->chieldcourse_name ? $value->chieldcourse_name : "N/A" }}</td>
                        <td>₹{{ $value->price }}</td>
                        <td>
                          @if($value->isExclusive==0)
                              ₹{{$value->admission_fees_selection_value_final}}
                          @else
                              ₹{{$value->ex_admission_fees_selection_value_final}}
                          @endif
                        </td>
                        <td>{{ $value->student_original_discount_per }}%</td>
                        <td>₹{{ $value->student_addmission_fees }}</td>
                        <td class="nowrap">  
                          @if($value->isapprove==0)
                            <a href="javascript:isApprovecourse({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve"><i class="fa fa-check"></i></a>
                            <a href="javascript:isApprovecourse({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline"><i class="fa fa-times"></i></a>
                          @elseif($value->isapprove==1)
                            <a href="javascript:isApprovecourse({{ $value->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline"><i class="fa fa-times"></i></a>
                          @elseif($value->isapprove==2)
                            <a href="javascript:isApprovecourse({{ $value->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve"><i class="fa fa-check"></i></a>
                          @endif
                            <a onclick="window.location.href='{{url('course/courseview/'.$value->id)}}'" class="circlebtn-view" data-toggle="tooltip" data-placement="bottom" title="View Course" data-original-title="View Course"><i class="fa fa-eye"></i></a>

                            <!-- <a href="javascript:getEnroll({{$value->id}})" title="View Enrolled" class="circlebtn-comment"><i class="fa fa-repeat"></i></a> -->

                            <a href="javascript:deleteCourse({{ $value->id }})" title="Delete" class="circlebtn-delete">
                              <i class="fa fa-trash"></i>
                              </a>
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

<!-- model -->
<div class="modal fade" id="viewEnroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Enroll Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
         @csrf
          <div class="modal-body">
          <!-- <p id="paid"></p>
          <p id="pending"></p> -->
          <!-- <hr/> -->
            <div class="table-responsive1">
                  <table id="tbl_enroll" class="table table-striped table-bordered sorting-data">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Student Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Start Time</th>
                              <th>End Time</th>
                              <th>Batch Type</th>
                              <th>Price</th>
                              <th>Owner Charge(%)</th>
                              <th>Owner Charge</th>
                              <th>Client Discount(%)</th>
                              <th>Client Discount</th>

                              <th>Admission Fees</th>
                              <th>Enroll</th>
                              <th>Final Owner Charge</th>
                              <th>Paid To Class</th>
                          </tr>
                          </thead>
                        <tbody>
                      </tbody>
                  </table>
              </div>
          </div>
    </div>
  </div>
</div>
  <!-- Edit Course Model -->
<!-- <div class="modal fade" id="view_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">View Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Class Name</label><br>
              <label id="class_name"></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Course Name</label><br>
              <label id="course_name"></label>
            </div>
          </div>   
          <div class="col-md-4">
            <div class="form-group">
              <label>Batch Type</label><br>
              <label id="batch_type"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Batch For</label><br>
              <label id="batch_for"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Material Provided</label><br>
              <label id="material_provided"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Certification Provided</label><br>
              <label id="certification_provided"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Price</label><br>
              <label id="price"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Owner Service Charge Percentage</label><br>
              <label id="owner_service_charge_per"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Owner Service Charge</label><br>
              <label id="owner_service_charge"></label>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Client Discount Percentage</label><br>
              <label id="client_discount_per"></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Final Price</label><br>
              <label id="final_price"></label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Date</label><br>
              <label id="date"></label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->

  <script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

function deleteCourse(id)
{
  if(id) {

    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this course?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('admin.deleteCourse')}}',
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

function isApprovecourse(id,status)
{
  if (id!="")
  {
    $.ajax({
      url:'{{route('course.isApprovecourse')}}',
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

//filter logic

$(window).bind("load", function() {

    $('#sub_course_dv').addClass('hidden');
    $('#child_course_dv').addClass('hidden');

    var maincourse_session ='{{ session('admin_maincourse_courselist_session')}}';
    var subcourse_session ='{{ session('admin_subcourse_courselist_session')}}';
    var childcourse_session ='{{ session('admin_childcourse_courselist_session')}}';

    //locations
    var city_session ='{{ session('admin_city_courselist_session')}}';
    var area_session ='{{ session('admin_area_courselist_session')}}';

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
          url:'{{route('admin.getFilterSubcourse_courselist')}}',
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
          url:'{{route('admin.getFilterArea_courselist')}}',
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
          url:'{{route('admin.getchildCourse_courselist')}}',
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

function getEnroll(id)
{
  $('#paid').html('');
  $('#pending').html('');
  var tbl = $('#tbl_enroll').DataTable();
  tbl.clear().draw();
  if (id!="")
  {
    $('#viewEnroll').modal('show');
    $.ajax({
      url:'{{route('admin.getEnroll')}}',
      dataType:'JSON',
      method:'POST',
      data:{id:id},
      success:function(data)
      {
        if (data)
        {
          // console.log(data);
          /*$('#paid').html('Total Paid:-'+" ₹ "+data.paid);
          $('#pending').html('Total Pending:-'+" ₹ "+(data.pending - data.paid));*/
          var counter = 1;
          for (var i = 0;i<data.enroll.length; i++) {

            // var pending_student = "₹ "+(data.enroll[i].student_addmission_fees - data.enroll[i].enroll_amount);
            var full_name = data.enroll[i].firstname +" "+ data.enroll[i].lastname;
            var price = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].price : "N/A";
            var batch_type = data.enroll[i].istrial==0 ? "Regular" : "Trial";
            var enroll_amount = "₹ "+data.enroll[i].enroll_amount;
            var pending_owner = "₹ "+(data.enroll[i].enroll_amount - data.enroll[i].final_owner_charge);
            var final_owner_charge = "₹ "+data.enroll[i].final_owner_charge;
            var owner_service_charge_per = data.enroll[i].istrial==0 ? data.enroll[i].owner_service_charge_per : "N/A";
            var owner_service_charge = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].owner_service_charge : "N/A";
            var client_discount_per = data.enroll[i].istrial==0 ? data.enroll[i].client_discount_per : "N/A";
            var student_original_discount_value = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].student_original_discount_value : "N/A";
            var final_price = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].final_price : "N/A";
            pending_owner = data.enroll[i].istrial==0 ? pending_owner : "N/A";
            final_owner_charge = data.enroll[i].istrial==0 ? final_owner_charge : "N/A";
            
            
            tbl.row.add([
              counter,
              full_name,
              data.enroll[i].email,
              data.enroll[i].mobile,
              data.enroll[i].start_date,
              data.enroll[i].end_date,
              data.enroll[i].start_time,
              data.enroll[i].end_time,
              batch_type,
              price,
              owner_service_charge_per,
              owner_service_charge,
              client_discount_per,
              student_original_discount_value,
              final_price,
              enroll_amount,
              final_owner_charge,
              pending_owner
            ]).draw(false);
            counter++;
          }
        }
      }
    });
  }
}
// function fetch_course_details(id) 
// {
//   if(id != "") {
//     $.ajax({
//       url:'{{route('course.fetch_course_details')}}',
//       method:'POST',
//       dataType:'JSON',
//       data:{id:id},
//       success:function(data)
//       {
//         console.log(data);
//         if(data != false) {
//           $('#class_name').text(data['class_name']);
//           $('#course_name').text(data['name']);

//           if(data['batch_type'] == 0) {
//             data['batch_type'] = 'Regular';
//           } else if (data['batch_type'] == 1) {
//             data['batch_type'] = 'Trial';
//           } else {
//             data['batch_type'] = 'NA';
//           }
//           $('#batch_type').text(data['class_name']);
          
//           if(data['batch_for'] == 0) {
//             data['batch_for'] = 'Female';
//           } else if (data['batch_for'] == 1) {
//             data['batch_for'] = 'Male';
//           } else {
//             data['batch_for'] = 'NA';
//           }
//           $('#batch_for').text(data['batch_for']);

//           if(data['material_provided'] == 1) {
//             data['material_provided'] = 'YES';
//           } else if (data['material_provided'] == 0) {
//             data['material_provided'] = 'NO';
//           } else {
//             data['material_provided'] = 'NA';
//           }
//           $('#material_provided').text(data['material_provided']);

//           if(data['certification_provided'] == 1) {
//             data['certification_provided'] = 'YES';
//           } else if (data['certification_provided'] == 0) {
//             data['certification_provided'] = 'NO';
//           } else {
//             data['certification_provided'] = 'NA';
//           }
//           $('#certification_provided').text(data['certification_provided']);
//           $('#price').text(data['price']);
//           $('#owner_service_charge_per').text(data['owner_service_charge_per']);
//           $('#owner_service_charge').text(data['owner_service_charge']);
//           $('#client_discount_per').text(data['client_discount_per']);
//           $('#final_price').text(data['final_price']);
//           $('#date').text(data['date']);
//           $('#view_model').modal('show');
//         }
//       }
//     });
//   }
// }
</script>

  @endsection