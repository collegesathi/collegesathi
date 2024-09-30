@extends('layouts.default')
@section('content')
@php
$afterblogAdsshow = FRONT_BLOG_PER_PAGE - 1;
@endphp


<div class="blog-section">
	<div class="container">
		<div class="blogtab">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				@foreach($productTypes as $key => $productType)
				<?php
				$active = '';
				if(!empty($slug) && $productType->slug == $slug){
					$active = 'active';
				}elseif (empty($slug) && $key == 0) {
					$active = 'active';
				}else{
					$active = '';
				}
				?>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $active }} " id="productService-tab-{{ $productType->id }}" data-bs-toggle="tab" data-bs-target="#productService{{ $productType->id }}" type="button" role="tab" aria-controls="home" aria-selected="true">{{ $productType->name }}</button>
				</li>
				@endforeach
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="productService{{ UAE_TOURIST_VISA_ID }}" role="tabpanel" aria-labelledby="productService-tab-{{ UAE_TOURIST_VISA_ID }}">
				<div class="bloglist">
					<ul class="blog-append-list_{{ UAE_TOURIST_VISA_ID }}">
						@foreach($uaeBlogResult as $uaeBlog)
						<li>
						@include('elements.single_blog_list', ['value' => $uaeBlog])
						</li>
						@endforeach
					</ul>
					@if($uae_last_page > ACTIVE )
                    <div class="loadmore">
                        <a href="javascript:void(0);" class="btn btn-outline load_more" id="load_more_{{ UAE_TOURIST_VISA_ID }}" data-page="{{$uae_search_string}}" >
                            {{ trans('front_messages.global.view_more')}}
                        </a>
                    </div>
                	@endif 
				</div>
			  </div>
			  <div class="tab-pane fade" id="productService{{ TRAVEL_INSURANCE_ID }}" role="tabpanel" aria-labelledby="productService-tab-{{ TRAVEL_INSURANCE_ID }}">
				<div class="bloglist">
					<ul class="blog-append-list_{{ TRAVEL_INSURANCE_ID }}">
						@foreach($travelBlogResult as $travelBlog)
						<li>
						@include('elements.single_blog_list', ['value' => $travelBlog])
						</li>
						@endforeach
						 
					</ul>
					@if($travel_last_page > ACTIVE )
                    <div class="loadmore">
                        <a href="javascript:void(0);" class="btn btn-outline load_more" id="load_more_{{ TRAVEL_INSURANCE_ID }}" data-page="{{$travel_search_string}}" >
                            {{ trans('front_messages.global.view_more')}}
                        </a>
                    </div>
                	@endif 
				</div>  
			  </div>
			  <div class="tab-pane fade" id="productService{{ COMBO_ID }}" role="tabpanel" aria-labelledby="productService-tab-{{ COMBO_ID }}">
				<div class="bloglist">
					<ul class="blog-append-list_{{ COMBO_ID }}">
						@foreach($comboBlogResult as $comboBlog)
						<li>
						@include('elements.single_blog_list', ['value' => $comboBlog])	
						</li>
						@endforeach
						 
					</ul>
					@if($combo_last_page > ACTIVE )
                    <div class="loadmore">
                        <a href="javascript:void(0);" class="btn btn-outline load_more" id="load_more_{{ COMBO_ID }}" data-page="{{$combo_search_string}}" >
                            {{ trans('front_messages.global.view_more')}}
                        </a>
                    </div>
                	@endif 
				</div>
			  </div>
			</div>

		</div>
	</div>
</div>
 
@stop
@section('javascript')  
{{ HTML::script(WEBSITE_JS_URL . 'blog.js') }}
@stop
