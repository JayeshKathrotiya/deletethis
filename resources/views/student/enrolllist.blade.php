@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- <h2 class="breadcrumb-title">Course Class</h2> -->
                    <div class="banner-inner">
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="registeration">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="reg-form-box">
                            <!-- <p>Total Pending:- ₹ {{$pending ? ($pending - $paid) : "-"}}</p>
                            <p>Total Paid:- ₹ {{$paid ? $paid : "-"}}</p> -->
                            <h4 class="text-center">Enroll Course List</h4>
                             <div class="card-body p-0">
                        <div class="table-responsive">
                          <table id="tbl_mcat" class="table table-striped table-bordered sorting-data">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Class</th>
                                      <th>Course</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Start Time</th>
                                      <th>End Time</th>
                                      <th>Batch Type</th>
                                      <th>Admission</th>
                                      <th style="width: 79px;">Enroll</th>
                                      <th style="width: 79px;">Pending</th>
                                      <th class="action-group no-sort">Action</th>
                                  </tr>
                                  </thead>
                                <tbody>
                                  @if(!empty($enroll)) 
                                    @foreach ($enroll as $key => $value)
                                  <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$value->name ? $value->class_name : "-"}}</td>
                                    <td>{{$value->name ? $value->name : "-"}}</td>
                                    <td>{{$value->start_date ? date('d-m-Y',strtotime($value->start_date)) : "-"}}</td>
                                    <td>{{$value->end_date ? date('d-m-Y',strtotime($value->end_date)) : "-"}}</td>
                                    <td>{{$value->start_time ? date('g:i A',strtotime($value->start_time)) : "-"}}</td>
                                    <td>{{$value->end_time ? date('g:i A',strtotime($value->end_time)) : "-"}}</td>
                                    <td>{{$value->istrial==1 ? "Trial" : "Regular"}}</td>
                                    <td>
                                      @if($value->istrial==1)
                                        N/A
                                      @else
                                        ₹ {{$value->student_addmission_fees ? $value->student_addmission_fees : "-"}}
                                      @endif

                                    </td>
                                    <td>₹ {{$value->enroll_amount ? $value->enroll_amount : "0"}}</td>
                                    <td>
                                      @if($value->istrial==1)
                                        N/A
                                      @else
                                        ₹ {{$value->student_addmission_fees - $value->enroll_amount}}
                                      @endif
                                    </td>
                                    <td>
                                      @if($value->isreview==0)
                                      <a href="" onclick="javascript:setRating({{$value->id}})" title="Add" class="circlebtn-comment" data-toggle="modal" data-target="#viewEnroll"><i class="fa fa-star"></i></a>
                                      @else
                                      N/A
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
        </section>


<!-- model -->
<div class="modal fade" id="viewEnroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Review And Rating</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="/rating" method="POST" id="rating_frm" name="rating_frm">
         @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="form-group"> 
                  <label>Rating</label> <span class="req-star text-danger"> *</span>
                  <input type="hidden" name="hdrate" id="hdrate" value="">
                  <input type="hidden" name="enroll_id" id="enroll_id" value="">
                  <div class="rerating">
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" onclick="javascript:setRate(this.value)" />
                        <label for="star5" title="5">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" onclick="javascript:setRate(this.value)" />
                        <label for="star4" title="4">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" onclick="javascript:setRate(this.value)" />
                        <label for="star3" title="3">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" onclick="javascript:setRate(this.value)" />
                        <label for="star2" title="2">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" onclick="javascript:setRate(this.value)" />
                        <label for="star1" title="1">1 star</label>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                  <label>Review</label> <span class="req-star text-danger"> *</span>
                  <textarea class="form-control resize" name="review" minlength="3" rows="5" maxlength="200"></textarea>
                </div>
              </div>   
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit" id="btn_submit" class="btn btn-submit">Submit</button>
        <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal">Close</button>
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
  $('#rating_frm').validate({
    ignore:"",
    rules:
    {
      hdrate:
      {
        required:true
      },
      review:
      {
        required:true,
        space:true,
        minlength:3,
        maxlength:200
      }
    },
    messages:
    {

    },
    submitHandler:function(form)
    {
      $('#btn_submit').attr('disabled',true);
      form.submit();
    }
  });

});

function setRate(rate)
{
  $('#hdrate').val("");
  $('#hdrate').val(rate);
}
function setRating(id)
{
  $('#enroll_id').val(id);
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
</script>
@endsection