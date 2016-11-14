<!--Footer starts -->

<div id="footer">
  <p><?php echo COPYRIGHT ?> </p>
</div>
<!--Footer ends  -->
</div>
<script language="javascript1.1">
$(document).ready(function() {
	$("#uberbar").fadeOut(5000, function(){$(this).remove()});
});
</script>
<?php if ( (int)$_SESSION['admin_user_id'] > 0 ) : /*?>
<!-- Smooth Navigational Menu -->
<script type="text/javascript" src="<?php echo SITEROOT?>/templates/js/jquery/ddsmoothmenu/ddsmoothmenu.js"></script>
<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
</script>
<?php */ endif; ?>
<?php
if(is_array($javascript) && sizeof($javascript) > 0){
	foreach($javascript as $k => $v){
		echo '<script type="text/javascript" src="'.$v.'"></script>';
	}
}
?>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</body></html>