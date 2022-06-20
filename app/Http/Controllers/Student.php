<?php

namespace App\Http\Controllers;

use App\StudentM;
use App\EdifygoM;
use App\ClassM;
use App\GenericM;
use Illuminate\Http\Request;
use App\Mail\student_mail;
use App\Mail\Allmail;

class Student extends Edifygo_class\Sms
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student/login');
    }

    public function checkLogin(Request $request)
    {
        $row = StudentM::checkLogin('tbl_student_registration',$request->username,sha1($request->password));
        if (!empty($row) && $row->password==sha1($request->password)) {
            if ($row->isverified==0) {
               session()->flash('error-msg','Account not verified.');
               return redirect('/student/login');
            }else
            {
                $request->session()->put('student_login_session_id', $row->id);
                $request->session()->put('student_login_session', $request->username);
                session()->flash('success-msg','Login successfully.');

                if (session('setCourseSession')!="" && session('setClassSessionForEnrollBeforLogin')!="" && session('setTimeSlotSessionForEnrollBeforLogin')) {
                    return redirect('viewcourse/'.session('setClassSessionForEnrollBeforLogin').'');
                }else
                {
                    return redirect('/student/profile');
                }
            }
        }else
        {
            session()->flash('error-msg','Invalid email/mobile or password.');
            return redirect('/student/login');
        }
    }

    public function registration()
    {
         $data['country'] = EdifygoM::getAllData('tbl_master_country',array('isdelete' =>0),'country_name');
         $data['know_us'] = GenericM::getAllData('tbl_know_us',array('isdelete' =>0,'isactive' =>1));
        return view('student/registration',$data);
    }

    public function checkAddEmailExists(Request $request)
    {
        if ($request->email!="") {
            $isExists = GenericM::getSingleRecord('tbl_student_registration','id',array('email'=>$request->email,'isdelete'=>0,'isverified'=>1));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkAddMobileExists(Request $request)
    {
        if ($request->mobile!="") {
            $isExists = GenericM::getSingleRecord('tbl_student_registration','id',array('mobile'=>$request->mobile,'isdelete'=>0,'isverified'=>1));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkEditMobileExists(Request $request)
    {
        if ($request->mobile!="") {
            $where = [
                ['id','<>',$request->inserted_id],
                ['mobile',$request->mobile],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_student_registration','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function addRegistration(Request $request)
    {

        $request->session()->forget('student_reg_session');
        $request->session()->forget('student_reg_mobile_session');
        $data['mobile'] = $request->mobile;
        $data['otp'] = rand(1000,9999);
        $data['isdelete'] = 0;
        $data['isverified'] = 0;
        $data['date'] = date('Y-m-d H:i:s');

        if (!empty($data)) {            
            if ($request->mobile != "") {
                //send SMS
                $err = $this->sendOTP($data['otp'],$request->mobile);   
                if (!$err) { 
                    //insert otp and contact
                    $isInsert = GenericM::insertData('tbl_student_registration',$data);
                    if ($isInsert) {
                        $data['country_id'] = $request->country_id;
                        $data['state_id'] = $request->state_id;
                        $data['city_id'] = $request->city_id;
                        $data['area_id'] = $request->area_id;
                        $data['firstname'] = $request->firstname;
                        $data['lastname'] = $request->lastname;
                        $data['address'] = $request->address;
                        $data['email'] = $request->email;
                        $data['password'] = sha1($request->password);
                        $data['schoolname'] = $request->schoolname;
                        $data['know_is_id'] = $request->know_us;
                        $data['isterms'] = $request->stud_terms;
                        $data['inserted_id'] = $isInsert;
                        $request->session()->put('student_reg_session',$data);
                        $request->session()->put('student_reg_mobile_session',$data['mobile']);
                        return redirect('/student/otp');
                    }else
                    {
                        //not inserted
                        session()->flash('error-msg','Student not created.');
                    }
                }else
                {
                    session()->flash('error-msg','Student not created.');
                    //OTP not sent
                }
            }
        }
        return redirect('/student/registration');

    }

    public function otp()
    {
        return view('student/otpverify');
    }

    public function verifyOtp(Request $request)
    {
        if ($request->inserted_id) {
            if ($request->hd_edit==0) {
                //update Mobile and send OTP
                $data['otp'] = rand(1000,9999);
                $data['mobile'] = $request->mobile;
                $err = $this->sendOTP($data['otp'],$data['mobile']);    
                if (!$err) { 
                    $where = array('id' => $request->inserted_id);
                    $isUpdate = GenericM::updateData('tbl_student_registration',$where,$data);
                    if ($isUpdate) {
                        $request->session()->forget('student_reg_mobile_session');
                        $request->session()->put('student_reg_mobile_session',$data['mobile']);
                        session()->flash('success-msg','Mobile updated successfully.');

                    }else
                    {
                        session()->flash('error-msg','Mobile not updated.');
                    }
                }else
                {
                    session()->flash('error-msg','Mobile not updated.');
                }
                return redirect('/student/otp');
            }
            else
            {
                //verify OTP
                if ($request->otp!="" && $request->inserted_id!="") {

                    $isExists = GenericM::getSingleRecord('tbl_student_registration','otp',array('id'=>$request->inserted_id));
                    if (!empty($isExists)) {
                        if ($isExists->otp==$request->otp) {
                            $request->session()->forget('student_reg_mobile_session');
                            //update records
                            $up_data = $request->session()->pull('student_reg_session');
                            $data['country_id'] = $up_data['country_id'];
                            $data['state_id'] = $up_data['state_id'];
                            $data['city_id'] = $up_data['city_id'];
                            $data['area_id'] = $up_data['area_id'];
                            $data['firstname'] = $up_data['firstname'];
                            $data['lastname'] = $up_data['lastname'];
                            $data['address'] = $up_data['address'];
                            $data['email'] = $up_data['email'];
                            $data['password'] = $up_data['password'];
                            // $data['confirm_password'] = $up_data['confirm_password'];
                            $data['schoolname'] = $up_data['schoolname'];
                            $data['know_is_id'] = $up_data['know_is_id'];
                            $data['isterms'] = $up_data['isterms'];
                            $data['isverified'] = 1;
                            $isUpdate = GenericM::updateData('tbl_student_registration',array('id'=>$request->inserted_id),$data);
                            if ($isUpdate) {
                                //send FAQ mail
                                try {
                                    \Mail::to($data['email'])->send(new student_mail());
                                } catch (\Exception $e) {
                                    
                                }
                                //student registration mail
                                $all_type = ['type' => 2];
                                try {
                                    \Mail::to($data['email'])->send(new Allmail($all_type));
                                } catch (\Exception $e) {
                                    
                                }

                                $request->session()->put('student_login_session_id', $request->inserted_id);
                                $request->session()->put('student_login_session', $data['email']);
                                session()->flash('success-msg','Login successfully.');
                                if (session('setCourseSession')!="" && session('setClassSessionForEnrollBeforLogin')!="" && session('setTimeSlotSessionForEnrollBeforLogin')) {
                                    return redirect('viewcourse/'.session('setClassSessionForEnrollBeforLogin').'');
                                }
                                return redirect('/student/profile');
                            }

                        }else
                        {
                            session()->flash('error-msg','Invalid otp.');
                            return redirect('/student/otp');
                        }
                    }else
                    {
                        session()->flash('error-msg','Otp not verifyed.');
                        return redirect('/student/otp');
                    }
                }else
                {
                    session()->flash('error-msg','Otp not verifyed.');
                    return redirect('/student/otp');
                }
            }
        }
    }

    public function resendOtp(Request $request)
    {
        if ($request->mobile!="" && $request->id) {
            $data['otp'] = rand(1000,9999);
            $err = $this->sendOTP($data['otp'],$request->mobile);
            if (!$err) { 
                    $where = array('id' => $request->id);
                    $isUpdate = GenericM::updateData('tbl_student_registration',$where,$data);
                    if ($isUpdate) {
                        session()->flash('success-msg','OTP send successfully.');

                    }else
                    {
                        session()->flash('error-msg','OTP not send.');
                    }
                }else
                {
                    session()->flash('error-msg','OTP not send.');
                }
        }

        echo json_encode(TRUE);
    }

    public function profile()
    {
        $data['student'] = StudentM::getClassData();
        return view('student/profile-details',$data);
    }

    public function edit_profile()
    {
        $data['student'] = StudentM::getClassData();
        return view('student/edit_profile',$data);
    }


    public function updateProfile(Request $request)
    {
        $student_id = $request->hdstudent_id;
        $data['firstname'] = $request->firstname;
        $data['lastname'] = $request->lastname;
        // $data['address'] = $request->address;
        $data['schoolname'] = $request->schoolname;

        $data['date'] = date('Y-m-d H:i:s');
        $isUpdate = GenericM::updateData('tbl_student_registration',array('id'=>$student_id),$data);
        if ($isUpdate) {
            session()->flash('success-msg','Student updated successfully.');
        }else
        {
            session()->flash('error-msg','Student not updated.');
        }

        return redirect('student/profile');
    }

    public function changePassword(Request $request)
    {
        $data['student'] = StudentM::getClassData();
        return view('student/change_password',$data);
    }

    public function updatePassword(Request $request)
    {
        $data['password'] = sha1($request->new_passwd);
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id' => $request->hdclass_id);
        $isUpdate = GenericM::updateData('tbl_student_registration',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Password updated successfully.');
        }else
        {
            session()->flash('error-msg','Password not updated.');
        }

        return redirect('/student/profile');
    }

    public function logout(request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
    
    public function enrollbeforLogin(Request $request)
    {
        // dd($request->hdcourse_id);
        if ($request->class_id!="" && $request->time_slot!="") {
            //get course id using time slot ID
            $row = StudentM::getCourseData($request->time_slot);
            if (!empty($row)) {
                $course_id = $row->id;
            }
            $request->session()->put('setCourseSession', $course_id);   
            $request->session()->put('setClassSessionForEnrollBeforLogin', $request->class_id);   
            $request->session()->put('setTimeSlotSessionForEnrollBeforLogin', $request->time_slot);   
        }
        echo json_encode(TRUE);
    }

    /*public function enrolllist(Request $request)
    {

    }*/

    public function enroll(Request $request)
    {
            $student_id = session('student_login_session_id');
            //get course id using time slot ID
            $row = StudentM::getCourseData($request->time_slot);
            if (!empty($row)) {
                $course_id = $row->id;
                if ($row->isExclusive==1) {
                    if ($row->ex_admission_fees_selection==0) {
                        //per
                        $enroll_amount = round($row->ex_final_price*$row->ex_admission_fees_selection_value/100);
                    }else
                    {
                        $enroll_amount = $row->ex_admission_fees_selection_value;
                    }                
                }else
                {
                    if ($row->admission_fees_selection==0) {
                        //per
                        $enroll_amount = round($row->final_price*$row->admission_fees_selection_value/100);
                    }else
                    {
                        $enroll_amount = $row->admission_fees_selection_value;
                    }
                }
            }

            $time_slot = $request->time_slot;
            if ($student_id!="" && $course_id!="" && $time_slot!="" && $enroll_amount!="") {
                $data['receipt'] = StudentM::getEnrollReceipt($time_slot);
                // dd($data);
                if (!empty($data['receipt'])) {
                    if ($request->btn_enroll==1) {
                        //real course
                        return view('student/orderdetails',$data);
                    }else
                    {
                        //trial course
                        $row = GenericM::getSingleRecord('tbl_setting_value',array('trial_course_fee'),array());
                        $data['trial_course_fee'] = $row->trial_course_fee;
                        if ($row->trial_course_fee>0) {
                            return view('student/trialorderdetails',$data);
                        }else
                        {
                            $rowt = StudentM::getCourseData($time_slot);   
                            if (!empty($rowt)) {
                                $data_trial['course_id'] = $rowt->id;
                                $data_trial['student_id'] = $student_id;
                                $data_trial['class_name'] = GenericM::getSingleRecord('tbl_class_registration','name',array('id'=>$rowt->class_id))->name;
                                $data_trial['class_id'] = $rowt->class_id;
                                $data_trial['name'] = $rowt->name;
                                $data_trial['timeslot_id'] = $time_slot;
                                $data_trial['istrial'] = 1;
                                $data_trial['start_date'] = $rowt->start_date;
                                $data_trial['end_date'] = $rowt->end_date;
                                $data_trial['start_time'] = $rowt->start_time;
                                $data_trial['end_time'] = $rowt->end_time;
                                $data_trial['price'] = $rowt->price;
                                $data_trial['enroll_amount'] = 0;
                                $data_trial['date'] = date('Y-m-d H:i:s');
                                // dd($data_trial);
                                $isInsert = GenericM::insertData('tbl_enroll_course',$data_trial);
                                if ($isInsert) {
                                    session()->flash('success-msg','enrolled successfully.');
                                }else
                                {
                                    session()->flash('error-msg','enrolled not done,try again.');
                                }
                            }
                            return redirect('/student/enrolllist');
                        }
                    }
                }
                else
                {
                    return redirect('/');
                }
            }else
            {
                return redirect('/');
            }
    }


    public function finalenroll(Request $request)
    {
        // dd($request->all());
        $student_id = session('student_login_session_id');
        //get course id using time slot ID

            $row = StudentM::getCourseData($request->time_slot);
            if (!empty($row)) {
                $course_id = $row->id;
                if ($request->istrial==0) {
                    if ($row->isExclusive==1) {
                        if ($row->ex_admission_fees_selection==0) {
                            //per
                            $enroll_amount = round($row->ex_final_price*$row->ex_admission_fees_selection_value/100);
                        }else
                        {
                            $enroll_amount = $row->ex_admission_fees_selection_value;
                        }                
                    }else
                    {
                        if ($row->admission_fees_selection==0) {
                            //per
                            $enroll_amount = round($row->final_price*$row->admission_fees_selection_value/100);
                        }else
                        {
                            $enroll_amount = $row->admission_fees_selection_value;
                        }
                    }
                }else
                {
                    $row = GenericM::getSingleRecord('tbl_setting_value',array('trial_course_fee'),array());
                    $enroll_amount = $row->trial_course_fee;
                }
            }

        $time_slot = $request->time_slot;
        if ($student_id!="" && $course_id!="" && $time_slot!="" && $enroll_amount!="" && $enroll_amount>0) {
            //paytm code start
            $order_id = uniqid()."X".rand(1000,9999)."-".$student_id."-".$time_slot."-".$request->istrial;
            $data_for_request = $this->handlePaytmRequestEnroll( $order_id, $enroll_amount );
            $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
            $paramList = $data_for_request['paramList'];
            $checkSum = $data_for_request['checkSum'];
            return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
            //paytm code end
        }else
        {
            return redirect('/');
        }
    }

    //after enroll
    public function enrolllist()
    {
        $student_id = session('student_login_session_id');
        if ($student_id!="") {
            $data['enroll'] = StudentM::getEnrollData('tbl_enroll_course',array('student_id' =>$student_id));
            $data['paid'] = StudentM::getSUM('tbl_enroll_course',array('student_id' =>$student_id),'enroll_amount');
            $data['pending'] = StudentM::getSUM('tbl_enroll_course',array('student_id' =>$student_id),'student_addmission_fees');
            // dd($data);
            return view('student/enrolllist',$data);
        }else
        {
            return redirect('/');
        }
    }

    public function addRating(Request $request)
    {
        $student_id = session('student_login_session_id');
        if ($request->enroll_id!="" && $request->hdrate!="" && $request->review!="" && $student_id!="") {
            $data['isreview'] = 1;
            $data['rating'] = $request->hdrate;
            $data['review'] = $request->review;
            $data['ratingdate'] = date('Y-m-d H:i:s');
            $where = array('student_id' => $student_id,'id'=>$request->enroll_id);
            $isInsert = GenericM::updateData('tbl_enroll_course',$where,$data);
            if ($isInsert) {
                session()->flash('success-msg','Review and rating submitted successfully.');
            }else
            {
                session()->flash('error-msg','Review and rating not submitted.');
            }
            return redirect('/student/enrolllist');
        }else
        {
            session()->flash('error-msg','Review and rating not submitted.');
        }
    }

    public function orderdetails()
    {
        return view('student/orderdetails');
    }

    public function terms()
    {
        return view('student/terms');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
    public function privacy()
    {
        return view('privacy');
    }
    public function refund()
    {
        return view('refund');
    }
    public function faq()
    {
        return view('faq');
    }

    //admin modules
    public function getStudentList()
    {
        $data['students'] = StudentM::getAllStudents();
        // dd($data);
        return view('admin/student/index',$data);
    }

    public function getEnrollList()
    {
        $data['enrolls'] = StudentM::getEnrollDataAdmin();

        $data['city'] = StudentM::getCityLocationData();
        // $data['area'] = StudentM::getLocationData();
        $data['course'] = StudentM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'name');

        // dd($data);
       /* $data['paid'] = StudentM::getSUM($course_id,'enroll_amount');
        $data['pending'] = StudentM::getSUM($course_id,'student_addmission_fees');*/
        return view('admin/course/enrollcourse',$data);
    }

    public function getFilterSubcourse(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('main_course_id' => $id,'status'=>1,'isdelete' => 0);
             $result = StudentM::getAllData('tbl_sub_course',$where,'name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function getFilterArea(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('city_id' => $id,'isdelete' => 0);
             $result = StudentM::getAllData('tbl_master_area',$where,'area_name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function getchildCourse(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('sub_course_id' => $id,'status'=>1,'isdelete' => 0);
             $result = StudentM::getAllData('tbl_child_course',$where,'name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function filterEnrollList(Request $request)
    {

        $request->session()->forget('admin_city_session');
        $request->session()->forget('admin_area_session');
        $request->session()->forget('admin_maincourse_session');
        $request->session()->forget('admin_subcourse_session');
        $request->session()->forget('admin_childcourse_session');
        $where = array();
            //city
            if ($request->city!="") {
                
                $where['tsr.city_id'] = $request->city;  
                $request->session()->put('admin_city_session', $request->city);   
            }
            else if(session('admin_city_session'))
            {
                $where['tsr.city_id'] = session('admin_city_session');    
            }

            //area
            if ($request->area!="") {
                
                $where['tsr.area_id'] = $request->area;  
                $request->session()->put('admin_area_session', $request->area);   
            }
            else if(session('admin_area_session'))
            {
                $where['tsr.area_id'] = session('admin_area_session');    
            }

            //main course
            if ($request->maincourse_id!="") {
                
                $where['tcc.maincourse_id'] = $request->maincourse_id;  
                $request->session()->put('admin_maincourse_session', $request->maincourse_id);   
            }
            else if(session('admin_maincourse_session'))
            {
                $where['tcc.maincourse_id'] = session('admin_maincourse_session');    
            }


            //sub course
            if ($request->subcourse_id!="" && $request->maincourse_id!="") {
                
                $where['tcc.subcourse_id'] = $request->subcourse_id;  
                $request->session()->put('admin_subcourse_session', $request->subcourse_id);  
            }
            else if(session('admin_subcourse_session'))
            {
                $where['tcc.subcourse_id'] = session('admin_subcourse_session');    
            }

            //child course
            if ($request->childcourse_id!="" && $request->maincourse_id!="" && $request->subcourse_id!="") {
                $where['tcc.childcourse_id'] = $request->childcourse_id;  
                $request->session()->put('admin_childcourse_session', $request->childcourse_id);  
            }
            else if(session('admin_childcourse_session'))
            {
                $where['tcc.childcourse_id'] = session('admin_childcourse_session');   
            }

        $data['enrolls'] = StudentM::getFilterEnrollDataAdmin($where);

        // $data['area'] = StudentM::getLocationData();
        $data['city'] = StudentM::getCityLocationData();
        $data['course'] = StudentM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'name');

        // dd($data);
       /* $data['paid'] = StudentM::getSUM($course_id,'enroll_amount');
        $data['pending'] = StudentM::getSUM($course_id,'student_addmission_fees');*/
        return view('admin/course/enrollcourse',$data);
    }
}
