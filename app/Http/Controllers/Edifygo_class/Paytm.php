<?php

namespace App\Http\Controllers\Edifygo_class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GenericM;
use App\StudentM;
use App\Mail\Allmail;
use Config;

class Paytm extends Controller
{
	//this method use for subscription
    public function handlePaytmRequest( $order_id, $amount ) {
		// Load all functions of encdec_paytm.php and config-paytm.php
		$this->getAllEncdecFunc();
		$this->getConfigPaytmSettings();
		$checkSum = "";
		$paramList = array();
		// Create an array having all required parameters for creating checksum.
		$paramList["MID"] = Config::get('constants.paytm.PAYTM_MERCHANT_MID');
		$paramList["ORDER_ID"] = $order_id;
		$paramList["CUST_ID"] = $order_id;
		$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
		$paramList["CHANNEL_ID"] = 'WEB';
		$paramList["TXN_AMOUNT"] = $amount;
		$paramList["WEBSITE"] = 'WEBSTAGING';
		$paramList["CALLBACK_URL"] = url( '/paytm-callback-cl' );
		$paytm_merchant_key = Config::get('constants.paytm.PAYTM_MERCHANT_KEY');
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
		return array(
			'checkSum' => $checkSum,
			'paramList' => $paramList
		);
	}

	public function handlePaytmRequestEnroll( $order_id, $amount ) {
		// Load all functions of encdec_paytm.php and config-paytm.php
		$this->getAllEncdecFunc();
		$this->getConfigPaytmSettings();
		$checkSum = "";
		$paramList = array();
		// Create an array having all required parameters for creating checksum.
		$paramList["MID"] = Config::get('constants.paytm.PAYTM_MERCHANT_MID');
		$paramList["ORDER_ID"] = $order_id;
		$paramList["CUST_ID"] = $order_id;
		$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
		$paramList["CHANNEL_ID"] = 'WEB';
		$paramList["TXN_AMOUNT"] = $amount;
		$paramList["WEBSITE"] = 'WEBSTAGING';
		$paramList["CALLBACK_URL"] = url( '/paytm-callback-enroll' );
		$paytm_merchant_key = Config::get('constants.paytm.PAYTM_MERCHANT_KEY');
		//Here checksum string will return by getChecksumFromArray() function.
		$checkSum = getChecksumFromArray( $paramList, $paytm_merchant_key );
		return array(
			'checkSum' => $checkSum,
			'paramList' => $paramList
		);
	}

