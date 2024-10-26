/* Login for customer */
$(document).ready(function() {

	if ($('#loginForm').length > 0) {
		loginFormValidations();
	}

	if ($('#forgotPasswordForm').length > 0) {
		forgotPasswordFormValidations();
	}

	if ($('#resetPasswordForm').length > 0) {
		resetPasswordFormValidations();
	}

	if ($('#customerSignUpForm').length > 0) {
		customerSignupFormValidations();
	}

     /* change password */
    if ($('#changePasswordForm').length > 0) {
        changePasswordFormValidations();
    }
``
	$('.password').on('click', '.visibility-icon', function () {
		var passInput = $(".password .form-control");
		if (passInput.attr('type') === 'password') {
			passInput.attr('type', 'text');
			$('.password img').prop('src', WEBSITE_IMG_URL + 'eye-icon-02.svg');
		} else {
			passInput.attr('type', 'password');
			$('.password img').prop('src', WEBSITE_IMG_URL + 'eye-closed-icon.svg');
		}
	});

	$('.cpassword ').on('click', '.visibility-cicon', function () {
		var cpassInput = $(".cpassword .form-control");
		if (cpassInput.attr('type') === 'password') {
			cpassInput.attr('type', 'text');
			$('.cpassword img').prop('src', WEBSITE_IMG_URL + 'eye-icon-02.svg');
		} else {
			cpassInput.attr('type', 'password');
			$('.cpassword img').prop('src', WEBSITE_IMG_URL + 'eye-closed-icon.svg');
		}
	});

	$('.confirm-password').on('click', '.visibility-icon', function() {
		var passInput = $(".confirm-password .form-control");
		if (passInput.attr('type') === 'password') {
			passInput.attr('type', 'text');
			$('.confirm-password img').prop('src', WEBSITE_IMG_URL + 'eye-icon-02.svg')
		} else {
			passInput.attr('type', 'password');
			$('.confirm-password img').prop('src', WEBSITE_IMG_URL + 'eye-closed-icon.svg')
		}
	});


	if ($('#customerSignUpForm').length > 0) {
		phoneNumValidate('phoneNumberCustomer','UserPhoneCustomer_error','phoneCustomer','stu_dial_codeCustomer','not_valid_mobile_customer');
	}
});

/**
 *  Function : validation for user login form
 */
function loginFormValidations() {
	$('#loginForm').formValidation('destroy', true);
	$('#loginForm').formValidation({
		message: 'This value is not valid',
		fields: {
			'email': {
				row: '.form-group',
				err: '.customer_login_email_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_EMAIL_ADDRESS
					},
					emailAddress: {
						message: ERROR_ENTER_VALID_EMAIL_ADDRESS
					}
				}
			},
			'password': {
				row: '.form-group',
				err: '.customer_login_password_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_PASSWORD
					},

				}
			},
		}
	}).on('success.form.fv', function(e) {
		e.preventDefault();
		login('loginForm');
	});
}


/**
 *  Function : validation for user forgot password form
 */
function forgotPasswordFormValidations() {
	$('#forgotPasswordForm').formValidation('destroy', true);
	$('#forgotPasswordForm').formValidation({
		message: 'This value is not valid',
		fields: {
			'email': {
				row: '.mws-form-item',
				err: '.user_account_email_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_EMAIL_ADDRESS
					},
					emailAddress: {
						message: ERROR_ENTER_VALID_EMAIL_ADDRESS
					}
				}
			}
		}
	}).on('success.form.fv', function(e, data) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: user_forgot_password_url,
			headers: { 'X-CSRF-TOKEN': csrf_token },
			data: $("#forgotPasswordForm").serialize(),
			beforeSend: function() { blockedUI(); }, 
			success: function(r) {

				/* If user is logged-out then redirect to login page **/
				if (typeof(r.status) != "undefined" && r.status !== null && r.status == 'no_logged_in') {
					window.location.href = return_url;
				}

				if (r.status == "success") {
					if (r.from == 'email') {
						window.location.reload();
					}
					else {
						showSuccessMessageTopRight(r.message);
					}
				}
				else if (r.status == "error") {

					$(".help-inline").empty();

					if (r.message != '') {
						showErrorMessageTopRight(r.message);
					}

					if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !== '') {
						$.each(r.errors, function(index, value) {
							$("." + index).html(value);
						});
					}
					else {
						showErrorMessageTopRight(r.message);
					}
				}
				else if (r.status == "success_message") {
					window.location.reload();
				}
				else {
					$('.email_err').html(r.msg);
				}
				unblockedUI();
			}
		});
	});

	$('#forgotPasswordForm').formValidation('resetForm', { reset: true });
}


