<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StateMasterm;

class StateMaster extends Controller
{
    //load the all state list
    public function index()
    {
    	// $where = array('tbl_master_state.isdelete' => 0,'tbl_master_country.isdelete' => 0);
    	$data['state'] = StateMasterm::fetch_all_state();
    	$data['country'] = StateMasterm::fetch_all_country('tbl_master_country');
    	return view('admin/locations/masterstate',$data);
    }

    //fetch data for edit
    public function fetch_state_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id);
    		$result = StateMasterm::fetch_state_data('tbl_master_state',$where);
    		if (!empty($result)) {
    			echo json_encode($result);
    		} else {
    			echo json_encode(false);
    		}
    	}else {
    		echo json_encode(false);
    	}
    }

    //add state 
    public function store(Request $request)
    {
    	$attributes = $this->validatePtype();
        $data['state_name'] = $request->name;
        $data['country_id'] = $request->country_id;
        $data['isdelete'] = 0;
        $data['created_datetime'] = date('Y-m-d H:i:s');
        $data['updated_datetime'] = date('Y-m-d H:i:s');
        $insertid = StateMasterm::add_state('tbl_master_state',$data);
        if($insertid) {
            session()->flash('success-msg','State added successfully.');
        } else {
            session()->flash('error-msg','State not added.');
        }
        return redirect('/state');
    }

    //edit state
    public function update_state(Request $request)
    {
    	$id = $request->state_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validatePtype1();
            $data['state_name'] = $request->edit_name;
        	$data['updated_datetime'] = date('Y-m-d H:i:s');
            $isupdate = StateMasterm::update_state('tbl_master_state',$where,$data);
            if($isupdate)
            {
                flash("success-msg","State updated successfully.");
            }else
            {
                flash("error-msg","State not updated.");
            }
        }else
        {
            flash("error-msg","State not updated.");
        }

        return redirect('/state');
    }

    //delete 
    public function delete_state_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$data['isdelete'] = 1;
    		$where = array('id' => $id);
    		$result = StateMasterm::delete_state_data('tbl_master_state',$where,$data);
    		if ($result) {
    			session()->flash('success-msg','State deleted successfully.');
    			echo json_encode(true);
    		} else {
    			session()->flash('error-msg','State not deleted.');
    			echo json_encode(false);
    		}
    	} else {
    		session()->flash('error-msg','State not deleted');
    		echo json_encode(false);
    	}
    }

    public function validatePtype()
    {
        return request()->validate([
            'name' => ['required','min:1'],
            'country_id' => ['required']
        ]);
    }

    public function validatePtype1()
    {
        return request()->validate([
            'edit_name' => ['required','min:1']
        ]);
    }

    //check state name exits
    public function check_state_name(Request $request)
    {
    	$state_name = $request->state_name;
    	$country_id = $request->country_id;
		$where = array('state_name' => $state_name,'isdelete' => 0,'country_id' => $country_id);
		$result = StateMasterm::check_state_name('tbl_master_state',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //check state name exits edit time
    public function check_state_name_edit(Request $request)
    {
    	$state_name = $request->state_name;
    	$id = $request->id;
    	$country_id = $request->country_id;
		$where = [
			['state_name',$state_name],
			['id','<>',$id],
			['isdelete',0],
			['country_id',$country_id]
		];
		$result = StateMasterm::check_state_name('tbl_master_state',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }
}
