<?php
class Core_Config_Data {
	
	function __construct(){
		
	} // end function
	
	function saveCoreConfigData($post){
		global $db;
		foreach($post as $k => $v){
			$path = $k;
			foreach($v as $_k => $_v){
				$path = $path ."/". $_k;
				foreach($_v as $__k => $__v){
					foreach($__v as $___k => $___v){
						$_path = $k ."/". $_k ."/". $___k;
						$_value = $___v;

						$sqlCoreConfigData = 'select * from mts_core_config_data where path=?';
						$row = $db->fetchAll($sqlCoreConfigData, $_path);
						//echo count($row); print_r($row); exit;
						if(count($row) > 0){
							$data['value'] = $_value;
							$db->update('mts_core_config_data', $data, "path like '".$_path."'");
						}else{
							$data['path'] = $_path;
							$data['value'] = $_value;
							$db->insert('mts_core_config_data', $data);
						}
					}
				}
			}
		}
	}
	
	
	function getData($path = 'ALL'){
		global $db;
		$data = array();
		if( strlen(trim($path)) > 0 ){
			if($path == 'ALL'){
				$where = "1=1";
			}else{			
				$where = "path like '%".$path."%'";
			}
			
			$sqlCoreConfigData = "select * from mts_core_config_data where ". $where;
			$row = $db->fetchAll($sqlCoreConfigData);
			for($i=0; $i < sizeof($row); $i++){
				$_x_arr = explode("/", $row[$i]['path']);
				
				$data[$_x_arr[0]][$_x_arr[1]]['fields']["ID"] = $row[$i]['core_config_data_id'];
				$data[$_x_arr[0]][$_x_arr[1]]['fields'][$_x_arr[2]] = $row[$i]['value'];
			}
			
		}else{
			echo "Path not define"; exit;
		}
		
		return $data;
	}
	
} // end class
?>