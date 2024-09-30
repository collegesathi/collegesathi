$(document).ready(function($) {
	
	$(document).on('click', "#openReviewPopUpButton", function() {
		$("#reviewRatingModal").modal('show');
	});


	$('textarea').keyup(function() {
		var textlen = maxLength - $(this).val().length;
		$('#rchars').text(textlen);
	});
	
	
	$('.rating').raty({
		path: WEBSITE_IMG_URL,
		targetKeep: true,
		readOnly: true,
		score: function() {
			return $(this).attr('data-score');
		}
	});
	

	$('.raty').raty({
		path: WEBSITE_IMG_URL,
		hints: ['Bad', 'Poor', 'Regular', 'Good', 'Gorgeous'],
		targetKeep: true,
		precision: false,
		half: false,
		readOnly: false,
		score: function() {
			return $(this).attr('data-score');
		},
		click: function(score, evt) {
			$(this).raty('score', score);
			$('#reviewSubmitForm').formValidation('revalidateField', 'score');
		}
	});
	
	
	$('#reviewSubmitForm').formValidation({
		message: 'This value is not valid',
		fields: {
			'score': {
				excluded: false,
				row: '.form_col_12',
				err: '.score',
				validators: {
					notEmpty: {
						message: RATING_REQUIRED_ERROR
					}
				}
			},
			'review_message': {
				row: '.form_col_12',
				err: '.review_message',
				validators: {
					notEmpty: {
						message: REVIEW_MESSAGE_REQUIRED_ERROR
					},
					stringLength: {
						max: REVIEW_MESSAGE_LENGTH,
						message: REVIEW_MESSAGE_MAX_LENGTH_ERROR
					}
				}
			},
		}
	}).on('success.form.fv', function(e) {
		var formData = new FormData($("#reviewSubmitForm")[0]);
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: reviewUrl,
			data: new FormData(this),
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			processData: false, // tell jQuery not to process the data
			contentType: false, // tell jQuery not to set contentType
			beforeSend: function() {
				blockedUI();
			},
			success: function(r) {
				// $(".error-message").empty();
				unblockedUI();
				if (r.status == 'success') {
					console.log(r);
					window.location.reload();
				}
				if (r.status == "error") {
					$(".error-message").empty();
					$.each(r.errors, function(index, value) {
						console.log(index + "--" + value);
						$("." + index).html(value);
					});
				}
				if (r.status == "errormessage") {
					window.location.reload();
				}
			}
		});
	});


	
	
	$(document).on('click', '#AllReviews', function() {
		var university_id = $(this).data('university_id');
		$.ajax({
			type: 'POST',
			url: viewAllReviewsUrl,
			data: {
				university_id: university_id
			},
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			beforeSend: function() {
				blockedUI();
			},
			success: function(res) {
				unblockedUI();
				console.log(res);
				if (res.status == 'success') {
					$("#ReviewsModal").modal('show');
					$(".all_reviews_data").html(res.html);
				}
			}
		});
	});

	
	$(document).on('blur', '.contactno', function() {
		SendOTP(mobileTextClass);
	});
	
	
	phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer', 'not_valid_mobile_customer');
            
			
	$(document).ready(function() {
		var dateOfBirth = 'dob';
		var calDateFormat = jsDateFormat;
		showDateInPast(dateOfBirth, calDateFormat);
	});
	
	
	window.onload = (event) => {      
		if (old_state == ''){
			getState(country, "state", "city", "state_div", "city_div", "applyUniversityForm", "", "form-select");
		}
	};
	
	
	
	
	
	$(window).resize(function() {
		setTimeout(otherUniversityqualheight(), 250);
	});

	$(window).on('load', function(event) {
 		otherUniversityqualheight();
	});

	setTimeout( otherUniversityqualheight(), 250);


	function otherUniversityqualheight() {
		if ($('.eq_otheruniversities').length > 0) {
			equalHeight($(".eq_otheruniversities"));
		}
	}
	
	
	
	
});



$(document).ready(function ($) {
    $('.responsive').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2500,
        speed: 2000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });


    $('.approved_crousel').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 1000,
        slidesToShow: 5,
        slidesToScroll: 5,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });


    $('.courses_crousel').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });


    $('.placementpartners_crousel').slick({
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 1000,
        speed: 1000,
        slidesToShow: 6,
        slidesToScroll: 6,
        responsive: [{
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
        ]
    });

    $('.image-popup-no-margins').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: false,
        fixedContentPos: true,
        mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
        image: {
            verticalFit: true
        },
        zoom: {
            enabled: true,
            duration: 300 // don't foget to change the duration also in CSS
        }
    });



    $('.blog_video_crousel').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 2000,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1191,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // tab slider show 

    $('.video_blogtab').on('shown.bs.tab', function (e) {
        $('.blog_video_crousel').slick('setPosition');
    })

    
});


