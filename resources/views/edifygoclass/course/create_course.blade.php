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
                            <p class="text-break">{{$class->address ? $class->address."," : ""}} {{$class->area_name}}, {{$class->city_name}} {{$class->state_name}}, {{$class->country_name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="valid_course" method="POST" action="/add_course" enctype="multipart/form-data">
        @csrf
        <section class="registeration">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-112 col-sm-12">
                        <div class="reg-form-box">
                                <h4 class="text-center">Fill Up Your Details</h4>
                            <!-- <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group position-relative">
                                        <label>Course Name </label> <span class="req-star text-danger"> *</span>
                                        <input type="text" name="course_name" id="course_name" maxlength="50" class="form-control" placeholder="Course Name">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Main Course</label> <span class="req-star text-danger"> *</span>
                                        <select class="form-control" id="maincourse_id" name="maincourse_id" onchange="getSubcourse(this)">
                                            <option value="">Select</option>
                                            @if(!empty($main_courses))
                                              @foreach ($main_courses as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                              @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Sub Course</label> <span class="req-star text-danger"> *</span>
                                        <select class="form-control" id="subcourse_id" name="subcourse_id" onchange="getchildcourse(this)">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12" id="dv_child_course"></div>
                                <div class="w-100"></div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Batch Type</label> <span class="req-star text-danger"> *</span>
                                        <br>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="regular" value="0" name="batch_type" checked="">
                                            <label for="regular">Regular</label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="trial" value="1" name="batch_type">
                                            <label for="trial">Trial</label>
                                       </div>
                                       <div class="radio radio-inline">
                                            <input type="radio" id="na" value="2" name="batch_type">
                                            <!-- <label for="na">NA</label> -->
                                            <label for="na">Both</label>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Batch For</label> <span class="req-star text-danger"> *</span>
                                        <br>
                                        <div class="radio radio-info radio-inline">
                                            <input type="radio" id="female" value="0" name="batch_for" checked="">
                                            <label for="female">Female</label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="male" value="1" name="batch_for">
                                            <label for="male">Male</label>
                                       </div>
                                       <div class="radio radio-inline">
                                            <input type="radio" id="na1" value="2" name="batch_for">
                                            <!-- <label for="na1">NA</label> -->
                                            <label for="na1">Both</label>
                                       </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Description</label> <span class="req-star text-danger"> *</span>
                                        <textarea class="form-control resize" rows="6" placeholder="Description about the course" name="description" id="description" maxlength="1000"></textarea>
                                    </div>
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Material Provided</label> <span class="req-star text-danger"> *</span>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="material_yes" value="1" name="material" checked="">
                                            <label for="material_yes">Yes</label>
                                       </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="material_no" value="0" name="material">
                                            <label for="material_no">No</label>
                                       </div>
                                       <div class="radio radio-inline">
                                            <input type="radio" id="material_na" value="2" name="material">
                                            <label for="material_na">NA</label>
                                       </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Certification Provided</label> <span class="req-star text-danger"> *</span>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="certificate_yes" value="1" name="cartificate" checked="">
                                            <label for="certificate_yes">Yes</label>
                                       </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="certificate_no" value="0" name="cartificate">
                                            <label for="certificate_no">No</label>
                                       </div>
                                       <div class="radio radio-inline">
                                            <input type="radio" id="certificate_na" value="2" name="cartificate">
                                            <label for="certificate_na">NA</label>
                                       </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row datetime-grid">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="datetime1">From Date</label> <span class="req-star text-danger">*</span>
                                      <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" id="datetime1" name="datetime1"/>
                                          <div class="input-group-append one_date" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="datetime2">To Date</label> <span class="req-star text-danger">*</span>
                                      <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" id="datetime2" name="datetime2" />
                                          <div class="input-group-append two_date" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="notes">24 Hours Time Format[E.g: 13:00 To 15:00]</p>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-5 col-5">
                                            <div class="form-group mb-0">
                                                <label>Start Timing</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-5 col-5">
                                            <div class="form-group mb-0 ml-1">
                                                <label>End Timing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row mre">
                                            <div class="col-lg-1 col-md-2 col-2 mls">
                                                <input type="text" class="form-control course_time_starttimeH" placeholder="00" name="starttimeH1" id="starttimeH1" maxlength="2">
                                            </div>
                                            <div class="timecolon">
                                                :
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-2">
                                                <input type="text" class="form-control course_time_starttimeM" placeholder="00" name="starttimeM1" id="starttimeM1" maxlength="2">
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-2 mle">
                                                <input type="text" class="form-control course_time_endtimeH" placeholder="00" name="endtimeH1" id="endtimeH1" maxlength="2">
                                            </div>
                                            <div class="timecolon">
                                                :
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-2">
                                                <input type="text" class="form-control course_time_endtimeM" placeholder="00" name="endtimeM1" id="endtimeM1" maxlength="2">
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-2 pl-0">
                                                <input type="hidden" name="hdarrtime" id="hdarrtime">
                                                <input type="hidden" name="hdarrtime_length" id="hdarrtime_length" value="0">
                                                <a href="javascript:addCourseTime()" class="btn btn-add">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="add_course_time"></div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Seat Available</label> <span class="req-star text-danger"> *</span>
                                        <br>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="seat_yes" value="1" name="seat" checked="">
                                            <label for="seat_yes">Yes</label>
                                       </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="seat_no" value="0" name="seat">
                                            <label for="seat_no">No</label>
                                       </div>
                                    </div>
                                </div>                                
                                <div class="w-100"></div>
                               <!--  <div class="col-md-12">
                                    <table class="table form-group price-cal-table">
                                        <thead>
                                            <tr>
                                                <th class="w-250 p-0"><label>Price ₹</label> <span class="req-star text-danger"> *</span></th>
                                                <th></th>
                                                <th class="w-250 text-center"><label>Owner Service Charges</label></th>
                                                <th class="w-250"><label>Client Discount(%) (Optional)</label></th>
                                                <th></th>
                                                <th class="w-250 text-center"><label>Final Price</label></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="w-250 p-0">
                                                    <input type="text" name="price" id="price" maxlength="6" class="form-control" placeholder="Net Price" onkeyup="javascript:getOwnerCharge(1)">
                                                </td>
                                                <td class="text-center">-</td>
                                                <td class="w-250 text-center">
                                                    <label class="mt-10" id="owner_charge"></label>
                                                    <input type="hidden" name="hdowner_charge" id="hdowner_charge">
                                                    <input type="hidden" name="hdowner_charge_per" id="hdowner_charge_per">
                                                </td>
                                                <td class="w-250">
                                                    <input type="text" name="client_descount" id="client_descount" class="form-control" placeholder="Client Discount" maxlength="3" onkeyup="javascript:getOwnerCharge(0)">
                                                </td>
                                                <td class="text-center">=</td>
                                                <td class="w-250 text-center">
                                                    <label class="mt-10" id="calculated_price"></label>
                                                    <input type="hidden" name="hdcalculated_price" id="hdcalculated_price">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group position-relative calc-dash">
                                        <label>Price ₹ </label> <span class="req-star text-danger"> *</span>
                                        <input type="text" name="price" id="price" maxlength="6" class="form-control" placeholder="Net Price" onkeyup="javascript:getOwnerCharge(1)">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group text-center position-relative calc-dash">
                                        <label>Owner Service Charges</label>
                                        <br>                                    
                                        <label class="mt-10 side-left">₹ <span id="owner_charge"></span></label>
                                        <input type="hidden" name="hdowner_charge" id="hdowner_charge">
                                        <input type="hidden" name="hdowner_charge_per" id="hdowner_charge_per">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Client Discount(%) (Optional)</label>
                                        <input type="text" name="client_descount" id="client_descount" class="form-control side-left" placeholder="Client Discount" maxlength="3" onkeyup="javascript:getOwnerCharge(0)">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="form-group position-relative calc-equal">
                                        <label>Final Price</label>
                                        <br>
                                        <label class="mt-10 side-left">₹ <span id="calculated_price"></span></label>
                                        <input type="hidden" name="hdcalculated_price" id="hdcalculated_price">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Admission Fees Selection</label> <span class="req-star text-danger"> *</span>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <select class="form-control" onchange="javascript:setFeeSelection(this)" name="feeselect" id="feeselect">
                                                    <option value="">Select</option>
                                                    <option value="0">(%)</option>
                                                    <option value="1">Fixed</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-9 col-md-6 col-sm-12 dvfeemin_amount" id="hdper">
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="fee_select_type0_25" value="25" name="fee_select_per" checked="">
                                                    <label for="fee_select_type0_25">25%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="fee_select_type0_35" value="35" name="fee_select_per">
                                                    <label for="fee_select_type0_35">35%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="fee_select_type0_50" value="50" name="fee_select_per">
                                                    <label for="fee_select_type0_50">50%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="fee_select_type0_65" value="65" name="fee_select_per">
                                                    <label for="fee_select_type0_65">65%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="fee_select_type0_100" value="100" name="fee_select_per">
                                                    <label for="fee_select_type0_100">100%</label>
                                               </div>
                                            </div>
                                            <div class="col-lg-9 col-md-6 col-sm-12 dvfeemin_amount" id="hdauto"></div>
                                        </div>
                                    </div>
                                    <p class="notes">Select either fixed money structure of percentage</p>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <!-- <label>Exclusive</label> -->
                                        <br>
                                        <div class="checkbox checkbox-primary checkbox-inline">
                                            <input type="checkbox" id="exclusive" name="exclusive" value="1">
                                            <label for="exclusive"> Exclusive </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group position-relative">
                                        <label>No Of Students</label> <span class="req-star text-danger"> *</span>
                                        <input type="text" name="no_of_students" id="no_of_students" maxlength="2" class="form-control ex_input" placeholder="No Of Students">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group">
                                      <label for="expiry_date">Expiry Date</label> <span class="req-star text-danger">*</span>
                                      <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input ex_input" data-target="#datetimepicker3" id="expiry_date" name="expiry_date" />
                                          <div class="input-group-append ex_date" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group position-relative">
                                        <label>Exclusive Charge(%)</label>
                                        <div class="form-control">{{$setting->exclusive_charge_per}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12"></div>
                                <div class="col-lg-3 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group position-relative">
                                        <label>Owner Service Charges</label>
                                        <br>                                    
                                        <label class="mt-10">₹ <span id="ex_owner_charge"></span></label>
                                        <input type="hidden" name="ex_hdowner_charge" id="ex_hdowner_charge">
                                        <input type="hidden" name="ex_hdowner_charge_per" id="ex_hdowner_charge_per">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group">
                                        <label>Client Discount(%) (Optional)</label>
                                        <input type="text" name="ex_client_descount" id="ex_client_descount" class="form-control ex_input" placeholder="Client Discount" maxlength="3" onkeyup="javascript:getOwnerCharge(0)">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 exclusivedv">
                                    <div class="form-group position-relative">
                                        <label>Final Price</label>
                                        <br>
                                        <label class="mt-10" id="ex_calculated_price"></label>
                                        <input type="hidden" name="ex_hdcalculated_price" id="ex_hdcalculated_price">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 exclusivedv">
                                    <div class="form-group">
                                        <label>Admission Fees Selection</label> <span class="req-star text-danger"> *</span>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <select class="form-control ex_input" onchange="javascript:setExFeeSelection(this)" name="ex_feeselect" id="ex_feeselect">
                                                    <option value="">Select</option>
                                                    <option value="0">(%)</option>
                                                    <option value="1">Fixed</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-9 col-md-6 col-sm-12 ex_dvfeemin_amount" id="ex_hdper">
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="ex_fee_select_type0_25" value="25" name="ex_fee_select_per" checked="">
                                                    <label for="ex_fee_select_type0_25">25%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="ex_fee_select_type0_35" value="35" name="ex_fee_select_per">
                                                    <label for="ex_fee_select_type0_35">35%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="ex_fee_select_type0_50" value="50" name="ex_fee_select_per">
                                                    <label for="ex_fee_select_type0_50">50%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="ex_fee_select_type0_65" value="65" name="ex_fee_select_per">
                                                    <label for="ex_fee_select_type0_65">65%</label>
                                               </div>
                                               <div class="radio radio-inline">
                                                    <input type="radio" id="ex_fee_select_type0_100" value="100" name="ex_fee_select_per">
                                                    <label for="ex_fee_select_type0_100">100%</label>
                                               </div>
                                            </div>
                                            <div class="col-lg-9 col-md-6 col-sm-12 ex_dvfeemin_amount" id="ex_hdauto"></div>
                                        </div>
                                    </div>
                                    <p class="notes">Select either fixed money structure of percentage</p>
                                </div>

                                <!-- <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="hdarrpdf" id="hdarrpdf">
                                    <input type="hidden" name="hdarrpdf_length" id="hdarrpdf_length" value="0">
                                    <div class="form-group">
                                        <label>Upload Files</label>
                                        <a href="javascript:addCoursePdf()" class="btn btn-add ml-2">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    
                                    <div id="add_course_pdf"></div>

                                    <p class="notes">Only PDF Files, Max 5 Files ,limit of 10MB per PDF</p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" name="hdarrtube" id="hdarrtube">
                                    <input type="hidden" name="hdarrtube_length" id="hdarrtube_length" value="0">
                                    <div class="form-group">
                                        <label>Upload Youtube Videos</label>
                                        <a href="javascript:addCourseTube()" class="btn btn-add ml-2">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div id="add_course_tube"></div>
                                    <p class="notes">Max 5 URls</p>
                                </div> -->
                                <div class="col-md-12 col-md-12 col-md-12">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Course Image Selection</label>
                                                <br>
                                                 <div class="custom-file mb-3">
                                                 <input class="custom-file-input" type="file" name="course_img" id="course_img" accept="image/*" onchange="javascript:setCourseFile()">
                                                 <label class="custom-file-label imglbl-text-break" for="customcourse_imgFile" id="customcourse_imgFile">Choose file</label>
                                                 </div>
                                                 <p class="notes">Limit of 5MB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <button class="btn btn-submit" id="btn_submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

<script type="text/javascript">
var arrcoursePdf = [];
var arrcourseTube = [];
var arrcourseTime = [];


 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

$(function () {
    $('.cource_timepicker').datetimepicker({
        format: 'LT'
    });
});

$('#valid_course').on('submit', function(event) {
    //Add validation rule for dynamically generated name fields
    $('.course_pdf_input').each(function() {
        $(this).rules("add", 
        {
            required:true,
            extension: "docx|rtf|doc|pdf",
            pdfSize10:true
        });
    });

    $('.pdf_text_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });

    $('.tube_url_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });

    $('.tube_title_class').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            minlength:1,
            maxlength:100
        });
    });

    $('.course_time_starttimeH').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            timeValidH:true,
            minlength:1,
            maxlength:2
        });
    });

    $('.course_time_endtimeH').each(function() {
        $(this).rules("add", 
        {
            required:true,
            space:true,
            timeValidH:true,
            minlength:1,
            maxlength:2
        });
    });

    $('.course_time_starttimeM').each(function() {
        $(this).rules("add", 
        {
            timeValidM:true,
            minlength:1,
            maxlength:2
        });
    });

    $('.course_time_endtimeM').each(function() {
        $(this).rules("add", 
        {
            timeValidM:true,
            minlength:1,
            maxlength:2
        });
    });

    if($('#exclusive').prop('checked')==true)
    {
        $('#no_of_students').rules("add",
        {
            required:true,
            minlength:1,
            maxlength:2,
            number:true
        });

        $('#expiry_date').rules("add",
        {
            required:true,
            greaterThanToday:true
        });

        $('#ex_client_descount').rules("add",
        {
            client_descount_offer:true,
            maxlength:3
        });

        $('#ex_feeselect').rules("add",{
            required:true
        });
    }
});

