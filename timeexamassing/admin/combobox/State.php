<?php
include_once("library/classes/combo.class.php");
class StateCombo extends Combo {
	
	function getAllState($options = array()){
		global $db;
		if(!is_array($options)){
			return "Please set parameters";
		}
		if($options["SELECTED"] > 0){
			$options["CONDITION"] .= "OR state_id=".$options["SELECTED"];
		}
		$sql = "select ".$options["VALUE"].", ".$options["TEXT"]." from mts_state where {$cdn} ".$options["CONDITION"]." ORDER BY ".$options["TEXT"]." ".$options["OB"];
		$row = $db->fetchAll($sql);
		if($options["AJAX"] == true){
			Combo::setDefaultOption("--- Select State ---");
			$data = Combo::generateJsonDropdown($row, $options["VALUE"], $options["TEXT"], $options["SELECTED"]);
		}else{
			$data = Combo::generateDropdown($row, $options["VALUE"], $options["TEXT"], $options["SELECTED"]);
		}
		return $data;
	}//end function
}