<?php

namespace App\Http\Controllers\Edifygo_class;

use App\Http\Controllers\Controller;
use App\CLLoginM;
use App\GenericM;
use Illuminate\Http\Request;
use App\Mail\ClientForgot;
use App\Mail\Allmail;

class Login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('edifygoclass/login');
    }

    public function checkLogin(Request $request)
    {
        $row = CLLoginM::checkLogin('tbl_class_registration',$request->username,sha1($request->password));
        if (!empty($row) && $row->password==sha1($request->password)) {
            if ($row->isverified==0) {
               session()->flash('error-msg','Account not verified.');
               return redirect('/class/login');
            }else
            {
                $request->session()->put('class_login_session_id', $row->id);
                $request->session()->put('class_login_session', $request->username);
                session()->flash('success-msg','Login successfully.');
                return redirect('/class/profile');
            }
        }else
        {
            session()->flash('error-msg','Invalid email/mobile or password.');
            return redirect('/class/login');
        }
    }

    public function forgotPasswd(Request $request)
    {
        return view('edifygoclass/forgot');
    }

    public function forgotPasswdStud(Request $request)
    {
        return view('student/forgot');
    }

    public function forgotLink(Request $request)
    {
        $email = $request->email;
        $user_type = $request->user_type;
        if ($email!="" && $user_type!="") {

            if ($user_type==0) {
                $tbl = 'tbl_class_registration';
            }else
            {
                $tbl = 'tbl_student_registration';
            }

            //check email if exists or not
            $row = GenericM::getSingleRecord($tbl,array('id'),array('email'=>$email,'isdelete'=>0,'isverified'=>1));
            if ($row) {

                //add link data
                $data['user_id'] = $row->id;
                $data['type'] = $user_type;
                $data['isused'] = 0;
                $data['date'] = date('Y-m-d H:i:s');
                $isinsert = GenericM::insertData('tbl_forgot_link',$data);
                if ($isinsert) {
                    //send mail
                    $d = ['id' => $isinsert,'user_type' => $user_type];
                    try {
                        $m = \Mail::to($email)->send(new ClientForgot($d));
                    } catch (\Exception $e) {
                        // dd($e);
                    }
                    
                    session()->flash('success-msg','Please check your email to change password.');
                }
            }else
            {
                session()->flash('error-msg','Invalid email.');
            }
        }else
        {
            session()->flash('error-msg','Invalid email.');
        }
        if ($user_type==0) {
            return redirect('/forgot');
        }else
        {
            return redirect('/stud/forgot');
        }
    }

    public function changePassword($id)
    {
        if ($id!="") {
            //check id if exists or not in tbl_forgot_link
            $row = GenericM::getSingleRecord('tbl_forgot_link',array('user_id','type'),array('id'=>$id,'isused'=>0,'type'=>0));
            if ($row) {
                $data['user_id'] = $row->user_id;
                $data['type'] = $row->type;
                return view('edifygoclass/changepasswd-forgot',$data);
            }else
            {
                session()->flash('error-msg','Invalid link,please try again.');
            }
        }else
        { 
            session()->flash('error-msg','Invalid link,please try again.');
        }
        if ($row->type==0) {
            return redirect('/forgot');
        }else
        {
            return redirect('/stud/forgot');
        }
    }

    public function changePasswordStudent($id)
    {
        if ($id!="") {
            //check id if exists or not in tbl_forgot_link
            $row = GenericM::getSingleRecord('tbl_forgot_link',array('user_id','type'),array('id'=>$id,'isused'=>0,'type'=>1));
            if ($row) {
                $data['user_id'] = $row->user_id;
                $data['type'] = $row->type;
                return view('edifygoclass/changepasswd-forgot',$data);
            }else
            {
                session()->flash('error-msg','Invalid link,please try again.');
            }
        }else
        { 
            session()->flash('error-msg','Invalid link,please try again.');
        }
        
        if ($row->type==0) {
            return redirect('/forgot');
        }else
        {
            return redirect('stud/forgot');
        }
    }

    public function updatePassword(Request $request)
    {
        if ($request->new_passwd!="" && $request->user_id!="" && $request->user_type!="") {
            //update data in registration
            if ($request->user_type==0) {
                $tbl = 'tbl_class_registration';
            }else
            {
                $tbl = 'tbl_student_registration';
            }
            $data['password'] = sha1($request->new_passwd);
            $isupdate = GenericM::updateData($tbl,array('id'=>$request->user_id),$data);
            if ($isupdate) {
                //update data in tbl_forgot_link
                $data1['isused'] = 1;
                $isupdate1 = GenericM::updateData('tbl_forgot_link',array('user_id'=>$request->user_id,'type'=>$request->user_type,'isused'=>0),$data1);
                if ($isupdate1) {

                    //send update password mail
                    $row = GenericM::getSingleRecord($tbl,array('firstname','lastname','email'),array('id'=>$request->user_id));

                    // dd($row);
                    if (!empty($row)) {
                        $all_type = ['type' => 5,'firstname'=>$row->firstname,'lastname'=>$row->lastname];
                        try {
                            \Mail::to($row->email)->send(new Allmail($all_type));
                        } catch (\Exception $e) {
                            
                        }
                    }

                    session()->flash('success-msg','Password updated successfully.');
                }else
                {
                    session()->flash('error-msg','Password not updated.');
                }
            }else
            {
                session()->flash('error-msg','Password not updated.');
            }
        }else
        {
            session()->flash('error-msg','Password not updated.');
        }
        if ($request->user_type==0) {
            return redirect('/class/login');
        }else
        {
            return redirect('/student/login');
        }
    }
}
