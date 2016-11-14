<?php
include_once('../bootstrap.php');
session_destroy(); header("Location:". SITEROOT ."/admin/login/login.php");exit;
?>