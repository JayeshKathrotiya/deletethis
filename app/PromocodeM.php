<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromocodeM extends Model
{
    //fetch data
    public static function fetch_data($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->orderby('id','desc')
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
