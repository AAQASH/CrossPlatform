<?php
include_once("includes/classes/message.class.php");

	$role_resources = array();

	function isAccessable($resource_name){
		global $db;	
		# account_type_id_fk 1 = admin #
		# return 1 = give all access #
		if($_SESSION['account_type_id_fk'] == 1){
			$returnvalue = 1;
		} else {
			$_role_resource_arr = @unserialize($_SESSION['admin_role_resource']);
			if(is_array($_role_resource_arr) && sizeof($_role_resource_arr) > 0){
			} else {
				$stmt = $db->query("select * from role_resource where role_id_fk= ?", array($_SESSION['account_type_id_fk']));
				$row = $stmt->fetchAll();
				$_role_resource_arr = unserialize($row['resource_id_fk']);
			}
			if(@in_array($resource_name, $_role_resource_arr)){
				$returnvalue = 1;
			} else {
				$returnvalue = 0;
			}
		}
		return $returnvalue;
	}
	
	function redirectUser(){
		$message = "Sorry! you dont have permission to access this module.";
		Message::setMessage($message, 'ERROR');
		redirect(SITEROOT.'/admin/errordocument.php');
		exit;
	}

	function hasChild($parent_id){
		global $db;
		$sql = "SELECT COUNT(1) as count FROM resources WHERE parent_id = ?";
		$result = $db->fetchRow($sql, $parent_id);
		return $result['count'];
	}
	
	function getAllResourcesByRoleId($role_id=0){
		global $db;
		$stmt = $db->query("select * from role_resource where role_id_fk= ?", array($role_id));
		$row = $stmt->fetchAll();
		$return_arr = unserialize($row['resource_id_fk']);
		return $return_arr;
	}
  
	function CategoryTree($list,$parent,$append){
		global $role_resources, $db;
		$list = '<li><a href="'.SITEROOT.'/admin/'.$parent['file_name'].'">'.$parent['title'].'</a>';

		if (hasChild($parent['resource_id'])){
			$append++;
			$list .= "<ul class='child child".$append."'>";
			$_x = "'".implode("','", $role_resources)."'";
			
			$sql = "SELECT * FROM resources WHERE parent_id = ? and resource_name in (".$_x.")";
			$result = $db->fetchAll($sql, $parent['resource_id']);
			for($i=0; $i < sizeof($result); $i++){
				$list .= CategoryTree($list,$result[$i],$append);
			}			
			$list .= "</ul>";
		}
		$list .= '</li>';
		return $list;
	}
	function CategoryList($role_id){
		global $role_resources, $db;
		$list = "";
		
		if($_SESSION['account_type_id_fk'] == 1){
			$sql = "SELECT * FROM resources WHERE (parent_id = 0 OR parent_id IS NULL)";
			$sqlGetResourceName = 'SELECT resource_name FROM resources WHERE 1=1';
			$role_resources = $db->fetchCol($sqlGetResourceName);
		} else {
			$sql_roles = "select * from role_resource where role_id_fk=?";
			$result = $db->fetchAll($sql_roles, $role_id);
			if(sizeof($result) > 0){
				$role_resources = unserialize($result[0]['resource_id_fk']);
			}
			$_x = "'".implode("','", $role_resources)."'";
			$sql = "SELECT * FROM resources WHERE resource_name in (".$_x.") AND (parent_id = 0 OR parent_id IS NULL)";
		}
		
		$resources = $db->fetchAll($sql);
		$mainlist = "<ul class='parent'>";
		for($i=0; $i < sizeof($resources); $i++){
			$mainlist .= CategoryTree($list,$resources[$i],$append = 0);
		}
		$list .= "</ul>";
		return $mainlist;
	}
?>