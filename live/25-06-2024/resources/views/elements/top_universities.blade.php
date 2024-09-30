<section class="top_universities">
    @if (!empty($topPrograms->toArray()))    
        <div class="container">
	<div class="headingCard"> 
            <h2 class="text-center heading">{!! trans('front_messages.global.top_university') !!}</h2>
            <p class="text-center paragraphline">{!! trans('front_messages.global.top_university_text') !!}</p>
			  </div>
            <div class="item_slider ">
                <div class="owl-carousel universities_programs owl-theme"> 
                    @foreach ($topPrograms as $programs)    
                        <div class="item">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <div class="universities_img">
                                            <?php
                                                echo $image = CustomHelper::showImage(SLIDER_ROOT_PATH, SLIDER_URL, $programs->getSliders[0]->slider_image, '', ['alt' => $programs->getSliders[0]->slider_image, 'height' => '370', 'width' => '245', 'zc' => 1]);
                                            ?>

                                            @if($programs->is_admission_open == ACTIVE)
                                                <p>Admissions Open </p>
                                            @endif
                                            <div class="top_universities_logo">
                                                <figure>
                                                    <?php
                                                        echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $programs->image, '', ['alt' => $programs->image, 'height' => '54', 'width' => '55', 'zc' => 2]);
                                                    ?>
                                                </figure>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body universities_program_content">
                                            {{-- <span class="card-title">{{ isset($programs->title) ? $programs->title : '' }}</span> --}}
                                            <h4>{{ $programs->title }}</h4>
                                            <p class="card-text">{{ isset($programs->description) ? CustomHelper::getStringLimit($programs->description,176) : '' }}</p>
                                            
											
                                            <div class="program_btn">
                                                <a class="btn btn-primary" href="{{ route('University.frontIndex',[$programs->slug]) }}">{{ trans('front_messages.global.view_details') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</section>
