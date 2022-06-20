<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassM extends Model
{
    public static function getClassData()
    {
    	$row = \DB::table('tbl_class_registration as tcr')
    				->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
    				->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
    				->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
    				->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
    				->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
    				->where(array('tcr.isdelete' =>0,'tcr.isverified'=>1,'tcr.email'=>session('class_login_session')))
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

            //get All PDF
            $row->class_pdflist = \DB::table('tbl_class_pdf as tcp')
                                ->where(array('isdelete'=>0,'tcp.class_id'=>$row->id))
                                ->get();

            //get All You tube links
            $row->class_tubelist = \DB::table('tbl_class_youtube_links as tcyl')
                                        ->where(array('isdelete'=>0,'tcyl.class_id'=>$row->id))
                                        ->get();
        }
        return $row;
    }

    public static function getClassDataByID($id)
    {
        $row = \DB::table('tbl_class_registration as tcr')
                    ->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
                    ->where(array('tcr.isdelete' =>0,'tcr.isverified'=>1,'tcr.id'=>$id,'tcr.isapprove'=>1))
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
                    
            //get All PDF
            $row->class_pdflist = \DB::table('tbl_class_pdf as tcp')
                                ->where(array('isdelete'=>0,'tcp.class_id'=>$row->id))
                                ->get();

            //get All You tube links
            $row->class_tubelist = \DB::table('tbl_class_youtube_links as tcyl')
                                        ->where(array('isdelete'=>0,'tcyl.class_id'=>$row->id))
                                        ->get();

            $row->rating_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $row->id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('rating');

            $row->rating_sum = \DB::table('tbl_enroll_course')
                    ->where(array('class_id' => $row->id,'isreview'=>1,'isapprove_review'=>1))
                    ->sum('rating');

            $row->review_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $row->id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('review');
        }
        return $row;
    }

    public static function getSubscriptionData()
    {
        return \DB::table('tbl_setting_value')
                    ->select('subscription_charge')
                    ->first();
    }

    public static function getMainCourseByClass($class_id)
    {
        return \DB::table('tbl_main_course as tmc')
                    ->select('tmc.*')
                    ->join('tbl_class_course as tcc','tcc.maincourse_id','=','tmc.id')
                    ->where(array('tmc.isdelete'=>0,'tcc.isdelete'=>0,'tcc.isapprove'=>1,'tcc.class_id'=>$class_id))
                    ->groupBy('tmc.id')
                    ->get();
    }
}
