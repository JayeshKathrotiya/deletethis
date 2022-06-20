<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GenericM;

class Login extends Validation
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->session()->exists('admin_login_session'));
        if($request->session()->exists('admin_login_session')) {
            return redirect('dashboard');
        }
        return view('admin/login');
    }
    
    public function login(Request $request)
    {
        $attributes = $this->validLogin();
        $select = array('id','isactive');
        $where = array('email'=>$attributes['email'],'password'=>sha1($attributes['password']),'isdelete'=>0);
        $user = GenericM::getSingleRecord('tbl_admin',$select,$where);
        if (!empty($user)) {
            if($user->isactive==0)
            {
                session()->flash('error-msg','Account is not active.');
            }else
            {
                $request->session()->put('admin_login_session', $attributes['email']);
                if ($request->session()->exists('admin_login_session')) {
                    session()->flash('success-msg','Login successfully.');
                    return redirect('/dashboard');
                }else
                {
                    session()->flash('error-msg','Invalid email or password.');
                }
            }
        }else
        {
            session()->flash('error-msg','Invalid email or password.');
        }
        return redirect('/admin');
    }

    //logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');
    }

}
