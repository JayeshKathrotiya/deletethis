@extends('edifygoclass.layout')
@section('contents')

<!-- <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-title">Course Class</h2>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="theme-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Surat</a></li>
                    <li><a href="#">Coaching Classes in Surat</a></li>
                    <li class="active"><a href="#">Vidhya Coaching Classes</a></li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

<section class="classes-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="classes-info">
                    <div class="classes-logo">
                        @if($class->class_logo)
                            <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" alt="Image not available">
                        @else
                            <img src="{{ asset('edifygo_assets')}}/image/classes-logo.png" alt="Image not available">
                        @endif
                    </div>
                    <div class="classes-details">
                        <h3 class="text-break">{{ $class->name}}</h3>
                        <div class="ratting">
                            <div class="rate">
                                 <span class="review-stars">

                                    <?php
                                        $rate = round($class->rating_sum/($class->rating_count ? $class->rating_count : 1));
                                        // echo $rate."<br/>";
                                    ?>
                                <!-- ////////////// STAR RATE CHECKER ////////////// -->
                                    @if($rate <= 0)
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rate == 1)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rate == 2)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rate == 3)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rate == 4)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    @elseif($rate == 5)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endif
                                    <!-- ///////////////////////////////////////////// -->
                                </span>
                            </div>
                            <span class="review">({{$class->review_count}} Review)</span>
                        </div>
                        <p class="address text-break">{{$class->address ? $class->address."," : ""}} {{$class->area_name}}, {{$class->city_name}}, {{$class->state_name}}, {{$class->country_name}}</p>

                        <!-- <button class="btn btn-share">Share <i class="fa fa-share" aria-hidden="true"></i></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <h1>Ok{{session('setCourseSession')}}</h1> -->
