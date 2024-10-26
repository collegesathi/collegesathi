@extends('layouts.default')
@section('content')

    <div class="customer-review-box">
        <div class="review-carousel owl-carousel owl-theme">
            @foreach($testimonials as $testimonial)
                <div class="item">
                    <div class="review-box">
                        <figure>
                            <img src="{{ WEBSITE_IMG_URL }}quote_right_icon.svg" alt="img">
                        </figure>
                        <p>
                        {{ isset($testimonial->comment)? $testimonial->comment:"N/A" }}
                        </p>
                        <div class="cumtomer-detail">
                            <h3>{{ isset($testimonial->client_name)? $testimonial->client_name:"N/A" }}</h3>
                            <p>{{ isset($testimonial->address)? $testimonial->address:"N/A" }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@stop
