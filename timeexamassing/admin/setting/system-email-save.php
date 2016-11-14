<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			//echo $input->post('email_message'); exit;
			if(strlen(trim($input->post("subject"))) < 1){
				$error = 1;
			}
			if($error < 1){
				$data["subject"] = $input->post('subject');
				$data["email_message"] = $input->post('email_message');
				$data["is_active"] = $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where['emailtemplate_id=?'] = $edit_id;
					$db->update('mts_emailtemplate', $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert('mts_emailtemplate', $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("system-email-save.php", $_SERVER['QUERY_STRING']);
				
			} else {
				$message = "Please enter value in required fields.";
				Message::setMessage($message, 'ERROR');
			}//IF
		}//IF
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 

	/* SELECT INFORMATION BY EDIT_ID */
	try{
		if($edit_id > 0){
			$where['emailtemplate_id=?'] = $edit_id;
			//$data = $et->fetchRow($et->select()->from(TABLENAME)->where('emailtemplate_id=?', $edit_id));
			$stmt = $db->query("select * from mts_emailtemplate", $where);
			$data = $stmt->fetch();
			if(count($data) > 0){
				extract($data);
				unset($data);
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/ckeditor/ckeditor.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOTADMIN. "/setting/js/email-template-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save Email Template </h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='systememails-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="addnew_email_template_info" id="addnew_email_template_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td>&nbsp;</td>
                <td colspan="2"><strong class="error">Note:(Please do not edit/modify in [] or [[]] values Example : [[SITETITLE]] OR [SITETITLE]) </strong></td>
              </tr>
              <tr>
                <td width="25%"><label for="subject">Subject:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="subject" type="text" id="subject" value="<?php echo $subject?>" size="50" /></td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><label for="email_message">Message:</label></td>
              </tr>
              <tr>
                <td colspan="3" valign="top"><textarea class="form-control" cols="80" id="email_message" name="email_message" rows="10"><?php echo $email_message?></textarea>
                <div><small>(No characters limit.)</small></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Email Template Information " class="btn btn-primary" /></td>
                <td>&nbsp;</td>
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
