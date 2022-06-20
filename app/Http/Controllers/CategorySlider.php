<?php

namespace App\Http\Controllers;

use App\CategorySliderM;
use Illuminate\Http\Request;

class CategorySlider extends Controller
{
    public function index()
    {
        $where = array('isdelete' => 0);
        $data['slider'] = CategorySliderM::fetch_data('tbl_category_slider',$where);        
        return view('homeslider/categoryslider',$data);
    }

    //insert
    public function insert(Request $request)
    {
        $attributes = $this->validmaincategory();
        $path = $request->file('image')->store('category_slider_img','public');
        if($path) {
            $data['image'] = substr($path, strrpos($path, '/' )+1);
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d');
            // dd($data);
            $insertid = CategorySliderM::insert('tbl_category_slider',$data);
            if($insertid)
            {
                session()->flash('success-msg','Category slider image added successfully.');
            }else
            {
                session()->flash('error-msg','Category slider image Not added');
            }
        } else {
            session()->flash('error-msg','Category slider image not added');
        }
        return redirect('/category_slider');
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
                $path = $request->file('edit_image')->store('category_slider_img','public');
                $old_file = $request->old_file;
                // unlink('category_slider_img/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['date'] = date('Y-m-d');
            $isupdate = CategorySliderM::update_data('tbl_category_slider',$where,$data);
            if($isupdate)
            {
                session()->flash('success-msg','Category slider image updated successfully.');
            }else
            {
                session()->flash('error-msg','Category slider image not updated.');
            }
        }else
        {
            session()->flash('error-msg','Category slider image not updated.');
        }

        return redirect('/category_slider');
    }

    //validation
    public function validmaincategory()
    {
        return request()->validate([
            'image' => ['required' ,'mimes:png,jpg,jpeg']
        ]);
    }

    //validation
    public function validmaincategory1()
    {
        return request()->validate([
            'image' => ['mimes:png,jpg,jpeg']
        ]);
    }

    //delete 
    public function delete_category_slider_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = CategorySliderM::update_data('tbl_category_slider',$where,$data);
            if($res) {
                // unlink('category_slider_img/'.$request->image);
                session()->flash('success-msg','Category slider image deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Category slider image not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Category slider image not deleted.');
            echo json_encode(false);
        }
    }
}
