<?php

namespace App\Http\Controllers;

use App\PromoterSliderM;
use Illuminate\Http\Request;

class PromoterSlider extends Controller
{
    public function index()
    {
        $where = array('isdelete' => 0,'isverified' => 1);
        $where1 = array('tbl_promoter_slider.isdelete' => 0,'tbl_class_registration.isverified' => 1,'tbl_class_registration.isdelete' => 0);
        // $data['class'] = PromoterSliderM::fetch_data('tbl_class_registration',$where);
        $data['slider'] = PromoterSliderM::fetch_data_join('tbl_promoter_slider',$where1); 
        $data['city'] = PromoterSliderM::fetch_city();   
        // dd($data);    
        return view('homeslider/promoterslider',$data);
    }

    public function fetch_class(Request $request)
    {
        if($request->city_id != "") {
            $where = array('isdelete' => 0,'isverified' => 1,'city_id' => $request->city_id);
            $class = PromoterSliderM::fetch_data('tbl_class_registration',$where);
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
        $path = $request->file('image')->store('promoter_slider_img','public');
        if($path) {
            $data['image'] = substr($path, strrpos($path, '/' )+1);
            $data['class_id'] = $request->name;
            $data['city_id'] = $request->city;
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d');
            // dd($data);
            $insertid = PromoterSliderM::insert('tbl_promoter_slider',$data);
            if($insertid)
            {
                session()->flash('success-msg','Promoter slider image added successfully.');
            }else
            {
                session()->flash('error-msg','Promoter slider image Not added');
            }
        }
        return redirect('/promoter_slider');
    }

    //validation
    public function validmaincategory()
    {
        return request()->validate([
            'name' => ['required'],
            'city' => ['required']
        ]);
    }

    //validation
    public function validmaincategory1()
    {
        return request()->validate([
            'edit_name' => ['required'],
            'edit_city' => ['required']
        ]);
    }

    //delete 
    public function delete_promoter_slider_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = PromoterSliderM::update_data('tbl_promoter_slider',$where,$data);
            if($res) {
                if ($old_file) {
                    unlink('promoter_slider_img/'.$request->image);
                }
                session()->flash('success-msg','Promoter slider image deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Promoter slider image not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Promoter slider image not deleted.');
            echo json_encode(false);
        }
    }

    //check
    public function check_class_name(Request $request)
    {
        $id = $request->name;
        $city_id = $request->city_id;
        $where = array('class_id' => $id,'isdelete' => 0,'city_id' => $city_id);
        $res = PromoterSliderM::fetch_data1('tbl_promoter_slider',$where);
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
        $city_id = $request->edit_city;
        $id = $request->id;
        $where = [
            ['class_id',$class_id],
            ['id','<>',$id],
            ['city_id',$city_id],
            ['isdelete',0]
        ];
        $res = PromoterSliderM::fetch_data1('tbl_promoter_slider',$where);
        if($res) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    //update
    public function update(Request $request)
    {
        // dd($request);
        $id = $request->id;
        if($id)
        {
            $where = array('id' => $id);
            $attributes = $this->validmaincategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('promoter_slider_img','public');
                $old_file = $request->old_file;
                if ($old_file) {
                    unlink('promoter_slider_img/'.$old_file);
                }
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['city_id'] = $request->edit_city;
            $data['class_id'] = $request->edit_name;
            $data['date'] = date('Y-m-d');
            $isupdate = PromoterSliderM::update_data('tbl_promoter_slider',$where,$data);
            if($isupdate)
            {
                session()->flash('success-msg','Promoter slider image updated successfully.');
            }else
            {
                session()->flash('error-msg','Promoter slider image not updated.');
            }
        }else
        {
            session()->flash('error-msg','Promoter slider image not updated.');
        }

        return redirect('/promoter_slider');
    }
}
