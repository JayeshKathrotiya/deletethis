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
            <div class="col-lg-8 col-md-10 col-sm-12">
                <form id="frm_final_enroll" method="POST" action="/student/finalenroll">
                @csrf
            	<div class="reg-form-box">
            		<h4 class="text-center">Admission Details</h4>
            		<div class="row">
            			<div class="col-lg-6 col-md-6 col-sm-12">
            				<div class="form-group">
            					<label>Course Name</label>
            					<p>{{$receipt->name ? $receipt->name : "-"}} - {{$receipt->main_course_name ? $receipt->main_course_name : "-"}}</p>
            				</div>
            			</div>
            			<div class="col-lg-6 col-md-6 col-sm-12">
            				<div class="form-group">
            					<label>Class Name</label>
            					<p>{{$receipt->class_name ? $receipt->class_name : "-"}}</p>
            				</div>
            			</div>
            			<div class="col-lg-6 col-md-6 col-sm-12">
            				<div class="form-group">
            					<label>Address</label>
            					<p>{{$receipt->address ? $receipt->address : "N/A"}}</p>
            				</div>
            			</div>
            			<div class="col-lg-6 col-md-6 col-sm-12">
            				<div class="form-group">
            					<label>Timing</label>
                                <input type="hidden" name="time_slot" id="time_slot" value="{{$receipt->time_slot_id}}">
                                <input type="hidden" name="istrial" id="istrial" value="1">
            					<p>{{$receipt->start_time ? date('g:i A',strtotime($receipt->start_time)) : ""}} To {{$receipt->end_time ? date('g:i A',strtotime($receipt->end_time)) : ""}}</p>
            				</div>
            			</div>
            			<div class="col-lg-12 col-md-12 col-sm-12">
            				<div class="orderdetails-box">
            					<table class="table table-bordered">
            						<tr>
            							<td>Trial Course Fees</td>
            							<td class="text-right">
                                            ₹{{$trial_course_fee ? $trial_course_fee : ""}}
                                        </td>
            						</tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <!-- <button class="btn btn-submit">Pay Now</button> -->
                                            <button type="submit" name="btn_enroll" class="btn btn-submit" id="btn_enroll{{$receipt->id}}">Pay Now</button>
                                        </td>
                                    </tr>            						
            					</table>
            				</div>
            			</div>
            		</div>
            	</div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection