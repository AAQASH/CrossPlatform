<?php
	/* INCLUDE REQUIRED FILES */
	include_once("../../bootstrap.php");
	
	$uid = $input->post('uid');
	
	if($uid > 0){
		$is_verified = 0;
		$verificationdate = '';
		$verificationcode = md5(time());
		$password = time();
		$md5password = md5($password);
		
		$data['is_verified'] = $is_verified;
		$data['verificationdate'] = $verificationdate;
		$data['verificationcode'] = $verificationcode;
		$data['password'] = $md5password;
		$where["UID = ?"] = $uid; 
		$db->update('mts_user', $data, $where);
		
		
		## GET EMAIL TEMPLATE FROM DB ##
		$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", 4);
		$emailTemplate = $emailTemplateStmt->fetch();
		if(count($emailTemplate) > 0){
			$nu = $db->query('select * from mts_user where UID=?', $uid);
			$networkuserRow = $nu->fetch();
			if(count($networkuserRow) > 0){
				$firstname = $networkuserRow['firstname']. ' '. $networkuserRow['lastname'];
				$email = $networkuserRow['email'];
			}
			
			$link 		= SITEROOT .'/user-verification.html?vcode='.$verificationcode;
			$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
			$body 		= $emailTemplate['email_message'];
			$body 		= str_replace("[[firstname]]", $firstname, $body);
			$body 		= str_replace("[[SITETITLE]]", SITETITLE, $body);
			$body 		= str_replace("[[link]]", $link, $body);
			$body 		= str_replace("[[email]]", $email, $body);
			$body 		= str_replace("[[password]]", $password, $body);
			
			$template	= file_get_contents(ABSPATH ."/templates/email/email.html");
			$body		= str_replace("[[BODY]]", $body, $template);
			$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
			$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
			
		}//end if

		## RESEND VERIFICATION EMAIL AND LOGIN INFORMATION ##
		$mail->addTo( $email, $firstname );
		$mail->setSubject( $subject );
		$mail->setBodyHtml( $body );
		$mail->send();
		
		$value = array('error'=>'0', 'msg'=>'Verification email sent successfully.');
		$output = json_encode($value);
	}else{
		$value = array('error'=>'1', 'msg'=>'User Id not defined.');
		$output = json_encode($value);
	}//end if
	
	
?>