/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
$(document).ready(function(){
	$('#country_id').chainSelect('#state_id',SITEROOT+'/admin/master/ajax/country-state-city.php',
	{
		before:function (target) //before request hide the target combobox and display the loading message
		{},
		after:function (target) //after request show the target combobox and hide the loading message
		{}
	});
	$('#state_id').chainSelect('#city_id',SITEROOT+'/admin/master/ajax/country-state-city.php',
	{
		before:function (target) //before request hide the target combobox and display the loading message
		{},
		after:function (target) //after request show the target combobox and hide the loading message
		{}
	});
	
	
	var validator = $("#save_address_info").validate({
		errorElement: 'div',
		rules: {
			firstname:{
				letterspaceonly: true,
				required: true,
				minlength: 2,
				maxlength: 32
			},
			lastname:{
				letterspaceonly: true,
				required: true,
				minlength: 2,
				maxlength: 32
			},
			address1:{
				required: true
			},
			country_id:{
				required: true,
				number: true
			},
			state_id:{
				required: true,
				number: true
			},
			city_id:{
				required: true,
				number: true
			},
			phoneno:{
				required: true,
				phone: true,
				minlength: 4,
				maxlength: 12
			},
			zipcode:{
				required: true,
				postalCode:true,
				minlength: 4,
				maxlength: 6
			}
		},
		messages: {
			firstname:{
				required: "Please enter first name."
			},
			lastname:{
				required: "Please enter last name."
			},
			address1:{
				required: "Please enter address."
			},
			country_id:{
				required: "Please select country",
				number: "Please select country"
			},
			state_id:{
				required: "Please select state",
				number: "Please select state"
			},
			city_id:{
				required: "Please select city",
				number: "Please select city"
			},
			zipcode:{
				required: "Please enter zipcode."
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