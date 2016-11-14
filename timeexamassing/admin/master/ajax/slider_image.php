<?php
	/* INCLUDE REQUIRED FILES */
	include_once("../../bootstrap.php");
	
	/* ASSIGN VALUES TO VERIABLES */
	$type = $input->post('type');
	$action = $input->post('action');
	$edit_id = $input->post('edit_id');

	
	function deleteImage($ID){
		global $hps, $db;
		//$db = $hps->fetchRow($hps->select()->from('homepage_slider_image')->where('hps_image_id=?', $ID));
		$stmt = $db->query('select * from mts_homepage_slider_image where hps_image_id=?', $ID);
		$row = $stmt->fetch();
		@unlink(ABSPATH . "/uploads/slider/". $ID ."/small/". $row['image_name']);
		@unlink(ABSPATH . "/uploads/slider/". $ID ."/". $row['image_name']);
		
		$data["image_name"] = "";
		$where['hps_image_id = ?'] = $ID;
		$db->update('mts_homepage_slider_image', $data, $where);
		
		return true;
	}
	
	switch($type){
		case "delete_image":
			if(deleteImage($edit_id)){
				echo "true";
			} else {
				echo "false";
			}
		break;
	}	
	
?>