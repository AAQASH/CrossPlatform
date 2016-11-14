<?php
/* INCLUDE REQUIRED FILES */
if(!defined ('APPLICATION_PATH') ){include_once("../../bootstrap.php");}

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
			if(is_array($arr_ids) && sizeof($arr_ids) > 0){
				$db->delete('mts_contactus', "contactus_id in (".$ids.")");
				$message = "Total of ".sizeof($arr_ids)." record(s) were successfully deleted";
				Message::setMessage($message, 'SUCCESS');
			}//if
		break;
		case "active":
			if(is_array($arr_ids) && sizeof($arr_ids) > 0){
				$data["is_active"] = "1";
				$dbObj->update('mts_contactus', $data, "contactus_id in (".$ids.")");
				$message = "Total of ".sizeof($arr_ids)." record(s) were successfully activated";
				Message::setMessage($message, 'SUCCESS');
			}//if
		break;
		case "inactive":
			if(is_array($arr_ids) && sizeof($arr_ids) > 0){
				$data["is_active"] = "0";
				$dbObj->update('mts_contactus', $data, "contactus_id in (".$ids.")");
				$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
				Message::setMessage($message, 'SUCCESS');
			}//if
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['contactus_id']) > 0){
		$grid->andCondition("contactus_id like '%".$input->post('contactus_id')."%'");
	}
	if(strlen($_REQUEST['first_name']) > 0){
		$grid->andCondition("first_name like '%".$input->post('first_name')."%'");
	}
	if(strlen($_REQUEST['last_name']) > 0){
		$grid->andCondition("last_name like '%".$input->post('last_name')."%'");
	}
	if(strlen($_REQUEST['email']) > 0){
		$grid->andCondition("email like '%".$input->post('email')."%'");
	}
	if(strlen($_REQUEST['address']) > 0){
		$grid->andCondition("address like '%".$input->post('address')."%'");
	}
	if(strlen($_REQUEST['phone_no']) > 0){
		$grid->andCondition("phone_no like '%".$input->post('phone_no')."%'");
	}
	
	/* SEARCH QUERY */
	$select = "SQL_CALC_FOUND_ROWS *";
	$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
	$grid->select($select)->from('mts_contactus')->where(1)->orderby($order_by)->limit();
	$row = $grid->query();
	$grid->SQL;
	
	/* GENERATE PAGINATION */
	$pager->paginate();
	
	
?>
<div>
  <form name="grid" id="grid">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table">
      <tr>
        <td><div class="page-header">
<div class="fl">
  <h1><small>Contact Us</small></h1>
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
          <th style="cursor:pointer;" abbr="contactus_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="first_name"><div>First Name</div></th>
          <th style="cursor:pointer;" abbr="last_name"><div>Last Name</div></th>
          <th style="cursor:pointer;" abbr="email"><div>Email</div></th>
          <th style="cursor:pointer;" abbr="address"><div>Address</div></th>
          <th style="cursor:pointer;" abbr="phone_no"><div>Phone No</div></th>
          <th style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="contactus_id" id="contactus_id" value="<?php echo stripslashes($_REQUEST['contactus_id']); ?>" size="3"/></td>
          <td><input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo stripslashes($_REQUEST['first_name']); ?>"/></td>
          <td><input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo stripslashes($_REQUEST['last_name']); ?>"/></td>
          <td><input class="form-control" type="text" name="email" id="email" value="<?php echo stripslashes($_REQUEST['email']); ?>"/></td>
          <td><input class="form-control" type="text" name="address" id="address" value="<?php echo stripslashes($_REQUEST['address']); ?>"/></td>
          <td><input class="form-control" type="text" name="phone_no" id="phone_no" value="<?php echo stripslashes($_REQUEST['phone_no']); ?>"/></td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["contactus_id"]?>" /></td>
          <td><?php echo $row[$i]["contactus_id"]; ?></td>
          <td><?php echo $row[$i]["first_name"]; ?></td>
          <td><?php echo $row[$i]["last_name"]; ?></td>
          <td><?php echo $row[$i]["email"]; ?></td>
          <td><?php echo $row[$i]["address"]; ?></td>
          <td><?php echo $row[$i]["phone_no"]?></td>
          <td align="center"><a href="<?php echo SITEROOTADMIN?>/reports/contact-us-reply.php?edit_id=<?php echo $row[$i]["contactus_id"]?>" title="Reply"><span class="glyphicon glyphicon-share-alt"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["contactus_id"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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
