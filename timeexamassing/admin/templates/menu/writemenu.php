<?php
include_once('../includes.php');
include_once("admin/menu/functions.php");
include_once('includes/classes/file.class.php');

	# create object #
	$f = new file;
	
	$menu =  CategoryList($_SESSION['account_type_id_fk']);
	$path = ABSPATH.'/admin/menu/'.$_SESSION['account_type_id_fk'].'.php';
	if (is_file($path)){
		$f->delete_file($path);
	}
	$f->make_file($path);
	$f->write_file($menu, $path, 1, 1);
	header("Location:".SITEROOT."/admin/welcome.php");
	exit;	