/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_faq_info").validate({
		errorElement: 'div',
		rules: {
			faq_category_id:{
				required: true
			},
			faq_question:{
				minlength: 4,
				maxlength:255,
				required: true
			},
			faq_answer:{
				minlength: 4,
				required: true
			}
		},
		messages: {
			faq_category_id:{
				required: "Please select FAQ Category"
			},
			faq_question:{
				required: "Please enter FAQ question."
			},
			faq_answer:{
				required: "Please enter FAQ answer."
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