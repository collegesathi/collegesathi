@extends('layouts.default')
@section('content')


@php
$title = isset($record->descriptionData->title) ? Ucfirst($record->descriptionData->title) : '';
$description = isset($record->descriptionData->description) ? $record->descriptionData->description : '';
$created_at = CustomHelper::convert_date_to_timestamp($record->created_at);
$blogDate = date(BLOG_DETAIL_DATE_FORMAT, $created_at);

if (isset($record->addedByUser->user_role_id) && $record->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
$addedBy = 'Admin';
} else {
$addedBy = $record->addedByUser->full_name;
}

@endphp
<section class="blog_details_section common_background_img">
    <div class="container">
        <div class="blog_detailsbanner box_shadow">
            <figure>
                @php //echo CustomHelper::showImage(TREND_IMAGE_ROOT_PATH, TREND_IMAGE_URL, $record->image_1, '', ['alt' => $record->title, 'id' => $record->id , 'height' =>'759', 'width' =>'1320', 'zc' =>'2']); @endphp
                 <img src="/images/op-mng.png" alt="Top Online executive MBA Universities in India"></figure>
            </figure>
        </div>

        <div class="blog_details box_shadow">
            <h1>{{ $title }}</h1>
            <div class="author_details">

                <span>by <a href="javascript:void(0);">{{ $addedBy }}</a> </span> <span>- {{ $blogDate }}</span>
            </div>

            {!! $description !!}

            <div class="blog_banner_icon">
                <div class="icon d-flex latest_postsicon share-wrapper">
                    <figure>
                        <a href="javascript:void(0);">
                            <img class="share_icon share" src="{{ WEBSITE_IMG_URL }}share_network_icon.svg" alt="">
                            <img class="share_icon_white share" src="{{ WEBSITE_IMG_URL }}share_network_icon_white.svg" alt="">
                        </a>

                    </figure>

                    <div class="share-btns">
                        <a target="_blank" href="https://www.facebook.com/sharer.php?u={{ route('Blog.postView', $record->slug) }}&amp;t={{ $record->title }}"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                        </a>
                        <a target="_blank" href="https://twitter.com/home/?status={{ $record->title }} - {{ route('Blog.postView', $record->slug) }}"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
                        </a>
                        <a target="_blank" href="https://www.instagram.com/?url={{ route('Blog.postView', $record->slug) }}"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                        </a>
                        <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('Blog.postView', $record->slug) }}&amp;title={{ $record->title }}"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i>
                        </a>
                        <a target="_blank" href="https://api.whatsapp.com/send?text=The text to share!={{ route('Blog.postView', $record->slug) }}&amp;title={{ $record->title }}"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>
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
</section>

{{ HTML::script(WEBSITE_JS_URL . 'blog.js') }}

{{-- Enquire Now Script --}}
<script>
    window.addEventListener('load', function() {
        setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById('enquireNowModel'));
            myModal.show();
        }, 2000);
    });
</script>
{{-- Enquire Now Script --}}
@stop