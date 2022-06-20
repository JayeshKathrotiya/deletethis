<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassesM extends Model
{
    public static function getClassData($id)
    {
    	$row = \DB::table('tbl_class_registration as tcr')
    				->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
    				->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
    				->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
    				->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
    				->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
    				->where(array('tcr.isdelete' =>0,'tcr.isverified'=>1,'tcr.id'=>$id))
    				->orWhere(array('tcr.mobile'=>session('class_login_session')))
    				->first();
        if (!empty($row)) {
            //class images
            $row->class_imglist = \DB::table('tbl_class_images as tci')
                    ->where(array('tci.isdelete'=>0,'tci.class_id'=>$row->id))
                    ->get();

            //rankers images
            $row->class_rankerlist = \DB::table('tbl_class_rankers as tcr')
                    ->where(array('tcr.isdelete'=>0,'tcr.class_id'=>$row->id))
                    ->get();

            //rankers images
            $row->class_pdflist = \DB::table('tbl_class_pdf as tcp')
                    ->where(array('tcp.isdelete'=>0,'tcp.class_id'=>$row->id))
                    ->get();

            //rankers images
            $row->class_tubelist = \DB::table('tbl_class_youtube_links as tcyl')
                    ->where(array('tcyl.isdelete'=>0,'tcyl.class_id'=>$row->id))
                    ->get();
        }
        return $row;
    }

    //fetch all data admin side
    public static function fetch_all_data_join()
    {
        return \DB::table('tbl_class_registration as tcr')
                    ->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
                    ->where(array('tcr.isdelete' => 0,'tcr.isverified' => 1))
                    // ->where(array('tcr.isdelete' => 0,'tku.isdelete' => 0,'tku.isactive' => 1,'tcr.isverified' => 1))
                    ->orderby('tcr.id','desc')
                    ->get();
    }

    public static function getAllFees($tbl,$where,$whereNotIn)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->whereNotIn('fee',$whereNotIn)
                    ->orderby('fee','ASC')
                    ->get();
    }

    public static function getOneFees($tbl,$where,$whereIn)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->whereIn('fee',$whereIn)
                    ->orderby('fee','ASC')
                    ->first();
    }
}
