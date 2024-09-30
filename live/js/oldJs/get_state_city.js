$( document ).ready(function() {
    $('.autocomplete').select2();
});


/* get state dropdown */
function getState(country_id, stateName, cityName, stateDiv, cityDiv, formId, selected_value = '', classname = '',bankDiv) {
    var country_id 			= country_id;
    var state_field_name 	= stateName;
    var city_field_name 	= cityName;
    var stateDiv 			= stateDiv;
    var cityDiv 			= cityDiv;
    var formId 				= formId;
	
	$.ajax({
        url: getStateUrl,
        data: 	{
					'country_id': country_id,
					'state_field_name': state_field_name,
					'city_field_name': city_field_name,
					'cityDiv': cityDiv,
					'formId': formId,
					'classname': classname
				},
        type: "post",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        beforeSend: function() {
            blockedUI();
        },
        success: function(data) {

            unblockedUI();

            $("#" + stateDiv).empty();
            $("#" + stateDiv).html(data);
            if (selected_value != '') {
                $('.' + stateDiv + ' select').val(selected_value);
            }

            $('#' + cityDiv).empty();
            $('#' + cityDiv).append('<select class="autocomplete form-control show-tick' + classname + '" name="' + city_field_name + '" id="' + city_field_name + '"><option value=""> Please Select City </option></select>');

			if (formId != '' && (formId == 'updateProfileForm' || formId == 'customerSignUpForm')) {
				$('.autocomplete').select2();
                $('#' + formId +' #state').select2({ 'width': '100%', dropdownParent: $('#state_div'), dropdownPosition: 'below' });
                $('#' + formId +' #city').select2({ 'width': '100%', dropdownParent: $('#city_div'), dropdownPosition: 'below' });
            }
 
			if (formId != '') {
				$('#' + formId).formValidation('addField', state_field_name);
				$('#' + formId).formValidation('addField', city_field_name);
			}
        }
    });
}

/* get city dropdwon */
function getCity(state_id, cityName, cityDiv, formId, country_id = '', selected_value = "", classname = "") {
    var country_id 		= 	(country_id == '') ? $("#country").val() : country_id;
    var state_id 		= 	state_id;
    var city_field_name = 	cityName
    var cityDiv 		= 	cityDiv;
    var formId 			= 	formId;
    $.ajax({
        url: getCityUrl,
        data: { 'country_id': country_id, 'state_id': state_id, 'city_field_name': city_field_name, 'cityDiv': cityDiv, 'formId': formId, 'classname': classname },
        type: "post",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        beforeSend: function() {
            blockedUI();
        },
        success: function(data) {
            unblockedUI();
            $("#" + cityDiv).empty();
            $("#" + cityDiv).html(data);
            if (selected_value != '') {
                $('#' + cityDiv + ' select').val(selected_value);
            }

			if (formId != '' && (formId == 'updateProfileForm' || formId == 'customerSignUpForm')) {
				$('.autocomplete').select2();
                $('#' + formId +' #city').select2({ 'width': '100%', dropdownParent: $('#city_div'), dropdownPosition: 'below' });
            }
			
            if (formId != '') {
                $('#' + formId).formValidation('addField', city_field_name);
            }
        }
    });
}