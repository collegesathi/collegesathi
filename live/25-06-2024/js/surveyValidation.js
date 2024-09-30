/** survey form validate here */
$(document).ready(function($) {
    $('#surveyForm').formValidation({
        message: 'This value is not valid',
        fields: {
            'full_name': {
                row: '.form-group',
                err: '.contact_us_full_name_error_div',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_FULL_NAME
                    }
                }
            },
            'email': {  
                row: '.form-group',
                err: '.contact_email_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_EMAIL_ADDRESS
                    },
                    emailAddress: {
                        message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                    },
                }
            },
            'phone_number': {
                row: '.form-group',
                err: '.contact_us_phone_number_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_MOBILE_NO
                    },
                }
            },
            'dob': {
                row: '.form-group',
                err: '.contact_us_dob_error_div',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_DOB
                    }
                }
            },

            'state': {
                row: '.form-group',
                err: '.contact_state_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_STATE
                    },
                }
            },
            'city': {
                row: '.form-group',
                err: '.contact_city_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_CITY
                    },
                }
            },
            'otp_veryfy': {
                excluded: false,
                row: '.form-group',
                err: '.otp_error_div',
                validators: {
                    notEmpty: {
                        message: 'Please enter OTP.'
                    },
                }
            }
        }
    }).on('click', '.submit_btn', function(e) { 
        
		var captcha = $('#surveyForm').find('[name="g-recaptcha-response"]').val();
		if(captcha===''){
			$(".g-recaptcha-response_error").html('Please fill recaptcha.');
		}
		else{
			$(".g-recaptcha-response_error").html('');
			$(".submit_btn").attr('disabled',false);
		}
	});
});
