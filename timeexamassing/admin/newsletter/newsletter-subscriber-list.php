<?php
include_once('../bootstrap.php');
?>
<?php include_once("admin/templates/header-start.php"); ?>
<?php
$javascript[] = SITEROOT. "/templates/js/jquery/jstree/_lib/jquery.cookie.js";
$javascript[] = SITEROOTADMIN. "/templates/js/custom_grid_plugin.1.0.js";
$javascript[] = SITEROOTADMIN. "/newsletter/js/newsletter-subscriber-list.js";
?>
<?php include_once("admin/templates/header-end.php"); ?>
<?php include_once("admin/templates/navigation.php"); ?>
<!--Maincontent starts -->

<div id="maincont" class="ovfl-hidden">

<div id="newsletter_subscriber_list"></div>
</div>
<!--Maincontent ends  -->

<?php include_once("admin/templates/footer.php"); ?>