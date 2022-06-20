<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddM extends Model
{
    public static function getAdvertise($where)
    {
    	return \DB::table('tbl_slider_request as tsr')
    				->select('tsr.*','tcr.name as class_name','tcr.mobile','tmc.city_name','tmcourse.name as main_course_name','tsc.name as sub_course_name','tcc.name as child_course_name')
    				->join('tbl_class_registration as tcr','tcr.id','=','tsr.class_id')
    				->join('tbl_master_city as tmc','tmc.id','=','tsr.city_id')
    				->leftjoin('tbl_main_course as tmcourse','tmcourse.id','=','tsr.maincourse_id')
                    ->leftjoin('tbl_sub_course as tsc','tsc.id','=','tsr.subcourse_id')             
                    ->leftjoin('tbl_child_course as tcc', function ($join) {
                        $join->on('tcc.id', '=', 'tsr.childcourse_id')
                             ->where('tcc.isdelete', 0);
                    })	
    				->where($where)
    				->orderBy('id','DESC')
    				->get();
    }

    // public static function priceLogic()
    // {
    //     $data = \DB::table('tbl_class_course')
    //             ->get();
    //     if (!empty($data)) {
    //         foreach ($data as $key => $value) {
    //             //simple course
    //                 if ($value->admission_fees_selection==0) {
    //                     $updata['admission_fees_selection_value_final'] = round($value->final_price*$value->admission_fees_selection_value/100);
    //                 }else
    //                 {
    //                     $updata['admission_fees_selection_value_final'] = $value->admission_fees_selection_value;
    //                 }
    //             //exclusive course
    //                 if ($value->ex_admission_fees_selection==0) {
    //                     $updata['ex_admission_fees_selection_value_final'] = round($value->ex_final_price*$value->ex_admission_fees_selection_value/100);
    //                 }else
    //                 {
    //                     $updata['ex_admission_fees_selection_value_final'] = $value->ex_admission_fees_selection_value;
    //                 }

    //             //update query
    //                 \DB::table('tbl_class_course')
    //                         ->where(array('id'=>$value->id))
    //                         ->update($updata);
    //         }
    //     }
    // }
}
