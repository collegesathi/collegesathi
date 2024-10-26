

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
                    callback: {
                        message: '',
                        callback: function (value, validator, $field) {
                            if (!$.isNumeric(value) && value != '') {
                                validator.updateMessage('referee_phone', 'callback', ERROR_ENTER_MOBILE_NO_NUMERIC);
                                return false;
                            }

                            if (value.length != 10 && $.isNumeric(value)) {
                                validator.updateMessage('referee_phone', 'callback', ERROR_MOBILE_LENGTH);
                                return false;
                            }
                            return true;
                        }
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
                    callback: {
                        message: '',
                        callback: function (value, validator, $field) {
                            if (!$.isNumeric(value) && value != '') {
                                validator.updateMessage('reference_phone', 'callback', ERROR_ENTER_MOBILE_NO_NUMERIC);
                                return false;
                            }

                            if (value.length != 10 && $.isNumeric(value)) {
                                validator.updateMessage('reference_phone', 'callback', ERROR_MOBILE_LENGTH);
                                return false;
                            }
                            return true;
                        }
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