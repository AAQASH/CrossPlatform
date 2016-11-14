<?php
include_once('../bootstrap.php');

	$get_uid = ( (int)$_GET['UID'] > 0 ? (int)$_GET['UID'] : (int)$_SESSION['ss_uid'] );
	$is_admin = ( strlen($_GET['is_admin']) > 0 ? $_GET['is_admin'] : $_SESSION['ss_is_admin'] );
	$_SESSION['ss_uid'] = $get_uid;
	$_SESSION['ss_is_admin'] = $is_admin;

	$ss_uid = ( (int)$_SESSION['ss_uid'] > 0 ? (int)$_SESSION['ss_uid'] : 0 );
	$is_admin = (int)$_SESSION['ss_is_admin'];
	
	if( (int)$ss_uid <  1){
		if( (int) $is_admin > 0 ){
			header("Location:admin-list.php");
			exit;
		}else{
			header("Location:network-list.php");
			exit;
		}
		exit;
	}
	
	if( (int)$_GET['UID'] > 0 ){
		header("Location:addressbook-list.php");
		exit;	
	}
	
	//echo '<pre>';print_r($_SESSION);exit;
	

?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jstree/_lib/jquery.cookie.js";
$javascript[] = SITEROOTADMIN. "/templates/js/custom_grid_plugin.1.0.js";
$javascript[] = SITEROOTADMIN. "/network/js/addressbook-list.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->

<div id="maincont" class="ovfl-hidden">
  <div id="addressbook_grid"></div>
</div>
<!--Maincontent ends  -->
<div id="question" style="display:none; cursor: default"> <br />
  <h1>Would you like to contine?.</h1>
  <br />
  <input type="button" id="yes" value="Yes" />
  <input type="button" id="no" value="No" />
  <br />
  <br />
</div>
<?php include_once("admin/templates/footer.php"); ?>