$(document).ready(function(){
$('.exclusivedv').hide();

$('#exclusive').click(function(){
    if($(this).prop("checked") == true){
        getOwnerCharge(0);
        $('.ex_input').val('');
        $('.ex_dvfeemin_amount').hide();

        $('.exclusivedv').show();
    }
    else if($(this).prop("checked") == false){
        $('.exclusivedv').hide();
    }
});

arrcourseTime.push(1);
$('#hdarrtime').val(arrcourseTime);

$('.dvfeemin_amount').hide();
$('.ex_dvfeemin_amount').hide();

    //Add date time
  $(function () {
      $('#datetime1').on('click', function() {
          $('.one_date').click();
      });
      $('#datetime2').on('click', function() {
          $('.two_date').click();
      });

      $('#expiry_date').on('click', function() {
          $('.ex_date').click();
      });

      $('#datetime1').keydown(function() {  return false; });
      $('#datetime2').keydown(function() {  return false; });
      $('#expiry_date').keydown(function() {  return false; });

      $('#datetimepicker1').datetimepicker({ //defaultDate: new Date(),minDate: new Date(),
        format: 'YYYY-MM-DD'
      });
      $('#datetimepicker2').datetimepicker({ //defaultDate: new Date(),minDate: new Date()
          format: 'YYYY-MM-DD'
      });
      $('#datetimepicker3').datetimepicker({ //defaultDate: new Date(),minDate: new Date()
          format: 'YYYY-MM-DD'
      });
  });

$('#valid_course').validate({
        rules:
        {
            /*course_name:
            {
                required:true,
                space:true,
                minlength:1,
                maxlength:50,
                remote:{
                   url:"{{route('course.checkAddCourseExists')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     name: function(){ return $("#course_name").val(); }
                   }
                 }
            },*/
            maincourse_id:
            {
                required:true
            },
            subcourse_id:
            {
                required:true,
                remote:{
                   url:"{{route('course.checkExistsCourse')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     maincourse_id: function(){ return $("#maincourse_id").val(); },
                     subcourse_id: function(){ return $("#subcourse_id").val(); },
                     childcourse_id: function(){ return $("#childcourse_id").val(); }
                   }
                 }
            },
            childcourse_id:
            {
                required:true,
                remote:{
                   url:"{{route('course.checkExistsCourse')}}",
                   type:"POST",
                   dataType:"json",
                   data: 
                   {
                     maincourse_id: function(){ return $("#maincourse_id").val(); },
                     subcourse_id: function(){ return $("#subcourse_id").val(); },
                     childcourse_id: function(){ return $("#childcourse_id").val(); }
                   }
                 }
            },
            batch_type:
            {
                required:true
            },
            batch_for:
            {
                required:true
            },
            description:
            {
                required:true,
                space:true,
                minlength:5,
                maxlength:1000,
            },
            material:
            {
                required:true
            },
            cartificate:
            {
                required:true
            },
            seat:
            {
                required:true
            },
            feeselect:
            {
                required:true
            },
            fee_select_per:
            {
                required:true
            },
            fee_select_amount:
            {
                required:true
            },
            price:
            {
              required:true,
              price:true,
              minlength:1,
              maxlength:6
            },
            client_descount:
            {
              client_descount_offer:true,
              maxlength:3
            },
            feeselect:
            {
                required:true
            },
            course_img:
            {
                // required:true,
                accept:"image/png,jpg,jpeg",
                imageSize5:true
            },
            datetime1:
            {
              required:true,
              // greaterThanToday:true
            },
            datetime2:
            {
              required:true,
              greaterThan: "#datetime1"
            },
        },
        messages:
        {
            course_name:
            {
                remote:'Course name already exists.'
            },
            price:
            {
             price:"Invalid price."
            },
            subcourse_id:
            {
              remote:"Course already exists."
            },
            childcourse_id:
            {
              remote:"Course already exists."
            }
        },
        submitHandler: function(form) {
          form.submit();
          $('#btn_submit').attr('disabled',true);
        }

    });
});


