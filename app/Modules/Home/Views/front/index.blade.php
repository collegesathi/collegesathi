@extends('layouts.default')
@section('content')

<section class="banner_section">
    <img src="{{ WEBSITE_IMG_URL }}bshape_01.png" alt="image" class="globeshape">

    <!--<div class="banner_img">
        <?php
$homeBannerImages = CustomHelper::getBlockdetail('banner-images');
        ?>
        {!! $homeBannerImages->description ?? '' !!}
    </div>-->
    <div class="carousel">
        <div class="slides">
            <!-- Add your banner images here -->
            <div class="slide"><img src="http://localhost/mukul/images/mains-banner2.png" srcset="http://localhost/mukul/images/mobile-bnr.png 600w, 
                         http://localhost/mukul/images/mains-banner2.png 1200w" sizes="(max-width: 600px) 100vw, 50vw"
                    class="img-fluid" alt="Banner 2"></div>
            <div class="slide"><img src="http://localhost/mukul/images/main-banner2.png" srcset="http://localhost/mukul/images/mobile-bnr.png 600w, 
                         http://localhost/mukul/images/main-banner2.png 1200w" sizes="(max-width: 600px) 100vw, 50vw"
                    class="img-fluid" alt="Banner 1"></div>
            <div class="slide"><img src="http://localhost/mukul/images/main-bn.png" srcset="http://localhost/mukul/images/mobile-bnr.png 600w, 
                         http://localhost/mukul/images/main-bn.png 1200w" sizes="(max-width: 600px) 100vw, 50vw"
                    class="img-fluid" alt="Banner 3"></div>
        </div>

        <!-- Carousel controls (optional) -->
        <!-- <div class="carousel_controls">
            <span class="prev" onclick="moveSlide(-1)">&#10094;</span>
            <span class="next" onclick="moveSlide(1)">&#10095;</span>
        </div> -->

        <!-- Dots (optional) -->
        <div class="dots">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>

    <div class="container">
        <div class="bannerFlex">
            <div class="banner_content">
                <?php
$homeBannerText = CustomHelper::getBlockdetail('banner-text');
                ?>
                {!! $homeBannerText->description ?? '' !!}
            </div>
        </div>
    </div>
</section>

<!-- ################ COLLABORATE UNIVERSITIES SECTION ################ -->
@include('elements.collaborate_universities_slider')
<!-- ################ COLLABORATE UNIVERSITIES SECTION ################ -->
 
<!-- ################ Explore Our Programs ################ -->
@include('elements.explore_programs')
<!-- ################ Explore Our Programs ################ -->

<!-- ################ QUESTION STEPS SECTION ################ -->
 @include('elements.question_steps')
<!-- ################ QUESTION STEPS SECTION ################ -->






<!-- ################ leading_universities SECTION ################ -->
@include('elements.leading_universities')
<!-- ################ leading_universities SECTION ################ -->


<!-- ################ Top Universities Programs ################ -->
@include('elements.top_universities')
<!-- ################ Top Universities Programs ################ -->


<!-- ################ TESTIMONIAL SECTION ################ -->
@include('elements.testimonial')
<!-- ################ TESTIMONIAL SECTION ################ -->


<!-- ################ need a reason to pick Collegesathi ################ -->
@include('elements.reason_to_pick')
<!-- ################ need a reason to pick Collegesathi ################ -->


<!-- ################ EXPERTS SLIDER SECTION ################ -->
@include('elements.experts_slider')
<!-- ################ EXPERTS SLIDER SECTION ################ -->





<!-- ################ BLOG SECTION ################ -->
@include('elements.blog')
<!-- ################ BLOG SECTION ################ -->





<!-- ################ Trending ################ -->
@include('elements.trending')
<!-- ################ Trending ################ -->

<!-- ################ Learner Support ################ -->
@include('elements.learner_support')
<!-- ################ Learner Support ################ -->


<div class="modal fade testimonial_modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ trans('front_messages.global.apply_jobs') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="readMoreTestimonial"></div>
            </div>
        </div>
    </div>
</div>




{{-- Enquire Now Popup Element --}}
@include('elements.enquire_now')
{{-- Enquire Now Popup Element --}}

{{-- Enquire Now Sticky Button Element --}}
@include('elements.enquire_now_sticky_button')
{{-- Enquire Now Sticky Button Element --}}