<section class="classes-info-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="classes-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="classes-tab" data-toggle="tab" href="#classes" role="tab" aria-controls="classes" aria-selected="false">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">FAQ</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" id="achievers-tab" data-toggle="tab" href="#achievers" role="tab" aria-controls="achievers" aria-selected="false">Top Achievers</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <div class="group-list">
                                        <label class="clabel">Description</label>
                                        <p class="text-black" style="word-break: break-all;">{{$class->overview}}</p>
                                    </div>
                                     <div class="group-list {{$class->class_pdflist->isEmpty() ? 'hidden' : ''}}">
                                        <label class="clabel">View Brouchure</label><br>
                                        <ul>
                                        @if(!$class->class_pdflist->isEmpty())
                                          <?php $chk = 0; ?>
                                            @foreach($class->class_pdflist as $pdf)
                                              @if($pdf->pdf != null)
                                                <?php $chk++;?>
                                                <li><a target="_blank" href="{{asset('class_pdf/'.$pdf->pdf.'')}}">{{$pdf->title}}</a></li>
                                              @elseif($chk == 0)
                                                <p class="msg_course">No Brouchure.</p>
                                              @endif
                                            @endforeach
                                          @endif
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div style="display:none;" id="class_video1{{$class->id}}">
                                            <video class="lg-video-object lg-html5" controls preload="none">
                                                <source src="{{asset('class_video/'.$class->class_video.'')}}" type="video/mp4">
                                                 Your browser does not support HTML5 video.
                                            </video>
                                        </div>
                                    <div class="group-list" id="group-video">
                                        <a href="" class="group-video" data-html="#class_video1{{$class->id}}">
                                            <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg">
                                        </a>


                                    </div>

                                    <div class="group-list">
                                        <div class="group-img-grid" id="group-image">
                                            @if($class->class_imglist)
                                                @foreach($class->class_imglist as $key => $value)
                                                    <a href="{{asset('class_images/'.$value->image.'')}}" class="group-image">
                                                        <img src="{{asset('class_images/'.$value->image.'')}}">
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row {{$class->class_tubelist->isEmpty() ? 'hidden' : ''}}">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="group-list">
                                        <label class="clabel">Videos</label>
                                        <div class="row video-grid myvideo-grid">
                                            @if(!$class->class_tubelist->isEmpty())
                                                @foreach($class->class_tubelist as $tub => $tube)
                                                <a href="{{$tube->url}}" class="col-lg-3 col-md-6 col-sm-12 vgrid">
                                                    <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg">
                                                    {{$tube->title}}
                                                </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="tab-pane fade show active" id="classes" role="tabpanel" aria-labelledby="classes-tab">
                                <div class="">
                                    <div class="col-md-4 pl-0">
                                        <div class="form-group">
                                            <form id="maincoursefrm" name="maincoursefrm" method="POST" action="">
                                                @csrf
                                                <select id="maincourseselect" name="maincourseselect" class="form-control" onchange="javascript:setSessionAndGetCourse({{\Request::segment(2)}})">
                                                    @if(!empty($maincourse))
                                                        <option value="all">Select Main Course</option>
                                                        @foreach($maincourse as $l => $maincour)
                                                            <option value="{{$maincour->id}}" {{session('setMainCourseSession')==$maincour->id ? "selected" : ""}}>{{$maincour->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion" id="accordionExample">
                                    @if(!$courses->isEmpty())
                                        @foreach($courses as $c => $course)
                                    <div class="card">
                                        <form id="frm_enroll{{$course->id}}" method="POST" action="/student/enroll">
                                            @csrf
                                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                                @if(session('setCourseSession'))
                                                    <div class="card-header {{session('setCourseSession')!=$course->id?'collapsed':''}}" id="headingOne" data-toggle="collapse" data-target="#collapse{{$course->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                        {{$course->name}}
                                                    </div>
                                                    <div id="collapse{{$course->id}}" class=" collapse {{session('setCourseSession')==$course->id?'collapse':''}} {{session('setCourseSession')==$course->id?'show':''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                @else
                                                <div class="card-header {{$c!=0?'collapsed':''}}" id="headingOne" data-toggle="collapse" data-target="#collapse{{$course->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                    {{$course->name}}
                                                </div>
                                                <div id="collapse{{$course->id}}" class=" collapse {{$c==0?'collapse':''}} {{$c==0?'show':''}}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                @endif
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-6 col-sm-12">
                                                                <div class="group-list">
                                                                    <label class="clabel">Course Type</label>
                                                                    <ul class="cinfo">
                                                                        @if($course->isExclusive==1)
                                                                            <li>Exclusive</li>
                                                                            <!-- <li>Expired: {{date('d-m-Y',strtotime($course->expiry_date))}}</li> -->
                                                                        @else
                                                                            <li>Regular</li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                <!-- <div class="group-list">
                                                                    <label class="clabel">Batch Type</label>
                                                                    <ul class="cinfo">
                                                                        @if($course->batch_type==0)
                                                                            <li>Regular</li>
                                                                        @elseif($course->batch_type==1)
                                                                            <li>Trial</li>
                                                                        @else
                                                                            <li>Regular,Trial</li>
                                                                        @endif
                                                                    </ul>
                                                                </div> -->
                                                                @if( $course->batch_for==0 || $course->batch_for==1)
                                                                    <div class="group-list">
                                                                        <label class="clabel">Batch For</label>
                                                                        <ul class="cinfo">
                                                                            @if($course->batch_for==0)
                                                                                <li>Female</li>
                                                                            @elseif($course->batch_for==1)
                                                                                <li>Male</li>
                                                                            @else
                                                                                <!-- <li>Both</li> -->
                                                                                <li>Female,Male</li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                @endif

                                                                @if( $course->material_provided==1)
                                                                    <div class="group-list">
                                                                        <label class="clabel">Material Provided</label><br>
                                                                        <ul class="cinfo">
                                                                            @if($course->material_provided==0)
                                                                                <li>No</li>
                                                                            @elseif($course->material_provided==1)
                                                                                <li>Yes</li>
                                                                            @else
                                                                                <li>NA</li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                                @if( $course->certification_provided==1)
                                                                    <div class="group-list">
                                                                        <label class="clabel">Certification Provided</label>
                                                                         <ul class="cinfo">
                                                                            @if($course->certification_provided==0)
                                                                                <li>No</li>
                                                                            @elseif($course->certification_provided==1)
                                                                                <li>Yes</li>
                                                                            @else
                                                                                <li>NA</li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                                <div class="cregister">
                                                                    @if($course->isExclusive==0)
                                                                        <p class="price"><strike>₹ {{$course->price}}</strike>
                                                                             ₹ {{$course->student_addmission_fees}}</p>
                                                                         <p class="saveper txt-red">Save {{$course->student_original_discount_per}}%</p>
                                                                        <h4>Admission @ ₹{{$course->admission_fees_selection_value_final}} Only</h4>
                                                                    @else
                                                                        <p class="price"><strike>₹ {{$course->price}}</strike>
                                                                             ₹ {{$course->ex_student_addmission_fees}}</p>
                                                                         <p class="saveper txt-red">Save {{$course->ex_student_original_discount_per}}%</p>
                                                                        <h4>Admission @ ₹{{$course->ex_admission_fees_selection_value_final}} Only</h4>
                                                                    @endif
                                                                    @if(!session('class_login_session_id'))
                                                                        <button type="submit" name="btn_enroll" class="btn btn-enroll" id="btn_enroll{{$course->id}}" value="1">Enroll Now</button>
                                                                    @endif
                                                                    @if($course->batch_type!=0 && !session('class_login_session_id'))
                                                                        <button type="submit" name="btn_enroll_trial" class="btn btn-enroll" id="btn_enroll_trial{{$course->id}}" value="0">Enroll Trial Course</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <!-- <div class="group-list">
                                                                    <label class="clabel">Description</label>
                                                                    <p>{{$course->description}}</p>
                                                                </div> -->
                                                                <div class="group-list">
                                                                    <label class="clabel">Time Slot</label>
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th></th>
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
                                                                                            <td>
                                                                                                @if(!session('class_login_session_id'))
                                                                                                <input type="radio" name="time_slot" value="{{$tm->id}}" {{session('setTimeSlotSessionForEnrollBeforLogin')==$tm->id ? 'checked' :''}}>
                                                                                                @endif
                                                                                            </td>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($c==0)
                                                    <input type="hidden" name="hdcourse_id" id="hdcourse_id" value="{{$course->id}}">
                                                @endif
                                            </form>
                                            </div>

                                        @endforeach
                                        {{session()->forget('setCourseSession')}}
                                        {{session()->forget('setMainCourseSession')}}
                                        {{session()->forget('setClassSessionForEnrollBeforLogin')}}
                                        {{session()->forget('setTimeSlotSessionForEnrollBeforLogin')}}
                                    @endif
                                        </div>
                            </div>
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="review-top">
                                <span class="outofreview">{{round($count['rating_sum']/($count['rating_count'] ? $count['rating_count'] : 1))}} out of 5</span>
                                <span class="totalreview">{{$count['review_count']}} review</span>
                            </div>
                            <div class="review-grid">
                                @if(!empty($ratings))
                                    @foreach($ratings as $rt => $rating)
                                    <div class="review-list">
                                        <div class="reimg">
                                            <img src="{{asset('edifygo_assets')}}/image/user-image.png">
                                        </div>
                                        <div class="redesc">
                                            <h6>{{$rating->firstname}} {{$rating->lastname}}</h6>
                                            <div class="rerating">
                                                <div class="rate">
                                                    <!-- <input type="radio" id="star5" name="rate" value="5" />
                                                    <label for="star5" title="text">5 stars</label>
                                                    <input type="radio" id="star4" name="rate" value="4" />
                                                    <label for="star4" title="text">4 stars</label>
                                                    <input type="radio" id="star3" name="rate" value="3" />
                                                    <label for="star3" title="text">3 stars</label>
                                                    <input type="radio" id="star2" name="rate" value="2" />
                                                    <label for="star2" title="text">2 stars</label>
                                                    <input type="radio" id="star1" name="rate" value="1" />
                                                    <label for="star1" title="text">1 star</label> -->
                                                    <span class="review-stars">
                                                        <!-- ////////////// STAR RATE CHECKER ////////////// -->
                                                            @if($rating->rating <= 0)
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($rating->rating === 1)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($rating->rating === 2)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($rating->rating === 3)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($rating->rating === 4)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @elseif($rating->rating >= 5)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endif
                                                            <!-- ///////////////////////////////////////////// -->
                                                        </span>
                                                </div>
                                            </div>
                                            <p>{{$rating->review}}</p>
                                        </div>
                                        
                                        <p class="redate">{{date('d-m-Y',strtotime($rating->ratingdate))}}</p>
                                        <p class="redatee">{{date('g:iA',strtotime($rating->ratingdate))}}</p>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                       <!--  <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                            <div class="course-faq">
                                @if(!$faqs->isEmpty())
                                    @foreach($faqs as $f => $faq)
                                        <div class="faq-list">
                                        <h5><span>Q {{++$f}}:</span>{{$faq->question}}</h5>
                                        <p class="text-break">{{$faq->answer}}</p>
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="faq-list">
                                        <h5><span>No data available.</span></h5>
                                    </div>
                                @endif
                            </div>
                        </div> -->
                        <div class="tab-pane fade" id="achievers" role="tabpanel" aria-labelledby="achievers-tab">
                            <!-- <div class="achievers-grid">
                            @if($class->class_imglist)
                                @foreach($class->class_rankerlist as $key1 => $value1)
                                <div class="achievers-list">
                                    <a href="{{asset('ranker_images/'.$value1->image.'')}}" class="group-image">
                                        <img src="{{asset('ranker_images/'.$value1->image.'')}}">
                                    </a>
                                </div>
                                @endforeach
                            @endif
                            </div> -->

                            <div class="achievers-grid" id="group-image1">
                                @if($class->class_imglist)
                                    @foreach($class->class_rankerlist as $key1 => $value1)
                                        <a href="{{asset('ranker_images/'.$value1->image.'')}}" class="achievers-list">
                                            <img src="{{asset('ranker_images/'.$value1->image.'')}}">
                                            <p>{{$value1->title}}</p>
                                        </a>
                                    @endforeach
                                @endif
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
        <?php
        if (!empty($courses))
        {
            foreach ($courses as $key => $value) {
                ?>
                    $('#frm_enroll<?php echo $value->id; ?>').validate({
                        rules:
                        {
                            time_slot:
                            {
                                required:true
                            }
                        },
                        messages:
                        {
                            time_slot:
                            {
                                required:function()
                                {
                                    $.confirm({
                                        title: 'Warning',
                                        content: 'Please select time slot.',
                                        buttons: {
                                            OK: function () {
                                            }
                                        }
                                    });
                                }
                            }
                        },
                        submitHandler:function(form)
                        {
                            $('#btn_enroll<?php echo $value->id; ?>').attr('disabled',true);
                            var class_id = '{{ \Request::segment(2) }}';
                            var student_login = '{{session('student_login_session')}}';
                            var time_slot = $("input[name='time_slot']:checked").val();
                            if (student_login)
                            {
                                form.submit();
                            }else
                            {
                                // var hdcourse_id = $('#hdcourse_id').val();
                                $.ajax({
                                    url:'{{route('student.enrollbeforlogin')}}',
                                    method:'POST',
                                    dataType:'JSON',
                                    data:{class_id:class_id,time_slot:time_slot},
                                    success:function(data)
                                    {
                                        window.location.href = '/student/login';
                                    }
                                });
                            }
                        }
                    });
                <?php
            }
        }
        ?>
    });

    function setSessionAndGetCourse(class_id)
    {
        var final_url = "";
        var url_maincourse_id = $('#maincourseselect').val();
        var url_maincourse = $('#maincourseselect option:selected').text();
        url_maincourse = url_maincourse.split(" ").join('-');

        var class_id = '{{ \Request::segment(2) }}';
        //convert to slug
        if (url_maincourse_id!="" && url_maincourse_id!="all")
        {
            // var final_url = '/viewcourse/'+class_id+'/'+url_maincourse+'/'+url_maincourse_id+'';
            var final_url = '/viewcourse/'+class_id+'/'+url_maincourse;
        }else
        {
            var final_url = '/viewcourse/'+class_id;
        }
        $('#maincoursefrm').attr('action',final_url);
        $('#maincoursefrm').submit();

    }
</script>
@endsection