	/**
	 * Get all the functions from encdec_paytm.php
	 */
	function getAllEncdecFunc() {
		function encrypt_e($input, $ky) {
			$key   = html_entity_decode($ky);
			$iv = "@@@@&&&&####$$$$";
			$data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
			return $data;
		}
		function decrypt_e($crypt, $ky) {
			$key   = html_entity_decode($ky);
			$iv = "@@@@&&&&####$$$$";
			$data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
			return $data;
		}
		function pkcs5_pad_e($text, $blocksize) {
			$pad = $blocksize - (strlen($text) % $blocksize);
			return $text . str_repeat(chr($pad), $pad);
		}
		function pkcs5_unpad_e($text) {
			$pad = ord($text{strlen($text) - 1});
			if ($pad > strlen($text))
				return false;
			return substr($text, 0, -1 * $pad);
		}
		function generateSalt_e($length) {
			$random = "";
			srand((double) microtime() * 1000000);
			$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
			$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
			$data .= "0FGH45OP89";
			for ($i = 0; $i < $length; $i++) {
				$random .= substr($data, (rand() % (strlen($data))), 1);
			}
			return $random;
		}
		function checkString_e($value) {
			if ($value == 'null')
				$value = '';
			return $value;
		}
		function getChecksumFromArray($arrayList, $key, $sort=1) {
			if ($sort != 0) {
				ksort($arrayList);
			}
			$str = getArray2Str($arrayList);
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}
		function getChecksumFromString($str, $key) {
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}
		function verifychecksum_e($arrayList, $key, $checksumvalue) {
			$arrayList = removeCheckSumParam($arrayList);
			ksort($arrayList);
			$str = getArray2StrForVerify($arrayList);
			$paytm_hash = decrypt_e($checksumvalue, $key);
			$salt = substr($paytm_hash, -4);
			$finalString = $str . "|" . $salt;
			$website_hash = hash("sha256", $finalString);
			$website_hash .= $salt;
			$validFlag = "FALSE";
			if ($website_hash == $paytm_hash) {
				$validFlag = "TRUE";
			} else {
				$validFlag = "FALSE";
			}
			return $validFlag;
		}
		function verifychecksum_eFromStr($str, $key, $checksumvalue) {
			$paytm_hash = decrypt_e($checksumvalue, $key);
			$salt = substr($paytm_hash, -4);
			$finalString = $str . "|" . $salt;
			$website_hash = hash("sha256", $finalString);
			$website_hash .= $salt;
			$validFlag = "FALSE";
			if ($website_hash == $paytm_hash) {
				$validFlag = "TRUE";
			} else {
				$validFlag = "FALSE";
			}
			return $validFlag;
		}
		function getArray2Str($arrayList) {
			$findme   = 'REFUND';
			$findmepipe = '|';
			$paramStr = "";
			$flag = 1;
			foreach ($arrayList as $key => $value) {
				$pos = strpos($value, $findme);
				$pospipe = strpos($value, $findmepipe);
				if ($pos !== false || $pospipe !== false)
				{
					continue;
				}
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}
		function getArray2StrForVerify($arrayList) {
			$paramStr = "";
			$flag = 1;
			foreach ($arrayList as $key => $value) {
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}
		function redirect2PG($paramList, $key) {
			$hashString = getchecksumFromArray($paramList, $key);
			$checksum = encrypt_e($hashString, $key);
		}
		function removeCheckSumParam($arrayList) {
			if (isset($arrayList["CHECKSUMHASH"])) {
				unset($arrayList["CHECKSUMHASH"]);
			}
			return $arrayList;
		}
		function getTxnStatus($requestParamList) {
			return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
		}
		function getTxnStatusNew($requestParamList) {
			return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
		}
		function initiateTxnRefund($requestParamList) {
			$CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
			$requestParamList["CHECKSUM"] = $CHECKSUM;
			return callAPI(PAYTM_REFUND_URL, $requestParamList);
		}
		function callAPI($apiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Content-Length: ' . strlen($postData))
			);
			$jsonResponse = curl_exec($ch);
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}
		function callNewAPI($apiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'Content-Length: ' . strlen($postData))
			);
			$jsonResponse = curl_exec($ch);
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}
		function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
			if ($sort != 0) {
				ksort($arrayList);
			}
			$str = getRefundArray2Str($arrayList);
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}
		function getRefundArray2Str($arrayList) {
			$findmepipe = '|';
			$paramStr = "";
			$flag = 1;
			foreach ($arrayList as $key => $value) {
				$pospipe = strpos($value, $findmepipe);
				if ($pospipe !== false)
				{
					continue;
				}
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}
		function callRefundAPI($refundApiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_URL, $refundApiURL);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$jsonResponse = curl_exec($ch);
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}
	}
	/**
	 * Config Paytm Settings from config_paytm.php file of paytm kit
	 */
	function getConfigPaytmSettings() {
		define('PAYTM_ENVIRONMENT', Config::get('constants.paytm.PAYTM_ENVIRONMENT')); // PROD
		define('PAYTM_MERCHANT_KEY', Config::get('constants.paytm.PAYTM_MERCHANT_KEY')); //Change this constant's value with Merchant key downloaded from portal
		define('PAYTM_MERCHANT_MID', Config::get('constants.paytm.PAYTM_MERCHANT_MID')); //Change this constant's value with MID (Merchant ID) received from Paytm
		define('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'); //Change this constant's value with Website name received from Paytm
		$PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
		$PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
		if (PAYTM_ENVIRONMENT == 'PROD') {
			$PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
			$PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
		}
		define('PAYTM_REFUND_URL', '');
		define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
		define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
		define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
	}

	//this method used for subscription
	public function paytmCallback( Request $request ) {
		// dd($request);
		if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
			if (session('class_login_session_id')) {
				$class_id = session('class_login_session_id');
			}else
			{
				$class_id = (int)substr($request['ORDERID'], strpos($request['ORDERID'], "-") + 1);    
			}

			$data['issubscribe'] = 1;
			$data['subscription_method'] = 1;
			$data['subscription_price'] = $request['TXNAMOUNT'];
	        $data['subscription_date'] = date('Y-m-d H:i:s');
	        $data['subscription_expire'] = date('Y-m-d H:i:s', strtotime('+1 years'));
			$data['transaction_id'] = $request['TXNID'];
			$data['order_id'] = $request['ORDERID'];
			$data['txn_date'] = date('Y-m-d H:i:s');
			$data['txn_details'] = $request->all();

			// dd($data);
			$where = array('id' => $class_id);
            $isUpdate = GenericM::updateData('tbl_class_registration',$where,$data);
            if ($isUpdate) {
                session()->flash('success-msg','subscribed successfully.');
            }else
            {
                session()->flash('error-msg','subscription not done,try again.');
            }
		} else if( 'TXN_FAILURE' === $request['STATUS'] ){
			session()->flash('error-msg','subscription not done,try again.');
		}
		return redirect('/class/profile');
	}

	public function paytmCallbackEnroll( Request $request ) {
		// dd($request->all());
		if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
			//explod ORDERID FOR GET student_id and timeslot_id
			$explod = explode('-',$request['ORDERID']);
			if (session('student_login_session_id')) {
				$student_id = session('student_login_session_id');
			}else
			{
				$student_id = $explod[1];    
			}
			$timeslot_id = $explod[2];
			$istrial = $explod[3];

			// dd($request['ORDERID']);
			$row = StudentM::getCourseData($timeslot_id);   
			// dd($row);
			if (!empty($row)) {
				$data['course_id'] = $row->id;
				$data['student_id'] = $student_id;
				$data['class_name'] = GenericM::getSingleRecord('tbl_class_registration','name',array('id'=>$row->class_id))->name;
				$data['class_id'] = $row->class_id;
				$data['name'] = $row->name;
				$data['timeslot_id'] = $timeslot_id;
				$data['istrial'] = $istrial;
				$data['start_date'] = $row->start_date;
				$data['end_date'] = $row->end_date;
				$data['start_time'] = $row->start_time;
				$data['end_time'] = $row->end_time;
				$data['price'] = $row->price;
				$data['enroll_amount'] = $request['TXNAMOUNT'];
				if ($istrial==0) {
					$data['isExclusive'] = $row->isExclusive;
					if ($row->isExclusive==0) {
						//if Not Exclusive
						$data['owner_service_charge_per'] = $row->owner_service_charge_per;
						$data['owner_service_charge'] = $row->owner_service_charge;
						$data['client_discount_per'] = $row->client_discount_per;
						$data['client_discount'] = $row->client_discount;
						$data['total_discount_per'] = $row->total_discount_per;
						$data['final_price'] = $row->final_price;
						$data['admission_fees_selection'] = $row->admission_fees_selection;
						$data['admission_fees_selection_value'] = $row->admission_fees_selection_value;
						$data['owner_service_charge_student_discount_per'] = $row->owner_service_charge_student_discount_per;
						$data['owner_service_charge_student_discount_value'] = $row->owner_service_charge_student_discount_value;
						$data['owner_service_charge_owner_discount_per'] = $row->owner_service_charge_owner_discount_per;
						$data['owner_service_charge_owner_discount_value'] = $row->owner_service_charge_owner_discount_value;
						$data['gst_per'] = $row->gst_per;
						$data['gst_value'] = $row->gst_value;
						$data['final_owner_charge'] = $row->final_owner_charge;
						$data['student_addmission_fees'] = $row->student_addmission_fees;
						$data['student_original_discount_value'] = $row->student_original_discount_value;
						$data['student_original_discount_per'] = $row->student_original_discount_per;
					}else
					{
						//if Exclusive
						$data['owner_service_charge_per'] = $row->ex_owner_service_charge_per;
						$data['owner_service_charge'] = $row->ex_owner_service_charge;
						$data['client_discount_per'] = $row->ex_client_discount_per;
						$data['client_discount'] = $row->ex_client_discount;
						$data['total_discount_per'] = $row->ex_total_discount_per;
						$data['final_price'] = $row->ex_final_price;
						$data['admission_fees_selection'] = $row->ex_admission_fees_selection;
						$data['admission_fees_selection_value'] = $row->ex_admission_fees_selection_value;
						$data['owner_service_charge_student_discount_per'] = $row->ex_owner_service_charge_student_discount_per;
						$data['owner_service_charge_student_discount_value'] = $row->ex_owner_service_charge_student_discount_value;
						$data['owner_service_charge_owner_discount_per'] = $row->ex_owner_service_charge_owner_discount_per;
						$data['owner_service_charge_owner_discount_value'] = $row->ex_owner_service_charge_owner_discount_value;
						$data['gst_per'] = $row->ex_gst_per;
						$data['gst_value'] = $row->ex_gst_value;
						$data['final_owner_charge'] = $row->ex_final_owner_charge;
						$data['student_addmission_fees'] = $row->ex_student_addmission_fees;
						$data['student_original_discount_value'] = $row->ex_student_original_discount_value;
						$data['student_original_discount_per'] = $row->ex_student_original_discount_per;
					}
				}

				$data['transaction_id'] = $request['TXNID'];
				$data['order_id'] = $request['ORDERID'];
				$data['txn_details'] = json_encode($request->all());
				$data['date'] = date('Y-m-d H:i:s');
				// dd($data);
	            $isInsert = GenericM::insertData('tbl_enroll_course',$data);
	            if ($isInsert) {
	            	$up_data = array();
	            	//update if exclusive count ++ in course tbl
	            	if ($row->isExclusive==1) {
	            		$up_data['total_ex_enroll'] = $row->total_ex_enroll + 1;
	            		$where = array('id' =>$row->id);
	            		$isUpdate = GenericM::updateData('tbl_class_course',$where,$up_data);
	            	// dd($row->isExclusive);
	            	}


	            	//send mail to student
                    $student_row = GenericM::getSingleRecord('tbl_student_registration','*',array('id'=>$student_id));
                    $class_row = GenericM::getSingleRecord('tbl_class_registration','email',array('id'=>$row->class_id));
                    $student_all_type = [
                    	'type' => 8,
                    	'student_name' => $student_row->firstname." ".$student_row->lastname,
                    	'class_name' => $row->class_name,
                    	'main_course_name' => $row->main_course_name,
                    	'sub_course_name' => $row->sub_course_name,
                    	'child_course_name' => $row->child_course_name ? $row->child_course_name : "N/A",
                    	'address' => $row->address,
                    	'timing' => date("g:i A", strtotime($row->start_time))." To ".date("g:i A", strtotime($row->end_time)),
                    	'total_course_fees' => $row->price,
                    	'discount' => $istrial==0 ? $data['student_original_discount_value'] : "N/A",
                    	'your_price_by_oktat' => $istrial==0 ? $data['student_addmission_fees'] : "N/A",
                    	'addmission_fees' => $istrial==0 ? $data['admission_fees_selection_value'] :"N/A",
                    	'remaining_amount' => $istrial==0 ? ($data['student_addmission_fees'] - $data['admission_fees_selection_value']) : "N/A",
                    	'payment_mode' => "Paytm",
                    ];                    
                    // dd($student_all_type);
                    if (!empty($student_row) && !empty($student_all_type)) {
                    	try {
                    		\Mail::to($student_row->email)->send(new Allmail($student_all_type));
	                    } catch (\Exception $e) {
	                        
	                    }
                    	if (!empty($class_row)) {
                    		$class_all_type = [
		                    	'type' => 11,
		                    	'student_name' => $student_row->firstname." ".$student_row->lastname,
		                    	'class_name' => $row->class_name,
		                    	'main_course_name' => $row->main_course_name,
		                    	'sub_course_name' => $row->sub_course_name,
		                    	'child_course_name' => $row->child_course_name ? $row->child_course_name : "N/A",
		                    	'address' => $row->address,
		                    	'timing' => date("g:i A", strtotime($row->start_time))." To ".date("g:i A", strtotime($row->end_time)),
		                    	'total_course_fees' => $row->price,
		                    	'discount' => $istrial==0 ? $data['student_original_discount_value'] : "N/A",
		                    	'your_price_by_oktat' => $istrial==0 ? $data['student_addmission_fees'] : "N/A",
		                    	'addmission_fees' => $istrial==0 ? $data['admission_fees_selection_value'] : "N/A",
		                    	'remaining_amount' => $istrial==0 ? ($data['student_addmission_fees'] - $data['admission_fees_selection_value']) : "N/A",
		                    	'payment_mode' => "Paytm",
		                    ];
		                    
		                    try {
                    			\Mail::to($class_row->email)->send(new Allmail($class_all_type));
		                    } catch (\Exception $e) {
		                        
		                    }
                    	}
                    }

	                session()->flash('success-msg','Enrolled successfully.');
	            }else
	            {
	                session()->flash('error-msg','Enrolled not done,try again.');
	            }
			}	
		} else if( 'TXN_FAILURE' === $request['STATUS'] ){
			session()->flash('error-msg','Enrolled not done,try again.');
		}
		return redirect('/student/enrolllist');
	}
}
