<?php

namespace App\Http\Middleware;

use Closure;
use App\GenericM;
use App\EdifygoM;

class Exclusive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //check exclusive details and if total exclusive student added OR Expired than SET AS isExclusive=0
        $Exdata = GenericM::getDataForExclusiveCheck();
        // dd($Exdata);
        $today = date('Y-m-d');
        $data = array();
        foreach ($Exdata as $key => $value) {
            if (($value->total_ex_enroll >= $value->no_of_students) || ($today>$value->expiry_date)) {
                //update data isExclusive=0
                $data['isExclusive']=0;
                GenericM::updateData('tbl_class_course',array('id'=>$value->id),$data);
            }
        }

        $city_id = '';
        if(session('city_id') == '')
        {
            $request->session()->put('city_id', 1); 
            $city_id = 1;
        } else {
            $city_id = session('city_id');
        }
        
        $city = EdifygoM::fetch_city();
        $request->session()->forget('all_city_session');
        if (!$city->isEmpty()) {
            $request->session()->put('all_city_session', $city); 
        }
        return $next($request);
    }
}
