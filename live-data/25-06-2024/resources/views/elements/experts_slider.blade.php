@php

$expertData = CustomHelper::getExpertData();

@endphp
 
@if(!empty($expertData))
<section class="experts_section">
        <div class="container"> 
            <div class="experts_main">
				<div class="headingCard">
				  <h2 class="text-center heading"> {!! trans('front_messages.global.right_ruidance_from_expert') !!}</h2>
				         <p class="paragraphline text-center">{{ trans('front_messages.global.brightest_minds_from_across_the_globe_help_message') }}</p>
			   </div>
                <!--<div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="guidance">
                            <h2 class="inner_heading"> {!! trans('front_messages.global.right_ruidance_from_expert') !!}</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="guidance experts_contant ">
                            <p>{{ trans('front_messages.global.brightest_minds_from_across_the_globe_help_message') }}</p>
                        </div>
                    </div>

                </div>-->
                <div class="item_slider ">
                    <div class="owl-carousel experts_slider owl-theme">


                        @foreach($expertData as $expert)

                        <div class="item">
                            <div class="guidance_box">

                            @php
                            $root_path = EXPERT_IMAGE_ROOT_PATH;
                            $http_path = EXPERT_IMAGE_URL;
                            $attribute = array();
                            $type = '';
                            $attribute['alt'] = $expert->name;
                            $attribute['width'] = '305';
                            $attribute['height'] = '350';
                            $attribute['cropratio'] = '1:1';
                            $attribute['zc'] = '1';
                            $attribute['type'] = '3';
                            $image_name =  $expert->image;

                            $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                            @endphp
                                <figure>
                                    {!! $image !!}
                                </figure>
								<div class="expertswrapper">
                                <span class="expert">{{isset($expert->designation) ? $expert->designation : "N/A"}}</span>
                                <h3>{{isset($expert->name) ? $expert->name : "N/A"}}</h3>
                                <p>{{isset($expert->short_description) ? $expert->short_description : "N/A"}}</p>
                                <div class="consult_now">
                                    <a href="{{ route('survey.getAssist',$expert->slug) }}" class="btn btn-primary">{{ trans('front_messages.global.consult_now') }}</a>
                                </div>
								 </div>
                            </div>
                        </div>
                       @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
