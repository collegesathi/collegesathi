@php
    $testimonialList = CustomHelper::getTestimonial();
@endphp


@if (!empty($testimonialList))
    <section class="testimonials">
        <div class="container">
			<div class="headingCard">
            <h2 class="text-center heading ">{!! trans('front_messages.global.testimonials') !!}</h2>
            <p class="text-center paragraphline">{{ trans('front_messages.global.trusted_from _our_learners') }}</p>
	  </div>
            <div class="owl-carousel owl-theme testimonials-slider">

                @foreach ($testimonialList as $record)
                    <div class="item small_width">
                        <div class="testimonial-wrapper">
						
						       <div class="userClient-image testimonial-authors">
                                    @php
                                    $root_path = TESTIMONIAL_IMAGE_ROOT_PATH;
                                    $http_path = TESTIMONIAL_IMAGE_URL;
                                    $attribute = [];
                                    $type = '';
                                    $attribute['alt'] = $record->title;
                                    $attribute['width'] = '295';
                                    $attribute['height'] = '354';
                                    $attribute['zc'] = '1';
                                    $attribute['type'] = '3';
                                    $image_name = $record->image;

                                    $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                                @endphp
                                    <div class="testimonials_img">
                                        {!!  $image !!}
                                    </div>
									
									   <div class="testimonials_details">
                                            <h4>{{ isset($record->descriptionData->client_name) ? $record->descriptionData->client_name : '' }}</h4>
                                            <p>{{ isset($record->descriptionData->designation) ? $record->descriptionData->designation : '' }}
											<strong>{{ isset($record->descriptionData->company) ? $record->descriptionData->company : '' }},    <span>{{ isset($record->descriptionData->batch) ? $record->descriptionData->batch : '' }}</span></strong>
                                            </p>
                                         
                                        </div>
									

                                </div>
						
                                        <div class="testimonials_decription scrollbar1 content_scroll">
                                            <div class="testimonials_overflow">
                                                <p class="card-text">{{ isset($record->descriptionData->comment) ? $record->descriptionData->comment : '' }}
                                                <a href="#">Read More</a></p>
                                            </div>

                                        </div>
										
										<div class="quote-icon mt-20"> <img src="{{ WEBSITE_IMG_URL }}quote.svg" alt="image"></div>
                                     

                             
                         
                        </div>
                    </div>
                @endforeach
            </div>
			
        </div>
    </section>
@endif