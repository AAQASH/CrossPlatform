<?php
class Page {
	
	var $metacontent = "";
	
	function __construct(){

	} // end function
	
	function __parseURL($request_uri){
		$arr = parse_url($_SERVER['REQUEST_URI']);
		if(is_array($arr) && sizeof($arr) > 0){
			return $arr['path'];
		}else{
			return $request_uri;
		}
	}
	
	function metaTitle($title=''){
		if(strlen(trim($title)) > 0){
			$this->metacontent['meta_title'] = $title;
		}else{
			$this->metacontent['meta_title'] = SITETITLE;
		}
	}
	
	function metaDescription($description=''){
		if(strlen(trim($description)) > 0){
			$this->metacontent['meta_description'] = $description;
		}else{
			$this->metacontent['meta_description'] = SITETITLE;
		}
	}
	
	function metaKeywords($keywords=''){
		if(strlen(trim($keywords)) > 0){
			$this->metacontent['meta_keywords'] = $keywords;
		}else{
			$this->metacontent['meta_keywords'] = SITETITLE;
		}
	}
	
	function getMetaContent($request_uri){
		global $db;
		$request_uri = $this->__parseURL($request_uri);
		if(strlen(trim($request_uri)) > 0){
			
			$stmt = $db->query('select * from seo_content_management where request_uri=?', $request_uri);
			$row = $stmt->fetchAll(); 
			
			$this->metaTitle($row[0]['title']);
			$this->metaDescription($row[0]['meta_description']);
			$this->metaKeywords($row[0]['meta_keywords']);
		}else{
			$this->metaTitle();
			$this->metaDescription();
			$this->metaKeywords();
		}
	}
	
}
