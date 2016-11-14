<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "UID");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");
	$user_ids = array();
	
	
	/* COLLECT USER IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$user_ids = $_POST['id'];
		$ids = implode(",", $user_ids);
	}//if
	
	
	/* CODE WILL PERFORM FOLLOWING ACTIONS
	 * 1. DELETE
	 * 2. ACTIVE
	 * 3. INACTIVE
	 */
	switch($_POST["action"]){
		case "delete":
			try{
				if(is_array($user_ids) && sizeof($user_ids) > 0){
					$cnt = sizeof($user_ids);
					for($i=0; $i < $cnt; $i++){
						$f = new file;
						$f->delete_dir(ABSPATH.'/uploads/user/'.$user_ids[$i]);
					}
					$db->delete('mts_user', "UID in (".$ids.")");
					$message = "Total of {$cnt} record(s) were successfully deleted";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "active":
			try{
				if(is_array($user_ids) && sizeof($user_ids) > 0){
					$data['is_active'] = 1;
					$db->update('mts_user', $data, "UID in (".$ids.")");
					$message = "Total of ".sizeof($user_ids)." record(s) were successfully activated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
		case "inactive":
			try{
				if(is_array($user_ids) && sizeof($user_ids) > 0){
					$data['is_active'] = 0;
					$db->update('mts_user', $data, "UID in (".$ids.")");
					$message = "Total of ".sizeof($user_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['UID']) > 0){
		$grid->andCondition("UID like '%".$input->post('UID')."%'");
	}
	if(strlen($_REQUEST['email']) > 0){
		$grid->andCondition("email like '%".$input->post('email')."%'");
	}
	if(strlen($_REQUEST['firstname']) > 0){
		$grid->andCondition("firstname like '%". $input->post('firstname') ."%'");
	}
	if(strlen($_REQUEST['lastname']) > 0){
		$grid->andCondition("lastname like '%". $input->post('lastname') ."%'");
	}
	if(strlen($_REQUEST['birthdate']) > 0){
		$grid->andCondition("birthdate like '%".$input->post('birthdate')."%'");
	}
	if(strlen($_REQUEST['signupdate']) > 0){
		$grid->andCondition("signupdate like '%".$input->post('signupdate')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_user')->where("account_type_id_fk=3")->orderby($order_by)->limit();
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
              <h1><small>Network Staff List</small></h1>
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
              <input type="button" name="btnaddnew" id="btnaddnew" value=" Add New User " class="btn btn-warning btn-sm" onclick="javascript:location.href='staff-save.php';" />
            </div>
            <div class="clr"></div>
            </div>
          	<div class="clr"></div>
          </div></td>
      </tr>
    </table>
    <?php echo Message::getMessage(); ?>
    <table width="100%" border="0" id="my_table" class="tblformat">
      <colgroup>
      <col width="23">
      <col width="36">
      <col width="230">
      <col width="100">
      <col width="120">
      <col width="45">
      <col width="70">
      <col width="100">
      <col width="50">
      <col width="20">
      <col width="50">
      </colgroup>
      <thead>
        <tr>
          <th style="cursor:pointer;">&nbsp;</th>
          <th style="cursor:pointer;" abbr="UID"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="email"><div>Email</div></th>
          <th style="cursor:pointer;" abbr="firstname"><div>First Name</div></th>
          <th style="cursor:pointer;" abbr="lastname"><div>Last Name</div></th>
          <th style="cursor:pointer;" abbr="is_active"><div>Active</div></th>
          <th style="cursor:pointer;" abbr="birthdate"><div>Birth Date</div></th>
          <th style="cursor:pointer;" abbr="signupdate"><div>Signup Date</div></th>
          <th style="cursor:pointer;" abbr="is_verified"><div>Verified</div></th>
          <th style="cursor:pointer;" abbr="is_blocked"><div>Block</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="UID" id="UID" value="<?php echo stripslashes($_REQUEST['UID']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="email" id="email" value="<?php echo stripslashes($_REQUEST['email']); ?>" /></td>
          <td><input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo stripslashes($_REQUEST['firstname']) ?>" /></td>
          <td><input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo stripslashes($_REQUEST['lastname']) ?>" /></td>
          <td><select class="form-control" name="is_active" id="is_active">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['is_active'] == '1' ? 'selected="selected"' : "");?>>Active</option>
              <option value="0" <?php echo ($_REQUEST['is_active'] == '0' ? 'selected="selected"' : "");?>>Inactive</option>
            </select></td>
          <td><input class="form-control" type="text" name="birthdate" id="birthdate" value="<?php echo stripslashes($_REQUEST['birthdate']) ?>" size="7" /></td>
          <td><input class="form-control" type="text" name="signupdate" id="signupdate" value="<?php echo stripslashes($_REQUEST['signupdate']) ?>" size="7" /></td>
          <td>&nbsp;</td>
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
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["UID"]?>" /></td>
          <td><?php echo $row[$i]["UID"]; ?></td>
          <td><?php echo $row[$i]["email"]; ?></td>
          <td><?php echo $row[$i]["firstname"]; ?></td>
          <td><?php echo $row[$i]["lastname"]; ?></td>
          <td align="left"><?php echo ($row[$i]["is_active"] == 1 ? "Active" : "Inactive");?></td>
          <td><?php echo $row[$i]["birthdate"]; ?></td>
          <td><?php echo $row[$i]["signupdate"]; ?></td>
          <td align="center"><?php echo ((int)$row[$i]["is_verified"] == "1" ? "Yes" : "No"); ?></td>
          <td><?php
			  if((int)$row[$i]['is_blocked'] > 0){
				  echo '<a href="javascript:void(0);" onclick="unblockUser('.$row[$i]["UID"].');">Unblock</a>';
			  }else{
				  echo '<a href="javascript:void(0);" onclick="blockUser('.$row[$i]["UID"].')">Block</a>';
			  }
              ?></td>
          <td><a href="addressbook-list.php?UID=<?php echo $row[$i]['UID']; ?>&is_admin=no" title="Manage Addresses"><span class="glyphicon glyphicon-home"></span></a>&nbsp; 
          <a href="<?php echo SITEROOTADMIN?>/network/staff-save.php?edit_id=<?php echo $row[$i]["UID"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["UID"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="11" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="11" align="left"><div>
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
