<?php

namespace App\Http\Controllers;

use App\GeneralSettingM;
use App\GenericM;
use Illuminate\Http\Request;

class GeneralSetting extends Validation
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['value'] = GenericM::getSingleRecord('tbl_setting_value','*',array());
        return view('admin/general_setting/index',$data);
    }

    public function addValue(Request $request)
    {
        $data['trial_course_fee'] = $request->trial_course_fee;
        $data['student_discount_perc'] = $request->student_discount_perc;
        $data['owner_discount_per'] = 100 - $request->student_discount_perc;
        $data['GST_per'] = $request->GST_per;
        $data['subscription_charge'] = $request->subscription_charge;
        $data['exclusive_charge_per'] = $request->exclusive_charge_per;
        $data['ex_student_discount_perc'] = $request->ex_student_discount_perc;
        $data['ex_owner_discount_per'] = 100 - $request->ex_student_discount_perc;
        $data['offer_text'] = $request->offer_text;
        $data['date'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_setting_value',$data);
            if ($isInsert) {
                session()->flash('success-msg','Value inserted successfully.');
            }else
            {
                session()->flash('error-msg','Value not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Value not inserted.');
        }

        return redirect('/setting');
    }

    public function editValue(Request $request)
    {
        if ($request->id!="") {
            $row = GenericM::getSingleRecord('tbl_setting_value','*',array('id'=>$request->id));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateValue(Request $request)
    {
        $data['trial_course_fee'] = $request->edittrial_course_fee;
        $data['student_discount_perc'] = $request->editstudent_discount_perc;
        $data['owner_discount_per'] = 100 - $request->editstudent_discount_perc;
        $data['GST_per'] = $request->editGST_per;
        $data['subscription_charge'] = $request->editsubscription_charge;
        $data['exclusive_charge_per'] = $request->editexclusive_charge_per;
        $data['ex_student_discount_perc'] = $request->editex_student_discount_perc;
        $data['ex_owner_discount_per'] = 100 - $request->editex_student_discount_perc;
        $data['offer_text'] = $request->edit_offer_text;
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id' => $request->hdvalue_id);
        $isUpdate = GenericM::updateData('tbl_setting_value',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Value updated successfully.');
        }else
        {
            session()->flash('success-msg','Value not updated.');
        }

        return redirect('/setting');
    }

    public function deleteValue(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_setting_value',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Value deleted successfully.');
        }else
        {
            session()->flash('success-msg','Value not deleted.');
        }

        return redirect('/setting');
    }
}
