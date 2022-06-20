<?php

namespace App\Http\Controllers;

use App\AddM;
use App\ClassM;
use App\GenericM;
use App\SponsoredSliderM;
use Illuminate\Http\Request;
use App\Mail\Allmail;

class Add extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['class'] = ClassM::getClassData();
        $class_id = session('class_login_session_id');
        $data['add'] = AddM::getAdvertise(array('tsr.class_id'=>$class_id,'tsr.isdelete'=>0));
        // dd($data);
        return view('edifygoclass/advertise/index',$data);
    }

    // public function priceLogic()
    // {
    //     AddM::priceLogic();
    // }

    public function addadvertise(Request $request)
    {
        if ($request->slider!="" && $request->city_id!="" && $request->class_id!="") {
            switch ($request->slider) {
                case 1:
                    //1=Excluseive/Home Slider
                    $data['slider_name'] = "Excluseive";
                    break;
                case 2:
                    //2=Promoter Slider
                    $data['slider_name'] = "Promoter";
                    break;
                case 3:
                    //3=Feature Slider
                    $data['slider_name'] = "Feature";
                    break;
                case 4:
                    //4=Newly Arrived Slider
                    $data['slider_name'] = "Newly Arrived";
                    break;
                case 5:
                    //5=Sponsored Slider
                    $data['slider_name'] = "Sponsored";
                    $data['maincourse_id'] = $request->maincourse;
                    $data['subcourse_id'] = $request->subcourse;
                    $data['childcourse_id'] = $request->childcourse;
                    break;
                case 6:
                    //6=Popular class
                    $data['slider_name'] = "Popular Class";
                    break;

                default:
                    break;
            }

            $data['class_id'] = $request->class_id;
            $data['city_id'] = $request->city_id;
            $data['isapprove'] = 0;
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d H:i:s');

            $isinsert = GenericM::insertData('tbl_slider_request',$data);
            if ($isinsert) {
                //Advertise mail
                $row = GenericM::getSingleRecord('tbl_class_registration',array('email','firstname','lastname'),array('id'=>$request->class_id));
                // dd($stud_row);
                if ($row->email) {
                    $all_type = ['type' => 7,'slider_name'=>$data['slider_name'],'firstname'=>$row->firstname,'lastname'=>$row->lastname];
                    try {
                        // \Mail::to($row->email)->send(new Allmail($all_type));
                    } catch (\Exception $e) {
                        
                    }
                }

                session()->flash('success-msg','Advertise created successfully.');
            }else
            {
                session()->flash('error-msg','Advertise not created1.');
            }
        }else
        {
                session()->flash('error-msg','Advertise not created2.');
        }

        return redirect('/add');
    }

    public function deleteRequest(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_slider_request',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Advertise deleted successfully.');
        }else
        {
            session()->flash('success-msg','Advertise not deleted.');
        }

        echo json_encode(TRUE);
    }


    public function getMainCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        if($class_id) {
            $res = SponsoredSliderM::fetch_main_course($class_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                echo json_encode(false);
            }
        }  else {
            echo json_encode(false);
        }
    }


    public function getSubCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        $main_course_id = $request->main_course_id;
        if($class_id) {
            $res = SponsoredSliderM::fetch_sub_course($class_id,$main_course_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                echo json_encode(false);
            }
        }  else {
            echo json_encode(false);
        }
    }

    public function getChildCourse(Request $request)
    {
        $class_id = session('class_login_session_id');
        $main_course_id = $request->main_course_id;
        $sub_course_id = $request->sub_course_id;
        if($class_id) {
            $res = SponsoredSliderM::fetch_child_course($class_id,$main_course_id,$sub_course_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                $id = SponsoredSliderM::fetch_single_course_id($class_id,$main_course_id,$sub_course_id);
                echo json_encode($id->id);
            }
        }  else {
            echo json_encode(false);
        }
    }

    //Admin Side

    public function listAdd()
    {
        $data['add'] = AddM::getAdvertise(array('tsr.isdelete'=>0));
        // dd($data);
        return view('admin/advertise/index',$data);
    }

    public function isApproveRequest(Request $request)
    {
        if ($request->id!="") {
            $data['isapprove'] = $request->status;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_slider_request',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Advertise updated successfully.');
            }else
            {
                session()->flash('success-msg','Advertise not updated.');
            }
        }

        echo json_encode(TRUE);
    }
}
