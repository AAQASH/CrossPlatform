<?php
class Combo {
	
	protected static $defaultOption = "--- Please select ----";
	
	function __construct(){
	} // end function
	
	function createCombo($tablename,$id,$name,$selected_id=0,$order_by="*",$where="+",$selectFields="*"){
		global $db;
		$dis = explode(",",$name);
		if($order_by == "*" and $where == "+")	{		$wh = "1";		}
		if($order_by != "*" and $where == "+")	{		$wh = "1 ".$order_by;		}
		if($order_by == "*" and $where != "+")	{		$wh = $where;		}
		if($order_by != "*" and $where != "+")	{		$wh = $where." ".$order_by;		}
		
		$sql = "select " . $selectFields . " from  ". $tablename . " where " . $wh;
		$row = $db->fetchAll($sql);
		$row_count = sizeof($row);
		
		if(sizeof($row_count) > 0){
			for($m=0;$m < $row_count;$m++){
				if($row[$m][$id] == $selected_id){
					$mm = "selected='selected'";
				}else{	
					$mm = " ";		
				}
				$mr.= "<option value='".$row[$m][$id]."' ".$mm.">";
				if(sizeof($dis) == 1){
					$mr.=$row[$m][$dis[0]];
				}else{
					for($i=0;$i<sizeof($dis);$i++){
						$mr.=$row[$m][$dis[$i]]." ";
					}
				}
				$mr.="</option>";
				
			}
		}else{
			return "Table is empty";
		}
		return $mr;
	}
	
	
	function setDefaultOption($defaultVal){
		if(trim($defaultVal) != ""){
			self::$defaultOption = $defaultVal;
		}
	}
	
	function generateDropdown($row, $valuefield, $showfield, $selvalue){
		$option = "";
		for($i=0; $i < sizeof($row); $i++){
			$sl = ($selvalue == $row[$i][$valuefield] ? "selected=\"selected\"" : "");
			$option .= "<option value='".$row[$i][$valuefield]."' ".$sl.">".$row[$i][$showfield]."</option>\n";
		}
		return $option;
	}
	
	function generateJsonDropdown($row, $valuefield, $showfield, $selvalue){
		$option = "";
		$data[] = array(""=>self::$defaultOption);
		for($i=0; $i < sizeof($row); $i++){
			$data[] = array($row[$i][$valuefield] => $row[$i][$showfield]);
		}
		return json_encode($data);
	}
	
	function getAllAddress($valuefield='ID', $showfield, $selvalue, $cdn=1, $ob='ASC', $prn="" ){
		global $dbObj;
		if( strlen(trim($showfield)) < 1 ){
			$showfield = "firstname, lastname, address1, zipcode, phoneno";
		}//if
		$sql = "select {$valuefield}, {$showfield} from address where {$cdn}";
		$rs = $dbObj->customqry($sql, $prn);
		
		$option = "";
		if(is_resource($rs)){
			while($row = $dbObj->fetchAssoc($rs)){
				$option_text = array();
				$sl = ($selvalue == $row[$valuefield] ? "selected=\"selected\"" : "");
				if( strlen($row['firstname']) > 0 ){
					$option_text[] = $row['firstname'];
				}
				if( strlen($row['lastname']) > 0 ){
					$option_text[] = $row['lastname'];
				}
				if( strlen($row['address1']) > 0 ){
					$option_text[] = $row['address1'];
				}
				if( strlen($row['zipcode']) > 0 ){
					$option_text[] = $row['zipcode'];
				}
				if( strlen($row['phoneno']) > 0 ){
					$option_text[] = $row['phoneno'];
				}
				if( is_array($option_text) && sizeof($option_text) > 0 ){
					$val = implode(", ", $option_text);
				}
				$option .= "<option value='".$row[$valuefield]."' ".$sl.">".$val."</option>\n";
			}
		}

		return $option;
		//return $this->generateDropdown($rs, $valuefield, $showfield, $selvalue);
	}//end function
	
} // end class
$combo = new Combo();