<style>
    .carousel {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
        position: relative;
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
        height: 100%;
        width: 100%;
        flex-wrap: nowrap;
    }

    .slide {
        min-width: 100vw;
        height: 100%;
        position: relative;
    }

    .slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* .carousel_controls {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
} */

    /* .prev, .next {
    cursor: pointer;
    font-size: 2rem;
    color: white;
    user-select: none;
} */

    .dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
    }

    .dot {
        cursor: pointer;
        height: 10px;
        width: 10px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .dot.active {
        background-color: #717171;
    }

    /* Responsive Styles for Mobile Devices */
    @media screen and (max-width: 768px) {
        /* Adjust the height for mobile */

        .slide img {
            /* height: 50vh;  Half the screen height on mobile devices */
            object-position: top center;
        }

        /* Adjust the controls for smaller screens */
        /* .carousel_controls .prev, .carousel_controls .next {
        padding: 12px;
        font-size: 20px;
    } */

        /* Adjust dots for mobile */
        .dot {
            height: 10px;
            width: 10px;
            margin: 0 3px;
        }
    }

    @media screen and (max-width: 480px) {

        /* Further adjust for very small mobile screens */
        .slide img {
            /* height: 40vh; Smaller height for very small screens */
            object-position: top center;
        }

        /* .carousel_controls .prev, .carousel_controls .next {
        padding: 10px;
        font-size: 18px;
    } */

        .dot {
            height: 8px;
            width: 8px;
        }
    }


.swiper-horizontal>.swiper-pagination-bullets,.swiper-pagination-bullets.swiper-pagination-horizontal,.swiper-pagination-custom,.swiper-pagination-fraction {
    bottom: var(--swiper-pagination-bottom,-3px);}

</style>
<style>
/* Common styles for both buttons */
.swiper-button-prev, .swiper-button-next {
    width: 38px;
    height: 33px;
    background-color: white; /* Button background */
    border-radius: 50%; /* Make it circular */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd; /* Light border */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth hover transition */
}

/* Arrow color */
.swiper-button-prev::after, .swiper-button-next::after {
    color: #888; /* Grey color for the arrow */
    font-size: 18px;
}

/* Hover effect */
.swiper-button-prev:hover, .swiper-button-next:hover {
    background-color: #f0f0f0; /* Light grey on hover */
}

/* Positioning */
.swiper-button-prev {
    left: -12px; /* Adjust this based on your layout */
}

.swiper-button-next {
    right: -1px; /* Adjust this based on your layout */
}
</style>

<script>
    let currentSlideIndex = 0;
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;

    function moveSlide(direction) {
        currentSlideIndex = (currentSlideIndex + direction + totalSlides) % totalSlides;
        updateSlidePosition();
    }

    function updateSlidePosition() {
        slides.style.transform = `translateX(-${currentSlideIndex * 100}vw)`;
    }

    function currentSlide(index) {
        currentSlideIndex = index - 1;
        updateSlidePosition();
    }

    // Automatically move to the next slide every 5 seconds
    setInterval(() => {
        moveSlide(1);
    }, 5000);



</script>

<script>
    $(document).ready(function () {
        $(".testimonial_read_more").on('click', function () {
            var id = $(this).data('id');
            var route = $(this).data('href');

            $.ajax({
                type: 'POST',
                url: route,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    id: id
                },
                success: function (data) {
                    $('#readMoreTestimonial').html(data.html);
                    $('#testimonial_modal').modal('show');
                }
            })
        })
    });
</script>
<!-- <script>
  var swiper = new Swiper('.swiper', {
    slidesPerView: 3, // Display 3 slides at a time
    spaceBetween: 30, // Add space between slides
    autoplay: {
      delay: 5000, // 5 seconds delay
      disableOnInteraction: false, // Keep autoplay running after interaction
    },
    loop: true, // Loop through slides
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script> -->
<script>
  var swiper = new Swiper('.swiper', {
    slidesPerView: 3, // Show 3 slides by default on large screens
    spaceBetween: 30, // Space between slides
    autoplay: {
      delay: 5000, // 5 seconds delay
      disableOnInteraction: false, // Autoplay keeps running after interaction
    },
    loop: true, // Loop the slides
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    // Responsive breakpoints
    breakpoints: {
      // When the window width is >= 320px (mobile phones)
      320: {
        slidesPerView: 1, // Show only 1 slide on mobile
        spaceBetween: 10, // Smaller space between slides
      },
      // When the window width is >= 768px (tablets)
      768: {
        slidesPerView: 2, // Show 2 slides on tablets
        spaceBetween: 20,
      },
      // When the window width is >= 1024px (desktops)
      1024: {
        slidesPerView: 3, // Show 3 slides on desktops
        spaceBetween: 30,
      },
    }
  });
</script>
@stop