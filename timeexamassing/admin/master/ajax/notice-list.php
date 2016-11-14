<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "ID");
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
					$db->delete('mts_notice', "ID in (".$ids.")");
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
					$db->update('mts_notice', $data, "ID in (".$ids.")");
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
					$db->update('mts_notice', $data, "ID in (".$ids.")");
					$message = "Total of ".sizeof($list_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['ID']) > 0){
		$grid->andCondition("mts_notice.ID like '%".$input->post('ID')."%'");
	}
	if(strlen($_REQUEST['attribute_code']) > 0){
		$grid->andCondition("mts_notice.name like '%".$input->post('name')."%'");
	}
	if(strlen($_REQUEST['class']) > 0){
		$grid->andCondition("mts_notice.description like '%".$input->post('description')."%'");
	}
	if(strlen($_REQUEST['date']) > 0){
		$grid->andCondition("mts_notice.date like '%".$input->post('date')."%'");
	}
	if(strlen($_REQUEST['status']) > 0){
		$grid->andCondition("mts_notice.status = '".$input->post('status')."'");
	}
	if(strlen($_REQUEST['time']) > 0){
		$grid->andCondition("mts_notice.time = '".$input->post('time')."'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("mts_noticed.is_active = '".$input->post('is_active')."'");
	}

	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS mts_notice.*";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_notice')
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
  <h1><small>Notice List</small></h1>
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
    <input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New Notice " onclick="javascript:location.href='notice-save.php';" />
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
          <th width="7%" style="cursor:pointer;" abbr="ID"><div>ID</div></th>
          <th width="14%" style="cursor:pointer;" abbr="name"><div>Name</div></th>
          <th width="23%" style="cursor:pointer;" abbr="description"><div>Description</div></th>
          <th width="11%" style="cursor:pointer;" abbr="date"><div>Date</div></th>
          <!--<th width="11%" style="cursor:pointer;" abbr="time"><div>Time</div></th>	-->
          <th width="11%" style="cursor:pointer;" abbr="status"><div>Status</div></th>
          <th width="11%" style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th width="5%" style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="ID" id="ID" value="<?php echo stripslashes($_REQUEST['ID']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="name" id="name" value="<?php echo stripslashes($_REQUEST['name']); ?>" /></td>
          <td><input class="form-control" type="text" name="description" id="description" value="<?php echo stripslashes($_REQUEST['description']); ?>" /></td>
          <td><input class="form-control" type="text" name="date" id="date" value="<?php echo stripslashes($_REQUEST['date']); ?>" /></td>
          <!--<td><input class="form-control" type="text" name="time" id="time" value="<?php echo stripslashes($_REQUEST['time']); ?>" /></td>-->
          <td><input class="form-control" type="text" name="status" id="status" value="<?php echo stripslashes($_REQUEST['status']); ?>" /></td>
          <td><input class="form-control" type="text" name="is_active" id="is_active" value="<?php echo stripslashes($_REQUEST['is_active']); ?>" /></td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["ID"]?>" /></td>
          <td><?php echo $row[$i]["ID"]; ?></td>
          <td><?php echo $row[$i]["name"]; ?></td>
          <td><?php echo substr($row[$i]["description"],0,50); ?></td>
          <td><?php echo $row[$i]["date"]; ?></td>
          <!--<td><?php echo $row[$i]['time']; ?></td>-->
          <td><?php echo $row[$i]["status"]; ?></td>
          <td><?php echo ( (int)$row[$i]["is_active"] > 0 ? "Active" : "Inactive" );?></td>
          <td align="center">
          <a href="<?php echo SITEROOTADMIN?>/master/notice-save.php?edit_id=<?php echo $row[$i]["ID"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;
          <a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["ID"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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
