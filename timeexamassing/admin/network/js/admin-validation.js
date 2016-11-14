$(document).ready(function(){
	$( "#birthdate" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: "-18Y", changeMonth: true, changeYear: true });
});

/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	
	$('#btnresendverification').click(function(){
		var uid = $('#edit_id').val();
		$.ajax({
			type: 'post',
			url: 'ajax/resend-verification-code.php',
			async: false,
			data: {"uid":uid},
			contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
			cache: false,
			dataType: 'json',
			success: function(data){
				var classname = (data.error > 0 ? 'alert alert-danger' : 'alert alert-success');
				jQuery.facebox(data.msg, classname)
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {  }
		});
	});
	
	
	var validator = $("#addnew_user_info").validate({
		errorElement: 'div',
		rules: {
			email:{
				required: true,
				email: true,
				remote: 'ajax/user.php?type=validate_email&edit_id='+$("#edit_id").val()+'&action=edit'
			},
			password:{
				required: true,
				minlength: 5,
				maxlength:15,
				nowhitespace: true
			},
			firstname:{
				required: true,
				minlength: 2,
				maxlength: 32,
				letterspaceonly: true
			},
			lastname:{
				required: true,
				minlength: 2,
				maxlength: 32,
				letterspaceonly: true
			},
			birthdate:{
				required: true
			},
			gender:{
				required: true
			},
			thumbnail:{
				accept:'png|jpg|jpeg|gif'
			}
		},
		messages: {
			email:{
				required: "Please enter email.",
				email: "Please enter valid email address.",
				remote: "Email already in use please enter another one."
			},
			password:{
				required: "Please enter password"
			},
			thumbnail:{
				accept: "Please enter a Image/File with a valid extension."
			}
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

/* IF FORM ID IS STARTING WITH EDIT THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#edit_user_info").validate({
		errorElement: 'div',
		rules: {
			email:{
				required: true,
				email: true,
				remote: 'ajax/user.php?type=validate_email&edit_id='+$("#edit_id").val()+'&action=edit',
				async: false
			},
			password:{
				required: true,
				minlength: 5,
				maxlength:15,
				nowhitespace: true
			},
			firstname:{
				required: true,
				letterspaceonly: true,
				minlength: 2,
				maxlength: 32
			},
			lastname:{
				required: true,
				letterspaceonly: true,
				minlength: 2,
				maxlength: 32
			},
			birthdate:{
				required: true
			},
			gender:{
				required: true
			},
			thumbnail:{
				accept:'png|jpg|jpeg|gif'
			}
		},
		messages: {
			email:{
				required: "Please enter email.",
				email: "Please enter valid email address.",
				remote: "Email already in use please enter another one."
			},
			password:{
				required: "Please enter password"
			}
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


function deleteImage(user_id){
	if(confirm("Are you sure you want to delete this Image?\nIf you click yes then image will be delated directly from database.")){
		var param = $.extend({"edit_id":user_id, "type" : "delete_image"}, param);
		$.ajax({
			type: 'post',
			url: 'ajax/user.php',
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