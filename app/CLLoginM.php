<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CLLoginM extends Model
{
    public static function checkLogin($tbl,$username,$password)
    {
    	return \DB::table($tbl)
    			->where(array('password'=>$password,'isdelete'=>0))
    			->where('email',$username)
    			->orWhere('mobile',$username)
    			->first();
    }
}
