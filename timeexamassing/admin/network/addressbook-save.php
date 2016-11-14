<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$ss_uid = (int)$_SESSION['ss_uid'];
	
	
	function updateDefaultBillingAndShipping($UID, $ID, $column_name){
		global $db;
		$data = array();
		$data[$column_name] = $ID;
		$where["UID = ?"] = $UID; 
		try{
			$db->update('mts_user', $data, $where);
		} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	}//function
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			if($T->Check()) {
				$validator->addValidation("firstname","req","Please enter firstname.");
				$validator->addValidation("lastname","req","Please enter lastname.");
				$validator->addValidation("address1","req","Please enter address1.");
				$validator->addValidation("country_id","req","Please select country.");
				$validator->addValidation("city_id","req","Please select city.");
				$validator->addValidation("zipcode","req","Please enter zipcode.");
				$validator->addValidation("phoneno","req","Please enter phoneno.");
	
				if($validator->ValidateForm()){
					
					$prefix 	= $input->post('prefix'); 
					$firstname 	= $input->post('firstname'); 
					$middlename = $input->post('middlename'); 
					$lastname 	= $input->post('lastname'); 
					$suffix 	= $input->post('suffix'); 
					$address1 	= $input->post('address1'); 
					$address2 	= $input->post('address2'); 
					$country_id = $input->post('country_id'); 
					$state_id 	= $input->post('state_id'); 
					$city_id 	= $input->post('city_id'); 
					$zipcode 	= $input->post('zipcode'); 
					$phoneno 	= $input->post('phoneno'); 
					$faxno 		= $input->post('faxno'); 
					$btnsubmit 	= $input->post('btnsubmit');
					
					$data["UID"] = $ss_uid;
					$data["entity_type_id_fk"] = '1';
					$data["prefix"] = $prefix;
					$data["firstname"] = $firstname;
					$data["middlename"] = $middlename;
					$data["lastname"] = $lastname;
					$data["suffix"] = $suffix;
					$data["address1"] = $address1;
					$data["address2"] = $address2;
					$data["country_id_fk"] = $country_id;
					$data["state_id_fk"] = $state_id;
					$data["city_id_fk"] = $city_id;
					$data["zipcode"] = $zipcode;
					$data["phoneno"] = $phoneno;
					$data["faxno"] = $faxno;
					$data["is_active"] = $_POST['is_active'];
					
					/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
					if($edit_id > 0){
						$where["address_id = ?"] = $edit_id; 
						$db->update('mts_address', $data, $where);
						if( (int)$_POST['default_shipping_id'] > 0 ){
							$default_shipping_id = $edit_id;
						}else{
							$default_shipping_id = 0;
						}
						updateDefaultBillingAndShipping($ss_uid, $default_shipping_id, 'default_shipping_id');
						if( (int)$_POST['default_billing_id'] > 0 ){
							$default_billing_id = $edit_id;
						}else{
							$default_billing_id = 0;
						}
						updateDefaultBillingAndShipping($ss_uid, $default_billing_id, 'default_billing_id');
						//}
						$message = "User information saved successfully.";
						Message::setMessage($message, 'SUCCESS');
					} else {
					/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
						$db->insert('mts_address', $data);
						$id = $db->lastInsertId();
						if( (int)$_POST['default_shipping_id'] > 0 ){
							updateDefaultBillingAndShipping($ss_uid, $id, 'default_shipping_id');
						}
						if( (int)$_POST['default_billing_id'] > 0 ){
							updateDefaultBillingAndShipping($ss_uid, $id, 'default_billing_id');
						}
						$message = "User information saved successfully.";
						Message::setMessage($message, 'SUCCESS');
					}//IF
					
					redirect("addressbook-save.php", $_SERVER['QUERY_STRING']);
					
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
			$select = $db->select();
			//$select->setIntegrityCheck(false);
			$select->from("mts_address as address", array("address.*"));
			$select->join(array("mts_user", "mts_user"), "mts_user.UID=address.UID", array("mts_user.default_billing_id", "mts_user.default_shipping_id"));
			$select->where("address.address_id=?", $edit_id);
			$stmt = $select->query();
			$data = $stmt->fetch();
			
			if(count($data) > 0){
				if( $data['country_id_fk'] > 0 ){
					$selectState = $db->select();
					$selectState->from('mts_state', array('state_id', 'state'));
					$selectState->where('mts_state.country_id_fk=?', $data['country_id_fk']);
					$selectStateStmt = $selectState->query();
					$stateRow = $selectStateStmt->fetch();
					
					if(count($stateRow) > 0){
						$state_name = $stateRow['state'];
						$state_id = $stateRow['state_id'];
					}
				}//if
				if( (int)$data['state_id_fk'] > 0 ){
					$stmt = $db->query('select city_id, city from mts_city where mts_city.state_id_fk=?', (int)$data['state_id_fk']);
					$cityRow = $stmt->fetch();
					if(count($cityRow) > 0){
						$city_name = $cityRow['city'];
						$city_id = $cityRow['city_id'];
					}
				}//if
				if(count($data) > 0){
					extract($data);
					unset($row, $data);
				}
				
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.chainedSelects.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOTADMIN. "/network/js/addressbook-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Addressbook Save</h3>
        <div class="fr">
          <input type="button" class="btn btn-primary btn-xs" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='addressbook-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="save_address_info" id="save_address_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <?php echo $T->protectForm(); ?>
        <div>
          <div>
            <table width="100%" class="form">
              <tr>
                <td width="25%"><label for="prefix">Prefix:</label></td>
                <td><input class="form-control" name="prefix" type="text" id="prefix" value="<?php echo $prefix?>" size="50" maxlength="5" /></td>
              </tr>
              <tr>
                <td><label for="firstname">First Name:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="firstname" type="text" id="firstname" value="<?php echo $firstname?>" size="50" maxlength="32" /></td>
              </tr>
              <tr>
                <td><label for="middlename">Middle Name:</label></td>
                <td><input class="form-control" name="middlename" type="text" id="middlename" value="<?php echo $middlename?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="lastname">Last Name:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="lastname" type="text" id="lastname" value="<?php echo $lastname?>" size="50" maxlength="32" /></td>
              </tr>
              <tr>
                <td><label for="suffix">Suffix:</label></td>
                <td><input class="form-control" name="suffix" type="text" id="suffix" value="<?php echo $suffix?>" size="50" maxlength="5" /></td>
              </tr>
              <tr>
                <td><label for="address1">Address1:&nbsp;<span class="error">*</span></label>
                  <div class="vsmlTxt">(Please enter upto 128 characters.)</div></td>
                <td><input class="form-control" name="address1" type="text" id="address1" value="<?php echo $address1?>" size="60" maxlength="128" /></td>
              </tr>
              <tr>
                <td><label for="address2">Address2:</label>
                  <div class="vsmlTxt">(Please enter upto 128 characters.)</div></td>
                <td><input class="form-control" name="address2" type="text" id="address2" value="<?php echo $address2?>" size="60" maxlength="128" /></td>
              </tr>
              <tr>
                <td><label for="country_id">Country:&nbsp;<span class="error">*</span></label></td>
                <td><select class="form-control" name="country_id" id="country_id">
                    <option value="">--- Select Country ---</option>
                    <?php 
						echo $combo->createCombo('mts_country','country_id','country_name',$country_id_fk,"order by country_name","is_active=1");
			  ?>
                  </select></td>
              </tr>
              <tr>
                <td><label for="state_id">State:&nbsp;<span class="error">*</span></label></td>
                <td><select class="form-control" name="state_id" id="state_id">
                    <option value="">--- Select State ---</option>
                    <?php
					if((int)$country_id_fk > 0){
						echo $combo->createCombo('mts_state','state_id','state',$state_id_fk,"order by state","is_active=1");
					}
			?>
                  </select></td>
              </tr>
              <tr>
                <td><label for="city_id">City:&nbsp;<span class="error">*</span></label></td>
                <td><select class="form-control" name="city_id" id="city_id">
                    <option value="">--- Select City ---</option>
                    <?php
					if((int)$state_id_fk > 0){
						echo $combo->createCombo('mts_city','city_id','city',$city_id_fk,"order by city","is_active=1");
					}
			?>
                  </select></td>
              </tr>
              <tr>
                <td><label for="zipcode">Zip:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="zipcode" type="text" id="zipcode" value="<?php echo $zipcode?>" size="50" maxlength="10" /></td>
              </tr>
              <tr>
                <td><label for="phoneno">Phone:&nbsp;<span class="error">*</span></label></td>
                <td><input class="form-control" name="phoneno" type="text" id="phoneno" value="<?php echo $phoneno?>" size="50" /></td>
              </tr>
              <tr>
                <td><label for="faxno">Fax:</label></td>
                <td><input class="form-control" name="faxno" type="text" id="faxno" value="<?php echo $faxno?>" size="50" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="default_shipping_id" id="default_shipping_id" value="1" <?php echo ($default_shipping_id == $edit_id ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="default_shipping_id">Default Shipping</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="default_billing_id" id="default_billing_id" value="1" <?php echo ($default_billing_id == $edit_id ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="default_billing_id">Default Billing</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Address " class="btn btn-primary" /></td>
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