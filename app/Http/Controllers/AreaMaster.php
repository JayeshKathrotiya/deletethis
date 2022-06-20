<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EdifygoM;
use App\AreaMasterm;
use App\GenericM;

class AreaMaster extends Controller
{
    //load the all city list
    public function index()
    {
    	$data['area'] = AreaMasterm::getAllArea();
    	$data['country'] = GenericM::getAllData('tbl_master_country',array('isdelete'=>0));
    	return view('admin/locations/masterarea',$data);
    }

    public function fetch_state(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $where = array('country_id' => $id,'isdelete' => 0);
            // $result = GenericM::getAllData('tbl_master_state',$where);
            $result = EdifygoM::getAllData('tbl_master_state',$where,'state_name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function fetch_city(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $where = array('state_id' => $id,'isdelete' => 0);
            // $result = GenericM::getAllData('tbl_master_city',$where);
            $result = EdifygoM::getAllData('tbl_master_city',$where,'city_name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function fetch_area(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $where = array('city_id' => $id,'isdelete' => 0);
            // $result = GenericM::getAllData('tbl_master_area',$where);
             $result = EdifygoM::getAllData('tbl_master_area',$where,'area_name');
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }

    public function checkAddAreaExists(Request $request)
    {
        if ($request->area_name!="" && $request->city_id!="" && $request->state_id!="" && $request->country_id!="") {
            $isExists = GenericM::getSingleRecord('tbl_master_area','id',array('area_name'=>$request->area_name,'city_id'=>$request->city_id,'state_id'=>$request->state_id,'country_id'=>$request->country_id,'isdelete'=>0));
            if (!empty($isExists)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function addArea(Request $request)
    {
        $data['country_id'] = $request->country_id;
        $data['state_id'] = $request->state_id;
        $data['city_id'] = $request->city_id;
        $data['area_name'] = $request->name;
        $data['isdelete'] = 0;
        $data['date'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $isInsert = GenericM::insertData('tbl_master_area',$data);
            if ($isInsert) {
                session()->flash('success-msg','Area inserted successfully.');
            }else
            {
                session()->flash('error-msg','Area not inserted.');
            }
        }else
        {
            session()->flash('error-msg','Area not inserted.');
        }

        return redirect('/area');
    }

    public function getEditArea(Request $request)
    {
        if ($request->id) {
            $row = GenericM::getSingleRecord('tbl_master_area','*',array('id'=>$request->id,'isdelete'=>0));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(FALSE);
            }
        }
    }

    public function checkEditAreaExists(Request $request)
    {
        if ($request->id!="" && $request->area_name!="") {
            $where = [
                ['id','<>',$request->id],
                ['country_id',$request->country_id],
                ['state_id',$request->state_id],
                ['city_id',$request->city_id],
                ['area_name',$request->area_name],
                ['isdelete',0],
            ];
            $isExists = GenericM::getSingleRecord('tbl_master_area','id',$where);
            if ($isExists) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateArea(Request $request)
    {
        $data['area_name'] = $request->edit_name;
        $data['date'] = date('Y-m-d H:i:s');
        $where = array('id'=>$request->hdarea_id);
        $isUpdate = GenericM::updateData('tbl_master_area',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Area updated successfully.');
        }else
        {
            session()->flash('error-msg','Area not updated.');
        }

        return redirect('/area');
    }

    public function deleteArea(Request $request)
    {
        $data['isdelete'] = 1;
        $where = array('id'=>$request->id);
        $isUpdate = GenericM::updateData('tbl_master_area',$where,$data);
        if ($isUpdate) {
            session()->flash('success-msg','Area deleted successfully.');
        }else
        {
            session()->flash('error-msg','Area not deleted.');
        }

        echo json_encode(TRUE);
    }
}
