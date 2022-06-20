<?php

namespace App\Http\Controllers;

use App\HomeSliderM;
use App\GenericM;
use Illuminate\Http\Request;

class HomeSlider extends Controller
{
    public function index()
    {
        $where = array('isdelete' => 0,'isverified' => 1);
        $where1 = array('tbl_home_slider.isdelete' => 0,'tbl_class_registration.isverified' => 1,'tbl_class_registration.isdelete' => 0);
        $data['city'] = HomeSliderM::fetch_city();
        $data['slider'] = HomeSliderM::fetch_data_join('tbl_home_slider',$where1);        
        return view('homeslider/homeslider',$data);
    }

    public function fetch_class(Request $request)
    {
        if($request->city_id != "") {
            $where = array('isdelete' => 0,'isverified' => 1,'city_id' => $request->city_id);
            $class = HomeSliderM::fetch_data('tbl_class_registration',$where);
            if(!$class->isEmpty()) {
                echo json_encode($class);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }

    //insert
    public function insert(Request $request)
    {
        $attributes = $this->validmaincategory();
        $path = $request->file('image')->store('home_slider_img','public');
        if($path) {
            $data['image'] = substr($path, strrpos($path, '/' )+1);
            $data['class_id'] = $request->name;
            $data['city_id'] = $request->city;
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d');
            // dd($data);
            $insertid = HomeSliderM::insert('tbl_home_slider',$data);
            if($insertid)
            {
                session()->flash('success-msg','Exclusive slider image added successfully.');
            }else
            {
                session()->flash('error-msg','Exclusive slider image Not added');
            }
        } else {
            session()->flash('error-msg','Exclusive slider image not added');
        }
        return redirect('/exclusive_slider');
    }

    //validation
    public function validmaincategory()
    {
        return request()->validate([
            'city' => ['required'],
            'name' => ['required'],
            'image' => ['required' ,'mimes:png,jpg,jpeg']
        ]);
    }

    //validation
    public function validmaincategory1()
    {
        return request()->validate([
            'edit_city' => ['required'],
            'edit_name' => ['required'],
            'edit_image' => ['mimes:png,jpg,jpeg']
        ]);
    }

    //delete 
    public function delete_home_slider_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = HomeSliderM::update_data('tbl_home_slider',$where,$data);
            if($res) {
                unlink('home_slider_img/'.$request->image);
                session()->flash('success-msg','Exclusive slider image deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Exclusive slider image not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Exclusive slider image not deleted.');
            echo json_encode(false);
        }
    }

    //check
    public function check_class_name(Request $request)
    {
        $id = $request->name;
        $city_id = $request->city;
        $where = array('tbl_home_slider.class_id' => $id,'tbl_home_slider.isdelete' => 0,'city_id' => $city_id);
        $res = HomeSliderM::fetch_data1('tbl_home_slider',$where);
        if($res) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    //check edit
    public function check_class_name_edit(Request $request)
    {
        $class_id = $request->edit_name;
        $edit_city = $request->edit_city;
        $id = $request->id;
        $where = [
            ['class_id',$class_id],
            ['city_id',$edit_city],
            ['id','<>',$id],
            ['isdelete',0]
        ];
        $res = HomeSliderM::fetch_data1('tbl_home_slider',$where);
        if($res) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    //update
    public function update(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $where = array('id' => $id);
            $attributes = $this->validmaincategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('home_slider_img','public');
                $old_file = $request->old_file;
                unlink('home_slider_img/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['class_id'] = $request->edit_name;
            $data['city_id'] = $request->edit_city;
            $data['date'] = date('Y-m-d');
            $isupdate = HomeSliderM::update_data('tbl_home_slider',$where,$data);
            if($isupdate)
            {
                session()->flash('success-msg','Exclusive slider image updated successfully.');
            }else
            {
                session()->flash('error-msg','Exclusive slider image not updated.');
            }
        }else
        {
            session()->flash('error-msg','Exclusive slider image not updated.');
        }

        return redirect('/exclusive_slider');
    }

    public function isViewSlider(Request $request)
    {
        if ($request->isview!="" && $request->tbl!="" && $request->id!="") {
            $data['isview'] = $request->isview ? 0 : 1;
            $isUpdate = GenericM::updateData($request->tbl,array('id'=>$request->id),$data);
            if ($isUpdate) {
                session()->flash('success-msg','Slider updated successfully.');
                echo json_encode(TRUE);
            }else
            {
                session()->flash('error-msg','Slider not updated.');
                echo json_encode(FALSE);
            }
        }
    }
}
