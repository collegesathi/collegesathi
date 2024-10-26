grecaptcha.ready(function() {
    grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
        document.getElementById('g-recaptcha-response-scholarship').value = token;
    });
});


$(document).ready(function($) {
    $('#scholarship_form').formValidation({
        message: 'This value is not valid',
        fields: {
            'full_name': {
                row: '.form_col_12',
                err: '.error_full_name',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_FULL_NAME
                    }
                }
            },
             
            'email': {
                row: '.form_col_12',
                err: '.error_email',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_EMAIL_ADDRESS
                    },
                    emailAddress: {
                        message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                    },
                }
            },
            'phone': {
                row: '.form_col_12',
                err: '.error_phone',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_MOBILE_NO
                    },
                    callback: {
                        message: '',
                        callback: function (value, validator, $field) {
                            if (!$.isNumeric(value) && value != '') {
                                validator.updateMessage('phone', 'callback', ERROR_ENTER_MOBILE_NO_NUMERIC);
                                return false;
                            }

                            if (value.length != 10 && $.isNumeric(value)) {
                                validator.updateMessage('phone', 'callback', ERROR_MOBILE_LENGTH);
                                return false;
                            }
                            return true;
                        }
                    } 
                }  
            },

            'course': {
                row: '.form_col_12',
                err: '.error_course',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_COURSE
                    },
                }
            }, 
            'city': {
                row: '.form_col_12',
                err: '.error_city',
                validators: {
                    notEmpty: {
                        message: ERROR_SELECT_CITY
                    },
                }
            },
        }
    }).on('click', '#scholarship_form_btn', function(e) {
        var captcha = $('#scholarship_form').find('[name="g-recaptcha-response"]').val();
        if(captcha===''){
            $(".scholarship-g-recaptcha-response_error").html('Please fill recaptcha.');
        }
        else{
            $(".scholarship-g-recaptcha-response_error").html('');
            $("#scholarship_form_btn").removeClass("disabled");
            $("#scholarship_form_btn").removeAttr("disabled");
        }
    }).on('success.form.fv', function(e) {
        var formData 				= 	new FormData($("#scholarship_form")[0]);
        e.preventDefault();
         $.ajax({
            url: apply_scholarship_url,
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
					document.getElementById('g-recaptcha-response-scholarship').value = token;
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