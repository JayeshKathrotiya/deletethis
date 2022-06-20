<?php

namespace App\Http\Controllers;
use App\EdifygoM;
use App\GenericM;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
    	$data['students'] = EdifygoM::getCount('tbl_student_registration',array('isdelete'=>0,'isverified'=>1));
    	$data['classes'] = EdifygoM::classCount();
        $data['courses'] = EdifygoM::courseCount();
        $data['slider'] = EdifygoM::getCount('tbl_slider_request',array('isdelete'=>0));
    	return view('admin/dashboard',$data);
    }

    public function review()
    {
    	$data['review'] = EdifygoM::getAllReview();
    	// dd($data);
    	return view('admin/review/index',$data);
    }

    public function isapprove(Request $request)
    {
    	$id = $request->id;
        if($id)
        {
            $data['isapprove_review'] = $request->status ? 0 : 1;
            $where = array('id' => $id);
            $res = GenericM::updateData('tbl_enroll_course',$where,$data);
            if($res) {
            	session()->flash('success-msg','Review updated successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Review not updated.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Review not updated.');
            echo json_encode(false);
        }
    }

    public function contactus()
    {
        $data['contacts'] = GenericM::getContatct();
        return view('admin/contactus/index',$data);
    }
}
