jQuery.validator.addMethod("checkDuplicateState", function(value, element, params) {
    var state = $("#state").val();
	var country_id = $("#country_id").val();
    var param = $.extend({ "edit_id": $("#edit_id").val(), "country_id": country_id, "state" : state, "action": "unique_state_name" }, param);
	var is_valid = false;
    return eval($.ajax({
        type: "POST",
        url: "ajax/country-state-city.php",
        async: false,
        data: param,
        contentType: 'application/x-www-form-urlencoded; charset=iso-8859-1;',
        cache: false,
        dataType: "json",
        success: function(data) { return data },
        error: function(XMLHttpRequest, textStatus, errorThrown) { try { if (p.onError) p.onError(XMLHttpRequest, textStatus, errorThrown); } catch (e) { } }
    }).responseText);
}, jQuery.validator.format("State name is already in use"));

/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_state_info").validate({
		errorElement: 'div',
		rules: {
			country_id:{
				required: true
			},
			state: {
				minlength: 5,
				maxlength:40,
				letterswithbasicpunc: true,
				checkDuplicateState: true,
				async: false,
				required: true
			}
		},
		messages: {
			country_id:{
				required: "Please select country name."
			},
			state: {
				required: "Please enter state."
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