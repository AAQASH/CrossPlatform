<?php
/* INCLUDE REQUIRED FILES */
if(!defined ('APPLICATION_PATH') ){include_once("../../bootstrap.php");}

	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "contactus_reply_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");

	$edit_id = (int)$_SESSION["edit_id"];
	
	/* COLLECT USER IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$user_ids = $_POST['id'];
		$ids = implode(",", $user_ids);
	}//if
	
	
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['subject']) > 0){
		$grid->andCondition("subject like '%".$input->post('subject')."%'");
	}
	if(strlen($_REQUEST['message']) > 0){
		$grid->andCondition("message like '%".$input->post('message')."%'");
	}
	if(strlen($_REQUEST['added_datetime']) > 0){
		$grid->andCondition("added_datetime like '%". $input->post('added_datetime') ."%'");
	}

	
	
	/* SEARCH QUERY */
	$select = "SQL_CALC_FOUND_ROWS *";
	$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
	$grid->select($select)->from("mts_contactus_reply")->where("1 AND contactus_id_fk=".$edit_id)->orderby($order_by)->limit();
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
		<td>
        <div class="page-header">
<div class="fl">
  <h1><small>Contact-Us Reply List</small></h1>
</div>
<div class="fr" style="margin-top:15px;">
  <div class="fr">
            <input type="hidden" size="1" name="edit_id" id="edit_id" value="<?php echo stripslashes($edit_id); ?>"/>
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
</div>		
		</td>
	  </tr>
	</table>
	<?php echo Message::getMessage(); ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table" class="tblformat">
    <colgroup>
        <col width="23">
        <col width="100">
        <col width="230">
        <col width="50">
    </colgroup>
    <thead>
      <tr>
        <th style="cursor:pointer;" abbr="contactus_reply_id"><div>ID</div></th>
        <th style="cursor:pointer;" abbr="subject"><div>Subject</div></th>
		<th style="cursor:pointer;" abbr="message"><div>Message</div></th>
		<th style="cursor:pointer;" abbr="added_datetime"><div>Added Date</div></th>
        </tr>
      <tr class="search">
        <td>&nbsp;</td>
        <td><input class="form-control" type="text" name="subject" id="subject" value="<?php echo stripslashes($_REQUEST['subject']); ?>" /></td>
        <td><input class="form-control" type="text" name="message" id="message" value="<?php echo stripslashes($_REQUEST['message']) ?>" /></td>
        <td><input class="form-control" type="text" name="added_datetime" id="added_datetime" value="<?php echo stripslashes($_REQUEST['added_datetime']) ?>" /></td>
        </tr>	  
	</thead>
	<tbody>
    <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			?>
			<tr>
			  <td valign="top"><?php echo $row[$i]["contactus_reply_id"]; ?></td>
			  <td valign="top"><?php echo $row[$i]["subject"]; ?></td>
			  <td valign="top"><?php echo $row[$i]["message"]; ?></td>
			  <td valign="top"><?php echo $row[$i]["added_datetime"]; ?></td>
		    </tr><?php
		}//while
	}else{ ?>
		<tr>
		  <td colspan="4" align="center" class="listisempty">List is empty.</td>
	    </tr> <?php
	}//if
	?>
    <tr>
      <td align="left">&nbsp;</td>
	  <td colspan="3" align="right"><?php echo $pager->renderFullNav('setPage'); ?></td>
      </tr>
  </tbody>
  </table>
</form>
</div>
