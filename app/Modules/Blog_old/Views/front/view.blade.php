@extends('layouts.default')
@section('content')
@php
$title          = isset($record->descriptionData->title) ? Ucfirst($record->descriptionData->title) : '';
$description    = isset($record->descriptionData->description) ? $record->descriptionData->description : '';
$updated        = CustomHelper::convert_date_to_timestamp($record->created_at);
$blogDate       = date(BLOG_DETAIL_DATE_FORMAT,$updated);
@endphp
<div class="blog-detail">
	<div class="container">
		<div class="detail-content">
			<strong class="blog-category">{{ $title }}</strong>
			<span class="posttime">{{ $blogDate }}</span>
			<figure>
                @php  echo CustomHelper::showImage(BLOG_IMAGE_ROOT_PATH, BLOG_IMAGE_URL,  $record->image_1, '', ['alt' => $record->title, 'id' => $record->id ,  'height' =>'415', 'width' =>'980', 'zc' =>'2']);  @endphp
            </figure>
            {!! $description !!}
		</div>
	</div>
</div>

<!-- Skyline Us End -->
<div class="skylinebg"></div>
<!-- Skyline Us End -->
{{ HTML::script(WEBSITE_JS_URL . 'blog.js') }}
@stop