function getSubcourse(data)
{
  var id = data.value;
  $('#subcourse_id').html('');
  $('<option/>').val('').html('Select').appendTo('#subcourse_id');

  $('#childcourse_id').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse_id');
  $('#dv_child_course').html('');

  //hide error msg
  $('#subcourse_id-error').html('');
  
  if(id != "") {
    $.ajax({
          url:'{{route('class.getSubcourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#subcourse_id');    
                }
            }
          }
        });
  }
}


function getchildcourse(data)
{
  var id = data.value;
  $('#childcourse_id').html('');
  $('#dv_child_course').html('');
  $('<option/>').val('').html('Select').appendTo('#childcourse_id');
  if(id != "") {
    $.ajax({
          url:'{{route('class.getchildCourse')}}',
          method:'POST',
          dataType:'JSON',
          data:{id:id},
          success:function(data)
          {
            if (data != false) {
                var html='';
                html+='<div class="form-group">';
                html+='<label>Select Sub Child Course</label> <span class="req-star text-danger"> *</span>';
                html+='<select class="form-control" id="childcourse_id" name="childcourse_id">';
                html+='<option value="">Select</option>';
                html+='</select>';
                html+='</div>';
                $('#dv_child_course').append(html);
              var len=data.length;
              for (var i =0; i<len; i++) {
                  $('<option/>').val(data[i]['id']).html(data[i]['name']).appendTo('#childcourse_id');    
                }
            }
          }
        });
  }
}

