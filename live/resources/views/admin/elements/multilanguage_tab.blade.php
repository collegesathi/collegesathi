<!-- multilanguage tab button -->
 @if(count($languages) > 1)
		<!--mandatory message -->
		<div  class="default_language_color">
			{{ Config::get('default_language.message') }}
		</div>
	
	<!-- Nav tabs -->
	<ul class="nav nav-tabs tab-nav-right" role="tablist">
		@foreach($languages as $langCode => $title)
		<?php  $i = $langCode;  ?> 
		<li role="presentation" class="{{ ($i ==  $language_code ) ? 'active':'' }}" ><a href="#{{ $i }}_div" data-toggle="tab">{{$title}}</a></li>
		@endforeach
					   
	</ul>
	<div class="row clearfix seperator-line"></div>

@endif