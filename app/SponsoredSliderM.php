<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsoredSliderM extends Model
{
    //fetch data
    public static function fetch_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->orderby('id','desc')
    				->get();
    }

    //fetch city
    public static function fetch_city()
    {
        return \DB::table('tbl_master_city')
                    ->where(array('isdelete' => 0))
                    ->orderby('id','desc')
                    ->get();
    }
    
    //fetch data check
    public static function fetch_data1($tbl,$where)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->first();
    }

    //fetch data join
    public static function fetch_data_join($tbl)
    {
    	$data = \DB::table($tbl)
    				->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_main_course.name as main_course_name','tbl_sub_course.name as sub_course_name','tbl_sub_course.image as sub_image','tbl_child_course.name as child_course_name','tbl_child_course.image as child_image','tbl_master_city.city_name')
                    ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                    ->join('tbl_main_course','tbl_main_course.id','=',''.$tbl.'.main_course_id')
                    ->join('tbl_sub_course','tbl_sub_course.id','=',''.$tbl.'.sub_course_id')             
                    ->leftjoin('tbl_child_course', function ($join) {
                        $join->on('tbl_child_course.id', '=', 'tbl_sponsored_slider.child_course_id')
                             ->where('tbl_child_course.isdelete', 0);
                    })		
                    ->join('tbl_class_course','tbl_class_course.id','=',''.$tbl.'.class_course_id')	
                    ->join('tbl_master_city','tbl_master_city.id','=',''.$tbl.'.city_id')	
    				->where(array(''.$tbl.'.isdelete' => 0,'tbl_class_registration.isverified' => 1,'tbl_class_registration.isdelete' => 0,'tbl_class_registration.isapprove'=>1,'tbl_class_registration.issubscribe'=>1,'tbl_main_course.isdelete' => 0,'tbl_sub_course.isdelete' => 0,'tbl_class_course.isdelete'=>0,'tbl_class_course.isapprove'=>1))
    				->orderby(''.$tbl.'.id','desc')
                    // ->groupby('tbl_child_course.id')
    				->get();
            // dd($data);
            // if(!$data->isEmpty()) { 
            //     foreach ($data as $key => $value) {
            //         if($value->child_course_id != null) {
            //             $result = \DB::table($tbl)
            //             ->select('tbl_child_course.name as child_course_name','tbl_child_course.image as child_image')              
            //             ->join('tbl_child_course','tbl_child_course.id','=',''.$tbl.'.child_course_id')             
            //             ->where(array('tbl_child_course.isdelete' => 0))
            //             ->first();
            //             if($result) {
            //                 $data[$key]->child_course_name = $result->child_course_name;
            //                 $data[$key]->child_image = $result->child_image;
            //             }
            //         }
            //     }
            // } 
            return $data;
    }

    //insert
    public static function insert($tbl,$data)
    {
		return \DB::table($tbl)
    				->insert($data); 	
    }

    //update
    public static function update_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //fetch main course
    public static function fetch_main_course($class_id)
    {
        return \DB::table('tbl_class_course')
                    ->select('tbl_class_course.*','tbl_main_course.name as main_course_name')
                    ->join('tbl_main_course','tbl_main_course.id','=','tbl_class_course.maincourse_id')
                    ->where(array('tbl_class_course.class_id' => $class_id,'tbl_class_course.isdelete' => 0,'tbl_class_course.isapprove' => 1,'tbl_main_course.isdelete' => 0))
                    ->orderby('tbl_class_course.id','desc')
                    ->groupby('tbl_class_course.maincourse_id')
                    ->get();
    }

    //fetch sub course
    public static function fetch_sub_course($class_id,$main_course_id)
    {
        return \DB::table('tbl_class_course')
                    ->select('tbl_class_course.*','tbl_sub_course.name as sub_course_name')
                    ->join('tbl_sub_course','tbl_sub_course.id','=','tbl_class_course.subcourse_id')
                    ->where(array('tbl_class_course.class_id' => $class_id,'tbl_class_course.maincourse_id' => $main_course_id,'tbl_class_course.isdelete' => 0,'tbl_class_course.isapprove' => 1,'tbl_sub_course.isdelete' => 0))
                    ->orderby('tbl_class_course.id','desc')
                    ->groupby('tbl_class_course.subcourse_id')
                    ->get();
    }

    //fetch child course
    public static function fetch_child_course($class_id,$main_course_id,$sub_course_id)
    {
        return \DB::table('tbl_class_course')
                    ->select('tbl_class_course.*','tbl_child_course.name as child_course_name')
                    ->join('tbl_child_course','tbl_child_course.id','=','tbl_class_course.childcourse_id')
                    ->where(array('tbl_class_course.class_id' => $class_id,'tbl_class_course.maincourse_id' => $main_course_id,'tbl_class_course.subcourse_id' => $sub_course_id,'tbl_class_course.isdelete' => 0,'tbl_class_course.isapprove' => 1,'tbl_child_course.isdelete' => 0))
                    ->orderby('tbl_class_course.id','desc')
                    ->get();
    }

    //single
    public static function fetch_single_course_id($class_id,$main_course_id,$sub_course_id)
    {
        return \DB::table('tbl_class_course')
                    ->select('tbl_class_course.id')
                    ->where(array('tbl_class_course.class_id' => $class_id,'tbl_class_course.maincourse_id' => $main_course_id,'tbl_class_course.subcourse_id' => $sub_course_id,'tbl_class_course.isdelete' => 0,'tbl_class_course.isapprove' => 1))
                    ->first();
    }

    //single
    public static function fetch_single_course_id1($class_id,$main_course_id,$sub_course_id,$child_course_id)
    {
        return \DB::table('tbl_class_course')
                    ->select('tbl_class_course.id')
                    ->where(array('tbl_class_course.class_id' => $class_id,'tbl_class_course.maincourse_id' => $main_course_id,'tbl_class_course.subcourse_id' => $sub_course_id,'tbl_class_course.isdelete' => 0,'tbl_class_course.isapprove' => 1,'tbl_class_course.childcourse_id' => $child_course_id))
                    ->first();
    }
}