function getOwnerCharge(status)
{
    if (status==1)
    {
        $.each($("#feeselect option:selected"), function () {
              $(this).prop('selected', false);
        });

        $.each($("#ex_feeselect option:selected"), function () {
              $(this).prop('selected', false);
        });

        $('.dvfeemin_amount').hide();
        $('.ex_dvfeemin_amount').hide();
    }
    var price = parseInt($('#price').val());

    $('#owner_charge').html('');
    $('#hdowner_charge').val('');
    $('#hdowner_charge_per').val('');
    $('#calculated_price').html('');
    $('#hdcalculated_price').val('');

    if (price!="" && !isNaN(price))
    {
        $.ajax({
            url:'{{route('course.getOwnerCharge')}}',
            dataType:'JSON',
            method:'POST',
            data:{price:price},
            success:function(data)
            {
                // console.log(data);
                if (data)
                {
                    var client_descount = parseInt($('#client_descount').val());
                    var owner_charge = Math.round((price*data.owner_charge_per)/100);

                    $('#owner_charge').html(owner_charge);
                    $('#hdowner_charge').val(owner_charge);
                    $('#hdowner_charge_per').val(data.owner_charge_per);

                    //calculated_price
                    // console.log(client_descount);
                    if (client_descount=="" || isNaN(client_descount))
                    {
                        var calculated_price = price - owner_charge;
                    }else
                    {
                        var client_descount_price = Math.round((price*client_descount)/100)
                        var calculated_price = (price - owner_charge) - client_descount_price;
                    }
                    // console.log("calculated_price="+calculated_price);
                    $('#calculated_price').html(calculated_price);
                    $('#hdcalculated_price').val(calculated_price);
                }
            }
        });

        if ($('#exclusive').prop('checked')==true)
        {
            $('#ex_owner_charge').html('');
            $('#ex_hdowner_charge').val('');
            $('#ex_calculated_price').html('');
            $('#ex_hdcalculated_price').val('');

            var ex_client_descount = parseInt($('#ex_client_descount').val());
            var ex_owner_charge_per = '{{$setting->exclusive_charge_per}}';
            var ex_owner_charge = Math.round((price*ex_owner_charge_per)/100);
            $('#ex_hdowner_charge_per').val(ex_owner_charge_per);

            $('#ex_owner_charge').html(""+ex_owner_charge);
            $('#ex_hdowner_charge').val(ex_owner_charge);

            //calculated_price
            // console.log(client_descount);
            if (ex_client_descount=="" || isNaN(ex_client_descount))
            {
                var ex_calculated_price = price - ex_owner_charge;
            }else
            {
                var ex_client_descount_price = Math.round((price*ex_client_descount)/100)
                var ex_calculated_price = (price - ex_owner_charge) - ex_client_descount_price;
            }
            // console.log("calculated_price="+calculated_price);
            $('#ex_calculated_price').html("₹ "+ex_calculated_price);
            $('#ex_hdcalculated_price').val(ex_calculated_price);
        }
    }
}

