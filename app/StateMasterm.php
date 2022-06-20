<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateMasterm extends Model
{
    //fetch all state 
    public static function fetch_all_state()
    {
    	return \DB::table('tbl_master_state')
    				->select('tbl_master_state.*','tbl_master_country.country_name')
    				->join('tbl_master_country','tbl_master_country.id','=','tbl_master_state.country_id')
    				->where(array('tbl_master_state.isdelete' => 0,'tbl_master_country.isdelete' => 0))
                    ->orderby('tbl_master_state.id','desc')
    				->get();
    }

    //fetch all country 
    public static function fetch_all_country($tbl)
    {
    	return \DB::table($tbl)
    				->where(array('isdelete' => 0))
    				->get();
    }

    //fetch data for edit
    public static function fetch_state_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }

    //add state
    public static function add_state($tbl,$data)
    {
    	return \DB::table($tbl)
    				->insert($data);
    }

    //update
    public static function update_state($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //delete
    public  static function delete_state_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->update($data);
    }

    //check name exits
    public static function check_state_name($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->first();
    }
}
