@extends('layouts.default')
@section('content')

<section class="banner_section">
	      <img src="{{ WEBSITE_IMG_URL }}bshape_01.png" alt="image" class="globeshape">

    <!--<div class="banner_img">
        <?php
        $homeBannerImages = CustomHelper::getBlockdetail('banner-images');
        ?>
        {!! $homeBannerImages->description ?? '' !!}
    </div>-->
    <div class="container">
	<div class="bannerFlex">
        <div class="banner_content">  
            <?php
            $homeBannerText = CustomHelper::getBlockdetail('banner-text');
            ?>
            {!! $homeBannerText->description ?? '' !!}
        </div>
		
	
		
		 </div>  
		
    </div>
</section>

<!-- ################ COLLABORATE UNIVERSITIES SECTION ################ -->
@include('elements.collaborate_universities_slider') 
<!-- ################ COLLABORATE UNIVERSITIES SECTION ################ -->


<!-- ################ QUESTION STEPS SECTION ################ -->
@include('elements.question_steps')
<!-- ################ QUESTION STEPS SECTION ################ -->



<!-- ################ Explore Our Programs ################ -->
@include('elements.explore_programs')
<!-- ################ Explore Our Programs ################ -->


<!-- ################ Students Counter ################ -->

<!-- ################ Students Counter ################ -->



<!-- ################ EXPERTS SLIDER SECTION ################ -->
@include('elements.experts_slider')
<!-- ################ EXPERTS SLIDER SECTION ################ -->

<!-- ################ Top Universities Programs ################ -->  
@include('elements.top_universities')
<!-- ################ Top Universities Programs ################ -->


<!-- ################ TESTIMONIAL SECTION ################ -->
@include('elements.testimonial')
<!-- ################ TESTIMONIAL SECTION ################ -->

<!-- ################ BLOG SECTION ################ -->
@include('elements.blog')   
<!-- ################ BLOG SECTION ################ -->


<!-- ################ BLOG SECTION ################ -->
@include('elements.leading_universities')
<!-- ################ BLOG SECTION ################ -->


<!-- ################ Trending ################ -->
@include('elements.trending')
<!-- ################ Trending ################ -->

<!-- ################ Learner Support ################ -->
@include('elements.learner_support')
<!-- ################ Learner Support ################ -->
    
	
	




@stop