<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubCategorym;

class SubCategory extends Controller
{
    //load all details of main category
    public function index()
    {
    	$where = array('isdelete' => 0);
        $where1 = array('tbl_sub_course.isdelete' => 0);
        $data['main_course'] = SubCategorym::fetch_all_data('tbl_main_course',$where);
    	$data['sub_course'] = SubCategorym::fetch_all_data_by_join('tbl_sub_course',$where1);
    	return view('admin/categories/subcategory',$data);
    }

    //insert
    public function insert(Request $request)
    {
    	$attributes = $this->validsubcategory();
        if ($request->file('image')) {
            $path = $request->file('image')->store('sub_course','public');
            if($path) {
            	$attributes['image'] = substr($path, strrpos($path, '/' )+1);
            }
        }
        $attributes['name'] = $request->name;
        $attributes['main_course_id'] = $request->main_id;
        $attributes['status'] = 1;
        $attributes['isdelete'] = 0;
        $attributes['date'] = date('Y-m-d H:i:s');
        // dd($attributes);
        $insertid = SubCategorym::insert('tbl_sub_course',$attributes);
        if($insertid)
        {
            session()->flash('success-msg','Sub course created successfully.');
        }else
        {
            session()->flash('error-msg','Sub course Not Created');
        }
        return redirect('/subcourse');
    }

    //validation
    public function validsubcategory()
    {
    	return request()->validate([
            'name' => ['required'  ,'min:1' ,'max:100'],
            'image' => ['mimes:png,jpg,jpeg']
        ]);
    }

    //validation
    public function validsubcategory1()
    {
    	return request()->validate([
            'edit_name' => ['required'  ,'min:1' ,'max:100']
        ]);
    }

    //check add time
    public function check_subcategory_name(Request $request)
    {
        $name = $request->name;
    	$main_id = $request->main_id;
		$where = array('name' => $name,'isdelete' => 0,'main_course_id' => $main_id);
		$result = SubCategorym::check_main('tbl_sub_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //for edit fetch data 
    public static function fetch_subcategory_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id,'isdelete' => 0);
    		$result = SubCategorym::fetch_single_data('tbl_sub_course',$where);
    		if (!empty($result)) {
    			echo json_encode($result);
    		} else {
    			echo json_encode(false);
    		}
    	}else {
    		echo json_encode(false);
    	}
    }

    //check edit time
    public function check_subcategory_name_edit(Request $request)
    {
        $name = $request->edit_name;
    	$main_id = $request->main_id;
    	$id = $request->id;
		$where = [
			['name',$name],
			['id','<>',$id],
			['isdelete',0],
            ['main_course_id',$main_id]
		];
		$result = SubCategorym::check_main('tbl_sub_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //update
    public function update_subcategory(Request $request)
    {
    	$id = $request->sub_category_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validsubcategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('sub_course','public');
                $old_file = $request->old_file;
                // unlink('sub_course/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['name'] = $request->edit_name;
        	$data['date'] = date('Y-m-d H:i:s');
            $isupdate = SubCategorym::update_data('tbl_sub_course',$where,$data);
            if($isupdate)
            {
                flash("success-msg","Sub course updated successfully.");
            }else
            {
                flash("error-msg","Sub course not updated.");
            }
        }else
        {
            flash("error-msg","Sub course not updated.");
        }

        return redirect('/subcourse');
    }

    //delete 
    public function delete_subcategory_data(Request $request)
    {
    	$id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = SubCategorym::update_data('tbl_sub_course',$where,$data);
            if($res) {
            	// unlink('sub_course/'.$request->image);
            	session()->flash('success-msg','Sub course deleted Successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Sub course not deleted.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Sub course not deleted.');
            echo json_encode(false);
        }
    }

    //change status
    public function change_subcategory_status(Request $request)
    {
    	$id = $request->id;
        if($id)
        {
        	$msg='';
		    if($request->status == 1) {
		      $msg = 'active';
		    } else {
		      $msg = 'deactive';
		    }

            $data['status'] = $request->status;
            $where = array('id' => $id);
            $res = SubCategorym::update_data('tbl_sub_course',$where,$data);
            if($res) {
            	session()->flash('success-msg','Sub course '.$msg.' successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Sub course not '.$msg.'.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Sub course not '.$msg.'.');
            echo json_encode(false);
        }
    }
}
