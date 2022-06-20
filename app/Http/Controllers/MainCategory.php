<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainCategorym;

class MainCategory extends Controller
{
    //load all details of main category
    public function index()
    {
    	$where = array('isdelete' => 0);
    	$data['main_course'] = MainCategorym::fetch_all_data('tbl_main_course',$where);
    	return view('admin/categories/maincategory',$data);
    }

    //insert
    public function insert(Request $request)
    {
    	$attributes = $this->validmaincategory();
        if ($request->file('image')) {
            $path = $request->file('image')->store('main_course','public');
            if($path) {
            	$attributes['image'] = substr($path, strrpos($path, '/' )+1);
            }
        }
        $attributes['name'] = $request->name;
        $attributes['status'] = 1;
        $attributes['isdelete'] = 0;
        $attributes['date'] = date('Y-m-d H:i:s');
        // dd($attributes);
        $insertid = MainCategorym::insert('tbl_main_course',$attributes);
        if($insertid)
        {
            session()->flash('success-msg','Main course created successfully.');
        }else
        {
            session()->flash('error-msg','Main course Not Created');
        }
        return redirect('/maincourse');
    }

    //validation
    public function validmaincategory()
    {
    	return request()->validate([
            'name' => ['required'  ,'min:1' ,'max:100'],
            'image' => ['mimes:png,jpg,jpeg']
        ]);
    }

    //validation
    public function validmaincategory1()
    {
    	return request()->validate([
            'edit_name' => ['required'  ,'min:1' ,'max:100']
        ]);
    }

    //check add time
    public function check_maincategory_name(Request $request)
    {
    	$name = $request->name;
		$where = array('name' => $name,'isdelete' => 0);
		$result = MainCategorym::check_main('tbl_main_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //for edit fetch data 
    public static function fetch_maincategory_data(Request $request)
    {
    	$id = $request->id;
    	if ($id) {
    		$where = array('id' => $id,'isdelete' => 0);
    		$result = MainCategorym::fetch_single_data('tbl_main_course',$where);
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
    public function check_maincategory_name_edit(Request $request)
    {
    	$name = $request->edit_name;
    	$id = $request->id;
		$where = [
			['name',$name],
			['id','<>',$id],
			['isdelete',0]
		];
		$result = MainCategorym::check_main('tbl_main_course',$where);
		if ($result) {
			echo json_encode(false);
		} else {
			echo json_encode(true);
		}
    }

    //update
    public function update_maincategory(Request $request)
    {
    	$id = $request->main_category_id;
        if($id)
        {
        	$where = array('id' => $id);
            $attributes = $this->validmaincategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('main_course','public');
                $old_file = $request->old_file;
                // unlink('main_course/'.$old_file);
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['name'] = $request->edit_name;
        	$data['date'] = date('Y-m-d H:i:s');
            $isupdate = MainCategorym::update_data('tbl_main_course',$where,$data);
            if($isupdate)
            {
                flash("success-msg","Main course updated successfully.");
            }else
            {
                flash("error-msg","Main course not updated.");
            }
        }else
        {
            flash("error-msg","Main course not updated.");
        }

        return redirect('/maincourse');
    }

    //delete 
    public function delete_maincategory_data(Request $request)
    {
    	$id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = MainCategorym::update_data('tbl_main_course',$where,$data);
            if($res) {
            	// unlink('main_course/'.$request->image);
            	session()->flash('success-msg','Main course deleted Successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Main course not deleted.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Main course not deleted.');
            echo json_encode(false);
        }
    }

    //change status
    public function change_maincategory_status(Request $request)
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
            $res = MainCategorym::update_data('tbl_main_course',$where,$data);
            if($res) {
            	session()->flash('success-msg','Main course '.$msg.' successfully.');
                echo json_encode(true);
            } else {
            	session()->flash('error-msg','Main course not '.$msg.'.');
                echo json_encode(false);
            }
        } else {
        	session()->flash('error-msg','Main course not '.$msg.'.');
            echo json_encode(false);
        }
    }

    public function priorityInsert(Request $request)
    {
        if ($request->position!="" && $request->cat_id!="") {
            $data['position'] = $request->position;
            $where = array('id' => $request->cat_id);

            $res = MainCategorym::update_data('tbl_main_course',$where,$data);
            if($res) {
                session()->flash('success-msg','Position updated successfully.');
            } else {
                session()->flash('error-msg','Position not updated.');
            }
        }else
        {
                session()->flash('error-msg','Position not updated.');
        }

        return redirect('/maincourse');
    }

    public function checkPosition(Request $request)
    {
        $where = [
            ['position',$request->position],
            ['id','<>',$request->cat_id],
            ['isdelete',0]
        ];
        $result = MainCategorym::fetch_single_data('tbl_main_course',$where);
        if (!empty($result)) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }
}	
