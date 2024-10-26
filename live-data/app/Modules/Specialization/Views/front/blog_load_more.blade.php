@foreach($result as $key => $value)
	<li>
		@include('elements.single_trend_list', ['blogData' => $value])
	</li>
@endforeach
