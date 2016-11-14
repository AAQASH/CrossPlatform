<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	
	if( is_array($_POST) && sizeof($_POST) > 0 ){
		if($T->Check()) {
			$validator = new FormValidator();
			$validator->addValidation("title","req","Please enter title.");
			if($validator->ValidateForm()){
				$ukg->db_table = 'mts_contentpage';
				$ukg->db_field = 'urlkey';
				$ukg->where_field_name = 'contentpage_id';
				$urlkey_dt = (strlen(trim($input->post('title'))) > 0 ? $input->post('title') : $input->post('title') );
				$ukg->generateUrlKey($urlkey_dt, $edit_id);
				
				$data["urlkey"] = $ukg->urlkey;
				$data["title"] = $input->post('title');
				$data["is_allow_comment"] = (int)$input->post('chkAllowComments');
				$data["page_template_id"] = (int)$input->post('page_template_id');
				$data["description"] = $_POST['description'];
				$data["page_type"] = 'post';
				$data["modified_date"] = date("Y-m-d H:i:s");
				$data["is_active"] = $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$where["contentpage_id=?"] = $edit_id;
					$db->update('mts_contentpage', $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$data["added_date"] = date("Y-m-d H:i:s");
					$db->insert('mts_contentpage', $data);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				
				redirect("content-page-save.php", $_SERVER['QUERY_STRING']);
				
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

	/* SELECT INFORMATION BY EDIT_ID */
	if($edit_id > 0){
		$stmt = $db->query('select * from mts_contentpage where contentpage_id=?', $edit_id);
		$data = $stmt->fetch();
		if(count($data) > 0){
			extract($data);
			unset($data);
		}
	}
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/ckeditor/ckeditor.js";
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOTADMIN. "/contents/js/content-post-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
<div class="box">  <div class="heading"><div class="mainhead">
    <h3 class="fl">Save Content Post </h3>
    <div class="fr">
      <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='content-post-list.php';" />
    </div>
    <div class="clr"></div>
  </div></div>
<div class="content">  <?php echo Message::getMessage(); ?>
  <form name="addnew_content_info" id="addnew_content_info" method="post" enctype="multipart/form-data">
    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
    <?php echo $T->protectForm(); ?>
    <div>
      <div class="">
        <table width="100%" class="form">
          
          <tr>
            <td width="25%"><label for="title">Title:&nbsp;<span class="error">*</span></label></td>
            <td><input class="form-control" name="title" type="text" id="title" value="<?php echo $title?>" size="50" /></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="checkbox" name="chkAllowComments"  value="1" id="chkAllowComments" <?php echo ((int)$is_allow_comment > 0 ? 'checked="checked"' : ''); ?>/>&nbsp;&nbsp;<label for="chkAllowComments">Allow Comments</label></td>
            </tr>
          <tr>
            <td valign="top">Template: </td>
            <td valign="top"><select class="form-control" name="page_template_id" id="page_template_id>">
            <option value="1" <?php echo ($page_template_id == 1 ? "selected=\"selected\"" : "")?>>Default Template</option>
            <option value="2" <?php echo ($page_template_id == 2 ? "selected=\"selected\"" : "")?>>One column, no sidenar</option>
            </select></td>
          </tr>
          <tr>
            <td valign="top"><label for="description">Description:<span class="error">*</span></label></td>
            <td valign="top"><textarea cols="80" id="description" name="description" rows="10"><?php echo $description?></textarea>
              <div class="error" id="error_description"></div>
              <div><small>(No characters limit.)</small></div>              </td>
          </tr>
          <!--<tr>
		    <td>&nbsp; </td>
		    <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />&nbsp;<label for="is_active">Is Active</label></td>
		    <td>&nbsp;</td>
      </tr>-->
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Content Post Information " class="btn btn-primary" /></td>
            </tr>
        </table>
      </div>
      <div class="clr"></div>
    </div>
  </form></div></div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
