<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "hps_image_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");
	$arr_ids = array();
	
	
	/* COLLECT CONTENT IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$arr_ids = $_POST['id'];
		$ids = implode(",", $arr_ids);
	}//if
	
	
	/* CODE WILL PERFORM FOLLOWING ACTIONS
	 * 1. DELETE
	 * 2. ACTIVE
	 * 3. INACTIVE
	 */
	switch($_POST["action"]){
		case "delete":
			try{
				if(is_array($arr_ids) && sizeof($arr_ids) > 0){
					$cnt = sizeof($arr_ids);
					for($i=0; $i < $cnt; $i++){
						$file->delete_dir(ABSPATH.'/uploads/slider/'.$arr_ids[$i]);
					}
					$db->delete('mts_homepage_slider_image', "hps_image_id in (".$ids.")");
					$message = "Total of {$cnt} record(s) were successfully deleted";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "active":
			try{
				if(is_array($arr_ids) && sizeof($arr_ids) > 0){
					$data = array();
					$data['is_active'] = 1;
					$db->update('mts_homepage_slider_image', $data, "hps_image_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully activated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "inactive":
			try{
				if(is_array($arr_ids) && sizeof($arr_ids) > 0){
					$data = array();
					$data['is_active'] = 0;
					$db->update('mts_homepage_slider_image', $data, "hps_image_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['hps_image_id']) > 0){
		$grid->andCondition("hps_image_id like '%".$input->post('hps_image_id')."%'");
	}
	if(strlen($_REQUEST['title']) > 0){
		$grid->andCondition("title like '%".$input->post('title')."%'");
	}
	if(strlen($_REQUEST['description']) > 0){
		$grid->andCondition("description like '%".$input->post('description')."%'");
	}
	if(strlen($_REQUEST['sort_order']) > 0){
		$grid->andCondition("sort_order like '%".$input->post('sort_order')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_homepage_slider_image')->where(1)->orderby($order_by)->limit();
		$row = $grid->query();
		$grid->SQL;
		
		/* GENERATE PAGINATION */
		$pager = new PS_Pagination($grid);
		$pager->paginate();
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	
?>
<div>
  <form name="grid" id="grid">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table">
      <tr>
        <td><div class="page-header">
<div class="fl">
  <h1><small>Home Page Image Slider Image Management</small></h1>
</div>
<div class="fr" style="margin-top:15px;">
  <div class="fr">
              <input type="hidden" size="1" name="txt_column" id="txt_column" value="<?php echo stripslashes($_REQUEST['txt_column']); ?>"/>
              <input type="hidden" size="1" name="txt_order_type" id="txt_order_type" value="<?php echo stripslashes($_REQUEST['txt_order_type']); ?>"/>
  </div>
  <div class="fr">
	<input type="button" name="btn_search" id="btn_search" value="Search" class="btn btn-info btn-sm" />
	&nbsp;
	<input type="reset" name="btn_reset_search" id="btn_reset_search" value="Reset Search" class="btn btn-info btn-sm" />
	&nbsp;
    <input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New Image " onclick="javascript:location.href='home-page-slider-manager-save.php';" />
  </div>
  <div class="clr"></div>
</div>
<div class="clr"></div>
</div></td>
      </tr>
    </table>
    <?php echo Message::getMessage(); ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table" class="tblformat">
      <colgroup>
      <col width="23">
      <col width="36">
      <col width="200">
      <col width="200">
      <col width="200">
      <col width="50">
      <col width="50">
      <col width="50">
      </colgroup>
      <thead>
        <tr>
          <th style="cursor:pointer;">&nbsp;</th>
          <th style="cursor:pointer;" abbr="hps_image_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="image_name"><div>Image Name</div></th>
          <th style="cursor:pointer;" abbr="title"><div>Title</div></th>
          <th style="cursor:pointer;" abbr="description"><div>Description</div></th>
          <th style="cursor:pointer;" abbr="sort_order"><div>Sort Order</div></th>
          <th style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="hps_image_id" id="hps_image_id" value="<?php echo stripslashes($_REQUEST['hps_image_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="image_name" id="image_name" value="<?php echo stripslashes($_REQUEST['image_name']); ?>" /></td>
          <td><input class="form-control" type="text" name="title" id="title" value="<?php echo stripslashes($_REQUEST['title']); ?>" /></td>
          <td><input class="form-control" type="text" name="description" id="description" value="<?php echo stripslashes($_REQUEST['description']); ?>" /></td>
          <td><input class="form-control" type="text" name="sort_order" id="sort_order" value="<?php echo stripslashes($_REQUEST['sort_order']); ?>" /></td>
          <td><select class="form-control" name="is_active" id="is_active">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['is_active'] == '1' ? 'selected="selected"' : "");?>>Active</option>
              <option value="0" <?php echo ($_REQUEST['is_active'] == '0' ? 'selected="selected"' : "");?>>Inactive</option>
            </select></td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["hps_image_id"]?>" /></td>
          <td><?php echo $row[$i]["hps_image_id"]; ?></td>
          <td>
          <?php
				$imagePath = ABSPATH .'/uploads/slider/'. $row[$i]["hps_image_id"] .'/small/'. $row[$i]["image_name"] .'';
				if(is_file($imagePath)){
					echo '<img src="'. SITEROOT .'/uploads/slider/'. $row[$i]["hps_image_id"] .'/small/' .$row[$i]["image_name"]. '" />';
				} else {
					echo '<img src="'. SITEROOT .'/uploads/comingsoon-100X100.png" />';
				}
		  ?>
          
          </td>
          <td><?php echo $row[$i]["title"]; ?></td>
          <td><?php echo $row[$i]["description"]; ?></td>
          <td><?php echo $row[$i]["sort_order"]; ?></td>
          <td><?php echo ($row[$i]["is_active"] == 1 ? "Active" : "Inactive");?></td>
          <td align="center"><a href="<?php echo SITEROOTADMIN?>/master/home-page-slider-manager-save.php?edit_id=<?php echo $row[$i]["hps_image_id"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["hps_image_id"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="8" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="8" align="left"><div>
              <div class="fl">
                <select name="action" id="action">
                  <option value="">---Select---</option>
                  <option value="active">Active</option>
                  <option value="inactive">InActive</option>
                  <option value="delete">Delete</option>
                </select>
                &nbsp;
                <input type="button" name="btnaction" id="btnaction" value="Go" class="btn btn-primary btn-xs" />
              </div>
              <div class="fr"><?php echo $pager->renderFullNav('setPage'); ?></div>
              <div class="clr"></div>
            </div></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
