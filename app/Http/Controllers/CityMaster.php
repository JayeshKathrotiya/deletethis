<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CityMasterm;

class CityMaster extends Controller
{
    //load the all city list
    public function index()
    {
    	$data['city'] = CityMasterm::fetch_all_city();
    	$data['country'] = CityMasterm::fetch_all_country('tbl_master_country');
    	return view('admin/locations/mastercity',$data);
    }

    //fetch state based on country
    public function fetch_state_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('country_id' => $id,'isdelete' => 0);
    		$result = CityMasterm::fetch_state_data('tbl_master_state',$where);
    		if (!empty($result)) {
    			echo json_encode($result);
    		} else {
    			echo json_encode(false);
    		}
    	}else {
    		echo json_encode(false);
    	}
    }

    //fetch data for edit
    public function fetch_city_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id);
    		$result = CityMasterm::fetch_city_data('tbl_master_city',$where);
    		if (!empty($result)) {
    			echo json_encode($result);
    		} else {
    			echo json_encode(false);
    		}
    	}else {
    		echo json_encode(false);
    	}
    }

    //active-deactive 
    public function cityChange(Request $request)
    {
        $id = $request->id;
        if ($id!="") {
            $data['isactive'] = $request->status ? 0 : 1;
            $where = array('id' => $id);
            $result = CityMasterm::delete_city_data('tbl_master_city',$where,$data);
            if ($result) {
                session()->flash('success-msg','City updated successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','City not updated.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','City not updated.');
            echo json_encode(false);
        }
    }

    //add city 
    public function store(Request $request)
    {
    	$attributes = $this->validatePtype();
        $data['city_name'] = $request->name;
        $data['postalcode'] = $request->postalcode;
        $data['country_id'] = $request->country_id;
        $data['state_id'] = $request->state_id;
        $data['isactive'] = 1;
        $data['isdelete'] = 0;
        $data['created_datetime'] = date('Y-m-d H:i:s');
        $data['updated_datetime'] = date('Y-m-d H:i:s');
        $insertid = CityMasterm::add_city('tbl_master_city',$data);
        if($insertid) {
            session()->flash('success-msg','City added successfully.');
        } else {
            session()->flash('error-msg','City not added.');
        }
        return redirect('/city');
    }

    //edit city
    public function update_city(Request $request)
    {
    	$id = $request->city_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validatePtype1();
            $data['city_name'] = $request->edit_name;
            $data['postalcode'] = $request->editpostalcode;
        	$data['updated_datetime'] = date('Y-m-d H:i:s');
            $isupdate = CityMasterm::update_city('tbl_master_city',$where,$data);
            if($isupdate)
            {
                flash("success-msg","City updated successfully.");
            }else
            {
                flash("error-msg","City not updated.");
            }
        }else
        {
            flash("error-msg","City not updated.");
        }

        return redirect('/city');
    }

    //delete 
    public function delete_city_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$data['isdelete'] = 1;
    		$where = array('id' => $id);
    		$result = CityMasterm::delete_city_data('tbl_master_city',$where,$data);
    		if ($result) {
    			session()->flash('success-msg','City deleted successfully.');
    			echo json_encode(true);
    		} else {
    			session()->flash('error-msg','City not deleted.');
    			echo json_encode(false);
    		}
    	} else {
    		session()->flash('error-msg','City not deleted.');
    		echo json_encode(false);
    	}
    }

    public function validatePtype()
    {
        return request()->validate([
            'name' => ['required','min:1'],
            'country_id' => ['required'],
            'state_id' => ['required']
        ]);
    }

    public function validatePtype1()
    {
        return request()->validate([
            'edit_name' => ['required','min:1']
        ]);
    }

    //check city name exits
    public function check_city_name(Request $request)
    {
    	$city_name = $request->city_name;
    	$country_id = $request->country_id;
    	$state_id = $request->state_id;
		$where = array('city_name' => $city_name,'isdelete' => 0,'country_id' => $country_id,'state_id' => $state_id);
		$result = CityMasterm::check_city_name('tbl_master_city',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //check city name exits edit time
    public function check_city_name_edit(Request $request)
    {
    	$city_name = $request->city_name;
    	$id = $request->id;
    	$country_id = $request->country_id;
    	$state_id = $request->state_id;
		$where = [
			['city_name',$city_name],
			['id','<>',$id],
			['isdelete',0],
			['country_id',$country_id],
			['state_id',$state_id]
		];
		$result = CityMasterm::check_city_name('tbl_master_city',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //check postal exits
    public function checkPostalcode(Request $request)
    {
        $postalcode = $request->postalcode;
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $where = array('postalcode' => $postalcode,'isdelete' => 0,'country_id' => $country_id,'state_id' => $state_id);
        $result = CityMasterm::check_city_name('tbl_master_city',$where);
        if ($result) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function checkPosatalcodeEdit(Request $request)
    {
        $postalcode = $request->editpostalcode;
        $id = $request->id;
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $where = [
            ['postalcode',$postalcode],
            ['id','<>',$id],
            ['isdelete',0],
            ['country_id',$country_id],
            ['state_id',$state_id]
        ];
        $result = CityMasterm::check_city_name('tbl_master_city',$where);
        if ($result) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}
