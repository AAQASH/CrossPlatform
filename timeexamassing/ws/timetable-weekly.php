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
		$sql = "
		SELECT * , mts_subject.ID AS sid FROM mts_timetable 
		LEFT JOIN mts_class ON ( mts_class.CID = mts_timetable.class_id ) 
		LEFT JOIN mts_subject ON ( mts_subject.ID = mts_timetable.subject_id ) 
		LEFT JOIN mts_user ON ( mts_user.UID = mts_timetable.staff_id ) 
		WHERE mts_timetable.class_id = ? AND mts_timetable.is_active =1";
		$row = $db->fetchAll($sql, $obj["class_id"]);
		
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