/**
 *  Function : validation for reset password form
 */
function resetPasswordFormValidations() {
	$('#resetPasswordForm').formValidation('destroy', true);
	$('#resetPasswordForm').formValidation({
		message: 'This value is not valid',
		fields: {
			'password': {
				row: '.form-group',
				err: '.user_signup_password_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_PASSWORD
					},
					regexp: {
						regexp: PASSWORD_REGX,
						message: PASSWORD_HELP_MESSAGE
					}
				}
			},
			'confirm_password': {
				row: '.form-group',
				err: '.user_signup_confirm_password_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_CONFIRM_PASSWORD
					},
					identical: {
						field: 'password',
						message: ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH
					},
				}
			},
		}
	}).on('success.form.fv', function(e) {
		e.preventDefault();
		var reset_password_submit_url = reset_password_url;
		signup('resetPasswordForm', reset_password_submit_url);
	});

	$('#resetPasswordForm').formValidation('resetForm', { reset: true });
}


/**
 *  Function : validation for user signup form
 */
function customerSignupFormValidations() {
	$('#customerSignUpForm').formValidation('destroy', true);
	$('#customerSignUpForm').formValidation({
		message: 'This value is not valid',
		fields: {
			'first_name': {
				row: '.form-group',
				err: '.user_signup_first_name_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_FIRST_NAME
					}
				}
			},
            'last_name': {
				row: '.form-group',
				err: '.user_signup_last_name_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_LAST_NAME
					}
				}
			},
			'email': {
				row: '.form-group',
				err: '.user_signup_email_error',
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
				err: '.student_signup_phone_error',
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
			'password': {
				row: '.form-group',
				err: '.user_signup_password_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_PASSWORD
					},
					regexp: {
						regexp: PASSWORD_REGX,
						message: PASSWORD_HELP_MESSAGE
					}
				}
			},
			'confirm_password': {
				row: '.form-group',
				err: '.user_signup_confirm_password_error',
				validators: {
					notEmpty: {
						message: ERROR_ENTER_CONFIRM_PASSWORD
					},
					identical: {
						field: 'password',
						message: ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH
					},
				}
			},
			'terms': {
				row: '.form-group',
				err: '.terms_error',
				validators: {
					notEmpty: {
						message: ERROR_TERMS_CONDITIONS
					}
				}
			},
		},
	})
	/* .on('success.field.fv', '[name="email"]', function(e, data) {
		$("#customerSignUpForm .help-inline.email").empty();
	}) */
	.on('success.form.fv', function(e) {
		$("#customerSignUpForm .help-inline").empty();
		var signup_url = customer_signup_url;
        var form = $('#customerSignUpForm')[0];
        var formData = new FormData(form);
        formData.modal = "modal";
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: signup_url,
            headers: { 'X-CSRF-TOKEN': csrf_token },
            //data: formData + "&modal=modal",
            data : formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                blockedUI();
            },
            success: function(r) {
                if (r.status == 'success') {
                    window.location.href = r.url;
                }
                else if (r.status == "error") {
                    unblockedUI();
                    $(".help-inline").empty();

                    if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !== '') {
                        $.each(r.errors, function(index, value) {
                            if('confirm_password' == index){
                                $(".error." + index).html(value);
                            }
                            else {
                                $("." + index).html(value);
                            }
                        });
                    } else {
                        showErrorMessageTopRight(r.message);
                    }
                }
            }
        });
	});

	$('#customerSignUpForm').formValidation('resetForm', {
		reset: true
	});
}


