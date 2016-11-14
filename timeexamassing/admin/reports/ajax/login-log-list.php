<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");
	
	$user_ids = array();
	
	
	/* COLLECT USER IDS HERE */
	if(is_array($_POST['id']) && sizeof($_POST['id']) > 0){
		$user_ids = $_POST['id'];
		$ids = implode(",", $user_ids);
	}//if
	
	
	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "login_log_id");
	$_REQUEST["txt_order_type"] = (strlen(trim($_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_order_type"]) : "ASC");	
	
		
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['UID']) > 0){
		$grid->andCondition("mts_user_login_log.UID like '%".$input->post('UID')."%'");
	}
	if(strlen($_REQUEST['firstname']) > 0){
		$grid->andCondition("mts_user_login_log.user_info like '%". $input->post('firstname') ."%'");
	}
	if(strlen($_REQUEST['lastname']) > 0){
		$grid->andCondition("mts_user_login_log.user_info like '%". $input->post('lastname') ."%'");
	}
	if(strlen($_REQUEST['http_user_agent']) > 0){
		$grid->andCondition("mts_user_login_log.http_user_agent like '%".$input->post('http_user_agent')."%'");
	}
	if(strlen($_REQUEST['http_accept_language']) > 0){
		$grid->andCondition("mts_user_login_log.http_accept_language like '%".$input->post('http_accept_language')."%'");
	}
	if(strlen($_REQUEST['server_addr']) > 0){
		$grid->andCondition("mts_user_login_log.server_addr = '".$input->post('server_addr')."'");
	}
	if(strlen($_REQUEST['remote_addr']) > 0){
		$grid->andCondition("mts_user_login_log.remote_addr = '".$input->post('remote_addr')."'");
	}
	if(strlen($_REQUEST['login_at']) > 0){
		$grid->andCondition("mts_user_login_log.login_at = '".$input->post('login_at')."'");
	}
	if(strlen($_REQUEST['logout_at']) > 0){
		$grid->andCondition("mts_user_login_log.logout_at = '".$input->post('logout_at')."'");
	}
	
	
	/* SEARCH QUERY */
	$select = "SQL_CALC_FOUND_ROWS mts_user_login_log.*";
	$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
	$grid->select($select)
		 ->from('mts_user_login_log')
		 ->where("1=1")
		 ->orderby($order_by)->limit();
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
  <h1><small>User Login Log</small></h1>
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
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="my_table" class="tblformat">
      <colgroup>
      <col width="10">
      <col width="50">
      <col width="10">
      <col width="200">
      <col width="10">
      <col width="10">
      <col width="10">
      <col width="10">
      <col width="10">
      </colgroup>
      <thead>
        <tr>
          <th style="cursor:pointer;" abbr="UID"><div>ID</div></th>
          <th style="cursor:pointer;" abbr=""><div>First Name</div></th>
          <th style="cursor:pointer;" abbr=""><div>Last Name</div></th>
          <th style="cursor:pointer;" abbr="http_user_agent"><div>Browser Info</div></th>
          <th style="cursor:pointer;" abbr="http_accept_language"><div>Language</div></th>
          <th style="cursor:pointer;" abbr="server_addr"><div>Server IP</div></th>
          <th style="cursor:pointer;" abbr="remote_addr"><div>IP</div></th>
          <th style="cursor:pointer;" abbr="login_at"><div>Login</div></th>
          <th style="cursor:pointer;" abbr="logout_at"><div>Logout</div></th>
        </tr>
        <tr class="search">
          <td><input class="form-control" type="text" name="UID" id="UID" value="<?php echo stripslashes($_REQUEST['UID']); ?>" size="3" /></td>
          <td>&nbsp;-&nbsp;</td>
          <td>&nbsp;-&nbsp;</td>
          <td><input class="form-control" type="text" name="http_user_agent" id="http_user_agent" value="<?php echo stripslashes($_REQUEST['http_user_agent']) ?>" /></td>
          <td><input class="form-control" type="text" name="http_accept_language" id="http_accept_language" value="<?php echo stripslashes($_REQUEST['http_accept_language']) ?>" /></td>
          <td><input class="form-control" type="text" name="server_addr" id="server_addr" value="<?php echo stripslashes($_REQUEST['server_addr']) ?>" /></td>
          <td><input class="form-control" type="text" name="remote_addr" id="remote_addr" value="<?php echo stripslashes($_REQUEST['remote_addr']) ?>" /></td>
          <td><input class="form-control" type="text" name="login_at" id="login_at" value="<?php echo stripslashes($_REQUEST['login_at']) ?>" /></td>
          <td><input class="form-control" type="text" name="logout_at" id="logout_at" value="<?php echo stripslashes($_REQUEST['logout_at']) ?>" /></td>
        </tr>
      </thead>
      <tbody>
        <?php
	if(sizeof($row) > 0){
		for($i=0; $i < sizeof($row); $i++){
			$user_info = unserialize($row[$i]["user_info"]);
			?>
        <tr>
          <td valign="top"><?php echo $row[$i]["UID"]; ?></td>
          <td valign="top"><?php echo $user_info["firstname"]; ?></td>
          <td valign="top"><?php echo $user_info["lastname"]; ?></td>
          <td valign="top"><?php echo $row[$i]["http_user_agent"];?></td>
          <td valign="top"><?php echo $row[$i]["http_accept_language"]; ?></td>
          <td valign="top"><?php echo $row[$i]["server_addr"]; ?></td>
          <td valign="top"><?php echo $row[$i]["remote_addr"]; ?></td>
          <td valign="top"><?php echo $row[$i]["login_at"]; ?></td>
          <td valign="top"><?php echo $row[$i]["logout_at"]; ?></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="9" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="9" align="left"><div>
              <div class="fl"></div>
              <div class="fr"><?php echo $pager->renderFullNav('setPage'); ?></div>
              <div class="clr"></div>
            </div></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
