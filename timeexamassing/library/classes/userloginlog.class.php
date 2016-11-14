<?php

Class UserLoginLog{
	
	function addnew($UID){
		global $db;

		$stmt = $db->query('select * from user where UID=?', $UID);
		$row = $stmt->fetchAll(); 
			
		if( count($row) > 0){
			$user_info["username"] 		= $row[$i]['username'];
			$user_info["password"] 		= $row[$i]['password'];
			$user_info["firstname"] 	= $row[$i]['firstname'];
			$user_info["lastname"] 		= $row[$i]['lastname'];
			$user_info["birthdate"] 	= $row[$i]['birthdate'];
			$user_info["gender"] 		= $row[$i]['gender'];
			$user_info["userimage"] 	= $row[$i]['userimage'];
			$user_info["verificationdate"] = $row[$i]['verificationdate'];
		}
		
		$data['UID'] = $UID;
		$data['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$data['http_accept_charset'] = $_SERVER['HTTP_ACCEPT_CHARSET'];
		$data['http_accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$data['server_addr'] = $_SERVER['REMOTE_ADDR'];
		$data['remote_addr'] = $_SERVER['SERVER_ADDR'];
		$data['login_at'] = date("Y-m-d H:i:s");
		$data['user_info'] = serialize($user_info);
		$id = $db->insert("user_login_log", $data);
		$_SESSION['UserLoginLogId'] = $id;
	}
	
	function update(){
		global $db;
		if((int)$_SESSION['UserLoginLogId'] > 0){
			$data['logout_at'] = date('Y-m-d H:i:s');
			$where['login_log_id=?'] = $_SESSION['UserLoginLogId'];
			$db->update('user_login_log', $data, $where);
		}
	}
	
}


?>