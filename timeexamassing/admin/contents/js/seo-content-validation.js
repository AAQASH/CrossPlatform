
/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	
	var validator = $("#addnew_content_info").validate({
		errorElement: 'div',
		rules: {
			title:{required: true,minlength: 5, maxlength:100},
			meta_description:{maxlength: 200},
			meta_keywords: {maxlength: 200}
		},
		messages: {
			title:{required: "Please enter title."}
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		}
	});
});