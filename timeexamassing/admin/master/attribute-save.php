<?php

include_once('../bootstrap.php');

	/* DEFINE TABLE NAME */
	define('TABLENAME', 'attribute');
	define('SELECTED', 'attribute-save');
	define('MODULE_NAME', 'Attribute');
	

	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	
	function saveOptionValue($ID){
		global $input, $_POST, $db, $log;
		try{
			$input_type = $_POST['input_type'];
			if(is_array($_POST['option_value']) && sizeof($_POST['option_value']) > 0 && (int)$ID > 0){
				$size = sizeof($_POST['option_value']);
				for($i=0; $i < $size; $i++){
					$index = ($input_type == 'listbox' ? $i : 0);
					$default = ( strlen(trim($_POST['default'][$index])) > 0 ? trim($_POST['default'][$index]) : "" );
					$value = ( strlen(trim($default)) > 0 ? str_replace("option_", "", $default) : "" );
					$is_default_selected = ( $value == $i ? 1 : 0 );
					//echo $i;
					
					$val = $_POST['option_value'][$i];
					$position = $_POST['position'][$i];
					$data["attribute_id_fk"] = $ID;
					$data["value"] = $input->_clean_input_data($val);
					$data["sort_order"] = $input->_clean_input_data($position);
					$data["is_default_selected"] = $is_default_selected;
					$db->insert("mts_attribute_option_value", $data);
				}//for
			}//if
		} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	}
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			//echo '<pre>'; print_r($_POST); exit;
			$validator = new FormValidator();
			if($edit_id < 1){
				$validator->addValidation("attribute_code","req","Please enter attribute code.");
			}
			if($validator->ValidateForm()){
				//echo 's'; exit;
				$data["entity_type_id_fk"] = $input->post('entity_type_id');
				$data["backend_type"] = $input->post('backend_type');
				$data["frontend_input"] = $input->post('input_type');
				$data["frontend_label"] = $input->post('frontend_label');
				$data["frontend_class"] = $input->post('validation');
				$data["is_global"] = 1;
				$data["is_visible"] = $input->post('is_visible');
				$data["is_required"] = $input->post('values_required');
				$data["is_user_defined"] = 1;
				$data["default_value"] = $input->post('default_value');
				$data["is_searchable"] = 1;
				$data["is_filterable"] = 1;
				$data["is_compareable"] = 1;
				$data["is_unique"] = $input->post('unique_value');
				$data["position"] = 1;
				$data["is_active"] = $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where['attribute_id_fk = ?'] = $edit_id;
					$db->delete("mts_attribute_option_value", $where);
					unset($where);
					saveOptionValue($edit_id);
					
					$where['attribute_id = ?'] = $edit_id;
					$db->update("mts_attribute", $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$data["attribute_code"] = $input->post('attribute_code');
					$db->insert("mts_attribute", $data);
					$id = $db->lastInsertId();
					saveOptionValue($id);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("attribute-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_attribute where attribute_id=?', $edit_id);
			$data = $stmt->fetch();
			if(count($data) > 0){
				extract($data);
				$input_type = $data['frontend_input'];
				$unique_value = $data["is_unique"];
				$values_required = $data['is_required'];
				$validation = $data['frontend_class'];
				unset($data);
			}
			if($input_type == "listbox" || $input_type == "select"){
				$data = $db->fetchAll('select * from mts_attribute_option_value where attribute_id_fk=?', $edit_id);
				//echo '<pre>'; print_r($data);
				if(count($data) > 0){
					for($i=0; $i < count($data); $i++){
						$options[] = $data[$i];
					}//while
				}
			}//if
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	
?>
<?php include_once("admin/templates/header-start.php"); ?>

<link href="<?php echo SITEROOT ?>/admin/css/adminleftmenu.css" rel="stylesheet" type="text/css" />
<?php
$javascript[] = SITEROOT. "/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/admin/master/js/attribute-validation.js";
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
        <h3 class="fl">Save Attribute </h3>
        <div class="fr">
          <input type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='attribute-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="save_attribute_info" id="save_attribute_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class="">
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="attribute_code">Attribute code: <span class="error">*</span></label></td>
                <td><input class="form-control" type="text" name="attribute_code" id="attribute_code" size="50" maxlength="32" value="<?php echo $attribute_code?>" 
			<?php echo ($edit_id > 0 ? "disabled=\"disabled\"" : ""); ?>  /></td>
                <td width="49%">&nbsp;</td>
              </tr>
              <tr>
                <td><label for="frontend_label">Frontend Label:</label></td>
                <td><input class="form-control" type="text" name="frontend_label" id="frontend_label" size="50" value="<?php echo $frontend_label?>" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr id="tr_input_type">
                <td width="25%"><label for="input_type">Input type:</label></td>
                <td><select class="form-control" name="input_type" id="input_type">
                    <option value="text" <?php echo ($input_type == "text" ? "selected=\"selected\"" : "");?>>Text Field</option>
                    <option value="textarea" <?php echo ($input_type == "textarea" ? "selected=\"selected\"" : "");?>>Text Area</option>
                    <option value="date" <?php echo ($input_type == "date" ? "selected=\"selected\"" : "");?>>Date</option>
                    <option value="yes_no" <?php echo ($input_type == "yes_no" ? "selected=\"selected\"" : "");?>>Yes/No</option>
                    <option value="listbox" <?php echo ($input_type == "listbox" ? "selected=\"selected\"" : "");?>>Multiple Select</option>
                    <option value="select" <?php echo ($input_type == "select" ? "selected=\"selected\"" : "");?>>Dropdown</option>
                    <option value="price" <?php echo ($input_type == "price" ? "selected=\"selected\"" : "");?>>Price</option>
                  </select></td>
                <td>&nbsp;</td>
              </tr>
              <?php
          if( $input_type != 'listbox' && $input_type != 'select'){
			  ?>
              <tr id="tr_default_value">
                <td width="25%" valign="top"><label for="default_value">Default value:</label>
                  <div class="vsmlTxt">(Please enter upto 128 characters.)</div></td>
                <td><input class="form-control" type="text" name="default_value" id="default_value" size="50" value="<?php echo $default_value?>" maxlength="128"/></td>
                <td>&nbsp;</td>
              </tr>
              <?php
		  }
		  ?>
              <tr>
                <td width="25%"><label for="unique_value">Unique value:</label></td>
                <td><select class="form-control" name="unique_value" id="unique_value">
                    <option value="0" <?php echo ($input_type == "0" ? "selected=\"selected\"" : "");?>>No</option>
                    <option value="1" <?php echo ($input_type == "1" ? "selected=\"selected\"" : "");?>>Yes</option>
                  </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="25%"><label for="values_required">Value required:</label></td>
                <td><select class="form-control" name="values_required" id="values_required">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="25%"><label for="validation">Validation:</label></td>
                <td><select class="form-control" name="validation" id="validation">
                    <option value="">None</option>
                    <option value="decimal" <?php echo ($validation == "decimal" ? "selected=\"selected\"" : "");?>>Decimal Number</option>
                    <option value="integer" <?php echo ($validation == "integer" ? "selected=\"selected\"" : "");?>>Intiger Number</option>
                    <option value="email" <?php echo ($validation == "email" ? "selected=\"selected\"" : "");?>>Email</option>
                    <option value="url" <?php echo ($validation == "url" ? "selected=\"selected\"" : "");?>>Url</option>
                    <option value="letters" <?php echo ($validation == "letters" ? "selected=\"selected\"" : "");?>>Letters</option>
                    <option value="alphanumber" <?php echo ($validation == "alphanumber" ? "selected=\"selected\"" : "");?>>Letters (A-Z) or Number (0-9)</option>
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
                <td><input type="checkbox" name="is_visible" id="is_visible" value="1" <?php echo ($is_visible == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_visible">Is Visible</label></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td colspan="2" id="append_options"><?php
				//echo '<pre>'; print_r($options); exit;
		if($input_type == "listbox" || $input_type == "select"){
			if( is_array($options) && sizeof($options) ){
				$size = sizeof($options);
				$type = ( $input_type == 'listbox' ? 'checkbox' : 'radio' );
		?>
                  <table border="0" cellpadding="3" cellspacing="0" id="option_value">
                    <tr>
                      <th align="left">Value</th>
                      <th align="left">Position</th>
                      <th>Is Default</th>
                      <th><a href="javascript:void(0);" id="add_option"><img src="<?php echo SITEROOT ?>/admin/templates/images/add.png" title="Add More" /></a></th>
                    </tr>
                    <?php
              for($i=0; $i < $size; $i++){
			  ?>
                    <tr>
                      <td><input class="form-control" type="text" name="option_value[]" id="option_value[]" size="40" value="<?php echo $options[$i]["value"]?>" /></td>
                      <td><input class="form-control" type="text" name="position[]" id="position[]" size="10" value="<?php echo $options[$i]["sort_order"]?>" /></td>
                      <td align="center"><input class="form-control" type="<?php echo $type; ?>" name="default[]" id="default[]" value="option_<?php echo $i; ?>" 
				<?php echo ( $options[$i]['is_default_selected'] > 0 ? "checked=\"checked\"" : "" ); ?> /></td>
                      <td><a href="javascript:void(0);" class="delete_option" onclick="javascript:deleteOption(this);"><img title="Delete" src="<?php echo SITEROOT ?>/admin/templates/images/trash-icon.gif" /></a></td>
                    </tr>
                    <?php
			  }
			  ?>
                  </table>
                  <script type="text/javascript">
            $("#add_option").click(function(){ addOption(); });
            </script>
                  <?php
			}//if
		}//if    
		?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Attribute " class="submitbutton" /></td>
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
