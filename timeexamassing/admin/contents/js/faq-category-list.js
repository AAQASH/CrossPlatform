var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
var grid_id = "#faq_category_grid";

$(document).ready(function(){
	$(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: "ajax/"+filename, ALLOWDELETE: true, COOKIE: "faq_category_grid"});
});