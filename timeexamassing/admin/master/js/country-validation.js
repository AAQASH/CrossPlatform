jQuery.validator.addMethod("checkDuplicateCountry", function(value, element, params) {
    var country_name = $("#country_name").val()
    var param = $.extend({ "edit_id": $("#edit_id").val(), "country_name" : country_name, "action": "unique_country_name" }, param);
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
}, jQuery.validator.format("Country name is already in use"));

jQuery.validator.addMethod("checkDuplicateCountryIsoCode2", function(value, element, params) {
    var country_iso_code_2 = $("#country_iso_code_2").val()
    var param = $.extend({ "edit_id": $("#edit_id").val(), "country_iso_code_2" : country_iso_code_2, "action": "unique_country_iso_code_2" }, param);
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
}, jQuery.validator.format("Country ISO code 2 is already in use"));

jQuery.validator.addMethod("checkDuplicateCountryIsoCode3", function(value, element, params) {
    var country_iso_code_3 = $("#country_iso_code_3").val()
    var param = $.extend({ "edit_id": $("#edit_id").val(), "country_iso_code_3" : country_iso_code_3, "action": "unique_country_iso_code_3" }, param);
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
}, jQuery.validator.format("Country ISO code 3 is already in use"));


/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	var validator = $("#save_country_info").validate({
		errorElement: 'div',
		rules: {
			country_name:{
				minlength: 4,
				maxlength:40,
				required: true,
				letterswithbasicpunc: true,
				checkDuplicateCountry: true,
				async: false
			},
			country_iso_code_2:{
				minlength: 2,
				maxlength: 2,
				checkDuplicateCountryIsoCode2: true,
				required: true
			},
			country_iso_code_3:{
				minlength: 2,
				maxlength: 3,
				checkDuplicateCountryIsoCode3: true,
				required: true
			}
		},
		messages: {
			country_name:{
				required: "Please enter country name."
			},
			country_iso_code_2:{
				minlength: "Please enter two-letter country codes",
				maxlength: "Please enter two-letter country codes",
				required: "Two-letter country codes"
			},
			country_iso_code_3:{
				minlength: "Please enter three-letter country codes",
				maxlength: "Please enter three-letter country codes",
				required: "Three-letter country codes"
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