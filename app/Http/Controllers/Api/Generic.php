<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Generic extends Controller
{
    //send SMS Code
    public function sendOTP($otp,$contact)
    {
        $urls="http://sms.magnadism.in/vendorsms/pushsms.aspx?user=oktat&password=oktat@123&msisdn=91".$contact."&sid=OKTATE&msg=Use%20this%20One%20Time%20Password%20to%20verify%20your%20registration:".$otp."&fl=0&gwid=2";//&email=".$email&email=".$email
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $urls,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $err;
    }

    public function responseData($status,$msg,$data)
    {
        $response['status'] = $status;
        $response['msg'] = $msg;
        $response['data'] = $data;
        return $response;
    }
}
