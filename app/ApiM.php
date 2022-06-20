<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiM extends Model
{
    public static function getLocation()
    {
    	$data = \DB::table('tbl_master_country')
    				->where(array('isdelete'=>0))
    				->get();
    	//country by state
    	if (!empty($data)) {
    		foreach ($data as $s => $value) {
    			$data[$s]->state = \DB::table('tbl_master_state')
					    				->where(array('isdelete'=>0,'country_id'=>$value->id))
					    				->get();
    			//state by city
				if (!empty($data[$s]->state)) {
					foreach ($data[$s]->state as $c => $value1) {
						$data[$s]->state[$c]->city = \DB::table('tbl_master_city')
					    				->where(array('isdelete'=>0,'isactive'=>1,'state_id'=>$value1->id))
					    				->get();
					    if (!empty($data[$s]->state[$c]->city)) {
					    	foreach ($data[$s]->state[$c]->city as $a => $value2) {
					    		$data[$s]->state[$c]->city[$a]->area = \DB::table('tbl_master_area')
					    				->where(array('isdelete'=>0,'city_id'=>$value2->id))
					    				->get();
					    	}
					    }
					}
				}

    		}
    	}

    	return $data;
    }

    public static function login($tbl,$username,$password)
    {
        return \DB::table($tbl)
                    ->where(array('password'=>$password,'isdelete'=>0,'isverified'=>1))
                    ->where('email',$username)
                    ->orWhere('mobile',$username)
                    ->first();
    }

    public static function getStudentDetails($id)
    {
        return \DB::table('tbl_student_registration as tsr')
                    ->select('tsr.*','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                    ->join('tbl_master_country as tmc','tmc.id','=','tsr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tsr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tsr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tsr.area_id')
                    ->join('tbl_know_us as tku','tku.id','=','tsr.know_is_id')
                    ->where(array('tsr.isdelete'=>0,'tsr.isverified'=>1,'tsr.id'=>$id))
                    ->first();
    }

    public static function getExclusiveSlider($postal_code)
    {
        $path = asset('home_slider_img')."/";
        return \DB::table('tbl_home_slider as ths')
                    ->select('ths.id','ths.class_id','ths.city_id','ths.isdelete','ths.date',\DB::raw('CONCAT("'.$path.'",ths.image) AS url'))
                    ->join('tbl_class_registration as tcr','tcr.id','=','ths.class_id')
                    ->join('tbl_master_city as tmc','tmc.id','=','ths.city_id')
                    ->where(array('ths.isdelete'=>0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'tmc.postalcode' => $postal_code))
                    ->get();
    }

    public static function getAllCategories($tbl,$where)
    {
        $path = asset('main_course')."/";
        return \DB::table($tbl)
                    ->select('id','name','status','isdelete','date',\DB::raw('CONCAT("'.$path.'",image) AS url'))
                    ->where($where)
                    ->orderby('position','ASC')
                    ->get();
    }

    public static function getFreatureSlider($postal_code)
    {
        $path = asset('class_logo')."/";
        $result = \DB::table('tbl_feature_slider as tfs')
                    ->select('tfs.*','tcr.name',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'),'tmc.city_name','tma.area_name')
                        ->join('tbl_class_registration as tcr','tcr.id','=','tfs.class_id')
                        ->join('tbl_master_city as tmc','tmc.id','=','tcr.city_id')
                        ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->where(array('tfs.isdelete' => 0,'tmc.isdelete' => 0,'tma.isdelete' => 0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'tmc.postalcode' => $postal_code))
                    ->orderby('tfs.id','asc')
                    ->get();
                    // dd($result);
            if(!$result->isEmpty()) {
                foreach ($result as $key => $value) {
                    $result[$key]->class = \DB::table('tbl_class_course')
                            ->select('isExclusive','total_discount_per','admission_fees_selection','admission_fees_selection_value','price','final_price','student_original_discount_per','ex_total_discount_per','ex_admission_fees_selection','ex_admission_fees_selection_value','ex_final_price','ex_student_original_discount_per')
                            ->where(array('class_id' => $value->class_id,'isdelete'=>0,'isapprove'=>1,'seat_available'=>1))
                            ->orderby('total_discount_per','DESC')
                            ->first();
                            if (!empty($result[$key]->class)) {
                                if ($result[$key]->class->isExclusive==0) {
                                    if ($result[$key]->class->admission_fees_selection==0) {
                                        $result[$key]->class->admission_fees_selection_value = round($result[$key]->class->final_price*$result[$key]->class->admission_fees_selection_value/100);
                                    }
                                }else
                                {
                                    //Exclusive Course
                                    $result[$key]->class->total_discount_per = $result[$key]->class->ex_total_discount_per;
                                    $result[$key]->class->admission_fees_selection = $result[$key]->class->ex_admission_fees_selection;
                                    $result[$key]->class->admission_fees_selection_value = $result[$key]->class->ex_admission_fees_selection_value;
                                    $result[$key]->class->final_price = $result[$key]->class->ex_final_price;
                                    $result[$key]->class->student_original_discount_per = $result[$key]->class->ex_student_original_discount_per;

                                    if ($result[$key]->class->ex_admission_fees_selection==0) {
                                        $result[$key]->class->ex_admission_fees_selection_value = round($result[$key]->class->ex_final_price*$result[$key]->class->ex_admission_fees_selection_value/100);
                                    }

                                }
                            }
                }
            }
        return $result;
    }

    public static function getPromocode($tbl,$where)
    {
        $path = asset('promocode_slider_img')."/";
        return \DB::table($tbl)
                    ->select(\DB::raw('CONCAT("'.$path.'",image) AS url'))
                    ->where($where)
                    ->first();
    }

    public static function getPromoterSlider($postal_code)
    {
        $path = asset('class_logo')."/";
        return \DB::table('tbl_promoter_slider as tps')
                    ->select('tps.*','tcr.name',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'),'tmc.city_name','tma.area_name','tcr.firstname','tcr.lastname')
                        ->join('tbl_class_registration as tcr','tcr.id','=','tps.class_id')
                        ->join('tbl_master_city as tmc','tmc.id','=','tcr.city_id')
                        ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->where(array('tps.isdelete' => 0,'tmc.isdelete' => 0,'tma.isdelete' => 0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'tmc.postalcode' => $postal_code))
                    ->orderby('tps.id','asc')
                    ->get();
    }

    public static function getNewlySlider($postal_code)
    {
        $path = asset('class_logo')."/";
        $result = \DB::table('tbl_newly_slider as tns')
                    ->select('tns.*','tcr.name',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'),'tmc.city_name','tma.area_name','tcr.firstname','tcr.lastname')
                        ->join('tbl_class_registration as tcr','tcr.id','=','tns.class_id')
                        ->join('tbl_master_city as tmc','tmc.id','=','tcr.city_id')
                        ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->where(array('tns.isdelete' => 0,'tmc.isdelete' => 0,'tma.isdelete' => 0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'tmc.postalcode' => $postal_code))
                    ->orderby('tns.id','asc')
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

                    $result[$key]->api_rating = round($result[$key]->rating_sum/($result[$key]->rating_count ? $result[$key]->rating_count : 1));
                            // dd($data);
                    // if(!$result->isEmpty()) {
                    //     $result[$key]->class = $data;
                    // }
                }
            }
            return $result;
    }

    public static function getSponsered($postal_code)
    {
        $path = asset('class_logo')."/";
        $path1 = asset('sponsored_slider_img')."/";
        $data =  \DB::table('tbl_sponsored_slider as tss')
                    ->select('tss.*','tcr.name',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS class_logo'),\DB::raw('CONCAT("'.$path1.'",tss.image) AS url'),'tmc.city_name','tma.area_name','tcr.firstname','tcr.lastname','tcr.ispopular','tsc.name as sub_course_name','tsc.image as sub_course_image','tcc.name as child_course_name','tcc.image as child_course_image','tc_cou.id as course_id','tc_cou.price','tc_cou.final_price','tc_cou.owner_service_charge_per','tc_cou.client_discount_per','tc_cou.admission_fees_selection_value','tc_cou.admission_fees_selection','tc_cou.total_discount_per','tc_cou.student_addmission_fees','tc_cou.student_original_discount_per','tc_cou.isExclusive','tc_cou.ex_total_discount_per','tc_cou.ex_admission_fees_selection','tc_cou.ex_admission_fees_selection_value','tc_cou.ex_final_price','tc_cou.ex_student_original_discount_per','ex_student_addmission_fees')
                        ->join('tbl_sub_course as tsc','tsc.id','=','tss.sub_course_id')
                        ->leftjoin('tbl_child_course as tcc','tcc.id','=','tss.child_course_id')
                        ->join('tbl_class_course as tc_cou','tc_cou.id','=','tss.class_course_id')
                        ->join('tbl_class_registration as tcr','tcr.id','=','tss.class_id')
                        ->join('tbl_master_city as tmc','tmc.id','=','tcr.city_id')
                        ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->where(array('tss.isdelete' => 0,'tss.isactive' => 1,'tmc.isdelete' => 0,'tma.isdelete' => 0,'tcr.isapprove'=>1,'tcr.isdelete'=>0,'tcr.issubscribe'=>1,'tcr.isverified'=>1,'tc_cou.isdelete'=>0,'tc_cou.isapprove'=>1,'tmc.postalcode' => $postal_code))
                    ->orderby('tss.id','asc')
                    ->get();
        if (!empty($data)) {
            $default_path = asset('edifygo_assets')."/image/classes-logo.png";
            foreach ($data as $key => $value) {
                if ($value->url=="") {
                    $value->url = $value->class_logo;
                }

                if ($value->isExclusive==0) {
                    if ($value->admission_fees_selection==0) {
                        $value->admission_fees_selection_value = round($value->final_price*$value->admission_fees_selection_value/100);
                    }
                }else
                {
                    //Exclusive Course
                    $value->total_discount_per = $value->ex_total_discount_per;
                    $value->admission_fees_selection = $value->ex_admission_fees_selection;
                    $value->admission_fees_selection_value = $value->ex_admission_fees_selection_value;
                    $value->final_price = $value->ex_final_price;
                    $value->student_original_discount_per = $value->ex_student_original_discount_per;
                    $value->student_addmission_fees = $value->ex_student_addmission_fees;

                    if ($value->ex_admission_fees_selection==0) {
                        $value->ex_admission_fees_selection_value = round($value->ex_final_price*$value->ex_admission_fees_selection_value/100);
                    }

                }
            }
        }

        return $data;
    }

    public static function getSubcategories($cat_id,$where)
    {
        $path = asset('sub_course')."/";
        $data =  \DB::table('tbl_sub_course as tsc')
                    ->select('tsc.id','tsc.name','tsc.status','tsc.isdelete','tsc.date',\DB::raw('CONCAT("'.$path.'",tsc.image) AS url'))
                    ->join('tbl_class_course as tcc','tcc.subcourse_id','=','tsc.id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->where($where)
                    ->orderby('tsc.name')
                    ->groupBy('tsc.name')
                    ->get();
/*
        echo "<pre>";
        print_r($data);die;*/
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data[$key]->level = \DB::table('tbl_child_course')
                                    ->where(array('isdelete' =>0,'status' =>1,'sub_course_id'=>$value->id))
                                    ->count('id') ? 1 : 0;
            }
        }

        return $data;
    }

    public static function getChildcategories($where)
    {
        $path = asset('child_course')."/";
        return \DB::table('tbl_child_course as tcc')
                    ->select('tcc.id','tcc.name','tcc.status','tcc.isdelete','tcc.date',\DB::raw('CONCAT("'.$path.'",tcc.image) AS url'))
                    ->join('tbl_class_course as tclassc','tclassc.childcourse_id','=','tcc.id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tclassc.class_id')
                    ->where($where)
                    ->orderby('tcc.name')
                    ->groupBy('tcc.name')
                    ->get();
    }

    public static function getClassDataByID($id)
    {
        $path = asset('class_logo')."/";
        $path1 = asset('class_video')."/";
        $row = \DB::table('tbl_class_registration as tcr')
                    ->select('tcr.*',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS logo_url'),\DB::raw('CONCAT("'.$path1.'",tcr.class_video) AS video_url'),'tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tku.title')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->join('tbl_know_us as tku','tku.id','=','tcr.know_is_id')
                    ->where(array('tcr.isdelete' =>0,'tcr.isverified'=>1,'tcr.id'=>$id,'tcr.isapprove'=>1))
                    ->first();
        if (!empty($row)) {
            //create link for redirect website
            $row->class_link = url('viewcourse')."/".$row->id;
            //class images
            $path = asset('class_images')."/";
            $row->class_imglist = \DB::table('tbl_class_images as tci')
                    ->select('tci.id','tci.class_id','tci.isdelete',\DB::raw('CONCAT("'.$path.'",tci.image) AS url'))
                    ->where(array('tci.isdelete'=>0,'tci.class_id'=>$row->id))
                    ->get();

            //rankers images
            $path1 = asset('ranker_images')."/";
            $row->class_rankerlist = \DB::table('tbl_class_rankers as tcr')
                    ->select('tcr.id','tcr.title','tcr.per',\DB::raw('CONCAT("'.$path1.'",tcr.image) AS url'))
                    ->where(array('tcr.isdelete'=>0,'tcr.class_id'=>$row->id))
                    ->get();
                    
            //get All PDF
            $path2 = asset('class_pdf')."/";
            $row->class_pdflist = \DB::table('tbl_class_pdf as tcp')
                                ->select('tcp.id','tcp.title','tcp.date',\DB::raw('CONCAT("'.$path2.'",tcp.pdf) AS url'))
                                ->where(array('isdelete'=>0,'tcp.class_id'=>$row->id))
                                ->get();

            //get All You tube links
            $row->class_tubelist = \DB::table('tbl_class_youtube_links as tcyl')
                                        ->where(array('isdelete'=>0,'tcyl.class_id'=>$row->id))
                                        ->get();

            $row->rating_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $row->id,'isreview'=>1))
                            ->count('rating');

            $row->rating_sum = \DB::table('tbl_enroll_course')
                    ->where(array('class_id' => $row->id,'isreview'=>1))
                    ->sum('rating');

            $row->review_count = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $row->id,'isreview'=>1))
                            ->count('review');
            $row->api_rating = round($row->rating_sum/($row->rating_count ? $row->rating_count : 1));
        }
        return $row;
    }

    public static function getAllCourse($where)
    {
        $data =  \DB::table('tbl_class_course as tcc')
                    ->select('tcc.*','tcr.isapprove as cl_isapprove','tcr.address','tcr.name as class_name','tmc.name as maincourse_name','tsc.name as subcourse_name','tchieldc.name as chieldcourse_name')
                    ->join('tbl_main_course as tmc','tmc.id','=','tcc.maincourse_id')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->leftjoin('tbl_child_course as tchieldc','tchieldc.id','=','tcc.childcourse_id')
                    ->where($where)
                    ->orderBy('tcc.id','DESC')
                    ->get();
        // dd($data);
        if (!$data->isEmpty()) {
            $data[0]->istrialcourse = 0;
            foreach ($data as $key => $value) {
                    //All Calculations
                    if ($value->isExclusive==0) {
                        $data[$key]->api_student_admission_fees = $value->student_addmission_fees;
                        $data[$key]->api_student_original_discount_per = $value->student_original_discount_per;
                        if ($value->admission_fees_selection==0) {
                            $data[$key]->api_admission_fees_selection_value = round($value->final_price*$value->admission_fees_selection_value/100);
                        }else
                        {
                            $data[$key]->api_admission_fees_selection_value = $value->admission_fees_selection_value;
                        }
                    }else
                    {
                        //Exclusive Course
                        $data[$key]->api_student_admission_fees = $value->ex_student_addmission_fees;
                        $data[$key]->api_student_original_discount_per = $value->ex_student_original_discount_per;
                        if ($value->ex_admission_fees_selection==0) {
                            $data[$key]->api_admission_fees_selection_value = round($value->final_price*$value->ex_admission_fees_selection_value/100);
                        }else
                        {
                            $data[$key]->api_admission_fees_selection_value = $value->admission_fees_selection_value;
                        }
                    }
                    //get All date
                    $data[$key]->date = \DB::table('tbl_class_course_date')
                                        ->where(array('isdelete'=>0,'course_id'=>$value->id))
                                        ->first();
                                        
                    if ($data[$key]->date) {
                        $data[$key]->date->start_date = date('d-m-Y',strtotime($data[$key]->date->start_date));
                        $data[$key]->date->end_date = date('d-m-Y',strtotime($data[$key]->date->end_date));
                        $data[$key]->date->time = \DB::table('tbl_class_course_time')
                                                        ->where(array('isdelete'=>0,'course_date_id'=>$data[$key]->date->id))
                                                        ->get();
                        //convert time to AM/PM Format
                        if (!empty($data[$key]->date->time)) {
                            foreach ($data[$key]->date->time as $tt => $time) {
                                $time->start_time = date("g:i A", strtotime($time->start_time));
                                $time->end_time = date("g:i A", strtotime($time->end_time));
                            }
                        }
                    }

                    //check if ant trial coursed  this class
                    if ($data[0]->istrialcourse==0) {
                        if ($value->batch_type!=0) {
                            $data[0]->istrialcourse = 1;
                        }
                    }
            }
        }

        return $data;
    }

    public static function getAllCount($class_id)
    {
        $data = array();
        $data['rating_count'] = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('rating');

        $data['rating_sum'] = \DB::table('tbl_enroll_course')
                ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                ->sum('rating');

        $data['review_count'] = \DB::table('tbl_enroll_course')
                            ->where(array('class_id' => $class_id,'isreview'=>1,'isapprove_review'=>1))
                            ->count('review');

        return $data;
    }

    public static function getAllRating($class_id)
    {
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.rating','tec.review','tec.ratingdate','tsr.firstname','tsr.lastname')
                    ->join('tbl_student_registration as tsr','tsr.id','=','tec.student_id')
                    ->where(array('tec.class_id' => $class_id,'tec.isreview'=>1,'tec.isapprove_review'=>1))
                    ->get();
    }

    public static function getEnroll($id)
    {
        $path = asset('class_logo')."/";
        return \DB::table('tbl_enroll_course as tec')
                    ->select('tec.*',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'))
                    ->join('tbl_class_registration as tcr','tcr.id','=','tec.class_id')
                    ->where(array('tec.student_id'=>$id))
                    ->get();
    }

    public static function getBlog()
    {
        $path = asset('blogs')."/";
        return \DB::table('tbl_blog')
                ->select('*',\DB::raw('CONCAT("'.$path.'",image) AS url'))
                ->where(array('isdelete' =>0,'isactive'=>1))
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
    
    //filter logics for API
    public static function searchClass($where,$where_between,$orderby,$order)
    {
        $path = asset('class_logo')."/";
        $data = \DB::table('tbl_class_course as tcc')
                    ->select('tcr.*',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'),'tcc.id as course_id','tcc.price','tcc.final_price','tcc.total_discount_per','tcc.admission_fees_selection','tcc.final_price','tcc.admission_fees_selection_value','tcc.student_addmission_fees','tcc.student_original_discount_per','tcc.isExclusive','tcc.ex_total_discount_per','tcc.ex_admission_fees_selection','tcc.ex_final_price','tcc.ex_admission_fees_selection_value','tcc.ex_student_addmission_fees','tcc.ex_student_original_discount_per','tcc.total_ex_enroll','tcc.no_of_students','tcc.batch_type','tcc.batch_for','tcc.material_provided','tcc.certification_provided','tcc.seat_available','tcc.student_original_discount_value','tmc.country_name','tms.state_name','tmcity.city_name','tma.area_name','tmcourse.name AS maincourse_name','tsc.name as subcourse_name')
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->join('tbl_main_course as tmcourse','tmcourse.id','=','tcc.maincourse_id')
                    ->join('tbl_sub_course as tsc','tsc.id','=','tcc.subcourse_id')
                    ->where($where)
                    ->where($where_between)
                    ->where(array('tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1,'tcr.issubscribe'=>1,'tcc.isdelete'=>0,'tcc.isapprove'=>1))
                    ->groupBy('tcc.class_id')
                    ->orderby(''.$orderby.'',''.$order.'')
                    ->paginate(20);
                    // dd($data);
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {

                //All Calculations
                if ($value->isExclusive==0) {
                    $data[$key]->api_student_admission_fees = $value->student_addmission_fees;
                    $data[$key]->api_student_original_discount_per = $value->student_original_discount_per;
                    if ($value->admission_fees_selection==0) {
                        $data[$key]->api_admission_fees_selection_value = round($value->final_price*$value->admission_fees_selection_value/100);
                    }else
                    {
                        $data[$key]->api_admission_fees_selection_value = $value->admission_fees_selection_value;
                    }
                }else
                {
                    //Exclusive Course
                    $data[$key]->api_student_admission_fees = $value->ex_student_addmission_fees;
                    $data[$key]->api_student_original_discount_per = $value->ex_student_original_discount_per;
                    if ($value->ex_admission_fees_selection==0) {
                        $data[$key]->api_admission_fees_selection_value = round($value->final_price*$value->ex_admission_fees_selection_value/100);
                    }else
                    {
                        $data[$key]->api_admission_fees_selection_value = $value->admission_fees_selection_value;
                    }
                }
                    
                 $data[$key]->class_imglist = \DB::table('tbl_class_images as tci')
                    ->where(array('tci.isdelete'=>0,'tci.class_id'=>$value->id))
                    ->get();

                //count total courses
                $course = \DB::table('tbl_class_course')
                ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                ->get();
                $data[$key]->total_course = count($course);


                //get All date
                $data[$key]->date = \DB::table('tbl_class_course_date')
                                    ->where(array('isdelete'=>0,'course_id'=>$value->course_id))
                                    ->first();

                /*echo "<pre>";
                print_r($data[$key]->date->date);die;*/
                if ($data[$key]->date) {
                    $data[$key]->date->start_date = date('d-m-Y',strtotime($data[$key]->date->start_date));
                    $data[$key]->date->end_date = date('d-m-Y',strtotime($data[$key]->date->end_date));
                    $data[$key]->date->time = \DB::table('tbl_class_course_time')
                                                    ->where(array('isdelete'=>0,'course_date_id'=>$data[$key]->date->id))
                                                    ->get();
                    //convert time to AM/PM Format
                    if (!empty($data[$key]->date->time)) {
                        foreach ($data[$key]->date->time as $tt => $time) {
                            $time->start_time = date("g:i A", strtotime($time->start_time));
                            $time->end_time = date("g:i A", strtotime($time->end_time));
                        }
                    }
                }

                

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

                $data[$key]->api_rating = round($data[$key]->rating_sum/($data[$key]->rating_count ? $data[$key]->rating_count : 1));

                //concate address
                $value->area_name = $value->area_name.",".$value->city_name.",".$value->state_name.",".$value->country_name;

                //addmission_fees set
                if ($value->isExclusive==1) {
                    $value->student_addmission_fees = $value->ex_student_addmission_fees;
                }

                //admission fee type
                if ($value->admission_fees_selection==0) {
                    $value->admission_fees_selection_value = round($value->final_price*$value->admission_fees_selection_value/100);
                }
                /*$data[$key]->offer_course = \DB::table('tbl_class_course')
                                            ->where(array('isdelete'=>0,'isapprove'=>1,'class_id'=>$value->id))
                                            ->orderBy(''.$orderby.'',''.$order.'')
                                            ->first();*/
            }

        }
        return $data;
    }

    public static function relatedClass($where,$orderby,$order,$class_id)
    {
        $wherenot = [
            ['tcr.id','<>',$class_id]
        ];
        $path = asset('class_logo')."/";
        $path1 = asset('edifygo_assets')."/";
        $data = \DB::table('tbl_class_course as tcc')
                    ->select('tcr.id','tcr.name',\DB::raw('CONCAT("'.$path.'",tcr.class_logo) AS url'))
                    ->join('tbl_class_registration as tcr','tcr.id','=','tcc.class_id')
                    ->join('tbl_master_country as tmc','tmc.id','=','tcr.country_id')
                    ->join('tbl_master_state as tms','tms.id','=','tcr.state_id')
                    ->join('tbl_master_city as tmcity','tmcity.id','=','tcr.city_id')
                    ->join('tbl_master_area as tma','tma.id','=','tcr.area_id')
                    ->join('tbl_main_course as tmcourse','tmcourse.id','=','tcc.maincourse_id')
                    ->where($where)
                    ->where($wherenot)
                    ->where(array('tcr.isdelete'=>0,'tcr.isverified'=>1,'tcr.isapprove'=>1,'tcr.issubscribe'=>1,'tcc.isdelete'=>0,'tcc.isapprove'=>1))
                    ->groupBy('tcc.class_id')
                    ->orderby(''.$orderby.'',''.$order.'')
                    ->get();
                    // dd($data);
        if (!$data->isEmpty()) {
            foreach ($data as $key => $value) {
                if ($value->url=="") {
                    $value->url = $path1."image/classes-logo.png";
                }
            }

        }
        return $data;
    }

    public static function getLocationData($city)
    {
        $city_id = 1;//default surat city id is 1
        if ($city!="") {
            $city_id = $city;
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

    public static function getAllData($tbl,$where,$order)
    {
        return \DB::table($tbl)
                    ->where($where)
                    ->orderby($order)
                    ->get();
    }

    public static function getOfferText()
    {
        return \DB::table('tbl_setting_value')
                    ->select('offer_text')
                    ->first();
    }
}
