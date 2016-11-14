<?php
	$role_resources_list = array();

	function hasChild($parent_id){
		global $db;
		$sql = "SELECT COUNT(1) as count FROM resources WHERE parent_id = ?";
		$result = $db->fetchRow($sql, $parent_id);
		
		/*$qry = mysql_query($sql);
		$rs = mysql_fetch_array($qry);*/
		return $result['count'];
	}
	
	function getAllResourcesByRoleId($role_id=0){
		global $db;
		$sql = 'select * from role_resource where role_id_fk=?';
		$result = $db->fetchRow($sql, $role_id);
		$return_arr = unserialize($result['resource_id_fk']);
		return $return_arr;
	}
  
	function CategoryTree($list,$parent,$append){
		global $role_resources_list, $db;

		if(is_array($role_resources_list) && sizeof($role_resources_list) > 0){
			if(in_array($parent['resource_name'], $role_resources_list)){
				$checked = 'checked="checked"';
			}else{
				$checked = '';
			}
		}
		
		$list = '<li><input name="resources[]" type="checkbox" id="'.$parent['resource_name'].'" class="checkall" onclick="javascript:bindCheckAll(this)"  value="'.$parent['resource_name'].'" '.$checked.'/>&nbsp;<a href="javascript:void(0);">'.$parent['resource_name'].'</a>';
	
		if (hasChild($parent['resource_id'])){
			$append++;
			$list .= "<ul class='child child".$append."'>";
			$sql = "SELECT * FROM resources WHERE parent_id = ?";
			$child = $db->fetchAll($sql, $parent['resource_id']);
			
			for($i=0; $i < sizeof($child); $i++){
				$list .= CategoryTree($list,$child[$i],$append);
			}
			/*$qry = mysql_query($sql);
			$child = mysql_fetch_array($qry);
			do{
				$list .= CategoryTree($list,$child,$append);
			}while($child = mysql_fetch_array($qry));*/
			$list .= "</ul>";
		}
		$list .= '</li>';
		return $list;
	}
	function CategoryList(){
		global $role_resources_list, $db;
		$list = "";
	
		$role_resources_list = getAllResourcesByRoleId(ROLE_ID);
	
		$sql = "SELECT * FROM resources WHERE (parent_id = 0 OR parent_id IS NULL)";
		$parent = $db->fetchAll($sql);
		$mainlist = "<ul class='parent'>";
		for($i=0; $i < sizeof($parent); $i++){
			$mainlist .= CategoryTree($list,$parent[$i],$append = 0);
		}//while($parent = mysql_fetch_array($qry));
		$list .= "</ul>";
		
		/*$qry = mysql_query($sql);
		$parent = mysql_fetch_array($qry);
		$mainlist = "<ul class='parent'>";
		do{
			$mainlist .= CategoryTree($list,$parent,$append = 0);
		}while($parent = mysql_fetch_array($qry));
		$list .= "</ul>";*/
		return $mainlist;
	}
?>