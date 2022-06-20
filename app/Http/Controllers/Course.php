<?php

namespace App\Http\Controllers;

use App\CourseM;
use App\StudentM;
use Illuminate\Http\Request;

class Course extends Controller
{
    public function index()
    {
        $data['class_course'] = CourseM::fetch_all_data();
        $data['city'] = StudentM::getCityLocationData();
        $data['course'] = StudentM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'name');
        // dd($data);
        return view('admin/course/courselist',$data);
    }

    public function getFilterSubcourse_courselist(Request $request)
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

    public function getchildCourse_courselist(Request $request)
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

    public function getFilterArea_courselist(Request $request)
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

    public function filterCourseList(Request $request)
    {

        $request->session()->forget('admin_city_courselist_session');
        $request->session()->forget('admin_area_courselist_session');
        $request->session()->forget('admin_maincourse_courselist_session');
        $request->session()->forget('admin_subcourse_courselist_session');
        $request->session()->forget('admin_childcourse_courselist_session');
        $where = array();
            //city
            if ($request->city!="") {
                
                $where['tcr.city_id'] = $request->city;  
                $request->session()->put('admin_city_courselist_session', $request->city);   
            }
            else if(session('admin_city_courselist_session'))
            {
                $where['tcr.city_id'] = session('admin_city_courselist_session');    
            }

            //area
            if ($request->area!="") {
                
                $where['tcr.area_id'] = $request->area;  
                $request->session()->put('admin_area_courselist_session', $request->area);   
            }
            else if(session('admin_area_courselist_session'))
            {
                $where['tcr.area_id'] = session('admin_area_courselist_session');    
            }

            //main course
            if ($request->maincourse_id!="") {
                
                $where['tcc.maincourse_id'] = $request->maincourse_id;  
                $request->session()->put('admin_maincourse_courselist_session', $request->maincourse_id);   
            }
            else if(session('admin_maincourse_courselist_session'))
            {
                $where['tcc.maincourse_id'] = session('admin_maincourse_courselist_session');    
            }


            //sub course
            if ($request->subcourse_id!="" && $request->maincourse_id!="") {
                
                $where['tcc.subcourse_id'] = $request->subcourse_id;  
                $request->session()->put('admin_subcourse_courselist_session', $request->subcourse_id);  
            }
            else if(session('admin_subcourse_courselist_session'))
            {
                $where['tcc.subcourse_id'] = session('admin_subcourse_courselist_session');    
            }

            //child course
            if ($request->childcourse_id!="" && $request->maincourse_id!="" && $request->subcourse_id!="") {
                $where['tcc.childcourse_id'] = $request->childcourse_id;  
                $request->session()->put('admin_childcourse_courselist_session', $request->childcourse_id);  
            }
            else if(session('admin_childcourse_courselist_session'))
            {
                $where['tcc.childcourse_id'] = session('admin_childcourse_courselist_session');   
            }

        $data['class_course'] = CourseM::getFilterCourseDataAdmin($where);

        // $data['area'] = StudentM::getLocationData();
        $data['city'] = StudentM::getCityLocationData();
        $data['course'] = StudentM::getAllData('tbl_main_course',array('isdelete'=>0,'status'=>1),'name');

        // dd($data);
       /* $data['paid'] = StudentM::getSUM($course_id,'enroll_amount');
        $data['pending'] = StudentM::getSUM($course_id,'student_addmission_fees');*/
        return view('admin/course/courselist',$data);
    }

    public function courseView(Request $request)
    {
        // $id = $request->id;
        $id = \Request::segment(3);
        if($id) {
            $data['course'] = CourseM::getAllCourse($id);
            // dd($data);
            if(!empty($data['course']))
            {
                return view('admin/course/courseview',$data);
            }
        }
         return redirect('/courselist');
        // dd($data);
    }

    public function isApprovecourse(Request $request)
    {
        if ($request->id!="") {
            $data['isapprove'] = $request->status;
            if($request->status == 1) {
                $msg = 'approve';
            } else {
                $msg = 'disapprove';
            }
            $where = array('id' => $request->id);
            $isUpdate = CourseM::update_data('tbl_class_course',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Course '.$msg.' successfully.');
            }else
            {
                session()->flash('error-msg','Course not '.$msg.'.');
            }
        }
        echo json_encode(TRUE);
    }

    public function deleteCourse(Request $request)
    {
        if ($request->id!="") {
            $data['isdelete'] = 1;
            $where = array('id' => $request->id);
            $isUpdate = CourseM::update_data('tbl_class_course',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Course updated successfully.');
            }else
            {
                session()->flash('error-msg','Course not updated.');
            }
        }
        echo json_encode(TRUE);
    }

    //fetch
    public function fetch_course_details(Request $request)
    {  
        $id = $request->id;
        if($id != "") {
            $where = array('tbl_class_course.id' => $id,'tbl_class_registration.isdelete' => 0,'tbl_class_course.isdelete' => 0);
            $data = CourseM::fetch_single_data($where);
            if(!empty($data)) {
                echo json_encode($data);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }

    public function getEnroll(Request $request)
    {
        $course_id = $request->id;
        if ($course_id!="") {
            $data['enroll'] = CourseM::getEnrollData($course_id);
            $data['paid'] = CourseM::getSUM($course_id,'enroll_amount');
            $data['pending'] = CourseM::getSUM($course_id,'student_addmission_fees');
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
}
