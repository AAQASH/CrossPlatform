<?php

if (@ini_set('zlib.output_compression',TRUE) || @ini_set('zlib.output_compression_level',2)) {
    ob_start();
} else {
    ob_start('ob_gzhandler');
}

ini_set('register_globals', '0');
ini_set('memory_limit', '512M');
error_reporting(E_ERROR | E_WARNING | E_PARSE);


$server = (strlen($_SERVER['HTTP_HOST']) > 0 ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);

switch($server){
	case "timeexamassing.wiseprm.com": 
		/* DATABASE CONNECTION */
		define('HST', 'localhost');     
		define('USR', 'timeexamassing');		
		define('PWD', '9KM@06#K');		
		define('DBN', 'mts_timeexamassing');	
		define("SITEROOT", "http://timeexamassing.wiseprm.com/");
		define("SITEROOTCDN", "http://timeexamassing.wiseprm.com/");
		define("SITEROOTADMIN", "http://timeexamassing.wiseprm.com/admin/");
		define("ABSPATH",$_SERVER["DOCUMENT_ROOT"]);
		define("SMT_CONFIG", ABSPATH."/configs");
		define("TOKEN_SESSION_TIME", "30");
		define('STORE_ID', '1');
		
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
			'host'     => HST,
			'username' => USR,
			'password' => PWD,
			'dbname'   => DBN
		));
		
	break;
	
	default:
		/* DATABASE CONNECTION */
		define('HST', 'localhost');
		define('USR', 'root');
		define('PWD', '');
		define('DBN', 'mts_college');
		define('FOLDERPATH', '/projects/timeexamassing');
	break;
}

define("SITEROOT", "http://".$server."". FOLDERPATH);
define("SITEROOTCDN", "http://".$server."". FOLDERPATH);
define("SITEROOTADMIN", "http://".$server."".FOLDERPATH."/admin");
define("ABSPATH", $_SERVER["DOCUMENT_ROOT"]."".FOLDERPATH);

$db = new Zend_Db_Adapter_Pdo_Mysql(array(
	'host'     => HST,
	'username' => USR,
	'password' => PWD,
	'dbname'   => DBN,
	'charset'  => 'utf8'
));

?>