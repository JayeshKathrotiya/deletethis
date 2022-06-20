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
                            <h4 class="text-center">Your Details</h4>
                        <!-- </div> -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <p>{{$class->firstname}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <p>{{$class->lastname}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <p>{{$class->mobile}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <p>{{$class->email}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Class Status</label>
                                    <p>
                                        @if($class->isapprove==0)
                                          <span class="badge badge-warning">Requested</span>
                                        @elseif($class->isapprove==1)
                                          <span class="badge badge-primary">Approved</span>
                                        @elseif($class->isapprove==2)
                                          <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Subscription Status</label>
                                    <p>
                                        @if($class->issubscribe==0)
                                          <span class="badge badge-warning">Pending</span>
                                        @elseif($class->issubscribe==1)
                                          <span class="badge badge-primary">Subscribed</span>
                                        @elseif($class->issubscribe==2)
                                          <span class="badge badge-info">Skipped</span>
                                        @elseif($class->issubscribe==3)
                                          <span class="badge badge-danger">Expired</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Subscription Price</label>
                                    <p>
                                        ₹ {{$class->issubscribe==1 ? $class->subscription_price:"N/A"}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Subscription Date</label>
                                    <p>
                                        <!-- {{$class->issubscribe==1 ? date('d-m-Y g:i:s A',strtotime($class->subscription_date)):"N/A"}} -->
                                        N/A
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Subscription Expire Date</label>
                                    <p>
                                        <!-- {{$class->issubscribe==1 ? date('d-m-Y g:i:s A',strtotime($class->subscription_expire)):"N/A"}} -->
                                        N/A
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center mt-4">
                                    <a href="/edit_profile" class="btn btn-submit">Edit Profile</a>
                                    @if($class->issubscribe!=1)
                                    <a href="/payment" class="btn btn-submit">Make Payment</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection