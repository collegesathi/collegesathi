@if ($result->universityCourses->isNotEmpty())
<div class="courses_box">
    <h2 class="heading_program_details"> {{ trans('front_messages.global.courses') }}</h2>
    <div class="slider courses_crousel slider_inner_content">
        @foreach ($result->universityCourses as $courses)
        @if (isset($course_slug))
        @if ($course_slug != $courses->course_slug)
        <div class="crousel_item">
            <div class="course_details eq_course_details card">
                <?php
                echo $image = CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $courses->image, '', ['alt' => $courses->image, 'height' => '162', 'width' => '249', 'zc' => 0]);
                ?>
                <div class="card-body">
                    <div class="small_logo_box">
                        <figure class="university_logo_explore_program">
                            <?php
                            if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $result->image) && !empty($result->image)) {
                                echo '<img src="' . UNIVERSITY_IMAGE_URL . $result->image . '" alt="University Logo" />';
                            }
                            // echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $result->image, '', ['alt' => $result->image, 'height' => '26', 'width' => '77', 'zc' => 0]);
                            ?>
                        </figure>
                    </div>

                    <strong>{{ $result->title }}</strong>
                    <h5>{{ $courses->name }}</h5>
                    <p>{{ $courses->tag_line }}</p>

                </div>
                <div class="card-footer">
                    <a href="{{ route('University.universityCourseDetail', [$courses->university_slug, $courses->course_slug]) }}" class="btn btn-outline-primary">{{ trans("front_messages.global.read_more") }}</a>
                </div>
            </div>
        </div>
        @endif
        @else
        <div class="crousel_item">
            <div class="course_details card">
                <?php
                echo $image = CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $courses->image, '', ['alt' => $courses->image, 'height' => '162', 'width' => '249', 'zc' => 0]);
                ?>
                <div class="card-body">
                    <div class="small_logo_box">
                        <figure class="university_logo_explore_program">
                            <?php
                            if (file_exists(UNIVERSITY_IMAGE_ROOT_PATH . $result->image) && !empty($result->image)) {
                                echo '<img src="' . UNIVERSITY_IMAGE_URL . $result->image . '" alt="University Logo" />';
                            }
                            // echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $result->image, '', ['alt' => $result->image, 'height' => '26', 'width' => '77', 'zc' => 0]);
                            ?>
                        </figure>
                    </div>

                    <strong>{{ $result->title }}</strong>
                    <h5>{{ $courses->name }}</h5>
                    <p>{{ $courses->tag_line }}</p>

                </div>
                <div class="card-footer">
                    <a href="{{ route('University.universityCourseDetail', [$courses->university_slug, $courses->course_slug]) }}" class="btn btn-outline-primary">{{ trans("front_messages.global.read_more") }}</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif