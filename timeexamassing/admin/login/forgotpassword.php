<?php
include_once('../bootstrap.php');

	if(is_array($_POST) && sizeof($_POST) > 0){
		$txt_email = $input->post('txt_email');
		$error = "";
		$classname = "";
		
		if(strlen($txt_email) < 1){
			$message = "Cannot find the email address.";
			$classname = 'customerror';
			
		}//if
		
		if(strlen(trim($txt_email)) > 0){
			$UserStmt = 'select UID from mts_user where email=? and account_type_id_fk=?';
			$stmt = $db->query($UserStmt, array($txt_email, "1"));
    		$row = $stmt->fetchAll(); 
			if(count($row) > 0){
				$pwd = Password::getInstance()->generate();
				$data['password'] = md5($pwd);
				$data['is_verified'] = 1;
				$where['email=?'] = $txt_email;
				$db->update('mts_user', $data, $where);
				
				## GET EMAIL TEMPLATE FROM DB ##
				$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", 2);
				$emailTemplate = $emailTemplateStmt->fetch();
				if(sizeof($emailTemplate) > 0){
					$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
					$body 		= $emailTemplate['email_message'];
					$body 		= str_replace("[[firstname]]", $firstname, $body);
					$body 		= str_replace("[[SITETITLE]]", SITETITLE, $body);
					$body 		= str_replace("[[email]]", $txt_email, $body);
					$body 		= str_replace("[[password]]", $pwd, $body);
					
					$template	= file_get_contents(ABSPATH."/templates/email/email.html");
					$body		= str_replace("[[BODY]]", $body, $template);
					$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
					$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
				}//end if
				
				## SEND REGISTRATION EMAIL ##
				$mail->addTo( $txt_email, $firstname );
				$mail->setSubject( $subject );
				$mail->setBodyHtml( $body );
				$mail->send();  
				
				$message = "Password sent to your email.";
				$classname = "alert alert-success";
			}else{
				$message = "Cannot find the email address.";
				$classname = "alert alert-danger";
			}//if
		}//if
	}//if
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->

<div id="maincont" class="ovfl-hidden">
  <div id="loginwrapper"> <br>
    <br>
    <br>
    <br>
    <div class="loginbox">
      <div class="top1">
        <div>&nbsp;</div>
      </div>
      <div class="bg1">
         <div style="padding:1px 20px;">
          <form method="post" name="forgotpassword">
            <div class="loginCont">
              <h3 class="mainhead">Forgot Password </h3>
              <div class="clr"></div>
              <?php echo (strlen($message) > 0 ? '<div class="'.$classname.'">'.$message.'</div><br/>' : ''); ?>
              <ul class="reset listing">
                <li>
                  <label class="label fl"><strong>Email:</strong></label>
                  <div class="field">
                    <input value="" name="txt_email" id="txt_email" type="text" tabindex="1" />
                  </div>
                </li>
                <!--<li>
            <label class="label fl">&nbsp;</label>
                <a href="login.php">&laquo;&nbsp;Back to Login</a>
          </li>-->
                <li>
                  <label class="label fl">&nbsp;</label>
                  <div class="ovfl-hidden" style="padding-top:0px;">
                    <div class="fl leftAlign"><a href="login.php">&laquo;&nbsp;Back to Login</a></div>
                    <div class="fr rightAligh">
                      <div class="button rightAlign">
                        <input type="submit" name="btn_receive_password" value="Receive Password" tabindex="5"  />
                      </div>
                    </div>
                    <div class="clr"></div>
                  </div>
                </li>
              </ul>
            </div>
          </form>
          <div class="clr">&nbsp;</div>
        </div>
      </div>
      <div class="end1">
        <div>&nbsp;</div>
      </div>
    </div>
  </div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>