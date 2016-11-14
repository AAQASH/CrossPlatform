<?php 

include_once('../bootstrap.php');
	
	/*
		- assign get/post data to json object
		- decode json data into object veriable and use that object veriable in code below as input parameters from client
	*/
	$json = file_get_contents('php://input');
	if(sizeof($_GET) > 0){	$json = Zend_Json::encode($_GET);	}
	if(sizeof($_POST) > 0){	$json = Zend_Json::encode($_POST);	}
	$obj = Zend_Json::decode($json);
	$data['UID'] = $obj['UID'];
	/*
		- set default response
		- statusCode default Fail (Success - if records found)
	*/
	$Response = array("Result"=>array(), "StatusCode"=>"Fail", "ErrorMessage"=> "");

	
	/*
		- write your code in the below try catch block
	*/
	try{
	
		if($obj['roll_no']) {
			$data['roll_no'] = $obj['roll_no'];
		} 
		if($obj['email']) {
			$data['email'] = (string)$obj['email'];
		} 
		if($obj['firstname']) {
			$data['firstname'] = $obj['firstname'];
		} 
		if($obj['lastname']) {
			$data['lastname'] = (string)$obj['lastname'];
		} 
		if($obj['phone']) {
			$data['phone'] = (string)$obj['phone'];
		} 
		if($obj['userimage']) {
			$data['userimage'] = $obj['userimage'];
		} 
		
		$where['UID=?'] = $data['UID'];
		$db->update("mts_user", $data, $where);
		$Response = array("Result"=>$data, "StatusCode"=>"Success", "ErrorMessage"=> "");
	 }
	 catch(Exception $e){
		$log->saveErrorMessage($e->getMessage());
		$Response["StatusCode"] = "Fail";
		$Response["ErrorMessage"] = $e->getMessage();
	}
	

	header('Content-type: application/json');
	echo json_encode($Response);
?>