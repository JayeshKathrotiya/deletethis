<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureSliderM extends Model
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
    public static function fetch_data_join($tbl,$where)
    {
    	return \DB::table($tbl)
    				->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_master_city.city_name')
    				->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                    ->join('tbl_master_city','tbl_master_city.id','=',''.$tbl.'.city_id')
    				->where($where)
    				->orderby(''.$tbl.'.id','desc')
    				->get();
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
}
