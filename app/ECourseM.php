<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ECourseM extends Model
{
    public static function getAllData($tbl,$where,$order)
    {
    	return \DB::table($tbl)
    				->where($where)
                    ->orderby($order)
    				->get();
    }

    public static function getOwnerCharge($tbl,$where,$price)
    {
    	return \DB::table($tbl)
    				->where('fee', '<=',$price)
    				->where($where)
    				->orderBy('fee','DESC')
    				->limit(1)
    				->first();
    }

    public static function getExclusiveCharge()
    {
        return \DB::table('tbl_setting_value')
                    ->select('exclusive_charge_per')
                    ->first();
    }

    public static function getAdmissionFees($where)
    {
    	return \DB::table('tbl_admission_amount')
    			->where($where)
    			->orderBy('amount')
    			->get();
    }

    public static function getAllCourse($where)
    {
        $data =  \DB::table('tbl_class_course as tcc')
                    ->select('tcc.*','tcr.isapprove as cl_isapprove','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                    ->where($where)
                    ->orderBy('tcc.id','DESC')
                    ->get();
        // dd($data);
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {
                    //get All PDF
                    $data[$key]->pdf = \DB::table('tbl_class_course_pdf')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All You tube links
                    $data[$key]->tube = \DB::table('tbl_class_course_youtube_links')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All date
                    $data[$key]->date = \DB::table('tbl_class_course_date')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();
                                        
                    if (!$data[$key]->date->isEmpty()) {
                        foreach ($data[$key]->date as $key1 => $value1) {
                            $data[$key]->date[$key1]->time = \DB::table('tbl_class_course_time')
                                                            ->where(array('isdelete'=>0,'course_date_id'=>$value1->id))
                                                            ->get();
                        }
                    }
            }
        }

        return $data;
    }

    public static function getAllCourseClassSide($class_id)
    {
        $data =  \DB::table('tbl_class_course as tcc')
                    ->select('tcc.*','tcr.isapprove as cl_isapprove','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                    ->where(array('tcc.class_id'=>$class_id,'tcc.isdelete'=>0))
                    ->orderBy('tcc.id','DESC')
                    ->get();
        // dd($data);
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {
                    //get All PDF
                    $data[$key]->pdf = \DB::table('tbl_class_course_pdf')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All You tube links
                    $data[$key]->tube = \DB::table('tbl_class_course_youtube_links')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All date
                    $data[$key]->date = \DB::table('tbl_class_course_date')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();
                                        
                    if (!$data[$key]->date->isEmpty()) {
                        foreach ($data[$key]->date as $key1 => $value1) {
                            $data[$key]->date[$key1]->time = \DB::table('tbl_class_course_time')
                                                            ->where(array('isdelete'=>0,'course_date_id'=>$value1->id))
                                                            ->get();
                        }
                    }
            }
        }

        return $data;
    }

    public static function getCourseData($course_id)
    {
            $row = \DB::table('tbl_class_course as tcc')
                        ->select('tcc.*','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                        ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                        ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                        ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                        ->where(array('tcc.isdelete'=>0,'tcc.id'=>$course_id))
                        ->get();

            if (!$row->isEmpty()) {
                foreach ($row as $key => $value) {
                    //get All PDF
                    $row[$key]->pdf = \DB::table('tbl_class_course_pdf')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All You tube links
                    $row[$key]->tube = \DB::table('tbl_class_course_youtube_links')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();

                    //get All date
                    $row[$key]->date = \DB::table('tbl_class_course_date')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->get();
                                        
                    if (!$row[$key]->date->isEmpty()) {
                        foreach ($row[$key]->date as $key1 => $value1) {
                            $row[$key]->date[$key1]->time = \DB::table('tbl_class_course_time')
                                                            ->where(array('isdelete'=>0,'course_date_id'=>$value1->id))
                                                            ->get();
                        }
                    }
            }
        }

        return $row;
    }


    public static function getAllCount($class_id)
    {
        $data = array();
        $data['rating_count'] = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('rating');

        $data['rating_sum'] = \DB::table('tbl_enroll_course')
                ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                ->sum('rating');

        $data['review_count'] = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('review');

        return $data;
    }

    public static function getAllRating($class_id)
    {
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.rating','tec.review','tec.ratingdate','tsr.firstname','tsr.lastname')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('tec.class_id' => $class_id,'tec.isreview'=>1,'tec.isapprove_review'=>1))
                    ->get();
    }

    public static function getAllFaq($class_id)
    {
        return \DB::table('tbl_faq')
                    ->where(array('class_id' => $class_id,'isdelete'=>0))
                    ->get();
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

    //get all review
    public static function getAllReview($course_id)
    {
        $class_id = session('class_login_session_id');
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.rating','tec.review','tec.isapprove_review','tec.id','tsr.firstname','tsr.lastname','tec.ratingdate')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('tec.isreview'=>1,'tec.isapprove_review'=>1,'tec.course_id'=>$course_id,'tec.class_id'=>$class_id))
                    ->orderby('tec.ratingdate','DESC')
                    ->get();
    }
}
