@extends('layouts.default')
@section('content')
@php
$afterblogAdsshow = FRONT_BLOG_PER_PAGE - 1;
@endphp
<?php
// echo 1; die;
?>
<section class="common_banner contactus_banner blog_listingbanner">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="inner_page_banner blog_heading">
                    <span>{{ trans('front_messages.global.blogs') }}</span>
                    <h1>{{ trans('front_messages.global.updates_on_the_latest_career_opportunities') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="blog_listing_section">
    <div class="container">
        @if(!empty($featured_posts))
        <div class="blog_banner_slider">
            <h2 class="blog_posts_heading">{{ trans('front_messages.global.featured_blog_posts') }}</h2>
            <div class="bg-white box_shadow">
                <div class="slider responsive">
                    @foreach ($featured_posts as $featured_post)
                    <div class="blog_item d-flex">
                        <div class="featured_blog">

                            @php
                            $root_path = BLOG_IMAGE_ROOT_PATH;
                            $http_path = BLOG_IMAGE_URL;
                            $attribute = [];
                            $type = '';
                            $attribute['alt'] = $featured_post->title;
                            $attribute['width'] = '547';
                            $attribute['height'] = '312';
                            $attribute['zc'] = '0';
                            $attribute['type'] = '3';
                            $image_name = $featured_post->image;

                            $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                            @endphp


                            <figure>
                                {!! $image !!}
                            </figure>
                        </div>
                        <div class="featured_blog_content">
                            <h2>{{ isset($featured_post->title) ? $featured_post->title : 'N/A' }}</h2>
                            <div class="author_details">

                                @php
                                if (isset($featured_post->addedByUser->user_role_id) && $featured_post->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
                                $featuredAddedBy = 'Admin';
                                } else {
                                $featuredAddedBy = $blogData->addedByUser->full_name;
                                }

                                $featured_created_at = CustomHelper::convert_date_to_timestamp($featured_post->created_at);
                                $featuredBlogDate = date(BLOG_DETAIL_DATE_FORMAT, $featured_created_at);

                                @endphp
                                <span>by <a href="javascript:void(0);">{{$featuredAddedBy}}</a> </span> <span>- {{$featuredBlogDate}}</span>
                            </div>

                            @php
                            $featuredDescription = isset($featured_post->descriptionData->description) ? trim($featured_post->descriptionData->description) : '';
                            $featuredDescription = !empty($featuredDescription) ? strip_tags($featuredDescription) : '';
                            $featuredDescription = !empty($featuredDescription) ? Str::limit($featuredDescription, 300) : '';
                            @endphp

                            <p>{!! $featuredDescription !!}</p>

                            <div class="blog_banner_icon">
                                <div class="icon d-flex latest_postsicon share-wrapper">
                                    <figure>
                                        <a href="javascript:void(0);">
                                            <img class="share_icon share" src="{{ WEBSITE_IMG_URL }}share_network_icon.svg" alt="">
                                            <img class="share_icon_white share" src="{{ WEBSITE_IMG_URL }}share_network_icon_white.svg" alt="">
                                        </a>

                                    </figure>

                                    <div class="share-btns">
                                        <a target="_blank" href="https://www.facebook.com/sharer.php?u={{ route('Blog.postView', $featured_post->slug) }}&amp;t={{ $featured_post->title }}">
                                            <i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i></a>
                                        <a target="_blank" href="https://twitter.com/home/?status={{ $featured_post->title }} - {{ route('Blog.postView', $featured_post->slug) }}">
                                            <i class="fa fa-twitter-square fa-2x" aria-hidden="true">
                                            </i>
                                        </a>
                                        <a target="_blank" href="https://www.instagram.com/?url={{ route('Blog.postView', $featured_post->slug) }}"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                                        </a>
                                        <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('Blog.postView', $featured_post->slug) }}&amp;title={{ $featured_post->title }}"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i>
                                        </a>
                                        <a target="_blank" href="https://api.whatsapp.com/send?text=The text to share!={{ route('Blog.postView', $featured_post->slug) }}&amp;title={{ $featured_post->title }}"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="blog_btnbox">
                                    <a href="{{ route('Blog.postView', $featured_post->slug) }}" class="btn btn-outline-primary"> {{ trans('front_messages.global.read_more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="blog_listing d-flex">
            <div class="latest_posts">
                <h3> {{ trans('front_messages.global.latest_posts') }}</h3>
                <ul class="blog-append-list">

                    @foreach ($blogResult as $blog)
                    <li>
                        @include('elements.single_blog_list', ['blogData' => $blog])
                    </li>
                    @endforeach

                </ul>
                @if ($last_page > ACTIVE)
                <div class="loadmore content_btn text-center mb-5">
                    <a href="javascript:void(0);" class="btn btn-primary load_more" id="load_more" data-page="{{$search_string}}">
                        {{ trans('front_messages.global.view_more') }}
                    </a>
                </div>
                @endif
            </div>

            @if(!empty($trending_posts))
            <div class="trending_posts">
                <h2>{{ trans('front_messages.global.trending_posts') }}</h2>
                <a class="posts_menu accordion_filter collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    {{ trans('front_messages.global.trending_posts') }}
                </a>

                <div class="collapse" id="collapseExample">
                    <ul class="trending_posts_listing">
                        @foreach($trending_posts as $trending_post)
                        <li>
                            <h5><a href="{{ route('Blog.postView', $trending_post->slug) }}">{{ isset($trending_post->title) ? $trending_post->title : 'N/A' }}</a>
                            </h5>
                            <div class="author_details">

                                @php
                                if (isset($trending_post->addedByUser->user_role_id) && $trending_post->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
                                $trendingAddedBy = 'Admin';
                                } else {
                                $trendingAddedBy = $trending_post->addedByUser->full_name;
                                }

                                $trending_created_at = CustomHelper::convert_date_to_timestamp($trending_post->created_at);
                                $trendingBlogDate = date(BLOG_DETAIL_DATE_FORMAT, $trending_created_at);

                                @endphp

                                <span>by <a href="javascript:void(0);">{{$trendingAddedBy}}</a> </span> <span>- {{$trendingBlogDate}}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@stop


@section('stylesheet')
{{ HTML::style(WEBSITE_CSS_URL . 'slick-theme.css') }}
{{ HTML::style(WEBSITE_CSS_URL . 'slick.css') }}
@stop

@section('javascript')
{{ HTML::script(WEBSITE_JS_URL . 'slick.min.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'blog.js') }}
<script type="text/javascript">
    $('.responsive').slick({
        dots: true,
        infinite: false,
        autoplay: true,
        autoplaySpeed: 3000,
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
</script>
@stop