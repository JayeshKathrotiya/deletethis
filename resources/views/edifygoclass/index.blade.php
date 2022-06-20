@extends('edifygoclass.layout')
@section('contents')
    <section class="main-slider">
        <div class="owl-carousel owl-theme" id="main-slider">
            @if (!$exclusive_slider->isEmpty())
                @foreach ($exclusive_slider as $key => $value)
                    <div class="item">
                        <a href="{{ url('viewcourse/' . $value->class_id) }}">
                            <div class="slider-bg"
                                style="background-image: url('{{ asset('home_slider_img') }}/{{ $value->image }}')">
                                <div class="slider-status">
                                    Exclusive
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif

        </div>
        <!-- div.searchform -->
    </section>

    <section class="search-class">
        <div class="container">
            <div class="row m-auto">
                <div class="col-lg-6 col-md-12 col-sm-12  d-flex justify-content-center">
                    <form method="POST" action="" class="form-box" id="searchfrm">
                        @csrf
                        <div class="row pt-5">
                            <label class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <h4 class="heading-text"><b>Your search for the Ideal coaching classes ends
                                        here</b></h4>
                            </label>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group pt-3">
                                    <select class="form-control" id="maincourse_id" name="maincourse_id">
                                        <option value="">Select Main Course</option>
                                        @if (!empty($categories))
                                            @foreach ($categories as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" id="area" name="area">
                                        <option value="">Select Location</option>
                                        @if (!empty($location))
                                            @foreach ($location as $value)
                                                <option value="{{ $value->id }}">
                                                    {{ $value->area_name }},{{ $value->city_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- <button type="submit">Search</button> -->
                                <a class="btn btn-search px-4 py-2 " href="javascript:submitForm()">Search</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="./edifygo_assets/image/Mobile inbox-pana (1).svg" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">Pay Less, Get More Value</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advertisement" <?php if(!empty($promocode_slider)){?>
        style="background-image: url('{{ asset('promocode_slider_img') }}/{{ $promocode_slider->image }}');"
        <?php }?>>
        <div class="container">
            <!-- <form method="POST" action="/search_classes" class="form-box">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-md-12 col-sm-12">All Type of Classes Near By You</label>
                                            <div class="col-lg-5 col-md-4 col-sm-12">
                                                <select class="form-control" id="maincourse_id" name="maincourse_id">
                                                    <option value="">Select Main Course</option>
                                                    @if (!empty($categories))
    @foreach ($categories as $value)
    <option value="{{ $value->id }}">{{ $value->name }}</option>
    @endforeach
    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-5 col-md-4 col-sm-12">
                                                <select class="form-control" id="area" name="area">
                                                    <option value="">Select Location</option>
                                                    @if (!empty($location))
    @foreach ($location as $value)
    <option value="{{ $value->id }}">{{ $value->area_name }},{{ $value->city_name }}</option>
    @endforeach
    @endif
                                                </select>
                                            </div>
                                            <div class="col-lg-2 col-md-4 col-sm-12">
                                                <button type="submit" class="btn btn-search">Search</button>
                                            </div>
                                        </div>
                                    </form> -->
        </div>
    </section>

    <section class="course-category">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-title">
                        <p class="text-center">Multiple course categories to choose from</p>
                        <h2 class="text-center">Courses Categories</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme owl-navigation" id="coursecat-slider">
                        @if (!empty($categories_slider))
                            @foreach ($categories_slider as $key => $value1)
                                <div class="item">
                                    <div class="coursecat-bg"
                                        style="background-image: url('{{ asset('category_slider_img') }}/{{ $value1->image }}')">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="courses">
        <div class="course-features">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-title">
                            <h2 class="text-center">Features</h2>
                            <h3 class="text-center">Featured at Oktat</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="owl-carousel owl-theme owl-navigation" id="courses-slider">
                            @if (!empty($feature_slider))
                                @foreach ($feature_slider as $key => $value2)
                                    <div class="item">
                                        <a class="course-blog" href="{{ url('viewcourse/' . $value2->class_id) }}">
                                            <div class="course-img" <?php if(!empty($value2->image)) { ?>
                                                style="background-image: url('{{ asset('feature_slider_img/' . $value2->image) }}')"
                                                <?php } else { ?>
                                                style="background-image: url('{{ asset('class_logo/' . $value2->class_logo) }}')"
                                                <?php } ?>>

                                            </div>
                                            <div class="course-details">
                                                <h5>{{ $value2->name }}</h5>
                                                <p>{{ $value2->area_name }},{{ $value2->city_name }}</p>
                                            </div>
                                            <div class="course-price">
                                                <div class="cprice">
                                                    @if ($value2->class != null)
                                                        Admission<br />@
                                                        {{ $value2->class->admission_fees_selection_value_final }}
                                                    @endif
                                                </div>
                                                <div class="cdiscount">
                                                    upto <br>
                                                    <strong>
                                                        @if ($value2->class != null)
                                                            {{ $value2->class->student_original_discount_per }}
                                                        @endif%
                                                    </strong> off
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- <section class="advertisement" style="display: none;">
                            <div class="owl-carousel owl-theme" id="advertisement-slider">
                                <div class="item">
                                    <div class="adv-bg" style="background-image: url('{{ asset('edifygo_assets') }}/image/adv3.png')">

                                    </div>
                                </div>
                                <div class="item">
                                    <div class="adv-bg" style="background-image: url('{{ asset('edifygo_assets') }}/image/adv3.png')">

                                    </div>
                                </div>
                            </div>
                        </section> -->

    <section class="promoters">
        {{-- <svg viewBox="0 0 500 500"
            preserveAspectRatio="xMinYMin meet"
            style="z-index: -2;">

            <path d="M0, 100 C150, 200 350,
                0 500, 100 L500, 00 L0, 0 Z"
                style="stroke: none;
                fill:#0977B2;">
            </path>
        </svg> --}}

        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="main-title">
                        <h2 class="text-center pt-5 ">Promoters</h2>
                        <h3 class="text-center">People's Favourite</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme owl-dotnavigation" id="promoters-slider">
                    @if (!empty($promoter_slider))
                        @foreach ($promoter_slider as $key => $value5)
                            <div class="item">
                                <a class="promoters-block" href="{{ url('viewcourse/' . $value5->class_id) }}">

                                    <div class="promoters-img"
                                        style="background-image: url('@if (!empty($value5->image)) {{ asset('promoter_slider_img/' . $value5->image) }} @else {{ asset('class_logo/' . $value5->class_logo) }} @endif');">
                                    </div>

                                    <div class="promoters-details ">
                                        <h6>{{ $value5->name }}</h6>
                                        <p>{{ $value5->area_name }},{{ $value5->city_name }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="upcomming-course">
        <div>
            <h2 class="side-title d-flex">Newly Added  </h2>
        </div>
            <div id="arrowAnim">
                <div class="arrowSliding">
                  <div class="arrow"></div>
                </div>
                <div class="arrowSliding delay1">
                  <div class="arrow"></div>
                </div>
                <div class="arrowSliding delay2">
                  <div class="arrow"></div>
                </div>
                {{-- <div class="arrowSliding delay3">
                  <div class="arrow"></div>
                </div> --}}

        </div>



        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">"Knowledge is the power" - Great Saint</h2>
                        <h3 class="text-center">Welcome to Oktat</h3>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="owl-carousel owl-theme owl-dotnavigation" id="upcomming-course-slider">
                        @if (!empty($newly_slider))
                            @foreach ($newly_slider as $key => $value3)
                                <div class="item">
                                    <a class="upcoming-block" href="{{ url('viewcourse/' . $value3->class_id) }}">
                                        <div class="upcoming-img"
                                            style="background-image: url('@if (!empty($value3->image)) {{ asset('newly_slider_img/' . $value3->image) }} @else {{ asset('class_logo/' . $value3->class_logo) }} @endif');">
                                        </div>

                                        <div class="upcoming-desc">
                                            <div class="uprating">
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
                                                        $rate = round($value3->rating_sum / ($value3->rating_count ? $value3->rating_count : 1));
                                                        // echo $rate."<br/>";
                                                        ?>

                                                        @if ($rate <= 0)
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
                                                <span>( {{ $value3->review_count }} Review )</span>
                                            </div>
                                            <h5>{{ $value3->name }}</h5>
                                            <div class="upcoming-user">
                                                <!-- <div class="upuser">
                                                                    <img src="@if (!empty($value3->image)) {{ asset('class_logo/' . $value3->class_logo) }} @else {{ asset('edifygo_assets') }}/image/classes-logo.png}} @endif">
                                                                </div> -->
                                                <div class="upname">
                                                    <p>{{ $value3->firstname }} {{ $value3->lastname }}</p>
                                                </div>
                                                <div class="upprice">
                                                    @if ($value3->class != null)
                                                        <strike>₹ {{ $value3->class->price }}</strike>
                                                    @endif
                                                    <br>
                                                    @if ($value3->class != null)
                                                        <span>₹ {{ $value3->class->student_addmission_fees }} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-works">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">How it works</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="how-works-grid work-line">
                        <div class="step">1</div>
                        <div class="icon">
                            <img src="{{ asset('edifygo_assets') }}/image/work1.png">
                        </div>
                        <p class="">Classes Registers their Courses</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="how-works-grid work-line">
                        <div class="step">2</div>
                        <div class="icon">
                            <img src="{{ asset('edifygo_assets') }}/image/work2.png">
                        </div>
                        <p>Students Compare and select the best course</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="how-works-grid">
                        <div class="step">3</div>
                        <div class="icon">
                            <img src="{{ asset('edifygo_assets') }}/image/work3.png">
                        </div>
                        <p>Student registers and enrolls at the best price</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="sponsored">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">Sponsored</h2>
                        <h3 class="text-center">Your Best Course at Oktat</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="owl-carousel owl-theme owl-dotnavigation" id="sponsored-slider">

                    @if (!empty($sponsored_slider))
                        @foreach ($sponsored_slider as $key => $value4)
                            <div class="item">
                                <div class="col-md-12">
                                    <a style="cursor: pointer;"
                                        onclick="javascript:setCourseSession({{ $value4->course_id }},{{ $value4->class_id }},'{{ $value4->name }}')"
                                        class="sponsored-block">
                                        <!-- <img class="card-img-top" src="@if (!empty($value4->image)) {{ asset('class_logo/' . $value4->image) }} @else {{ asset('edifygo_assets') }}/image/classes-logo.png @endif" alt="Card image cap"> -->

                                        <div class="sponsored-img"
                                            style="background-image: url('@if (!empty($value4->image)) {{ asset('sponsored_slider_img/' . $value4->image) }} @else {{ asset('class_logo/' . $value4->class_logo) }} @endif');">
                                        </div>

                                        <div class="sponsored-details">
                                            <h6 class="stitle">
                                                @if (!empty($value4->child_course_name))
                                                    {{ $value4->child_course_name }}
                                                @else
                                                    {{ $value4->sub_course_name }}
                                                @endif
                                            </h6>

                                            <p class="scomp">{{ $value4->name }}</p>
                                            <p class="sprice">
                                                @if ($value4->price != $value4->student_addmission_fees)
                                                    <strike>₹ {{ $value4->price }}</strike>
                                                    <span class="aprice">₹ {{ $value4->student_addmission_fees }}</span>
                                                    <span class="peroff">{{ $value4->student_original_discount_per }}%
                                                        off</span>
                                                @else
                                                    <span class="aprice">₹ {{ $value4->student_addmission_fees }}</span>
                                                @endif
                                            </p>
                                            <p class="adm">Get Admission @
                                                {{ $value4->admission_fees_selection_value_final }} only</p>

                                            <div class="slocation">
                                                <i class="fa fa-map-marker"></i> {{ $value4->area_name }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="students-quotes">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">Why Students Love us?</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="owl-carousel owl-theme owl-navigation" id="stud-quotes">
                        @if (!$testimonial->isEmpty())
                            @foreach ($testimonial as $key => $testi)
                                <div class="item">
                                    <div class="quotes-box">
                                        <div class="quotes-img"
                                            style="background-image: url('{{ asset('testimonial') }}/{{ $testi->image }}')">

                                        </div>
                                        <div class="quotes-desc">
                                            <p>{{ $testi->description }}</p>
                                            <h6>{{ $testi->title }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contactus">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-sm-12">
                    <div class="contact-desc">
                        <h5>What Is Oktat ?</h5>
                        <p>An Online Admission Website Or Application Created For Coaching Classes That Help Users To Find
                            The Best Coaching Classes In Their Locality Area. Oktat Is a Bridge Between Coaching Classes And
                            User That Helps Them To Choose The Right Coaching Classes As Per Their Varied Need And
                            Preferences.</p>
                        <h5>Why Oktat ?</h5>
                        <p>We Do Not Just Do The Registration Of Coaching Classes But We Smoothen The End To End Admission
                            Experience Of Student And Enable Them To Take Admission Anytime , Anywhere 24x7.</p>
                        <p>For Clients , Oktat Is The Best Digital Platform To Strengthen The Market And Create Awareness
                            Among Potential Users , About Their Coaching Classes Whereas For Users It Helps Them to Make a
                            Correct And Rational Choice Of Coaching Classes As Per Their Need.</p>
                    </div>
                    <div>
                        {{-- <img src="./edifygo_assets/image/Mention-amico.svg" alt=""> --}}
                        <img src="./edifygo_assets/image/phone.svg" alt="">

                    </div>
                </div>

                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="main-title">
                                    <h2>Contact Us</h2>
                                    <p>Fill the details to Register & Get a call back from our team</p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="class-tab" data-toggle="tab" href="#class"
                                            role="tab" aria-controls="class" aria-selected="true"
                                            onclick="javascript:setNull()">Class</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="stud-tab" data-toggle="tab" href="#stud"
                                            role="tab" aria-controls="stud" aria-selected="false"
                                            onclick="javascript:setNull()">Students</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="class" role="tabpanel"
                                        aria-labelledby="class-tab">
                                        <form id="cl_contact_frm" method="POST" action="/contact-us">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="Name" maxlength="20">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="classname" id="classname"
                                                    class="form-control" placeholder="Class Name" maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Email ID" maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="mobile" id="mobile" class="form-control"
                                                    placeholder="Mobile No." maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="cl_contact_city">
                                                    <option value="">Select City</option>
                                                    @if (!empty(session('all_city_session')))
                                                        @foreach (session('all_city_session') as $c => $cc)
                                                            <option value="{{ $cc->id }}">{{ $cc->city_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="cl_know">
                                                    <option value="">How you know about us?</option>
                                                    @if ($know_us)
                                                        @foreach ($know_us as $kk)
                                                            <option value="{{ $kk->id }}">{{ $kk->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control resize" rows="3" placeholder="Any message?" name="cl_msg" maxlength="500"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="isclass" id="isclass" value="1">
                                                <button class="btn btn-submit" name="btn_cl_submit" id="btn_cl_submit"
                                                    value="1">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="stud" role="tabpanel"
                                        aria-labelledby="stud-tab">
                                        <form id="stud_contact_frm" method="POST" action="contact-us">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="stud_name" id="stud_name"
                                                    class="form-control" placeholder="Name" maxlength="20">
                                            </div>
                                            <!-- <div class="form-group">
                                                                    <input type="text" name="" class="form-control" placeholder="Class">
                                                                </div> -->
                                            <div class="form-group">
                                                <input type="text" name="stud_email" id="stud_email"
                                                    class="form-control" placeholder="Email ID" maxlength="50">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="stud_mobile" id="stud_mobile"
                                                    class="form-control" placeholder="Mobile No." maxlength="10">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="stud_contact_city">
                                                    <option value="">Select City</option>
                                                    @if (!empty(session('all_city_session')))
                                                        @foreach (session('all_city_session') as $c => $cc)
                                                            <option value="{{ $cc->id }}">{{ $cc->city_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="stud_know">
                                                    <option value="">How you know about us?</option>
                                                    @if ($know_us)
                                                        @foreach ($know_us as $kk)
                                                            <option value="{{ $kk->id }}">{{ $kk->title }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control resize" rows="3" placeholder="Any message?" name="stud_msg" maxlength="500"></textarea>
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="hidden" name="isclass" id="isclass" value="0">
                                                <button class="btn btn-submit" name="btn_stud_submit"
                                                    id="btn_stud_submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blogs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-title">
                        <h2 class="text-center">Blogs</h2>
                    </div>
        </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="owl-carousel owl-theme owl-navigation" id="blog-slider">
                        @if ($blogs)
                            @foreach ($blogs as $b => $blog)
                                <div class="item">
                                    <a class="blog-grid" href="/viewblog/{{ $blog->id }}">
                                        <div class="blog-img"
                                            style="background-image: url('{{ asset('blogs/' . $blog->image . '') }}')">
                                        </div>
                                        <div class="blog-details">
                                            <h5>{{ $blog->question }}</h5>
                                            <!-- <div class="blogdesc"><?php echo $blog->description; ?></div> -->
                                            <div class="blog_footer">
                                                <p class="author">{{ $blog->title }}</p>
                                                <p class="date">{{ date('d M Y', strtotime($blog->date)) }}</p>
                                            </div>

                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>


                <!-- @if ($blogs)
    @foreach ($blogs as $b => $blog)
    <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="blog-grid">
                                                    <div class="blog-img" style="background-image: url('{{ asset('blogs/' . $blog->image . '') }}')">
                                                    </div>
                                                    <div class="blog-details">
                                                        <h5>{{ $blog->question }}</h5>
                                                        <p class="desc">{{ $blog->description }}</p>

                                                        <p class="author">{{ $blog->title }}</p>
                                                        <p class="date">{{ date('d M Y', strtotime($blog->date)) }}</p>
                                                    </div>
                                                </div>
                                            </div>
    @endforeach
    @endif -->
            </div>
        </div>
    </section>

    <section class="download-app">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <img src="{{ asset('edifygo_assets') }}/image/mobile.png" class="mobile">
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="download-content">
                        <h2><b>“Education is not preparation for life<br> education is life itself !”</b></h2>

                        <!-- <img src="{{ asset('edifygo_assets') }}/image/appstore.png"> -->
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.techhive.oktat"><img
                                src="{{ asset('edifygo_assets') }}/image/playstore.png"></a>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <img src="./edifygo_assets/image/Tablet login-pana (1).svg" alt="">
                </div>
                <div class="col-lg-6">
                    <div class="download-content">
                        <h2 class=" text-center"><b>“Education is not preparation for life education is life
                                itself !”</b></h2>
                    </div>
                    <div class="payment text-center">
                       <img src="{{ asset('edifygo_assets') }}/image/appstore.png">
                        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.techhive.oktat"><img
                                src="{{ asset('edifygo_assets') }}/image/playstore.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- model -->
    <div class="modal fade" id="indexmdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cat_countryel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/class/check_login" method="POST" id="valid_login" name="valid_login">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="reg-form-box">
                                    <!-- <h4 class="text-center">Login</h4> -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Login As</label>
                                                <br />
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="class1" value="0" name="loginas"
                                                        checked="">
                                                    <label for="class1">Class</label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="student" value="1" name="loginas">
                                                    <label for="student">Student</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email or Mobile</label>
                                                <input type="text" name="username" id="username"
                                                    class="form-control" placeholder="Email Or Mobile*" maxlength="50">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Password*" maxlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>New to OKTAT ? <a id="signup" href="/class/registration"
                                                        class="text-blue">
                                                        Sign Up</a></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_submit" class="btn btn-submit">LOGIN</button>
                        <button type="button" class="btn btn-secondary text-uppercase"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //class validation
        $(document).ready(function() {
            $('#cl_contact_frm').validate({
                rules: {
                    name: {
                        required: true,
                        validname: true,
                        space: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    classname: {
                        required: true,
                        space: true,
                        minlength: 1,
                        maxlength: 50,
                    },
                    email: {
                        required: true,
                        email: true,
                        space: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    mobile: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    cl_contact_city: {
                        required: true
                    },
                    cl_know: {
                        required: true
                    },
                    cl_msg: {
                        required: true,
                        space: true,
                        minlength: 5,
                        maxlength: 500,
                    }
                },
                messages: {

                },
                submitHandler: function(form) {
                    form.submit();
                    $('#btn_cl_submit').attr('disabled', true);
                }
            });

            $('#stud_contact_frm').validate({
                rules: {
                    stud_name: {
                        required: true,
                        validname: true,
                        space: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    stud_email: {
                        required: true,
                        email: true,
                        space: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    stud_mobile: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    stud_contact_city: {
                        required: true
                    },
                    stud_know: {
                        required: true
                    },
                    stud_msg: {
                        required: true,
                        space: true,
                        minlength: 5,
                        maxlength: 500,
                    }
                },
                messages: {

                },
                submitHandler: function(form) {
                    form.submit();
                    $('#btn_stud_submit').attr('disabled', true);
                }
            });
        });

        $(window).on("load", function() {
            myFunction();
        });

        function myFunction() {
            /*var url = '{{ url()->current() }}';
            var route = '{{ url('/') }}';*/
            var student_url = '{{ session('student_login_session_id') }}';
            var class_url = '{{ session('class_login_session_id') }}';
            var isopenmdl = 0;
            if (student_url == "" && class_url == "" && isopenmdl == 0) {
                isopenmdl = 1;
                setTimeout(function() {
                    $('#indexmdl').modal('show');
                }, 30000);

            }
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function setCourseSession(course_id, class_id, url_class_name) {
            if (course_id != "") {
                $.ajax({
                    url: '{{ route('search.setCourseSession') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        course_id: course_id
                    },
                    success: function(data) {
                        var final_url = "";
                        url_class_name = url_class_name.split(" ").join('-');

                        var url = '{{ url('viewcourse') }}';
                        // var url = 'http://127.0.0.1:8000/';
                        // console.log(data);
                        if (class_id != "") {
                            window.location.href = url + '/' + class_id + '/' + url_class_name;
                        }
                    }
                });
            }
        }

        function setNull() {
            // $('#')
        }

        function submitForm() {
            var final_url = "";
            var url_maincourse_id = $('#maincourse_id').val();
            var url_maincourse = $('#maincourse_id option:selected').text();
            url_maincourse = url_maincourse.split(" ").join('-');

            //convert to slug
            if (url_maincourse_id != "") {
                var final_url = '/search-classes/' + url_maincourse + '/' + url_maincourse_id + '';
            } else {
                var final_url = '/search-classes';
            }
            $('#searchfrm').attr('action', final_url);
            $('#searchfrm').submit();
        }
    </script>
@endsection
