<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentM extends Model
{
    public static function checkLogin($tbl,$username,$password)
    {
    	return \DB::table($tbl)
    			->where(array('password'=>$password,'isdelete'=>0))
    			->where('email',$username)
    			->orWhere('mobile',$username)
    			->first();
    }

    public static function getClassData()
    {
    	return  \DB::table('tbl_student_registration as tsr')
    				->select('tsr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
    				->join('tbl_master_country as tmc','tmc.id','=','tsr.country_id')
    				->join('tbl_master_state as tms','tms.id','=','tsr.state_id')
    				->join('tbl_master_city as tmcity','tmcity.id','=','tsr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tsr.area_id')
    				->join('tbl_know_us as tku','tku.id','=','tsr.know_is_id')
    				->where(array('tsr.isdelete' =>0,'tsr.isverified'=>1,'tsr.email'=>session('student_login_session')))
    				->orWhere(array('tsr.mobile'=>session('student_login_session')))
    				->first();
    }

    public static function getCourseData($time_slot)
    {
        return \DB::table('tbl_class_course_time as tcct')
                    ->select('tcc.*','tcr.address','tcr.name as class_name','tccd.start_date','tccd.end_date','tcct.start_time','tcct.end_time','tmc.name as main_course_name','tsc.name as sub_course_name','tchildc.name as child_course_name')
                    ->join('tbl_class_course_date as tccd','tccd.id','=','tcct.course_date_id')
                    ->join('tbl_class_course as tcc','tcc.id','=','tccd.course_id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchildc','tchildc.id','=','tcc.childcourse_id')
                    ->where(array('tcct.id'=>$time_slot))
                    ->first();
    }

    public static function getEnrollData($tbl,$where)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->orderby('id','desc')
                    ->get();
    }

    public static function getSUM($tbl,$where,$field)
    {
        return \DB::table($tbl)
                ->where($where)
                ->sum($field);
    }

    public static function getEnrollReceipt($time_slot)
    {
        return \DB::table('tbl_class_course_time as tcct')
                    ->select('tcc.*','tccd.start_date','tccd.end_date','tcct.id as time_slot_id','tcct.start_time','tcct.end_time','tcr.name as class_name','tcr.address','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as main_course_name','tsc.name as sub_course_name','tchildc.name as child_course_name')
                    ->join('tbl_class_course_date as tccd','tccd.id','=','tcct.course_date_id')
                    ->join('tbl_class_course as tcc','tcc.id','=','tccd.course_id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_master_country as tmcountry','tmcountry.id','=','tcr.country_id')
                    ->join('tbl_master_state as tmstat','tmstat.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tmarea','tmarea.id','=','tcr.area_id')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchildc','tchildc.id','=','tcc.childcourse_id')
                    ->where(array('tcct.id'=>$time_slot))
                    ->first();
    }

    //admin modules start
    public static function getAllStudents()
    {
        return \DB::table('tbl_student_registration as tsr')
                    ->select('tsr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                    ->join('tbl_master_country as tmc','tmc.id','=','tsr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tsr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tsr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tsr.area_id')
                    ->join('tbl_know_us as tku','tku.id','=','tsr.know_is_id')
                    ->where(array('tsr.isdelete'=>0,'tsr.isverified'=>1))
                    ->get();
    }

    public static function getEnrollDataAdmin()
    {
        $data =  \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*','tsr.firstname','tsr.lastname','tsr.email','tsr.mobile','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as main_course_name','tsc.name as sub_course_name','tchildc.name as child_course_name')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->join('tbl_class_course as tcc','tcc.id','=','tec.course_id')
                    ->join('tbl_master_country as tmcountry','tmcountry.id','=','tsr.country_id')
                    ->join('tbl_master_state as tmstat','tmstat.id','=','tsr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tsr.city_id')
                    ->join('tbl_master_area as tmarea','tmarea.id','=','tsr.area_id')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchildc','tchildc.id','=','tcc.childcourse_id')
                    ->orderby('id','desc')
                    ->get();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $value->start_date = date('d-m-Y',strtotime($value->start_date));
                $value->end_date = date('d-m-Y',strtotime($value->end_date));
                $value->start_time = date('g:i A',strtotime($value->start_time));
                $value->end_time = date('g:i A',strtotime($value->end_time));
            }
        }

        return $data;
    }

    public static function getFilterEnrollDataAdmin($where)
    {
        $data =  \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*','tsr.firstname','tsr.lastname','tsr.email','tsr.mobile','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as main_course_name','tsc.name as sub_course_name','tchildc.name as child_course_name')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->join('tbl_class_course as tcc','tcc.id','=','tec.course_id')
                    ->join('tbl_master_country as tmcountry','tmcountry.id','=','tsr.country_id')
                    ->join('tbl_master_state as tmstat','tmstat.id','=','tsr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tsr.city_id')
                    ->join('tbl_master_area as tmarea','tmarea.id','=','tsr.area_id')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchildc','tchildc.id','=','tcc.childcourse_id')
                    ->orderby('id','desc')
                    ->where($where)
                    ->get();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $value->start_date = date('d-m-Y',strtotime($value->start_date));
                $value->end_date = date('d-m-Y',strtotime($value->end_date));
                $value->start_time = date('g:i A',strtotime($value->start_time));
                $value->end_time = date('g:i A',strtotime($value->end_time));
            }
        }

        return $data;
    }

    /*public static function getSUM($course_id,$field)
    {
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*','tsr.firstname','tsr.lastname','tsr.email','tsr.mobile')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('course_id' =>$course_id))
                    ->sum($field);
    }*/

    public static function getAllMainCategories($tbl,$where)
    {
        $path = asset('main_course')."/";
        return \DB::table($tbl)
                    ->select('*',\DB::raw('CONCAT("'.$path.'",image) AS url'))
                    ->where($where)
                    ->orderby('position')
                    ->get();
    }

    public static function getLocationData()
    {
        return \DB::table('tbl_master_area as tma')
                    ->select('tma.area_name','tma.id','tmc.city_name')
                    ->join('tbl_master_city as tmc','tmc.id','=','tma.city_id')
                    ->join('tbl_master_state as tms','tms.id','=','tmc.state_id')
                    ->join('tbl_master_country as tmcountry','tmcountry.id','=','tms.country_id')
                    ->where(array('tma.isdelete'=>0,'tmc.isdelete'=>0,'tms.isdelete'=>0,'tmcountry.isdelete'=>0))
                    ->get();
    }

    public static function getCityLocationData()
    {
        return \DB::table('tbl_master_city as tmc')
                ->where(array('isactive'=>1,'isdelete'=>0))
                ->get();
    }

    public static function getAllData($tbl,$where,$order)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->orderby($order)
                    ->get();
    }

    public static function getMainCourseByClass($class_id)
    {
        return \DB::table('tbl_main_course as tmc')
                    ->select('tmc.*')
                    ->join('tbl_class_course as tcc','tcc.maincourse_id','=','tmc.id')
                    ->where(array('tmc.isdelete'=>0,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.class_id'=>$class_id))
                    ->groupBy('tmc.id')
                    ->get();
    }
}
