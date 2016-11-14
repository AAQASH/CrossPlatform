<?php
include_once("library/classes/combo.class.php");
class CityCombo extends Combo {
	
	function getAllCity($options = array()){
		global $db;
		if(!is_array($options)){
			return "Please set parameters";
		}
		if($options["SELECTED"] > 0){
			$options["CONDITION"] .= "OR city_id=".$options["SELECTED"];
		}
		$sql = "select ".$options["VALUE"].", ".$options["TEXT"]." from mts_city where ".$options["CONDITION"]." ORDER BY ".$options["TEXT"]." ".$options["OB"];
		$row = $db->fetchAll($sql);
		if($options["AJAX"] == true){
			Combo::setDefaultOption("--- Select City ---");
			return Combo::generateJsonDropdown($row, $options["VALUE"], $options["TEXT"], $options["SELECTED"]);
		}else{
			return Combo::generateDropdown($row, $options["VALUE"], $options["TEXT"], $options["SELECTED"]);
		}
		
	}//end function

}