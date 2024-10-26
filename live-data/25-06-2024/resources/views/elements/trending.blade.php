<section class="trending">
    @if (!empty($specializationCourses->toArray()))
        <div class="container">
            <div class="trending_content">
			
				<div class="headingCard">
			<h2 class="heading text-center">{!! trans('front_messages.global.specialization_course_heading') !!}</h2>
            <p class="text-center paragraphline">These emerging fields offer exciting opportunities for professionals to drive impactful change and lead the future of innovation</p>
			  </div>
			
                <h2>
                </h2>
                <div class="item_slider">
                    <div class="owl-carousel trending_slider owl-theme">
                        @foreach ($specializationCourses as $specializations)
                            
                            <div class="item">
                                <div class="best_trending">
                                     <a href="{{ route('University.universityCourseDetail', [$specializations->getUniversityDetails->slug, $specializations->slug]) }}" class="text-decoration-none text-dark">
										<figure>
											<?php  echo $image = CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $specializations->image, '', ['alt' => $specializations->image, 'height' => '258', 'width' => '404', 'zc' => 1]);  ?>
										</figure>
									</a>
                                    <div class="trending_content_box">
                                        <div class="trending_wrap">
                                            <figure>
                                                <?php
                                                    echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $specializations->getUniversityDetails->image, '', ['alt' => $specializations->getUniversityDetails->image, 'height' => '40', 'width' => '40', 'zc' => 2]);
                                                ?>

                                            </figure>
                                            <div class="trending_caption">
                                                <p>
                                                    <a href="{{ route('University.universityCourseDetail', [$specializations->getUniversityDetails->slug, $specializations->slug]) }}" class="text-decoration-none text-dark">
                                                    {{ $specializations->getUniversityDetails->title }}</p>
                                                    </a>
                                                <span class="sub_title">Australia</span>
                                            </div>

                                        </div>
                                            <a href="{{ route('University.universityCourseDetail', [$specializations->getUniversityDetails->slug, $specializations->slug]) }}" class="text-decoration-none text-dark"><h3>{{ CustomHelper::getStringLimit($specializations->name,23) }}</h3></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</section>





