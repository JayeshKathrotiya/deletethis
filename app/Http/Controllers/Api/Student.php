<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GenericM;
use App\ApiM;
use App\StudentM;
use App\Mail\student_mail;
use App\Mail\ClientForgot;

class Student extends Generic
{
    public function addStudent(Request $request)
    {
    	$firstname = $request->firstname;
    	$lastname = $request->lastname;
    	$mobile = $request->mobile;
    	$email = $request->email;
    	$password = $request->password;
    	$country_id = $request->country_id;
    	$state_id = $request->state_id;
    	$city_id = $request->city_id;
    	$area_id = $request->area_id;
    	$address = $request->address;
    	$schoolname = $request->schoolname;
    	$know_is_id = $request->know_is_id;
    	if ($firstname!="" && $lastname!="" && $mobile!="" && $email!="" && $password!="" && $country_id!="" && $state_id!="" && $city_id!="" && $area_id!="" && $address!="" && $know_is_id!="") {
    		$data['firstname'] = $firstname;
    		$data['lastname'] = $lastname;
    		$data['mobile'] = $mobile;
    		$data['email'] = $email;
    		$data['password'] = sha1($password);
    		$data['country_id'] = $country_id;
    		$data['state_id'] = $state_id;
    		$data['city_id'] = $city_id;
    		$data['area_id'] = $area_id;
    		$data['address'] = $address;
    		$data['schoolname'] = $schoolname;
    		$data['know_is_id'] = $know_is_id;
    		$data['otp'] = rand(1000,9999);
	        $data['isdelete'] = 0;
	        $data['isverified'] = 0;
	        $data['date'] = date('Y-m-d H:i:s');
	        if (!empty($data)) { 

	        	//check mobile Exists           
	        		$ismobileExists = GenericM::getSingleRecord('tbl_student_registration',array('id'),array('mobile'=>$mobile,'isdelete'=>0,'isverified'=>1));
	        		if ($ismobileExists=="") {
	        			//check email Exists           
	        			$isemailExists = GenericM::getSingleRecord('tbl_student_registration',array('id'),array('email'=>$email,'isdelete'=>0,'isverified'=>1));
	        			if ($isemailExists=="") {
	        				if ($mobile != "") {
				                //send SMS
				                $err = $this->sendOTP($data['otp'],$mobile);   
				                if (!$err) { 
				                    //insert otp and contact
				                    $isInsert = GenericM::insertData('tbl_student_registration',$data);
				                    if ($isInsert) {
				                		$response = $this->responseData(true,"Otp send successfully.",$isInsert);
				                    }
				                }else
				                {
				                	$response = $this->responseData(false,"Otp not send.","");
				                }
				            }else
				            {
				                $response = $this->responseData(false,"Otp not send.","");
				            }
	        			}else
	        			{
	        				$response = $this->responseData(false,"Email already exists.","");
	        			}
	        		}else
	        		{
	        			$response = $this->responseData(false,"Mobile already exists.","");
	        		}
        	}else
        	{
                $response = $this->responseData(false,"Otp not send.","");
        	}
    	}else
    	{
            $response = $this->responseData(false,"All Parameter Are Required.","");
    	}

    	echo json_encode($response);
    }

