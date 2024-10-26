<?php
if (!empty($universities)) {
?>
    <section class="universities">
        <div class="container">
              <!--<h2 class="text-center">{!! trans('front_messages.global.collaborate_universities_text') !!}
            </h2>-->
            <!-- <h2 class="text-center"><span class="fw_normal">We collaborate with </span>100+ leading universities
                <span class="fw_normal">&</span> companies
            </h2> -->
        </div>
        <div class="owl-carousel universities_carousel owl-theme">
			 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo1.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo2.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo3.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo4.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo5.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo6.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo7.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo8.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo9.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo10.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo11.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo12.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo13.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo14.png" alt="image">
                        </figure>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                	    <img src="{{ WEBSITE_IMG_URL }}university-logo15.png" alt="image">
                        </figure>
                </div>
			
		
		
            <!--  <?php
            foreach ($universities as $key => $value) {
            ?>  
                <div class="item">
                    <div class="universities_cardbox">
                        <figure>
                            <?php
                            echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $value['image'], '', ['alt' => $value['image'], 'height' => '77', 'width' => '100', 'zc' => 2]);
                            ?>
                        </figure>
                        <div class="universities_content">
                            <p>{{ isset($value['short_text']) && !empty($value['short_text']) ? $value['short_text'] : '' }}</p>
                            <a href="{{ route('University.frontIndex', $value['slug']) }}">{{ trans('front_messages.global.view_our_courses') }}</a>
                        </div>
                    </div>
                </div>
				
				 <div class="item">
               <figure class="universitieslogo">
                            <?php
                            echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $value['image'], '', ['alt' => $value['image'], 'height' => '77', 'width' => '100', 'zc' => 2]);
                            ?>
                        </figure>
                </div>
				
            <?php  } ?>-->
        </div>
    </section>
<?php
}
?>