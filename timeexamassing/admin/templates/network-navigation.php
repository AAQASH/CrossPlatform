<?php
echo '<div id="vertmenu">';
if($_SESSION['account_type_id_fk'] > 0){
	include('admin/menu/'.$_SESSION['account_type_id_fk'].'.php');
} else {
	include('admin/menu/menu.php');
}
echo '</div>'; 