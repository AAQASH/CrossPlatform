<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	$action = (strlen(trim($_REQUEST['action'])) > 0 ? $_REQUEST['action'] : "");
	
	
	switch($action){
		case 'showform':
			showform();
			break;
		case 'block':
			$input = new input();
			$data = array();
			$data['is_blocked'] = 1;
			$data['blocked_reason'] = $input->post('reason');
			$where["UID = ?"] = $input->post('UID');
			$db->update('mts_user', $data, $where);
			
			$networkUserStmt = $db->query('select * from mts_user where UID=?', $input->post('UID'));
			$row = $networkUserStmt->fetch();
	
			## GET EMAIL TEMPLATE FROM DB ##
			$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", 2);
			$emailTemplate = $emailTemplateStmt->fetch();
			if(sizeof($emailTemplate) > 0){
				$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
				$body 		= $emailTemplate['email_message'];
				$body 		= str_replace("[[user_full_name]]", $row['firstname']." ". $row['lastname'], $body);
				$body 		= str_replace("[[SITETITLE]]", SITETITLE, $body);
				$body 		= str_replace("[[reason]]", $input->post('reason'), $body);
				
				$template	= file_get_contents(ABSPATH ."/templates/email/email.html");
				$body		= str_replace("[[BODY]]", $body, $template);
				$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
				$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
			}//end if
			
			## SEND REGISTRATION EMAIL ##
			$mail->addTo( $row['email'], $row['firstname'] );
			$mail->setSubject( $subject );
			$mail->setBodyHtml( $body );
			$mail->send();
			$message = "User blocked successfully.";
			Message::setMessage($message, 'SUCCESS');
			
			echo json_encode(array('error'=>'0', 'msg'=>$message));
			
			break;
		case 'unblock':
			$input = new input();
			$data = array();
			$data['is_blocked'] = 0;
			$data['blocked_reason'] = '';
			$where["UID = ?"] = $input->post('UID');
			$db->update('mts_user', $data, $where);
			
			
			$networkUserStmt = $db->query('select * from mts_user where UID=?', $input->post('UID'));
			$row = $networkUserStmt->fetch();
			
			## GET EMAIL TEMPLATE FROM DB ##
			$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", 2);
			$emailTemplate = $emailTemplateStmt->fetch();
			if(sizeof($emailTemplate) > 0){
				$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
				$body 		= $emailTemplate['email_message'];
				$body 		= str_replace("[[user_full_name]]", $row['firstname']." ". $row['lastname'], $body);
				$body 		= str_replace("[[SITETITLE]]", SITETITLE, $body);
				$body 		= str_replace("[[reason]]", $input->post('reason'), $body);
				
				$template	= file_get_contents(ABSPATH ."/templates/email/email.html");
				$body		= str_replace("[[BODY]]", $body, $template);
				$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
				$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
			}//end if
			
			## SEND REGISTRATION EMAIL ##
			$mail->addTo( $row['email'], $row['firstname'] );
			$mail->setSubject( $subject );
			$mail->setBodyHtml( $body );
			$mail->send();
			
			$message = "User unblocked successfully.";
			Message::setMessage($message, 'SUCCESS');
			
			echo json_encode(array('error'=>'0', 'msg'=>$message));
			break;
	}
	
	
	function showform(){
		print <<< END
		  <form method='post' name='save_block_reason' id='save_block_reason'>
		    <input type="hidden" id="UID" name="UID" value="${_REQUEST['UID']}"/>
			<table border="0" cellpadding="3" cellspacing="0">
			  <tr>
				<td><h3 class='mediumhead'>Block Reason</h3></td>
			  </tr>
			  <tr>
				<td><textarea name="reason" cols="40" rows="5" id="reason"></textarea></td>
			  </tr>
			  <tr>
				<td align='right'><input type="button" name="save" id="save" value="Save" class='smallbutton' onclick='javascript:saveBlockReason();'></td>
			  </tr>
			</table>
		  </form>
END;
	}