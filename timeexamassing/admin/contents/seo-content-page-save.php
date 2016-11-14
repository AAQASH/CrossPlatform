<?php
include_once('../includes.php');
require_once("includes/classes/formvalidator.class.php");
include_once("includes/classes/message.class.php");
include_once("admin/menu/functions.php");
include_once('admin/contents/Model/Seo_Content_Page.php');

	/* DEFINE TABLE NAME */
	define('TABLENAME', 'seo_content_management');
	define('SELECTED', 'seo-content-page-save');
	define('MODULE_NAME', 'SEO_Content_Management');
	
	if(isAccessable(MODULE_NAME) == FALSE){
		redirectUser();
	}

	/* CREATE OBJECTS */
	$seocontentpage = new Seo_Content_Page($db);
	$input = new input();
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	
	if( is_array($_POST) && sizeof($_POST) > 0 ){
		$validator = new FormValidator();
		$validator->addValidation("title","req","Please enter title.");
		if($validator->ValidateForm()){
			
			$data["request_uri"] = $input->post("request_uri");
			$data["content_type"] = $input->post('content_type');
			$data["title"] = $input->post('title');
			$data["meta_description"] = $input->post('meta_description');
			$data["meta_keywords"] = $input->post('meta_keywords');
			$data["is_active"] = $input->post('is_active');
			
			/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
			if($edit_id > 0){
				$where = $seocontentpage->getAdapter()->quoteInto("seo_id=?", $edit_id);
				$seocontentpage->update($data, $where);
				$message = "Page information saved successfully.";
				Message::setMessage($message, 'SUCCESS');
			} else {
			/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
				$seocontentpage->insert($data);
				$message = "Page information saved successfully.";
				Message::setMessage($message, 'SUCCESS');
			}//IF
			
			redirect("seo-content-page-save.php", $_SERVER['QUERY_STRING']);
			
		} else {
			$message .= "Please enter value in required fields.";
			$error_hash = $validator->GetErrors();
			foreach($error_hash as $inpname => $inp_err){
				$message .= "<p>$inpname : $inp_err</p>\n";
			}
			Message::setMessage($message, 'ERROR');
		}//IF
	}//IF

	/* SELECT INFORMATION BY EDIT_ID */
	if($edit_id > 0){
		$data = $seocontentpage->fetchRow($seocontentpage->select()->from(TABLENAME)->where('seo_id=?', $edit_id));
		if(count($data) > 0){
			extract($data->toArray());
			unset($data);
		}
	}
?>
<?php include_once("admin/commonfiles/header-start.php"); ?>
<link href="<?php echo SITEROOT ?>/templates/<?php echo TEMPLATEDIR ?>/admin/css/adminleftmenu.css" rel="stylesheet" type="text/css" />
<?php
$javascript[] = SITEROOT. "/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/admin/contents/js/seo-content-validation.js";
?>
<?php include_once("admin/commonfiles/header-end.php"); ?>
<?php include_once("admin/commonfiles/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save SEO Content </h3>
        <div class="fr">
          <input type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='seo-content-page-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="addnew_content_info" id="addnew_content_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <table width="100%" class="form">
            <tr>
              <td><label for="content_type">Type:</label></td>
              <td><select class="form-control" name="content_type" id="content_type">
                  <option value="custom" selected="selected">Custom</option>
                  <option value="system">System</option>
                  <!--<option value="system">System</option>-->
                </select></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="25%"><label for="urlkey">Request URI:</label></td>
              <td><input class="form-control" name="request_uri" type="text" id="request_uri" value="<?php echo $request_uri?>" size="50" /></td>
              <td width="49%">&nbsp;</td>
            </tr>
            <tr>
              <td><label for="title">Title:&nbsp;<span class="error">*</span></label></td>
              <td><input class="form-control" name="title" type="text" id="title" value="<?php echo $title?>" size="50" maxlength="100" /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><label for="meta_description">Meta Description:</label></td>
              <td valign="top"><textarea name="meta_description" cols="50" rows="5" id="meta_description"><?php echo $meta_description ?></textarea>
              <div><small>(Please enter 255 characters only.)</small></div>
              </td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td valign="top"><label for="meta_keywords">Meta Keywords:</label></td>
              <td valign="top"><textarea name="meta_keywords" cols="50" rows="5" id="meta_keywords"><?php echo $meta_keywords ?></textarea>
              <div><small>(Please enter 255 characters only.)</small></div>
              </td>
              <td valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td><label for="is_active">Is Active:</label></td>
              <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> /></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Content Page Information " class="submitbutton" /></td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <div class="clr"></div>
      </form>
    </div>
  </div>
</div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/commonfiles/footer.php"); ?>
