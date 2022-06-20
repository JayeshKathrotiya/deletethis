<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryMasterm;

class CountryMaster extends Controller
{
    //load the all country list
    public function index()
    {
    	$where = array('isdelete' => 0);
    	$country = CountryMasterm::fetch_all_country('tbl_master_country',$where);
    	return view('admin/locations/mastercountry',compact('country'));
    }

    //fetch data for edit
    public function fetch_country_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id);
    		$result = CountryMasterm::fetch_country_data('tbl_master_country',$where);
    		if (!empty($result)) {
    			echo json_encode($result);
    		} else {
    			echo json_encode(false);
    		}
    	}else {
    		echo json_encode(false);
    	}
    }

    //add country 
    public function store(Request $request)
    {
    	$attributes = $this->validatePtype();
        $data['country_name'] = $request->name;
        $data['isdelete'] = 0;
        $data['created_datetime'] = date('Y-m-d H:i:s');
        $data['updated_datetime'] = date('Y-m-d H:i:s');
        $insertid = CountryMasterm::add_country('tbl_master_country',$data);
        if($insertid) {
            session()->flash('success-msg','Country added successfully.');
        } else {
            session()->flash('error-msg','Country not added.');
        }
        return redirect('/country');
    }

    //edit country
    public function update_country(Request $request)
    {
    	$id = $request->country_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validatePtype1();
            $data['country_name'] = $request->edit_name;
        	$data['updated_datetime'] = date('Y-m-d H:i:s');
            $isupdate = CountryMasterm::update_country('tbl_master_country',$where,$data);
            if($isupdate)
            {
                flash("success-msg","Country updated successfully.");
            }else
            {
                flash("error-msg","Country not updated.");
            }
        }else
        {
            flash("error-msg","Country not updated.");
        }

        return redirect('/country');
    }

    //delete 
    public function delete_country_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$data['isdelete'] = 1;
    		$where = array('id' => $id);
    		$result = CountryMasterm::delete_country_data('tbl_master_country',$where,$data);
    		if ($result) {
    			session()->flash('success-msg','Country deleted successfully.');
    			echo json_encode(true);
    		} else {
    			session()->flash('error-msg','Country not deleted.');
    			echo json_encode(false);
    		}
    	} else {
    		session()->flash('error-msg','Country not deleted.');
    		echo json_encode(false);
    	}
    }

    public function validatePtype()
    {
        return request()->validate([
            'name' => ['required','min:1']
        ]);
    }

    public function validatePtype1()
    {
        return request()->validate([
            'edit_name' => ['required','min:1']
        ]);
    }

    //check country name exits
    public function check_country_name(Request $request)
    {
    	$country_name = $request->country_name;
		$where = array('country_name' => $country_name,'isdelete' => 0);
		$result = CountryMasterm::check_country_name('tbl_master_country',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //check country name exits edit time
    public function check_country_name_edit(Request $request)
    {
    	$country_name = $request->country_name;
    	$id = $request->id;
		$where = [
			['country_name',$country_name],
			['id','<>',$id],
			['isdelete',0]
		];
		$result = CountryMasterm::check_country_name('tbl_master_country',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }
}
