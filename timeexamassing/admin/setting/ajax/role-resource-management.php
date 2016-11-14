<?php
/* INCLUDE REQUIRED FILES */
include_once("../../includes.php");
include_once("includes/grid.class.php");
include_once("includes/classes/input.class.php");
include_once("includes/classes/ps_pagination.php");
include_once("includes/classes/message.class.php");
include_once("admin/setting/functions.php");

	# define role id #
	define('ROLE_ID', (int)$_POST['roleId']);

?>
<form name="grid" id="grid">
<?php echo Message::getMessage(); ?>
<div id="jstree"> <?php echo CategoryList(); ?> </div>
<script type="text/javascript">
	var ids = [], hrefs = [];
	$("#jstree").find('input[id]').each(function() {
		ids.push(this.id);
	})
    $("#jstree").jstree({"core" : { "initially_open" :  ids } });
	
</script>
</form>