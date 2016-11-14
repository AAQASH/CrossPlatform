<?php
/*This is query from table sitesetting (compulsory table)*/
$sitesetting = $db->select('type, value')->from( 'mts_sitesetting' )->where( '1' );
$stmt = $sitesetting->query();
$result_sitesetting = $stmt->fetchAll();
if(sizeof($result_sitesetting) > 0){
	for($i=0; $i < sizeof($result_sitesetting); $i++){
		define($result_sitesetting[$i]['type'], $result_sitesetting[$i]['value']);
	}
}
define("SITEJS", SITEROOT."/templates/default/js");
define("SITEIMG", SITEROOT."/templates/".TEMPLATEDIR."/images");
define("SITECSS", SITEROOT."/templates/".TEMPLATEDIR."/css");
	
	
## DEFAULT WARNING MESSAGES ##
//upload_max_filesize
define('WARNING_UPLOAD_MAX_FILESIZE', 'Upload Max Filesize set to 8Mb, Please do not try to upload any file more then 8Mb in size.');
define('WARNING_DEAL_DATE_TIME_RANGE', 'Please be careful while selecting datetime range.');
define('WARNING_BASIC_PUNCTUATION',"These are the basic punctuation are allowd: a - z - . , ( ) ' \" ");

# DEFAULT DATE FORMAT #
define('DATE_FORMAT', 'm-d-Y');
define('TIME_FORMAT', 'H:i:s');

function redirect($filename, $querystring){
	#  IF QUERYSTRING IS ARRAY #
	if( is_array($querystring) && sizeof($querystring) > 0 ){
		$_x = http_build_query($querystring);
	}
	
	#  IF QUERYSTRING IS STRING #
	if( strlen(trim($querystring)) > 0 ){
		$_x = $querystring;
	}
	
	if(strlen(trim($_x)) < 1){
		header("Location:{$filename}");
		exit;
	}else{
		header("Location:{$filename}" ."?". $_x);
		exit;
	}
}

function dateFormat($date, $date_format = DATE_FORMAT, $time_format = ""){
	
	$date_time_format = trim($date_format .' '. $time_format);
	
	if(strtolower($date) == 'now'){
		$date = date($date_time_format);
	}
	$time_stamp = strtotime($date);
	
	return date($date_time_format, $time_stamp);
}