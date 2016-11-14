<?php
include_once('../bootstrap.php');
require_once("admin/network/upload_image.php");
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			if($T->Check()) {
				$validator = new FormValidator();
				$validator->addValidation("email","req","Please enter email.");
				$validator->addValidation("email","email","The input for Email should be a valid email value.");
				//$validator->addValidation("password","req","Please enter password.");
			
				if($validator->ValidateForm()){
	
					$username 	= $input->post('username');
					$email		= $input->post('email');
					$password	= $input->post('password');
					$firstname	= $input->post('firstname');
					$lastname	= $input->post('lastname');
					$birthdate	= $input->post('birthdate');
					$gender		= $input->post('gender');
					$is_active	= $input->post('is_active');
					$is_verified= $input->post('is_verified');
					$verificationcode = md5(time());
					
					$data["username"] = $username;
					$data["email"] = $email;
					
					if($password!="")
					{
						$data["password"] = md5($password);
					}
					
					$data["firstname"] = $firstname;
					$data["lastname"] = $lastname;
					$data["birthdate"] = $birthdate;
					$data["gender"] = $gender;
					
					if(strlen($userimage) > 0){
						$data["userimage"] = $userimage;
					}
					if(strlen($thumbnail) > 0){
						$data["thumbnail"] = $thumbnail;
					}
					$data["lastlogindate"] = date("Y-m-d H:i:s");
					$data["is_online"] = 0;
					$data["is_verified"] = $is_verified;
					$data["verificationdate"] = "";
					$data["verificationcode"] = $verificationcode;
					$data["account_type_id_fk"] = 3;
					$data["is_active"] = $is_active;
					
					/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
					if($edit_id > 0){
						$where["UID = ?"] = $edit_id; 
						$db->update('mts_user', $data, $where);
						$ID = $edit_id;
						$message = "User information saved successfully.";
						Message::setMessage($message, 'SUCCESS');
					} else {
					/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
						$data["signupdate"] = date("Y-m-d H:i:s");
						$db->insert('mts_user', $data);
						$ID = $db->lastInsertId();
						
						if($is_verified < 1){ // send registration email with verification link
							$EmailTemplateId = 4;
						}else{ //send only registration email
							$EmailTemplateId = 7;
						}
						
						
						## GET EMAIL TEMPLATE FROM DB ##
						$emailTemplateStmt = $db->query("select * from mts_emailtemplate where emailtemplate_id=?", $EmailTemplateId);
						$emailTemplate = $emailTemplateStmt->fetch();
						if(count($emailTemplate) > 0){
							if($is_verified < 1){
								$link 		= SITEROOT .'/user-verification.html?vcode='.$verificationcode;
							}else{
								$link 		= "";
							}
							$subject 	= str_replace("[[SITETITLE]]", SITETITLE, $emailTemplate['subject']);
							$body 		= $emailTemplate['email_message'];
							$body 		= str_replace("[[firstname]]", $firstname.' '.$lastname, $body);
							$body 		= str_replace("[[SITETITLE]]", SITETITLE, $body);
							$body 		= str_replace("[[email]]", $email, $body);
							$body 		= str_replace("[[password]]", $password, $body);
							$body 		= str_replace("[[link]]", $link, $body);
							
							$template	= file_get_contents(ABSPATH ."/templates/email/email.html");
							$body		= str_replace("[[BODY]]", $body, $template);
							$body		= str_replace("[[COPYRIGHT]]", COPYRIGHT, $body);
							$body		= str_replace("[[SITEROOT]]", SITEROOT, $body);
						}//end if
						
						## SEND REGISTRATION EMAIL ##
						$mail->addTo( $email, $firstname );
						$mail->setSubject( $subject );
						$mail->setBodyHtml( $body );
						$mail->send();
						$message = "User information saved successfully.";
						Message::setMessage($message, 'SUCCESS');
					}//IF
					
					if(strlen($_FILES['thumbnail']['name']) > 0){
						saveUserImage('thumbnail', $ID, 1, $networkuser);
					}
					
					redirect("staff-save.php", $_SERVER['QUERY_STRING']);
					
				} else {
					$message .= "Please enter value in required fields.";
					$error_hash = $validator->GetErrors();
					foreach($error_hash as $inpname => $inp_err){
						$message .= "<p>$inpname : $inp_err</p>\n";
					}
					Message::setMessage($message, 'ERROR');
				}//IF
			}//end token if
		}//IF
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 

	/* SELECT INFORMATION BY EDIT_ID */
	try{	
		if($edit_id > 0){
			$selectFields = '`UID`, `username`, `email`, `password`, `firstname`, `lastname`, `birthdate`, `gender`, `userimage`, `signupdate`, `lastlogindate`, `is_online`, `is_verified`, `verificationdate`, `verificationcode`, `account_type_id_fk`, `is_active`, `is_blocked`, `blocked_reason`';
			$networkUserStmt = $db->query('select '.$selectFields.' from mts_user where UID=?', $edit_id);
			$data = $networkUserStmt->fetch();
			if(count($data) > 0){
				extract($data);
				unset($data);
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<link rel="stylesheet" href="<?php echo SITEROOT ?>/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo SITEROOT ?>/templates/js/jquery/facebox/src/facebox.css" type="text/css">
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOT. "/templates/js/jquery/facebox/src/facebox.js";
$javascript[] = SITEROOTADMIN. "/network/js/user-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<script language="javascript">
$(document).ready(function(){
	//$('#password').attr("disabled", "disabled"); 
	$('#Edit').click(function(){
		$('#password').removeAttr("disabled"); 
		
	});
	$('#Cancle').click(function(){
		//$('#password').removeAttr("disabled"); 
		$('#password').attr("disabled", "disabled"); 
	});
})
</script>
<div id="maincont" class="ovfl-hidden">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="">
        <h3 class="fl panel-title">Save User Personal Information</h3>
        <div class="fr">
          <input type="button" name="btnback" id="btnback" class="btn btn-primary btn-xs" value=" Back " onClick="javascript:location.href='staff-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="panel-body"><?php echo Message::getMessage(); ?>
      <form name="<?php echo ($edit_id > 0 ? 'edit_user_info' : 'addnew_user_info')?>" id="<?php echo ($edit_id > 0 ? 'edit_user_info' : 'addnew_user_info')?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <?php echo $T->protectForm(); ?>
        <div>
          <div class=""> <?php echo Message::customMessage(WARNING_UPLOAD_MAX_FILESIZE, 'WARNING'); ?>
            <table width="100%" class="form">
              <?php /*<tr>
			<td width="25%"><label for="username">Username:</label>&nbsp;<span class="error">*</span></td>
			<td><input name="username" type="text" id="username" value="<?php echo $username?>" size="50" maxlength="32" /></td>
		    <td width="49%">&nbsp;</td>
		  </tr>*/?>
              <tr>
                <td><label for="email">Email:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="email" type="text" id="email" value="<?php echo $email?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="password">Password:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" <?php echo ($edit_id >0)?"disabled='disabled'":""?> name="password" type="password" id="password" value="" size="50" />
                <?php
					if($edit_id > 0){ 
				?>
                <a href="javascript:void(0)" id="Edit">Edit Password</a> | <a href="javascript:void(0)" id="Cancle">Cancle Password</a>
                <?php
					}// end if. 
				?>
                </td>
              </tr>
              <tr>
                <td><label for="firstname">First Name:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="firstname" type="text" id="firstname" value="<?php echo $firstname?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="lastname">Last Name: <span class="error">*</span></label></td>
                <td><input class="form-control" name="lastname" type="text" id="lastname" value="<?php echo $lastname?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="birthdate">Birthdate: <span class="error">*</span></label></td>
                <td><input type="text" name="birthdate" id="birthdate" value="<?php echo $birthdate?>" readonly="readonly" />
                  &nbsp;<small>(yyyy-mm-dd)</small></td>
              </tr>
              <tr>
                <td><label for="gender">Gender: <span class="error">*</span></label></td>
                <td><select class="form-control" name="gender" id="gender">
                    <option value="">--- Gender ---</option>
                    <option value="Male" <?php echo ($gender == "Male" ? "selected=\"selected\"" : "");?>>Male</option>
                    <option value="Female" <?php echo ($gender == "Female" ? "selected=\"selected\"" : "");?>>Female</option>
                  </select></td>
              </tr>
              <?php
            if(strlen($userimage) < 1){
                $tr_image_1_uploader = "";
                $tr_image_1_preview = "none";
				$image_1_status = "";
            }else{
                $tr_image_1_uploader = "none";
                $tr_image_1_preview = "";
				$image_1_status = "disabled=\"disabled\"";
            }
        ?>
              <tr id="tr_image_1_uploader" style="display:<?php echo $tr_image_1_uploader?>">
                <td valign="top"><label for="thumbnail">Thumbnail:</label>
                  <label><small>(png, jpg, jpeg, gif)</small></label></td>
                <td valign="top"><input name="thumbnail" type="file" id="thumbnail" size="50" contenteditable="false"/></td>
              </tr>
              <tr id="tr_image_1_preview" style="display:<?php echo $tr_image_1_preview?>">
                <td valign="top"><label for="thumbnail">Thumbnail:</label>
                  <label><small>(png, jpg, jpeg, gif)</small></label></td>
                <td valign="top"><?php
					$imagePath = ABSPATH .'/uploads/user/'.$edit_id.'/small/'.$userimage;
					if(is_file($imagePath)){
						echo '<img src="'.SITEROOT.'/uploads/user/'.$edit_id.'/small/'.$userimage.'" />';
					} else {
						echo '';
					}
				?>
                  &nbsp; <span><a href="javascript:void(0);" onclick="javascript:deleteImage('<?php echo $edit_id; ?>', '<?php echo $userimage ?>', '1')">Delete</a></span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_verified" id="is_verified" value="1" <?php echo ($is_verified == "1" ? "checked=\"checked\"" : "")?>/>
                  &nbsp;
                  <label for="is_verified">Is verified</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary" value=" Save User Information " />
                  &nbsp;
                  <?php
			if($edit_id > 0 && $is_verified < 1){?>
                  <input type="button" name="btnresendverification" id="btnresendverification" class="btn btn-warning" value=" Resend Verification Email " />
                  <?php
			} ?></td>
              </tr>
            </table>
          </div>
          <div class="clr"></div>
        </div>
      </form>
    </div>
  </div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
