<?php

namespace App\Http\Controllers;

use App\SponsoredSliderM;
use Illuminate\Http\Request;

class SponsoredSlider extends Controller
{
    public function index()
    {
        $where = array('isdelete' => 0,'isverified' => 1);
        // $where1 = array('tbl_sponsored_slider.isdelete' => 0,'tbl_class_registration.isverified' => 1,'tbl_class_registration.isdelete' => 0);
        // $data['class'] = SponsoredSliderM::fetch_data('tbl_class_registration',$where);
        $data['slider'] = SponsoredSliderM::fetch_data_join('tbl_sponsored_slider'); 
        $data['city'] = SponsoredSliderM::fetch_city();  
        // dd($data);     
        return view('homeslider/sponsored',$data);
    }

    public function fetch_class(Request $request)
    {
        if($request->city_id != "") {
            $where = array('isdelete' => 0,'isverified' => 1,'city_id' => $request->city_id);
            $class = SponsoredSliderM::fetch_data('tbl_class_registration',$where);
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
        // dd($request);
        $attributes = $this->validmaincategory();
        $path = $request->file('image')->store('sponsored_slider_img','public');
        if($path) {
            $data['image'] = substr($path, strrpos($path, '/' )+1);
            $data['class_id'] = $request->name;
            $data['city_id'] = $request->city;
            $data['main_course_id'] = $request->maincourse;
            $data['sub_course_id'] = $request->subcourse;
            $data['class_course_id'] = $request->clss_course_id;
            if($request->childcourse != "") {    
                $data['child_course_id'] = $request->childcourse;
            }
            $data['isdelete'] = 0;
            $data['date'] = date('Y-m-d');
            // dd($data);
            $insertid = SponsoredSliderM::insert('tbl_sponsored_slider',$data);
            if($insertid)
            {
                session()->flash('success-msg','Sponsored slider image added successfully.');
            }else
            {
                session()->flash('error-msg','Sponsored slider image Not added');
            }
        }
        return redirect('/sponsored_slider');
    }

    //validation
    public function validmaincategory()
    {
        return request()->validate([
            'name' => ['required'],
            'maincourse' => ['required'],
            'subcourse' => ['required'],
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
    public function delete_sponsored_slider_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = SponsoredSliderM::update_data('tbl_sponsored_slider',$where,$data);
            if($res) {
                // unlink('home_slider_img/'.$request->image);
                session()->flash('success-msg','Sponsored slider image deleted successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Sponsored slider image not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Sponsored slider image not deleted.');
            echo json_encode(false);
        }
    }

    //check
    public function check_class_name(Request $request)
    {
        $id = $request->name;
        $maincourse = $request->maincourse;
        $subcourse = $request->subcourse;
        $city_id = $request->city_id;
        // if($request->childcourse) {
            $childcourse = $request->childcourse;
            $where = array('class_id' => $id,'main_course_id' => $maincourse,'sub_course_id' => $subcourse,'child_course_id' => $childcourse,'isdelete' => 0,'city_id' => $city_id);
        // } else {
        //     $where = array('class_id' => $id,'main_course_id' => $maincourse,'sub_course_id' => $subcourse,'isdelete' => 0);
        // }
        $res = SponsoredSliderM::fetch_data1('tbl_sponsored_slider',$where);
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
        $res = SponsoredSliderM::fetch_data1('tbl_sponsored_slider',$where);
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
        // dd($id);
            $where = array('id' => $id);
            // $attributes = $this->validmaincategory1();
            if($request->edit_image)
            {
                $path = $request->file('edit_image')->store('sponsored_slider_img','public');
                $old_file = $request->old_file;
                if ($old_file) {
                    unlink('sponsored_slider_img/'.$old_file);
                }
                $data['image'] = substr($path, strrpos($path, '/' )+1);
            }
            $data['date'] = date('Y-m-d');
            $isupdate = SponsoredSliderM::update_data('tbl_sponsored_slider',$where,$data);
            if($isupdate)
            {
                session()->flash('success-msg','Sponsored slider image updated successfully.');
            }else
            {
                session()->flash('error-msg','Sponsored slider image not updated.');
            }
        }else
        {
            session()->flash('error-msg','Sponsored slider image not updated.');
        }

        return redirect('/sponsored_slider');
    }

    //fetch main course
    public function fetch_main_course(Request $request)
    {
        $class_id = $request->class_id;
        if($class_id) {
            $res = SponsoredSliderM::fetch_main_course($class_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                echo json_encode(false);
            }
        }  else {
            echo json_encode(false);
        }
    }

    //fetch main course
    public function fetch_sub_course(Request $request)
    {
        $class_id = $request->class_id;
        $main_course_id = $request->main_course_id;
        if($class_id) {
            $res = SponsoredSliderM::fetch_sub_course($class_id,$main_course_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                echo json_encode(false);
            }
        }  else {
            echo json_encode(false);
        }
    }

    //fetch sub course
    public function fetch_child_course(Request $request)
    {
        $class_id = $request->class_id;
        $main_course_id = $request->main_course_id;
        $sub_course_id = $request->sub_course_id;
        if($class_id) {
            $res = SponsoredSliderM::fetch_child_course($class_id,$main_course_id,$sub_course_id);
            if(!$res->isEmpty()) {
                echo json_encode($res);
            } else {
                $id = SponsoredSliderM::fetch_single_course_id($class_id,$main_course_id,$sub_course_id);
                echo json_encode($id->id);
            }
        }  else {
            echo json_encode(false);
        }
    }

    //fetch sub course
    public function fetch_course_id(Request $request)
    {
        $class_id = $request->class_id;
        $main_course_id = $request->main_course_id;
        $sub_course_id = $request->sub_course_id;
        $child_course_id = $request->child_course_id;
        if($class_id) {
            $id = SponsoredSliderM::fetch_single_course_id1($class_id,$main_course_id,$sub_course_id,$child_course_id);
            if($id) {
                echo json_encode($id->id);
            } else {                
                echo json_encode(false);
            }
        }  else {
            echo json_encode(false);
        }
    }

    public function change_sponsored_status(Request $request)
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

            $data['isactive'] = $request->status;
            $where = array('id' => $id);
            $res = SponsoredSliderM::update_data('tbl_sponsored_slider',$where,$data);
            if($res) {
                session()->flash('success-msg','Sponsored image '.$msg.' successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','Sponsored image not '.$msg.'.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','Sponsored image not '.$msg.'.');
            echo json_encode(false);
        }
    }
}
