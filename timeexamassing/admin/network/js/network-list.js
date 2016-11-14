var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
var grid_id = "#user_grid";

$(document).ready(function(){
	$(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: "ajax/"+filename, ALLOWDELETE: true, COOKIE:"network_user_list"});
});


function blockUser(UID){
	$.facebox.settings.closeImage   = SITEROOT + "/templates/images/closelabel.png";    
	$.facebox.settings.loadingImage = SITEROOT + "/templates/images/loading.gif";
	$.facebox.settings.overlay      = true;
	$.facebox.settings.opacity      = 0.3;
	jQuery.facebox({ajax:SITEROOTADMIN+'/network/ajax/block-unblock.php?action=showform&UID='+UID});
}

function unblockUser(UID){
	if(confirm('Are you sure, you want to Unblock user?')){
		var url = SITEROOTADMIN+'/network/ajax/block-unblock.php';
		var param = 'action=unblock&UID='+UID;
		$.ajax({
			type: 'POST',
			url: url,
			async: false,
			data: param,
			contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
			cache: false,
			dataType: 'json',
			success: function(data){
				$(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: "ajax/"+filename, ALLOWDELETE: true, COOKIE:"network_user_list"});
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert('Error');
			}
		});
	}
}

function saveBlockReason(){
	var url = SITEROOTADMIN+'/network/ajax/block-unblock.php';
	var param = $('#save_block_reason').serialize() + '&action=block';
	$.ajax({
		type: 'POST',
		url: url,
		async: false,
		data: param,
		contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
		cache: false,
		dataType: 'json',
		success: function(data){
			$(document).trigger('close.facebox');
			$(grid_id).custom_grid_plugin({DIV:grid_id, REQUEST_URL: "ajax/"+filename, ALLOWDELETE: true, COOKIE:"network_user_list"});
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { 
			alert('Error');
		}
	});
}