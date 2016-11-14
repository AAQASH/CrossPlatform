<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			// $validator->addValidation("class","req","Please enter class name.");
			$validator->addValidation("from_roll_no","req","Please enter from roll no.");
			$validator->addValidation("to_roll_no","req","Please enter to roll no.");
			$validator->addValidation("batch","req","Please enter batch.");
			
			if($validator->ValidateForm()){
				$data["class_id"] 		= $input->post('class_id');
				$data["from_roll_no"] 	= $input->post('from_roll_no');
				$data["to_roll_no"] 	= $input->post('to_roll_no');
				$data["batch"] 			= $input->post('batch');
				$data["is_active"] 		= $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$db->update('mts_practical', $data, "PID=". $edit_id);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert('mts_practical', $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("practical-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_practical where PID=?', $edit_id);
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
        <h3 class="fl">Save Practical </h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='practical-list.php';" />
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
                <td width="25%"><label for="subject">Class: <span class="error">*</span></label></td>
                <td><!--<input class="form-control" name="class" type="text" id="class" value="<?php echo $class?>" size="50" />-->
                <select class="form-control" name="class_id" id="class_id">
                    <option value="">--- Select Class ---</option>
                    <?php 
						echo $combo->createCombo('mts_class','CID','class_title',$class_id,"order by class_title","is_active=1");
			  		?>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="country_iso_code_2">From Roll No : <span class="error">*</span></label></td>
                <td><input class="form-control" name="from_roll_no" type="text" id="from_roll_no" value="<?php echo $from_roll_no?>" size="50" />
                  </td>
              </tr>
              <tr>
                <td><label for="country_iso_code_2">To Roll No : <span class="error">*</span></label></td>
                <td><input class="form-control" name="to_roll_no" type="text" id="to_roll_no" value="<?php echo $to_roll_no?>" size="50" />
                  </td>
              </tr>
              <tr>
                <td><label for="country_iso_code_2">Batch : <span class="error">*</span></label></td>
                <td><input class="form-control" name="batch" type="text" id="batch" value="<?php echo $batch?>" size="50" />
                  </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Practical Batch " class="btn btn-primary" /></td>
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
