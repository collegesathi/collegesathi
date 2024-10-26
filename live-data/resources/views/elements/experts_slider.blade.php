@php

    $expertData = CustomHelper::getExpertData();

@endphp

@if(!empty($expertData))
    <section class="teachers-section py-5">
        <div class="container">
            <div class="header text-center mx-auto">
                <h2>Meet some of our <strong style="
    color: #EC1C24;
">Program Experts</strong></h2>
                <!-- <p>{{ trans('front_messages.global.brightest_minds_from_across_the_globe_help_message') }}</p> -->
            </div>
            <div class="body mt-4">
                <div class="swiper my-tech">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        @foreach($expertData as $expert)
                        <div class="swiper-slide">
                            <div class="card d-block border-0 p-0">
                            @php
                            $root_path = EXPERT_IMAGE_ROOT_PATH;
                            $http_path = EXPERT_IMAGE_URL;
                            $attribute = array();
                            $type = '';
                            $attribute['alt'] = $expert->name;
                            $attribute['width'] = '305';
                            $attribute['height'] = '350';
                            $attribute['cropratio'] = '1:1';
                            $attribute['zc'] = '1';
                            $attribute['type'] = '3';
                            $image_name =  $expert->image;                           
                            @endphp
                                <img src="{{ EXPERT_IMAGE_URL . $image_name}}" class="card-img obj-contain" height="310"
                                    alt="Mr. Chirag Nagpal">
                                <div class="body px-2 py-4 text-center">
                                    <h4 class="mb-1">{{isset($expert->name) ? $expert->name : "N/A"}}</h4>
                                    <div>
                                        <small class="pe-3">{{isset($expert->designation) ? $expert->designation : "N/A"}}</small>                                       
                                    </div>
                                    <p class="mb-3 mt-2">{{isset($expert->short_description) ? $expert->short_description : "N/A"}}</p>
                                    <a href="{{ route('survey.getAssist',$expert->slug) }}" class="btn btn-navi">Consult Now</a>
                                </div>
                            </div>
                        </div>
                        @endforeach                        
                    </div>

                    <!-- Add Pagination and Navigation -->
                    <!-- <div class="swiper-pagination"></div> -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .my-tech {
            width: 100%;
            height: 100%;
        }

        .teachers-section .header {
            max-width: 651px;
        }

        @media (max-width: 440px) {
            .my-tech .card {
                width: 68%;
                max-width: 100% !important;
                margin-left: 0 !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.my-tech')) {
                let tech = new Swiper('.my-tech', {
                    slidesPerView: 3,
                    spaceBetween: 0,
                    loop: true,
                    autoplay: {
                        delay: 8000,
                        disableOnInteraction: true,
                        pauseOnMouseEnter: true,
                        pauseOnMouseLeave: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    // pagination: {
                    //     el: '.swiper-pagination',
                    //     clickable: true,
                    // },
                    breakpoints: {
                        320: { slidesPerView: 1, spaceBetween: 0 }, /* For mobile */
                            450: { slidesPerView: 2, spaceBetween: 100 }, /* For mobile */
                            768: { slidesPerView: 2, spaceBetween: 105 }, /* For tablet */
                            1024: { slidesPerView: 2, spaceBetween: 100 }, /* For desktop */
                            1200: { slidesPerView: 3, spaceBetween: 0 }, /* For desktop */
                            1400: { slidesPerView: 3, spaceBetween: 0 } /* For desktop */
                    }
                });
            }
        });
    </script>
@endif