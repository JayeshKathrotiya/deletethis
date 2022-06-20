<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmissionM extends Model
{
   	public static function getAllData($tbl,$where)
    {
    	return \DB::table($tbl)
    				->where($where)
                    ->orderby('amount')
    				->get();
    }
}
