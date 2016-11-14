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
	$role = $obj['role'];
	
	/*
		- set default response
		- statusCode default Fail (Success - if records found)
	*/
	$Response = array("Result"=>array(), "StatusCode"=>"Fail", "ErrorMessage"=> "");

	/*
		- write your code in the below try catch block
	*/
	try{
	
			$ValidateEmailSql = "select * from mts_notification where userId=? and deviceRegisterId=?";
			$ValidateEmailStmt = $db->query($ValidateEmailSql, array($obj['userId'],$obj['deviceRegisterId']));
			$ValidateEmailRow = $ValidateEmailStmt->fetch();
			
			if((int)$ValidateEmailRow['ID']>0){
				$Response = json_encode($ValidateEmailRow);
				echo $_GET['callback'] . '(' . "{'StatusCode' : 'Success' , 'Result':[".$Response."],'ErrorMessage':'Already available.'"." }" . ')';
			}
			else{
				$data['userId'] 			= (int)$obj['userId'];
				$data['deviceRegisterId'] 	= (string)$obj['deviceRegisterId'];
				$data['is_active'] 			= 1;
				$data['added_date'] 		= date("Y-m-d");

				$db->insert("mts_notification", $data);
				
				$Response = json_encode($data);
				echo $_GET['callback'] . '(' . "{'StatusCode' : 'Success' , 'Result':[".$Response."],'ErrorMessage':''"." }" . ')';
			}
	} 
	catch(Exception $e){
		$log->saveErrorMessage($e->getMessage());
		// $Response["StatusCode"] = "Fail";
		// $Response["ErrorMessage"] = $e->getMessage();
		echo $_GET['callback'] . '(' . "{'StatusCode' : 'Fail' , 'Result':[],'ErrorMessage':'Invalid Request.'"." }" . ')';
	}
	
	#header('Content-type: application/json');
	#echo json_encode($Response);
?>