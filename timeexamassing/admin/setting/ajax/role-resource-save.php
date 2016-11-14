<?php
/* INCLUDE REQUIRED FILES */
include_once("../../includes.php");
include_once("includes/classes/input.class.php");
include_once("includes/classes/message.class.php");
include_once("includes/classes/JSON.php");


	# create json object #
	$json = new Services_JSON();
	$input = new input();
	
	
	# declear response array #
	$response = array();
	$role_id = $input->post('role_id');
	$resources = $input->post('resources');
	
	# search if resource is already saved #
	try{
		$userdata["resource_id_fk"] = serialize($resources);
		$where["role_id_fk = ?"] = $role_id;
		$db->update("role_resource", $userdata, $where);
		
		$sql = 'select * from role_resource where role_id_fk=?';
		$row = $db->fetchAll($sql, $role_id);
		
		if(count($row) < 1){
			$data['role_id_fk'] = $role_id;
			$data['resource_id_fk'] = serialize($resources);
			$db->insert("role_resource", $data);
		}
		
		$response["resp_status"] = "success";
		$response["resp_message"] = "Data saved successfully !";
	}catch (Exception $e) {
		$response["resp_status"] = "fail";
		$response["resp_message"] = "Role id is undefined !";
	}
	
	# return json response #
	echo $output = $json->encode($response);