/**
 *  Function : signup for user
 */
function signup(formId, signup_url) {
	$.ajax({
		type: 'POST',
		url: signup_url,
		data: $("#" + formId).serialize() + "&modal=modal",
		beforeSend: function() {
			blockedUI();
		},
		success: function(r) {
			if (r.status == 'success') {
				window.location.href = r.url;
			}
			else if (r.status == "error") {
				unblockedUI();
				$(".help-inline").empty();

				if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !== '') {
					$.each(r.errors, function(index, value) {
						if('confirm_password' == index){
							$(".error." + index).html(value);
						}
						else {
							$("." + index).html(value);
						}
					});
				} else {
					showErrorMessageTopRight(r.message);
				}
			}
		}
	});
}


/**
 *  Function : login for user
*/
function login(formId) {
	$.ajax({
		type: 'POST',
		url: user_login_url,
		data: $("#" + formId).serialize() + "&modal=modal",
		beforeSend: function() {
			blockedUI();
		},
		success: function(r) {
			unblockedUI();
			if (r.status == 'success') {
				window.location.href = r.url;
			}

			if (r.status == "error") {
				showErrorMessageTopRight(r.message);
			}
		}
	});
}



/**
 *  Function : validation for change password form
 */
function changePasswordFormValidations() {
    $('#changePasswordForm').formValidation('destroy', true);
    $('#changePasswordForm').formValidation({
        message: 'This value is not valid',
        trigger: 'blur',
        fields: {
            'old_password': {
                row: '.form-group',
                err: '.user_edit_old_password_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_OLD_PASSWORD
                    },
                }
            },
            'new_password': {
                row: '.form-group',
                err: '.user_edit_new_password_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_NEW_PASSWORD
                    },
                    regexp: {
                        regexp: PASSWORD_REGX,
                        message: PASSWORD_HELP_MESSAGE
                    }
                }
            },
            'confirm_password': {
                row: '.form-group',
                err: '.user_edit_confirm_password_error',
                validators: {
                    notEmpty: {
                        message: ERROR_ENTER_CONFIRM_PASSWORD
                    },
                    callback: {
                        message: ERROR_PASSWORD_CONFIRM_PASSWORD_NOT_MATCH,
                        callback: function(value, validator, $field) {
                            var newPassword = validator.getFieldElements('new_password').val();
                            if (value === '') {
                                return true;
                            }
                            return value === newPassword;
                        }
                    }
                }
            },

        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        changePassword('changePasswordForm', change_password_url);
    });

    $('#changePasswordForm').formValidation('resetForm', { reset: true });
}


function changePassword(formId, change_password_url) {
    $.ajax({
        type: 'POST',
        url: change_password_url,
        data: $("#" + formId).serialize() + "&modal=modal",
        beforeSend: function() {
            blockedUI();
        },
        success: function(r) {
            unblockedUI();
            if (r.status == 'success') {
                window.location.href = r.url;
            } else if (r.status == "error") {
                $(".help-inline").empty();

                if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !== '') {
                    $.each(r.errors, function(index, value) {
                        if('confirm_password' == index){
							$(".error." + index).html(value);
						}
						else {
							$("." + index).html(value);
						}
                    });
                } else {
                    showErrorMessageTopRight(r.message);
                }
            }
        }
    });
}






function referAFriend(formId, refer_promocode_url) {

    $.ajax({
        type: 'POST',
        url: refer_promocode_url,
        data: $("#" + formId).serialize() + "&modal=modal",
        beforeSend: function() {
            blockedUI();
        },
        success: function(r) {
            unblockedUI();
            if (r.status == 'success') {
                window.location.reload();
            } else if (r.status == "error") {
                $(".help-inline").empty();
                if (typeof(r.errors) != "undefined" && r.errors !== null && r.errors !== '') {
                    $.each(r.errors, function(index, value) {
							$("." + index).html(value);
                    });
                } else {
                    showErrorMessageTopRight(r.message);
                }
            }
        }
    });
}


