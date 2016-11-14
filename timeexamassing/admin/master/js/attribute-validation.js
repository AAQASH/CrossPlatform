/* IF FORM ID IS STARTING WITH ADDNEW THEN APPLY THESE VALIDATIONS */
var append_options = '';
append_options =  '<table border="0" cellpadding="3" cellspacing="0" id="option_value">';
append_options += ' <tr>';
append_options += '  <th align="left">Value</th>';
append_options += '  <th align="left">Position</th>';
append_options += '  <th>Is Default</th>';
append_options += '  <th><a href="javascript:void(0);" id="add_option"><img src="'+SITEROOT+'/admin/templates/images/add.png" title="Add More" /></a></th>';
append_options += ' </tr>';
append_options += '</table>';

function addOption(){
	var input_type = $("#input_type").val();
	var rowCount = $('#option_value tr').length;
	rowCount = parseInt(rowCount) - 1;
	var value = 'option_'+rowCount;
	
	var _x  = '<tr>';
		_x +=  '<td><input type="text" name="option_value[]" id="option_value[]" size="40"/></td>';
		_x +=  '<td><input type="text" name="position[]" id="position[]" size="10" /></td>';
		if( input_type == 'listbox'){
			_x +=  '<td align="center"><input type="checkbox" name="default[]" id="default[]" value="'+value+'" /></td>';
		}
		if( input_type == 'select'){
			_x +=  '<td align="center"><input type="radio" name="default[]" id="default[]" value="'+value+'" /></td>';
		}
		_x +=  '<td><a href="javascript:void(0);" class="delete_option" onclick="javascript:deleteOption(this);"><img title="Delete" src="'+SITEROOT+'/admin/templates/images/trash-icon.gif" /></a></td>';
		_x += '</tr>';
	
	$("#option_value").append(_x);
}


$(document).ready(function(){
	
	$("#input_type").change(function(){
		var input_type = $("#input_type").val();
		var _x = '<tr id="tr_default_value"><td width="25%" valign="top"><label for="default_value">Default value:</label></td><td>';
		//alert(input_type);
		
		$("#tr_default_value").remove();
		
		switch( input_type ){
			case "text":
				$("#option_value").remove();
				_x += '<input type="text" name="default_value" id="default_value" size="50"/>';
			break;
			case "textarea":
				$("#option_value").remove();
				_x += '<textarea name="default_value" id="default_value" cols="35" rows="5"/></textarea>';
			break;
			case "date":
				$("#option_value").remove();
				_x += '<input type="text" name="default_value" id="default_value" size="50"/>';
				
			break;
			case "yes_no":
				$("#option_value").remove();
				_x += '<select name="default_value" id="default_value"><option value="no">No</option><option value="yes">Yes</option></select>';
			break;
			case "listbox":
				if( $("#option_value").html() == null ){
					$("#append_options").append(append_options);
					$("#add_option").click(function(){ addOption(); });
					addOption();
				}
				var rowCount = 0;
				$("input[type=radio]").each(function(){
					if( $(this).attr("id") == 'default[]' ){
						var value = 'option_'+rowCount;
						var td = $(this).parent();
						$(this).remove();
						var _rc =  '<input type="checkbox" name="default[]" id="default[]" value="'+value+'" />';
						$(td).append(_rc);
						rowCount = parseInt(rowCount)+1;
					}
				});
			break;
			case "select":
				if( $("#option_value").html() == null ){
					$("#append_options").append(append_options);
					$("#add_option").click(function(){ addOption(); });
					addOption();
				}
				var rowCount = 0;
				$("input[type=checkbox]").each(function(){
					if( $(this).attr("id") == 'default[]' ){
						var value = 'option_'+rowCount;
						var td = $(this).parent();
						$(this).remove();
						var _rc =  '<input type="radio" name="default[]" id="default[]" value="'+value+'" />';
						$(td).append(_rc);
						rowCount = parseInt(rowCount)+1;
					}
				});
			break;
			case "price":
				$("#option_value").remove();
				_x += '<input type="text" name="default_value" id="default_value" size="50"/>';
			break;
		}
		_x += '</td><td>&nbsp;</td></tr>';
		if( input_type == 'listbox' || input_type == 'select' ){
			$("#tr_default_value").remove();
		}else{
			$("#option_value").remove();
			$("#tr_input_type").after(_x);
		}
		if( input_type == 'date' ){
			$( "#default_value" ).datepicker({ dateFormat: 'yy-mm-dd' });
		}
	});
	
	var validator = $("#save_attribute_info").validate({
		errorElement: 'div',
		rules: {
			attribute_code:{
				required: true,
				maxlength: 32,
				remote: SITEROOT + '/admin/master/ajax/attribute-save.php?action=validate_attribute_code'
			}
		},
		messages: {
			attribute_code:{
				required: "Please enter attribute code.",
				remote: "Attribute code is already available."
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

function deleteOption(el){
	$(el).parent().parent().remove();
}