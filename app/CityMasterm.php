<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityMasterm extends Model
{
    //fetch all city 
    public static function fetch_all_city()
    {
    	return \DB::table('tbl_master_city')
    				->select('tbl_master_city.*','tbl_master_country.country_name','tbl_master_state.state_name')
    				->join('tbl_master_state','tbl_master_state.id','=','tbl_master_city.state_id')
    				->join('tbl_master_country','tbl_master_country.id','=','tbl_master_city.country_id')
    				->where(array('tbl_master_city.isdelete' => 0,'tbl_master_country.isdelete' => 0,'tbl_master_state.isdelete' => 0))
                    ->orderby('tbl_master_city.id','desc')
    				->get();
    }

    //fetch all country 
    public static function fetch_all_country($tbl)
    {
    	return \DB::table($tbl)
    				->where(array('isdelete' => 0))
    				->get();
    }

    //fetch all state 
    public static function fetch_state_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->get();
    }

    //fetch data for edit
    public static function fetch_city_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }

    //add city
    public static function add_city($tbl,$data)
    {
    	return \DB::table($tbl)
    				->insert($data);
    }

    //update
    public static function update_city($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //delete
    public  static function delete_city_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //check name exits
    public static function check_city_name($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }
}
