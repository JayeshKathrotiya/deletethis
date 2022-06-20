<?php

namespace App\Http\Controllers;

use App\CouponM;
use App\GenericM;
use Illuminate\Http\Request;

class Coupon extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coupon'] = CouponM::getAllData();
        $data['courses'] = GenericM::getAllData('tbl_main_course',array('isdelete'=>0));
        // dd($data);
        return view('admin/coupon/index',$data);
    }

    public function checkExists(Request $request)
    {
        if ($request->code) {
            $where = array('code'=>$request->code,'isdelete'=>0);
            $isExists = GenericM::getSingleRecord('tbl_coupon','id',$where);
            if (!$isExists)
                echo json_encode(TRUE);
            else
                echo json_encode(FALSE);
        }else if($request->coupon_id!="" && $request->editcode!="")
        {
            $where = [
                ['id','<>',$request->coupon_id],
                ['code',$request->editcode],
                ['isdelete',0]
            ];
            $isExists = GenericM::getSingleRecord('tbl_coupon','id',$where);
            if (!$isExists)
                echo json_encode(TRUE);
            else
                echo json_encode(FALSE);
        }
    }

    public function addCoupon(Request $request)
    {
        $data['code'] = $request->code;
        $data['perc'] = $request->perc;
        $data['coupon_type'] = $request->coupon_type;
        $data['start_date'] = $request->datetime1;
        $data['end_date'] = $request->datetime2;
        $data['isactive'] = 1;
        $data['isdelete'] = 0;
        $data['date'] = date('Y-m-d H:i:s');

        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_coupon',$data);
            // $isInsert = 1;
            if ($isInsert) {
                if ($request->coupon_type==1) {
                    $data1['coupon_id'] = $isInsert;
                    $course = $request->course;
                    if (!empty($course)) {
                        foreach ($course as $key => $value) {
                            $data1['course_id'] = $value;
                            GenericM::insertData('tbl_coupon_courses',$data1);                        
                        }
                    }
                }
                session()->flash('success-msg','Coupon inserted successfully.');
            }else
            {
                session()->flash('error-msg','Coupon not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Coupon not inserted.');
        }

        return redirect('/coupon');
    }

    public function isActive(Request $request)
    {
        $data['isactive'] = $request->status ? 0 : 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_coupon',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Coupon updated successfully.');
        }else
        {
            session()->flash('success-msg','Coupon not updated.');
        }

        echo json_encode(TRUE);
    }

    public function deleteCoupon(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_coupon',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Coupon deleted successfully.');
        }else
        {
            session()->flash('success-msg','Coupon not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function editCoupon(Request $request)
    {
        if ($request->id!="") {
            $row = CouponM::getDataByID($request->id);
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function updateCoupon(Request $request)
    {
        $data['code'] = $request->editcode;
        $data['perc'] = $request->editperc;
        $data['coupon_type'] = $request->editcoupon_type;
        $data['start_date'] = $request->editdatetime1;
        $data['end_date'] = $request->editdatetime2;
        $data['date'] = date('Y-m-d H:i:s');

        $coupon_id = $request->coupon_id;

        //delete old data
        CouponM::deleteCouponCourse('tbl_coupon_courses',array('coupon_id'=>$coupon_id));

        if ($request->editcoupon_type==1) {
            $data1['coupon_id'] = $coupon_id;
            $course = $request->editcourse;
            if (!empty($course)) {
                foreach ($course as $key => $value) {
                    $data1['course_id'] = $value;
                    GenericM::insertData('tbl_coupon_courses',$data1);                        
                }
            }
        }
        $where = array('id' => $request->coupon_id);
        $isUpdate = GenericM::updateData('tbl_coupon',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Coupon updated successfully.');
        }else
        {
            session()->flash('success-msg','Coupon not updated.');
        }

        return redirect('/coupon');
    }
}
