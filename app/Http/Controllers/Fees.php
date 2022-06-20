<?php

namespace App\Http\Controllers;

use App\FeesM;
use App\GenericM;
use Illuminate\Http\Request;

class Fees extends Validation
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fees'] = GenericM::getAllData('tbl_fee_structure',array('isdelete' =>0));
        $data['setting'] = GenericM::getSingleRecord('tbl_setting_value','*',array());
        return view('admin/fee/index',$data);
    }

    public function checkAddExistFee(Request $request)
    {
        if ($request->fee!="") {
            $isExists = GenericM::getSingleRecord('tbl_fee_structure','id',array('fee'=>$request->fee,'isdelete'=>0));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function addFee(Request $request)
    {
        $data['fee'] = $request->fee;
        $data['owner_charge_per'] = $request->owner_charge_per;
        $data['owner_charge_amount'] = $request->hd_owner_charge_amount;
        $data['isdelete'] = 0;
        $data['date'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_fee_structure',$data);
            if ($isInsert) {
                session()->flash('success-msg','Fee inserted successfully.');
            }else
            {
                session()->flash('error-msg','Fee not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Fee not inserted.');
        }

        return redirect('/fee');
    }

    public function checkEditExistFee(Request $request)
    {
        if ($request->editfee!="") {
            $where = [
                ['id','<>',$request->hdfee_id],
                ['fee',$request->editfee],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_fee_structure','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function getEditFee(Request $request)
    {
        if ($request->id!="") {
            $row = GenericM::getSingleRecord('tbl_fee_structure','*',array('id'=>$request->id));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateFee(Request $request)
    {
        $data['fee'] = $request->editfee;
        $data['owner_charge_per'] = $request->editowner_charge_per;
        $data['owner_charge_amount'] = $request->edithd_owner_charge_amount;
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id' => $request->hdfee_id);
        $isUpdate = GenericM::updateData('tbl_fee_structure',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Fee updated successfully.');
        }else
        {
            session()->flash('error-msg','Fee not updated.');
        }

        return redirect('/fee');
    }

    public function deleteFee(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_fee_structure',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Fee deleted successfully.');
        }else
        {
            session()->flash('success-msg','Fee not deleted.');
        }

        echo json_encode(TRUE);
    }
}
