<?php

namespace App\Http\Controllers;

use App\TestimonialM;
use Illuminate\Http\Request;

class Testimonial extends Controller
{
        //load all details of main category
    public function index()
    {
        $where = array('isdelete' => 0);
        $data['testi'] = TestimonialM::fetch_all_data('tbl_testimonial',$where);
        return view('admin/testimonial/index',$data);
    }

    //insert
    public function insert(Request $request)
    {
        $attributes = $this->validmaincategory();
        if ($request->file('image')) {
            $path = $request->file('image')->store('testimonial','public');
            if($path) {
                $attributes['image'] = substr($path, strrpos($path, '/' )+1);
            }
        }
        $attributes['title'] = $request->title;
        $attributes['description'] = $request->description;
        $attributes['isactive'] = 1;
        $attributes['isdelete'] = 0;
        $attributes['date'] = date('Y-m-d H:i:s');
        // dd($attributes);
        $insertid = TestimonialM::insert('tbl_testimonial',$attributes);
        if($insertid)
        {
            session()->flash('success-msg','Testimonial inserted successfully.');
        }else
        {
            session()->flash('error-msg','Testimonial not inserted.');
        }
        return redirect('/testimonials');
    }

    //validation
    public function validmaincategory()
    {
        return request()->validate([
            'title' => ['required'  ,'min:1' ,'max:100'],
            'image' => ['required'  ,'mimes:png,jpg,jpeg'],
            'description' => ['required'  ,'min:1' ,'max:10000'],
        ]);
    }

    
    //update
    public function update(Request $request)
    {
        $id = $request->hd_testi;
        if($id)
        {
            $where = array('id' => $id);
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('testimonial','public');
                $old_file = $request->old_file;
                // unlink('main_course/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['title'] = $request->edit_title;
            $data['description'] = $request->edit_description;
            $data['date'] = date('Y-m-d H:i:s');
            $isupdate = TestimonialM::update_data('tbl_testimonial',$where,$data);
            if($isupdate)
            {
                flash("success-msg","Testimonial updated successfully.");
            }else
            {
                flash("error-msg","Testimonial not updated.");
            }
        }else
        {
            flash("error-msg","Testimonial not updated.");
        }

        return redirect('/testimonials');
    }

    //delete 
    public function isDelete(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = TestimonialM::update_data('tbl_testimonial',$where,$data);
            if($res) {
                // unlink('main_course/'.$request->image);
                session()->flash('success-msg','Testimonial deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Testimonial not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Testimonial not deleted.');
            echo json_encode(false);
        }
    }

    //change status
    public function isActive(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isactive'] = $request->status;
            $where = array('id' => $id);
            $res = TestimonialM::update_data('tbl_testimonial',$where,$data);
            if($res) {
                session()->flash('success-msg','Testimonial updated successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Testimonial not updated.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Testimonial not updated.');
            echo json_encode(false);
        }
    }

    public function editTesti(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $where = array('id' => $id,'isdelete' => 0);
            $result = TestimonialM::fetch_single_data('tbl_testimonial',$where);
            if (!empty($result)) {
                echo json_encode($result);
            } else {
                echo json_encode(false);
            }
        }else {
            echo json_encode(false);
        }
    }
}
