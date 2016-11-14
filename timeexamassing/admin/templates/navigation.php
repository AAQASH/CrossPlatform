<!-- Header starts --><noscript>
<meta http-equiv="refresh" content="0;URL=<?php echo SITEROOTADMIN ?>/checkbrowser.php" />
</noscript>

<div id="header">
  <?php
  
	if((int)$_SESSION['admin_user_id'] > 0){
		$link = '<a href="'.SITEROOTADMIN.'/login/logout.php">Logout</a>';
		$fullname = "(".$_SESSION['admin_firstname']." ".$_SESSION['admin_lastname'].")";
	} else {
		$link = '<a href="'.SITEROOTADMIN.'/login/login.php">Login</a>';
	}
  
  ?>
  <div class="midcont">
    <h1 id="logo" class="fl"><a href="<?php echo SITEROOTADMIN ?>/">&nbsp;</a></h1>
    <div id="toprighttrxt" >
      <DIV>Welcome <?php echo $_SESSION['accounttype'] ?> <?php echo $fullname ?> [<?php echo $link ?>]</DIV>
    </div>
    <div class="clr"></div>
  </div>
  <?php
	echo '<div id="smoothmenu1" class="ddsmoothmenu">';
		if($_SESSION['account_type_id_fk'] > 0){
			include_once('admin/templates/menu/menu.php');
		}
	echo '</div>';
    ?>
  
</div>
<!-- Header ends  -->
<div class="clr"></div>