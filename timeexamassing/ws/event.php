<?php
include_once('../bootstrap.php'); 
	
	/*
		- assign get/post data to json object
		- decode json data into object veriable and use that object veriable in code below as input parameters from client
	*/
	$json = file_get_contents('php://input');
	if(sizeof($_GET) > 0) {	$json = Zend_Json::encode($_GET);	}
	if(sizeof($_POST) > 0){	$json = Zend_Json::encode($_POST);	}
	$obj = Zend_Json::decode($json);

	/*
		- set default response
		- statusCode default Fail (Success - if records found)
	*/
	$Response = array("Result"=>array(), "StatusCode"=>"Fail", "ErrorMessage"=> "");

	
	/*
		- write your code in the below try catch block
	*/
	try{
		$sql = "select * from mts_assignment where is_active=1";
		$stmt = $db->query($sql, array($obj["day"], $obj["class"]));
		$row = $stmt->fetch();
		
		if(is_array($row) && sizeof($row) > 0){
			$Response["StatusCode"] = "Success";
			$Response["Result"] = $row;
		} else {
			$Response["StatusCode"] = "Fail";
			$Response["ErrorMessage"] = "Invalid email id or password.";
		}
		
	} 
	catch(Exception $e){
		$log->saveErrorMessage($e->getMessage());
		$Response["StatusCode"] = "Fail";
		$Response["ErrorMessage"] = $e->getMessage();
	}
	

	header('Content-type: application/json');
	echo json_encode($Response);
	
?>