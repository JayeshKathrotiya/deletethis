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
                            <button type="button" class="btn btn-submit float-right" id="btn_addcat" name="btn_addcat" value="Add Course" onclick="window.location.href='{{ route('course.create_course')}}'"><i class="fa fa-plus mr-2"></i> Add Course</button>
                            <h4 class="text-center">Course List</h4>

                      <div class="card-body p-0">
                        <div class="table-responsive">
                          <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Main Course Name</th>
                                      <th>Sub Course Name</th>
                                      <th>Child Course Name</th>
                                      <th>Class Status</th>
                                      <th>Course Status</th>
                                      <th class="no-sort">Seat</th>
                                      <th class="action-group no-sort" style="width: 136px;">Action</th>
                                  </tr>
                                  </thead>
                                <tbody>
                                  @if(!empty($course)) 
                                    @foreach ($course as $key => $value)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->maincourse_name ? $value->maincourse_name : "-"}}</td>
                                    <td>{{$value->subcourse_name ? $value->subcourse_name : "-"}}</td>
                                    <td>{{$value->chieldcourse_name ? $value->chieldcourse_name : "N/A"}}</td>
                                    <td>
                                          @if($value->cl_isapprove==0)
                                            <span class="badge badge-warning">Requested</span>
                                          @elseif($value->cl_isapprove==1)
                                            <span class="badge badge-primary">Approved</span>
                                          @elseif($value->cl_isapprove==2)
                                            <span class="badge badge-danger">Declined</span>
                                          @endif
                                    </td>
                                    <td>
                                          @if($value->isapprove==0)
                                            <span class="badge badge-warning">Requested</span>
                                          @elseif($value->isapprove==1)
                                            <span class="badge badge-primary">Approved</span>
                                          @elseif($value->isapprove==2)
                                            <span class="badge badge-danger">Declined</span>
                                          @endif
                                    </td>
                                    <td>
                                      <input type="checkbox" name="isAvailableseat" id="isAvailableseat" {{$value->seat_available==1 ? "checked":""}} onclick="javascript:isAvailableSeat({{$value->seat_available}},{{$value->id}})">
                                    </td>
                                    <td>  
                                          <a href="javascript:getEnroll({{$value->id}})" title="View Enrolled" class="circlebtn-view"><i class="fa fa-eye"></i></a>

                                          <a href="javascript:getReview({{$value->id}})" title="View Review" class="circlebtn-comment"><i class="fa fa-star"></i></a>
                                          <a href="{{url('/editcourse/'.$value->id.'')}}" title="Edit" class="circlebtn-edit"><i class="fa fa-edit"></i></a>
                                          @if($value->isapprove==0)
                                          @endif


                                          <a href="javascript:deleteCourse({{$value->id}})" title="Delete" class="circlebtn-delete"><i class="fa fa-trash"></i></a>
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
              <div class="table-responsive">
                  <table id="tbl_enroll" class="table table-striped table-bordered sorting-data">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Student Name</th>
                              <!-- <th>Email</th> -->
                              <!-- <th>Mobile</th> -->
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
                              <th>Pending From Student</th>
                              <th>Pending From Owner</th>
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

<!-- model -->
<div class="modal fade" id="viewReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Review List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
         @csrf
          <div class="modal-body">
          <!-- <p id="paid"></p>
          <p id="pending"></p> -->
          <!-- <hr/> -->
              <div class="table-responsive">
                  <table id="tbl_review" class="table table-striped table-bordered sorting-data">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Student Name</th>
                              <th>Rating</th>
                              <th class="no-sort">Review</th>
                              <th class="no-sort">Date</th>
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
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


function isAvailableSeat(status,id)
{
  $.ajax({
    url:'{{ route('course.isAvailableSeat')}}',
    method:'POST',
    dataType:'JSON',
    data:{status:status,id:id},
    success:function(data)
    {
      window.location.reload();
    }
  });
}

function deleteCourse(id)
{
    $.confirm({
      title : 'Warning',
      content:"Are you sure to delete this course?",
      buttons:{
        Confirm:function(){
           $.ajax({
              url:'{{ route('course.deleteCourse')}}',
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
      url:'{{route('class.getEnroll')}}',
      dataType:'JSON',
      method:'POST',
      data:{id:id},
      success:function(data)
      {
        if (data)
        {
          /*$('#paid').html('Total Paid:-'+" ₹ "+data.paid);
          $('#pending').html('Total Pending:-'+" ₹ "+(data.pending - data.paid));*/
          var counter = 1;
          for (var i = 0;i<data.enroll.length; i++) {

            var pending_student = "₹ "+(data.enroll[i].student_addmission_fees - data.enroll[i].enroll_amount);
            var pending_owner = "₹ "+(data.enroll[i].enroll_amount - data.enroll[i].final_owner_charge);
            var full_name = data.enroll[i].firstname +" "+ data.enroll[i].lastname;

            var price = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].price : "N/A";
            var batch_type = data.enroll[i].istrial==0 ? "Regular" : "Trial";
            var enroll_amount = "₹ "+data.enroll[i].enroll_amount;
            var owner_service_charge_per = data.enroll[i].istrial==0 ? data.enroll[i].owner_service_charge_per : "N/A";
            var owner_service_charge = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].owner_service_charge : "N/A";
            var client_discount_per = data.enroll[i].istrial==0 ? data.enroll[i].client_discount_per : "N/A";
            var student_original_discount_value = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].student_original_discount_value : "N/A";
            var final_price = data.enroll[i].istrial==0 ? "₹ "+data.enroll[i].final_price : "N/A";
            pending_owner = data.enroll[i].istrial==0 ? pending_owner : "N/A";
            pending_student = data.enroll[i].istrial==0 ? pending_student : "N/A";

            tbl.row.add([
              counter,
              full_name,
              // data.enroll[i].email,
              // data.enroll[i].mobile,
              data.enroll[i].start_date,
              data.enroll[i].end_date,
              data.enroll[i].start_time,
              data.enroll[i].end_time,
              batch_type,
              price,
              owner_service_charge_per,
              owner_service_charge,
              client_discount_per,
              owner_service_charge,
              final_price,
              enroll_amount,
              pending_student,
              pending_owner
            ]).draw(false);
            counter++;
          }
        }
      }
    });
  }
}

function getReview(id)
{
  var tbl = $('#tbl_review').DataTable();
  tbl.clear().draw();
  if (id!="")
  {
    $('#viewReview').modal('show');
    $.ajax({
      url:'{{route('class.getReview')}}',
      dataType:'JSON',
      method:'POST',
      data:{id:id},
      success:function(data)
      {
        // console.log(data);
        if (data)
        {
          var counter = 1;
          for (var i = 0;i<data.review.length; i++) {

            var full_name = data.review[i].firstname +" "+ data.review[i].lastname;

            tbl.row.add([
              counter,
              full_name,
              data.review[i].rating,
              data.review[i].review,
              data.review[i].ratingdate,
            ]).draw(false);
            counter++;
          }
        }
      }
    });
  }
}
</script>
@endsection