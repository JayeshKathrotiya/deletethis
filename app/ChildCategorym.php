<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildCategorym extends Model
{
    //insert
    public static function insert($tbl,$data)
    {
		return \DB::table($tbl)
    				->insert($data); 	
    }

    //add time check
    public static function check_main($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first(); 
    }

    //fetch single data
    public static function fetch_single_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }

    //fetch all data
    public static function fetch_all_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->orderby('position','ASC')
    				->get();
    }

    //fetch all data
    public static function fetch_all_data_by_join($tbl,$where)
    {
    	return \DB::table($tbl)
    				->select(''.$tbl.'.*','tbl_main_course.name as main_course_name','tbl_sub_course.name as sub_course_name','tbl_main_course.id as main_id','tbl_sub_course.id as sub_id')
    				->join('tbl_sub_course','tbl_sub_course.id','=',''.$tbl.'.sub_course_id')
    				->join('tbl_main_course','tbl_main_course.id','=','tbl_sub_course.main_course_id')
    				->where($where)
    				->orderby(''.$tbl.'.id','desc')
    				->get();
    }

    //update
    public static function update_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }
}
