<div class="search_by_filters">
    <h2>{{ trans('front_messages.global.search_by_filters') }}</h2>
    
	<a class="filters_menu accordion_filter collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        {{ trans('front_messages.global.search_by_filters') }}
    </a>

    <div class="collapse" id="collapseExample">
        <div class="specialisations">
            <h2>{{ trans('front_messages.global.courses') }}</h2>
        </div>
		
        {{ Form::open(['role' => 'form', 'route' => ['University.listing'], 'class' => 'mws-form specialisations_listing', 'files' => true, 'method' => 'get', 'id' => 'filter_form']) }}
			<div class="course_filters">
				@include('University::Front.elements.course_filters')
			</div>
        {{ Form::close() }}

		@if ($courseDropdown->currentPage() != $courseDropdown->lastPage())
			<div class="form-check load_more_button_bg">
				<a href="javascript:void(0)" data-route="{{ route('University.load_more_filter_courses') }}" class="btn btn-outline-primary load_more_filter_courses" data-page="{{ $courseDropdown->currentPage() + 1 }}">{{ trans('front_messages.global.load_more') }}</a>
			</div>
		@endif

		<div class="form-check">
			<a href="{{ route('University.listing') }}" class="btn btn-outline-primary">{{ trans('front_messages.global.clear_all') }}</a>
		</div>
    </div>
</div>