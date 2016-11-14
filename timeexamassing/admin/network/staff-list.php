<?php
include_once('../bootstrap.php');
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jstree/_lib/jquery.cookie.js";
$javascript[] = SITEROOT. "/templates/js/jquery/facebox/src/facebox.js";
$javascript[] = SITEROOTADMIN. "/templates/js/custom_grid_plugin.1.0.js";
$javascript[] = SITEROOTADMIN. "/network/js/staff-list.js";
?>
<link href="<?php echo SITEROOT?>/templates/js/jquery/facebox/src/facebox.css" rel="stylesheet" type="text/css" />
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->
<div id="maincont" class="ovfl-hidden">
  <div id="user_grid"></div>
</div>
<!--Maincontent ends  -->
<?php include_once("admin/templates/footer.php"); ?>
