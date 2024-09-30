$(document).ready(function() {
    $(".load_more").click(function() {
        var page = $(this).attr('data-page');
        $.ajax({
            url: load_more_career_page_url,
            data: {
                page: page
            },
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            beforeSend: function() {
                blockedUI();
            },
            success: function(data) {
                unblockedUI();
                if (data.status == "success") {
                    $(".career_list").append(data.html);
                    if (data.nextPage == data.currentPage) {
                        $(".seemore").remove();
                    } else {
                        $(".load_more").attr('data-page', data.nextPage);
                        $("#total_count").html(data.totalCount);
                    }
                } 
            }
        });
    });




    $(document).on('click', '.apply_career', function() {
        var career_id = $(this).attr('data-career_id');
        var job_title = $(this).attr('data-job_title');
        $("#career_id").val(career_id);
        $("#job_position").val(job_title);
    });



	// grecaptcha.ready(function() {
	// 	grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
	// 		document.getElementById('g-recaptcha-response-career').value = token;
	// 	});
	// });



    $('#career_apply_form').formValidation({
            message: 'This value is not valid',
            fields: {
                'full_name': {
                    row: '.form-group',
                    err: '.error_full_name',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_FULL_NAME
                        },
                    }
                },
                'email_address': {
                    row: '.form-group',
                    err: '.error_email_address',
                    validators: {
                        notEmpty: {
                            message: ERROR_ENTER_EMAIL_ADDRESS
                        },
                        emailAddress: {
                            message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                        }
                    }
                },
                'mobile_number': {
                    row: '.form-group',
                    err: '.error_mobile_number',
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
                'job_position': {
                    row: '.form-group',
                    err: '.error_job_position',
                    validators: {
                        notEmpty: {
                            message: ERROR_SELECT_COURSE_TYPE
                        },
                    }
                },
                'description': {
                    row: '.form-group',
                    err: '.error_description',
                    validators: {
                        notEmpty: {
                            message: REQUIRED_ERROR_DESCRIPTION
                        },
                    }
                },
                'upload_cv': {
                    row: '.form-group',
                    err: '.error_upload_cv',
                    excluded: false,  
                    validators: {
                        notEmpty: {
                            message: REQUIRED_ERROR_CV
                        },
                        file: {
                            extension: 'pdf,doc,docx',
                            type: 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            message: VALID_ERROR_CV,
                        }
                    }
                },
            },
        }).on('click', '#career_apply', function(e) {
           
			var captcha = $('#career_apply_form').find('[name="g-recaptcha-response"]').val();
			if(captcha===''){
				$(".career-g-recaptcha-response_error").html('Please fill recaptcha.');
			}
			else{
				$(".career-g-recaptcha-response_error").html('');
				$("#career_apply").removeClass("disabled");
				$("#career_apply").removeAttr("disabled");
			}
		})
        .on('success.form.fv', function(e) {
         
            var form = $('#career_apply_form')[0];
            var formData = new FormData(form);
            e.preventDefault();
            $.ajax({
                url: apply_career_url,
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