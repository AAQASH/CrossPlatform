
/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	
	var validator = $("#addnew_content_info").validate({
		errorElement: 'div',
		rules: {
			title:{
				required: true
			}
		},
		messages: {
			title:{
				required: "Please enter title."
			}
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		},
		submitHandler: function(form) { // How to repace this?
			if(validateCKEditor("description")){
				$('input[type=submit]', form).attr('disabled', 'disabled');
				form.submit();
			}else{
				return false;
			}
        }
	});
});

//<![CDATA[
CKEDITOR.replace('description', {
	filebrowserBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html',
	filebrowserImageBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html?type=Images',
	filebrowserFlashBrowseUrl : SITEROOT + '/ckeditor/ckfinder/ckfinder.html?type=Flash',
	filebrowserUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	filebrowserImageUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
	filebrowserFlashUploadUrl : SITEROOT + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'				 
} );
//]]>