@foreach($result as $key => $value)
	<li>
		@include('elements.single_blog_list', ['value' => $value])
	</li>
@endforeach