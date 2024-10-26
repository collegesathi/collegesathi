<section class="common_banner university-banner">
    <div class="container">
        <div class="programs_banner_content d-flex">

            <div class="programs_details">
                <?php
                if(isset($courseDetail->name)){
                    $name = $courseDetail->name .' - '.  $result->title;
                } else {
                    $name = $result->title;
                }
                ?>
                <div class="programs_details_contant">
                    <h1>{{  $name }}</h1>

					<div class="certificate_listing">
						@if($result->short_description)
							{!! $result->short_description !!}
						@endif
					</div>
					

                    <div class="d-md-flex logobrand-card align-items-center">
                        <div class="info_logo">
                            <ul>
                                @foreach (explode(',', $result->universityBadges->university_badges_id) as $badges)
                                @php
                                $badgeImages = CustomHelper::getFieldValueByFieldName(
                                $badges,
                                'id',
                                'DropDown',
                                'image',
                                'DropDown',
                                );
                                @endphp

                                <li>
                                    <figure>
                                        <?php
                                        echo $image = CustomHelper::showImage(DROPDOWN_IMAGE_ROOT_PATH, DROPDOWN_IMAGE_URL, $badgeImages, '', ['alt' => $badgeImages, 'height' => '57', 'width' => '57', 'zc' => 0]);
                                        ?>
                                    </figure>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="nirf-content">

                            <h2>
                                <span class="d-block pb-2"><img src="{{ WEBSITE_IMG_URL }}info-logo6.png" alt="img"></span>
                                {{ trans('front_messages.global.nirf_ranking') }}
                                <strong class="d-block">#{{ $result->nirf_ranking }}</strong>
                            </h2>

                        </div>
                    </div>
                    <div class="compare_btn_box">
                        <div class="download_prospectus compare_btn_section">
                            <a href="" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span>
                                    {{ trans('front_messages.global.download_prospectus') }} </span></a>
                        </div>
                        @php
                        $universityArray = Session::get('university_id');
                        if(Session::has('course_id') && Session::has('university_id') && in_array($courseDetail->univercity_id,$universityArray)){
							$disabled = 'disabled';
							$text = trans('front_messages.global.added_to_compare');
                        }
						else {
							$disabled = '';
							$text = trans('front_messages.global.add_to_compare');
                        }
                        @endphp
                        
						@if (isset($courseDetail))
                        <div class="d-flex addto_compare_box">
                            <div class="compare_btn">
                                <a href="javascript:void(0);" class="addToCompare" data-university_id="{{ $courseDetail->univercity_id }}" data-course_id="{{ $courseDetail->course_id }}" data-page_request="course_university" id="universityCompareButton">
                                    <img class="plus_icon" src="{{ WEBSITE_IMG_URL }}plus_icon.svg" alt="img">
                                    <img class="plus_icon_white" src="{{ WEBSITE_IMG_URL }}plus_icon_white.svg" alt="img">{{ $text }}</a>
                            </div>
                        </div>
                        
                        @elseif(Auth::check())
                        <?php
                        $isAllowReviewAndRating = CustomHelper::isAllowReviewAndRating(Auth::user()->id, $result->id);
                        ?>
                        @if ($isAllowReviewAndRating)
                        <div class="d-flex addto_compare_box">
                            <div class="compare_btn">
                                <a href="javascript:void(0);" data-university_id="{{ $result->id }}" id="openReviewPopUpButton">
                                    <img class="plus_icon" src="{{ WEBSITE_IMG_URL }}plus_icon.svg" alt="img">
                                    <img class="plus_icon_white" src="{{ WEBSITE_IMG_URL }}plus_icon_white.svg" alt="img">{{ trans('front_messages.global.review') }}</a>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>

                    <div class="star_rating">
                        <figure><span class="rating" data-score='{{$result->avg_rating}}'></span></figure>
                        <h5><span>{{ $result->tag_line ?? '' }}</span></h5>
                    </div>


                </div>
            </div>

            <div class="programs_crousel">
                <div class="slider responsive">
                    @foreach ($result->getSliders as $sliderImage)
                    <div class="programs_crousel_item">

                        <div class="program_img_box">
                            <figure>
                                <?php
                                echo $image = CustomHelper::showImage(SLIDER_ROOT_PATH, SLIDER_URL, $sliderImage->slider_image, '', ['alt' => $sliderImage->slider_image, 'height' => '405', 'width' => '585', 'zc' => 2]);
                                ?>

                            </figure>
                            <div class="small_logo">
                                <figure>
                                    <?php
                                    echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $result->image, '', ['alt' => $result->image, 'height' => '70', 'width' => '210', 'zc' => 2]);
                                    ?>
                                </figure>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
