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
		$ValidateEmailSql = "select * from mts_user where email=?";
		$ValidateEmailStmt = $db->query($ValidateEmailSql, $obj['email']);
		$ValidateEmailRow = $ValidateEmailStmt->fetch();
		
		if(is_array($ValidateEmailRow) && sizeof($ValidateEmailRow) > 0){
			$Response = array("Result"=>array(), "StatusCode"=>"Fail", "ErrorMessage"=> "Someone is already register with this email id.");
		}// end try 
		else {
			$verificationcode 			= time();
			$data['email'] 				= (string)$obj['email'];
			$data['phone'] 				= $obj['phone_number'];
			$data['password'] 			= (string)md5($obj['password']);
			$data['verificationcode'] 	= $verificationcode;
			$data['account_type_id_fk'] = 2; // for student.
			$data['signupdate'] 		= date("Y-m-d H:i:s");

			$db->insert("mts_user", $data);
			
			/*
			## send registration email ##
			$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", 4);
			$emailTemplate = $emailTemplateStmt->fetch();
				
			if(is_array($emailTemplate) && sizeof($emailTemplate) > 0){
				
				$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
				$body 		= $emailTemplate['email_message'];
				$body 		= str_replace("[[firstname]]", $obj['name'], $body);
				$template	= file_get_contents(ABSPATH ."/templates/email/email.html");
				$body		= str_replace("[[BODY]]", $body, $template);
				$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
				$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
				$body		= str_replace("[[SITETITLE]]", SITETITLE, $body);
				$body		= str_replace("[[email]]", $obj['email'], $body);
				$body		= str_replace("[[verification_code]]", $verificationcode, $body);
			}//end if
			
			## SEND EMAIL BY ZEND CLASS ##
			try{
				$mail->setBodyHtml($body); //email body
				$mail->addTo($obj['email'], $obj['name']); 
				$mail->setSubject($subject); 
				$mail->send(); 
			}
			catch(Exception $e){}
			*/
			
			$Response = array("Result"=>$data, "StatusCode"=>"Success", "ErrorMessage"=> "");
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