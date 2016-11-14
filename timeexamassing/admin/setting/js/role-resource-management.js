$(document).ready(function(){
	$("#role_resource_management").custom_grid_plugin({DIV:"#role_resource_management", REQUEST_URL: "ajax/role-resource-management.php", ALLOWDELETE: true, COOKIE:"role_resource_management"});
	
	/* bind click event to save button */
	$("#btnSave").click(function(){
		saveResources();
	});
	
});

function loadRoleResources(roleId){
	var url = SITEROOT + "/admin/setting/ajax/role-resource-management.php";
	$.post(url, {"roleId": roleId}, function(data){
		$("#role_resource_management").html(data);
	});
}

function bindCheckAll(el){
	if(typeof($(el).attr('checked')) != "undefined"){
		$(el).parent().find(':checkbox').attr('checked', 'checked');
	}else{
		$(el).parent().find(':checkbox').removeAttr('checked');
	}
}

function saveResources(){
	var url = SITEROOT +'/admin/setting/ajax/role-resource-save.php';
	var param = $("form#grid").serializeArray();
	param.push({"name":"role_id","value":$("#role").val()});
	$.post(url, param, function(data){
		alert(data.resp_message);
	}, 'json');
}