    public function resendOTP(Request $request)
    {
    	$id = $request->id;
    	$mobile = $request->mobile;
    	if ($id!="" && $mobile != "") {
            //send SMS
            $data['otp'] = rand(1000,9999);
            $err = $this->sendOTP($data['otp'],$mobile);   
            if (!$err) { 
                //update otp
                $isUpdate = GenericM::updateData('tbl_student_registration',array('id'=>$id,'mobile'=>$mobile),$data);
                if ($isUpdate) {
            		$response = $this->responseData(true,"Otp send successfully.","");
                }
            }else
            {
            	$response = $this->responseData(false,"Otp not send.","");
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        echo json_encode($response);
    }

    public function verifyOTP(Request $request)
    {   
        $id = $request->id;
        $otp = $request->otp;
        if ($id!="" && $otp != "") {
            //get user OTP
            $row = GenericM::getSingleRecord('tbl_student_registration',array('id','email'),array('id'=>$id,'otp'=>$otp));
            if ($row) {
                $data['isverified'] = 1;
                $isUpdate = genericM::updateData('tbl_student_registration',array('id'=>$id),$data);
                if ($isUpdate) {
                    //send mail to student
                    try {
                        \Mail::to($row->email)->send(new student_mail());
                    } catch (\Exception $e) {
                        
                    }
                    $response = $this->responseData(true,"Otp verified successfully.","");
                }else
                {
                    $response = $this->responseData(false,"Otp not verified.","");
                }
            }else
            {
                $response = $this->responseData(false,"Otp not verified.","");
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        echo json_encode($response);
    }


    public function getLocation(Request $request)
    {
        $data = ApiM::getLocation();
        if (!empty($data)) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(false,"Data not found.",array());
        }
    	echo json_encode($response);
    }

    //login
    public function login(Request $request)
    {
        if ($request->password!="" && $request->username!="") {
            $row = ApiM::login('tbl_student_registration',$request->username,sha1($request->password));
            if (!empty($row) && $row->password==sha1($request->password)) {
                if ($row->isverified==0) {
                   $response = $this->responseData(false,"Account not verified.","");
                }else
                {
                   //get user details
                   $data = ApiM::getStudentDetails($row->id);
                   $response = $this->responseData(true,"Login successfully.",$data);
                }
            }else
            {
                $response = $this->responseData(false,"Invalid email/mobile or password.","");
            }
        }else
        {
          $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        echo json_encode($response);
    }

    //home
    public function home(Request $request)
    {
        $count= strlen((string)$request->postal_code);
        $postal_code=123;
        if ($count>=3) {
            $postal_code = $request->postal_code[0].$request->postal_code[1].$request->postal_code[2];
        }
        if ($postal_code!="") {
            $data['exclusive_slider'] = ApiM::getExclusiveSlider($postal_code);
            $data['category_list'] = ApiM::getAllCategories('tbl_main_course',array('status'=>1,'isdelete'=>0));
            $data['feature_slider'] = ApiM::getFreatureSlider($postal_code);
            $data['promocode_slider'] = ApiM::getPromocode('tbl_promocode_slider',array('isdelete' => 0));
            $data['promoter_slider'] = ApiM::getPromoterSlider($postal_code);
            $data['newly_slider'] = ApiM::getNewlySlider($postal_code);
            $data['sponsored_slider'] = ApiM::getSponsered($postal_code);
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    //know us
    public function knowUs(Request $request)
    {
        $data = GenericM::getAllData('tbl_know_us',array('isdelete' =>0,'isactive' =>1));
        if (!empty($data)) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(true,"Data not found.",array());
        }
        echo json_encode($response);
    }

    public function getSubcategories(Request $request)
    {
        if ($request->category_id!="") {
            if ($request->area_id!=0) {
                $where = array('tsc.isdelete' =>0,'tsc.status' =>1,'tsc.main_course_id'=>$request->category_id,'tcr.area_id'=>$request->area_id,'tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1);
            }else
            {
                $where = array('tsc.isdelete' =>0,'tsc.status' =>1,'tsc.main_course_id'=>$request->category_id,'tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1);
            }
            $data = ApiM::getSubcategories($request->category_id,$where);
            if (!empty($data)) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(true,"Data not found.",array());
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    public function getChildcategories(Request $request)
    {
        if ($request->sub_category_id!="") {
            if ($request->area_id!=0) {
                $where = array('tcc.isdelete' =>0,'tcc.status' =>1,'tcc.sub_course_id'=>$request->sub_category_id,'tcr.area_id'=>$request->area_id,'tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1);
            }else
            {
                $where = array('tcc.isdelete' =>0,'tcc.status' =>1,'tcc.sub_course_id'=>$request->sub_category_id,'tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1);
            }
            $data = ApiM::getChildcategories($where);
            if (!empty($data)) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(true,"Data not found.",array());
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    public function getCity(Request $request)
    {
        $data = GenericM::getAllData('tbl_master_city',array('isdelete' =>0,'isactive' =>1));
        if (!$data->isEmpty()) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(true,"Data not found.",array());
        }
        echo json_encode($response);
    }

    public function getAreaByCity(Request $request)
    {
        if ($request->city_id!="") {
            $data = GenericM::getAllData('tbl_master_area',array('isdelete' =>0,'city_id'=>$request->city_id));
            if (!empty($data)) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(true,"Data not found.",array());
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    public function viewCourse(Request $request)
    {
        $class_id = $request->class_id;
        $maincourse_id = $request->maincourse_id;
        if ($class_id!="") {
            $data['class'] = ApiM::getClassDataByID($class_id);
            if (!empty($data['class'])) {
                if (!empty($data['class']->class_tubelist)) {
                    // $data['class']->class_tubelist[0] = $data['class']->video_url;
                    //class video url set to class youtube links
                    $temp_tubelist = array();
                    if ($data['class']->video_url) {
                        array_push($temp_tubelist, (Object)['url'=>$data['class']->video_url]);
                        
                    }
                    foreach ($data['class']->class_tubelist as $key => $value) {
                        array_push($temp_tubelist, $value);
                    }
                }

                //class logo set to class images
                if (!empty($data['class']->class_imglist)) {
                    $temp_imagelist = array();
                    if ($data['class']->video_url) {
                        array_push($temp_imagelist, (Object)['url'=>$data['class']->logo_url]);
                        
                    }
                    foreach ($data['class']->class_imglist as $key => $value) {
                        array_push($temp_imagelist, $value);
                    }
                }
            }
            
            $data['class']->class_tubelist = $temp_tubelist;
            $data['class']->class_imglist = $temp_imagelist;
            // echo "<pre>";
            // print_r($data['class']);die;
            $data['trial_fees'] = GenericM::getSingleRecord('tbl_setting_value',array('trial_course_fee'),array());

            if ($maincourse_id!="" && $maincourse_id!="all") {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1,'tmc.id'=>$maincourse_id);
            }else
            {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1);
            }

            $data['courses'] = ApiM::getAllCourse($where1);
            // $data['count'] = ApiM::getAllCount($class_id);
            $data['ratings'] = ApiM::getAllRating($class_id);
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
           $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    public function getEnroll(Request $request)
    {
        if ($request->id!="") {
            $data = ApiM::getEnroll($request->id);
            if (!empty($data)) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(true,"Data not found.",array());
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        echo json_encode($response);
    }

    public function addReview(Request $request)
    {
        if ($request->enroll_id!="" && $request->student_id!="" && $request->rating!="" && $request->review!="") {
            $data['isreview'] = 1;
            $data['rating'] = $request->rating;
            $data['review'] = $request->review;
            $data['ratingdate'] = date('Y-m-d H:i:s');
            $where = array('student_id' => $request->student_id,'id'=>$request->enroll_id);
            $isInsert = GenericM::updateData('tbl_enroll_course',$where,$data);
            if ($isInsert) {
                $response = $this->responseData(true,"Review and rating submitted successfully.","");
            }else
            {
                $response = $this->responseData(false,"Review and rating not submitted.","");
            }
            
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        echo json_encode($response);
    }


    public function getBlog(Request $request)
    {
        $data = ApiM::getBlog();
        if (!empty($data)) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(false,"Data not found.",array());
        }
        
        echo json_encode($response);
    }

    public function getCoupons(Request $request)
    {
        $data = GenericM::getAllData('tbl_coupon',array('isdelete' =>0,'isactive'=>1));
        if (!empty($data)) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(false,"Data not found.",array());
        }
        
        echo json_encode($response);
    }

    public function getOtp($mobile)
    {
        $response = "";
        if ($mobile!="") {
            //get Otp
            $response = GenericM::getSingleRecord('tbl_student_registration',array('otp'),array('mobile'=>$mobile,'isdelete'=>0,'isverified'=>0));
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.",array());
        }
        dd($response);
    }

    public function filterClass(Request $request)
    {
        $where = array();

        //default set
        $orderby = "tcc.student_original_discount_per";
        $order = "DESC";

        if ($request->sortby!="") {   
            switch ($request->sortby) {
                case 1:
                    //Price - High to Low
                    $orderby = "tcc.final_price";
                    $order = "DESC";
                    break;
                case 2:
                    //Price - Low to High
                    $orderby = "tcc.final_price";
                    $order = "ASC";
                    break;

                case 3:
                    //Popularity
                    $orderby = "tcr.ispopular";
                    $order = "DESC";
                    break;

                case 4:
                    //exclusive course
                    $orderby = "tcc.isExclusive";
                    $order = "DESC";
                    break;
                
                default:
                    $orderby = "tcc.student_original_discount_per";
                    $order = "DESC";
                    break;
            }
        }

            //main course
            if ($request->maincourse_id!="") {
                
                $where['tcc.maincourse_id'] = $request->maincourse_id;    
            }

            //area
            if ($request->area!="") {
                
                $where['tcr.area_id'] = $request->area;    
            }

            //fees
            /*if ($request->fees!="") {
                
                if ($request->sortby==4) {
                	//Exclusive
                    $where['tcc.ex_admission_fees_selection_value'] = $request->fees;  
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    $where['tcc.admission_fees_selection_value'] = $request->fees;  
                    $where['tcc.isExclusive'] = 0;  
                }  
            }*/


            //New Logic for range fees start

            $data['min'] = ApiM::getMinFees();
            $data['max'] = ApiM::getMaxFees();

            if ($request->min!=0 && $request->max!=0) {
                if ($request->sortby==4) {
                    //Exclusive
                    $where_between = [
                        ['tcc.ex_admission_fees_selection_value_final','>=',$request->min],
                        ['tcc.ex_admission_fees_selection_value_final','<=',$request->max]
                    ];  
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    $where_between = [
                        ['tcc.admission_fees_selection_value_final','>=',$request->min],
                        ['tcc.admission_fees_selection_value_final','<=',$request->max]
                    ]; 
                    // $where['tcc.isExclusive'] = 0;  
                }
            }else
            {
                if ($request->sortby==4) {
                    //Exclusive
                    $where_between = [
                        ['tcc.ex_admission_fees_selection_value_final','>=',$data['min']],
                        ['tcc.ex_admission_fees_selection_value_final','<=',$data['max']]
                    ];  
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    $where_between = [
                        ['tcc.admission_fees_selection_value_final','>=',$data['min']],
                        ['tcc.admission_fees_selection_value_final','<=',$data['max']]
                    ]; 
                    // $where['tcc.isExclusive'] = 0;  
                }
            }

            //New Logic for range end

            //trial course
            if ($request->trial_course!="") {
                
                $where['tcc.batch_type'] = 1;   
            }

            //sub course
            if ($request->subcourse_id!="" && $request->maincourse_id!="") {
                
                $where['tcc.subcourse_id'] = $request->subcourse_id;   
            }

            //child course
            if ($request->childcourse_id!="" && $request->maincourse_id!="" && $request->subcourse_id!="") {
                $where['tcc.childcourse_id'] = $request->childcourse_id;   
            }

            
            if ($request->city_id) {
                $where['tcr.city_id'] = $request->city_id;  
            }

        $data['classes'] = ApiM::searchClass($where,$where_between,$orderby,$order);
        $data['offer_text'] = ApiM::getOfferText();
        
        if (!$data['classes']->isEmpty()) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(false,"Data not found.",(Object)[]);
        }

        echo json_encode($response);
    }

    public function editProfile(Request $request)
    {
    	if ($request->student_id!="") {
    		$isdata = 0;
    		if ($request->firstname!="") {
    			$isdata = 1;
    			$data['firstname'] = $request->firstname;
    		}

    		if ($request->lastname!="") {
    			$isdata = 1;
    			$data['lastname'] = $request->lastname;
    		}

    		/*if ($request->schoolname!="") {
    		}*/
    			$isdata = 1;
    			$data['schoolname'] = $request->schoolname;

    		if ($isdata==1) {
    			$isUpdate = GenericM::updateData('tbl_student_registration',array('id'=>$request->student_id),$data);
	    		if ($isUpdate) {
	    			$response = $this->responseData(true,"Profile updated.","");
	    		}else
	    		{
	    			$response = $this->responseData(false,"Profile not updated.","");
	    		}
    		}else
    		{
	    		$response = $this->responseData(false,"Profile not updated.","");
    		}
    	}else
    	{
    		$response = $this->responseData(false,"All Parameter Are Required.","");
        }
        
        echo json_encode($response);
    }

    public function getAdmissionFess()
    {
    	// $data['fees'] = ApiM::getFeesData();

        $data['min'] = ApiM::getMinFees();
        $data['max'] = ApiM::getMaxFees();

    	if (!empty($data['min']) && !empty($data['max'])) {
    		$response = $this->responseData(true,"Data found.",$data);
    	}else
    	{
    		$response = $this->responseData(false,"Data not found.",array());
    	}
    	echo json_encode($response);
    }

    public function getProfile(Request $request)
    {
    	if ($request->student_id!="") {
    		$data = GenericM::getSingleRecord('tbl_student_registration',array('*'),array('isdelete' =>0,'isverified'=>1,'id'=>$request->student_id));
	        if (!empty($data)) {
	            $response = $this->responseData(true,"Data found.",$data);
	        }else
	        {
	            $response = $this->responseData(false,"Data not found.",array());
	        }
    	}else
    	{
    		$response = $this->responseData(false,"All Parameter Are Required.","");
        }
        
        echo json_encode($response);
    }

    public function PaytmResponse(Request $request)
    {
        $response = json_decode($request->response);

        $timeslot_id = $request->timeslot_id;
        $student_id = $request->student_id;
        $istrial = $request->istrial;

        if ($student_id!="" && $timeslot_id!="") {
            if ( 'TXN_SUCCESS' === $response->STATUS ) {

                    $row = StudentM::getCourseData($timeslot_id);   
                    if (!empty($row)) {
                        $data['course_id'] = $row->id;
                        $data['student_id'] = $student_id;
                        $data['class_name'] = GenericM::getSingleRecord('tbl_class_registration','name',array('id'=>$row->class_id))->name;
                        $data['class_id'] = $row->class_id;
                        $data['name'] = $row->name;
                        $data['timeslot_id'] = $timeslot_id;
                        $data['istrial'] = $istrial;
                        $data['start_date'] = $row->start_date;
                        $data['end_date'] = $row->end_date;
                        $data['start_time'] = $row->start_time;
                        $data['end_time'] = $row->end_time;
                        $data['price'] = $row->price;
                        $data['enroll_amount'] = $response->TXNAMOUNT;
                        if ($istrial==0) {
                            $data['isExclusive'] = $row->isExclusive;
                                if ($row->isExclusive==0) {
                                    //if Not Exclusive
                                    $data['owner_service_charge_per'] = $row->owner_service_charge_per;
                                    $data['owner_service_charge'] = $row->owner_service_charge;
                                    $data['client_discount_per'] = $row->client_discount_per;
                                    $data['client_discount'] = $row->client_discount;
                                    $data['total_discount_per'] = $row->total_discount_per;
                                    $data['final_price'] = $row->final_price;
                                    $data['admission_fees_selection'] = $row->admission_fees_selection;
                                    $data['admission_fees_selection_value'] = $row->admission_fees_selection_value;
                                    $data['owner_service_charge_student_discount_per'] = $row->owner_service_charge_student_discount_per;
                                    $data['owner_service_charge_student_discount_value'] = $row->owner_service_charge_student_discount_value;
                                    $data['owner_service_charge_owner_discount_per'] = $row->owner_service_charge_owner_discount_per;
                                    $data['owner_service_charge_owner_discount_value'] = $row->owner_service_charge_owner_discount_value;
                                    $data['gst_per'] = $row->gst_per;
                                    $data['gst_value'] = $row->gst_value;
                                    $data['final_owner_charge'] = $row->final_owner_charge;
                                    $data['student_addmission_fees'] = $row->student_addmission_fees;
                                    $data['student_original_discount_value'] = $row->student_original_discount_value;
                                    $data['student_original_discount_per'] = $row->student_original_discount_per;
                                }else
                                {
                                    //if Exclusive
                                    $data['owner_service_charge_per'] = $row->ex_owner_service_charge_per;
                                    $data['owner_service_charge'] = $row->ex_owner_service_charge;
                                    $data['client_discount_per'] = $row->ex_client_discount_per;
                                    $data['client_discount'] = $row->ex_client_discount;
                                    $data['total_discount_per'] = $row->ex_total_discount_per;
                                    $data['final_price'] = $row->ex_final_price;
                                    $data['admission_fees_selection'] = $row->ex_admission_fees_selection;
                                    $data['admission_fees_selection_value'] = $row->ex_admission_fees_selection_value;
                                    $data['owner_service_charge_student_discount_per'] = $row->ex_owner_service_charge_student_discount_per;
                                    $data['owner_service_charge_student_discount_value'] = $row->ex_owner_service_charge_student_discount_value;
                                    $data['owner_service_charge_owner_discount_per'] = $row->ex_owner_service_charge_owner_discount_per;
                                    $data['owner_service_charge_owner_discount_value'] = $row->ex_owner_service_charge_owner_discount_value;
                                    $data['gst_per'] = $row->ex_gst_per;
                                    $data['gst_value'] = $row->ex_gst_value;
                                    $data['final_owner_charge'] = $row->ex_final_owner_charge;
                                    $data['student_addmission_fees'] = $row->ex_student_addmission_fees;
                                    $data['student_original_discount_value'] = $row->ex_student_original_discount_value;
                                    $data['student_original_discount_per'] = $row->ex_student_original_discount_per;
                                }
                        }

                        $data['transaction_id'] = $response->TXNID;
                        $data['order_id'] = $response->ORDERID;
                        $data['txn_details'] = json_encode($response);
                        $data['date'] = date('Y-m-d H:i:s');
                        // dd($data);
                        $isInsert = GenericM::insertData('tbl_enroll_course',$data);
                        if ($isInsert) {
                            $up_data = array();
                            //update if exclusive count ++ in course tbl
                            if ($row->isExclusive==1) {
                                $up_data['total_ex_enroll'] = $row->total_ex_enroll + 1;
                                $where = array('id' =>$row->id);
                                $isUpdate = GenericM::updateData('tbl_class_course',$where,$up_data);
                            // dd($row->isExclusive);
                            }
                            $response = $this->responseData(true,"Enrolled successfully.","");
                        }else
                        {
                            $response = $this->responseData(false,"Enrolled not done,try again.","");
                        }
                    }   
            }
            else if( 'TXN_FAILURE' === $response->STATUS ){
                $response = $this->responseData(false,"Enrolled not done,try again.","");
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }   
        echo json_encode($response);
    }

    public function relatedSearch(Request $request)
    {
        if ($request->class_id!="") {
           $where = array();

            //default set
            $orderby = "tcc.student_original_discount_per";
            $order = "DESC";

                //main course
                if ($request->maincourse_id!="") {
                    
                    $where['tcc.maincourse_id'] = $request->maincourse_id;    
                }

                //area
                if ($request->area!="") {
                    
                    $where['tcr.area_id'] = $request->area;    
                }

                //sub course
                if ($request->subcourse_id!="" && $request->maincourse_id!="") {
                    
                    $where['tcc.subcourse_id'] = $request->subcourse_id;   
                }

                //child course
                if ($request->childcourse_id!="" && $request->maincourse_id!="" && $request->subcourse_id!="") {
                    $where['tcc.childcourse_id'] = $request->childcourse_id;   
                }

                
                if ($request->city_id) {
                    $where['tcr.city_id'] = $request->city_id;  
                }

            $data['classes'] = ApiM::relatedClass($where,$orderby,$order,$request->class_id);
            
            if (!$data['classes']->isEmpty()) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(false,"Data not found.",(Object)[]);
            } 
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }

        echo json_encode($response);
    }

    public function getAllMainCategories()
    {
        $data = StudentM::getAllMainCategories('tbl_main_course',array('isdelete' =>0,'status' =>1));
        if (!empty($data)) {
            $response = $this->responseData(true,"Data found.",$data);
        }else
        {
            $response = $this->responseData(true,"Data not found.",array());
        }
        echo json_encode($response);
    }

    public function getClassMainCategory(Request $request)
    {
        if ($request->class_id!="") {
            $data = StudentM::getMainCourseByClass($request->class_id);
            if (!empty($data)) {
                $response = $this->responseData(true,"Data found.",$data);
            }else
            {
                $response = $this->responseData(false,"Data not found.",array());
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        
        echo json_encode($response);
    }

    public function forgotPassword(Request $request)
    {
        if ($request->email!="") {
            //check email if exists or not
            $row = GenericM::getSingleRecord('tbl_student_registration',array('id'),array('email'=>$request->email,'isdelete'=>0,'isverified'=>1));
            if ($row) {

                //add link data
                $data['user_id'] = $row->id;
                $data['type'] = 1;
                $data['isused'] = 0;
                $data['date'] = date('Y-m-d H:i:s');
                $isinsert = GenericM::insertData('tbl_forgot_link',$data);
                if ($isinsert) {
                    //send mail
                    $d = ['id' => $isinsert,'user_type' => 1];
                    try {
                        $m = \Mail::to($request->email)->send(new ClientForgot($d));
                    } catch (\Exception $e) {
                        
                    }
                    
                    $response = $this->responseData(true,"Please check your email to change password.","");
                }
            }else
            {
                $response = $this->responseData(false,"Invalid email.","");
            }
        }else
        {
            $response = $this->responseData(false,"All Parameter Are Required.","");
        }
        
        echo json_encode($response);
    }
}
