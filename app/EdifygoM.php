<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EdifygoM extends Model
{

    public static function getCount($tbl,$where)
    {
        $data = \DB::table($tbl)
                    ->where($where)
                    ->get();
        return count($data);
    }

    public static function classCount()
    {
        $data = \DB::table('tbl_class_registration as tcr')
                        ->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                        ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                        ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                        ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                        ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                        ->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
                        ->where(array('tcr.isdelete' => 0,'tcr.isverified' => 1))
                        ->orderby('tcr.id','desc')
                        ->get();
        
        return count($data);
    }

    public static function courseCount()
    {
        $data = \DB::table('tbl_class_course as tcc')
                ->select('tcc.*','tcr.name as class_name','tmcountry.country_name','tmstat.state_name','tmcity.city_name','tmarea.area_name','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                ->join('tbl_master_country as tmcountry','tmcountry.id','=','tcr.country_id')
                ->join('tbl_master_state as tmstat','tmstat.id','=','tcr.state_id')
                ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                ->join('tbl_master_area as tmarea','tmarea.id','=','tcr.area_id')
                ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                ->where(array('tcr.isdelete' => 0,'tcc.isdelete' => 0))
                ->orderby('tcc.id','desc')
                ->get();
        
        return count($data);
    }

    //fetch city
    public static function fetch_city()
    {
        return \DB::table('tbl_master_city')
                    ->where(array('isdelete' => 0,'isactive'=>1))
                    ->get();
    }

    public static function getAllData($tbl,$where,$order)
    {
    	return \DB::table($tbl)
    				->where($where)
                    ->orderby($order)
    				->get();
    }

    public static function getLocationData()
    {
        $city_id = 1;//default surat city id is 1
        if (session('city_id')) {
            $city_id = session('city_id');
        }
        return \DB::table('tbl_master_area as tma')
                    ->select('tma.area_name','tma.id','tmc.city_name')
                    ->join('tbl_master_city as tmc','tmc.id','=','tma.city_id')
                    ->where(array('tma.isdelete'=>0,'tmc.isdelete'=>0,'tmc.id'=>$city_id))
                    ->get();
    }

    public static function getFeesData()
    {
        return \DB::table('tbl_admission_amount')
                    ->where(array('isdelete'=>0))
                    ->get();
    }

    public static function getMinFees()
    {
        return \DB::table('tbl_admission_amount')
                    ->where(array('isdelete'=>0))
                    ->min('amount');
    }

    public static function getMaxFees()
    {
        return \DB::table('tbl_admission_amount')
                    ->where(array('isdelete'=>0))
                    ->max('amount');
    }

    public static function getCouponData()
    {
        return \DB::table('tbl_admission_amount')
                    ->where(array('isdelete'=>0))
                    ->get();
    }

/*    public static function searchClass($maincourse_id,$area,$where,$orderby,$order)
    {
        $data =  \DB::table('tbl_class_registration as tcr')
                ->select('tcr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name')
                ->join('tbl_class_course as tcc','tcc.class_id','=','tcr.id')
                ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                // ->orWhere(array('tcr.area_id'=>$area,'tcc.maincourse_id'=>$maincourse_id))
                ->where($where)
                ->where(array('tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1,'tcr.issubscribe'=>1,'tcc.isdelete'=>0,'tcc.isapprove'=>1))
                ->groupBy('tcr.id')
                ->paginate(5);
                // ->get();
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {
                 $data[$key]->class_imglist = \DB::table('tbl_class_images as tci')
                    ->where(array('tci.isdelete'=>0,'tci.class_id'=>$value->id))
                    ->get();

            //count total courses
                $course = \DB::table('tbl_class_course')
                ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                ->get();
                $data[$key]->total_course = count($course);

                $data[$key]->offer_course = \DB::table('tbl_class_course')
                                            ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                                            ->orderBy(''.$orderby.'',''.$order.'')
                                            ->first();
            }

        }
        return $data;
    }*/

    public static function searchClass($where,$where_between,$orderby,$order)
    {
        $data = \DB::table('tbl_class_course as tcc')
                    ->select('tcr.*','tcc.id as course_id','tcc.price','tcc.final_price','tcc.total_discount_per','tcc.admission_fees_selection','tcc.final_price','tcc.admission_fees_selection_value','tcc.student_addmission_fees','tcc.student_original_discount_per','tcc.isExclusive','tcc.ex_total_discount_per','tcc.ex_admission_fees_selection','tcc.ex_final_price','tcc.ex_admission_fees_selection_value','tcc.ex_student_addmission_fees','tcc.ex_student_original_discount_per','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tcc.admission_fees_selection_value_final','tcc.ex_admission_fees_selection_value_final')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->where($where)
                    ->where($where_between)
                    ->where(array('tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1,'tcr.issubscribe'=>1,'tcc.isdelete'=>0,'tcc.isapprove'=>1))
                    ->groupBy('tcc.class_id')
                    ->orderby(''.$orderby.'',''.$order.'')
                    ->paginate(5);
                    // dd($data);
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {
                 $data[$key]->class_imglist = \DB::table('tbl_class_images as tci')
                    ->where(array('tci.isdelete'=>0,'tci.class_id'=>$value->id))
                    ->get();

                //count total courses
                $course = \DB::table('tbl_class_course')
                ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                ->get();
                $data[$key]->total_course = count($course);

                //count total students
                $stud = \DB::table('tbl_enroll_course')
                ->where(array('class_id'=>$value->id))
                ->get();
                $data[$key]->total_stud = count($stud);

                //review rating
                $data[$key]->rating_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('rating');

                $data[$key]->rating_sum = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->id,'isreview'=>1,'isapprove_review'=>1))
                            ->sum('rating');

                $data[$key]->review_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('review');

                /*$data[$key]->offer_course = \DB::table('tbl_class_course')
                                            ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                                            ->orderBy(''.$orderby.'',''.$order.'')
                                            ->first();*/
            }

        }
        return $data;
    }

    public static function getselectedLocationData($where)
    {
        return \DB::table('tbl_master_area as tma')
                    ->select('tma.area_name','tmc.city_name')
                    ->join('tbl_master_city as tmc','tmc.id','=','tma.city_id')
                    ->where($where)
                    ->first();
    }

    public static function getselectedCourseData($where)
    {
        return \DB::table('tbl_main_course')
                    ->where($where)
                    ->first();
    }

    public static function getrelatedSearch()
    {
        return \DB::table('tbl_related_search as trs')
                    ->select('tma.area_name','tmc.city_name','tmcourse.name')
                    ->join('tbl_master_area as tma','tma.id','=','trs.area_id')
                    ->join('tbl_master_city as tmc','tmc.id','=','tma.city_id')
                    ->join('tbl_main_course as tmcourse','tmcourse.id','=','trs.maincourse_id')
                    ->get();
    }

    public static function getslider($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
    				->get();
    }

    public static function getsliderforhome($tbl,$city_id)
    {
        return \DB::table(''.$tbl.' as ths')
                    ->select('ths.*')
                    ->join('tbl_class_registration as tcr','tcr.id','=','ths.class_id')
                    ->where(array('ths.isdelete'=>0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'ths.city_id' => $city_id))
                    ->get();
    }

    public static function getslidersingle($tbl,$where)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->first();
    }

    public static function getsliderjoin($tbl)
    {
        return \DB::table($tbl)
                    ->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as image','tbl_master_city.city_name','tbl_master_area.area_name')
                        ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                        ->join('tbl_master_city','tbl_master_city.id','=','tbl_class_registration.city_id')
                        ->join('tbl_master_area','tbl_master_area.id','=','tbl_class_registration.area_id')
                    ->where(array(''.$tbl.'.isdelete' => 0,'tbl_master_city.isdelete' => 0,'tbl_master_area.isdelete' => 0))
                    ->orderby(''.$tbl.'.id','asc')
                    ->get();
    }

    public static function getsliderjoin1($tbl,$city_id)
    {
        return \DB::table($tbl)
                    ->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_master_city.city_name','tbl_master_area.area_name','tbl_class_registration.firstname','tbl_class_registration.lastname')
                        ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                        ->join('tbl_master_city','tbl_master_city.id','=','tbl_class_registration.city_id')
                        ->join('tbl_master_area','tbl_master_area.id','=','tbl_class_registration.area_id')
                    ->where(array(''.$tbl.'.isdelete' => 0,'tbl_master_city.isdelete' => 0,'tbl_master_area.isdelete' => 0,'tbl_class_registration.isapprove'=>1,'tbl_class_registration.isdelete'=>0,'tbl_class_registration.issubscribe'=>1,'tbl_class_registration.isverified'=>1,''.$tbl.'.city_id' => $city_id))
                    ->orderby(''.$tbl.'.id','asc')
                    ->get();
    }

    public static function getsliderjoin2($tbl,$city_id)
    {
        $data =  \DB::table($tbl)
                    ->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_master_city.city_name','tbl_master_area.area_name','tbl_class_registration.firstname','tbl_class_registration.lastname','tbl_main_course.name as maincourse_name','tbl_sub_course.name as sub_course_name','tbl_sub_course.image as sub_course_image','tbl_child_course.name as child_course_name','tbl_child_course.image as child_course_image','tbl_class_course.id as course_id','tbl_class_course.price','tbl_class_course.final_price','tbl_class_course.owner_service_charge_per','tbl_class_course.client_discount_per','tbl_class_course.admission_fees_selection_value','tbl_class_course.admission_fees_selection','tbl_class_course.total_discount_per','tbl_class_course.student_addmission_fees','tbl_class_course.student_original_discount_per','tbl_class_course.isExclusive','tbl_class_course.ex_total_discount_per','tbl_class_course.ex_admission_fees_selection','tbl_class_course.ex_admission_fees_selection_value','tbl_class_course.ex_final_price','tbl_class_course.ex_student_original_discount_per','tbl_class_course.ex_student_addmission_fees','tbl_class_course.admission_fees_selection_value_final','tbl_class_course.ex_admission_fees_selection_value_final')
                        ->join('tbl_main_course','tbl_main_course.id','=',''.$tbl.'.main_course_id')
                        ->join('tbl_sub_course','tbl_sub_course.id','=',''.$tbl.'.sub_course_id')
                        ->leftjoin('tbl_child_course','tbl_child_course.id','=',''.$tbl.'.child_course_id')
                        ->join('tbl_class_course','tbl_class_course.id','=',''.$tbl.'.class_course_id')
                        ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                        ->join('tbl_master_city','tbl_master_city.id','=','tbl_class_registration.city_id')
                        ->join('tbl_master_area','tbl_master_area.id','=','tbl_class_registration.area_id')
                    ->where(array(''.$tbl.'.isdelete' => 0,''.$tbl.'.isactive' => 1,'tbl_master_city.isdelete' => 0,'tbl_master_area.isdelete' => 0,'tbl_class_registration.isapprove'=>1,'tbl_class_registration.isdelete'=>0,'tbl_class_registration.issubscribe'=>1,'tbl_class_registration.isverified'=>1,'tbl_class_course.isdelete'=>0,'tbl_class_course.isapprove'=>1,''.$tbl.'.city_id' => $city_id))
                    ->orderby(''.$tbl.'.id','asc')
                    ->get();
        if (!empty($data)) {
            foreach ($data as $key => $value) {

                if ($value->isExclusive==1) {
                    //Exclusive Course
                    $value->total_discount_per = $value->ex_total_discount_per;
                    $value->admission_fees_selection = $value->ex_admission_fees_selection;
                    $value->admission_fees_selection_value = $value->ex_admission_fees_selection_value;
                    $value->final_price = $value->ex_final_price;
                    $value->student_original_discount_per = $value->ex_student_original_discount_per;  
                    $value->student_addmission_fees = $value->ex_student_addmission_fees; 
                }
            }
        }

        return $data;
    }

    public static function getsliderjoin3($tbl,$city_id)
    {
        $result = \DB::table($tbl)
                    ->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_master_city.city_name','tbl_master_area.area_name')
                        ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                        ->join('tbl_master_city','tbl_master_city.id','=','tbl_class_registration.city_id')
                        ->join('tbl_master_area','tbl_master_area.id','=','tbl_class_registration.area_id')
                    ->where(array(''.$tbl.'.isdelete' => 0,'tbl_master_city.isdelete' => 0,'tbl_master_area.isdelete' => 0,'tbl_class_registration.isapprove'=>1,'tbl_class_registration.isdelete'=>0,'tbl_class_registration.issubscribe'=>1,'tbl_class_registration.isverified'=>1,''.$tbl.'.city_id' => $city_id))
                    ->orderby(''.$tbl.'.id','asc')
                    ->get();
                    // dd($result);
            if(!$result->isEmpty()) {
                foreach ($result as $key => $value) {
                    $result[$key]->class = \DB::table('tbl_class_course')
                            ->select('isExclusive','total_discount_per','admission_fees_selection','admission_fees_selection_value','price','final_price','student_original_discount_per','ex_total_discount_per','ex_admission_fees_selection','ex_admission_fees_selection_value','ex_final_price','ex_student_original_discount_per','admission_fees_selection_value_final','ex_admission_fees_selection_value_final')
                            ->where(array('class_id' => $value->class_id,'isdelete'=>0,'isapprove'=>1,'seat_available'=>1))
                            ->orderby('total_discount_per','DESC')
                            ->first();
                    if (!empty($result[$key]->class)) {
                        if ($result[$key]->class->isExclusive==1) {
                            //Exclusive Course
                            $result[$key]->class->total_discount_per = $result[$key]->class->ex_total_discount_per;
                            $result[$key]->class->admission_fees_selection = $result[$key]->class->ex_admission_fees_selection;
                            $result[$key]->class->admission_fees_selection_value = $result[$key]->class->ex_admission_fees_selection_value;
                            $result[$key]->class->final_price = $result[$key]->class->ex_final_price;
                            $result[$key]->class->student_original_discount_per = $result[$key]->class->ex_student_original_discount_per;
                        }
                    }
                }
            }
        return $result;
    }

    public static function getsliderjoin4($tbl,$city_id)
    {
        $result = \DB::table($tbl)
                    ->select(''.$tbl.'.*','tbl_class_registration.name','tbl_class_registration.class_logo as class_logo','tbl_master_city.city_name','tbl_master_area.area_name','tbl_class_registration.firstname','tbl_class_registration.lastname')
                        ->join('tbl_class_registration','tbl_class_registration.id','=',''.$tbl.'.class_id')
                        ->join('tbl_master_city','tbl_master_city.id','=','tbl_class_registration.city_id')
                        ->join('tbl_master_area','tbl_master_area.id','=','tbl_class_registration.area_id')
                    ->where(array(''.$tbl.'.isdelete' => 0,'tbl_master_city.isdelete' => 0,'tbl_master_area.isdelete' => 0,'tbl_class_registration.isapprove'=>1,'tbl_class_registration.isdelete'=>0,'tbl_class_registration.issubscribe'=>1,'tbl_class_registration.isverified'=>1,''.$tbl.'.city_id' => $city_id))
                    ->orderby(''.$tbl.'.id','asc')
                    ->get();

            if(!$result->isEmpty()) {
                foreach ($result as $key => $value) {
                    $result[$key]->class = \DB::table('tbl_class_course')
                            ->select('isExclusive','total_discount_per','admission_fees_selection','admission_fees_selection_value','price','final_price','student_addmission_fees','ex_total_discount_per','ex_admission_fees_selection','ex_admission_fees_selection_value','ex_final_price','ex_student_original_discount_per','ex_student_addmission_fees')
                            ->where(array('class_id' => $value->class_id,'isdelete'=>0,'isapprove'=>1))
                            ->orderby('total_discount_per','DESC')
                            ->first();

                    if (!empty($result[$key]->class) && $result[$key]->class->isExclusive==1) {
                        $result[$key]->class->student_addmission_fees = $result[$key]->class->ex_student_addmission_fees;
                    }

                    $result[$key]->rating_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('rating');

                    $result[$key]->rating_sum = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->sum('rating');

                    $result[$key]->review_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $value->class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('review');
                            // dd($data);
                    // if(!$result->isEmpty()) {
                    //     $result[$key]->class = $data;
                    // }
                }
            }
            return $result;
    }

    //get all review
    public static function getAllReview()
    {
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.rating','tec.review','tec.isapprove_review','tec.id','tcr.name as class_name','tcc.name as course_name','tsr.firstname','tsr.lastname','tec.ratingdate')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tec.class_id')
                    ->join('tbl_class_course as tcc','tcc.id','=','tec.course_id')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('tec.isreview'=>1))
                    ->orderby('tec.ratingdate','DESC')
                    ->get();
    }
}
