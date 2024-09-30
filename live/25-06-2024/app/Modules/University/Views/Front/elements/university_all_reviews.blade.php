<?php
use Carbon\Carbon;
?>
@if ($allReviews->isNotEmpty())
    @foreach ($allReviews as $reviews)
        <div class="bg-white details_box_main">
            <div class="allrewview_content ">
                <div class="allreviews_heading pb-2 d-flex  align-items-center">
                    <h2><span>{{ CustomHelper::getFirstLatterOfFullName($reviews->getUserDetails->full_name)  }}</span></h2>
                    <h3>{{ $reviews->getUserDetails->full_name }}</h3>
                </div>

                <div class="top_rating pb-3 d-flex">
                    <span class="rating" data-score='{{$reviews->rating}}'></span>
                </div>

                <span class="pb-2">Reviewed in India on {{  Carbon::parse($reviews->created_at )->format('F j, Y')}}</span>

                <h4>{{ trans('front_messages.global.verified') }}</h4>

                <p>{{ $reviews->review_message }}</p>
            </div>
        </div>
    @endforeach
@endif  


<script>
    $('.rating').raty({
            path: '{{ WEBSITE_IMG_URL }}',
            targetKeep: true,
            readOnly: true,
            score: function() {
                return $(this).attr('data-score');
            }
        });
</script>