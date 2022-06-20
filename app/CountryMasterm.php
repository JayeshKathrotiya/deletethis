<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryMasterm extends Model
{
    //fetch all country 
    public static function fetch_all_country($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
                    ->orderby('id','desc')
    				->get();
    }

    //fetch data for edit
    public static function fetch_country_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }

    //add country
    public static function add_country($tbl,$data)
    {
    	return \DB::table($tbl)
    				->insert($data);
    }

    //update
    public static function update_country($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //delete
    public  static function delete_country_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //check name exits
    public static function check_country_name($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }
}
