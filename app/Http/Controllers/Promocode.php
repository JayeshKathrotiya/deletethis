<?php

namespace App\Http\Controllers;

use App\PromocodeM;
use Illuminate\Http\Request;

class Promocode extends Controller
{
    public function index()
    {
        $where = array('isdelete' => 0);
        $data['slider'] = PromocodeM::fetch_data('tbl_promocode_slider',$where);        
        return view('homeslider/promocodeslider',$data);
    }

    //insert
    public function insert(Request $request)
    {
        $attributes = $this->validmaincategory();
        $path = $request->file('image')->store('promocode_slider_img','public');
        if($path) {
            $data['image'] = substr($path, strrpos($path, '/' )+1);
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d');
            // dd($data);
            $insertid = PromocodeM::insert('tbl_promocode_slider',$data);
            if($insertid)
            {
                session()->flash('success-msg','Promocode slider image added successfully.');
            }else
            {
                session()->flash('error-msg','Promocode slider image Not added');
            }
        } else {
            session()->flash('error-msg','Promocode slider image not added');
        }
        return redirect('/promocode');
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
                $path = $request->file('edit_image')->store('promocode_slider_img','public');
                $old_file = $request->old_file;
                // unlink('promocode_slider_img/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['date'] = date('Y-m-d');
            $isupdate = PromocodeM::update_data('tbl_promocode_slider',$where,$data);
            if($isupdate)
            {
                session()->flash('success-msg','Promocode slider image updated successfully.');
            }else
            {
                session()->flash('error-msg','Promocode slider image not updated.');
            }
        }else
        {
            session()->flash('error-msg','Promocode slider image not updated.');
        }

        return redirect('/promocode');
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
    public function delete_promocode_slider_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = PromocodeM::update_data('tbl_promocode_slider',$where,$data);
            if($res) {
                // unlink('promocode_slider_img/'.$request->image);
                session()->flash('success-msg','Promocode slider image deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Promocode slider image not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Promocode slider image not deleted.');
            echo json_encode(false);
        }
    }
}
