grecaptcha.ready(function() {
    grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
        document.getElementById('g-recaptcha-response-referral').value = token;
    });
});

$(document).ready(function() {

    $('#referal_form').formValidation({
        message: 'This value is not valid',
        fields: {
            'referee_name': {
                row: '.form_col_12',
                err: '.error_referee_name',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_FULL_NAME
                    }
                }
            },
            'referee_email': {
                row: '.form_col_12',
                err: '.error_referee_email',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_EMAIL_ADDRESS
                    },
                    emailAddress: {
                        message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                    },
                }
            },
            'referee_phone': {
                row: '.contact_number',
                err: '.error_referee_phone',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_MOBILE_NO
                    },
                    numeric: {
                        message: ERROR_ENTER_MOBILE_NO_NUMERIC
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: ERROR_MOBILE_LENGTH
                    }
                }
            },
            'referee_city': {
                row: '.form_col_12',
                err: '.error_referee_city',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_CITY
                    },
                }
            },

            'reference_name': {
                row: '.form_col_12',
                err: '.error_reference_name',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_FULL_NAME
                    }
                }
            },
            'reference_email': {
                row: '.form_col_12',
                err: '.error_reference_email',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_EMAIL_ADDRESS
                    },
                    emailAddress: {
                        message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                    },
                }
            },
            'reference_phone': {
                row: '.contact_number',
                err: '.error_reference_phone',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_MOBILE_NO
                    },
                    numeric: {
                        message: ERROR_ENTER_MOBILE_NO_NUMERIC
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: ERROR_MOBILE_LENGTH
                    }
                }
            },
            'reference_city': {
                row: '.form_col_12',
                err: '.error_reference_city',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_CITY
                    },
                }
            },
        }
    }).on('click', '#referal_form_btn', function(e) {
        var captcha = $('#referal_form').find('[name="g-recaptcha-response"]').val();
        if(captcha===''){
            $(".referral-g-recaptcha-response_error").html('Please fill recaptcha.');
        }
        else{
            $(".referral-g-recaptcha-response_error").html('');
            $("#referal_form_btn").removeClass("disabled");
            $("#referal_form_btn").removeAttr("disabled");
        }
    }).on('success.form.fv', function(e) {
        var formData 				= 	new FormData($("#referal_form")[0]);

        e.preventDefault();
         $.ajax({
            url: apply_referal_url,
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            beforeSend: function() {
                blockedUI();
            },
            success: function(data) {
                unblockedUI();
                
                grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
					document.getElementById('g-recaptcha-response-referral').value = token;
				});

                $('.error').empty();
                if (data.status == "success") {
                    window.location.reload();
                } else {
                    $.each(data.errors, function(key, value) {
                        $('.error_' + key).html(value);
                    });
                }
            }
        });
    });
});