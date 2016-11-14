<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			$validator->addValidation("faq_category_id","req","Please select FAQ Category.");
			$validator->addValidation("faq_question","req","Please Enter FAQ Question.");
			$validator->addValidation("faq_answer","req","Please Enter FAQ Answer.");
			if($validator->ValidateForm()){
				$data["faq_category_id_fk"] = $input->post('faq_category_id');
				$data["faq_question"] = $input->post('faq_question');
				$data["faq_answer"] = $input->post('faq_answer');
				$data["is_active"] = $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where["faq_id=?"] = $edit_id;
					$db->update('mts_faq', $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert('mts_faq', $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("faq-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_faq where faq_id=?', $edit_id);
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
$javascript[] = SITEROOTADMIN. "/contents/js/faq-save.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save FAQ </h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='faq-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"> <?php echo Message::getMessage(); ?>
      <form name="save_faq_info" id="save_faq_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="faq_category_id">FAQ Category: <span class="error">*</span></label></td>
                <td><select class="form-control" name="faq_category_id" id="faq_category_id">
                    <option value="">--- Select FAQ Category ---</option>
                    <?php 
						echo $combo->createCombo('mts_faq_category','faq_category_id','category_name',$faq_category_id_fk,"order by category_name","is_active=1");
				?>
                  </select></td>
              </tr>
              <tr>
                <td width="25%"><label for="faq_question">Question: <span class="error">*</span></label></td>
                <td><input class="form-control" name="faq_question" type="text" id="faq_question" size="100" value="<?php echo $faq_question?>"/></td>
              </tr>
              <tr>
                <td width="25%" valign="top"><label for="faq_answer">Answer: <span class="error">*</span></label></td>
                <td><textarea id="faq_answer" name="faq_answer" cols="80" rows="20"><?php echo $faq_answer?></textarea>
                <div><small>(No characters limit.)</small></div>                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save FAQ " class="btn btn-primary" /></td>
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
