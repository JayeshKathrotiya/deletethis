<?php

namespace App\Http\Controllers;

use App\KnowusM;
use App\GenericM;
use Illuminate\Http\Request;

class KnowUs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['know'] = GenericM::getAllData('tbl_know_us',array('isdelete' =>0));
        return view('admin/general_setting/know_us',$data);
    }

    public function checkAddTitle(Request $request)
    {
        if ($request->title!="") {
            $isExists = GenericM::getSingleRecord('tbl_know_us','id',array('title'=>$request->title,'isdelete'=>0));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function addKnow(Request $request)
    {
        $data['title'] = $request->title;
        $data['isactive'] = 1;
        $data['isdelete'] = 0;
        $data['date'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_know_us',$data);
            if ($isInsert) {
                session()->flash('success-msg','Title inserted successfully.');
            }else
            {
                session()->flash('error-msg','Title not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Title not inserted.');
        }

        return redirect('/know-us');
    }

    public function deleteKnow(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_know_us',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Title deleted successfully.');
        }else
        {
            session()->flash('success-msg','Title not deleted.');
        }

        echo json_encode(TRUE);
    }

    public function isActive(Request $request)
    {
        $data['isactive'] = $request->status ? 0 : 1;
        $where = array('id' => $request->id);
        $isUpdate = GenericM::updateData('tbl_know_us',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Title updated successfully.');
        }else
        {
            session()->flash('success-msg','Title not updated.');
        }

        echo json_encode(TRUE);
    }

    public function editKnow(Request $request)
    {
        if ($request->id!="") {
            $row = GenericM::getSingleRecord('tbl_know_us','*',array('id'=>$request->id));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function checkEditTitle(Request $request)
    {
        if ($request->edit_title!="") {
            $where = [
                ['title',$request->edit_title],
                ['isdelete',0],
                ['id','<>',$request->know_id]
            ];
            $isExists = GenericM::getSingleRecord('tbl_know_us','id',$where);
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateKnow(Request $request)
    {
        $data['title'] = $request->edit_title;
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id' => $request->know_id);
        $isUpdate = GenericM::updateData('tbl_know_us',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Title updated successfully.');
        }else
        {
            session()->flash('success-msg','Title not updated.');
        }

        return redirect('/know-us');
    }
}
