/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#addnew_email_template_info").validate({
		errorElement: 'div',
		rules: {
			subject:{
				required: true
			}
		},
		messages: {
			subject:{
				required: "Please enter subject."
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

//<![CDATA[
	CKEDITOR.replace( 'email_message', {
		filebrowserBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'				 
	} );
//]]>