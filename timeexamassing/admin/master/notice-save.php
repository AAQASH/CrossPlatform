<?php
include_once('../bootstrap.php');

	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){

			$validator = new FormValidator();
			if($edit_id < 1){
				$validator->addValidation("name","req","Please enter name.123");
				$validator->addValidation("description","req","Please enter description.");
				$validator->addValidation("date","req","Please enter date.");
				$validator->addValidation("status","req","Please enter status.");
			}
			if($validator->ValidateForm()){

				$data["name"] 			= $input->post('name');
				$data["description"] 	= $input->post('description');
				$data["date"] 			= $input->post('date');
				$data["status"] 		= $input->post('status');
				$data["is_active"] 		= $input->post('is_active');
				$data["added_date"] 	= date("Y-m-d");
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where['ID = ?'] = $edit_id;
					$db->update("mts_notice", $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
					
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert("mts_notice", $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("notice-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_notice where ID=?', $edit_id);
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
<link rel="stylesheet" href="<?php echo SITEROOT ?>/templates/js/jquery/facebox/src/facebox.css" type="text/css">
<?php
$javascript[] = SITEROOT. "/ckeditor/ckeditor.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOT. "/templates/js/jquery/facebox/src/facebox.js";
$javascript[] = SITEROOTADMIN. "/network/js/user-validation.js";
$javascript[] = SITEROOTADMIN. "/contents/js/content-validation.js";
?>
<style type="text/css">
select, textarea {
	width:325px;
}
</style>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save Notice </h3>
        <div class="fr">
          <input type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='notice-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="save_notice_info" id="save_notice_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="attribute_code">Name: <span class="error">*</span></label></td>
                <td><input class="form-control" type="text" name="name" id="name" size="50" maxlength="32" value="<?php echo $name?>" /></td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td valign="top"><label for="frontend_label">Description:<span class="error">*</span></label></td>
                <td colspan="2">
                <textarea cols="80" id="description" name="description" rows="10"><?php echo $description?></textarea>
                  <div class="error" id="error_description"></div>
                  <div><small>(No characters limit.)</small></div>                </td>
              </tr>
              <tr id="tr_input_type" style="color:#000000">
                <td width="25%" style="color:#000000"><label for="input_type">Date:<span class="error">*</span></label></td>
                <td><input class="form-control" type="text" name="date" id="date" value="<?php echo $date?>" readonly="readonly" style="color:#000000" />
                &nbsp;<small>(yyyy-mm-dd)</small></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="25%"><label for="unique_value">Status:<span class="error">*</span></label></td>
                <td><input class="form-control" type="text" name="status" id="status" size="50" value="<?php echo $status?>" /></td>
                <td>&nbsp;</td>
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
                <td colspan="2" id="append_options">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Notice " class="submitbutton" /></td>
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
