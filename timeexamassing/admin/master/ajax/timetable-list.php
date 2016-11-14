<?php
/* INCLUDE REQUIRED FILES */
include_once("../../bootstrap.php");
	
	/* SET DEFAULT ASC/DESC ORDER */
	$_REQUEST["txt_column"] = (strlen(trim($_REQUEST["txt_column"])) > 0 ? trim($_REQUEST["txt_column"]) : "TID");
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
					$db->delete('mts_timetable', "TID in (".$ids.")");
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
					$db->update('mts_timetable', $data, "TID in (".$ids.")");
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
					$db->update('mts_timetable', $data, "TID in (".$ids.")");
					$message = "Total of ".sizeof($arr_ids)." record(s) were successfully inactivated";
					Message::setMessage($message, 'SUCCESS');
				}//if
			} catch(Exception $e){$log->saveErrorMessage($e->getMessage());} 
		break;
	}//switch
	
	
	/* SEARCH CONDITION FOR PAGINATION QUERY */
	if(strlen($_REQUEST['TID']) > 0){
		$grid->andCondition("TID like '%".$input->post('TID')."%'");
	}
	if(strlen($_REQUEST['from_time']) > 0){
		$grid->andCondition("from_time like '%".$input->post('from_time')."%'");
	}
	if(strlen($_REQUEST['to_time']) > 0){
		$grid->andCondition("to_time like '%".$input->post('to_time')."%'");
	}
	if(strlen($_REQUEST['room_no']) > 0){
		$grid->andCondition("room_no like '%".$input->post('room_no')."%'");
	}
	if(strlen($_REQUEST['subject']) > 0){
		$grid->andCondition("mts_subject.subject_code like '%".$input->post('subject')."%'");
	}
	if(strlen($_REQUEST['class']) > 0){
		$grid->andCondition("mts_class.class_title like '%".$input->post('class')."%'");
	}
	if(strlen($_REQUEST['is_active']) > 0){
		$grid->andCondition("is_active = '".$input->post('is_active')."'");
	}
	
	/* SEARCH QUERY */
	try{
		$select = "SQL_CALC_FOUND_ROWS *, mts_subject.ID as sid, mts_timetable.is_active as ack";
		$order_by = (strlen(trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"])) > 0 ? trim($_REQUEST["txt_column"]." ".$_REQUEST["txt_order_type"]) : "" );
		$grid->select($select)->from('mts_timetable')
							  ->leftjoin('mts_class')
			                  ->on('mts_class.CID = mts_timetable.class_id')
							  ->leftjoin('mts_subject')
			                  ->on('mts_subject.ID = mts_timetable.subject_id')
							  ->leftjoin('mts_user')
			                  ->on('mts_user.UID = mts_timetable.staff_id')
		                      ->where(1)->orderby($order_by)->limit();
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
  <h1><small>Time Table List</small></h1>
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
    <input type="button" name="btnaddnew" id="btnaddnew"  class="btn btn-warning btn-sm" value=" Add New Time Table " onclick="javascript:location.href='timetable-save.php';" />
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
          <th width="6%" style="cursor:pointer;">&nbsp;</th>
          <th width="6%" style="cursor:pointer;" abbr="TID"><div>ID</div></th>
          <th width="11%" style="cursor:pointer;" abbr="day"><div>Day</div></th>
          <th width="11%" style="cursor:pointer;" abbr="from_time">From Time</th>
          <th width="11%" style="cursor:pointer;" abbr="to_time">To Time</th>
          <th width="11%" style="cursor:pointer;" abbr="subject">Subject</th>
          <th width="11%" style="cursor:pointer;" abbr="room_no">Room No</th>
          <th width="10%" style="cursor:pointer;" abbr="class"><div>Class</div></th>
          <th width="10%" style="cursor:pointer;" abbr="class">Staff</th>
          <th width="8%" style="cursor:pointer;" abbr="is_active"><div>Active/Inactive</div></th>
          <th width="5%" style="cursor:pointer;" abbr=""><div>Action</div></th>
        </tr>
        <tr class="search">
          <td align="center"><input type="checkbox" name="checkall" id="checkall" value="1" /></td>
          <td><input class="form-control" type="text" name="TID" id="TID" value="<?php echo stripslashes($_REQUEST['TID']); ?>" size="3" /></td>
          <td><input class="form-control" type="text" name="day" id="day" value="<?php echo stripslashes($_REQUEST['day']); ?>" /></td>
          <td><input class="form-control" type="text" name="from_time" id="from_time" value="<?php echo stripslashes($_REQUEST['from_time']); ?>" /></td>
          <td><input class="form-control" type="text" name="to_time" id="to_time" value="<?php echo stripslashes($_REQUEST['to_time']); ?>" /></td>
          <td><input class="form-control" type="text" name="subject" id="subject" value="<?php echo stripslashes($_REQUEST['subject']); ?>" /></td>
          <td><input class="form-control" type="text" name="room_no" id="room_no" value="<?php echo stripslashes($_REQUEST['room_no']); ?>" /></td>
          <td><input class="form-control" type="text" name="class" id="class" value="<?php echo stripslashes($_REQUEST['class']); ?>" /></td>
          <td><input class="form-control" type="text" name="class2" id="class2" value="<?php echo stripslashes($_REQUEST['class']); ?>" /></td>
          <td><select class="form-control" name="is_active" id="is_active">
              <option value="">---Select---</option>
              <option value="1" <?php echo ($_REQUEST['ack'] == '1' ? 'selected="selected"' : "");?>>Active</option>
              <option value="0" <?php echo ($_REQUEST['ack'] == '0' ? 'selected="selected"' : "");?>>Inactive</option>
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
          <td align="center"><input type="checkbox" name="id[]" id="id[]" value="<?php echo $row[$i]["TID"]?>" /></td>
          <td><?php echo $row[$i]["TID"]; ?></td>
          <td><?php echo $row[$i]["day"]; ?></td>
          <td><?php echo $row[$i]["from_time"]; ?></td>
          <td><?php echo $row[$i]["to_time"]; ?></td>
          <td><?php echo $row[$i]["subject_code"]; ?></td>
          <td><?php echo $row[$i]["room_no"]; ?></td>
          <td><?php echo $row[$i]["class_title"]; ?></td>
          <td><?php echo $row[$i]["firstname"].' '.$row[$i]["lastname"]; ?></td>
          <td><?php echo ($row[$i]["ack"] == 1 ? "Active" : "Inactive");?></td>
          <td align="center"><a href="<?php echo SITEROOTADMIN?>/master/timetable-save.php?edit_id=<?php echo $row[$i]["TID"]?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;<a href="javascript:void(0);" class="delete" id="<?php echo $row[$i]["class"]?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
        <?php
		}//while
	}else{ ?>
        <tr>
          <td colspan="12" align="center" class="listisempty">List is empty.</td>
        </tr>
        <?php
	}//if
	?>
        <tr>
          <td colspan="12" align="left"><div>
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
