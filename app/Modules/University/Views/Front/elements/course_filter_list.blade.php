<div class="search_by_filters">
    <h2>{{ trans('front_messages.global.search_by_filters') }}</h2>
   <?php
   $class = !empty($queryString) ? "collapse show" : "collapsed";
   $courseCategories = CustomHelper::getCourseCategory();
   ?>
	<a class="filters_menu accordion_filter {{ $class }}" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        {{ trans('front_messages.global.search_by_filters') }}
    </a>

    <div class="collapse {{ !empty($queryString) ? 'show': '' }}" id="collapseExample">
        <!-- <div class="specialisations">
            <h2>{{ trans('front_messages.global.courses') }}</h2>
        </div> -->
        <div class="specialisations-filter accordion mt-3" id="filter-accordion">
            
            {{ Form::open(['role' => 'form', 'route' => ['University.listing'], 'class' => 'mws-form specialisations_listing', 'files' => true, 'method' => 'get', 'id' => 'filter_form']) }}
            @if (!empty($courseCategories))
                @foreach ($courseCategories as $courseCategoryKey => $courseCategoryName)
                    
                    @php 
                        $allCourses  =  CustomHelper::getCoursesWithSpecifications($courseCategoryKey, 'course_filter_list'); 
                    @endphp

                    <div class="accordion-item">
                        <h2 class="accordion-header {{ ($courseCategoryKey == 1 && empty($queryString)) ? '' : 'collapsed' }}">
                            <button class="accordion-button {{ ($courseCategoryKey == 1 && empty($queryString)) ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$courseCategoryKey}}" aria-expanded="{{ ($courseCategoryKey == 1 && empty($queryString)) ? 'true' : 'false' }}" aria-controls="collapse">
                                {{$courseCategoryName}}
                            </button>
                        </h2>
                        <div id="collapse{{$courseCategoryKey}}" class="accordion-collapse {{ ($courseCategoryKey == 1 && empty($queryString)) ? 'collapse show' : 'collapse' }}" data-bs-parent="#filter-accordion">
                            <div class="accordion-body">
                                <div class="course_filters">
                                    @include('University::Front.elements.course_filters')
                                </div>

                                {{-- @if ($courseDropdown->currentPage() != $courseDropdown->lastPage())
                                    <div class="form-check load_more_button_bg">
                                        <a href="javascript:void(0)" data-route="{{ route('University.load_more_filter_courses') }}" class="btn btn-primary  load_more_filter_courses" data-page="{{ $courseDropdown->currentPage() + 1 }}">{{ trans('front_messages.global.load_more') }}</a>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{ Form::close() }}
        </div>
		
        <!-- {{ Form::open(['role' => 'form', 'route' => ['University.listing'], 'class' => 'mws-form specialisations_listing', 'files' => true, 'method' => 'get', 'id' => 'filter_form']) }}
			<div class="course_filters">
				@include('University::Front.elements.course_filters')
			</div>
        {{ Form::close() }}

		{{-- @if ($courseDropdown->currentPage() != $courseDropdown->lastPage())
			<div class="form-check load_more_button_bg">
				<a href="javascript:void(0)" data-route="{{ route('University.load_more_filter_courses') }}" class="btn btn-primary  load_more_filter_courses" data-page="{{ $courseDropdown->currentPage() + 1 }}">{{ trans('front_messages.global.load_more') }}</a>
			</div>
		@endif --}} -->

		<div class="form-check mt-2 ps-0">
			<a href="{{ route('University.listing') }}" class="btn btn-primary">{{ trans('front_messages.global.clear_all') }}</a>
		</div>
    </div>
</div>  