/* Login for customer */
$(document).ready(function() {
    phoneNumValidate('phoneNumber', 'phoneNumber', 'phone');

    if ($('#applyUniversityForm').length > 0) {
        applyUniversityFormValidations();
    }

	$("#apply_Job_Model").on("show.bs.modal", function () {
		applyUniversityFormValidations();
	});   


});

function getDetailsPopup(id, title) {
    $("#job_title_heading").html(title);
    $("#uni_id").val(id);
    $("#apply_Job_Model").modal('show');
} 

/**
 *  Function : validation for user signup form 
 */
function applyUniversityFormValidations() {
    // $('#applyUniversityForm').formValidation('destroy', true);
    $('#applyUniversityForm').formValidation({
        
            message: 'This value is not valid',
            fields: {
                'full_name': {
                    row: '.form_col_12',
                    err: '.contact_us_full_name_error_div',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_FULL_NAME
                        }
                    }
                },
                'email': {
                    row: '.form_col_12',
                    err: '.email',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_EMAIL_ADDRESS
                        },
                        emailAddress: {
                            message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                        }
                    }
                },
                'phone_number': {
                    row: '.form_col_12',
                    err: '.not_valid_mobile',
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
                        }
                    }
                },
                'course_type': {
                    row: '.form_col_12',
                    err: '.course_type_error',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_COURSE_TYPE
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
                    row: '.form_col_12',
                    err: '.state_error',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_STATE
                        },
                    }
                },
               'city': {
                    row: '.form_col_12',
                    err: '.error_reference_city',
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
                },

            },
        })
        .on('success.form.fv', function(e) {
            $("#applyUniversityForm .help-inline").empty();
            var form = $('#applyUniversityForm')[0];
            var formData = new FormData(form);
            console.log(formData);
            var verfyOtp = $("#otp_veryfy").val();
            formData.modal = "modal";
            e.preventDefault();
            if(verfyOtp != ''){
                $.ajax({
                    type: 'POST',
                    url: universityApply_url,
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        blockedUI();
                    },
                    success: function(r) {
                        $('.help-inline').empty();
                        if (r.status == 'success') {
                            window.location.reload();
                        } else if (r.status == "error") {
                            unblockedUI();
                            if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !==
                                '') {
                                $.each(r.errors, function(index, value) {
                                        $("." + index).html(value);
                                });
                            } else {
                                showErrorMessageTopRight(r.message);
                            }
                        }
                    }
                });
            } else{
				swal("Please veryfy otp first.");
            }
        });

    /*
	$('#applyUniversityForm').formValidation('resetForm', {
        reset: true
    });
	*/
}

