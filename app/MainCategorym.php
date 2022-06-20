<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategorym extends Model
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

    //update
    public static function update_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }
}
