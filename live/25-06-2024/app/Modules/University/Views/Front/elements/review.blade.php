<?php
   use Carbon\Carbon;
   
   $getReviewRatingForProgressBar = CustomHelper::getReviewRatingForProgressBar($result->id);
   ?>
<section id="TestimonialsReviews" class="testimonialsreviews_main">
   <div class="reviews_content">
      <h2 class="heading_program_details"> {{ trans('front_messages.global.reviews') }}</h2>
      <div class="review_innercontent">
         <div class="student_reviews d-flex">
            <div class="reviews_rating_box  ">
               <figure>
                  <img src="{{ WEBSITE_IMG_URL }}education.png" alt="img">
               </figure>
            </div>
            <div class="user_rating">
               <h4>{{ trans('front_messages.global.students') }}</h4>
               <span>{{ $result->avg_rating }} {{ trans('front_messages.global.out_of_5') }}</span>
               <div class="student_rating d-flex">
                  <span class="rating " data-score='{{$result->avg_rating}}'></span>
                  <span>( {{ $result->review_count }} {{ trans('front_messages.global.reviews') }})</span>
               </div>
            </div>
         </div>
         @if(Auth::check())  
         <?php
            $isAllowReviewAndRating = CustomHelper::isAllowReviewAndRating(Auth::user()->id, $result->id);
            ?>
         @if ($isAllowReviewAndRating)
         <div class="create_review_btn">
            <a href="javascript:void(0);" data-university_id="{{ $result->id }}" id="openReviewPopUpButton" class="btn btn-outline-primary">
            <img class="edit_img" src="{{ WEBSITE_IMG_URL }}edit.png" alt="img"> <img class="edit_whiteimg" src="{{ WEBSITE_IMG_URL }}edit_white.png" alt="img">{{ trans('front_messages.global.review') }}</a>
         </div>
         @endif
         @endif
      </div>
      <div class="ratingbar_img">
         <div class="ratingProgressbar">  
                @foreach ($getReviewRatingForProgressBar as $rating => $review)    
                    <div class="progressBarFlex">
                    <strong class="start">{{$rating}} {{ trans('front_messages.global.star') }}</strong>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{$review.'%'}}" aria-valuenow="{{$review.'%'}}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="startValue">{{$review.'%'}}</span>
                    </div>
                @endforeach 
         </div>
      </div>
      <div class="faq_content padding_top">
         <div class="faq_content_box accordion accordion-flush" id="accordionCalculated">
            <div class="accordion-item">
               <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsecalculated" aria-expanded="false" aria-controls="flush-collapsecalculated">
                  {{ trans('front_messages.global.how_are_rating_calculate') }}
                  </button>
               </h2>
               <div id="flush-collapsecalculated" class="accordion-collapse collapse" data-bs-parent="#accordionCalculated">
                  <div class="accordion-body"> {{ trans('front_messages.global.how_are_rating_calculate_answer') }}</div>
               </div>
            </div> 
         </div>
      </div>
      @if(!empty($result->getReviewRatingUniversitiesPage->toArray()))
      @foreach($result->getReviewRatingUniversitiesPage as $reviews)
      <div class="review_content_box padding_top">
         <div class="d-flex">
            <figure>
               <img src="{{ WEBSITE_IMG_URL }}rimages.png" alt="img">
            </figure>
            <div class="user_reviews">
               <h5>{{ $reviews->getUserDetails->full_name }}</h5>
               <span>Reviewed in India on {{ Carbon::parse($reviews->created_at )->format('F j, Y') }}</span>
               <div class="top_rating d-flex">
                  <span class="rating" data-score='{{$reviews->rating}}'></span>
               </div>
            </div>
         </div>
         <div class="user_reviews_content">
            <h6>{{ trans('front_messages.global.verified') }}</h6>
            <p>{{ $reviews->review_message }}</p>
         </div>
      </div>
      @endforeach
      <div class="all_reviews">
         <a href="javascript:void(0);" class="btn btn-primary" id="AllReviews" data-university_id="{{ $result->id }}"><img src="{{ WEBSITE_IMG_URL }}eye.png" alt="img"> {{ trans('front_messages.global.view_all_reviews') }}</a>
      </div>
      @endif
   </div>
</section>