$(document).ready(function() {
	
	/* Get Destination List */

	$('.get_destination').select2({
 		placeholder: 'Search Destination',
 		minimumInputLength: 3,
 		ajax: {
    		url: show_destinations_list_url,
    		dataType: 'json',
    		delay: 250,
    		type:"POST",
    		headers: {
				'X-CSRF-TOKEN': csrf_token
			},
    	
	    	processResults: function (data) {
	    		
	    		if (data.length) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.title,
                                id: item.id
                            }
                        })
                    };
                } else {

                	var inpTextId = 'google-place-id';
                    var countryInpId = 'country_id';
                    var stateInpId = 'state_id';
                    var cityInpId = 'city_id';

                    initMap(inpTextId, countryInpId, stateInpId, cityInpId);

                   

                }    

	      	},
	    	
	    	cache: true,
	    }
  		
  	});


  	/* Get Trip List */


	$('.get_trip').select2({
 		placeholder: 'Search Trip',
 		
  	}); 


  	/* Add Destination */

  	$(document).on('click', '.add_destination', function(e){

  		var formSerializeData = $('#adminAddDestinationExpert').serialize();
			
		$.ajax({
			url: add_destinations_url,
			method: 'POST',
			data: formSerializeData,
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			success: function(result){
				/* If user is logged-out then redirect to login page **/
				if(typeof(result.status) != "undefined" && result.status !== null && result.status == 'no_logged_in'){
					window.location.href = "{{ route('User.login', ['?return_url=Consultant.frontconsultantDestinations'])}}";
				}
				
				$(".error").html("");
				
				if(result.status=="error"){
					
					$.each( result.errors, function( key, value ) {
						$("."+key).html(value);
					});
				} else {
					
					showSuccessMessageTopRight(result.message);

					$('.destination_list').html(result.html);	

					resetSelect();
					
				}
			}	
		});
	});


  	/* Delete Destination */

	$(document).on('click', '.delete_destination', function(e){
		
		var id = $(this).attr('data-id');

		bootbox.confirm({
			message: deleteRecordMsg,
			buttons: {
				confirm: {
					className: 'btn btn-primary'
				},
				cancel: {
					className: 'btn btn-primary btn_theme_blue_color'
				}
			},
			callback: function (result) {
				if (result) {

					

					$.ajax({
						url: delete_destinations_url,
						method: 'POST',
						data:{'id':id},
						headers: {
							'X-CSRF-TOKEN': csrf_token
						},
						success: function(result){
							/* If user is logged-out then redirect to login page **/
							if(typeof(result.status) != "undefined" && result.status !== null && result.status == 'no_logged_in'){
								window.location.href = "{{ route('User.login', ['?return_url=Consultant.frontconsultantDestinations'])}}";
							}
								
							
							
							if(result.status=="success"){

								showSuccessMessageTopRight(result.message);

								$('.destination_list').html(result.html);		
							}
						}	
					});
				}
			}
		})			
	});


	/* Add Trip */

  	$(document).on('click', '.add_trip', function(e){
		
		var formSerializeData = $('#adminAddTripExpert').serialize();
		
		$.ajax({
			url: add_trip_url,
			method: 'POST',
			data:formSerializeData,
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			success: function(result){
				/* If user is logged-out then redirect to login page **/
				if(typeof(result.status) != "undefined" && result.status !== null && result.status == 'no_logged_in'){
					window.location.href = "{{ route('User.login', ['?return_url=Consultant.frontconsultantDestinations'])}}";
				}
				
				$(".error").html("");
				
				if(result.status=="error"){
					

					console.log(result.errors);

					$.each( result.errors, function( key, value ) {
						$("."+key).html(value);
					});
				} else {
					
					showSuccessMessageTopRightTrip(result.message);

					$('.trip_list').html(result.html);	

					resetSelect();
				}
			}	
		});
	});


  	/* Delete Trip */

	$(document).on('click', '.delete_trip', function(e){
		
		var id = $(this).attr('data-id');

		bootbox.confirm({
			message: deleteRecordMsg,
			buttons: {
				confirm: {
					className: 'btn btn-primary'
				},
				cancel: {
					className: 'btn btn-primary btn_theme_blue_color'
				}
			},
			callback: function (result) {
				if (result) {

					

					$.ajax({
						url: delete_trip_url,
						method: 'POST',
						data:{'id':id},
						headers: {
							'X-CSRF-TOKEN': csrf_token
						},
						success: function(result){
							/* If user is logged-out then redirect to login page **/
							if(typeof(result.status) != "undefined" && result.status !== null && result.status == 'no_logged_in'){
								window.location.href = "{{ route('User.login', ['?return_url=Consultant.frontconsultantDestinations'])}}";
							}
							
							if(result.status=="success"){

								showSuccessMessageTopRightTrip(result.message);

								var last_id = result.last_id;

								$('.trip_list').html(result.html);

									
							}
						}	
					});
				}
			}
		})			
	});
	

});

