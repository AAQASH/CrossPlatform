/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_exam_info").validate({
		errorElement: 'div',
		rules: {
			exam_type:{
				required: true
			},
			class:{
				required: true
			},
			date:{
				required: true
			},
			time:{
				required: true
			},
			status:{
				required: true
			}
		},
		messages: {
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