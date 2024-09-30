@php
    $blogList = CustomHelper::getHomeBlogList();
@endphp


@if (!empty($blogList))
    <section class="blog_section">
        <div class="container">
            <div class="blog_main">
			
			<div class="headingCard">
			<h2 class="heading text-center"> {!! trans('front_messages.global.explore_our_latest_blog') !!}</h2>
            <p class="text-center paragraphline">We explore how these institutions are pushing the boundaries of technology and science.</p>
			  </div>
			
         
                <div class="item_slider ">
                    <div class="owl-carousel blog_slider owl-theme">

                        @foreach ($blogList as $blogData)
                            <div class="item">
                                <div class=" blog_content">

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

                                    <figure>
                                        <a href="{{route('Blog.postView',$blogData->slug)}}">
                                            {!! $image !!}
                                        </a>
                                    </figure>
									<div class="blogWrapper">
                                    <h3><a href="{{route('Blog.postView',$blogData->slug)}}">
                                            {{ isset($blogData->title) ? $blogData->title : 'N/A' }}</a></h3>
                                    <span>

                                        @php
                                            if (isset($blogData->addedByUser->user_role_id) && $blogData->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
                                                $addedBy = 'Admin';
                                            } else {
                                                $addedBy = $blogData->addedByUser->full_name;
                                            }

                                            $created_at        = CustomHelper::convert_date_to_timestamp($blogData->created_at);
                                            $blogDate       = date(BLOG_DETAIL_DATE_FORMAT,$created_at);

                                        @endphp

                                        {{ $blogDate }} | {{$addedBy}}
                                    </span>

                                    @php
                                        $description = isset($blogData->descriptionData->description) ? trim($blogData->descriptionData->description) : '';
                                        $description = !empty($description) ? strip_tags($description) : '';
                                        $description = !empty($description) ? Str::limit($description, BLOG_LIST_DESCRIPTION_LENGTH) : '';
                                    @endphp

                                    <p>{!! $description !!}</p>
									
                                    <div class="content_btn">
                                        <a href="{{route('Blog.postView',$blogData->slug)}}"
                                            class="btn-link">{{ trans('front_messages.global.read_more') }}</a>
                                    </div>
									 </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="blog_btn">
                    <a href="{{route('Blog.frontIndex')}}" class="btn btn-primary">
                        View All Blog</a>
                </div>
            </div>

        </div>
    </section>
@endif