function showSuccessMessageTopRight(msg) {

	var html = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div>';

	$('.show_message').html(html);

}


function showSuccessMessageTopRightTrip(msg) {

	var html = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div>';

	$('.show_message_trip').html(html);

}


function resetSelect() {
	
	$('.get_destination, .get_trip').val(null).trigger('change');

} 



/**
 initMap GENERATE MAP
*/
function initMap(inpTextId, countryInpId, stateInpId, cityInpId) {
    let inputContainer = document.querySelector('autocomplete-input-container');
    /* let autocomplete_results 	= 	document.querySelector('.autocomplete-results'); */
    let autocomplete_results = document.querySelector('.select2-results__options');
    let sessionToken = new google.maps.places.AutocompleteSessionToken();
    let service = new google.maps.places.AutocompleteService();
    let geocoder = new google.maps.Geocoder();
    let autocomplete_input = document.getElementById(inpTextId);


    let displaySuggestions = function(predictions, status) {
        if (status != google.maps.places.PlacesServiceStatus.OK || !predictions) {
            return;
        }

        let results_html = [];
        predictions.forEach((prediction) => {
            results_html.push('<li class="autocomplete-item google-result" data-type="place" data-place-id= ' + prediction.place_id + '><span class="autocomplete-text">' + prediction.description + '</span></li>');
        });

        autocomplete_results.innerHTML = results_html.join("");
        autocomplete_results.style.display = 'block';
        let autocomplete_items = autocomplete_results.querySelectorAll('.autocomplete-item');

        
        

        for (let autocomplete_item of autocomplete_items) {
            autocomplete_item.addEventListener('click', function() {
                const selected_text = this.querySelector('.autocomplete-text').textContent;
                const place_id = this.getAttribute('data-place-id');
                geocoder
                    .geocode({ placeId: place_id })
                    .then(({ results }) => {
                        if (results[0]) {
                            fillupAddressFields(results[0], countryInpId, stateInpId, cityInpId, inpTextId);
                            autocomplete_input.value = selected_text;
                            autocomplete_results.style.display = 'none';
                        }
                    })
                    .catch((e) => window.alert("Geocoder failed due to: " + e));

                sessionToken = new google.maps.places.AutocompleteSessionToken();
            });
        }
    };


    let value = $('#google-place-id').val();
    value.replace('"', '\\"').replace(/^\s+|\s+$/g, '');
    if (value !== "" && (value.length >= 3)) {
        service.getPlacePredictions({
            input: value,
            sessionToken: sessionToken,
            fields: ['address_component', 'place_id']
        }, displaySuggestions);
    } else {
        autocomplete_results.innerHTML = '';
        autocomplete_results.style.display = 'none';
    }

}


/** FILLUP COUNTRY/STATE/CITY/LATITUTE/LONGITUTE ETC */
function fillupAddressFields(responses, countryInpId, stateInpId, cityInpId, inpTextId) {
    var countryMarker = addresComponent('country', responses, false);
    var stateMarker = addresComponent('administrative_area_level_1', responses, false);
    var cityMarker = addresComponent('locality', responses, false);
    var addressString = '';

    if (cityMarker == '') {
        var cityMarker = addresComponent('administrative_area_level_2', responses, false);
    }

    if ((typeof(cityInpId) != 'undefined') || (cityInpId != '')) {
        $('#' + cityInpId).val(cityMarker);
        addressString = cityMarker;
    }

    if ((typeof(stateInpId) != 'undefined') || (stateInpId != '')) {
        $('#' + stateInpId).val(stateMarker);
        addressString = addressString + ', ' + stateMarker;
    }

    if ((typeof(countryInpId) != 'undefined') || (countryInpId != '')) {
        $('#' + countryInpId).val(countryMarker);
        addressString = addressString + ', ' + countryMarker;
    }



    $('#' + inpTextId).val(responses.formatted_address);

    if (addressString) {
        $('.select2-selection__rendered').html(addressString);

        $('.get_trip').val(null).trigger('change');
    }
}


function debounce(func, wait, immediate) {
    let timeout;
    return function() {
        let context = this,
            args = arguments;
        let later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };

        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}


/** GET ADDRESS COMPONENTS */
function addresComponent(type, geocodeResponse, shortName) {
    for (var i = 0; i < geocodeResponse.address_components.length; i++) {
        for (var j = 0; j < geocodeResponse.address_components[i].types.length; j++) {
            if (geocodeResponse.address_components[i].types[j] == type) {
                if (shortName) {
                    return geocodeResponse.address_components[i].short_name;
                } else {
                    return geocodeResponse.address_components[i].long_name;
                }
            }
        }
    }
    return '';
}

