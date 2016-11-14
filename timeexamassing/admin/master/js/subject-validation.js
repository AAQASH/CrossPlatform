
/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_country_info").validate({
		errorElement: 'div',
		rules: {
			subject:{
				minlength: 4,
				maxlength:40,
				required: true
			},
			subject_code:{
				minlength: 2,
				maxlength: 4,
				required: true
			}
		},
		messages: {
			country_name:{
				required: "Please enter subject name."
			},
			subject_code:{
				minlength: "Please enter two-letter subject codes",
				maxlength: "Please enter four-letter subject codes",
				required: "Two-letter subject code"
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