function setFeeSelection(sel)
{
    $('.dvfeemin_amount').hide();
    if (sel.value==0 && sel.value!="")
    {
        $('#hdper').show();
    }else if(sel.value==1)
    {
        $('#hdauto').show();
        $('#hdauto').html('');
        var price = parseInt($('#hdcalculated_price').val());
        var owner_charge = parseInt($('#hdowner_charge').val());
        if (price!="")
        {
            $.ajax({
                url:'{{route('course.getFeeSelectionAuto')}}',
                method:'POST',
                dataType:'JSON',
                data:{price:price,owner_charge:owner_charge},
                success:function(data)
                {
                    // console.log(data);
                    if (data)
                    {
                        var html='';
                        for(var i=0;i<data.length;i++)
                        {
                            html+='<div class="radio radio-inline">';
                            if (i==0)
                            {
                                html+='<input type="radio" id="fee_select_'+data[i].id+'" value="'+data[i].amount+'" name="fee_select_amount" checked>';
                            }else
                            {
                                html+='<input type="radio" id="fee_select_'+data[i].id+'" value="'+data[i].amount+'" name="fee_select_amount">';
                            }
                            html+='<label for="fee_select_'+data[i].id+'">₹ '+data[i].amount+'</label>';
                            html+='</div>';
                        }
                        $('#hdauto').append(html);
                    }
                }
            });
        }
    }
}

