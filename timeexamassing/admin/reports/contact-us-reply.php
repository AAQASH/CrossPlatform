<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$_SESSION["edit_id"] = $edit_id;
	$error = 0;
	

	/* SELECT INFORMATION BY EDIT_ID */
	if($edit_id > 0){
		$stmt = $db->query('select * from mts_contactus where contactus_id = ?', $edit_id);
		$data = $stmt->fetch();
		if(count($data) > 0){
			extract($data);
			unset($data);
		}
	}
	
	if( is_array($_POST) && sizeof($_POST) > 0 ){
		$validator->addValidation("subject","req","Please enter your subject.");
		$validator->addValidation("description","req","Please enter your comment.");
		if($validator->ValidateForm()){
			$data["contactus_id_fk"] = $edit_id;
			$data["subject"] = $input->post('subject');
			$data["message"] = $_POST['description'];
			$data["added_datetime"] = date("Y-m-d H:i:s");
			
			/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
			if($edit_id > 0){
				
//				## SEND CONTACTUS REPLY EMAIL ##
//				$mail->addTo( $email, "" );
//				$mail->setSubject( $input->post('subject') );
//				$mail->setBodyHtml( $_POST['description'] );
//				$mail->send();
				
				$db->insert('mts_contactus_reply', $data);
				$message = "Reply sent successfully.";
				Message::setMessage($message, 'SUCCESS');
			}//IF
			
			redirect("contact-us-list.php", $_SERVER['QUERY_STRING']);
			
		} else {
			$message .= "Please enter value in required fields.";
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				$message .= "<p>$inpname : $inp_err</p>\n";
			}
			Message::setMessage($message, 'ERROR');
		}//IF
	}//IF
	
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/ckeditor/ckeditor.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jstree/_lib/jquery.cookie.js";
$javascript[] = SITEROOTADMIN. "/templates/js/custom_grid_plugin.1.0.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOTADMIN. "/reports/js/contactus-reply.js";
$javascript[] = SITEROOTADMIN. "/reports/js/contactus-reply-list.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Contact Us Reply</h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='contact-us-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="contact_us_reply" id="contact_us_reply" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td><label for="first_name">First Name:</label></td>
                <td><?php echo $first_name?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="last_name">Last Name:</label></td>
                <td><?php echo $last_name?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="email">Email:</label></td>
                <td><?php echo $email?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><label for="address">Address:</label></td>
                <td><?php echo $address?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="phone_no">Phone No:</label></td>
                <td><?php echo $phone_no?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><label for="address">User Comments:</label></td>
                <td><?php echo $comments?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><label for="subject">Subject: *</label></td>
                <td><input type="text" name="subject" id="subject" size="70" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><label for="address">Message:<span class="error">*</span></label></td>
                <td><textarea cols="80" id="description" name="description" rows="10"><?php echo $description?></textarea>
                  <div class="error" id="error_description"></div>
                  <div><small>(Please enter 1000 characters only.)</small></div></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Send Contact Us Reply " class="btn btn-primary" /></td>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="clr"></div>
        </div>
      </form>
    </div>
  </div>
  <div id="contactus-reply-list">

    <?php include_once("admin/reports/ajax/contactus-reply-list.php") ?>
  </div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
