<?php
$courseCategoryDropdown = CustomHelper::getConfigValue('COURSE_CATEGORY_TYPE_DROPDOWN');
$featuredCourses        = CustomHelper::getFeaturedCourses();
$courseCategoryArray = [];
if (!empty($featuredCourses)) {
    foreach ($featuredCourses as $key => $featuredCourse) {
        if (!empty($featuredCourse->getUniversityDetails)) {
            $courseCategoryArray[$featuredCourse->course_category][] =  $featuredCourse;
        }
    }
};
?>
@if(!empty($courseCategoryArray))
<section class="explore_programs">
    <div class="container">
        <div class="headingCard">
            <h2 class="text-center heading">Explore <strong>Our Programs</strong></h2>
            <p class="paragraphline text-center">Explore our programs to discover a diverse range of opportunities designed to enhance your skills and knowledge.</p>
        </div>
        <div class="explore_programs_tab">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                @foreach($courseCategoryDropdown as $key => $courseCategory)
                <?php
                $courseArray =  ($courseCategoryArray[$key]) ?? array();
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn {{ ($key == 2) ? 'active' : '' }}" id="pills-home-tab{{ $key }}" data-bs-toggle="pill" data-bs-target="#pills-home{{ $key }}" type="button" role="tab" aria-controls="pills-home{{ $key }}" aria-selected="true">{{ $courseCategory }}</button>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($courseCategoryDropdown as $key => $courseCategory)
                <?php $courseArray =  ($courseCategoryArray[$key]) ?? array(); ?>
                <div class="tab-pane campus_man_box fade {{ ($key == 2) ? 'show active' : '' }} " id="pills-home{{ $key }}" role="tabpanel" aria-labelledby="pills-home-tab{{ $key }}" tabindex="0">
                    <div class="degrees_section">
                        <div class="degrees_content degrees_left_box">
                            <h3> <span class="sub_heading"> Master's and Bachelor's Degrees</span> Find a top degree
                                that fits your life
                            </h3>
                            <p>Breakthrough pricing on 100% online degrees from top universities.</p>
                        </div>
                    </div>
                    <div class="owl-carousel degrees  owl-theme">
                        <div class="item">
                            @php $counter = 1; @endphp
                            @foreach ($courseArray as $course)
                            @php
                            $root_path = COURSE_IMAGE_ROOT_PATH;
                            $http_path = COURSE_IMAGE_URL;
                            $attribute = array();
                            $type = '';
                            $attribute['alt'] = $course->name;
                            $attribute['width'] = '404';
                            $attribute['height'] = '258';
                            $attribute['cropratio'] = '1:1';
                            $attribute['zc'] = '1';
                            $attribute['type'] = '3';
                            $image_name = $course->image;
                            $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                            @endphp

                            @php
                            $uni_root_path = UNIVERSITY_IMAGE_ROOT_PATH;
                            $uni_http_path = UNIVERSITY_IMAGE_URL;
                            $uni_attribute = array();
                            $uni_type = '';
                            $uni_attribute['alt'] = $course->getUniversityDetails->title;
                            $uni_attribute['width'] = '50';
                            $uni_attribute['height'] = '50';
                            $uni_attribute['cropratio'] = '1:1';
                            $uni_attribute['zc'] = '2';
                            $uni_attribute['type'] = '3';
                            $uni_image_name = $course->getUniversityDetails->image;
                            @endphp

                            <div class="degrees_cardbox card">
                                <figure>
                                    <a href="{{ route('University.universityCourseDetail',[$course->university_slug,$course->course_slug]) }}">
                                        {!! $image !!}
                                    </a>
                                    <span class="tagLine">Admission Open</span>
                                </figure>
                                <div class="card-body">
                                    <div class="degrees_contentbox">
                                        <figure class="university_logo_explore_program">
                                            @if ($uni_image_name != '' && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $uni_image_name))
                                            <img src="{{ UNIVERSITY_IMAGE_URL . $uni_image_name}}" alt="image">
                                            @endif
                                        </figure>
                                        <h4><a href="{{ route('University.universityCourseDetail',[$course->university_slug,$course->course_slug]) }}">{{ ($course->getUniversityDetails->title) ?? "" }} </a></h4>
                                    </div>
                                    <div class="universities_subtitle ps-3">
                                        <p>{{ ($course->getCourseDropDownDetails->full_name) ?? "" }}</p>
                                    </div>
                                    <span class="months"> <i class="fa fa-money" aria-hidden="true"></i>
                                        {{ (CustomHelper::displayPrice($course->total_fee)) ?? "" }}</span>
                                    <span class="months"> <i class="fa fa-tag pe-2" aria-hidden="true"></i>
                                        {{ ($course->tag_line) ?? "" }}</span>
                                    <div class="btn_program">
                                        <a class="btn btn-primary mt-3" href="{{ route('University.universityCourseDetail',[$course->university_slug,$course->course_slug]) }}">View
                                            Program</a>
                                    </div>
                                </div>
                            </div>

                            @if(($counter %2 == 0) && ($counter != count($courseArray)))
                        </div>
                        <div class="item">
                            @endif


                            @php $counter++; @endphp
                            @endforeach

                        </div>


                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>




</section>
@endif
<style>
    /* #pills-tab {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
} */

/* Layout for smaller screens */
@media (max-width: 768px) {
    #pills-tab {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Two columns */
        gap: 10px;
    }
}


</style>