<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");
	
	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "address_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");
	$arr_ids = array();
	$uid = $_SESSION['ss_uid'];
	$is_admin = $_SESSION['ss_is_admin'];
	
	
	
	/* COLLECT USER IDS HERE */
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
					$db->delete('mts_address', "address_id in (".$ids.")");
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
					$db->update('mts_address', $data, "address_id in (".$ids.")");
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
					$db->update('mts_address', $data, "address_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['ID']) > 0){
		$grid->andCondition("mts_address.address_id like '%".$input->post('ID')."%'");
	}
	if(strlen($_REQUEST['firstname']) > 0){
		$grid->andCondition("mts_address.firstname like '%".$input->post('firstname')."%'");
	}
	if(strlen($_REQUEST['lastname']) > 0){
		$grid->andCondition("mts_address.lastname like '%".$input->post('lastname')."%'");
	}
	if(strlen($_REQUEST['country_id']) > 0){
		$grid->andCondition("mts_country.country_name like '%". $input->post('country_id') ."%'");
	}
	if(strlen($_REQUEST['state_id']) > 0){
		$grid->andCondition("mts_state.state like '%". $input->post('state_id') ."%'");
	}
	if(strlen($_REQUEST['city_id']) > 0){
		$grid->andCondition("mts_city.city like '%".$input->post('city_id')."%'");
	}
	if(strlen($_REQUEST['zipcode']) > 0){
		$grid->andCondition("mts_address.zipcode like '%".$input->post('zipcode')."%'");
	}
	if(strlen($_REQUEST['phoneno']) > 0){
		$grid->andCondition("mts_address.phoneno like '%".$input->post('phoneno')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("mts_address.is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS mts_address.*, mts_country.country_name, mts_state.state, mts_city.city";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)
				->from('mts_address')
				->leftjoin('mts_country')
				->on('mts_country.country_id=mts_address.country_id_fk')
				->leftjoin('mts_state')
				->on('mts_state.state_id=mts_address.state_id_fk')
				->leftjoin('mts_city')
				->on('mts_city.city_id=mts_address.city_id_fk')
				->where("mts_address.UID={$uid}")
				->orderby($order_by)
				->limit();
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
              <h1><small>Addressbook</small></h1>
            </div>
            <div class="fr" style="margin-top:15px;">
              <div class="fr">
              <input type="hidden" size="1" name="txt_column" id="txt_column" value="<?php echo stripslashes($_REQUEST['txt_column']); ?>"/>
              <input type="hidden" size="1" name="txt_order_type" id="txt_order_type" value="<?php echo stripslashes($_REQUEST['txt_order_type']); ?>"/>
              </div>
              <div class="fr">
			  	<input type="button" class="btn btn-info btn-sm" onclick="javascript:location.href='<?php echo ( $is_admin == 'yes' ? "admin-list.php" : "network-list.php") ?>';" value=" Back " id="btnback" name="btnback">&nbsp;&nbsp;&nbsp;
                <input type="button" name="btn_search" id="btn_search" value="Search" class="btn btn-info btn-sm" />
                &nbsp;
                <input type="reset" name="btn_reset_search" id="btn_reset_search" value="Reset Search" class="btn btn-info btn-sm" />
                &nbsp;
                <input type="button" name="btnaddnew" id="btnaddnew" class="btn btn-info btn-warning btn-sm" value=" Add New Address " onclick="javascript:location.href='addressbook-save.php';" />
              </div>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div></td>
      </tr>
    </table>
    <?php echo Message::getMessage(); ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" id="my_table" class="tblformat">
      <thead>
        <tr>
          <th style="cursor:pointer;">&nbsp;</th>
          <th style="cursor:pointer;" abbr="address_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="firstname"><div>Firstname</div></th>
          <th style="cursor:pointer;" abbr="lastname"><div>Lastname</div></th>
          <th style="cursor:pointer;" abbr="country_id"><div>Country</div></th>
          <th style="cursor:pointer;" abbr="state_id"><div>State</div></th>
          <th style="cursor:pointer;" abbr="city_id"><div>City</div></th>
          <th style="cursor:pointer;" abbr="zipcode"><div>Zipcode</div></th>
          <th style="cursor:pointer;" abbr="phoneno"><div>Phone No</div></th>
          <th style="cursor:pointer;" abbr="is_active"><div>IS Active</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="address_id" id="address_id" value="<?php echo stripslashes($_REQUEST['address_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo stripslashes($_REQUEST['firstname']); ?>" /></td>
          <td><input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo stripslashes($_REQUEST['lastname']) ?>" /></td>
          <td><input class="form-control" type="text" name="country_id" id="country_id" value="<?php echo stripslashes($_REQUEST['country_id']) ?>" /></td>
          <td><input class="form-control" type="text" name="state_id" id="state_id" value="<?php echo stripslashes($_REQUEST['state_id']) ?>" /></td>
          <td><input class="form-control" type="text" name="city_id" id="city_id" value="<?php echo stripslashes($_REQUEST['city_id']) ?>" /></td>
          <td><input type="text" name="zipcode" id="zipcode" value="<?php echo stripslashes($_REQUEST['zipcode']); ?>" size="10" /></td>
          <td><input class="form-control" type="text" name="phoneno" id="phoneno" value="<?php echo stripslashes($_REQUEST['phoneno']); ?>" size="10" /></td>
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
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["address_id"]?>" /></td>
          <td><?php echo $row[$i]["address_id"]; ?></td>
          <td><?php echo $row[$i]["firstname"]; ?></td>
          <td><?php echo $row[$i]["lastname"]; ?></td>
          <td><?php echo $row[$i]["country_name"]; ?></td>
          <td><?php echo $row[$i]["state"]; ?></td>
          <td><?php echo $row[$i]["city"]; ?></td>
          <td><?php echo $row[$i]["zipcode"]; ?></td>
          <td><?php echo $row[$i]["phoneno"]; ?></td>
          <td><?php echo ($row[$i]["is_active"] == 1 ? "Active" : "Inactive");?></td>
          <td><a href="<?php echo SITEROOTADMIN?>/network/addressbook-save.php?edit_id=<?php echo $row[$i]["address_id"]?>"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["address_id"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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
