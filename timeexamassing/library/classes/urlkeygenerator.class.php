<?php 

class Url_Key_Generator {

	var $where_field_name = 'ID';
	var $db_table = '';
	var $db_field = '';
	var $urlkey = '';
	var $db = '';
	var $id='';
	
	
	/* INITILIZING VERIABLES */
	function Url_Key_Generator(){
		global $db;
		$this->db = $db;
	} // end function
	
	
	/* DO CLEAN TEXT */
	function generateUrlKey($title, $id=0) {
		$this->id = ((int)$id > 0 ? $id : 0);
		$order   	= array("(",")",":","$","#","@","%","^","*","[","]","&","{","}","|","/","_","+","!","~","`","?","<",/*".",*/",",">","'","\"");
		$replace 	= '';
		$url_title 	= str_replace($order, $replace, $title);
		$url_title 	= str_replace(" ","-",$url_title);
		$this->urlkey = strtolower($url_title);
		$this->createDuplicateUrlKey();
		return $this;
	} // end function
	
	
	/* 
	 * CHECK IF ALREADY EXIST IN DATABASE 
	 * IF FOUND THEN CREATE DUPLICATE
	 * IF NOT KEEP ORIGINAL AS IT IS
	 */
	function createDuplicateUrlKey(){
		if(strlen($this->urlkey) < 1) {  
			echo 'Please create url key first';
			exit;
		}
		if(is_object($this->db)){
			$sql = 'SELECT '.$this->db_field.' 
					FROM '.$this->db_table.' 
					WHERE '.$this->db_field.' = \''.$this->urlkey.'\' 
					AND '.$this->where_field_name.'!='.$this->id.'';
			$row = $this->db->fetchAll($sql);
			if(count($row) > 0){
				$this->urlkey .= '-'. ( $row_count + 1 );
			}
		} else {
			echo 'No database connected';
			exit;
		}
		return $this;
	} // end function

} // end class
?>