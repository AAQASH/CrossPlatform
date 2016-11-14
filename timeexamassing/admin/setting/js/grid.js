$(document).ready(function(){
	$("#content_grid").custom_grid_plugin({DIV:"#content_grid", REQUEST_URL: "ajax/grid.php", ALLOWDELETE: true, COOKIE:"email_template_list"});
});
$(document).ready(function(){
	$("#sitesetting_grid").custom_grid_plugin({DIV:"#sitesetting_grid", REQUEST_URL: "ajax/sitesetting-grid.php", ALLOWDELETE: true, COOKIE: "sitesetting_list"});
});