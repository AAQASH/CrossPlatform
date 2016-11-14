<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Website title -->
<title><?php echo SITENAME; ?></title>
<script type="text/javascript">
	var SITEROOT = "<?php echo SITEROOT; ?>";
	var SITEROOTADMIN = "<?php echo SITEROOTADMIN; ?>";
</script>
<script type="text/javascript" src="<?php echo SITEROOT?>/templates/js/jquery/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEROOT?>/admin/templates/js/jquery/bootstrap/bootstrap.min.js"></script>
<?php if ( (int)$_SESSION['admin_user_id'] > 0 ) : ?>
<?php endif; ?>
