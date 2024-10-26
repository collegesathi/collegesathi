<section id="OtherUniversities" class="otheruniversities_main_section">
    <!-- <span id="OtherUniversities" class="anchorslide"></span> -->

    <div class="otheruniversities_content">
        @if(!empty($otherUniversities->toArray()))
        <div class="otheruniversities_section">
            <h2 class="heading_program_details">{{ trans('front_messages.global.other_university_to_consider') }}</h2>
            <div class="slider courses_crousel other_universities_main">
                @foreach( $otherUniversities as $universityData )
                <div class="crousel_item">
                    <div class="course_details card">
                        <div class="otheruniversities_img">
                            <figure class="university_logo_explore_program">
                                <?php
                                if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $universityData->image) && !empty($universityData->image)) {
                                    echo '<img src="' . UNIVERSITY_IMAGE_URL . $universityData->image . '" alt="University Logo" />';
                                }
                                ?>
                            </figure>
                        </div>
                        <div class="card-body text-center eq_otheruniversities">
                            <h5>{{ $universityData->title }}</h5>
                            <span>{{ trans('front_messages.global.student_raiting') }}</span>
                            <div class="student_rating d-flex">
                                <span class="rating d-flex" data-score='{{$universityData->avg_rating}}'></span>
                                <span>( {{ $universityData->review_count }} {{trans('front_messages.global.reviews')}})</span>
                            </div>
                        </div>
                        <div class="card-footer other_universities">
                            <a href="{{ route('University.frontIndex', $universityData->slug) }}" class="btn btn-primary">{{ trans('front_messages.global.view_details') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>