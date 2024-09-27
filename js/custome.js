
// responsive nav bar js open slide

$(document).ready(function () {
    $('.menu').click(function () {
        $('.navigation').toggleClass('open');
		$('.mobileAccordion').removeClass('show');
    });
});
$(document).ready(function () {
    $('.menu').click(function () {
        $(this).toggleClass('open');
    });
});
$(document).ready(function () {
    $('.close-toast').click(function () {
        $('.toast').toggleClass('toast_hide')
    })
});

// navigation open backdrop click close navigation 
$(document).ready(function () {
    $(".menu").click(function () {
        $(".overley_backdrop").toggleClass("overlay");

    });

});
$(".menu").click(function () {
    $('body').toggleClass("scroll_stop");

});

$(window).scroll(function () {
    var sticky = $('.placement_section'),
        scroll = $(window).scrollTop();

    if (scroll >= 450) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
});

$(window).scroll(function () {
    var sticky = $('header'),
        scroll = $(window).scrollTop();

    if (scroll >= 81) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
});






$('.search-button').click(function () {
    $(this).toggleClass('open');
    $('.search-dropdown').toggleClass('open');
});

$('.close-btn').click(function () {
    $('nav').removeClass('open');
});
$('.search-close-btn').click(function () {
    $('.search-dropdown').removeClass('open');
    $('.search-button').removeClass('open');
});

// 

// 

$('.search_box').click(function () {
    $('.search-open').addClass('open');
});

$('.search-close').click(function () {
    $('.search-open').removeClass('open');
});



$(document).ready(function () {

});
$('.accordion-collapse').on('shown.bs.collapse', function () {
    $(this).parent().addClass('panel-open');
});

$('.accordion-collapse').on('hidden.bs.collapse', function () {
    $(this).parent().removeClass('panel-open');
});


$(document).ready(function () {
    $(".colss-btn").on("click", function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .siblings(".mob-tab-view")
                .slideUp(200);
        } else {
            $(this)
            $(".colss-btn").removeClass("active");
            $(this).addClass("active");
            $(".mob-tab-view").slideUp(300);
            $(this)
                .siblings(".mob-tab-view")
                .slideDown(300);
        }
    });
});


// Slider js


        $('.universitiesWidth').slick({
            speed: 4000,
            autoplay: true,
            autoplaySpeed: 0,
            centerMode: false,
            cssEase: 'linear',
            slidesToShow: 1,
            draggable: false,
            focusOnSelect: false,
            pauseOnFocus: false,
            pauseOnHover: true,
            slidesToScroll: 1,
            variableWidth: true,
            infinite: true,
            initialSlide: 1,
            arrows: false,
            buttons: false
        });




$/*('.universities_carousel').owlCarousel({
    loop: true,
    margin: 60,
    center: true,
    autoWidth: true,
    autoplay: true,
	touchDrag: false,
    mouseDrag: false,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
	autoplayHoverPause:true,
    nav: false,
    responsive: {
        0: {
            nav: false,
        },
        600: {
        
            nav: false,
        },
        1000: {
          
        }
    }

})*/


$('.degrees').owlCarousel({
    loop: false, 
    margin: 24,
    responsiveClass: true,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 3000,
    autoplayHoverPause:true,
    nav: true,
	dots: false,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 3,
            loop: false
        }
    }

})

$('.universities_programs').owlCarousel({
    loop: false,
    margin: 30,
    responsiveClass: true,
    autoplay: false,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
    nav: true,
    // autoplayHoverPause:true,
    dots: false,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 2,
        }
    }

})
$('.blog_slider').owlCarousel({
    loop: false,
    margin: 20,
    responsiveClass: true,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
    nav: true,
	 dots: false,
    autoplayHoverPause:true,

    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: true
        },
        1000: {
            items: 3,
        }
    }

})

$('.trending_slider').owlCarousel({
    loop: false,
    margin: 30,
    responsiveClass: true,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
    nav: true,
    dots: false,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 2,
        },
        1000: {
            items: 3,
        }
    }

})
$('.experts_slider').owlCarousel({
    loop: false,
    margin: 20,
    responsiveClass: true,
    autoplay: false,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
    speed: 800,
    nav: true,
	dots: false,
    responsive: {
        0: {
            items: 1,
			margin:5,
            mouseDrag: true,
            pullDrag: true,
            touchDrag: true,
        },
        600: {
            items: 2,
        },
		 992: {
            items: 3,
        },
		
        1200: {
            items: 4,

        }
    }

})

// test

