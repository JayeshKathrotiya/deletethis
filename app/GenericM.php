<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenericM extends Model
{
    public static function getSingleRecord($tbl,$select,$where)
    {
    	return \DB::table($tbl)
    				->select($select)
    				->where($where)
    				->first();
    }

    public static function getAllData($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
                    ->orderby('id','desc')
    				->get();
    }

    public static function insertData($tbl,$data)
    {
        // dd($data);
        return \DB::table($tbl)
                ->insertGetId($data);
    }

    /*public static function insertDataGetID($tbl,$data)
    {
        return \DB::table($tbl)
                ->insertGetId($data);
    }*/

    public static function updateData($tbl,$where,$data)
    {
        return \DB::table($tbl)
                ->where($where)
                ->update($data);
    }

    //middleware
    public static function getDataForExclusiveCheck()
    {
        return \DB::table('tbl_class_course')
                ->select('id','isExclusive','total_ex_enroll','no_of_students','expiry_date')
                ->where(array('isExclusive'=>1))
                ->get();
    }

    //middleware

    public static function getClassesSubscriptin()
    {
        return \DB::table('tbl_class_registration')
                    ->select('id','subscription_expire')
                    ->where(array('issubscribe'=>1))
                    ->get();
    }

    public static function getContatct()
    {
        return \DB::table('tbl_contactus as tc')
                    ->select('tc.*','tmc.city_name','tku.title')
                    ->join('tbl_master_city as tmc','tmc.id','=','tc.city_id')
                    ->join('tbl_know_us as tku','tku.id','=','tc.know_us_id')
                    ->get();
    }

}
