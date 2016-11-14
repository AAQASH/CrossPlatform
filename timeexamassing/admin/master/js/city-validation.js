jQuery.validator.addMethod("checkDuplicateCity", function(value, element, params) {
    var city = $("#city").val();
	var country_id = $("#country_id").val();
	var state_id = $("#state_id").val();
    var param = $.extend({ "edit_id": $("#edit_id").val(), "city" : city, "country_id": country_id, "state_id": state_id, "action": "unique_city_name" }, param);
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
}, jQuery.validator.format("City name is already in use"));
/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
						   
	$('#country_id').chainSelect('#state_id',SITEROOT+'/admin/master/ajax/country-state-city.php',
	{
		before:function (target) //before request hide the target combobox and display the loading message
		{},
		after:function (target) //after request show the target combobox and hide the loading message
		{}
	});
	
	var validator = $("#save_city_info").validate({
		errorElement: 'div',
		rules: {
			country_id:{
				required: true
			},
			state_id:{
				required: true
			},
			city:{
				minlength: 4,
				maxlength:40,
				letterswithbasicpunc: true,
				checkDuplicateCity: true,
				async: false,
				required: true
			}
		},
		messages: {
			country_id:{
				required: "Please select country."
			},
			state_id:{
				required: "Please select state."
			},
			city: {
				required: "Please enter city name."
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