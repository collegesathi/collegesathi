
@php

$for_roreign_nationals = CustomHelper::getConfigValue('Site.for_roreign_nationals');
$for_indian_nationals = CustomHelper::getConfigValue('Site.for_indian_nationals');

@endphp

<section class="learner_support commuity-section {{isset($about_learner) ? $about_learner : null}}">
    <div class="container">
	<div class="commuityrow">
	
	<div class="circleimg">
			<figure class="circleimg1"><img src="{{ WEBSITE_IMG_URL }}circleimg1.png" alt="img"></figure>
			<figure class="circleimg2"><img src="{{ WEBSITE_IMG_URL }}circleimg2.png" alt="img"></figure>
			<figure class="circleimg3"><img src="{{ WEBSITE_IMG_URL }}circleimg3.png" alt="img"></figure>
		</div>
	<div class="jointext text-center">
        <div class="online_support_heading">
			<div class="headingCard">
			<h2 class="heading text-center">{!! trans('front_messages.global.online_vidhya_learner_support') !!}</h2>
            <p class="text-center paragraphline">({{ trans('front_messages.global.we_are_available_24_7') }})</p>
			  </div>
		
			
        </div>
        <ul class="online_support">
            <li>
                <h3>{{ trans('front_messages.global.ror_indian_nationals') }}</h3>
                <h4><a href="tel:{{$for_roreign_nationals}}"><i class="fa fa-phone" aria-hidden="true"></i> {{$for_roreign_nationals}}</a></h4>
            </li>
            <li>
                <h3>{{ trans('front_messages.global.ror_foreign_nationals') }}</h3>
                <h4><a href="tel:{{$for_roreign_nationals}}"><i class="fa fa-phone" aria-hidden="true"></i> {{$for_roreign_nationals}}</a></h4>
            </li>
        </ul>
		 </div>
		<div class="circleimg">
			<figure class="circleimg4"><img src="{{ WEBSITE_IMG_URL }}circleimg4.png" alt="img"></figure>
			<figure class="circleimg5"><img src="{{ WEBSITE_IMG_URL }}circleimg5.png" alt="img"></figure>
			<figure class="circleimg6"><img src="{{ WEBSITE_IMG_URL }}circleimg6.png" alt="img"></figure>
		</div>
		
    </div>
	 </div>
	
</section>
