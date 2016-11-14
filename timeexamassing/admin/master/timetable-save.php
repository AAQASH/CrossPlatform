<?php

include_once('../bootstrap.php');

	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){

			$validator = new FormValidator();
			if($edit_id < 1){
				$validator->addValidation("day","req","Please enter day.");
				$validator->addValidation("from_time","req","Please enter from time.");
				$validator->addValidation("to_time","req","Please enter to time."); 
				$validator->addValidation("subject","req","Please enter subject.");
				$validator->addValidation("class","req","Please enter class.");
				$validator->addValidation("room_no","req","Please enter room no.");
			}
			if($validator->ValidateForm()){

				$data["day"] 		= $input->post('day');
				$data["from_time"] 	= $input->post('from_time');
				$data["to_time"] 	= $input->post('to_time');
				$data["subject_id"]	= $input->post('subject');
				$data["class_id"] 	= $input->post('class');
				$data["room_no"] 	= $input->post('room_no');
				$data["staff_id"] 	= $input->post('staff_id');
				$data["is_active"] 	= $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where['TID = ?'] = $edit_id;
					$db->update("mts_timetable", $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert("mts_timetable", $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("timetable-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_timetable where TID=?', $edit_id);
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
$javascript[] = SITEROOT. "/templates/js/jquery/jquery-ui-1.11.2/jquery-ui.min.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOT. "/templates/js/jquery/facebox/src/facebox.js";
$javascript[] = SITEROOTADMIN. "/network/js/user-validation.js";
$javascript[] = SITEROOTADMIN. "/network/js/exam-validation.js";
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
        <h3 class="fl">Save Time Table </h3>
        <div class="fr">
          <input type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='timetable-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="save_exam_info" id="save_exam_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="attribute_code">Day: <span class="error">*</span></label></td>
                <td><!--<input class="form-control" type="text" name="exam_type" id="exam_type" size="50" maxlength="32" value="<?php echo $day?>" />-->
                	<select name="day" id="day" class="form-control">
                    	<option value="">--- Select Day ---</option>
                    	<option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                    </select>                </td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td>From Time:*</td>
                <td><input class="form-control" type="text" name="from_time" id="from_time" size="50" maxlength="32" value="<?php echo $from_time?>" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>To Time:*</td>
                <td><input class="form-control" type="text" name="to_time" id="to_time" size="50" maxlength="32" value="<?php echo $to_time?>" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Subject:*</td>
                <td><!--<input class="form-control" type="text" name="exam_type4" id="exam_type4" size="50" maxlength="32" value="<?php echo $subject?>" />-->
                <select class="form-control" name="subject" id="subject">
                    <option value="">--- Select Subject ---</option>
                    <?php 
						echo $combo->createCombo('mts_subject','ID','subject',$subject_id,"order by subject","is_active=1");
			  		?>
                  </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Class:*</td>
                <td><!--<input class="form-control" type="text" name="class2" id="class2" size="50" value="<?php echo $class?>" />-->
                <select class="form-control" name="class" id="class">
                    <option value="">--- Select Class ---</option>
                    <?php 
						echo $combo->createCombo('mts_class','CID','class_title',$class_id,"order by class_title","is_active=1");
			  		?>
                  </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><label for="frontend_label">Room No:<span class="error">*</span></label></td>
                <td><input class="form-control" type="text" name="room_no" id="room_no" size="50" value="<?php echo $room_no?>" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Staff:*</td>
                <td><select class="form-control" name="staff_id" id="staff_id">
                  <option value="">--- Select Staff ---</option>
                  <?php 
						echo $combo->createCombo('mts_user','UID','firstname,lastname',$staff_id,"order by lastname","account_type_id_fk=3");
			  		?>
                </select></td>
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
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Time Table " class="submitbutton" /></td>
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
