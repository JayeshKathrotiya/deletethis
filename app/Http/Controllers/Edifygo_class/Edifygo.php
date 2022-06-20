<?php
namespace App\Http\Controllers\Edifygo_class;

use App\EdifygoM;
use App\GenericM;
use App\ClassM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\client_mail;
use App\Mail\Allmail;

class Edifygo extends Sms
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$ip = \Request::ip();
        dd($ip);
        dd(Location::get($ip));*/
        if ($request->session()->exists('class_login_session')) {
            return redirect('/class/profile');
        }
        $city_id = '';
        if(session('city_id') == '')
        {
            $request->session()->put('city_id', 1); 
            $city_id = 1;
        } else {
            $city_id = session('city_id');
        }
        $where = array('isdelete' => 0);
        $where1 = array('isdelete' => 0);
        $data['exclusive_slider'] = EdifygoM::getsliderforhome('tbl_home_slider',$city_id);
        $data['categories_slider'] = EdifygoM::getslider('tbl_category_slider',$where);
        $data['feature_slider'] = EdifygoM::getsliderjoin3('tbl_feature_slider',$city_id);
        $data['promoter_slider'] = EdifygoM::getsliderjoin1('tbl_promoter_slider',$city_id);
        $data['newly_slider'] = EdifygoM::getsliderjoin4('tbl_newly_slider',$city_id);
        $data['sponsored_slider'] = EdifygoM::getsliderjoin2('tbl_sponsored_slider',$city_id);
        $data['promocode_slider'] = EdifygoM::getslidersingle('tbl_promocode_slider',$where1);
        $data['testimonial'] = GenericM::getAllData('tbl_testimonial',array('isdelete'=>0,'isactive'=>1));
        $data['blogs'] = GenericM::getAllData('tbl_blog',array('isdelete'=>0,'isactive'=>1));
        $data['categories'] = EdifygoM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'position');
        $data['location'] = EdifygoM::getLocationData();
        $data['know_us'] = GenericM::getAllData('tbl_know_us',array('isdelete' =>0,'isactive' =>1));
        // dd($data['newly_slider']);
        /*$city = EdifygoM::fetch_city();
        if (!$city->isEmpty()) {
            $request->session()->put('all_city_session', $city); 
        }*/
        // dd($data['newly_slider']);
        return view('edifygoclass/index',$data);
    }

    //change session
    public function change_session(Request $request)
    {
        if($request->city_id != "") {
            $request->session()->put('city_id', $request->city_id); 
        }
        echo json_encode(true);
    }


    public function searchClass(Request $request)
    {

        // dd(\Request::segment(3));
        // dd($request);
        /*$request->session()->forget('filter');
        if ($request->sortby!="") {
            $request->session()->put('filter', $request->sortby);   
            // dd(session('filter'));   
            // dd($request->sortby);   
            switch ($request->sortby) {
                case 1:
                    //Price - High to Low
                    $where = array();
                    $orderby = "final_price";
                    $order = "DESC";
                    break;
                case 2:
                    //Price - High to Low
                    $where = array();
                    $orderby = "final_price";
                    $order = "ASC";
                    break;
                
                default:
                    # code...
                    break;
            }
        }else
        {
            $orderby = "total_discount_per";
            $order = "DESC";

            if ($request->maincourse_id!="" && $request->area!="") {
                $where = array('tcr.area_id'=>$request->area,'tcc.maincourse_id'=>$request->maincourse_id);
            }else if($request->maincourse_id!="" && $request->area=="")
            {
                $where = array('tcc.maincourse_id'=>$request->maincourse_id);
            }else if($request->maincourse_id=="" && $request->area!="")
            {
                $where = array('tcr.area_id'=>$request->area);
            }else
            {
                $where = array();
            }
        }*/
        // dd($request);

         $method = \Request::getQueryString();
         if (!$method) {
            //forgot all session
            $request->session()->forget('area_session');
            // $request->session()->forget('fees_session');
            // $request->session()->forget('rating_session');
            $request->session()->forget('maincourse_session');
            $request->session()->forget('subcourse_session');
            $request->session()->forget('childcourse_session');
            $request->session()->forget('filter');
            $request->session()->forget('trial_course');
            //fees new logic
            $request->session()->forget('minfees');
            $request->session()->forget('maxfees');

            $orderby = "tcc.student_original_discount_per";
            $order = "DESC";
         }

        $where = array();

        if ($request->sortby!="") {
            $request->session()->put('filter', $request->sortby);    
            switch ($request->sortby) {
                case 1:
                    //Price - High to Low
                    $orderby = "tcc.final_price";
                    $order = "DESC";
                    break;
                case 2:
                    //Price - High to Low
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

                /*case 5:
                    //Trial Course['Batch Type']
                    $orderby = "tcc.batch_type";
                    $order = "DESC";
                    break;*/
                
                default:
                    # code...
                    break;
            }
        }
        else if(session('filter'))
        {
            switch (session('filter')) {
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
                    
                /*case 5:
                    //Trial Course['Batch Type']
                    $orderby = "tcc.batch_type";
                    $order = "DESC";
                    break;*/

                default:
                    $orderby = "tcc.student_original_discount_per";
                    $order = "DESC";
                    break;
            }
        }else
        {
            $orderby = "tcc.student_original_discount_per";
            $order = "DESC";
        }


            $maincourse_id = "";
            if ($request->maincourse_id!="") {
                $maincourse_id = $request->maincourse_id;
            }else if (\Request::segment(3)!="") {
                
                $maincourse_id = \Request::segment(3);
            }

            $subcourse_id = "";
            if ($request->subcourse_id!="") {
                $subcourse_id = $request->subcourse_id;
            }else if (\Request::segment(5)!="") {
                
                $subcourse_id = \Request::segment(5);
            }

            //main course
            if ($maincourse_id!="") {
                
                $where['tcc.maincourse_id'] = $maincourse_id;  
                $request->session()->put('maincourse_session', $maincourse_id);   
            }
            else if(session('maincourse_session'))
            {
                $where['tcc.maincourse_id'] = session('maincourse_session');    
            }

            //area
            if ($request->area!="") {
                
                $where['tcr.area_id'] = $request->area;  
                $request->session()->put('area_session', $request->area);   
            }
            else if(session('area_session'))
            {
                $where['tcr.area_id'] = session('area_session');    
            }

            //fees
            /*if ($request->fees!="") {
                
                if (session('filter')==4) {
                    $where['tcc.ex_admission_fees_selection_value'] = $request->fees;  
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    // dd("if1");
                    $where['tcc.admission_fees_selection_value'] = $request->fees;  
                    $where['tcc.isExclusive'] = 0;  
                }
                $request->session()->put('fees_session', $request->fees);   
            }
            else if(session('fees_session'))
            {
                if (session('filter')==4) {
                    $where['tcc.ex_admission_fees_selection_value'] = session('fees_session');    
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    // dd("if2");
                    $where['tcc.admission_fees_selection_value'] = session('fees_session');    
                    $where['tcc.isExclusive'] = 0;  
                }
            }*/

            $data['min'] = EdifygoM::getMinFees();
            $data['max'] = EdifygoM::getMaxFees();

            if ($request->my_range) {
                $rangeArr = explode(';', $request->my_range);
                if (!empty($rangeArr)) {
                    if (session('filter')==4) {
                        $where_between = [
                            ['tcc.ex_admission_fees_selection_value_final','>=',$rangeArr[0]],
                            ['tcc.ex_admission_fees_selection_value_final','<=',$rangeArr[1]]
                        ];  
                        $where['tcc.isExclusive'] = 1;  
                    }else
                    {
                        $where_between = [
                            ['tcc.admission_fees_selection_value_final','>=',$rangeArr[0]],
                            ['tcc.admission_fees_selection_value_final','<=',$rangeArr[1]]
                        ]; 
                        // $where['tcc.isExclusive'] = 0;  
                    }
                    $request->session()->put('minfees', $rangeArr[0]);   
                    $request->session()->put('maxfees', $rangeArr[1]);   
                }
            }else if(session('minfees')!="" && session('maxfees')!="")
            {
                if (session('filter')==4) {
                    $where_between = [
                        ['tcc.ex_admission_fees_selection_value_final','>=',session('minfees')],
                        ['tcc.ex_admission_fees_selection_value_final','<=',session('maxfees')]
                    ];  
                    $where['tcc.isExclusive'] = 1;  
                }else
                {
                    $where_between = [
                        ['tcc.admission_fees_selection_value_final','>=',session('minfees')],
                        ['tcc.admission_fees_selection_value_final','<=',session('maxfees')]
                    ]; 
                    // $where['tcc.isExclusive'] = 0;  
                }
            }else
            {
                if (session('filter')==4) {
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
            //rating
            /*if ($request->rating!="") {
                $request->session()->put('rating_session', $request->rating);   
            }*/

            //trial course
            if ($request->trial_course!="") {
                
                $where['tcc.batch_type'] = 1;  
                $request->session()->put('trial_course', 1);  
            }
            else if(session('trial_course'))
            {
                $where['tcc.batch_type'] = 1;    
            }

            //sub course
            if ($subcourse_id!="" && $maincourse_id!="") {
                
                $where['tcc.subcourse_id'] = $subcourse_id;  
                $request->session()->put('subcourse_session', $subcourse_id);  
            }
            else if(session('subcourse_session'))
            {
                $where['tcc.subcourse_id'] = session('subcourse_session');    
            }

            //child course
            if ($request->childcourse_id!="" && $maincourse_id!="" && $subcourse_id!="") {
                $where['tcc.childcourse_id'] = $request->childcourse_id;  
                $request->session()->put('childcourse_session', $request->childcourse_id);  
            }
            else if(session('childcourse_session'))
            {
                $where['tcc.childcourse_id'] = session('childcourse_session');   
            }

            //popular course
            /*if (session('filter')==3) {
                $where['tcr.ispopular'] = 1;  
            }*/

            //exclusive course
            /*if (session('filter')==4) {
                $where['tcc.isExclusive'] = 1;  
            }*/

            //trial course
            /*if (session('filter')==5) {
                $where['tcc.batch_type'] = 1;  
            }*/

            
            if (session('city_id')) {
                $where['tcr.city_id'] = session('city_id');  
            }

        $data['classes'] = EdifygoM::searchClass($where,$where_between,$orderby,$order);

        $data['related_search'] = EdifygoM::getrelatedSearch();
        /*$data['city'] = EdifygoM::getAllData('tbl_master_city',array('isdelete'=>0),'city_name');
        $data['area'] = EdifygoM::getAllData('tbl_master_area',array('isdelete'=>0),'area_name');*/
        $data['area'] = EdifygoM::getLocationData();
        $data['coupon'] = EdifygoM::getCouponData();

        $data['fees'] = EdifygoM::getFeesData();
        // dd($data);
        $data['course'] = EdifygoM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'position');
        $data['subcourse'] = EdifygoM::getAllData('tbl_sub_course',array('isdelete'=>0),'name');
        $data['childcourse'] = EdifygoM::getAllData('tbl_child_course',array('isdelete'=>0),'name');
        if (!$data['classes']->isEmpty()) {
            if ($request->area) {
                // $data['location'] = EdifygoM::getselectedLocationData($request->area);
                //add related search data in tbl_related_search
                $add_data['area_id'] = $request->area;
                $add_data['maincourse_id'] = $maincourse_id;
                $add_data['date'] = date('Y-m-d H:i:s');
                if (!empty($add_data)) {
                    //check if aleready exists
                    $isExists = GenericM::getSingleRecord('tbl_related_search','id',array('area_id'=>$request->area,'maincourse_id'=>$request->maincourse_id));
                    if (empty($isExists)) {
                        GenericM::insertData('tbl_related_search',$add_data);
                    }
                }
            }
            // dd($data);
            return view('edifygoclass/class/filter-class',$data);
        }else
        {
            return view('edifygoclass/class/filter-class',$data);
        }
    }

    public function viewProfile(Request $request)
    {
        $data['class'] = ClassM::getClassData();
        return view('edifygoclass/view_profile',$data);
    }

    public function registration()
    {
         $data['country'] = EdifygoM::getAllData('tbl_master_country',array('isdelete' =>0),'country_name');
         $data['know_us'] = GenericM::getAllData('tbl_know_us',array('isdelete' =>0,'isactive' =>1));
        return view('edifygoclass/registration',$data);
    }

    public function checkAddClassExists(Request $request)
    {
        if ($request->name!="") {
            $isExists = GenericM::getSingleRecord('tbl_class_registration','id',array('name'=>$request->name,'isdelete'=>0,'isverified'=>1));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkEditClassExists(Request $request)
    {
        if ($request->class_name!="") {
            $where = [
                ['id','<>',$request->hdclass_id],
                ['name',$request->class_name],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_class_registration','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkAddEmailExists(Request $request)
    {
        if ($request->email!="") {
            $isExists = GenericM::getSingleRecord('tbl_class_registration','id',array('email'=>$request->email,'isdelete'=>0,'isverified'=>1));
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
            $isExists = GenericM::getSingleRecord('tbl_class_registration','id',array('mobile'=>$request->mobile,'isdelete'=>0,'isverified'=>1));
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

        $request->session()->forget('class_reg_session');
        $request->session()->forget('class_reg_mobile_session');
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
                    $isInsert = GenericM::insertData('tbl_class_registration',$data);
                    if ($isInsert) {
                        $data['name'] = $request->name;
                        $data['country_id'] = $request->country_id;
                        $data['state_id'] = $request->state_id;
                        $data['city_id'] = $request->city_id;
                        $data['area_id'] = $request->area_id;
                        $data['firstname'] = $request->firstname;
                        $data['lastname'] = $request->lastname;
                        $data['address'] = $request->address;
                        $data['email'] = $request->email;
                        $data['password'] = sha1($request->password);
                        $data['know_is_id'] = $request->know_us;
                        $data['isterms'] = $request->cl_terms;
                        $data['inserted_id'] = $isInsert;
                        // dd($data);
                        $request->session()->put('class_reg_session',$data);
                        $request->session()->put('class_reg_mobile_session',$data['mobile']);
                        return redirect('/class/otp');
                    }else
                    {
                        //not inserted
                        session()->flash('error-msg','Class not created.');
                    }
                }else
                {
                    session()->flash('error-msg','Class not created.');
                    //OTP not sent
                }
            }
        }
        return redirect('/class/registration');

    }

    public function checkEditMobileExists(Request $request)
    {
        if ($request->mobile!="") {
            $where = [
                ['id','<>',$request->inserted_id],
                ['mobile',$request->mobile],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_class_registration','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function otp()
    {
        return view('edifygoclass/registration_otp_verify');
    }

    public function resendOtp(Request $request)
    {
        if ($request->mobile!="" && $request->id) {
            $data['otp'] = rand(1000,9999);
            $err = $this->sendOTP($data['otp'],$request->mobile);
            if (!$err) { 
                    $where = array('id' => $request->id);
                    $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
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
                    $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
                    if ($isUpdate) {
                        $request->session()->forget('class_reg_mobile_session');
                        $request->session()->put('class_reg_mobile_session',$data['mobile']);
                        session()->flash('success-msg','Mobile updated successfully.');

                    }else
                    {
                        session()->flash('error-msg','Mobile not updated.');
                    }
                }else
                {
                    session()->flash('error-msg','Mobile not updated.');
                }
                return redirect('/class/otp');
            }
            else
            {
                //verify OTP
                if ($request->otp!="" && $request->inserted_id!="") {

                    $isExists = GenericM::getSingleRecord('tbl_class_registration','otp',array('id'=>$request->inserted_id));
                    if (!empty($isExists)) {
                        if ($isExists->otp==$request->otp) {
                            $request->session()->forget('class_reg_mobile_session');
                            //update records
                            $up_data = $request->session()->pull('class_reg_session');
                            $data['name'] = $up_data['name'];
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
                            $data['know_is_id'] = $up_data['know_is_id'];
                            $data['isterms'] = $up_data['isterms'];
                            $data['isverified'] = 1;
                            $data['issubscribe'] = 1;
                            // dd($data);
                            $isUpdate = GenericM::updateData('tbl_class_registration',array('id'=>$request->inserted_id),$data);
                            if ($isUpdate) {
                                //send FAQ mail
                                try {
                                    \Mail::to($data['email'])->send(new client_mail());
                                } catch (\Exception $e) {
                                    
                                }

                                //send sign up mail
                                $all_type = ['type' => 1];
                                try {
                                    \Mail::to($data['email'])->send(new Allmail($all_type));
                                } catch (\Exception $e) {
                                    
                                }

                                $request->session()->put('class_login_session_id', $request->inserted_id);
                                $request->session()->put('class_login_session', $data['email']);
                                session()->flash('success-msg','Login successfully.');
                                return redirect('/class/profile');
                            }

                        }else
                        {
                            session()->flash('error-msg','Invalid otp.');
                            return redirect('/class/otp');
                        }
                    }else
                    {
                        session()->flash('error-msg','Otp not verifyed.');
                        return redirect('/class/otp');
                    }
                }else
                {
                    session()->flash('error-msg','Otp not verifyed.');
                    return redirect('/class/otp');
                }
            }
        }
    }

    public function profile()
    {
        $data['class'] = ClassM::getClassData();
        // $data['main_courses'] = GenericM::getAllData('tbl_main_course',array('isdelete' =>0,'status'=>1));
        return view('edifygoclass/profile-details',$data);
    }

    public function edit_profile()
    {
        $data['class'] = ClassM::getClassData();
        // dd($data);
        return view('edifygoclass/edit_profile',$data);
    }

    public function updateProfile(Request $request)
    {
        $class_id = $request->hdclass_id;
        $data['name'] = $request->class_name;
        $data['address'] = $request->address;
        $data['overview'] = $request->class_overview;
        $data['gst_no'] = $request->gst;

        //upload if class logo selected
        if ($request->file('class_logo')) {
            $class_logo_path = $request->file('class_logo')->store('class_logo','public');
            if($class_logo_path) {
                $data['class_logo'] = substr($class_logo_path, strrpos($class_logo_path, '/' )+1);
            }
        }
        //upload if  class_video selected
        if ($request->file('class_video')) {
            $class_video_path = $request->file('class_video')->store('class_video','public');
            if($class_video_path) {
                $data['class_video'] = substr($class_video_path, strrpos($class_video_path, '/' )+1);
            }
        }

        //upload if  multiple class_images selected
        $hdarrcls = explode(',',$request->hdarrcls);
        $cl_img_data['class_id'] = $class_id;
        $cl_img_data['isdelete'] = 0;
        for ($i=0; $i <count($hdarrcls) ; $i++) { 
            if ($request->file('classimg'.$hdarrcls[$i].'')) {
                $class_img_path = $request->file('classimg'.$hdarrcls[$i].'')->store('class_images','public');
                if($class_img_path) {
                    $cl_img_data['image'] = substr($class_img_path, strrpos($class_img_path, '/' )+1);
                    $isInsert = GenericM::insertData('tbl_class_images',$cl_img_data);
                }
            }
        }


        //upload multiple PDF
        //1.upload if  multiple class_images selected

        $hdarrpdf = explode(',',$request->hdarrpdf);
        $pdf_data['class_id'] = $class_id;
        $pdf_data['isdelete'] = 0;
        $pdf_data['date'] = date('Y-m-d H:i:s');
        for ($i=0; $i <count($hdarrpdf) ; $i++) { 
            if ($request->file('coursepdf'.$hdarrpdf[$i].'')) {
                $pdfpath = $request->file('coursepdf'.$hdarrpdf[$i].'')->store('class_pdf','public');
                if($pdfpath) {
                    $pdf_data['pdf'] = substr($pdfpath, strrpos($pdfpath, '/' )+1);
                    $v1 = 'pdf_title'.$hdarrpdf[$i].'';
                    $pdf_data['title'] = $request[$v1];
                    $isInsert1 = GenericM::insertData('tbl_class_pdf',$pdf_data);
                }
            }

        }

        //2.upload multiple you tube links

        $hdarrtube = explode(',',$request->hdarrtube);
        $tube_data['class_id'] = $class_id;
        $tube_data['isdelete'] = 0;
        $tube_data['date'] = date('Y-m-d H:i:s');
        for ($j=0; $j <count($hdarrtube) ; $j++) { 

            $tube_v1 = 'tube_title'.$hdarrtube[$j].'';
            if($request[$tube_v1]) {
                $tube_data['title'] = $request[$tube_v1];

                $tube_v2 = 'tube_url'.$hdarrtube[$j].'';
                $tube_data['url'] = $request[$tube_v2];

                $isInsert2 = GenericM::insertData('tbl_class_youtube_links',$tube_data);
            }
        }

        //upload if  multiple class_images selected
        $hdarrrnk = explode(',',$request->hdarrrnk);
        // dd($hdarrrnk);
        $rnk_img_data['class_id'] = $class_id;
        $rnk_img_data['isdelete'] = 0;
        for ($i=0; $i <count($hdarrrnk) ; $i++) { 
            if ($request->file('rankerimg'.$hdarrrnk[$i].'')) {
                $ranker_img_path = $request->file('rankerimg'.$hdarrrnk[$i].'')->store('ranker_images','public');
                if($ranker_img_path) {
                    $rnk_img_data['image'] = substr($ranker_img_path, strrpos($ranker_img_path, '/' )+1);
                }

                $rnk_v1 = 'rnk_title'.$hdarrrnk[$i].'';
                // $rnk_v2 = 'ranker_per'.$hdarrrnk[$i].'';

                
                // dd($hdarrrnk);
                $rnk_img_data['title'] = $request[$rnk_v1];
                // $rnk_img_data['per'] = $request[$rnk_v2];
                $isExists = GenericM::getSingleRecord('tbl_class_rankers','id',array('id'=>$hdarrrnk[$i]));
                if ($isExists) {
                    $data_title['title'] = $request[$rnk_v1];
                    // $data_title['per'] = $request[$rnk_v2];
                    $isUpdate_title = GenericM::updateData('tbl_class_rankers',array('id'=>$hdarrrnk[$i]),$data_title);
                }else
                {
                    $isInsert = GenericM::insertData('tbl_class_rankers',$rnk_img_data);
                }

            }else
            {
                $rnk_v1 = 'rnk_title'.$hdarrrnk[$i].'';
                // $rnk_v2 = 'ranker_per'.$hdarrrnk[$i].'';

                
                // dd($hdarrrnk);
                $rnk_img_data['title'] = $request[$rnk_v1];
                // $rnk_img_data['per'] = $request[$rnk_v2];
                $isExists = GenericM::getSingleRecord('tbl_class_rankers','id',array('id'=>$hdarrrnk[$i]));
                if ($isExists) {
                    $data_title['title'] = $request[$rnk_v1];
                    // $data_title['per'] = $request[$rnk_v2];
                    $isUpdate_title = GenericM::updateData('tbl_class_rankers',array('id'=>$hdarrrnk[$i]),$data_title);
                }
            }


        }

        $data['date'] = date('Y-m-d H:i:s');
        $data['isapprove'] = 0;
        $isUpdate = GenericM::updateData('tbl_class_registration',array('id'=>$class_id),$data);
        if ($isUpdate) {
            //send edit course mail
            $class_row = GenericM::getSingleRecord('tbl_class_registration','email',array('id'=>$class_id));
            // dd($stud_row);
            if ($class_row->email) {
                $all_type = ['type' => 3];

                try {
                    // \Mail::to($class_row->email)->send(new Allmail($all_type));
                } catch (\Exception $e) {
                    
                }
            }

            session()->flash('success-msg','Class updated successfully.');
        }else
        {
            session()->flash('error-msg','Class not updated.');
        }
        if ($request->isadmin) {
            return redirect('/classes');
        }else
        {
            return redirect('/edit_profile');
        }
    }

    public function deleteClassImage(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_images',$where,$data);
        if ($isUpdate) {
            echo json_encode(TRUE);
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function updateclassImage(Request $request)
    {
        if ($request->id!="" && $request->class_id!="") {
            if ($request->file('up_classimg')) {
                    $class_img_path = $request->file('up_classimg')->store('class_images','public');
                    if($class_img_path) {

                        $data['image'] = substr($class_img_path, strrpos($class_img_path, '/' )+1);
                        $where = array('id' => $request->id);
                        $isUpdate = GenericM::updateData('tbl_class_images',$where,$data);

                        $regdata['isapprove'] = 0;
                        $where1 = array('id' => $request->class_id);
                        $isUpdate1 = GenericM::updateData('tbl_class_registration',$where1,$regdata);
                        if ($isUpdate) {
                            echo json_encode($data['image']);
                        }else
                        {
                            echo json_encode(FALSE);
                        }
                    }
                }else
                {
                    echo json_encode(FALSE);
                }
            }else
            {
                echo json_encode(FALSE);
            }
    }


    public function deleteRankerImage(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_rankers',$where,$data);
        if ($isUpdate) {
            echo json_encode(TRUE);
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function updaterankerImage(Request $request)
    {
        if ($request->id!="" && $request->class_id!="") {
            if ($request->file('up_rankerimg')) {
                    $ranker_img_path = $request->file('up_rankerimg')->store('ranker_images','public');
                    if($ranker_img_path) {

                        $data['image'] = substr($ranker_img_path, strrpos($ranker_img_path, '/' )+1);
                        $where = array('id' => $request->id);
                        $isUpdate = GenericM::updateData('tbl_class_rankers',$where,$data);

                        $regdata['isapprove'] = 0;
                        $where1 = array('id' => $request->class_id);
                        $isUpdate1 = GenericM::updateData('tbl_class_registration',$where1,$regdata);
                        if ($isUpdate) {
                            echo json_encode($data['image']);
                        }else
                        {
                            echo json_encode(FALSE);
                        }
                    }
                }else
                {
                    echo json_encode(FALSE);
                }
            }else
            {
                echo json_encode(FALSE);
            }
        }

        public function payment()
        {
            $data['class'] = ClassM::getClassData();
            $data['subscription'] = ClassM::getSubscriptionData();
            return view('edifygoclass/payment/index',$data);
        }

        public function subscribe(Request $request)
        {
            if ($request->class_id!="") {
                $subscription = ClassM::getSubscriptionData();
                if ($request->pay==1) {

                    //paytm code start
                    $order_id = uniqid()."X".rand(1000,9999)."-".$request->class_id;
                    $data_for_request = $this->handlePaytmRequest( $order_id, $subscription->subscription_charge );
                    $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
                    $paramList = $data_for_request['paramList'];
                    $checkSum = $data_for_request['checkSum'];
                    return view( 'paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
                    //paytm code end
                    
                }else
                {
                    $data['issubscribe'] = 2;
                }

                $where = array('id' => $request->class_id);
                $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
                if ($isUpdate) {
                    session()->flash('success-msg','subscribed successfully.');
                }else
                {
                    session()->flash('error-msg','subscription not done,try again.');
                }
            }else
            {
                session()->flash('error-msg','subscription not done,try again.');
            }

            return redirect('/');
        }

        public function changePassword(Request $request)
        {
            $data['class'] = ClassM::getClassData();
            return view('edifygoclass/change_password',$data);
        }

        public function updatePassword(Request $request)
        {
            $data['password'] = sha1($request->new_passwd);
            $data['date'] = date('Y-m-d H:i:s');
            $where = array('id' => $request->hdclass_id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Password updated successfully.');
            }else
            {
                session()->flash('error-msg','Password not updated.');
            }

            return redirect('/class/profile');
        }


    public function terms()
    {
        return view('edifygoclass/terms');
    }

    public function contactUs(Request $request)
    {
        if ($request->isclass==1) {
            //class request
            $data['name'] = $request->name;
            $data['classname'] = $request->classname;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['city_id'] = $request->cl_contact_city;
            $data['know_us_id'] = $request->cl_know;
            $data['msg'] = $request->cl_msg;
            $data['role'] = 1;
            $data['date'] = date('Y-m-d H:i:s');
        }else
        {
            //student request
            $data['name'] = $request->stud_name;
            $data['email'] = $request->stud_email;
            $data['mobile'] = $request->stud_mobile;
            $data['city_id'] = $request->stud_contact_city;
            $data['know_us_id'] = $request->stud_know;
            $data['msg'] = $request->stud_msg;
            $data['role'] = 0;
            $data['date'] = date('Y-m-d H:i:s');
        }

        $isinsert = GenericM::insertData('tbl_contactus',$data);
        if ($isinsert) {
            //send contact us  mail
            if ($data['email']) {
                $all_type = ['type' => 6,'name'=>$data['name']];
                try {
                    \Mail::to($data['email'])->send(new Allmail($all_type));
                } catch (\Exception $e) {
                    
                }
            }
            session()->flash('success-msg','Your record inserted successfully.');
        }else
        {
            session()->flash('error-msg','Your record not inserted.');
        }
        return redirect('/');
    }

    public function viewBlog($blog)
    {
        if ($blog) {
            $row['blog'] = GenericM::getSingleRecord('tbl_blog','*',array('id'=>$blog));
            if (!empty($row['blog'])) {
                return view('/edifygoclass/blog_view',$row);
            }else
            {
                session()->flash('error-msg','Blog not found.');
                return redirect('/');
            }
        }
    }
}
