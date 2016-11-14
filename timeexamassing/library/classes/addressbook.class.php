<?php

Class AddressBook{

	var $address = array();
	var $addresslist = array();

	function getShippingAddress($UID){
		global $db;
		$sql = "SELECT address.*, country.country_name, state.state, city.city
				FROM address 
				JOIN user ON (address.address_id=user.default_shipping_id)
				LEFT JOIN country ON (address.country_id_fk=country.country_id)
				LEFT JOIN state ON (address.state_id_fk=state.state_id)
				LEFT JOIN city ON (address.city_id_fk=city.city_id)
				WHERE user.UID=?";
		$stmt = $db->query($sql, $UID);
	    $row = $stmt->fetchAll(); 
		
		$this->__address($row);
		return $this;
		
	}
	
	function getBillingAddress($UID){
		global $db;
		$sql = "SELECT address.*, country.country_name, state.state, city.city
				FROM address 
				JOIN user ON (address.address_id=user.default_billing_id)
				LEFT JOIN country ON (address.country_id_fk=country.country_id)
				LEFT JOIN state ON (address.state_id_fk=state.state_id)
				LEFT JOIN city ON (address.city_id_fk=city.city_id)
				WHERE user.UID=?";
		
		$stmt = $db->query($sql, $UID);
	    $row = $stmt->fetchAll();

		$this->__address($row);
		return $this;
	}
	
	function getAllAddresses($UID){
		$sql = "SELECT address.*, country.country_name, state.state, city.city
				FROM address 
				LEFT JOIN country ON (address.country_id_fk=country.country_id)
				LEFT JOIN state ON (address.state_id_fk=state.state_id)
				LEFT JOIN city ON (address.city_id_fk=city.city_id)
				WHERE address.UID=? AND address.is_active=1";
		
		$stmt = $db->query($sql, $UID);
	    $row = $stmt->fetchAll();
		
		for($i=0; $i < count($row); $i++){
			$this->address = array();
			$this->__address($row);
			$this->addresslist[$row[$i]['address_id']] = $this->address;
		}
		return $this->__createDropdown();
	}
	
	function getBillingAddressById($id){

		$sql = "SELECT address.*, country.country_name, state.state, city.city
				FROM address 
				LEFT JOIN country ON (address.country_id_fk=country.country_id)
				LEFT JOIN state ON (address.state_id_fk=state.state_id)
				LEFT JOIN city ON (address.city_id_fk=city.city_id)
				WHERE address.address_id=?";
		$stmt = $db->query($sql, $id);
	    $row = $stmt->fetchAll();
		
		$this->__address($row);
		return $this;
	}

	function getShippingAddressById($id){

		$sql = "SELECT address.*, country.country_name, state.state, city.city
				FROM address 
				LEFT JOIN country ON (address.country_id_fk=country.country_id)
				LEFT JOIN state ON (address.state_id_fk=state.state_id)
				LEFT JOIN city ON (address.city_id_fk=city.city_id)
				WHERE address.address_id=?";
		$stmt = $db->query($sql, $id);
	    $row = $stmt->fetchAll();
		$this->__address($row);
		return $this;
	}

	
	function __createDropdown(){
		$tmp = $this->addresslist;
		unset($this->addresslist);
		$cnt = sizeof($tmp);
		//echo '<pre>'; print_r($tmp);
		$_option = '';
		foreach($tmp as $_k => $_v){
			$_option_text = "";
			$deli = "";
			foreach($tmp[$_k] as $k => $v){
				$_option_text .= $deli ."". $v;
				$deli = ", ";
			}
			$_option .= '<option value="'.$_k.'">'. $_option_text .'</option>';
		}
		return $_option;
	}
	
	function __address($row){
		if( count($row) > 0 ){
			for($i=0; $i < count($row); $i++){
				/* NAME */
				$this->address['address_id'] = $row[$i]['address_id'];
				$this->address['country_id'] = $row[$i]['country_id_fk'];
				$this->address['state_id'] = $row[$i]['state_id_fk'];
				
				if( strlen($row[$i]['prefix']) > 0 ){
					$_name .= $row[$i]['prefix'] ." ";
				}
				if( strlen($row[$i]['firstname']) > 0 ){
					$_name .= $row[$i]['firstname'] . " ";
				}
				if( strlen($row[$i]['middlename']) > 0 ){
					$_name .= $row[$i]['middlename'] . " ";
				}
				if( strlen($row[$i]['lastnamev']) > 0 ){
					$_name .= $row[$i]['lastname'] . " ";
				}
				if( strlen($row[$i]['suffix']) > 0 ){
					$_name .= $row[$i]['suffix'] . " ";
				}
				if(strlen(trim($_name)) > 0){
					$this->address['name'] = $_name;
				}
				/* ADDRESS */
				if( strlen($row[$i]['address1']) > 0 ){
					$_street .= $row[$i]['address1'] . " ";
				}
				if( strlen($row[$i]['address2']) > 0 ){
					$_street .= $row[$i]['address2'] . " ";
				}
				if(strlen(trim($_street)) > 0){
					$this->address['street'] = $_street;
				}
				/* COUNTRY/STATE/CITY */
				if( strlen($row[$i]['country_name']) > 0 ){
					$_location .= $row[$i]['country_name'] . ", ";
				}
				if( strlen($row[$i]['state']) > 0 ){
					$_location .= $row[$i]['state'] . ", ";
				}
				if( strlen($row[$i]['city']) > 0 ){
					$_location .= $row[$i]['city'] . ", ";
				}
				if( strlen($row[$i]['zipcode']) > 0 ){
					$_location .= $row[$i]['zipcode'] . " ";
				}
				if(strlen(trim($_location)) > 0){
					$this->address['location'] = $_location;
				}
				/* PHONE/FAX */
				if( strlen($row[$i]['phoneno']) > 0 ){
					$_contactno .= $row[$i]['phoneno'] . " ";
				}
				if( strlen($row[$i]['faxno']) > 0 ){
					$_contactno .= $row[$i]['faxno'] . " ";
				}
				if(strlen(trim($_contactno)) > 0){
					$this->address['contactno'] = $_contactno;
				}
			}
		}
	}
	
}


?>