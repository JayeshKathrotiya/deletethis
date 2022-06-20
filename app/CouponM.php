<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponM extends Model
{
    public static function getAllData()
    {
    	$data =  \DB::table('tbl_coupon')
    				->where(array('isdelete'=>0))
                    ->orderby('id','desc')
    				->get();
    	if (!empty($data)) {
    		foreach ($data as $key => $value) {
    			$data[$key]->course = \DB::table('tbl_coupon_courses as tcc')
    										->select('tcc.course_id','tmc.name')
    										->join('tbl_main_course as tmc','tmc.id','=','tcc.course_id')
						    				->where(array('tcc.coupon_id'=>$value->id))
						    				->get();
    		}
    	}

    	return $data;
    }

    public static function getDataByID($id)
    {
    	$row =  \DB::table('tbl_coupon')
    				->where(array('id'=>$id))
    				->first();
    	if (!empty($row)) {
    		$row->course = \DB::table('tbl_coupon_courses as tcc')
    										->select('tcc.course_id','tmc.name')
    										->join('tbl_main_course as tmc','tmc.id','=','tcc.course_id')
						    				->where(array('tcc.coupon_id'=>$id))
						    				->get();
    	}

    	return $row;
    }

    public static function deleteCouponCourse($tbl,$where)
    {
    	return \DB::table($tbl)
    			->where($where)
    			->delete();
    }
}
