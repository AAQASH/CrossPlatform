<?php
include_once("library/classes/combo.class.php");
class CountryCombo extends Combo {
	
	//function getAllCountry($valuefield='ID', $showfield='country_name', $selvalue, $cdn=1, $ob='ASC', $prn="" ){
	function getAllCountry($options = array()){
		global $db;
		if(!is_array($options)){
			return "Please set parameters";
		}
		if($options["SELECTED"] > 0){
			$options["CONDITION"] .= "OR country_id=".$options["SELECTED"];
		}
		$sql = "select ".$options["VALUE"].", ".$options["TEXT"]." from mts_country where ".$options["CONDITION"]." ORDER BY ".$options["TEXT"]." ".$options["OB"];
		$row = $db->fetchAll($sql);
		return Combo::generateDropdown($row, $options["VALUE"], $options["TEXT"], $options["SELECTED"]);
	}//end function
}