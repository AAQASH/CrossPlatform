<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "sitesetting_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");
	$arr_ids = array();
	
	
	
	/* COLLECT CONTENT IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$arr_ids = $_POST['id'];
		$ids = implode(",", $arr_ids);
	}//if
	
	
	/* CODE WILL PERFORM FOLLOWING ACTIONS
	 * 1. DELETE
	 */
	switch($_POST["action"]){
		case "delete":
			try{
				if(is_array($arr_ids) && sizeof($arr_ids) > 0){
					$ss->delete('mts_sitesetting', "sitesetting_id in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully deleted";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['sitesetting_id']) > 0){
		$grid->andCondition("sitesetting_id like '%".$input->post('sitesetting_id')."%'");
	}
	if(strlen($_REQUEST['type']) > 0){
		$grid->andCondition("type like '%".$input->post('type')."%'");
	}
	if(strlen($_REQUEST['value']) > 0){
		$grid->andCondition("value like '%".$input->post('value')."%'");
	}
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_sitesetting')->where("1")->orderby($order_by)->limit();
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
  <h1><small>Site Setting</small></h1>
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
    <!--<input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New Email Template " onclick="javascript:location.href='system-email-save.php';" />-->
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
          <th style="cursor:pointer;" abbr="sitesetting_id"><div>ID</div></th>
          <th style="cursor:pointer;" abbr="type"><div>Type</div></th>
          <th style="cursor:pointer;" abbr="value"><div>Value</div></th>
        </tr>
        <tr class="search">
          <td><input class="form-control" type="text" name="sitesetting_id" id="sitesetting_id" value="<?php echo stripslashes($_REQUEST['sitesetting_id']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="type" id="type" value="<?php echo stripslashes($_REQUEST['type']); ?>" /></td>
          <td><input class="form-control" type="text" name="value" id="value" value="<?php echo stripslashes($_REQUEST['value']); ?>" /></td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
        <tr>
          <td><?php echo $row[$i]["sitesetting_id"]; ?></td>
          <td><?php echo $row[$i]["type"]; ?></td>
          <td><?php echo $row[$i]["value"]; ?></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="3" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="4" align="left"><div>
              <div class="fl">
                <!--<select name="action" id="action">
	  <option value="">---Select---</option>
	  <option value="delete">Delete</option>
	  </select>&nbsp;<input type="button" name="btnaction" id="btnaction" value="Go" class="smallbutton" />-->
              </div>
              <div class="fr"><?php echo $pager->renderFullNav('setPage'); ?></div>
              <div class="clr"></div>
            </div></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
