<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			$validator->addValidation("subject","req","Please enter subject name.");
			$validator->addValidation("subject_code","req","Please enter subject code.");
			
			if($validator->ValidateForm()){
				$data["subject"] = $input->post('subject');
				$data["subject_code"] = strtoupper($input->post('subject_code'));
				$data["is_active"] = $input->post('is_active');
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$db->update('mts_subject', $data, "ID=". $edit_id);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert('mts_subject', $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("subject-save.php", $_SERVER['QUERY_STRING']);
				
			} else {
				$message .= "Please enter value in required fields.";
				$error_hash = $validator->GetErrors();
				foreach($error_hash as $inpname => $inp_err){
					$message .= "<p>$inpname : $inp_err</p>\n";
				}
				Message::setMessage($message, 'ERROR');
			}//IF
		}//IF
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 

	/* SELECT INFORMATION BY EDIT_ID */
	try{
		if($edit_id > 0){
			$stmt = $db->query('select * from mts_subject where ID=?', $edit_id);
			$data = $stmt->fetch();
			if(count($data) > 0){
				extract($data);
				unset($data);
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<link rel="stylesheet" href="<?php echo SITEROOT ?>/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.css">
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
//$javascript[] = SITEROOTADMIN. "/master/js/subject-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save Subject </h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='subject-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"> <?php echo Message::getMessage(); ?>
      <form name="save_country_info" id="save_country_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="subject">Subject: <span class="error">*</span></label></td>
                <td><input class="form-control" name="subject" type="text" id="subject" value="<?php echo $subject?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="country_iso_code_2">Subject Code : <span class="error">*</span></label></td>
                <td><input class="form-control" name="subject_code" type="text" id="subject_code" value="<?php echo $subject_code?>" size="50" />
                  &nbsp;(Allowed 4 characters only)</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Subject " class="btn btn-primary" /></td>
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
