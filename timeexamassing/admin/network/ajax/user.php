<?php
	/* INCLUDE REQUIRED FILES */
	include_once("../../bootstrap.php");
	
	/* ASSIGN VALUES TO VERIABLES */
	$type = (strlen($_POST['type']) > 0 ? $input->post('type') : $input->get('type'));
	$action = $input->get('action');
	$edit_id = ($input->get('edit_id') > 0 ? $input->get('edit_id') : $input->post('edit_id'));

	
	function deleteImage($UID){
		global $db;
		$networkUserStmt = $db->query('select userimage from mts_user where UID=?', $UID);
		$networkuserRow = $networkUserStmt->fetch();
		$data['userimage'] = '';
		$db->update('mts_user', $data, 'UID='.$UID);
		@unlink(ABSPATH . "/uploads/user/". $UID ."/small/". $networkuserRow['userimage']);
		@unlink(ABSPATH . "/uploads/user/". $UID ."/medium/". $networkuserRow['userimage']);
		@unlink(ABSPATH . "/uploads/user/". $UID ."/large/" . $networkuserRow['userimage']);
		@unlink(ABSPATH . "/uploads/user/". $UID ."/". $networkuserRow['userimage']);
		return true;
	}
	
	switch($type){
		case "validate_username":
			
			$select = $db->select()->from('mts_user', 'UID')->where('username=?', $input->get('username'));
			if($edit_id > 0){
				$select->where('UID!=?', $edit_id);
			}
			$stmt = $select->query();
			$_row = $stmt->fetch();
			if($_row['UID'] > 0){
				echo "false";
			} else {
				echo "true";
			}
		break;
		
		case "validate_email":
			$select = $db->select()->from('mts_user', 'UID')->where("email=?", $input->get('email'));
			if($edit_id > 0){
				$select->where('UID!=?', $edit_id);
			}
			$stmt = $select->query();
			$_row = $stmt->fetch();
			if($_row['UID'] > 0){
				echo "false";
			} else {
				echo "true";
			}
		break;
		case "delete_image":
			if(deleteImage($edit_id)){
				echo "true";
			} else {
				echo "false";
			}
		break;
	}	
	
?>