@if ($courseDetail->getCourseSpecifications->isNotEmpty())
<div class="courses_box">
    <h2 class="heading_program_details"> {{ trans('front_messages.global.specifications') }}</h2>
    <div class="slider courses_crousel slider_inner_content">
        @foreach ($courseDetail->getCourseSpecifications as $courseSpecification)
        
        

        <div class="crousel_item">
            <div class="course_details eq_course_details card">
                <?php
                echo $image = CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $courseSpecification->image, '', ['alt' => $courseSpecification->image, 'height' => '162', 'width' => '249', 'zc' => 0]);
                ?>
                <div class="card-body">
                    <div class="small_logo_box">
                        <figure class="university_logo_explore_program">
                            <?php
                            if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $result->image) && !empty($result->image)) {
                                echo '<img src="' . UNIVERSITY_IMAGE_URL . $result->image . '" alt="University Logo" />';
                            }
                            ?>
                        </figure>
                    </div>

                    <strong>{{ $result->title }}</strong>
                    <h5>{{ $courseSpecification->getCourseSpecificationDropdownDetails->name }}</h5>

                </div>
                <div class="card-footer">
                    <a href="{{ route('University.universityCourseSpecificationDetail', [$courseSpecification->university_slug, $courseSpecification->course_slug, $courseSpecification->slug]) }}" class="btn btn-outline-primary">{{ trans("front_messages.global.read_more") }}</a>
                </div>
            </div>
        </div>
        
        @endforeach
    </div>
</div>
@endif