$(document).ready(function () {
    $('.testimonials-slider').owlCarousel({
        margin: 26,
        center: false,
        loop: true,
        autoplay: true,
        autoplaySpeed: 2500,
        autoplayTimeout: 5000,
        Speed: 800,
        nav: true,
        autoplayHoverPause:true,
        dots: false,
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            767: {
                items: 2,
                nav: true,
            },
            992: {
                items: 2,
				 margin: 10,
            },
            1200: {
                items: 3,
                nav: true,
            },
        }


    })
})

$('.counter_slider').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 2000,
    nav: false,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
            nav: false,
            mouseDrag: true,
            pullDrag: true,
            touchDrag: true,
        },
        600: {
            items: 3,
            nav: false
        },
        1000: {
            items: 5,
            loop: false,
            mouseDrag: false,
            pullDrag: false,
            touchDrag: false,
        }
    }

});
$('.approved_universities').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    autoplay: true,
    autoplaySpeed: 1500,
    autoplayTimeout: 3000,
    nav: false,
    dots: false,
    autoplayHoverPause:true,
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 1,

        },
        1000: {
            items: 1,
        }
    }

})


// counter js

const counters = document.querySelectorAll('.counter');
const speed = 200;

counters.forEach(counter => {
    const animate = () => {
        const value = +counter.getAttribute('data-target');
        const data = +counter.innerText;

        const time = value / speed;
        if (data < value) {
            counter.innerText = Math.ceil(data + time);
            setTimeout(animate, 1);
        } else {
            counter.innerText = value;
        }

    }

    animate();
});


// range slider

const range = document.querySelectorAll(".range-slider span input");
progress = document.querySelector(".range-slider .progress");
let gap = 0.1;
const inputValue = document.querySelectorAll(".numberVal input");

range.forEach((input) => {
    input.addEventListener("input", (e) => {
        let minRange = parseInt(range[0].value);
        let maxRange = parseInt(range[1].value);

        if (maxRange - minRange < gap) {
            if (e.target.className === "range-min") {
                range[0].value = maxRange - gap;
            } else {
                range[1].value = minRange + gap;
            }
        } else {
            progress.style.left = (minRange / range[0].max) * 100 + "%";
            progress.style.right = 100 - (maxRange / range[1].max) * 100 + "%";
            inputValue[0].value = minRange;
            inputValue[1].value = maxRange;
        }
    });
});





function addRemoveUniversityCompare(courseId, universityId, type, checkbox, page, route){
    $.ajax({
        url: route,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        data: { courseId:courseId, universityId:universityId, type:type, page:page },
        beforeSend: function() {
            blockedUI();
        },
        dataType:"json",
        success: function(res) {
            unblockedUI();
            
            if (res.limitStatus != '') {
                showErrorMessageTopRight(res.message);
                $(checkbox).prop('checked', false);
                $("#addToCompare"+universityId).text(ADD_TO_COMPARE);
            }

            if(res.count == 0){
                $("#compareModal").modal('hide');
            }
			else {
				$("#universityCompareList").html(res.html)
				$("#compareModal").modal('show');
			}

            if(res.route != ''){
                window.location = res.route;
            }
        }
    });
}




$(document).on('click','.addToCompare',function(){
    var universityId 	= 	$(this).data('university_id');
    var courseId 		= 	$('input[name="courses[]"]:checked').val() || $(this).data('course_id');
    var type = '';
    var page = '';
    var page_request = $(this).data('page_request') || '';
    
    if(page_request != ''){
        var type = '';
        $(this).text(ADDED_TO_COMPARE);
        /* var compareButton = $(this); */
        /* compareButton.prop('disabled', true); */
    }
	else{
        if(!$(this).prop('checked')){
            var type = 'remove';
        }
    }

    if(courseId == ''){
        showErrorMessageTopRight("{{trans('front_messages.global.please_select_course')}}")
    } 
    else{
        addRemoveUniversityCompare(courseId, universityId, type, this, page, universityCompareRoute);
    }
});




$(document).on('click','.remove-btn',function(){
    var universityId = $(this).data('university_id');
    var courseId = $(this).data('course_id') || '';
    var type = $(this).data('type');
    var page = '';
    
    var checkboxId	=	'Addtocompare'+universityId;
    $("#"+checkboxId).prop('checked', false);
    
	/*
	$("#universityCompareButton").prop('disabled',false);
    $("#addToCompare"+universityId).prop('disabled',false);
	*/
	
    $("#universityCompareButton").text('+ ' + ADD_TO_COMPARE);
    $("#addToCompare"+universityId).text(ADD_TO_COMPARE);
    
    addRemoveUniversityCompare(courseId, universityId, type, '', page, universityCompareRoute);
});

$('.megaMenu').mouseover(function(){
    $('body').addClass('menu-show')
})

$('.megaMenu').mouseout(function(){
    $('body').removeClass('menu-show')
})

