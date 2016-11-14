<?php
include_once('../bootstrap.php');
	
	/* ASSIGN GET VALUES */
	$edit_id = ((int)$_GET["edit_id"] > 0 ? (int)$_GET["edit_id"] : 0 );
	$error = 0;
	
	
	function saveImage($name, $ID, $is_default){
		global $hps, $file, $upload, $db, $log;
		try{
			if( (int)$ID > 0 ){
				$file->make_dir(ABSPATH.'/uploads/slider/'.$ID);
				$file->make_dir(ABSPATH.'/uploads/slider/'.$ID."/small");
				
				$file_name = time() ."_". $_FILES[$name]['name'];
				/* START IMAGE UPLOADING */
				$upload->set_max_size(1018463000);
				$upload->set_directory(ABSPATH."/uploads/slider/".$ID);
				$upload->set_tmp_name($_FILES[$name]['tmp_name']);
				$upload->set_file_size($_FILES[$name]['size']);
				$upload->set_file_type($_FILES[$name]['type']);
				$upload->set_file_name($file_name);
				$upload->start_copy();
				$userimage = $upload->user_file_name;
				
				/* START IMAGE RESIZING */
				$upload->set_directory(ABSPATH."/uploads/slider/".$ID."/small");
				$upload->set_thumbnail_name($file_name);
				$upload->create_thumbnail();
				$upload->set_thumbnail_size(100, 100);
				$image_1 = $upload->thumbnail;
				
				$data["image_name"] = $upload->user_file_name;
				$where["hps_image_id = ?"] = $ID;
				$db->update('mts_homepage_slider_image', $data, $where);
			}
		} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	}//end function
	
	try{
		if( is_array($_POST) && sizeof($_POST) > 0 ){
			$validator->addValidation("title","req","Please enter Title.");
			$validator->addValidation("sort_order","req","Please enter Sort Order.");
			if($validator->ValidateForm()){
				$data["title"] = $input->post('title');
				$data["description"] = $input->post('description');
				$data["sort_order"] = $input->post('sort_order');
				$data["is_active"] = $input->post('is_active');
				
				/* IF EDIT_ID > 0 THEN UPDATE USER INFORMATION */
				if($edit_id > 0){
					$ID = $edit_id;
					$where["hps_image_id = ?"] = $edit_id;
					$db->update('mts_homepage_slider_image', $data, $where);
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				} else {
				/* EDIT ID < 1 THEN INSERT NEW INFORMATION */
					$db->insert('mts_homepage_slider_image', $data);
					$ID = $db->lastInsertId();
					$message = "Page information saved successfully.";
					Message::setMessage($message, 'SUCCESS');
				}//IF
				if(strlen($_FILES['image_name']['name']) > 0){
					saveImage('image_name', $ID, 1);
				}
	
				redirect("home-page-slider-manager-save.php", $_SERVER['QUERY_STRING']);
				
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
			$stmt = $db->query('select * from mts_homepage_slider_image where hps_image_id=?', $edit_id);
			$data = $stmt->fetch();
			if(count($data) > 0){
				extract($data);
				unset($data);
			}
		}
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
?>
<?php include_once("admin/templates/header-start.php"); ?>
<link href="<?php echo SITEROOT ?>/templates/<?php echo TEMPLATEDIR ?>/admin/css/adminleftmenu.css" rel="stylesheet" type="text/css" />
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jquery.validate.js";
$javascript[] = SITEROOT. "/templates/js/jquery/additional-methods.js";
$javascript[] = SITEROOTADMIN. "/master/js/home-page-slider-manager-validation.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div class="box">
    <div class="heading">
      <div class="mainhead">
        <h3 class="fl">Save Home Page Image Slider Image</h3>
        <div class="fr">
          <input class="btn btn-primary btn-xs" type="button" name="btnback" id="btnback" value=" Back " onClick="javascript:location.href='home-page-slider-manager-list.php';" />
        </div>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content"><?php echo Message::getMessage(); ?>
      <form name="save_homepage_slider_image_info" id="save_homepage_slider_image_info" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo ($edit_id > 0 ? $edit_id : ""); ?>" />
        <div>
          <div class=""> <?php echo Message::customMessage(WARNING_UPLOAD_MAX_FILESIZE, 'WARNING'); ?>
            <table width="100%" class="form">
              <?php
            if(strlen($image_name) < 1){
                $tr_image_1_uploader = "";
                $tr_image_1_preview = "none";
                $image_1_status = "";
            }else{
                $tr_image_1_uploader = "none";
                $tr_image_1_preview = "";
                $image_1_status = "disabled=\"disabled\"";
            }
            ?>
              <tr id="tr_image_1_uploader" style="display:<?php echo $tr_image_1_uploader?>">
                <td valign="top"><label for="image_name">Image:<span class="error">*</span></label></td>
                <td valign="top"><input name="image_name" type="file" id="image_name" size="50" contenteditable="false"/></td>
              </tr>
              <tr id="tr_image_1_preview" style="display:<?php echo $tr_image_1_preview?>">
                <td valign="top"><label for="image_name">Image:<span class="error">*</span></label></td>
                <td valign="top"><?php if (strlen(trim($image_name)) > 0) : ?>
                  <div>
                    <?php
							$imagePath = ABSPATH .'/uploads/slider/'.$edit_id.'/small/'.$image_name;
							if(is_file($imagePath)){
								echo '<img src="'.SITEROOT.'/uploads/slider/'.$edit_id.'/small/'.$image_name.'" />';
							} else {
								echo '';
							}
					?>
                    <span><a href="javascript:void(0);" onclick="javascript:deleteImage('<?php echo $edit_id; ?>')">Delete</a></span> </div>
                  <?php endif; ?></td>
              </tr>
              <tr>
                <td><label for="title">Title:<span class="error">*</span></label></td>
                <td><input class="form-control" name="title" type="text" id="title" value="<?php echo $title?>" size="50" /></td>
              </tr>
              <tr>
                <td valign="top"><label for="description">Description:</label></td>
                <td><textarea class="form-control" name="description" id="description" cols="50" rows="5"><?php echo $description ?></textarea>
                <div><small>(Please enter 255 characters only.)</small></div></td>
              </tr>
              <tr>
                <td width="25%"><label for="sort_order">Sort Order:<span class="error">*</span></label></td>
                <td><input class="form-control" name="sort_order" type="text" id="sort_order" value="<?php echo $sort_order?>" size="50" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="checkbox" name="is_active" id="is_active" value="1" <?php echo ($is_active == "1" ? "checked=\"checked\"" : "")?> />
                  &nbsp;
                  <label for="is_active">Is Active</label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btnsubmit" id="btnsubmit" value=" Save Home Page Slider Image " class="btn btn-primary" /></td>
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
