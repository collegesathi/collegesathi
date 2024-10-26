<section id="OtherUniversities" class="otheruniversities_main_section">
    <!-- <span id="OtherUniversities" class="anchorslide"></span> -->
    <div class="otheruniversities_content">
        @if($otherUniversities->isNotEmpty())
        <h2 class="heading_program_details">{{ trans('front_messages.global.similar_university') }}</h2>
        <div class="course_fees mb-5">
            <div class="course_fees-scroll">
                <ul>
                    <li class="course_heading">
                        <div class="course">
                            <h3>{{ trans('front_messages.global.university') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.fees') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.nirf_ranking') }}</h3>
                        </div>

                    </li>
                    @foreach($otherUniversities as $otherUnivversitiesDetails)
                    <li>
                        <div class="course">
                            <h4>{{ $otherUnivversitiesDetails->getAllUniversityDetails->title }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ $otherUnivversitiesDetails->total_fee }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ $otherUnivversitiesDetails->getAllUniversityDetails->nirf_ranking }}</h4>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
        @endif
        <?php
        $universityArray = Session::get('university_id');
        ?>
        @if ($otherUniversities->isNotEmpty())
        <div class="otheruniversities_section">
            <h2 class="heading_program_details">{{ trans('front_messages.global.consider_other_university') }}</h2>
            <div class="slider courses_crousel other_universities_main">
                @foreach ($otherUniversities as $item)
                @php
                if(Session::has('course_id') && Session::has('university_id') && in_array($item->univercity_id,$universityArray)){
                $disabled = 'disabled';
                $text = trans('front_messages.global.added_to_compare');
                }
                else {
                $disabled = '';
                $text = trans('front_messages.global.add_to_compare');
                }
                @endphp
                <div class="crousel_item">
                    <div class="course_details card">
                        <div class="otheruniversities_img">
                            <figure>
                                <?php
                                echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $item->getAllUniversityDetails->image, '', ['alt' => $item->getAllUniversityDetails->image, 'height' => '43', 'width' => '120', 'zc' => 2]);
                                ?>
                            </figure>
                        </div>
                        <div class="card-body text-center">
                            <h5>{{ CustomHelper::getStringLimit($item->getAllUniversityDetails->title,15) }}</h5>
                            <span>{{ trans('front_messages.global.student_raiting') }}</span>
                            <div class="student_rating d-flex">
                                <div class="top_rating d-flex">
                                    <span class="rating d-flex" data-score='{{$item->getAllUniversityDetails->avg_rating}}'></span>
                                </div>
                                <span>( {{count($item->getAllUniversityDetails->getReviewRatingUniversities)}} {{trans('front_messages.global.reviews')}})</span>
                            </div>
                        </div>

                        <div class="card-footer other_universities">
                            <a href="javascript:void(0);" class="btn btn-primary addToCompare" data-university_id="{{ $item->univercity_id }}" data-course_id="{{ $item->course_id }}" data-page_request="course_university" id="addToCompare{{$item->univercity_id}}">{{ $text }}</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    @endif
</section>