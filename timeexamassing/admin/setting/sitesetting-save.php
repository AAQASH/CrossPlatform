<?php
include_once('../bootstrap.php');


	/* DEFINE TABLE NAME */
	define('TABLENAME', 'mts_sitesetting');
	define('SELECTED', 'sitesetting-save');
	define('MODULE_NAME', 'Sitesettings');
	

	/* CREATE OBJECTS */
	$input = new input();
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			if(strlen(trim($input->post("value"))) < 1){
				$error = 1;
			}
			if($error < 1){
				//$dbObj->data("value", $input->post('value'));
				$data['value'] = $input->post('value');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where['sitesetting_id=?'] = $edit_id;
					$db->update(TABLENAME, $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert(TABLENAME);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("sitesetting-save.php", $_SERVER['QUERY_STRING']);
				
			} else {
				$message = "Please enter value in required fields.";
				Message::setMessage($message, 'ERROR');
			}//IF
		}//IF
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 

	/* SELECT INFORMATION BY EDIT_ID */
	try{
		if($edit_id > 0){
			$sql_setting = "select * from ".TABLENAME." WHERE sitesetting_id=".$edit_id;
			$stmt = $db->query($sql_setting);
			$row = $stmt->fetch();
			if(is_array($row) && sizeof($row) > 0){
				extract($row);
				unset($row);
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<link rel="stylesheet" href="<?php echo SITEROOT ?>/jquery/development-bundle/themes/base/jquery.ui.all.css">
<link href="<?php echo SITEROOT ?>/templates/<?php echo TEMPLATEDIR ?>/admin/css/adminleftmenu.css" rel="stylesheet" type="text/css" />
<?php
$javascript[] = SITEROOT. "/jquery/development-bundle/ui/jquery.ui.core.js";
$javascript[] = SITEROOT. "/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/<?php echo TEMPLATEDIR?>/admin/setting/js/sitesetting-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save Sitesetting </h3>
        <div class="fr">
          <input type="button" class="btn btn-primary btn-xs" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='sitesetting-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"> <?php echo Message::getMessage(); ?>
	<?php echo Message::getMessage(); ?>
	<form name="sitesetting" id="sitesetting" method="post" enctype="multipart/form-data">
	<input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
	<div>
    	<div class="fl adminRight">
    <table width="100%" border="0" class="form" cellpadding="3" cellspacing="3">
		  
		  <tr>
		    <td width="25%"><label>Type:</label>&nbsp;</td>
		    <td><?php echo $type ?></td>
		    <td width="49%">&nbsp;</td>
      </tr>
		  
		  <tr>
		    <td><label for="value">Value:</label> <span class="error">*</span></td>
		    <td><input type="text" name="value" id="value" value="<?php echo $value ?>" size="40" /></td>
		    <td>&nbsp;</td>
      </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Site Setting Information " class="btn btn-primary" /></td>
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