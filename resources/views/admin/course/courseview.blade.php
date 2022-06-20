@extends('admin.layout')
@section('content')      
<div class="content container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <input type="button" class="btn btn-primary float-right" value="Back" onclick="window.location.href='{{url('courselist')}}'">
          <h5 class="card-title mb-0">Course Details</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Main Course</label>
                <p>{{$course->maincourse_name ? $course->maincourse_name : "N/A"}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Sub Course</label>
                <p>{{$course->subcourse_name ? $course->subcourse_name : "N/A"}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Child Course</label>
                <p>{{$course->chieldcourse_name ? $course->chieldcourse_name : "N/A"}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Batch Type</label>
                <p>@if($course->batch_type == 0) Regular @elseif($course->batch_type == 1) Trial  @else Both @endif </p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Batch For</label>
                <p>@if($course->batch_for == 0) Female @elseif($course->batch_for == 1) Male  @else Both @endif</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Batch Fees</label>
                <p>Register @ ₹{{$course->admission_fees_selection_value_final}} Only</p>
              </div>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Description</label>
                <p>{{$course->description}}</p>
              </div>
            </div> -->
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Material Provided</label>
                <p>@if($course->material_provided == 0) No @elseif($course->material_provided == 0) Yes  @else NA @endif</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Certification Provided</label>
                <p>@if($course->certification_provided == 0) No @elseif($course->certification_provided == 0) Yes  @else NA @endif</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Price</label>
                <p>₹{{$course->price}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Owner Service Charge Percentage</label>
                <p>{{$course->owner_service_charge_per}}%</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Owner Service Charge </label>
                <p>₹{{$course->owner_service_charge}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Client Discount Percentage</label>
                <p>{{$course->client_discount_per ? $course->client_discount_per."%":"NA"}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Final Price</label>
                <p>₹{{$course->student_addmission_fees}}</p>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Admission</label>
                    <p>Register @ ₹{{$course->admission_fees_selection_value_final}} Only</p>
                </div>
              </div>
            <!-- <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Download Brouchure</label><br>
                <ul>
                  @if(!$course->pdf->isEmpty())
                  <?php $chk = 0; ?>
                    @foreach($course->pdf as $value5)
                      @if($value5->pdf != null)
                        <?php $chk++; ?>
                        <li><a target="_blank" href="{{asset('course_pdf/'.$value5->pdf.'')}}">{{$value5->title}}</a></li>
                      @elseif($chk == 0)
                        <p class="msg_course">No data available.</p>
                      @endif
                    @endforeach
                  @endif
                </ul>
              </div>
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Time Slot</label>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Batch Start Time</th>
                        <th>Batch End Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!$course->date->isEmpty())
                        @foreach($course->date as $d => $dt)
                          @if(!$dt->time->isEmpty())
                              @foreach($dt->time as $t => $tm)
                              <tr>
                                  <td>{{date('d-m-Y',strtotime($dt->start_date))}}</td>
                                  <td>{{date('d-m-Y',strtotime($dt->end_date))}}</td>
                                  <td>{{date("g:i A", strtotime($tm->start_time))}}</td>
                                  <td>{{date("g:i A", strtotime($tm->end_time))}}</td>
                              </tr>
                              @endforeach
                          @endif
                        @endforeach
                    @endif

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Videos</label>
                <div class="row video-grid myvideo-grid">
                  @if(!$course->tube->isEmpty())
                  <?php $chk1 = 0; ?>
                      @foreach($course->tube as $tub => $tube)
                        @if($tube->url != null)
                        <?php $chk1++; ?>
                        <a href="{{$tube->url}}" class="col-lg-3 col-md-6 col-sm-12 vgrid">
                            <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg">
                        </a>
                        @elseif($chk1 == 0)
                          <p class="col-lg-3 col-md-6 col-sm-12">No videos available.</p>
                        @endif
                      @endforeach
                  @endif
                </div>
              </div>
            </div> -->
            <!-- <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <label>Top Achievers</label>
                <div class="achievers-grid">
                    @if(!$course->class_rankerlist->isEmpty())
                      <?php $chk2 = 0; ?>
                      @foreach($course->class_rankerlist as $key1 => $value1)
                          @if($value1->image != null)
                          <?php $chk2++; ?>
                            <div class="achievers-list">
                                <img src="{{asset('ranker_images/'.$value1->image.'')}}">
                                <p>{{$value1->title}}</p>
                            </div>
                          @elseif($chk2 == 0)
                            <p>No data available.</p>
                          @endif
                        @endforeach
                    @else
                      <p>No data available.</p>
                    @endif
                </div>
              </div>
            </div> -->
          </div>
            @if($course->isExclusive==1)
            <br/>
            <hr/>
              <label>Exclusive Details</label>
            <hr/>
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Owner Service Charge Percentage</label>
                  <p>{{$course->ex_owner_service_charge_per}}%</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Owner Service Charge </label>
                  <p>₹{{$course->ex_owner_service_charge}}</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Client Discount Percentage</label>
                  <p>{{$course->ex_client_discount_per ? $course->ex_client_discount_per."%":"NA"}}</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Final Price</label>
                  <p>₹{{$course->ex_student_addmission_fees}}</p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="form-group">
                  <label>Admission</label>
                    <p>Register @ ₹{{$course->ex_admission_fees_selection_value_final}} Only</p>
                </div>
              </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
          <div class="pull-right">
            @if($course->isapprove == 0) 
              <button class="btn btn-success" id="approve" onclick="isapprove({{$course->id}},'1')">Approve</button>
              <button class="btn btn-danger" id="diapprove" onclick="isapprove({{$course->id}},'2')">Decline</button>
            @elseif($course->isapprove == 1)
              <button class="btn btn-danger" id="diapprove" onclick="isapprove({{$course->id}},'2')">Decline</button>
            @else
              <button class="btn btn-success" id="approve" onclick="isapprove({{$course->id}},'1')">Approve</button>
            @endif
          </div>
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

function isapprove(id,status)
{
  if (id!="")
  {
    if(status == 1) {
      $('#approve').attr('disabled','disabled');
    } else {
      $('#diapprove').attr('disabled','disabled');
    }
    $.ajax({
      url:'{{route('course.isApprovecourse')}}',
      method:'POST',
      dataType:'JSON',
      data:{id:id,status:status},
      success:function(data)
      {
        window.location.href = '{{url('courselist')}}';
      }
    });
  }
}
</script>
@endsection