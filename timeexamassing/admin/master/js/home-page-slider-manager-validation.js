/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_homepage_slider_image_info").validate({
		errorElement: 'div',
		rules: {
			image_name:{required: true, accept:'png|jpg|jpeg|gif'},
			title:{required: true},
			sort_order:{required: true, number: true}
		},
		messages: {
			image_name:{required: "Please enter image", accept:'Please select (png|jpg|jpeg|gif) image'},
			title:{required: "Please enter title"},
			sort_order:{required: "Please enter sort order (image position) in the list", number: "Please enter number only"}
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		},
		submitHandler: function(form) { // How to repace this?
            $('input[type=submit]', form).attr('disabled', 'disabled');
			form.submit();
        }
	});
});

function deleteImage(id){
	if(confirm("Are you sure you want to delete this Image?\nIf you click yes then image will be delated directly from database.")){
		var param = $.extend({"edit_id":id, "type" : "delete_image"}, param);
		$.ajax({
			type: 'post',
			url: 'ajax/slider_image.php',
			data: param,
			async: false,
			dataType: 'json',
			success: function(data){
				$("#tr_image_1_preview").hide();
				$("#tr_image_1_uploader").show();
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("I am in error"); 
			}
		});		
	}
}