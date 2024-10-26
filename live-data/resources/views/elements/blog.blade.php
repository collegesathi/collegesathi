@php
    $blogList = CustomHelper::getHomeBlogList();
@endphp


@if (!empty($blogList))
    <section class="latest-articles my-5">
        <div class="container">
            <div class="headers text-center">
                <h2>Explore Our <strong style="
    color: #EC1C24;
"> Latest Blog </strong></h2>
                <p>We explore how these institutions are pushing the boundaries of technology and science.</p>
            </div>
            <div class="body mt-4">
                <div class="swiper my-blog">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        @foreach ($blogList as $blogData)
                                                <div class="swiper-slide">
                                                    <div class="card d-block border-0 p-0">
                                                        @php
                                                            $root_path = BLOG_IMAGE_ROOT_PATH;
                                                            $http_path = BLOG_IMAGE_URL;
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
                             <a href="{{route('Blog.postView', $blogData->slug)}}">
                                                            {!! $image !!}
                                                        </a>
                                                         <!-- <img src="./assets/articles/a1.png" class="card-img obj-contain" height="206" 
                                                        alt="Image 1"> -->
                                                        <div class="body px-3 py-4">
                                                            <p class="mb-2"><b><a href="{{route('Blog.postView',$blogData->slug)}}">
                                                            {{ isset($blogData->title) ? $blogData->title : 'N/A' }}</a></b></p>
                                                            @php
                                        $description = isset($blogData->descriptionData->description) ? trim($blogData->descriptionData->description) : '';
                                        $description = !empty($description) ? strip_tags($description) : '';
                                        $description = !empty($description) ? Str::limit($description, BLOG_LIST_DESCRIPTION_LENGTH) : '';
                                    @endphp
                                                            <span>{!! $description !!}</span>
                                                            <div class="date mt-3 d-flex align-items-center">
                                                            @php
                                            if (isset($blogData->addedByUser->user_role_id) && $blogData->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
                                                $addedBy = 'Admin';
                                            } else {
                                                $addedBy = $blogData->addedByUser->full_name;
                                            }

                                            $created_at        = CustomHelper::convert_date_to_timestamp($blogData->created_at);
                                            $blogDate       = date(BLOG_DETAIL_DATE_FORMAT,$created_at);

                                        @endphp
                                                                <img src="./assets/icons/date.svg" alt="icon">
                                                                {{ $blogDate }} | {{$addedBy}}
                                                            </div>
                                                        </div>
                                                        <div class="card-footer text-end border-0 pt-0 pb-3 mt-0">
                                                            <a href="{{route('Blog.postView',$blogData->slug)}}">
                                                                <span class="me-2">Read More</span>
                                                                <img src="./assets/icons/rightarrow.svg" alt="icon">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                        @endforeach
                        
                    </div>

                    <!-- Add Pagination and Navigation -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .my-blog {
            width: 100%;
            height: 100%;
        }

        .latest-articles .header h2 {
            color: var(--black);
        }

        @media (max-width: 440px) {
            .my-blog .card {
                width: 100%;
                max-width: 100% !important;

                margin-left: 0 !important;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.my-blog')) {
                var blog = new Swiper('.my-blog', {
                    slidesPerView: 3,
                    spaceBetween: 10,
                    loop: true,
                    autoplay: {
                        delay: 3300,
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
                        450: { slidesPerView: 2, spaceBetween: 120 }, /* For mobile */
                        768: { slidesPerView: 2, spaceBetween: 207 }, /* For tablet */
                        1024: { slidesPerView: 2, spaceBetween: 190 }, /* For desktop */
                        1200: { slidesPerView: 3, spaceBetween: 10 } /* For desktop */
                    }
                });
            }
        });
    </script>
@endif