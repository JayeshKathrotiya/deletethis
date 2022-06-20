<?php

namespace App\Http\Controllers\Edifygo_class;

use App\ECourseM;
use App\ClassM;
use App\StudentM;
use App\GenericM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Allmail;

class ECourse extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['class'] = ClassM::getClassData();
        if ($data['class']->issubscribe==1 || $data['class']->issubscribe==2) {
            $data['main_courses'] = ECourseM::getAllData('tbl_main_course',array('isdelete' =>0,'status'=>1),'position');
            $data['setting'] = ECourseM::getExclusiveCharge();
            return view('edifygoclass/course/create_course',$data);
        }else
        {
            session()->flash('error-msg','Please subscribed first.');
            return redirect('/class/profile');
        }
    }

    public function setCourseSession(Request $request)
    {
        $request->session()->forget('setCourseSession');
        $request->session()->forget('setMainCourseSession');
        if ($request->course_id!="") {
            $request->session()->put('setCourseSession', $request->course_id);  
            //get main course id using course_id
            $row = GenericM::getSingleRecord('tbl_class_course',array('maincourse_id'),array('id'=>$request->course_id));
            if (!empty($row)) {
                $request->session()->put('setMainCourseSession', $row->maincourse_id);  
            }
        }
        echo json_encode(TRUE);
    }

    public function viewCourse(Request $request)
    {
        $class_id = \Request::segment(2);
        $maincourse_id = session('setMainCourseSession');
        $request->session()->forget('defaultselectcoursetab');
        if ($maincourse_id=="") {
            $maincourse_id = $request->maincourseselect;
            if ($maincourse_id!="") {
                $request->session()->put('setMainCourseSession', $maincourse_id); 
                $request->session()->put('defaultselectcoursetab', 1); 
            }
            /*else if(\Request::segment(4)!="")
            {
                $maincourse_id = \Request::segment(4);
                $request->session()->put('setMainCourseSession', $maincourse_id); 
                $request->session()->put('defaultselectcoursetab', 1); 
            }*/
        }
        if ($class_id!="") {
            $data['class'] = ClassM::getClassDataByID($class_id);

            if ($maincourse_id!="" && $maincourse_id!="all") {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1,'tmc.id'=>$maincourse_id);
            }else
            {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1);
            }

            $data['maincourse'] = ClassM::getMainCourseByClass($class_id);
            $data['courses'] = ECourseM::getAllCourse($where1);

            $data['count'] = ECourseM::getAllCount($class_id);
            $data['ratings'] = ECourseM::getAllRating($class_id);
            $data['faqs'] = ECourseM::getAllFaq($class_id);

            // dd($data);
            if (!$data['courses']->isEmpty() && !empty($data['class'])) {
                return view('edifygoclass/course/index',$data);
            }else
            {
                return redirect('/');
            }
        }else
        {
            return redirect('/');
        }
    }

    public function getSubcourse(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('main_course_id' => $id,'status'=>1,'isdelete' => 0);
             $result = ECourseM::getAllData('tbl_sub_course',$where,'name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function getFilterSubcourse(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('main_course_id' => $id,'status'=>1,'isdelete' => 0);
             $result = ECourseM::getAllData('tbl_sub_course',$where,'name');
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
             $result = ECourseM::getAllData('tbl_child_course',$where,'name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function getFilterchildcourse(Request $request)
    {
        $id = $request->id;
        if ($id) {
             $where = array('sub_course_id' => $id,'status'=>1,'isdelete' => 0);
             $result = ECourseM::getAllData('tbl_child_course',$where,'name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function getOwnerCharge(Request $request)
    {
        $class_id = session('class_login_session_id');
        if ($request->price) {
            //check if class have personal fees
            $class_row = ECourseM::getOwnerCharge('tbl_class_fee_structure',array('isdelete'=>0,'class_id'=>$class_id),$request->price);
            if (!empty($class_row)) {
                echo json_encode($class_row);
            }else
            {
                $row = ECourseM::getOwnerCharge('tbl_fee_structure',array('isdelete'=>0),$request->price);
                if (!empty($row)) {
                    echo json_encode($row);
                }else
                {
                    echo json_encode(FALSE);
                }
            }
        }
    }

    public function getFeeSelectionAuto(Request $request)
    {
        if ($request->price!="") {
            $calculate_owner_charge = $request->owner_charge;
            // owner_charge
            //get setting values GST and remain oener charge discount
            $row = GenericM::getSingleRecord('tbl_setting_value','*',array());
            if (!empty($row)) {
                if ($request->isExclusive==1){
                     $setting_owner_charge = ($calculate_owner_charge * $row->ex_owner_discount_per)/100;
                }else
                {
                     $setting_owner_charge = ($calculate_owner_charge * $row->owner_discount_per)/100;
                }

                $setting_gst = ($setting_owner_charge * $row->GST_per)/100;

                $actual_owner_charge = $setting_owner_charge + $setting_gst;
                //get all possible admission fees
                //Eg:- $request->price <= admission_fees && $actual_owner_charge >=admission_fees
                $where = [
                    ['amount','<=',$request->price],
                    ['amount','>=',$actual_owner_charge],
                    ['isdelete',0]

                ];
                $data = ECourseM::getAdmissionFees($where);
                if (!empty($data)) {
                    echo json_encode($data);
                }else
                {
                    echo json_encode(FALSE);
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

    public function checkAddCourseExists(Request $request)
    {
        $class_id = session('class_login_session_id');
        if ($request->name!="") {
            $isExists = GenericM::getSingleRecord('tbl_class_course','id',array('name'=>$request->course_name,'isdelete'=>0,'class_id'=>$class_id));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkeditCourseExists(Request $request)
    {
        $class_id = session('class_login_session_id');
        if ($request->name!="") {
            $where = [
                ['name',$request->course_name],
                ['id','<>',$request->id],
                ['isdelete',0],
                ['class_id',$class_id]
            ];
            $isExists = GenericM::getSingleRecord('tbl_class_course','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    //add course
    function addCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        if ($class_id!="") {
            $data['class_id'] = $class_id;
            $data['maincourse_id'] = $request->maincourse_id;
            $data['subcourse_id'] = $request->subcourse_id;

            if ($request->childcourse_id) {
                $data['childcourse_id'] = $request->childcourse_id;
                //get chield course name
                $courserow = GenericM::getSingleRecord('tbl_child_course','name',array('id'=>$request->childcourse_id));
                $data['name'] = $courserow->name;
            }else
            {
                //get sub course name
                $courserow = GenericM::getSingleRecord('tbl_sub_course','name',array('id'=>$request->subcourse_id));
                $data['name'] = $courserow->name;
            }

            $data['batch_type'] = $request->batch_type;
            $data['batch_for'] = $request->batch_for;
            $data['description'] = $request->description;
            $data['material_provided'] = $request->material;
            $data['certification_provided'] = $request->cartificate;
            $data['seat_available'] = $request->seat;
            $data['price'] = $request->price;

            /*Default Fee selection code START*/
            $data['owner_service_charge_per'] = $request->hdowner_charge_per;
            $data['owner_service_charge'] = $request->hdowner_charge;

            $data['client_discount_per'] = $request->client_descount;
            $data['client_discount'] = ($data['price'] * $request->client_descount)/100;
            $data['total_discount_per'] = $request->client_descount + $request->hdowner_charge_per;
            $data['final_price'] = $request->hdcalculated_price;
            $data['admission_fees_selection'] = $request->feeselect;
            if ($request->feeselect==0) {
                $data['admission_fees_selection_value'] = $request->fee_select_per;
            }else if($request->feeselect==1)
            {
                $data['admission_fees_selection_value'] = $request->fee_select_amount;
            }

            /*Start New Logic for (%)*/
                if ($request->feeselect==0) {
                    $data['admission_fees_selection_value_final'] = round($data['final_price']*$data['admission_fees_selection_value']/100);
                }else
                {
                     $data['admission_fees_selection_value_final'] = $request->fee_select_amount;
                }
            /*End New Logic for (%)*/

            $setting_row = GenericM::getSingleRecord('tbl_setting_value','*',array());
            //get student discount give by owner 
            if ($setting_row) {
                $data['owner_service_charge_student_discount_per'] = $setting_row->student_discount_perc;
                $data['owner_service_charge_student_discount_value'] = ($request->hdowner_charge * $setting_row->student_discount_perc)/100;
                $data['owner_service_charge_owner_discount_per'] = $setting_row->owner_discount_per;
                $data['owner_service_charge_owner_discount_value'] = ($request->hdowner_charge * $setting_row->owner_discount_per)/100;
                $data['gst_per'] = $setting_row->GST_per;
                $data['gst_value'] = ($data['owner_service_charge_owner_discount_value'] * $setting_row->GST_per)/100;
                $data['final_owner_charge'] = $data['owner_service_charge_owner_discount_value'] + $data['gst_value'];
                $data['student_addmission_fees'] = $data['final_price'] + $data['final_owner_charge'];
                $data['student_original_discount_value'] = $data['price'] - $data['student_addmission_fees'];
                $data['student_original_discount_per'] = ($data['student_original_discount_value']/$data['price'])*100;
            }

            /*Default Fee selection code END*/
            /*Exclusive Fee selection code START*/
            if ($request->exclusive==1) {
                $data['isExclusive'] = 1;
                $data['no_of_students'] = $request->no_of_students;
                $data['expiry_date'] = $request->expiry_date;
                $data['ex_owner_service_charge_per'] = $request->ex_hdowner_charge_per;
                $data['ex_owner_service_charge'] = $request->ex_hdowner_charge;

                $data['ex_client_discount_per'] = $request->ex_client_descount;
                $data['ex_client_discount'] = ($data['price'] * $request->ex_client_descount)/100;
                $data['ex_total_discount_per'] = $request->ex_client_descount + $request->ex_hdowner_charge_per;
                $data['ex_final_price'] = $request->ex_hdcalculated_price;
                $data['ex_admission_fees_selection'] = $request->ex_feeselect;

                if ($request->ex_feeselect==0) {
                    $data['ex_admission_fees_selection_value'] = $request->ex_fee_select_per;
                }else if($request->ex_feeselect==1)
                {
                    $data['ex_admission_fees_selection_value'] = $request->ex_fee_select_amount;
                }

                /*Start New Logic for (%)*/
                if ($request->ex_feeselect==0) {
                    $data['ex_admission_fees_selection_value_final'] = round($data['ex_final_price']*$data['ex_admission_fees_selection_value']/100);
                }else
                {
                     $data['ex_admission_fees_selection_value_final'] = $request->ex_fee_select_amount;
                }
                /*End New Logic for (%)*/

                //get student discount give by owner 
                if ($setting_row) {
                    $data['ex_owner_service_charge_student_discount_per'] = $setting_row->ex_student_discount_perc;
                    $data['ex_owner_service_charge_student_discount_value'] = ($request->ex_hdowner_charge * $setting_row->ex_student_discount_perc)/100;
                    $data['ex_owner_service_charge_owner_discount_per'] = $setting_row->ex_owner_discount_per;
                    $data['ex_owner_service_charge_owner_discount_value'] = ($request->ex_hdowner_charge * $setting_row->ex_owner_discount_per)/100;
                    $data['ex_gst_per'] = $setting_row->GST_per;
                    $data['ex_gst_value'] = ($data['ex_owner_service_charge_owner_discount_value'] * $setting_row->GST_per)/100;
                    $data['ex_final_owner_charge'] = $data['ex_owner_service_charge_owner_discount_value'] + $data['ex_gst_value'];
                    $data['ex_student_addmission_fees'] = $data['ex_final_price'] + $data['ex_final_owner_charge'];
                    $data['ex_student_original_discount_value'] = $data['price'] - $data['ex_student_addmission_fees'];
                    $data['ex_student_original_discount_per'] = ($data['ex_student_original_discount_value']/$data['price'])*100;
                }
            }else
            {
                $data['isExclusive'] = 0;
                /*Exclusive Fee selection code END*/
            }

            //upload if class logo selected
            if ($request->file('course_img')) {
                $course_img_path = $request->file('course_img')->store('course_images','public');
                if($course_img_path) {
                    $data['course_image'] = substr($course_img_path, strrpos($course_img_path, '/' )+1);
                }
            }

            $data['isdelete'] = 0;
            $data['isapprove'] = 0;
            $data['date'] = date('Y-m-d H:i:s');
            if (!empty($data)) {
                $isInsert = GenericM::insertData('tbl_class_course',$data);
                if ($isInsert) {
                    //upload multiple PDF
                    //1.upload if  multiple class_images selected

                    $hdarrpdf = explode(',',$request->hdarrpdf);
                    $pdf_data['course_id'] = $isInsert;
                    $pdf_data['isdelete'] = 0;
                    $pdf_data['date'] = date('Y-m-d H:i:s');
                    for ($i=0; $i <count($hdarrpdf) ; $i++) { 
                        if ($request->file('coursepdf'.$hdarrpdf[$i].'')) {
                            $pdfpath = $request->file('coursepdf'.$hdarrpdf[$i].'')->store('course_pdf','public');
                            if($pdfpath) {
                                $pdf_data['pdf'] = substr($pdfpath, strrpos($pdfpath, '/' )+1);
                            }
                        }

                        $v1 = 'pdf_title'.$hdarrpdf[$i].'';
                        $pdf_data['title'] = $request[$v1];
                        $isInsert1 = GenericM::insertData('tbl_class_course_pdf',$pdf_data);
                    }

                    //2.upload multiple you tube links

                    $hdarrtube = explode(',',$request->hdarrtube);
                    $tube_data['course_id'] = $isInsert;
                    $tube_data['isdelete'] = 0;
                    $tube_data['date'] = date('Y-m-d H:i:s');
                    for ($j=0; $j <count($hdarrtube) ; $j++) { 

                        $tube_v1 = 'tube_title'.$hdarrtube[$j].'';
                        $tube_data['title'] = $request[$tube_v1];

                        $tube_v2 = 'tube_url'.$hdarrtube[$j].'';
                        $tube_data['url'] = $request[$tube_v2];

                        $isInsert2 = GenericM::insertData('tbl_class_course_youtube_links',$tube_data);
                    }

                    //add start date and end date
                    $date_data['course_id'] = $isInsert;
                    $date_data['start_date'] = $request->datetime1;
                    $date_data['end_date'] = $request->datetime2;
                    $date_data['isdelete'] = 0;
                    $date_data['date'] = date('Y-m-d H:i:s');
                    $date_id = GenericM::insertData('tbl_class_course_date',$date_data);

                    //3.add time slots multiple
                    if ($date_id) {
                        $time_data['course_date_id'] = $date_id;
                        $time_data['start_time'] = $request->starttime1;
                        $time_data['end_time'] = $request->endtime1;
                        $time_data['isdelete'] = 0;
                        $time_data['date'] = date('Y-m-d H:i:s');
                        // $isInsert2 = GenericM::insertData('tbl_class_course_time',$time_data);
                    }

                    $hdarrtime = explode(',',$request->hdarrtime);
                    // dd($hdarrtime);
                    for ($t=0; $t <count($hdarrtime) ; $t++) { 
                        $stime_v1H = 'starttimeH'.$hdarrtime[$t].'';
                        $stime_v1M = 'starttimeM'.$hdarrtime[$t].'';
                        // dd($stime_v1H);
                        $time_data['start_time'] = $request[$stime_v1H].":".($request[$stime_v1M] ? $request[$stime_v1M] : 00);

                        $stime_v2H = 'endtimeH'.$hdarrtime[$t].'';
                        $stime_v2M = 'endtimeM'.$hdarrtime[$t].'';
                        $time_data['end_time'] = $request[$stime_v2H].":".($request[$stime_v2M] ? $request[$stime_v2M] : 00);
                        // dd($time_data);
                        $time_insert = GenericM::insertData('tbl_class_course_time',$time_data);
                    }

                }else
                {
                    session()->flash('error-msg','Course not inserted.');
                    return redirect('/editcourse');
                }
            }else
            {
                session()->flash('error-msg','Course not inserted.');
                return redirect('/editcourse');
            }
        }else
        {
            session()->flash('error-msg','Course not inserted.');
            return redirect('/editcourse');
        }

        if ($class_id!="") {
            //send edit course mail
            $class_row = GenericM::getSingleRecord('tbl_class_registration','email',array('id'=>$class_id));
            // dd($stud_row);
            if ($class_row->email) {
                $all_type = ['type' => 4,'course_name'=>$data['name']];
                try {
                    // \Mail::to($class_row->email)->send(new Allmail($all_type));
                } catch (\Exception $e) {
                    
                }
            }
        }

        session()->flash('success-msg','Course inserted successfully.');
        return redirect('/editcourse');
    }

    public function update_course(Request $request)
    {
        // dd();
        $class_id = session('class_login_session_id');
        if ($class_id!="") {
            // $data['name'] = $request->course_name;
            $data['batch_type'] = $request->batch_type;
            $data['batch_for'] = $request->batch_for;
            $data['description'] = $request->description;
            $data['material_provided'] = $request->material;
            $data['certification_provided'] = $request->cartificate;
            $data['seat_available'] = $request->seat;
            $data['price'] = $request->price;
            $data['owner_service_charge_per'] = $request->hdowner_charge_per;
            $data['owner_service_charge'] = $request->hdowner_charge;
            $data['client_discount_per'] = $request->client_descount;
            $data['client_discount'] = ($data['price'] * $request->client_descount)/100;
            $data['total_discount_per'] = $request->client_descount + $request->hdowner_charge_per;
            $data['final_price'] = $request->hdcalculated_price;
            $data['admission_fees_selection'] = $request->feeselect;

            if ($request->feeselect==0) {
                $data['admission_fees_selection_value'] = $request->fee_select_per;
            }else if($request->feeselect==1)
            {
                $data['admission_fees_selection_value'] = $request->fee_select_amount;
            }


            /*Start New Logic for (%)*/
                if ($request->feeselect==0) {
                    $data['admission_fees_selection_value_final'] = round($data['final_price']*$data['admission_fees_selection_value']/100);
                }else
                {
                     $data['admission_fees_selection_value_final'] = $request->fee_select_amount;
                }
            /*End New Logic for (%)*/

            // dd($data);
                        //get student discount give by owner 
            $setting_row = GenericM::getSingleRecord('tbl_setting_value','*',array());
            if ($setting_row) {
                $data['owner_service_charge_student_discount_per'] = $setting_row->student_discount_perc;
                $data['owner_service_charge_student_discount_value'] = ($request->hdowner_charge * $setting_row->student_discount_perc)/100;
                $data['owner_service_charge_owner_discount_per'] = $setting_row->owner_discount_per;
                $data['owner_service_charge_owner_discount_value'] = ($request->hdowner_charge * $setting_row->owner_discount_per)/100;
                $data['gst_per'] = $setting_row->GST_per;
                $data['gst_value'] = ($data['owner_service_charge_owner_discount_value'] * $setting_row->GST_per)/100;
                $data['final_owner_charge'] = $data['owner_service_charge_owner_discount_value'] + $data['gst_value'];
                $data['student_addmission_fees'] = $data['final_price'] + $data['final_owner_charge'];
                $data['student_original_discount_value'] = $data['price'] - $data['student_addmission_fees'];
                $data['student_original_discount_per'] = ($data['student_original_discount_value']/$data['price'])*100;
            }
            
            /*Exclusive Fee selection code START*/
            // dd($request->exclusive);
            if ($request->exclusive==1) {
                $data['isExclusive'] = 1;
                $data['no_of_students'] = $request->no_of_students;
                $data['expiry_date'] = $request->expiry_date;
                $data['ex_owner_service_charge_per'] = $request->ex_hdowner_charge_per;
                $data['ex_owner_service_charge'] = $request->ex_hdowner_charge;

                $data['ex_client_discount_per'] = $request->ex_client_descount;
                $data['ex_client_discount'] = ($data['price'] * $request->ex_client_descount)/100;
                $data['ex_total_discount_per'] = $request->ex_client_descount + $request->ex_hdowner_charge_per;
                $data['ex_final_price'] = $request->ex_hdcalculated_price;
                $data['ex_admission_fees_selection'] = $request->ex_feeselect;
                if ($request->ex_feeselect==0) {
                    $data['ex_admission_fees_selection_value'] = $request->ex_fee_select_per;
                }else if($request->ex_feeselect==1)
                {
                    $data['ex_admission_fees_selection_value'] = $request->ex_fee_select_amount;
                }

                /*Start New Logic for (%)*/
                if ($request->ex_feeselect==0) {
                    $data['ex_admission_fees_selection_value_final'] = round($data['ex_final_price']*$data['ex_admission_fees_selection_value']/100);
                }else
                {
                     $data['ex_admission_fees_selection_value_final'] = $request->ex_fee_select_amount;
                }
                /*End New Logic for (%)*/
                
                //get student discount give by owner 
                if ($setting_row) {
                    $data['ex_owner_service_charge_student_discount_per'] = $setting_row->ex_student_discount_perc;
                    $data['ex_owner_service_charge_student_discount_value'] = ($request->ex_hdowner_charge * $setting_row->ex_student_discount_perc)/100;
                    $data['ex_owner_service_charge_owner_discount_per'] = $setting_row->ex_owner_discount_per;
                    $data['ex_owner_service_charge_owner_discount_value'] = ($request->ex_hdowner_charge * $setting_row->ex_owner_discount_per)/100;
                    $data['ex_gst_per'] = $setting_row->GST_per;
                    $data['ex_gst_value'] = ($data['ex_owner_service_charge_owner_discount_value'] * $setting_row->GST_per)/100;
                    $data['ex_final_owner_charge'] = $data['ex_owner_service_charge_owner_discount_value'] + $data['ex_gst_value'];
                    $data['ex_student_addmission_fees'] = $data['ex_final_price'] + $data['ex_final_owner_charge'];
                    $data['ex_student_original_discount_value'] = $data['price'] - $data['ex_student_addmission_fees'];
                    $data['ex_student_original_discount_per'] = ($data['ex_student_original_discount_value']/$data['price'])*100;
                }
            }else
            {
                $data['isExclusive'] = 0;
                /*Exclusive Fee selection code END*/
            }
            
            $data['isapprove'] = 0;
            $data['date'] = date('Y-m-d H:i:s');
            $where = array('id' => $request->id);
            
            if (!empty($data)) {
                $isupdate = GenericM::updateData('tbl_class_course',$where,$data);
                if ($isupdate) {
                    //upload multiple PDF
                    //1.upload if  multiple class_images selected

                    $hdarrpdf = explode(',',$request->hdarrpdf);
                    $pdf_data['course_id'] = $request->id;
                    $pdf_data['isdelete'] = 0;
                    $pdf_data['date'] = date('Y-m-d H:i:s');
                    for ($i=0; $i <count($hdarrpdf) ; $i++) { 
                        if ($request->file('coursepdf'.$hdarrpdf[$i].'')) {
                            $pdfpath = $request->file('coursepdf'.$hdarrpdf[$i].'')->store('course_pdf','public');
                            if($pdfpath) {
                                $pdf_data['pdf'] = substr($pdfpath, strrpos($pdfpath, '/' )+1);
                                $v1 = 'pdf_title'.$hdarrpdf[$i].'';
                                $pdf_data['title'] = $request[$v1];
                                $isInsert1 = GenericM::insertData('tbl_class_course_pdf',$pdf_data);
                            }
                        }

                    }

                    //2.upload multiple you tube links

                    $hdarrtube = explode(',',$request->hdarrtube);
                    $tube_data['course_id'] = $request->id;
                    $tube_data['isdelete'] = 0;
                    $tube_data['date'] = date('Y-m-d H:i:s');
                    for ($j=0; $j <count($hdarrtube) ; $j++) { 

                        $tube_v1 = 'tube_title'.$hdarrtube[$j].'';
                        if($request[$tube_v1]) {
                            $tube_data['title'] = $request[$tube_v1];

                            $tube_v2 = 'tube_url'.$hdarrtube[$j].'';
                            $tube_data['url'] = $request[$tube_v2];

                            $isInsert2 = GenericM::insertData('tbl_class_course_youtube_links',$tube_data);
                        }
                    }

                    //add start date and end date
                    $course_id = $request->id;
                    $date_data['start_date'] = $request->datetime1;
                    $date_data['end_date'] = $request->datetime2;
                    $date_data['isdelete'] = 0;
                    $date_data['date'] = date('Y-m-d H:i:s');
                    $where1 = array('course_id' => $course_id);
                    $chk5 = GenericM::updateData('tbl_class_course_date',$where1,$date_data);

                    //3.add time slots multiple
                    if ($chk5) {
                        $time_data['course_date_id'] = $request->date_id;
                        // $time_data['start_time'] = $request->starttime1;
                        // $time_data['end_time'] = $request->endtime1;
                        $time_data['isdelete'] = 0;
                        $time_data['date'] = date('Y-m-d H:i:s');
                        // $isInsert2 = GenericM::insertData('tbl_class_course_time',$time_data);
                    }

                    $hdarrtime = explode(',',$request->hdarrtime);
                    // dd($hdarrtime);
                    \DB::table('tbl_class_course_time')
                        ->where(array('course_date_id' => $request->date_id))
                        ->delete();

                    for ($t=0; $t <count($hdarrtime) ; $t++) { 
                        /*$stime_v1 = 'starttime'.$hdarrtime[$t].'';
                        $time_data['start_time'] = $request[$stime_v1];

                        $stime_v2 = 'endtime'.$hdarrtime[$t].'';
                        $time_data['end_time'] = $request[$stime_v2];*/

                        $stime_v1H = 'starttimeH'.$hdarrtime[$t].'';
                        $stime_v1M = 'starttimeM'.$hdarrtime[$t].'';
                        // dd($stime_v1H);
                        $time_data['start_time'] = $request[$stime_v1H].":".($request[$stime_v1M] ? $request[$stime_v1M] : 00);

                        $stime_v2H = 'endtimeH'.$hdarrtime[$t].'';
                        $stime_v2M = 'endtimeM'.$hdarrtime[$t].'';
                        $time_data['end_time'] = $request[$stime_v2H].":".($request[$stime_v2M] ? $request[$stime_v2M] : 00);

                        $time_insert = GenericM::insertData('tbl_class_course_time',$time_data);
                    }

                }else
                {
                    session()->flash('error-msg','Course not updated.');
                    return redirect('/editcourse');
                }
            }else
            {
                session()->flash('error-msg','Course not updated.');
                return redirect('/editcourse');
            }
        }else
        {
            session()->flash('error-msg','Course not updated.');
            return redirect('/editcourse');
        }
        session()->flash('success-msg','Course updated successfully.');
        return redirect('/editcourse');
    }

    public function editCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        if ($class_id!="") {
            $data['class'] = ClassM::getClassData();
            $data['course'] = ECourseM::getAllCourseClassSide($class_id);
            // dd($data);
            return view('edifygoclass/course/listcourse',$data);
        }else
        {
            return redirect('/');
        }
    }

    public function editViewCourse(Request $request)
    {
        $course_id = \Request::segment(2);
        if ($course_id) {
            $data['class'] = ClassM::getClassData();
            $data['course'] = ECourseM::getCourseData($course_id);
            $data['setting'] = ECourseM::getExclusiveCharge();
            // dd($data);
            return view('edifygoclass/course/editcourse',$data);
        }else
        {
            return redirect('/editcourse');
        }
    }

    public function deleteCourse(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_course',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Course deleted successfully.');
        }else
        {
            session()->flash('success-msg','Course not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function isAvailableSeat(Request $request)
    {
        $data['seat_available'] = $request->status==1 ? 0 : 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_course',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Course updated successfully.');
        }else
        {
            session()->flash('success-msg','Course not updated.');
        }

        echo json_encode(TRUE);
    }

    public function listCourse(Request $request)
    {
        $class_id = \Request::segment(2);
        $maincourse_id = session('setMainCourseSession');
        $request->session()->forget('defaultselectcoursetab');
        if ($maincourse_id=="") {
            $maincourse_id = $request->maincourseselect;
            if ($maincourse_id!="") {
                $request->session()->put('setMainCourseSession', $maincourse_id); 
                $request->session()->put('defaultselectcoursetab', 1); 
            }
        }
        if ($class_id!="") {
            $data['class'] = ClassM::getClassDataByID($class_id);

            if ($maincourse_id!="" && $maincourse_id!="all") {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1,'tmc.id'=>$maincourse_id);
            }else
            {
                $where1 = array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.seat_available'=>1);
            }

            $data['maincourse'] = ClassM::getMainCourseByClass($class_id);
            $data['courses'] = ECourseM::getAllCourse($where1);

            $data['count'] = ECourseM::getAllCount($class_id);
            $data['ratings'] = ECourseM::getAllRating($class_id);
            $data['faqs'] = ECourseM::getAllFaq($class_id);

            // dd($data);
            if (!$data['courses']->isEmpty()) {
                return view('edifygoclass/course/index',$data);
            }else
            {
                session()->flash('error-msg','Approved course not available.');
            return redirect('/class/profile');
            }
        }else
        {
            session()->flash('error-msg','Approved course not available.');
            return redirect('/class/profile');
        }
    }

    public function deleteTube(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_course_youtube_links',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Link deleted successfully.');
        }else
        {
            session()->flash('success-msg','Link not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function deletePdf(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_course_pdf',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Pdf deleted successfully.');
        }else
        {
            session()->flash('success-msg','Pdf not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function deletetime(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_class_course_time',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Time deleted successfully.');
        }else
        {
            session()->flash('success-msg','Time not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function updatecourseImage(Request $request)
    {
        if ($request->id!="") {
            if ($request->file('up_courseimg')) {
                $class_img_path = $request->file('up_courseimg')->store('course_images','public');
                if($class_img_path) {
                    $data['course_image'] = substr($class_img_path, strrpos($class_img_path, '/' )+1);
                    $data['isapprove'] = 0;
                    $where = array('id' => $request->id);
                    $isUpdate = GenericM::updateData('tbl_class_course',$where,$data);
                    if ($isUpdate) {
                        echo json_encode($data['course_image']);
                    } else {
                        echo json_encode(FALSE);
                    }
                }
            } else {
                echo json_encode(FALSE);
            }
        } else {
            echo json_encode(FALSE);
        }
    }

    public function getEnroll(Request $request)
    {
        $course_id = $request->id;
        if ($course_id!="") {
            $data['enroll'] = ECourseM::getEnrollData($course_id);
            $data['paid'] = ECourseM::getSUM($course_id,'enroll_amount');
            $data['pending'] = ECourseM::getSUM($course_id,'student_addmission_fees');
            if (!empty($data)) {
                echo json_encode($data);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function getReview(Request $request)
    {
        $course_id = $request->id;
        if ($course_id!="") {
            $data['review'] = ECourseM::getAllReview($course_id);
            if (!empty($data)) {
                foreach ($data['review'] as $key => $value) {
                    $value->ratingdate = date('d-m-Y g:i A',strtotime($value->ratingdate));
                }
                echo json_encode($data);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function checkExistsCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        $maincourse_id = $request->maincourse_id;
        $subcourse_id = $request->subcourse_id;
        $childcourse_id = $request->childcourse_id;
        $where = array('class_id' => $class_id,'maincourse_id' => $maincourse_id,'subcourse_id' => $subcourse_id,'childcourse_id' => $childcourse_id,'isdelete' => 0);
        $isExists = GenericM::getSingleRecord('tbl_class_course','id',$where);
        if($isExists) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

/*    public function checkEditExistsCourse(Request $request)
    {
        $course_id = $request->id;
        $class_id = session('class_login_session_id');
        $maincourse_id = $request->maincourse_id;
        $subcourse_id = $request->subcourse_id;
        $childcourse_id = $request->childcourse_id;
        $where = [
            ['id','<>',$course_id],
            ['class_id',$class_id],
            ['maincourse_id',$maincourse_id],
            ['subcourse_id',$subcourse_id],
            ['childcourse_id',$childcourse_id],
            ['isdelete',0],
        ];

        $isExists = GenericM::getSingleRecord('tbl_class_course','id',$where);
        if($isExists) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }*/
}

