@php
    $blogList = CustomHelper::getTrendList();

@endphp
<section class="top-choice-uni top-choice my-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5">
                <div class="left-stuf txt-center-sm mb-lg-10">
                    <h2>Best <strong style="
    color: #EC1C24;
">Trending Specialization </strong> of 2024</h2>
                    <p>{{ trans('front_messages.global.specialization_heading_detail') }}</p>
                    <a href="{{route('Specialization.frontIndex')}}" class="btn btn-red sm-ds-none">View All</a>
                </div>
            </div>

            <div class="col-xl-7 position-relative">

                <div class="swiper my-trend">
                    <div class="swiper-wrapper">
                    @foreach ($blogList as $blogData)
                        <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            @php
                                        $root_path = TREND_IMAGE_ROOT_PATH;
                                        $http_path = TREND_IMAGE_URL;
                                        $attribute = [];
                                        $type = '';
                                        $attribute['alt'] = $blogData->title;
                                        $attribute['width'] = '404';
                                        $attribute['height'] = '258';
                                        $attribute['zc'] = '1';
                                        $attribute['type'] = '3';
                                        $image_name = $blogData->image;

                                        $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                                    @endphp
                                     <a href="{{route('Specialization.postView',$blogData->slug)}}">
                                            {!! $image !!}
                                        </a>
                                <!-- <img src="./assets/others/special1.png" alt="University Image" class="card-img-top" /> -->
                                <div class="px-2 py-2">
                                    <small>Specialization</small><br>
                                   <a href="{{route('Specialization.postView',$blogData->slug)}}"> <strong class="mb-2 d-block"  style="
    color:black;
">{{ isset($blogData->title) ? $blogData->title : 'N/A' }}</strong>
 @php
                                        $description = isset($blogData->descriptionData->description) ? trim($blogData->descriptionData->description) : '';
                                        $description = !empty($description) ? strip_tags($description) : '';
                                        $description = !empty($description) ? Str::limit($description, BLOG_LIST_DESCRIPTION_LENGTH) : '';
                                    @endphp
                                    <p class="d-flex align-items-center mb-0 mt-0">
                                        <img src="./assets/icons/redcircle.svg" alt="icon">
                                        <small class="ps-1"  style="
    color:black;
"> {!! $description !!}</small>
                                    </p>
                                
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <!-- <div class="swiper-pagination"></div> -->
                    <!-- Add Navigation -->
                    <!-- <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div> -->
                    <div class="swiper-button-next custom-next"></div>
                    <div class="swiper-button-prev custom-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>
    <style>
/* .swiper-container {
    width: 100%;
    height: 100%;
}

.top-choice p,
.top-choice small,
.top-choice strong {
    color: #000 !important;
} */



@media (max-width: 440px) {
    .card {
        width: 100%;
        /* max-width: 100% !important; */
        margin-left: 0 !important;
    }
}
</style>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.my-trend')) {
        let trend = new Swiper('.my-trend', {
            slidesPerView: 2,
            spaceBetween: -24, 
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                768: { slidesPerView: 2, spaceBetween: 15 },
                1024: { slidesPerView: 2, spaceBetween: 20 },
                1200: { slidesPerView: 2, spaceBetween: -24 },
            },
            on: {
                init: function () {
                    console.log('Swiper initialized');
                },
                slideChange: function () {
                    console.log('Slide changed');
                },
            },
        });
    }
});


</script>