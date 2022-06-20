<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaMasterm extends Model
{
    public static function getAllArea()
    {
        return \DB::table('tbl_master_area as tma')
                ->select('tma.*','tmc.city_name','tms.state_name','tm_country.country_name')
                ->join('tbl_master_city as tmc','tmc.id','=','tma.city_id')
                ->join('tbl_master_state as tms','tms.id','=','tma.state_id')
                ->join('tbl_master_country as tm_country','tm_country.id','=','tma.country_id')
                ->where(array('tma.isdelete'=>0,'tmc.isdelete'=>0,'tms.isdelete'=>0,'tm_country.isdelete'=>0))
                ->orderby('tma.id','desc')
                ->get();
    }
}
