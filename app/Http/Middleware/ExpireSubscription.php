<?php

namespace App\Http\Middleware;

use Closure;
use App\GenericM;

class ExpireSubscription
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
        //get all class users subscription date to check expired or not
        /*$data = GenericM::getClassesSubscriptin();
        if (!empty($data)) {
            $up['issubscribe'] = 3;
            $today = date('Y-m-d H:i:s');
            foreach ($data as $key => $value) {
                if ($today >=$value->subscription_expire) {
                    GenericM::updateData('tbl_class_registration',array('id'=>$value->id),$up);
                }
            }
        }*/

        return $next($request);
    }
}
