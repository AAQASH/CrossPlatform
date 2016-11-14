jQuery.validator.addMethod("checkDuplicateFaqCategory", function(value, element, params) {
    var category_name = $("#category_name").val()
    var param = $.extend({ "type": "validate_faq_category_name", "edit_id": $("#edit_id").val(), "category_name" : category_name, "action": "edit" }, param);
    return eval($.ajax({
        type: "POST",
        url: "ajax/check-duplicate-faq-category.php",
        async: false,
        data: param,
        contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
        cache: false,
        dataType: "json",
        success: function(data) { return data },
        error: function(XMLHttpRequest, textStatus, errorThrown) { try { if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown); } catch (e) { } }
    }).responseText);
}, jQuery.validator.format("Category name is already in use"));

$(document).ready(function(){
	var validator = $("#save_faq_category_info").validate({
		errorElement: 'div',
		rules: {
			category_name:{
				minlength: 4,
				maxlength:40,
				required: true,
				letterswithbasicpunc: true,
				checkDuplicateFaqCategory: true
			}
		},
		messages: {
			category_name:{
				required: "Please enter FAQ Category name."
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