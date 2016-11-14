<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "attribute_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");
	$list_ids = array();
	
	/* COLLECT CONTENT IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$list_ids = $_POST['id'];
		$ids = implode(",", $list_ids);
	}//if
	
	
	/* CODE WILL PERFORM FOLLOWING ACTIONS
	 * 1. DELETE
	 * 2. ACTIVE
	 * 3. INACTIVE
	 */
	switch($_POST["action"]){
		case "delete":
			try{
				if(is_array($list_ids) && sizeof($list_ids) > 0){
					$db->delete('mts_attribute_option_value', "attribute_id_fk in (".$ids.")" );
					$db->delete('mts_attribute', "attribute_id in (".$ids.")");
					$message = "Total of ".sizeof($list_ids)." record(s) were successfully deleted";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "active":
			try{
				if(is_array($list_ids) && sizeof($list_ids) > 0){
					$data = array();
					$data['is_active'] = 1;
					$db->update('mts_attribute', $data, "attribute_id in (".$ids.")");
					$message = "Total of ".sizeof($list_ids)." record(s) were successfully activated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "inactive":
			try{
				if(is_array($list_ids) && sizeof($list_ids) > 0){
					$data = array();
					$data['is_active'] = 0;
					$db->update('mts_attribute', $data, "attribute_id in (".$ids.")");
					$message = "Total of ".sizeof($list_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['attribute_id']) > 0){
		$grid->andCondition("mts_attribute.attribute_id like '%".$input->post('attribute_id')."%'");
	}
	if(strlen($_REQUEST['attribute_code']) > 0){
		$grid->andCondition("mts_attribute.attribute_code like '%".$input->post('attribute_code')."%'");
	}
	if(strlen($_REQUEST['frontend_input']) > 0){
		$grid->andCondition("mts_attribute.frontend_input like '%".$input->post('frontend_input')."%'");
	}
	if(strlen($_REQUEST['frontend_label']) > 0){
		$grid->andCondition("mts_attribute.frontend_label like '%".$input->post('frontend_label')."%'");
	}
	if(strlen($_REQUEST['is_user_defined']) > 0){
		$grid->andCondition("mts_attribute.is_user_defined = '".$input->post('is_user_defined')."'");
	}
	if(strlen($_REQUEST['is_required']) > 0){
		$grid->andCondition("mts_attribute.is_required = '".$input->post('is_required')."'");
	}
	if(strlen($_REQUEST['is_unique']) > 0){
		$grid->andCondition("mts_attribute.is_unique = '".$input->post('is_unique')."'");
	}
	
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("mts_attribute.is_active = '".$input->post('is_active')."'");
	}
	
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS mts_attribute.*";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_attribute')
			 ->where("1=1")
			 ->orderby($order_by)
			 ->limit();
		$row = $grid->query();
		$grid->SQL;
		
		/* GENERATE PAGINATION */
		$pager->paginate();
	} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
	
?>
<div>
  <form name="grid" id="grid">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table">
      <tr>
        <td><div class="page-header">
<div class="fl">
  <h1><small>Attribute List</small></h1>
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
    <input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New Attribute " onclick="javascript:location.href='attribute-save.php';" />
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
          <th width="7%" style="cursor:pointer;">&nbsp;</th>
          <th width="7%" style="cursor:pointer;" abbr="attribute_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="attribute_code"><div>Attribute Code</div></th>
          <th style="cursor:pointer;" abbr="frontend_input"><div>Frontend Input</div></th>
          <th style="cursor:pointer;" abbr="frontend_label"><div>Frontend Label</div></th>
          <th style="cursor:pointer;" abbr="is_user_defined"><div>Is User Defined</div></th>
          <th style="cursor:pointer;" abbr="is_required"><div>Is Required</div></th>
          <th style="cursor:pointer;" abbr="is_unique"><div>Is Unique</div></th>
          <th width="13%" style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th width="5%" style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="attribute_id" id="attribute_id" value="<?php echo stripslashes($_REQUEST['attribute_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="attribute_code" id="attribute_code" value="<?php echo stripslashes($_REQUEST['attribute_code']); ?>" /></td>
          <td><input class="form-control" type="text" name="frontend_input" id="frontend_input" value="<?php echo stripslashes($_REQUEST['frontend_input']); ?>" /></td>
          <td><input class="form-control" type="text" name="frontend_label" id="frontend_label" value="<?php echo stripslashes($_REQUEST['frontend_label']); ?>" /></td>
          <td><select class="form-control" name="is_user_defined" id="is_user_defined">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['is_user_defined'] == '1' ? 'selected="selected"' : "");?>>Yes</option>
              <option value="0" <?php echo ($_REQUEST['is_user_defined'] == '0' ? 'selected="selected"' : "");?>>No</option>
            </select></td>
          <td><select class="form-control" name="is_required" id="is_required">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['is_required'] == '1' ? 'selected="selected"' : "");?>>Yes</option>
              <option value="0" <?php echo ($_REQUEST['is_required'] == '0' ? 'selected="selected"' : "");?>>No</option>
            </select></td>
          <td><select class="form-control" name="is_unique" id="is_unique">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['is_unique'] == '1' ? 'selected="selected"' : "");?>>Yes</option>
              <option value="0" <?php echo ($_REQUEST['is_unique'] == '0' ? 'selected="selected"' : "");?>>No</option>
            </select></td>
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
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["attribute_id"]?>" /></td>
          <td><?php echo $row[$i]["attribute_id"]; ?></td>
          <td><?php echo $row[$i]["attribute_code"]; ?></td>
          <td><?php echo $row[$i]["frontend_input"]; ?></td>
          <td><?php echo $row[$i]['frontend_label']; ?></td>
          <td><?php echo ( (int)$row[$i]["is_user_defined"] > 0 ? "Yes" : "No" );?></td>
          <td><?php echo ( (int)$row[$i]["is_required"] > 0 ? "Yes" : "No" );?></td>
          <td><?php echo ( (int)$row[$i]["is_unique"] > 0 ? "Yes" : "No" );?></td>
          <td><?php echo ( (int)$row[$i]["is_active"] > 0 ? "Active" : "Inactive" );?></td>
          <td align="center"><a href="<?php echo SITEROOTADMIN?>/master/attribute-save.php?edit_id=<?php echo $row[$i]["attribute_id"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["attribute_id"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="10" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="10" align="left"><div>
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
