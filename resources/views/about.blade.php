@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="breadcrumb-title">About Us</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="aboutus ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="main-title">
                        <h2>What Is Oktat ?</h2>
                    </div>
                    <p>An Online Admission Website Or Application Created For Coaching Classes That Help Users To Find The Best Coaching Classes In Their Locality Area. Oktat Is a Bridge Between Coaching Classes And User That Helps Them To Choose The Right Coaching Classes As Per Their Varied Need And Preferences.</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mt-5">
                    <div class="main-title">
                        <h2>Why Oktat ?</h2>
                    </div>
                    <p>We Do Not Just Do The Registration Of Coaching Classes But We Smoothen The End To End Admission Experience Of Student And Enable Them To Take Admission Anytime , Anywhere 24x7.</p>

                    <p>For Clients , Oktat Is The Best Digital Platform To Strengthen The Market And Create Awareness Among Potential Users , About Their Coaching Classes Whereas For Users It Helps Them to Make a Correct And Rational Choice Of Coaching Classes As Per Their Need.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="vision-mission">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="vm-box ">
                        <h3 class="text-blue">Vision</h3>
                        <div>
                            <img src="./edifygo_assets/image/undraw_visionary_technology_re_jfp7.svg" alt="">
                        </div>
                        <div class="visison-text">
                            <p>Achieving Excellence in Education While Building The Bridge Between Students And Knowledgeable Client Or Coaching Classes With An Ultimate Solution.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="vm-box box1">
                        <h3 class="text-blue">Mission</h3>
                        <div>
                            <img src="./edifygo_assets/image/undraw_fitting_piece_re_pxay.svg" alt="">
                        </div>
                        <div class="visison-text">
                            <p>Providing Faithful Education To Learners With a Clear View And Easy Selection Of Coaching Class Around The Community.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="vm-box box2">
                        <h3 class="text-blue">Core Values</h3>
                        <div>
                            <img src="./edifygo_assets/image/undraw_chore_list_re_2lq8.svg" alt="">
                        </div>
                        <div class="visison-text">
                            <p>Providing Great Ease In Admission With Valuable Education.</p>
                        </div>
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
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="how-works-grid work-line">
                        <div class="step">1</div>
                        <div class="icon">
                            <img src="{{asset('edifygo_assets')}}/image/work1.png">
                        </div>
                        <p>Classes Registers their Courses</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="how-works-grid work-line">
                        <div class="step">2</div>
                        <div class="icon">
                            <img src="{{asset('edifygo_assets')}}/image/work2.png">
                        </div>
                        <p>Students Compare and select the best course</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="how-works-grid">
                        <div class="step">3</div>
                        <div class="icon">
                            <img src="{{asset('edifygo_assets')}}/image/work3.png">
                        </div>
                        <p>Student registers and enrolls at the best price</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
