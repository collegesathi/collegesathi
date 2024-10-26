@if ($universityData->isNotEmpty())

    <ul>
        @foreach ($universityData as $universityesCompare)
            <li class="d-flex">
                <div class="course_details card flex-grow-1">
                    <a href="javascript:void(0);" class="remove-btn"
                        data-university_id="{{ $universityesCompare->univercity_id }}" data-type="remove" data-course_id="{{ $universityesCompare->course_id }}"><img
                            src="{{ WEBSITE_IMG_URL }}close.svg" alt="Img"></a>
                    <div class="otheruniversities_img">
                        <figure>
                            <?php
                            echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $universityesCompare->getAllUniversityDetails->image, '', ['alt' => $universityesCompare->getAllUniversityDetails->image, 'height' => '43', 'width' => '120', 'zc' => 2]);
                            ?>
                        </figure>
                    </div>
                    <div class="card-body text-center">
                        <h5>{{ $universityesCompare->getAllUniversityDetails->title }}</h5>
                        <span
                            class="price d-flex align-items-center justify-content-center">{{ CustomHelper::displayPrice($universityesCompare->per_semester_fee) }}</span>
                        <div class="student_rating d-flex">
                            <div class="top_rating d-flex">
                                <span class="rating" data-score='{{$universityesCompare->getAllUniversityDetails->avg_rating}}'></span>
                            </div>
                            <span>( {{$universityesCompare->getAllUniversityDetails->review_count}} {{ trans('front_messages.global.reviews') }} )</span>
                        </div>
                    </div>
                </div>
            </li>

            @if ($count < 2)
                <li class="d-flex">
                    <a href="javascript:void(0);" class="course_details card add-box flex-grow-1" data-bs-toggle="modal"
                        data-bs-target="#addCompareModal">
                        <div class="add-box-icon">
                            <img src="{{ WEBSITE_IMG_URL }}add-icon-circle.svg" alt="img" width="30"
                                height="30">
                            <h3>{{ trans('front_messages.global.add_to_compare') }}</h3>
                        </div>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    
    @php
        $route = ($count < 2) ? 'javascript:void(0);' : route('University.compare');
    @endphp
    
    <div class="compare-btn mt-4">
        <a href="{{$route}}" class="btn btn-primary w-100">{{ trans('front_messages.global.compare_now') }}</a>
    </div>
@endif



<script>
    $('.rating').raty({
            path: '{{ WEBSITE_IMG_URL }}',
            targetKeep: true,
            readOnly: true,
            score: function() {
                return $(this).attr('data-score');
            }
        });
</script>