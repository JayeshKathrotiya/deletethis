<?php

namespace App\Http\Controllers;

use App\ClassesM;
use App\GenericM;
use App\ClassM;
use Illuminate\Http\Request;

class Classes extends Controller
{
    public function index()
    {
        $data['classes'] = ClassesM::fetch_all_data_join();
        $data['gst'] = GenericM::getSingleRecord('tbl_setting_value','GST_per',array());

        return view('admin/classes/index',$data);
    }

    public function isApproveClass(Request $request)
    {
    	if ($request->id!="") {
	        $data['isapprove'] = $request->status;
	        $where = array('id' => $request->id);
	        $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
	        if ($isUpdate) {
	            session()->flash('success-msg','Class updated successfully.');
	        }else
	        {
	            session()->flash('error-msg','Class not updated.');
	        }
    	}

        echo json_encode(TRUE);
    }

    public function isPopular(Request $request)
    {
        if ($request->id!="") {
            $data['ispopular'] = $request->status==1 ? 0 : 1;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Class updated successfully.');
            }else
            {
                session()->flash('error-msg','Class not updated.');
            }
        }

        echo json_encode(TRUE);
    }

    public function deleteClass(Request $request)
    {
        if ($request->id!="") {
            $data['isdelete'] = 1;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Class deleted successfully.');
            }else
            {
                session()->flash('error-msg','Class not deleted.');
            }
        }

        echo json_encode(TRUE);
    }

    public function getEditClass(Request $request)
    {
        if ($request->id!="") {
            $row = GenericM::getSingleRecord('tbl_class_registration',array('mobile','email'),array('id'=>$request->id));
            echo json_encode($row);
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function checkEditMobileExists(Request $request)
    {
        if ($request->class_id!="" && $request->mobile!="") {
            $where = [
                ['id','<>',$request->class_id],
                ['mobile',$request->mobile],
                ['isdelete',0],
                ['isverified',1]
            ];
            $row = GenericM::getSingleRecord('tbl_class_registration',array('id'),$where);
            if (!empty($row)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function updateAdminclass(Request $request)
    {
        if ($request->hdclass_id!="") {
            $data['mobile'] = $request->editmobile;
            $data['email'] = $request->editemail;
            $where = array('id' => $request->hdclass_id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Class updated successfully.');
            }else
            {
                session()->flash('error-msg','Class not updated.');
            }
        }
        return redirect('/classes');
    }

    public function checkEditEmailExists(Request $request)
    {
        if ($request->class_id!="" && $request->email!="") {
            $where = [
                ['id','<>',$request->class_id],
                ['email',$request->email],
                ['isdelete',0],
                ['isverified',1]
            ];
            $row = GenericM::getSingleRecord('tbl_class_registration',array('id'),$where);
            if (!empty($row)) {
                echo json_encode(FALSE);
            }else
            {
                echo json_encode(TRUE);
            }
        }
    }

    public function deletePdf(Request $request)
    {
        if ($request->id!="") {
            $data['isdelete'] = 1;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_pdf',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Pdf deleted successfully.');
            }else
            {
                session()->flash('error-msg','Pdf not updated.');
            }
        }

        echo json_encode(TRUE);
    }

    public function deleteTube(Request $request)
    {
        if ($request->id!="") {
            $data['isdelete'] = 1;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_youtube_links',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','You tube link deleted successfully.');
            }else
            {
                session()->flash('error-msg','You tube link not updated.');
            }
        }

        echo json_encode(TRUE);
    }

    public function isSubscribe(Request $request)
    {
        if ($request->id!="") {
            $subscription = ClassM::getSubscriptionData();
            $data['issubscribe'] = 1;
            $data['subscription_method'] = 0;
            $data['subscription_price'] = $subscription->subscription_charge;
            $data['subscription_date'] = date('Y-m-d H:i:s');
            $data['subscription_expire'] = date('Y-m-d H:i:s', strtotime('+1 years'));

            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Class updated successfully.');
            }else
            {
                session()->flash('error-msg','Class not updated.');
            }
        }

        echo json_encode(TRUE);
    }

    public function viewClass(Request $request)
    {
    	$class_id = \Request::segment(2);
    	if ($class_id) {
    		$data['class'] = ClassesM::getClassData($class_id);
    		//get all cources also
        	return view('admin/classes/view_class',$data);
    	}else
    	{
    		return redirect('/classes');
    	}

    }

    public function EditClass(Request $request)
    {
        $class_id = \Request::segment(2);
        if ($class_id) {
            $data['class'] = ClassesM::getClassData($class_id);
            // dd($data);
            //get all cources also
            return view('admin/classes/edit_class',$data);
        }else
        {
            return redirect('/classes');
        }
    }

    public function getFeesDetails(Request $request)
    {
        if ($request->fees_id) {
            $row = GenericM::getSingleRecord('tbl_fee_structure',array('*'),array('id'=>$request->fees_id,'isdelete'=>0));
            if (!empty($row)) {
                echo json_encode($row);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function addClassFees(Request $request)
    {
        if ($request->class_id) {
            $data['class_id'] = $request->class_id;
            $data['fee'] = $request->fee;
            $data['owner_charge_per'] = $request->owner_charge_per;
            $data['owner_charge_amount'] = $request->owner_charge_amount;
            $data['date'] = date('Y-m-d H:i:s');
            $data['isdelete'] = 0;

            $isInsert = GenericM::insertData('tbl_class_fee_structure',$data);
            if ($isInsert) {
                echo json_encode(TRUE);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function getClassFees(Request $request)
    {
        if ($request->id) {
            $data['class_fees'] = GenericM::getAllData('tbl_class_fee_structure',array('isdelete'=>0,'class_id'=>$request->id));
            $whereNotIn = array();
            if (!empty($data['class_fees'])) {
                foreach ($data['class_fees'] as $key => $value) {
                    array_push($whereNotIn, $value->fee);
                }
            }
            $data['public_fees'] = ClassesM::getAllFees('tbl_fee_structure',array('isdelete'=>0),$whereNotIn);
            if (!empty($data)) {
                echo json_encode($data);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function deleteClassFees(Request $request)
    {
        if ($request->id!="") {
            $data['isdelete'] = 1;
            $where = array('id' => $request->id);
            $isUpdate = GenericM::updateData('tbl_class_fee_structure',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Fees deleted successfully.');
            }else
            {
                session()->flash('error-msg','Fees not deleted.');
            }
        }

        echo json_encode(TRUE);
    }

    public function editClassFees(Request $request)
    {
        if ($request->id) {
            $data['class_fees'] = GenericM::getSingleRecord('tbl_class_fee_structure',array('id','fee','owner_charge_per'),array('isdelete'=>0,'id'=>$request->id));
            $whereIn = array();
            if (!empty($data['class_fees'])) {
                array_push($whereIn, $data['class_fees']->fee);
            }
            $data['public_fees'] = ClassesM::getOneFees('tbl_fee_structure',array('isdelete'=>0),$whereIn);
            if (!empty($data)) {
                echo json_encode($data);
            }else
            {
                echo json_encode(FALSE);
            }
        }else
        {
            echo json_encode(FALSE);
        }
    }

    public function updateClassFees(Request $request)
    {
        if ($request->class_fees_id!="") {
            $data['owner_charge_per'] = $request->class_owner_charge;
            $where = array('id' => $request->class_fees_id);
            $isUpdate = GenericM::updateData('tbl_class_fee_structure',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','Fees updated successfully.');
            }else
            {
                session()->flash('error-msg','Fees not updated.');
            }
        }

        echo json_encode(TRUE);
    }
}
