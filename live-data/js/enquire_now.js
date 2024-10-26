$(document).ready(function () {
    $('#enquireNowForm').formValidation({
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
                    callback: {
                        message: '',
                        callback: function (value, validator, $field) {
                            if (!$.isNumeric(value) && value != '') {
                                validator.updateMessage('phone_number', 'callback', ERROR_ENTER_MOBILE_NO_NUMERIC);
                                return false;
                            }

                            if (value.length != 10 && $.isNumeric(value)) {
                                validator.updateMessage('phone_number', 'callback', ERROR_MOBILE_LENGTH);
                                return false;
                            }
                            return true;
                        }
                    },
                }
            },
            'dob': {
                row: '.form_col_12',
                err: '.contact_us_dob_error_div',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_DOB
                    }
                }
            },
            'state': {
                row: '.form_column',
                err: '.contact_state_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_STATE
                    },
                }
            },
            'city': {
                row: '.form_column',
                err: '.contact_city_error',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_CITY
                    },
                }
            },
            'otp_veryfy': {
                excluded: false,
                row: '.form_col_12',
                err: '.otp_error_div',
                validators: {
                    notEmpty: {
                        message: 'Please enter OTP.'
                    },
                }
            }
            
        }
    })
    .on('click', '#enquireNowForm', function (e) {
        var captcha = $('#enquireNowForm').find('[name="g-recaptcha-response"]').val();
        if (captcha === '') {
            $(".career-g-recaptcha-response_error").html('Please fill recaptcha.');
        }
        else {
            $(".career-g-recaptcha-response_error").html('');
            $("#enquire_now_btn").removeClass("disabled");
            $("#enquire_now_btn").removeAttr("disabled");
        }
    }).on('success.form.fv', function (e) {
            var form = $('#enquireNowForm')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: enquire_now_url,
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

                    // grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
                    //     document.getElementById('g-recaptcha-response-career').value = token;
                    // });

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