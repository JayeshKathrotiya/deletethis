<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaqM extends Model
{
    //get data
    public static function getfaqData()
    {
    	$class_id = session('class_login_session_id');
    	return \DB::table('tbl_faq')
    			->where(array('isdelete' => 0,'class_id' => $class_id))
    			->get();	
    }

    //insert data
    public static function insert($data)
    {
    	return \DB::table('tbl_faq')
    			->insert($data);	
    }

    //delete and update
    public static function update_data($tbl,$where,$data)
    {
    	return \DB::table($tbl)
    			->where($where)
    			->update($data);
    }

    //fetch data
    public static function fetch_faq_data($tbl,$where)
    {
    	return \DB::table($tbl)
    			->where($where)
    			->first();
    }
}
