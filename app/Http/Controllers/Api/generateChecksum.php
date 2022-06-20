<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class generateChecksum extends encdec_paytm
{
    public function generate(Request $request)
    {
    	$checkSum = "";

		// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
		$findme   = 'REFUND';
		$findmepipe = '|';

		$paramList = array();

		$paramList["MID"] = '';
		$paramList["ORDER_ID"] = '';
		$paramList["CUST_ID"] = '';
		$paramList["INDUSTRY_TYPE_ID"] = '';
		$paramList["CHANNEL_ID"] = '';
		$paramList["TXN_AMOUNT"] = '';
		$paramList["WEBSITE"] = '';

		foreach($request->all() as $key=>$value)
		{  
		  $pos = strpos($value, $findme);
		  $pospipe = strpos($value, $findmepipe);
		  if ($pos === false || $pospipe === false) 
		    {
		        $paramList[$key] = $value;
		    }
		}


		  
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = $this->getChecksumFromArray($paramList,Config::get('constants.paytm.PAYTM_MERCHANT_KEY'));
		//print_r($_POST);
		 echo json_encode(array("CHECKSUMHASH" => $checkSum,"ORDER_ID" => $request->ORDER_ID, "payt_STATUS" => "1"),JSON_UNESCAPED_SLASHES);
		  //Sample response return to SDK
		 
		//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
    }
}
