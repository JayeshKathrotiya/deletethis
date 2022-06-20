@extends('edifygoclass.layout')
@section('contents')

    <section class="breadcrumb-banner overlay" style="background-image: url('{{asset('edifygo_assets')}}/image/breadcrumb-banner.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                                    <p>{{$student->firstname}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <p>{{$student->lastname}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <p>{{$student->address}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <p>{{$student->mobile}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <p>{{$student->email}}</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>School Name</label>
                                    <p>{{$student->schoolname ? $student->schoolname : "N/A"}}</p>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center mt-4">
                                    <a href="/student/edit_profile" class="btn btn-submit">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection