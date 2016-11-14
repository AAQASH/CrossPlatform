<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "contentpage_id");
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
					$db->delete('mts_contentpage', "contentpage_id in (".$ids.")");
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
					$db->update('mts_contentpage', $data, "contentpage_id in (".$ids.")");
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
					$db->update('mts_contentpage', $data, "contentpage_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['contentpage_id']) > 0){
		$grid->andCondition("contentpage_id like '%".$input->post('contentpage_id')."%'");
	}
	if(strlen($_REQUEST['title']) > 0){
		$grid->andCondition("title like '%".$input->post('title')."%'");
	}
	if(strlen($_REQUEST['urlkey']) > 0){
		$grid->andCondition("urlkey like '%".$input->post('urlkey')."%'");
	}
	if(strlen($_REQUEST['description']) > 0){
		$grid->andCondition("description like '%".$input->post('description')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_contentpage')->where("page_type='post'")->orderby($order_by)->limit();
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
              <h1><small>Content Post List</small></h1>
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
                <input type="button" name="btnaddnew" id="btnaddnew" class="btn btn-warning btn-sm" value=" Addnew Content Post " onclick="javascript:location.href='content-post-save.php';" />
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
      <col width="10" />
      <col width="200" />
      <col width="200" />
      <col width="200" />
      <col width="5" />
      </colgroup>
      <thead>
        <tr>
          <th style="cursor:pointer;" abbr="contentpage_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="title"><div>Title</div></th>
          <th style="cursor:pointer;" abbr="urlkey"><div>Urlkey</div></th>
          <th style="cursor:pointer;" abbr="is_allow_comment"><div>Allow Comment</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td><input class="form-control" type="text" name="contentpage_id" id="contentpage_id" value="<?php echo stripslashes($_REQUEST['contentpage_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="title" id="title" value="<?php echo stripslashes($_REQUEST['title']); ?>" /></td>
          <td><input class="form-control" type="text" name="urlkey" id="urlkey" value="<?php echo stripslashes($_REQUEST['urlkey']); ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td><?php echo $row[$i]["contentpage_id"]; ?></td>
          <td><?php echo $row[$i]["title"]; ?></td>
          <td><?php echo $row[$i]["urlkey"]; ?></td>
          <td><?php echo ((int)$row[$i]["is_allow_comment"] > 0 ? 'Yes' : 'No'); ?></td>
          <td><a href="<?php echo SITEROOTADMIN?>/contents/content-post-save.php?edit_id=<?php echo $row[$i]["contentpage_id"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
            <!--&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["contentpage_id"]?>"><img class="delete" id="<?php echo $row[$i]["contentpage_id"]?>" src="<?php echo SITEROOT; ?>/admin/images/trash-icon.gif" title="Delete" /></a>--></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="5" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="5" align="right"><!--<select name="action" id="action">
	  <option value="">---Select---</option>
	  <option value="active">Active</option>
	  <option value="inactive">InActive</option>
	  </select>&nbsp;<input type="button" name="btnaction" id="btnaction" value="Go" class="smallbutton" />-->
            <?php echo $pager->renderFullNav('setPage'); ?></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
