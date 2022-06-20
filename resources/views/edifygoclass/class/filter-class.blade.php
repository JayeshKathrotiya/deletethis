@extends('edifygoclass.layout')
@section('contents')

<!-- <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="breadcrumb-title">Join Us</h2>
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
                    <li class="active"><a href="#">Coaching Classes in Surat</a></li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

<section class="class-filter">
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="top-filter">
                    @if(isset($selected_area))
                    <h3>{{$selected_category->name}} Classes in {{$selected_area->area_name}} , {{$selected_area->city_name}}
                    </h3>
                    @endif
                </div>
                <hr>
            </div>
        </div> -->
        
        <form id="filer_frm" method="POST" action="">
            @csrf
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="filter-sidebar">
                    <div class="card">
                        <div class="card-header"> <i class="fa fa-filter"></i> Filter By </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="ismobile" value="0">
                                <select class="form-control" id="area" name="area">
                                    <option value="">Select Location</option>
                                    @if(!empty($area))
                                      @foreach ($area as $value)
                                        <option value="{{ $value->id }}" {{ session('area_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }},{{ $value->city_name }}</option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <select class="form-control" id="fees" name="fees" onchange="submitForm('fees')">
                                    <option value="">Admission Fees</option>
                                    @if(!empty($fees))
                                      @foreach ($fees as $value)
                                        <option value="{{ $value->amount }}" {{ session('fees_session')==$value->amount ? 'selected=selected':''}}>{{ $value->amount }}</option>
                                      @endforeach
                                    @endif
                                </select> -->
                                <label>Admission Fees</label>
                                <input type="text" class="js-range-slider" name="my_range" id="my_range" value="" />
                                <input type="hidden" name="min" id="min" value="{{$min ? $min : 0}}">
                                <input type="hidden" name="max" id="max" value="{{$max ? $max : 0}}">

                                <input type="hidden" name="selected_min" id="selected_min" value="{{session('minfees') ? session('minfees') : $min}}">
                                <input type="hidden" name="selected_max" id="selected_max" value="{{session('maxfees') ? session('maxfees') : $max}}">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="trial_course" name="trial_course">
                                    <option value="">Batch Type</option>
                                    <option value="1" {{ session('trial_course')==1 ? 'selected=selected':''}}>Trial Course</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <select class="form-control" id="rating" name="rating" onchange="submitForm('rating')">
                                    <option value="">Rating</option>
                                    <option value="1" {{ session('rating_session')==1 ? 'selected=selected':''}}>1</option>
                                    <option value="2" {{ session('rating_session')==2 ? 'selected=selected':''}}>2</option>
                                    <option value="3" {{ session('rating_session')==3 ? 'selected=selected':''}}>3</option>
                                    <option value="4" {{ session('rating_session')==4 ? 'selected=selected':''}}>4</option>
                                    <option value="5" {{ session('rating_session')==5 ? 'selected=selected':''}}>5</option>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <select class="form-control" id="maincourse_id" name="maincourse_id" onchange="javascript:getFilterSubcourse(this,0,1)">
                                    <option value="">Select Main  Course</option>
                                    @if(!empty($course))
                                      @foreach ($course as $value)
                                        <option value="{{ $value->id }}" {{ session('maincourse_session')==$value->id ? 'selected=selected':''}}>{{ $value->name }}</option>
                                      @endforeach
                                    @endif
                                </select>
                            </div>  
                            <div class="form-group hidden" id="sub_course_dv">
                                <select class="form-control" id="subcourse_id" name="subcourse_id" onchange="javascript:getFilterchildcourse(this,0,1)">
                                    <option value="">Select Sub Course</option>
                                    <!-- @if(!empty($subcourse))
                                      @foreach ($subcourse as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    @endif -->
                                </select>
                            </div>                                    
                            <div class="form-group hidden" id="child_course_dv">
                                <select class="form-control" id="childcourse_id" name="childcourse_id">
                                    <option value="">Select Child Course</option>
                                   <!--  @if(!empty($childcourse))
                                      @foreach ($childcourse as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                      @endforeach
                                    @endif -->
                                </select>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-explore" href="javascript:submitForm()">Filter</a>
                            </div> 
                        </div>
                    </div>

                    <!-- <div class="card">
                        <div class="card-header"> Related Search </div>
                        <div class="card-body">
                            <ul>
                                <li>
                                    @if(!$related_search->isEmpty())
                                        @foreach($related_search as $rel => $relsearch)
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="related_search{{$rel}}" value="{{$rel}}" name="filter">
                                                <label for="related_search{{$rel}}">{{$relsearch->name}} Classes in {{$relsearch->area_name}} {{$relsearch->city_name}}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>

            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="right-filter">
                    <!-- <div class="right-total"><span>Total Found : {{count($classes)}} - List : 1 to 4</span></div> -->
                    <!-- <div class="right-total"><span></span></div> -->
                    <div class="">
                    </div>
                    <div class="right-dropfilter">
                        <select class="form-control" id="sortby" name="sortby" onchange="submitForm('sortby')">
                            <option value="">Sort By</option>
                            <!-- <option>Popularity</option> -->
                            <option value="4" {{session('filter')==4 ? "selected=selected":''}}>Exclusive</option>
                            <option value="3" {{session('filter')==3 ? "selected=selected":''}}>Popularity</option>
                            <!-- <option value="5" {{session('filter')==5 ? "selected=selected":''}}>Trial Course</option> -->
                            <option value="1" {{session('filter')==1 ? "selected=selected":''}}>Price - High to Low</option>
                            <option value="2" {{session('filter')==2 ? "selected=selected":''}}>Price - Low to High</option>
                            <!-- <option value="3">Rating</option> -->
                        </select>
                    </div>
                </div>
                <hr>
                <div class="filter-course-grid">
                    @if(!$classes->isEmpty())
                        @foreach($classes as $key => $value)
                            <div class="cgrid-box">
                                @if($value->class_logo)
                                    <div class="cgrid-img" style="background-image: url('{{asset('class_logo/'.$value->class_logo.'')}}');">
                                @else
                                    <div class="cgrid-img" style="background-image: url('{{ asset('edifygo_assets')}}/image/classes-logo.png');">
                                @endif
                                </div>
                                <div class="cgrid-details">
                                    <h5>{{ $value->name ? $value->name : $value->name}}</h5>
                                    <div class="ratting">
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
                                                <?php
                                                    $rate = round($value->rating_sum/($value->rating_count ? $value->rating_count : 1));
                                                    // echo $rate."<br/>";
                                                ?>

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
                                        <span class="review">({{$value->review_count}} Review)</span>
                                       
                                    </div>
                                    <div class="class-share">
                                        <ul>
                                            <li><a href="tel:+72111 13006"><i class="fa fa-phone" aria-hidden="true"></i></a></li>
                                            <li><a class="shareall" type="button"><i class="fa fa-share" aria-hidden="true"></i>
                                            </a></li>                                            
                                            <li class="sh1"><a href="https://www.facebook.com/sharer.php?u={{url('viewcourse')}}/{{$value->id}}&t=TEst" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li class="sh2"><a href="https://www.linkedin.com/sharing/share-offsite/?url={{url('viewcourse')}}/{{$value->id}}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            <li class="sh3"><a href="https://api.whatsapp.com/send?'&text={{url('viewcourse')}}/{{$value->id}}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                            <li class="sh4"><a href="https://twitter.com/intent/tweet?url={{url('viewcourse')}}/{{$value->id}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li class="sh5"><a href="https://mail.google.com/mail/?view=cm&body={{url('viewcourse')}}/{{$value->id}}" target="_blank"><i class="fa fa-envelope-o"></i></a></li>
                                            <!-- <li class="sh2"><a href="https://www.instagram.com/?url={{url('viewcourse')}}/{{$value->id}}" ><i class="fa fa-instagram"></i></a></li> -->
                                        </ul>
                                        <!-- <a href="tel:+15555555555">Call me at +1 (555) 555-5555</a> -->
                                        
                                        <!-- https://www.linkedin.com/sharing/share-offsite/?url=www.techhive.co.in/services/web-development-company-india.html -->

                                        
                                        <!-- <a class="btn btn-sshare" onclick="javascript:getContact({{$value->id}})"><i class="fa fa-share" aria-hidden="true"></i></a> -->
                                        <!-- javascript:setCourseSession({{$value->course_id}})" href="{{ url('viewcourse/'.$value->id) }} -->
                                    </div>
                                    <p class="address">{{$value->area_name}} {{$value->city_name}} {{$value->state_name}} {{$value->country_name}}</p>
                                    <div class="cgrid-box-left">
                                        <ul class="stud-course">
                                            <li><i class="fa fa-graduation-cap"></i> {{$value->total_stud}} Student</li>
                                            <li><i class="fa fa-certificate"></i> {{$value->total_course}} Courses</li>
                                        </ul>
                                        <ul class="cimg-grid">
                                            @if($value->class_imglist)
                                                @foreach($value->class_imglist as $k=> $img)
                                                <?php
                                                $count = 0;
                                                ?>
                                                    @if($k<=2)
                                                    <li>
                                                        <img src="{{asset('class_images/'.$img->image.'')}}">
                                                    </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                            <li>
                                                <?php
                                                $count = (count($value->class_imglist) - 3);
                                                ?>
                                                @if($count>0)
                                                    +{{$count}} <br>
                                                    <a style="cursor: pointer;" onclick="javascript:setCourseSession({{$value->course_id}},{{ $value->id }},'{{$value->name}}')">View All</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cgrid-box-right">
                                        @if($value)
                                            @if($value->isExclusive==1)
                                                <p class="price"><strike>₹ {{$value->price}}</strike>₹ {{$value->ex_student_addmission_fees}}</p>
                                                <p class="saveper">Save {{$value->ex_student_original_discount_per}}%</p>

                                                <strong class="admprice">Admission <span class="text-danger">@ {{$value->ex_admission_fees_selection_value_final}}</span></strong>

                                                <!-- <button class="btn btn-explore">Explore <i class="fa fa-share" aria-hidden="true"></i></button> -->
                                                <a style="cursor: pointer;" onclick="javascript:setCourseSession({{$value->course_id}},{{ $value->id }},'{{$value->name}}')" class="btn btn-explore">Explore</a>
                                            @else
                                                <p class="price"><strike>₹ {{$value->price}}</strike>₹ {{$value->student_addmission_fees}}</p>
                                                <p class="saveper">Save {{$value->student_original_discount_per}}%</p>
                                                
                                                <strong class="admprice">Admission <span class="text-danger">@ {{$value->admission_fees_selection_value_final}}</span></strong>

                                                <!-- <button class="btn btn-explore">Explore</button> -->
                                                <a style="cursor: pointer;" onclick="javascript:setCourseSession({{$value->course_id}},{{ $value->id }},'{{$value->name}}')" class="btn btn-explore">Explore</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @if($value->ispopular==1)
                                    <div class="cgrid-status adm-close">
                                        Popular
                                    </div>
                                @endif
                                @if($value->isExclusive==1)
                                    <div class="cgrid-status adm-open">
                                        Exclusive
                                    </div>
                                @endif
                            </div>

                        @endforeach
                        @else
                        <div class="alert alert-danger">
                          No classes available.
                        </div>
                    @endif
                </div>

                <div class="right-bottom">
                    @if(!$classes->isEmpty())
                        <div class="total-records">
                            <!-- Page 1 of 5 -->
                        </div>
                    @endif
                    <ul class="pagination">
                        {{ $classes->links() }}
                        <!-- <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        <li class="page-item active"><span class="page-link" >1</span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</section>

<section class="bottom-filter">
    <div class="container">
        <form id="filer_frm1" method="POST" action="">
            @csrf
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="filter-grid">
                    <ul>
                        <li><a id="filterBy">Filter By</a></li>
                        <li><a id="sortBy">Sort By</a></li>
                    </ul>
                </div>
                <div class="filter-list" id="filter-list">
                    <div class="form-group">
                        <input type="hidden" name="ismobile" value="1">
                        <select class="form-control" id="area" name="area">
                            <option value="">Select Location</option>
                            @if(!empty($area))
                              @foreach ($area as $value)
                                <option value="{{ $value->id }}" {{ session('area_session')==$value->id ? 'selected=selected':''}}>{{ $value->area_name }},{{ $value->city_name }}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <select class="form-control" id="fees" name="fees" onchange="submitForm1('fees')">
                            <option value="">Admission Fees</option>
                            @if(!empty($fees))
                              @foreach ($fees as $value)
                                <option value="{{ $value->amount }}" {{ session('fees_session')==$value->amount ? 'selected=selected':''}}>{{ $value->amount }}</option>
                              @endforeach
                            @endif
                        </select> -->
                        <label>Admission Fees</label>
                        <input type="text" class="js-range-slider" name="my_range" id="my_range1" value="" />
                        <input type="hidden" name="min" id="min" value="{{$min ? $min : 0}}">
                        <input type="hidden" name="max" id="max" value="{{$max ? $max : 0}}">

                        <input type="hidden" name="selected_min" id="selected_min" value="{{session('minfees') ? session('minfees') : $min}}">
                        <input type="hidden" name="selected_max" id="selected_max" value="{{session('maxfees') ? session('maxfees') : $max}}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="trial_course" name="trial_course">
                            <option value="">Batch Type</option>
                            <option value="1" {{ session('trial_course')==1 ? 'selected=selected':''}}>Trial Course</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="maincourse_id1" name="maincourse_id" onchange="javascript:getFilterSubcourse(this,0,1)">
                            <option value="">Select Main  Course</option>
                            @if(!empty($course))
                              @foreach ($course as $value)
                                <option value="{{ $value->id }}" {{ session('maincourse_session')==$value->id ? 'selected=selected':''}}>{{ $value->name }}</option>
                              @endforeach
                            @endif
                        </select>
                    </div>  
                    <div class="form-group hidden" id="sub_course_dv1">
                        <select class="form-control" id="subcourse_id1" name="subcourse_id" onchange="javascript:getFilterchildcourse(this,0,1)">
                            <option value="">Select Sub Course</option>
                            <!-- @if(!empty($subcourse))
                              @foreach ($subcourse as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                              @endforeach
                            @endif -->
                        </select>
                    </div>                                    
                    <div class="form-group hidden" id="child_course_dv1">
                        <select class="form-control" id="childcourse_id1" name="childcourse_id">
                            <option value="">Select Child Course</option>
                           <!--  @if(!empty($childcourse))
                              @foreach ($childcourse as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                              @endforeach
                            @endif -->
                        </select>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-explore" href="javascript:submitForm1()">Filter</a>
                    </div>
                </div>
                 <div class="filter-list" id="sort-list">
                    <select class="form-control" id="sortby" name="sortby" onchange="submitForm1('sortby')">
                        <option value="">Sort By</option>
                        <option value="4" {{session('filter')==4 ? "selected=selected":''}}>Exclusive</option>
                        <option value="3" {{session('filter')==3 ? "selected=selected":''}}>Popularity</option>
                        <!-- <option value="5" {{session('filter')==5 ? "selected=selected":''}}>Trial Course</option> -->
                        <option value="1" {{session('filter')==1 ? "selected=selected":''}}>Price - High to Low</option>
                        <option value="2" {{session('filter')==2 ? "selected=selected":''}}>Price - Low to High</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>


    <!-- model -->
<div class="modal fade" id="sharemdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cat_countryel">Share Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <form id="valid_share" name="valid_share">
            @csrf
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" name="hdshare" id="hdshare">
                            <label>Mobile</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile*" maxlength="10">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_submit" class="btn btn-submit" onclick="javascript:validShare()">Share</button>
                <button type="button" class="btn btn-secondary text-uppercase" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function validShare()
{
    $('#valid_share').validate({
        rules:
        {
            mobile:
            {
                required:true,
                number:true,
                minlength:10,
                maxlength:10
            }
        },
        messages:
        {
            
        },
        submitHandler: function(form) {
          $('#btn_submit').attr('disabled',true);
          var mobile = $('#mobile').val();
          var id = $('#hdshare').val();
          var link = "{{ url('viewcourse') }}/"+id+"";
          window.location.href='https://api.whatsapp.com/send?phone=+91'+mobile+'&text='+link+'';
        }

    });
}


function getContact(id)
{
    $('#btn_submit').removeAttr('disabled',true);
    $('#mobile').val('');
    $('#hdshare').val(id);
    if (id)
    {
        $('#sharemdl').modal('show');
    }
}

$(document).ready(function(){

    $("#my_range").ionRangeSlider({
        type: "double",
        min: $('#min').val(),
        max: $('#max').val(),
        from: $('#selected_min').val(),
        to: $('#selected_max').val(),
        // grid: true,
        grid_snap: true,
        from_fixed: false,  // fix position of FROM handle
        to_fixed: false,     // fix position of TO handle
        onFinish: function (data) {
            // fired on pointer release
            // submitForm('feesrange');
        },
    });

    $("#my_range1").ionRangeSlider({
        type: "double",
        min: $('#min').val(),
        max: $('#max').val(),
        from: $('#selected_min').val(),
        to: $('#selected_max').val(),
        // grid: true,
        grid_snap: true,
        from_fixed: false,  // fix position of FROM handle
        to_fixed: false,     // fix position of TO handle
        onFinish: function (data) {
            // fired on pointer release
            // submitForm1('feesrange');
        },
    });
});

$(window).bind("load", function() {
    // alert($('#maincourse_id').val()=="");
    /*if ($('#maincourse_id').val()=="")
    {
        alert();
    }*/

    $('#sub_course_dv').addClass('hidden');
    $('#child_course_dv').addClass('hidden');

    //for mobile
    $('#sub_course_dv1').addClass('hidden');
    $('#child_course_dv1').addClass('hidden');

    var maincourse_session ='{{ session('maincourse_session')}}';
    var subcourse_session ='{{ session('subcourse_session')}}';
    var childcourse_session ='{{ session('childcourse_session')}}';
    if (maincourse_session)
    {
        getFilterSubcourse(maincourse_session,subcourse_session,0)
    }

    if (subcourse_session)
    {
        getFilterchildcourse(subcourse_session,childcourse_session,0)
    }
});

function getFilterSubcourse(id,sub_id,type)
{
  // user select mannuelly
  if (type==1)
  {
    id = id.value;
  }

  $('#subcourse_id').html('');
  $('<option/>').val('').html('Select Sub Course').appendTo('#subcourse_id');
  //for mobile
  $('#subcourse_id1').html('');
  $('<option/>').val('').html('Select Sub Course').appendTo('#subcourse_id1');
  if(id != "") {
    $.ajax({
          url:'{{route('class.getFilterSubcourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            console.log(data);
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


function getFilterchildcourse(id,child,type)
{

  // user select mannuelly
  if (type==1)
  {
    id = id.value;
  }

  $('#childcourse_id').html('');
  $('<option/>').val('').html('Select Child Course').appendTo('#childcourse_id');

  //for mobile
  $('#childcourse_id1').html('');
  $('<option/>').val('').html('Select Child Course').appendTo('#childcourse_id1');
  if(id != "") {
    $.ajax({
          url:'{{route('class.getFilterchildcourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
                if ($('#maincourse_id').val()!="")
                {
                    $('#child_course_dv').removeClass('hidden'); 
                    //for mobile  
                    $('#child_course_dv1').removeClass('hidden');   
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
    function submitForm(type)
    {
        /*var type = $('#'+type).val();
        if (type)
        {
        }*/

        var final_url = "";
        var url_maincourse_id = $('#maincourse_id').val();
        var url_maincourse = $('#maincourse_id option:selected').text();
        url_maincourse = url_maincourse.split(" ").join('-');

        var url_subcourse_id = $('#subcourse_id').val();
        var url_subcourse = $('#subcourse_id option:selected').text();
        url_subcourse = url_subcourse.split(" ").join('-');
        
        //convert to slug
        if (url_maincourse_id!="")
        {
            if (url_subcourse_id!="")
            {
                var final_url = '/search-classes/'+url_maincourse+'/'+url_maincourse_id+'/'+url_subcourse+'/'+url_subcourse_id+'';
            }else
            {
                var final_url = '/search-classes/'+url_maincourse+'/'+url_maincourse_id+'';
            }
        }else
        {
            var final_url = '/search-classes';
        }

        $('#filer_frm').attr('action',final_url);

        $('#filer_frm').submit();
    }

    function submitForm1(type)
    {
        var final_url = "";
        var url_maincourse_id = $('#maincourse_id1').val();
        var url_maincourse = $('#maincourse_id1 option:selected').text();
        url_maincourse = url_maincourse.split(" ").join('-');

        var url_subcourse_id = $('#subcourse_id1').val();
        var url_subcourse = $('#subcourse_id1 option:selected').text();
        url_subcourse = url_subcourse.split(" ").join('-');
        
        //convert to slug
        if (url_maincourse_id!="")
        {
            if (url_subcourse_id!="")
            {
                var final_url = '/search-classes/'+url_maincourse+'/'+url_maincourse_id+'/'+url_subcourse+'/'+url_subcourse_id+'';
            }else
            {
                var final_url = '/search-classes/'+url_maincourse+'/'+url_maincourse_id+'';
            }
        }else
        {
            var final_url = '/search-classes';
        }
        $('#filer_frm1').attr('action',final_url);
        $('#filer_frm1').submit();
    }
    
    function setCourseSession(course_id,class_id,url_class_name)
    {
        if (course_id!="")
        {
            $.ajax({
                url:'{{route('search.setCourseSession')}}',
                method:'POST',
                dataType:'JSON',
                data:{course_id:course_id},
                success:function(data)
                {
                    var final_url = "";
                    url_class_name = url_class_name.split(" ").join('-');

                    var url = '{{url('viewcourse')}}';
                    // var url = 'http://127.0.0.1:8000/';
                    // console.log(data);
                    if (class_id!="")
                    {
                        window.location.href = url+'/'+class_id+'/'+url_class_name;
                    }

                }
            });
        }
    }
</script>
@endsection