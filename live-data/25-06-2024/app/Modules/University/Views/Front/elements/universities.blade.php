
@if ($result->isNotEmpty())
<?php
// pr($result->toArray()); die;
?>
@foreach($result as $key => $value)

<li>
	<div class="card">
		<div class="slider responsive responsive{{$currentPage}}">
			@if($value->getSliders->isNotEmpty())
				@foreach($value->getSliders as $sliderImage)
				<div>
					<?php echo $image = CustomHelper::showImage(SLIDER_ROOT_PATH, SLIDER_URL, $sliderImage->slider_image, '', ['alt' => $sliderImage->slider_image, 'height' => '405', 'width' => '585', 'zc' => 2]); ?>
				</div>
				@endforeach
			@else
				<div>
				<?php 
				$url = WEBSITE_IMG_FILE_URL . '?image=' . WEBSITE_IMG_URL . 'admin/icon-no-image.png' . '&amp;height=405&amp;width=585&amp;zc=2&amp;ct=0';
				echo HTML::image($url,	'university image'); ?>
				</div>
			@endif
		</div>

		<div class="card-body">
			<div class="management_logo">
				<a class="text-decoration-none text-dark" href="{{ route('University.frontIndex',$value->slug) }}"><figure>
					<?php
					if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $value->image) && !empty($value->image)) {
						echo '<img src="'.UNIVERSITY_IMAGE_URL.$value->image.'" alt="University Logo" />';
					}
					?>
				</figure></a>
			</div>

			<a class="text-decoration-none text-dark" href="{{ route('University.frontIndex',$value->slug) }}">
				<h4 class="card-title">{{ $value->title }}</h4>
			</a>

			<div class="star_rating">
				<span class="rating" data-score='{{$value->avg_rating}}'></span>
				@if($value->avg_rating > 0)
				<h5>({{ $value->avg_rating}} / 5)<span></h5>
				@endif
			</div>

			<div class="download">
				<a class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-uni_id="{{ $value->id }}" data-slug="{{ $value->slug }}" id="download_prospectus_btn"> <img src="{{ WEBSITE_IMG_URL }}download.svg" alt=""> {{ trans('front_messages.global.download_prospectus') }}</a>
			</div>

			<h6>
				@foreach (explode(',', $value->universityBadges->university_badges_id) as $badges)
				@php $badgeNames = CustomHelper::getMasterDropdownNameById($badges);
				echo strtoupper($badgeNames)
				@endphp
				@if (!$loop->last)
				,
				@endif
				@endforeach
			</h6>
		</div>

		@php
			if($isCourse == true){
				$display_style = '';
			} else{
				$display_style = 'display:none;';
			}

			$checked = '';
            if (Session::has('course_id') && Session::has('university_id')) {
                $universityArray = Session::get('university_id');
				if(in_array($value->id,$universityArray)){
					$checked = 'checked';
				}
			}
		@endphp

		<div class="card-footer d-flex">
			<div class="form-check"  style="{{ $display_style }}" >
				<div>
					<input class="form-check-input addToCompare" type="checkbox" data-university_id="{{ $value->id }}" id="Addtocompare{{$value->id}}" {{$checked}}>
					<label class="form-check-label" for="Addtocompare{{$value->id}}">
						{{ trans('front_messages.global.add_to_compare') }}
					</label>
				</div>
			</div>
			<a href="{{ route('University.frontIndex', $value->slug) }}" class="btn btn-outline-primary">{{ trans('front_messages.global.view_details') }} </a>
		</div>
		{{-- <div class="card-footer">
			<a href="{{ route('University.frontIndex', $value->slug) }}" class="btn btn-outline-primary">View details </a>
		</div> --}}
	</div>
</li>
@endforeach
@else
<li class="w-100">
<div class="no-record-box">
	<figure class="mb-1">
		  <img src="{{ WEBSITE_IMG_URL }}no-record-img.png" alt="img">
	</figure>
	<p>{{ trans('front_messages.global.no_records_found') }}</p>
	<a href="  {{ route('home.index')  }}" class="btn btn-next btn-submit">{{ trans('front_messages.global.back_to_home') }}</a>
 </div>
	
</li>
@endif

<script type="text/javascript">
	$(document).ready(function($) {
		$('.responsive{{$currentPage}}').slick({
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
		$('.rating').raty({
            path        : '{{ WEBSITE_IMG_URL }}',
            targetKeep  : true,
            readOnly    : true,
            score       : function() {
                return $(this).attr('data-score');
            }
        });
	});
</script>