<?php

namespace App\Http\Controllers\Edifygo_class;

use App\FaqM;
use App\ClassM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Faq extends Controller
{
    public function index()
    {
        $data['class'] = ClassM::getClassData();
        $data['faq'] = FaqM::getfaqData();
        return view('edifygoclass/faq',$data);
    }

    public function addfaq(Request $request)
    {
        $data['class_id'] = $request->class_id;
        $data['question'] = $request->qus;
        $data['answer'] = $request->ans;
        $data['isdelete'] = 0;
        $data['created_datetime'] = date('Y-m-d H:i:s');
        $result = FaqM::insert($data);
        if($result == 1) {
            session()->flash('success-msg','FAQ inserted successfully.');
        } else {
            session()->flash('error-msg','FAQ not inserted');
        }
        return redirect('/faq');
    }

    public function editfaq(Request $request)
    {
        $where = array('id' => $request->faq_id);
        $data['question'] = $request->edit_qus;
        $data['answer'] = $request->edit_ans;
        $result = FaqM::update_data('tbl_faq',$where,$data);
        if($result == 1) {
            session()->flash('success-msg','FAQ updated successfully.');
        } else {
            session()->flash('error-msg','FAQ not updated');
        }
        return redirect('/faq');
    }

    //delete faq
    public function deletefaq(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $data['isdelete'] = 1;
            $where = array('id' => $id);
            $res = FaqM::update_data('tbl_faq',$where,$data);
            if($res) {
                session()->flash('success-msg','FAQ deleted Successfully.');
                echo json_encode(true);
            } else {
                session()->flash('error-msg','FAQ not deleted.');
                echo json_encode(false);
            }
        } else {
            session()->flash('error-msg','FAQ not deleted.');
            echo json_encode(false);
        }
    }

    //fetch faq data
    public function fetch_faq_data(Request $request)
    {
        $id = $request->id;
        if($id)
        {
            $where = array('id' => $id,'isdelete' => 0);
            $data = FaqM::fetch_faq_data('tbl_faq',$where);
            if($data) {
                echo json_encode($data);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }
}
