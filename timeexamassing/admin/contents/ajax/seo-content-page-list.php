<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "seo_id");
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
					$db->delete('mts_seo_content_management', "seo_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully deleted";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "active":
			try{
				if(is_array($arr_ids) && sizeof($arr_ids) > 0){
					$data = array();
					$data['is_active'] = 1;
					$db->update('mts_seo_content_management', "seo_id in (".$ids.")");
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
					$db->update('mts_seo_content_management', "seo_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['seo_id']) > 0){
		$grid->andCondition("seo_id like '%".$input->post('seo_id')."%'");
	}
	if(strlen($_REQUEST['request_uri']) > 0){
		$grid->andCondition("request_uri like '%".$input->post('request_uri')."%'");
	}
	if(strlen($_REQUEST['title']) > 0){
		$grid->andCondition("title like '%".$input->post('title')."%'");
	}
	if(strlen($_REQUEST['meta_description']) > 0){
		$grid->andCondition("meta_description like '%".$input->post('meta_description')."%'");
	}
	if(strlen($_REQUEST['content_type']) > 0){
		$grid->andCondition("content_type = '".$input->post('content_type')."'");
	}
	if(strlen($_REQUEST['meta_keywords']) > 0){
		$grid->andCondition("meta_keywords like '%".$input->post('meta_keywords')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "seo_id DESC" );
		$grid->select($select)->from('mts_seo_content_management')->where(1)->orderby($order_by)->limit();
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
  <h1><small>SEO Content List</small></h1>
</div>
<div class="fr" style="margin-top:15px;">
  <div class="fr">
<input type="hidden" size="1" name="txt_column" id="txt_column" value="<?php echo $_REQUEST['txt_column']; ?>"/>
              <input type="hidden" size="1" name="txt_order_type" id="txt_order_type" value="<?php echo $_REQUEST['txt_order_type']; ?>"/>
  </div>
  <div class="fr">
	<input type="button" name="btn_search" id="btn_search" value="Search" class="btn btn-info btn-sm" />
	&nbsp;
	<input type="reset" name="btn_reset_search" id="btn_reset_search" value="Reset Search" class="btn btn-info btn-sm" />
  </div>
  <div class="clr"></div>
</div>
<div class="clr"></div>
</div></td>
      </tr>
    </table>
    <?php echo Message::getMessage(); ?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table" class="tblformat">
      <thead>
        <tr>
          <th style="cursor:pointer;">&nbsp;</th>
          <th style="cursor:pointer;" abbr="seo_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="request_uri"><div>Request URI</div></th>
          <th style="cursor:pointer;" abbr="content_type"><div>Type</div></th>
          <th style="cursor:pointer;" abbr="title"><div>Title</div></th>
          <th style="cursor:pointer;" abbr="meta_description"><div>Meta Description</div></th>
          <th style="cursor:pointer;" abbr="meta_keywords"><div>Meta Keywords </div></th>
          <th style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="seo_id" id="seo_id" value="<?php echo stripcslashes($_REQUEST['seo_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="request_uri" id="request_uri" value="<?php echo stripcslashes($_REQUEST['request_uri']); ?>" /></td>
          <td><select class="form-control" name="content_type" id="content_type">
              <option value="">---Select---</option>
              <option value="custom" <?php echo ($_REQUEST['content_type'] == 'custom' ? 'selected="selected"' : "");?>>Custom</option>
              <option value="system" <?php echo ($_REQUEST['content_type'] == 'system' ? 'selected="selected"' : "");?>>System</option>
            </select></td>
          <td><input class="form-control" type="text" name="title" id="title" value="<?php echo stripcslashes($_REQUEST['title']); ?>" /></td>
          <td><input class="form-control" type="text" name="meta_description" id="meta_description" value="<?php echo stripcslashes($_REQUEST['meta_description']); ?>" /></td>
          <td><input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?php echo stripcslashes($_REQUEST['meta_keywords']); ?>" /></td>
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
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["seo_id"]?>" /></td>
          <td><?php echo $row[$i]["seo_id"]; ?></td>
          <td><?php echo $row[$i]["request_uri"]; ?></td>
          <td><?php echo ucfirst($row[$i]["content_type"]); ?></td>
          <td><?php echo $row[$i]["title"]; ?></td>
          <td><?php echo substr($row[$i]["meta_description"], 0, 100); ?></td>
          <td><?php echo substr($row[$i]["meta_keywords"], 0, 100); ?></td>
          <td><?php echo ($row[$i]["is_active"] == 1 ? "Active" : "Inactive");?></td>
          <td><a href="<?php echo SITEROOTADMIN?>/contents/seo-content-page-save.php?edit_id=<?php echo $row[$i]["seo_id"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
            <!--<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["seo_id"]?>"><img class="delete" id="<?php echo $row[$i]["seo_id"]?>" src="<?php echo SITEROOT; ?>/admin/images/trash-icon.gif" title="Delete" /></a>--></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="9" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="9" align="left"><div>
              <div class="fl">
                <select name="action" id="action">
                  <option value="">---Select---</option>
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

