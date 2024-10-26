@extends('layouts.default')
@section('content')

<!-- <section class="home-banner d-flex align-items-center">

        <div class="container">
            <div class="content">
                <h1>Find Your Perfect University <br> Program Today</h1>
                <p>Compare top programs from over 100+ verified universities. Join thousands of students in making informed decisions for a brighter future.</p>
                <a href="#" class="btn btn-red">Start Your Journey Today</a>
            </div>
        </div>
    </section>    -->

    <section class="banner_section">
    <!-- <img src="{{ WEBSITE_IMG_URL }}bshape_01.png" alt="image" class="globeshape"> -->

    <!--<div class="banner_img">
        <?php
        $homeBannerImages = CustomHelper::getBlockdetail('banner-images');
        ?>
        {!! $homeBannerImages->description ?? '' !!}
    </div>-->
    <div class="carousel">
        <div class="slides">
            <!-- Add your banner images here -->
            <div class="slide"><img src="images/mains-banner2.png" srcset="images/mbl-bnner.png 600w, 
                         images/mains-banner2.png 1200w" 
                 sizes="(max-width: 600px) 100vw, 50vw" class="img-fluid" alt="Banner 2"></div>
            <div class="slide"><img src="images/Website-main-banner.png" srcset="images/mbl-bnner.png 600w, 
                         images/Website-main-banner.png 1200w" 
                 sizes="(max-width: 600px) 100vw, 50vw" class="img-fluid" alt="Banner 1"></div>          
            <div class="slide"><img src="images/main-bn.png" srcset="images/mbl-bnner.png 600w, 
                         images/main-bn.png 1200w" 
                 sizes="(max-width: 600px) 100vw, 50vw" class="img-fluid" alt="Banner 3"></div>
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
<section class="top-cards">
        <div class="container">
            <div class="card-container d-flex justify-content-between mx-auto flex-wrap">
                <div class="top-card mb-lg-10 d-flex flex-column justify-content-center align-items-center px-2">
                    <h3 class="mb-0">170+</h3>
                    <p class="mb-0 pb-0">programs</p>
                </div>
                <!-- <div class="top-card mb-lg-10 d-flex flex-column justify-content-center align-items-center px-2">
                    <h3 class="mb-0">100K+</h3>
                    <p class="mb-0 pb-0">students</p>
                </div> -->
                <!-- <div class="top-card mb-lg-10 d-flex flex-column justify-content-center align-items-center px-2">
                    <h3 class="mb-0">350+</h3>
                    <p class="mb-0 pb-0">experts mentors</p>
                </div> -->
                <div class="top-card mb-lg-10 d-flex flex-column justify-content-center align-items-center px-2">
                    <h3 class="d-flex align-items-center mb-0">
                        <span>4.2</span>
                        <img src="./assets/icons/star.svg" alt="icon">
                    </h3>
                    <p class="mb-0 pb-0">rating by students</p>
                </div>
            </div>
        </div>
    </section>
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

<!-- ################ tips ################ -->
@include('elements.quick_tips')
<!-- ################ tips ################ -->

<!-- ################ faq ################ -->
@include('elements.faq')
<!-- ################ faq ################ -->

<!-- ################ Learner Support ################ -->
@include('elements.learner_support')
<!-- ################ Learner Support ################ -->


<div class="modal fade testimonial_modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
/* .home-banner {
    height: 360px;
    background: url('./assets/banners/homebanner.png');
}

.home-banner .content p{
    max-width: 540px;
} */
</style>

<style>
.card-container {
    max-width: 473px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.card-container .top-card {
    width: 200px;
    min-height: 74px;
    border-radius: 8px;
}

@media (max-width: 500px) {
    .card-container {
        justify-content: center;
    }

    .card-container .top-card {
        width: calc(50% - 10px);
        /* Adjust width to fit 2 cards per row with some space between */
        margin-bottom: 10px;
        text-align: center !important;
    }
}
</style>
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
        /* height: 50vh; Half the screen height on mobile devices */
        object-position: top center;
    }

    /* Adjust the controls for smaller screens */
    /* .carousel_controls .prev, .carousel_controls .next {
        padding: 12px;
        font-size: 20px;
    } */

    /* Adjust dots for mobile */
    .dot {
        height: 7px;
        width: 6px;
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
        height: 7px;
        width: 6px;
    }
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
}, 7000);



</script>

<script>
    $(document).ready(function() {
        $(".testimonial_read_more").on('click', function() {
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
                success: function(data) {
                    $('#readMoreTestimonial').html(data.html);
                    $('#testimonial_modal').modal('show');
                }
            })
        })
    });
</script>

@stop