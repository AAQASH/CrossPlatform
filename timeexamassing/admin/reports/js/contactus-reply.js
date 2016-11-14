$(document).ready(function(){
	
	var validator = $("#contact_us_reply").validate({
		errorElement: 'div',
		rules: {
			subject:{
				required: true,
				minlength: 5,
				maxlength: 32
			}
		},
		messages: {
			subject:{
				required: "Please enter Subject.",
				maxlength: 32
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
            $('input[type=submit]', form).attr('disabled', 'disabled');
			form.submit();
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