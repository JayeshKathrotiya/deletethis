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
                            <p class="text-break">{{$class->address ? $class->address.",":""}} {{$class->area_name}}, {{$class->city_name}}, {{$class->state_name}}, {{$class->country_name}}</p>
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
                        <!-- <div class="form-header"> -->
                        <h4 class="text-center">Fill Up Your Details</h4>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Class Logo</label>
                                    <br>
                                    <div class="cls-logo">
                                        @if($class->class_logo)
                                            <img src="{{ asset('class_logo/'.$class->class_logo.'')}}" alt="Image not available">
                                        @else
                                            <img src="{{ asset('edifygo_assets')}}/image/classes-logo.png" alt="Image not available">
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>GSTIN</label>
                                    <p>{{$class->gst_no ? $class->gst_no : "N/A"}}</p>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Class Images</label>
                                    <div class="cls-img-list">
                                        @if(!$class->class_imglist->isEmpty())
                                             @foreach($class->class_imglist as $key => $classimg)
                                                <div class="cls-img-grid">
                                                    <img src="{{ asset('class_images/'.$classimg->image.'')}}">
                                                </div>
                                             @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Class Video</label>
                                    <br>
                                    <div style="display:none;" id="class_video1{{$class->id}}">
                                        <video class="lg-video-object lg-html5" controls preload="none">
                                            <source src="{{asset('class_video/'.$class->class_video.'')}}" type="video/mp4">
                                             Your browser does not support HTML5 video.
                                        </video>
                                    </div>
                                     <div class="group-list mt-2" id="group-video">
                                        <a href="" class="group-video" data-html="#class_video1{{$class->id}}">
                                            <img src="{{asset('edifygo_assets')}}/image/videobanner.jpg" width="92px">
                                        </a>                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Ranker Images</label>
                                    <div class="rank-img-list">
                                         @if(!$class->class_rankerlist->isEmpty())
                                            @foreach($class->class_rankerlist as $key => $rankerimg)
                                                <div class="rank-img-grid">
                                                    <div class="rank-img">
                                                        <img src="{{ asset('ranker_images/'.$rankerimg->image.'')}}">
                                                    </div>
                                                    <p>{{$rankerimg->title}}</p>
                                                </div>
                                            @endforeach
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center">
                                    <a href="/create_course" class="btn btn-save">Add Course</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection