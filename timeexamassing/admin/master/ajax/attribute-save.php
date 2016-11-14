<?php

define('TABLENAME', 'tree');
include_once('../../includes.php');
include_once('includes/classes/JSON.php');
include_once('admin/master/Model/Attribute.php');
	
	$input = new input();
	$attribute = new Attribute($db);
	
	$attribute_code = ( strlen(trim($_GET['attribute_code'])) > 0 ? trim($_GET['attribute_code']) : '' );
	$action = ( strlen(trim($_GET['action'])) > 0 ? trim($_GET['action']) : '' );
	$attribute_code = $input->get("attribute_code");
	
	switch($action){
		case "validate_attribute_code":
			
			$row = $attribute->fetchAll($attribute->select()->where($attribute->getAdapter()->quoteInto('attribute_code=?', $attribute_code)));
			if(count($row) > 0){
				$data = false;
			}else{
				$data = true;
			}//if

		break;
	}//switch

$json = new Services_JSON();
$output = $json->encode($data);
echo $output;

?>