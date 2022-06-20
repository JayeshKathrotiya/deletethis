<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseM extends Model
{
   	public static function fetch_all_data()
   	{
   		return \DB::table('tbl_class_course as tcc')
   				->select('tcc.*','tcr.name as class_name','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
   				->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
          ->join('tbl_master_country as tmcountry','tmcountry.id','=','tcr.country_id')
          ->join('tbl_master_state as tmstat','tmstat.id','=','tcr.state_id')
          ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
          ->join('tbl_master_area as tmarea','tmarea.id','=','tcr.area_id')
          ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
          ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
          ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
   				->where(array('tcr.isdelete' => 0,'tcc.isdelete' => 0))
   				->orderby('tcc.id','desc')
   				->get();
   	}

    public static function getFilterCourseDataAdmin($where)
    {
        return \DB::table('tbl_class_course as tcc')
          ->select('tcc.*','tcr.name as class_name','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
          ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
          ->join('tbl_master_country as tmcountry','tmcountry.id','=','tcr.country_id')
          ->join('tbl_master_state as tmstat','tmstat.id','=','tcr.state_id')
          ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
          ->join('tbl_master_area as tmarea','tmarea.id','=','tcr.area_id')
          ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
          ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
          ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
          ->where(array('tcr.isdelete' => 0,'tcc.isdelete' => 0))
          ->where($where)
          ->orderby('tcc.id','desc')
          ->get();
    }

   	//update
    public static function update_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //single
    public static function fetch_single_data($where)
    {
    	return \DB::table('tbl_class_course')
   				->select('tbl_class_course.*','tbl_class_registration.name as class_name')
   				->join('tbl_class_registration','tbl_class_registration.id','=','tbl_class_course.class_id')
   				->where($where)
   				->first();
    }

    public static function getAllCourse($course_id)
    {
        $data =  \DB::table('tbl_class_course as tcc')
                    ->select('tcc.*','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                    ->where(array('tcc.id'=>$course_id,'tcc.isdelete'=>0))
                    ->first();
        // dd($data);
        if (!empty($data)) {
          //get All PDF
          $data->pdf = \DB::table('tbl_class_course_pdf')
                              ->where(array('isdelete'=>0,'course_id'=>$data->id))
                              ->get();

          //get All You tube links
          $data->tube = \DB::table('tbl_class_course_youtube_links')
                              ->where(array('isdelete'=>0,'course_id'=>$data->id))
                              ->get();

          //get All date
          $data->date = \DB::table('tbl_class_course_date')
                              ->where(array('isdelete'=>0,'course_id'=>$data->id))
                              ->get();

          $data->class_rankerlist = \DB::table('tbl_class_rankers as tcr')
                    ->where(array('tcr.isdelete'=>0,'tcr.class_id'=>$data->class_id))
                    ->get();
                              
          if (!$data->date->isEmpty()) {
              foreach ($data->date as $key1 => $value1) {
                  $data->date[$key1]->time = \DB::table('tbl_class_course_time')
                                                  ->where(array('isdelete'=>0,'course_date_id'=>$value1->id))
                                                  ->get();
              }
          }
        }

        return $data;
    }

    public static function getEnrollData($course_id)
    {
        $data =  \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*','tsr.firstname','tsr.lastname','tsr.email','tsr.mobile')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('course_id' =>$course_id))
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

    public static function getSUM($course_id,$field)
    {
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*','tsr.firstname','tsr.lastname','tsr.email','tsr.mobile')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('course_id' =>$course_id))
                    ->sum($field);
    }
}
