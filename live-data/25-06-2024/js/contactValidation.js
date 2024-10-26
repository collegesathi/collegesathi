/** contact form validate here */
$(document).ready(function($) {
    $('#contactUsForm').formValidation({
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
            'dob': {
                row: '.form-group',
                err: '.contact_us_dob_error_div',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_DOB
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
            'university_id': {
                row: '.form-group',
                err: '.contact_university_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_UNIVERSITY
                    },
                }
            },
            'course_type': {
                row: '.form-group',
                err: '.contact_course_type_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_COURSE_TYPE
                    },
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
            'message': {
                row: '.form-group',
                err: '.contact_message_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_MESSAGE
                    },
                }
            }
        }
    }).on('click', '.submit_btn', function(e) {
		var captcha = $('#contactUsForm').find('[name="g-recaptcha-response"]').val();
		if(captcha===''){
			$(".g-recaptcha-response_error").html('Please fill recaptcha.');
		}
		else{
			$(".g-recaptcha-response_error").html('');
			$(".submit_btn").removeClass("disabled");
			$(".submit_btn").removeAttr("disabled");
		}
	});
});
