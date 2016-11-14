<?php

Class ErrorLog{

	function __constructor(){}
	
	function saveErrorMessage($errorMessage){
		global $db;
		
		$data['user_id'] = (int)$_SESSION['artm_uid'];
		$data['requested_url'] = $_SERVER['REQUEST_URI'];
		$data['error_message'] = $errorMessage;
		$data['added_on_date'] = date("Y-m-d H:i:s");
		$db->insert("mts_error_log", $data);
	}	
	
}


?>