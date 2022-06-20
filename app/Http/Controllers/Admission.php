<?php

namespace App\Http\Controllers;

use App\AdmissionM;
use App\GenericM;
use Illuminate\Http\Request;

class Admission extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['amounts'] = AdmissionM::getAllData('tbl_admission_amount',array('isdelete' =>0));
        return view('admin/admission/index',$data);
    }

    public function checkAddExistAmount(Request $request)
    {
        if ($request->amount!="") {
            $isExists = GenericM::getSingleRecord('tbl_admission_amount','id',array('amount'=>$request->amount,'isdelete'=>0));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function addAmount(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['isdelete'] = 0;
        $data['date'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_admission_amount',$data);
            if ($isInsert) {
                session()->flash('success-msg','Amount inserted successfully.');
            }else
            {
                session()->flash('error-msg','Amount not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Amount not inserted.');
        }

        return redirect('/admission');
    }

    public function checkEditExistAmount(Request $request)
    {
        if ($request->editamount!="") {
            $where = [
                ['id','<>',$request->hdamount_id],
                ['amount',$request->editamount],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_admission_amount','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function getEditAmount(Request $request)
    {
        if ($request->id!="") {
            $row = GenericM::getSingleRecord('tbl_admission_amount','*',array('id'=>$request->id));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateAmount(Request $request)
    {
        $data['amount'] = $request->editamount;
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id' => $request->hdamount_id);
        $isUpdate = GenericM::updateData('tbl_admission_amount',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Amount updated successfully.');
        }else
        {
            session()->flash('success-msg','Amount not updated.');
        }

        return redirect('/admission');
    }

    public function deleteAmount(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_admission_amount',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Amount deleted successfully.');
        }else
        {
            session()->flash('success-msg','Amount not deleted.');
        }

        echo json_encode(TRUE);
    }
}
