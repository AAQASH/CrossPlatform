var url = window.location.pathname;
var filename = "contactus-reply-list.php";
var grid_id = "#contactus-reply-list";

$(document).ready(function(){
	$(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: "ajax/"+filename, ALLOWDELETE: true, COOKIE:"contactus_reply_list", DEFAULT_AJAX: false});
});