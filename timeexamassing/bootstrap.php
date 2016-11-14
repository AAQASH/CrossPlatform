<?php
	
	session_start();
	
	ini_set('date.timezone', 'America/Los_Angeles');
	
	defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/' ));
	set_include_path(implode(PATH_SEPARATOR, array(realpath(APPLICATION_PATH . ''),get_include_path(),)));
	set_include_path(implode(PATH_SEPARATOR, array(realpath(APPLICATION_PATH . '/library'),get_include_path(),)));
	set_include_path(implode(PATH_SEPARATOR, array(realpath(APPLICATION_PATH . '/admin'),get_include_path(),)));
	
	define('APPLICATION_MODULE', 'ADMIN');
	
	/* INCLUDE ALL REQUIRED FILES
	 */
	include_once('Zend/Db/Adapter/Pdo/Mysql.php');
	include_once('Zend/Db/Table/Abstract.php');
	include_once('Zend/Mail.php');
	include_once('Zend/Json.php');
	
	include_once('library/SiteConfig.php');
	include_once('library/SiteSetting.php');
	include_once('library/classes/combo.class.php');
	include_once('library/classes/file.class.php');
	include_once('library/classes/formvalidator.class.php');
	include_once('library/classes/grid.class.php');
	include_once('library/classes/input.class.php');
	include_once('library/classes/message.class.php');
	include_once('library/classes/page.class.php');
	include_once('library/classes/password.class.php');
	include_once('library/classes/ps_pagination.php');
	include_once('library/classes/token.class.php');
	include_once('library/classes/upload.inc.php');
	include_once('library/classes/urlkeygenerator.class.php');
	include_once('library/classes/userloginlog.class.php');
	include_once("library/classes/errorlog.class.php");
	include_once("library/classes/functions.class.php");
	
	
	
	/* CREATE OBJECT 
	 * CREATE OBJECT FOR ALL INCLUDED CLASSES
	 */
	$combo = new Combo();
	$file = new file();
	$validator = new FormValidator();
	$grid = new Grid();
	$input = new input();
	$page = new Page();
	$password = new Password();
	$pager = new PS_Pagination();
	$T = new Token();
	$upload = new upload();
	$ukg = new Url_Key_Generator();
	$log = new ErrorLog();
	$mail = new Zend_Mail();
	$function = new functions();
	
	$mail->setFrom( EMAIL_FROM, SITE_EMAIL );
	
	/* CHECK LOGIN STATUS 
	 * IF NOT LOGGED IN REDIRECT TO LOGIN PAGE
	 */
	$access_without_login_pages = array("login.php", "checkbrowser.php", "forgotpassword.php", "server.php", "addjsfiles.php");
	$page = basename($_SERVER['PHP_SELF']);

//	if((int)$_SESSION['admin_user_id'] < 1 && !in_array($page, $access_without_login_pages)){
//		header("Location:".SITEROOTADMIN."/login/login.php");exit;
//	}
	
	
?>