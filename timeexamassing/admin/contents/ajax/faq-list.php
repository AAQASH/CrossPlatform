<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");
	
	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "faq_id");
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
					$db->delete('mts_faq', "faq_id in (".$ids.")");
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
					$db->update('mts_faq', $data, "faq_id in (".$ids.")");
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
					$db->update('mts_faq', $data, "faq_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['faq_id']) > 0){
		$grid->andCondition("faq_id like '%".$input->post('faq_id')."%'");
	}
	if(strlen($_REQUEST['category_name']) > 0){
		$grid->andCondition("category_name like '%".$input->post('category_name')."%'");
	}
	if(strlen($_REQUEST['faq_question']) > 0){
		$grid->andCondition("faq_question like '%".$input->post('faq_question')."%'");
	}
	if(strlen($_REQUEST['faq_answer']) > 0){
		$grid->andCondition("faq_answer like '%".$input->post('faq_answer')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS mts_faq.*, mts_faq_category.category_name";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_faq')->leftjoin("mts_faq_category")->on("mts_faq_category.faq_category_id=mts_faq.faq_category_id_fk")->where(1)->orderby($order_by)->limit();
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
  <h1><small>FAQ List</small></h1>
</div>
<div class="fr" style="margin-top:15px;">
  <div class="fr">
<input type="hidden" size="1" name="txt_column" id="txt_column" value="<?php echo stripcslashes($_REQUEST['txt_column']); ?>"/>
              <input type="hidden" size="1" name="txt_order_type" id="txt_order_type" value="<?php echo stripcslashes($_REQUEST['txt_order_type']); ?>"/>
  </div>
  <div class="fr">
	<input type="button" name="btn_search" id="btn_search" value="Search" class="btn btn-info btn-sm" />
	&nbsp;
	<input type="reset" name="btn_reset_search" id="btn_reset_search" value="Reset Search" class="btn btn-info btn-sm" />
	&nbsp;
    <input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New FAQ " onclick="javascript:location.href='faq-save.php';" />
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
          <th width="5%" style="cursor:pointer;">&nbsp;</th>
          <th width="5%" style="cursor:pointer;" abbr="faq_id"><div>ID</div></th>
          <th width="25%" style="cursor:pointer;" abbr="category_name"><div>Category</div></th>
          <th width="25%" style="cursor:pointer;" abbr="faq_question"><div>Question</div></th>
          <th width="25%" style="cursor:pointer;" abbr="faq_answer"><div>Answer</div></th>
          <th width="10%" style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th width="10%" style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="faq_id" id="faq_id" value="<?php echo stripcslashes($_REQUEST['faq_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="category_name" id="category_name" value="<?php echo stripcslashes($_REQUEST['category_name']); ?>" /></td>
          <td><input class="form-control" type="text" name="faq_question" id="faq_question" value="<?php echo stripcslashes($_REQUEST['faq_question']); ?>" /></td>
          <td><input class="form-control" type="text" name="faq_answer" id="faq_answer" value="<?php echo stripcslashes($_REQUEST['faq_answer']); ?>" /></td>
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
          <td align="center" valign="top"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["faq_id"]?>" /></td>
          <td valign="top"><?php echo $row[$i]["faq_id"]; ?></td>
          <td valign="top"><?php echo $row[$i]["category_name"]; ?></td>
          <td valign="top"><?php echo $row[$i]["faq_question"]; ?></td>
          <td valign="top"><?php echo substr($row[$i]["faq_answer"], 0, 50)."..."; ?></td>
          <td><?php echo ($row[$i]["is_active"] == 1 ? "Active" : "Inactive");?></td>
          <td align="center"><a href="<?php echo SITEROOTADMIN?>/contents/faq-save.php?edit_id=<?php echo $row[$i]["faq_id"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["faq_id"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="7" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="7" align="left"><div>
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
