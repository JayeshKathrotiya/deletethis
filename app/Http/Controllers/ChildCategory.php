<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChildCategorym;

class ChildCategory extends Controller
{
    //load all details of main category
    public function index()
    {
    	$where = array('isdelete' => 0);
        $where1 = array('tbl_child_course.isdelete' => 0);
        $data['main_course'] = ChildCategorym::fetch_all_data('tbl_main_course',$where);
    	$data['child_course'] = ChildCategorym::fetch_all_data_by_join('tbl_child_course',$where1);
    	return view('admin/categories/childcategory',$data);
    }

    //insert
    public function insert(Request $request)
    {
    	$attributes = $this->validchildcategory();
        if ($request->file('image')) {
            $path = $request->file('image')->store('child_course','public');
            if($path) {
            	$attributes['image'] = substr($path, strrpos($path, '/' )+1);
            }
        }
        $attributes['name'] = $request->name;
        $attributes['sub_course_id'] = $request->sub_id;
        $attributes['main_course_id'] = $request->main_id;
        $attributes['status'] = 1;
        $attributes['isdelete'] = 0;
        $attributes['date'] = date('Y-m-d H:i:s');
        // dd($attributes);
        $insertid = ChildCategorym::insert('tbl_child_course',$attributes);
        if($insertid)
        {
            session()->flash('success-msg','Child course created successfully.');
        }else
        {
            session()->flash('error-msg','Child course Not Created');
        }
        return redirect('/childcourse');
    }

    //validation
    public function validchildcategory()
    {
    	return request()->validate([
            'name' => ['required'  ,'min:1' ,'max:100'],
            'image' => ['mimes:png,jpg,jpeg']
        ]);
    }

    //validation
    public function validchildcategory1()
    {
    	return request()->validate([
            'edit_name' => ['required'  ,'min:1' ,'max:100']
        ]);
    }

    //check add time
    public function check_childcategory_name(Request $request)
    {
        $name = $request->name;
        $main_id = $request->main_id;
    	$sub_id = $request->sub_id;
		$where = array('name' => $name,'isdelete' => 0,'main_course_id' => $main_id,'sub_course_id' => $sub_id);
		$result = ChildCategorym::check_main('tbl_child_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //for edit fetch data 
    public static function fetch_childcategory_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id,'isdelete' => 0);
    		$result = ChildCategorym::fetch_single_data('tbl_child_course',$where);
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
    public function check_childcategory_name_edit(Request $request)
    {
    	$name = $request->edit_name;
    	$id = $request->id;
        $main_id = $request->main_id;
        $sub_id = $request->sub_id;
		$where = [
			['name',$name],
			['id','<>',$id],
			['isdelete',0],
            ['main_course_id',$main_id],
            ['sub_course_id',$sub_id]
		];
		$result = ChildCategorym::check_main('tbl_child_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //update
    public function update_childcategory(Request $request)
    {
    	$id = $request->child_category_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validchildcategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('child_course','public');
                $old_file = $request->old_file;
                // unlink('child_course/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['name'] = $request->edit_name;
        	$data['date'] = date('Y-m-d H:i:s');
            $isupdate = ChildCategorym::update_data('tbl_child_course',$where,$data);
            if($isupdate)
            {
                flash("success-msg","Child course updated successfully.");
            }else
            {
                flash("error-msg","Child course not updated.");
            }
        }else
        {
            flash("error-msg","Child course not updated.");
        }

        return redirect('/childcourse');
    }

    //delete 
    public function delete_childcategory_data(Request $request)
    {
    	$id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = ChildCategorym::update_data('tbl_child_course',$where,$data);
            if($res) {
            	// unlink('child_course/'.$request->image);
            	session()->flash('success-msg','Child course deleted Successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Child course not deleted.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Child course not deleted.');
            echo json_encode(false);
        }
    }

    //change status
    public function change_childcategory_status(Request $request)
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
            $res = ChildCategorym::update_data('tbl_child_course',$where,$data);
            if($res) {
            	session()->flash('success-msg','Child course '.$msg.' successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Child course not '.$msg.'.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Child course not '.$msg.'.');
            echo json_encode(false);
        }
    }


    //fetch sub 
    public function fetch_sub_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('main_course_id' => $id,'isdelete' => 0);
    		$result = ChildCategorym::fetch_all_data('tbl_sub_course',$where);
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