function setExFeeSelection(sel)
{
    $('.ex_dvfeemin_amount').hide();
    if (sel.value==0 && sel.value!="")
    {
        $('#ex_hdper').show();
    }else if(sel.value==1)
    {
        var isExclusive = 0;
        if ($('#exclusive').prop('checked')==true)
        {
            isExclusive = 1;
        }

        $('#ex_hdauto').show();
        $('#ex_hdauto').html('');
        var price = parseInt($('#ex_hdcalculated_price').val());
        var owner_charge = parseInt($('#ex_hdowner_charge').val());
        if (price!="")
        {
            $.ajax({
                url:'{{route('course.getFeeSelectionAuto')}}',
                method:'POST',
                dataType:'JSON',
                data:{price:price,owner_charge:owner_charge,isExclusive:isExclusive},
                success:function(data)
                {
                    // console.log(data);
                    if (data)
                    {
                        var html='';
                        for(var i=0;i<data.length;i++)
                        {
                            html+='<div class="radio radio-inline">';
                            if (i==0)
                            {
                                html+='<input type="radio" id="ex_fee_select_'+data[i].id+'" value="'+data[i].amount+'" name="ex_fee_select_amount" checked>';
                            }else
                            {
                                html+='<input type="radio" id="ex_fee_select_'+data[i].id+'" value="'+data[i].amount+'" name="ex_fee_select_amount">';
                            }
                            html+='<label for="ex_fee_select_'+data[i].id+'">₹ '+data[i].amount+'</label>';
                            html+='</div>';
                        }
                        $('#ex_hdauto').append(html);
                    }
                }
            });
        }
    }
}
function addCoursePdf()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrcoursePdf_len =  arrcoursePdf.length;
    var hdarrpdf_length = parseInt($('#hdarrpdf_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrpdf_length<5)
    {
        $('#hdarrpdf_length').val(hdarrpdf_length+1);
        arrcoursePdf.push(random);
        $('#hdarrpdf').val(arrcoursePdf);
        var html='';
        html+='<div class="form-group" id="coursepdfdv'+random+'">';
        html+='<div class="row">';
        html+='<div class="col-lg-4 col-md-4 col-sm-12">';
        html+='<div class="custom-file">';
        html+='<input class="custom-file-input course_pdf_input" type="file" name="coursepdf'+random+'" id="coursepdf'+random+'" onchange="javascript:setPdfFile('+random+')">';
        html+='<label class="custom-file-label" for="customPdfFile'+random+'" id="customPdfFile'+random+'">Choose file</label>';
        html+='</div>';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<input type="text" id="pdf_title'+random+'" name="pdf_title'+random+'" class="form-control pdf_text_class" placeholder="Enter Title" maxlengt="100">';
        html+='</div>';        
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<a href="javascript:removeCoursePDF('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</div>';
        html+='</div>';
        html+='</div>';
        $('#add_course_pdf').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 5 pdf.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function addCourseTime()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    // var arrcoursePdf_len =  arrcourseTime.length;
    var hdarrtime_length = parseInt($('#hdarrtime_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrtime_length<9)
    {
        $('#hdarrtime_length').val(hdarrtime_length+1);
        arrcourseTime.push(random);
        $('#hdarrtime').val(arrcourseTime);
        var html='';

        html+='<div class="form-group" id="coursetimedv'+random+'">';
        html+='<div class="row mre">';
        html+='<div class="col-lg-1 col-md-2 col-2 mls">';
        html+='<input type="text" class="form-control course_time_starttimeH" placeholder="00" name="starttimeH'+random+'" id="starttimeH'+random+'" maxlength="2">';
        html+='</div>';

        html+='<div class="timecolon">';
        html+=':';
        html+='</div>';

        html+='<div class="col-lg-1 col-md-2 col-2">';
        html+='<input type="text" class="form-control course_time_starttimeM" placeholder="00" name="starttimeM'+random+'" id="starttimeM'+random+'" maxlength="2">';
        html+='</div>';

        html+='<div class="col-lg-1 col-md-2 col-2 mle">';
        html+='<input type="text" class="form-control course_time_endtimeH" placeholder="00" name="endtimeH'+random+'" id="endtimeH'+random+'" maxlength="2">';
        html+='</div>';

        html+='<div class="timecolon">';
        html+=':';
        html+='</div>';

        html+='<div class="col-lg-1 col-md-2 col-2">';
        html+='<input type="text" class="form-control course_time_endtimeM" placeholder="00" name="endtimeM'+random+'" id="endtimeM'+random+'" maxlength="2">';
        html+='</div>';

        html+='<div class="col-lg-2 col-md-2 col-2 pl-0">';
        html+='<a href="javascript:removeCourseTime('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</div>';
        html+='</div>';
        html+='</div>';
        $('#add_course_time').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 10 time.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function setPdfFile(random) 
{
  if($('#coursepdf'+random).val()!=="")
  {
    var file = $('#coursepdf'+random)[0].files[0].name;
    $('#customPdfFile'+random).text(file);
  }else
  {
    $('#customPdfFile'+random).text('Choose file');
  }
}

function removeCoursePDF(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this pdf.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('course.deletePdf')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveCoursePDF(random);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveCoursePDF(random);
    }
}

function removeCourseTime(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    finalremoveCourseTime(random);
    /*if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this time.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveCoursePDF(random);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
    }*/
}


function finalremoveCourseTime(random)
{
    var hdarrtime_length = parseInt($('#hdarrtime_length').val());
    $('#hdarrtime_length').val(hdarrtime_length-1);
    $('#coursetimedv'+random).remove();
    var index = arrcourseTime.indexOf(random);
    if (index > -1) {
       arrcourseTime.splice(index, 1);
    }
    $('#hdarrtime').val(arrcourseTime);
}


function finalremoveCoursePDF(random)
{
    var hdarrpdf_length = parseInt($('#hdarrpdf_length').val());
    $('#hdarrpdf_length').val(hdarrpdf_length-1);
    $('#coursepdfdv'+random).remove();
    var index = arrcoursePdf.indexOf(random);
    if (index > -1) {
       arrcoursePdf.splice(index, 1);
    }
    $('#hdarrpdf').val(arrcoursePdf);
}


function addCourseTube()
{
    // var hdtotalclass_img = parseInt($('#hdtotalclass_img').val());
    var arrcourseTube_len =  arrcourseTube.length;
    var hdarrtube_length = parseInt($('#hdarrtube_length').val());
    var random = Math.floor(Math.random() * 1000000000);
    if (hdarrtube_length<5)
    {
        $('#hdarrtube_length').val(hdarrtube_length+1);
        arrcourseTube.push(random);
        $('#hdarrtube').val(arrcourseTube);
        var html='';
        html+='<div class="form-group" id="coursetubedv'+random+'">';
        html+='<div class="row">';
        html+='<div class="col-lg-5 col-md-6 col-sm-12">';
        html+='<input type="text" class="form-control tube_url_class" placeholder="Enter URL" name="tube_url'+random+'" id="tube_url'+random+'">';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<input type="text" class="form-control tube_title_class" placeholder="Enter Title" name="tube_title'+random+'" id="tube_title'+random+'">';
        html+='</div>';
        html+='<div class="col-lg-3 col-md-6 col-sm-12">';
        html+='<a href="javascript:removeCourseTube('+random+',0)" class="btn btn-remove">';
        html+='<i class="fa fa-minus"></i>';
        html+='</a>';
        html+='</div>';
        html+='</div>';
        html+='</div>';
        $('#add_course_tube').append(html);
    }else
    {
        $.confirm({
            title: 'Warning',
            content: 'You can add only 5 you tube link.',
            buttons: {
                ok: function () {               
                }
            }
        });
    }
}

function removeCourseTube(random,type)
{
    /*{type:1='live tbl value'}
    {type:0='dummy value'}*/
    if (type==1)
    {
      $.confirm({
            title: 'Warning',
            content: 'Are you sure you want to delete this you tube link.',
            buttons: {
                Yes: function () {               
                  $.ajax({
                    url:'{{route('course.deleteTube')}}',
                    method:'POST',
                    dataType:'JSON',
                    data:{id:random},
                    success:function(data)
                    {
                      if (data==true)
                      {
                        finalremoveCourseTube(random);
                      }
                    }
                  });
                },
                No: function () {               
                }
            }
        });
    }else
    {
        finalremoveCourseTube(random);
    }
}

function finalremoveCourseTube(random)
{
    var hdarrtube_length = parseInt($('#hdarrtube_length').val());
    $('#hdarrtube_length').val(hdarrtube_length-1);
    $('#coursetubedv'+random).remove();
    var index = arrcourseTube.indexOf(random);
    if (index > -1) {
       arrcourseTube.splice(index, 1);
    }
    $('#hdarrtube').val(arrcourseTube);
}

function setCourseFile(random) 
{
  if($('#course_img').val()!=="")
  {
    var file = $('#course_img')[0].files[0].name;
    $('#customcourse_imgFile').text(file);
  }else
  {
    $('#customcourse_imgFile').text('Choose file');
  }
}
</script>
@endsection