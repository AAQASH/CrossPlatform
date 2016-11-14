<?php
	/* INCLUDE REQUIRED FILES */
	include_once("../../bootstrap.php");
	
	
	/* ASSIGN VALUES TO VERIABLES */
	$type = $input->post('type');
	$action = $input->post('action');
	$edit_id = $input->post('edit_id');

	
	switch($type){
		case "validate_faq_category_name":
			
			$select = $db->select()->from('mts_faq_category', 'faq_category_id')->where('category_name=?', $input->post('category_name'));
			if($edit_id > 0){
				$select->where('faq_category_id!=?', $edit_id);
			}
			$stmt = $select->query();
			$_row = $stmt->fetch();
			if($_row['faq_category_id'] > 0){
				echo "false";
			} else {
				echo "true";
			}
		break;
	}	
	
?>