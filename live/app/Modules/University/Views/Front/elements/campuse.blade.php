
@if (isset($slug) && !isset($course_slug))
    @if (!empty($indianCampuses) || !empty($internationalCampuses))
    <section id="Campuses" class="campuses_section mb-5">
        <h2 class="heading_program_details">{{ $result->title }} Campuses</h2>
        <div class="row">
            @if(!empty($indianCampuses))
            <div class="col-sm-6">
                <div class="campusesCard industry_listing_box">
                    <h3>{{ trans('front_messages.global.all_over_india') }} <span> <img src="{{ WEBSITE_IMG_URL }}top_arrow_right.png" alt="img"> </span></h3>
                    <ul class="certificate_listing mb-0">
                        @foreach ($indianCampuses as $indian_campuses_list)
                            <li>{{ $indian_campuses_list }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            @if(!empty($internationalCampuses))
                <div class="col-sm-6">
                    <div class="campusesCard industry_listing_box second_listing_box">
                        <h3>{{ trans('front_messages.global.international_campuses') }} <span> <img src="{{ WEBSITE_IMG_URL }}top_arrow_right.png"
                                    alt="img"> </span></h3>
                        <ul class="certificate_listing mb-0">
                            @foreach ($internationalCampuses as $international_campuses_list)
                                <li>{{ $international_campuses_list }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endif
@endif