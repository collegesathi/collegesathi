/* Login for customer */
$(document).ready(function() {
    phoneNumValidate('phoneNumber', 'phoneNumber', 'phone');

    if ($('#applyJobForm').length > 0) {
        applyJobFormValidations();
    }


    $(".upload-photo-action").click(function() {
        $('#resume').trigger('click');
    });  

    $('#resume').change(function() {
        checkUserDocumentSizeType('resume', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form',
            'resume_error_div');
    });

    $("input[name=resume]").on('change', function() {
        $('.input-file-name-resume').text(this.files[0].name);
    });


	$("#apply_Job_Model").on("show.bs.modal", function () {
		applyJobFormValidations();
	});


});

function getDetailsPopup(id, title) {
    $("#job_title_heading").html(title);
    $("#job_id").val(id);
    $("#apply_Job_Model").modal('show');
}

/**
 *  Function : validation for user signup form
 */
function applyJobFormValidations() {
    $('#applyJobForm').formValidation('destroy', true);
    $('#applyJobForm').formValidation({
            message: 'This value is not valid',
            fields: {
                'first_name': {
                    row: '.form-group',
                    err: '.first_name',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_FIRST_NAME
                        },
                    }
                },
                'last_name': {
                    row: '.form-group',
                    err: '.last_name',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_LAST_NAME
                        },
                    }
                },

                'email': {
                    row: '.form-group',
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
                    row: '.form-group',
                    err: '.not_valid_mobile',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_MOBILE_NO
                        },
                        numeric: {
                            message: ERROR_VALID_MOBILE_NO
                        },
                    }
                },
                'course_type': {
                    row: '.form-group',
                    err: '.course_type_error',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_COURSE_TYPE
                        },
                    }
                },
                'linkedin_profile': {
                    row: '.form-group',
                    err: '.linkedin_profile_error_div',
                    validators: {
                        notEmpty: {
                            message: ERROR_LINKDIN_PROFILE
                        },
                    }
                },
               'state': {
                    row: '.form-group',
                    err: '.state_error',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_STATE
                        },
                    }
                },
               'city': {
                    row: '.form-group',
                    err: '.city_error',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_CITY
                        },
                    }
                },
                'message': {
                    row: '.form-group',
                    err: '.message',
                    validators: {
                        notEmpty: {
                            message: REQUIRED_ERROR_MESSAGE
                        },
                    }
                },
                'resume': {
                    row: '.form-group',
                    err: '.resume',
                    validators: {
                        notEmpty: {
                            message: FILE_REQUIRED_ERROR_RESUME
                        },
                    }
                }

            },
        })
        .on('success.form.fv', function(e) {
            $("#applyJobForm .help-inline").empty();
            var form = $('#applyJobForm')[0];
            var formData = new FormData(form);
            formData.modal = "modal";
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: jobApply_url,
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
                    if (r.status == 'success') {
                        window.location.reload();
                    } else if (r.status == "error") {
                        unblockedUI();
                        $(".help-inline").empty();

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
        });

    /*
	$('#applyJobForm').formValidation('resetForm', {
        reset: true
    });
	*/
}

