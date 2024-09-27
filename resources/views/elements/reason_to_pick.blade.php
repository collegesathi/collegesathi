<?php
$reasonArray = CustomHelper::getConfigValue('REASON_ARRAY');

$reasonSearch = CustomHelper::getBlockdetail('reason-search');
$reasonStudy = CustomHelper::getBlockdetail('reason-study');
$reasonSupporty = CustomHelper::getBlockdetail('reason-support');
?>
<section class="collegesathi_section">
	<div class="container">

		<div class="headingCard">
			<h2 class="text-center heading"> {!! trans('front_messages.home.reason_to_pic') !!}</h2>
			<p class="paragraphline text-center">{!! trans('front_messages.home.reason_to_pic_other_text') !!}</p>
		</div>
		<ul class="nav nav-pills navbarPill" id="pillssss-tab" role="tablist">
			@foreach($reasonArray as $key => $reason)
			<li class="nav-item" role="presentation">
				<button class="nav-link {{ ($key == 1) ? 'active' : '' }}" id="pills-Search-tab{{ $key }}" data-bs-toggle="pill" data-bs-target="#pills-Search{{ $key }}" type="button" role="tab" aria-controls="pills-Search{{ $key }}" aria-selected="true">{{ $reason }}</button>
			</li>
			@endforeach
		</ul>
		<div class="collegesathiExpertise">
			<div class="tab-content" id="pills-tabContent">
				@foreach($reasonArray as $key => $reason)
				<div class="tab-pane fade  {{ ($key == 1) ? 'show active' : '' }}" id="pills-Search{{ $key }}" role="tabpanel" aria-labelledby="pills-Search-tab" tabindex="0">
				@if($key == 1)
				{!! $reasonSearch->description !!}
				@elseif ($key == 2)
				{!! $reasonStudy->description !!}
				@else
				{!! $reasonSupporty->description !!}	
				@endif
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<ul class="circles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</section>