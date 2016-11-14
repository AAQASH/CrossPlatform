<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");
	
	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "newsletter_sc_id");
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
			if(is_array($arr_ids) && sizeof($arr_ids) > 0){
				$db->delete('mts_newsletter_subscriber', "newsletter_sc_id in (".$ids.")");
				$message = "Total of ".sizeof($arr_ids)." record(s) were successfully deleted";
				Message::setMessage($message, 'SUCCESS');
			}//if
		break;
		case "unsubscribe":
			if(is_array($arr_ids) && sizeof($arr_ids) > 0){
				$data = array();
				$data['subscriber_status'] = 'Unsubscribed';
				$db->update('mts_newsletter_subscriber', $data, "newsletter_sc_id in (".$ids.")");
				$message = "Total of ".sizeof($arr_ids)." record(s) were successfully unsubscribed";
				Message::setMessage($message, 'SUCCESS');
			}//if
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['newsletter_sc_id']) > 0){
		$grid->andCondition("mts_newsletter_sc_id like '%".$input->post('newsletter_sc_id')."%'");
	}
	if(strlen($_REQUEST['subscriber_email']) > 0){
		$grid->andCondition("mts_newsletter_subscriber.subscriber_email like '%".$input->post('subscriber_email')."%'");
	}
	if(strlen($_REQUEST['subscriber_type']) > 0){
		$grid->andCondition("mts_newsletter_subscriber.subscriber_type like '%".$input->post('subscriber_type')."%'");
	}
	if(strlen($_REQUEST['firstname']) > 0){
		$grid->andCondition("mts_user.firstname like '%".$input->post('firstname')."%'");
	}
	if(strlen($_REQUEST['lastname']) > 0){
		$grid->andCondition("mts_user.lastname like '%".$input->post('lastname')."%'");
	}
	if(strlen($_REQUEST['subscriber_status']) > 0){
		$grid->andCondition("mts_newsletter_subscriber.subscriber_status like '%".$input->post('subscriber_status')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	
	/* SEARCH QUERY */
	$select = "SQL_CALC_FOUND_ROWS mts_newsletter_subscriber.*, mts_user.firstname, mts_user.lastname";
	$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
	$grid->select($select)->from('mts_newsletter_subscriber')->leftjoin('mts_user')->on('mts_user.UID=mts_newsletter_subscriber.UID')->where(1)->orderby($order_by)->limit();
	$row = $grid->query();
	$grid->SQL;
	
	/* GENERATE PAGINATION */
	$pager = new PS_Pagination($grid);
	$pager->paginate();
	
	
?>
<div>
  <form name="grid" id="grid">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table">
      <tr>
        <td><div class="page-header">
<div class="fl">
  <h1><small>Newsletter Subscriber List</small></h1>
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
          <th style="cursor:pointer;" abbr="newsletter_sc_id">&nbsp;</th>
          <th style="cursor:pointer;" abbr="newsletter_sc_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="subscriber_email"><div>Email</div></th>
          <th style="cursor:pointer;" abbr="subscriber_type"><div>Type</div></th>
          <th style="cursor:pointer;" abbr="firstname"><div>First Name</div></th>
          <th style="cursor:pointer;" abbr="lastname"><div>Last Name</div></th>
          <th style="cursor:pointer;" abbr="subscriber_status"><div>Status</div></th>
        </tr>
        <tr class="search">
          <td><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="newsletter_sc_id" id="newsletter_sc_id" value="<?php echo stripslashes($_REQUEST['newsletter_sc_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="subscriber_email" id="subscriber_email" value="<?php echo stripslashes($_REQUEST['subscriber_email']); ?>" /></td>
          <td><input class="form-control" type="text" name="subscriber_type" id="subscriber_type" value="<?php echo stripslashes($_REQUEST['subscriber_type']); ?>" /></td>
          <td><input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo stripslashes($_REQUEST['firstname']); ?>" /></td>
          <td><input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo stripslashes($_REQUEST['lastname']); ?>" /></td>
          <td><input class="form-control" type="text" name="subscriber_status" id="subscriber_status" value="<?php echo stripslashes($_REQUEST['subscriber_status']); ?>" /></td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["newsletter_sc_id"]?>" /></td>
          <td><?php echo $row[$i]["newsletter_sc_id"]; ?></td>
          <td><?php echo $row[$i]["subscriber_email"]; ?></td>
          <td><?php echo $row[$i]["subscriber_type"]; ?></td>
          <td><?php echo (strlen($row[$i]["firstname"]) > 0 ? $row[$i]["firstname"] : '---') ; ?></td>
          <td><?php echo (strlen($row[$i]["lastname"]) > 0 ? $row[$i]["lastname"] : '---') ; ?></td>
          <td><?php echo $row[$i]["subscriber_status"]; ?></td>
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
                  <option value="unsubscribe">Unsubscribe</option>
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
