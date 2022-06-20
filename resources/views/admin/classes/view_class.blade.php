@extends('admin.layout')
@section('content')
      
    <div class="content container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <input type="button" class="btn btn-warning float-right" value=" Back" onclick="window.location.href='{{ route('classes.index')}}'">
            <h5 class="card-title mb-0">{{$class->name ? $class->name:""}}</h5>
          </div>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class Details</span> 
              @if($class->isapprove==0)
                <span class="badge badge-warning">Requested</span>
              @elseif($class->isapprove==1)
                <span class="badge badge-primary">Approved</span>
              @elseif($class->isapprove==2)
                <span class="badge badge-danger">Declined</span>
              @endif
            </h5>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Class Logo</p>
              <p class="col-sm-9">
                @if($class->class_logo)
                  <img class="rounded-circle" alt="User Image" src="{{asset('class_logo/'.$class->class_logo.'')}}" width="50" height="50" alt="Image not available">
                @else
                  <img class="rounded-circle" alt="User Image" src="{{ asset('edifygo_assets')}}/image/classes-logo.png" width="50" height="50" alt="Image not available">
                @endif
              </p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Class Name</p>
              <p class="col-sm-9">{{$class->name ? $class->name:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Owner Name</p>
              <p class="col-sm-9">{{$class->firstname ? $class->firstname:""}} {{$class->lastname ? $class->lastname:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
              <p class="col-sm-9">{{$class->email ? $class->email:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
              <p class="col-sm-9">{{$class->mobile ? $class->mobile:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">GST Number</p>
              <p class="col-sm-9 mb-0">{{$class->gst_no ? $class->gst_no:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Address</p>
              <p class="col-sm-9 mb-0">{{$class->country_name ? $class->country_name:""}}<br>
              {{$class->state_name ? $class->state_name:""}}<br>
              {{$class->city_name ? $class->city_name:""}},<br>
              {{$class->area_name ? $class->area_name:""}},<br>
              {{$class->address ? $class->address:""}}.</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">How Did You Know About Us?</p>
              <p class="col-sm-9 mb-0">{{$class->title ? $class->title:""}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Subscription Status</p>
              <p class="col-sm-9 mb-0">
                @if($class->issubscribe==0)
                  <span class="badge badge-warning">Pending</span>
                @elseif($class->issubscribe==1)
                  <span class="badge badge-primary">Subscribed</span>
                @endif
              </p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Subscription Price</p>
              <p class="col-sm-9 mb-0">₹ {{$class->subscription_price ? $class->subscription_price:"N/A"}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Subscription Start Date</p>
              <p class="col-sm-9 mb-0">{{$class->subscription_date ? date('d-m-Y H:i:s',strtotime($class->subscription_date)):"N/A"}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Subscription Expire Date</p>
              <p class="col-sm-9 mb-0">{{$class->subscription_expire ? date('d-m-Y H:i:s',strtotime($class->subscription_expire)):"N/A"}}</p>
            </div>
            <div class="row">
              <p class="col-sm-3 text-muted text-sm-right mb-0">Change Class Status</p>
              <p class="col-sm-9 mb-0">
                @if($class->isapprove==0)
                <a href="javascript:isApproveClass({{ $class->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                  <i class="fa fa-check"></i>
                </a>
                <a href="javascript:isApproveClass({{ $class->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                  <i class="fa fa-times"></i>
                </a>
              @elseif($class->isapprove==1)
                <a href="javascript:isApproveClass({{ $class->id }},2)" class="circlebtn-deactivate" data-toggle="tooltip" data-placement="bottom" data-original-title="Decline" title="Decline">
                  <i class="fa fa-times"></i>
                </a>
              @elseif($class->isapprove==2)
                <a href="javascript:isApproveClass({{ $class->id }},1)" class="circlebtn-activate" data-toggle="tooltip" data-placement="bottom" data-original-title="Approve" title="Approve">
                  <i class="fa fa-check"></i>
                </a>
              @endif
              </p>
            </div>
          </div>
          <br/>
          <hr/>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class Images</span> 
            </h5>
            <div class="row">
              @if(!$class->class_imglist->isEmpty())
                @foreach($class->class_imglist as $key => $climg)
                  <img src="{{asset('class_images/'.$climg->image.'')}}" width="50" height="50">&nbsp;
                @endforeach
              @else
              <h5>Class image not available.</h5>
              @endif
            </div>
          </div>

          <br/>
          <hr/>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class Pdf</span> 
            </h5>
            <div class="row">
              @if(!$class->class_pdflist->isEmpty())
                  <?php $chk = 0; ?>
                    @foreach($class->class_pdflist as $value5)
                      @if($class->class_pdflist != null)
                        <?php $chk++; ?>
                        <li><a target="_blank" href="{{asset('class_pdf/'.$value5->pdf.'')}}">{{$value5->title}}</a></li>
                      @elseif($chk == 0)
                        <p class="msg_course">Class pdf not available.</p>
                      @endif
                    @endforeach
                @else
                  <h5>Class pdf not available.</h5>
                @endif
            </div>
          </div>

          <br/>
          <hr/>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class you tube videos</span> 
            </h5>
            <div class="row">
              @if(!$class->class_tubelist->isEmpty())
                  <?php $chk1 = 0; ?>
                      @foreach($class->class_tubelist as $tub => $tube)
                        @if($tube->url != null)
                        <?php $chk1++; ?>
                        <a href="{{$tube->url}}" class="col-lg-3 col-md-6 col-sm-12 vgrid">
                            <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg">
                        </a>
                        @elseif($chk1 == 0)
                          <p class="col-lg-3 col-md-6 col-sm-12">No videos available.</p>
                        @endif
                      @endforeach
              @else
              <h5>Class you tube videos not available.</h5>
              @endif
            </div>
          </div>

          <br/>
          <hr/>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class Ranker Images</span> 
            </h5>
            <div class="row">
              @if(!$class->class_rankerlist->isEmpty())
                @foreach($class->class_rankerlist as $key => $clrnkimg)
                  <img src="{{asset('ranker_images/'.$clrnkimg->image.'')}}" width="50" height="50">&nbsp;
                @endforeach
              @else
              <h5>Class rankers image not available.</h5>
              @endif
            </div>
          </div>

          <br/>
          <hr/>
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>Class Video</span> 
            </h5>
            <div class="row">
              @if($class->class_video)
                <video width="320" height="240" controls>
                  <source src="{{asset('class_video/'.$class->class_video.'')}}" type="video/ogg">
                  Your browser does not support the video tag.
                </video>
              @else
                <h5>Class video not available.</h5>
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
</script>
@endsection