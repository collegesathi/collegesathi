@extends('layouts.default')
@section('content')

@php
    if (Session::has('review_message')) { 
        Session::flash(SUCCESS, trans("front_messages.rating_has_been_successfully_added_message"));
        Session::forget('review_message');
        Session::save();
    }

    if (Session::has('enquiry_message')) { 
        Session::flash(SUCCESS, trans("front_messages.enquiry.success_message"));
        Session::forget('enquiry_message');
        Session::save();
    }
@endphp 

{{-- Slider section element  --}}
@include('University::Front.elements.slider_section')
{{-- Slider section element  --}}  
 
    <iframe src="{{ route('University.downloadProspectus') }}" style="height:0;" title="description"></iframe>


<section class="programs_details_section university_details_section">
    <div class="container">
        <div class="programs_tab_listing d-flex">

            @include('University::Front.elements.sidebar')

            <div class="university_program_detaile ">  
                <div class="bg-white box_shadow scrollspy-example">

                    <section id="About" class="about_main_section">
                        <div class="about">
                            <h2 class="heading_program_details">{{ trans('front_messages.global.about_university') .' '. $result->title }}</h2>
                            {!! $result->description !!}
                            <div class="course_fees">
                                @include('University::Front.elements.university_course_fee')
                            </div>
                        </div>
                    </section>


                    <section id="Approvals" class="university_approved_main_section">

                        @if($result->university_approval)
                        <div class="university_approved">
                            <h2 class="heading_program_details mb-2 w-100">{{ trans('front_messages.global.approvals') }}</h2>
                            {!! $result->university_approval !!}
                        </div>
                        @endif

                        <div class="university_approved_crousel">
                            <div class="slider approved_crousel ">
                                @foreach (explode(',', $result->universityBadges->university_badges_id) as $badges)
                                @php
                                $badgeImages = CustomHelper::getFieldValueByFieldName($badges, 'id', 'DropDown', 'image', 'DropDown',);
                                $badgeNames = CustomHelper::getMasterDropdownNameById($badges);
                                @endphp

                                <div class="approved_logo_box">
                                    <div class="approved_logo">
                                        <figure>
                                            <?php
                                            echo $image = CustomHelper::showImage(DROPDOWN_IMAGE_ROOT_PATH, DROPDOWN_IMAGE_URL, $badgeImages, '', ['alt' => $badgeImages, 'height' => '57', 'width' => '57', 'zc' => 2]);
                                            ?>
                                        </figure>
                                        <div class="logo_details">
                                            <h5>{{ $badgeNames }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
  

                    @if (!empty($result->universityCourses->toArray()))
                        <section class="courses_main_section" id="Courses">
                            @include('University::Front.elements.university_courses_slider')
                        </section>
                    @endif


                    @if($result->management_specialisations)
                    <section class="specialisations_section pb-4 pt-2" id="Specialisations">
                        <div class="courses_box">
                            <h2 class="heading_program_details pb-0">{{ trans("front_messages.global.management_specialisations") }}</h2>
                        </div>
                        <div class="certificate_listing mb-0">
                            {!! $result->management_specialisations !!}
                        </div>
                    </section>
                    @endif


                    {{-- Sample Certificate from Amity University Online --}}
                    @if(isset($result->university_certificate_image) && $result->university_certificate_image !="" )
                    <section class="certificate_main_section mt-4" id="SampleCertificate">
                        <div class="certificate">
                            <div class="row align-items-center">
                                <h2 class="heading_program_details">{{ trans('front_messages.global.certificate_text_front') . ' ' . $result->title }}</h2>
                                <div class="certificate_img">
                                    <figure>
                                        <a href="{{ UNIVERSITY_CERTIFICATE_IMAGE_URL.$result->university_certificate_image }}" class="image-popup-no-margins">
                                            <?php
                                            echo $image = CustomHelper::showImage(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH, UNIVERSITY_CERTIFICATE_IMAGE_URL, $result->university_certificate_image, '', ['alt' => $result->university_certificate_image, 'height' => '296', 'width' => '213', 'zc' => 2]);
                                            ?>
                                        </a>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </section>
                    @endif
                    {{-- Sample Certificate from Amity University Online --}}


                    {{-- Ranking --}}
                    <section class="certificate_main_section mt-5" id="Ranking">
                        <div class="courses_box">
                            <h2 class="heading_program_details pb-0">{{ trans('front_messages.global.ranking') }}</h2>
                        </div>
                        <div class="certificate_listing mb-0">
                          {!! $result->ranking !!}    
                        </div>
                    </section>
                    {{-- Ranking --}}


                    <section id="EducationLoanEMI" class="educationloanemi_main_section">
                        <div class="university_approved">
                            <h2 class="heading_program_details"> {{ trans("front_messages.global.education_loan_emi_detail") }}</h2>
                        </div>
                        <div class="educationloanemi">
                             
                            {!! $result->emi_detail !!}
                           
                            <!-- Course EMI detail table -->
                            @include('University::Front.elements.course_emi_table')
                            <!-- Course EMI detail table -->

                            <div class="educationloanemi_btn">
                                <small class="d-block">{{ trans('front_messages.global.university_page_emi_note') }}
                                </small>
                            </div>

                            @if ($result->universityLoanPartners->isNotEmpty())    
                                <div class="loancard-box pt-3">
                                    <strong class="loan-head">{{ trans('front_messages.global.loan_partners') }}</strong>
                                    <div class="partner-image d-md-flex align-items-center"> 
                                        @foreach ($result->universityLoanPartners as $loanPartners)
                                            <img src="{{ LOAN_PARTNER_IMAGE_URL . $loanPartners->image }}" alt="img" class="me-2" height="35">
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>


                    @if($result->admission_process)
                    <section id="AdmissionOpen" class="admissionopen_main_section">
                        <div class="admissionopen">
                            <h2 class="heading_program_details">{{ trans('front_messages.global.admission_process').' '. $result->title }}</h2>
                            {!! $result->admission_process !!}
                        </div>
                    </section>
                    @endif

 
                    @if($result->eligibility_criteria)
                    <section class="criteria_main_section" id="EligibilityCriteria">
                        <div class="courses_box">
                            <h2 class="heading_program_details pb-0">{{ trans("front_messages.global.eligibility_criteria") }}</h2>
                        </div>
                        <div class="certificate_listing mb-0">
                          {!! $result->eligibility_criteria !!}    
                        </div>
                    </section>
                    @endif


                    @if($result->examination_pattern)
                    <section class="examinationpattern_main_section" id="ExaminationPattern">
                        <div class="examinationpattern">
                            <h2 class="heading_program_details pb-0">{{ trans("front_messages.gobal.examination_pattern").' '. $result->title  }}</h2>
                        </div>
                        <div class="certificate_listing mb-0">
                          {!! $result->examination_pattern !!}    
                        </div>
                    </section>
                    @endif




                    @if($result->placement_partners || !empty($result->getUniversityPlacementPartners))
                    <section id="PlacementPartners" class="placementpartners_main_section">
                        <!-- <span id="PlacementPartners" class="anchorslide"></span> -->
                        <div class="placementpartners">
                            <h2 class="heading_program_details"> {{ trans("front_messages.global.placement_partners") }}</h2>
                            <span class="program_subheading">Our students get an opportunity to work with</span>
                            <div class="certificate_listing mb-0">
                                {!! $result->placement_partners !!}
                            </div>

                            <!-- Placement partners slider -->
                            <div class="slider placementpartners_crousel">
                                @include('University::Front.elements.university_placement_partners')
                            </div>
                            <!-- Placement partners slider -->
                        </div>
                    </section>
                    @endif

                    <!-- Campuses  -->
                    @if (isset($slug) && !isset($course_slug))
                        @if (!empty($indianCampuses) || !empty($internationalCampuses))
                            @include('University::Front.elements.campuse')
                        @endif
                    @endif
                    <!-- Campuses  -->


                    {{-- University Advantages --}}
                    @if($result->university_advantages)
                    <section id="Advantages" class="advantages-section mb-5">
                        <div class="advantages-card">
                            <h2 class="heading_program_details pb-2"> {{ trans('front_messages.global.online_advantages').' '. $result->title }}</h2>
                            <div class="certificate_listing mb-0">
                                {!! $result->university_advantages !!}
                            </div>
                        </div>
                    </section>
                    @endif
                    {{-- University Advantages --}}



                    @if (!empty($result->faqs->toArray()))
                    {{-- Frequently Asked Questions? --}}
                    @include('University::Front.elements.faq')
                    {{-- Frequently Asked Questions? --}}
                    @endif


                    @if (isset($slug) && !isset($course_slug) && !empty($result->blogs->toArray()))
                        @include('University::Front.elements.blogs')
                    @endif


                    {{-- Similar and other university  --}}
                    @include('University::Front.elements.similar_university')
                    {{-- Similar and other university  --}}


  
                    @include('University::Front.elements.review')
                </div>
            </div>
        </div>


    </div>

</section>
@include('elements.learner_support')

@include('University::Front.elements.apply_university') 

@include('University::Front.elements.review_raiting_form')

<!-- info modal -->
<div class="modal fade" id="ReviewsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header allreviews">

                <span>{{ trans('front_messages.global.all_reviews') }}</span>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="apply_now_modal_box future_modal all_reviews_data"></div>
            </div>
        </div>
    </div>
</div>


<!-- video modal -->
<div class="modal fade" id="ApprovedVideoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal_applynow">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="video_section_modal">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Diao6b6lfpE" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </div>
</div>
<!--  -->


<!-- info modal -->
<div class="modal fade" id="ExaminationPatternModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content examination_pattern">
            <div class="modal-header logo">
                <h2 class="modal-title"> Examination Pattern</h2>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="view_examination_content future_modal">
                    <p> <a href="assets/images/manipal-exam-pattern.pdf" target="_blank">Click Here to View
                            Examination Pattern!</a></p>

                </div>
            </div>

        </div>
    </div>
</div>
<!--  -->




{{-- Enquire Now Form Model --}}
@include('elements.enquire_now')
{{-- Enquire Now Form Model --}}

{{-- Enquire Now Sticky Button Element --}}
@include('elements.enquire_now_sticky_button')
{{-- Enquire Now Sticky Button Element --}}
@stop


@section('stylesheet')
{{ HTML::style(WEBSITE_CSS_URL . 'slick-theme.css') }}
{{ HTML::style(WEBSITE_CSS_URL . 'slick.css') }}
{{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::style('plugins/admin/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
{{ HTML::style(WEBSITE_CSS_URL . 'jquery.raty.css') }}
@stop

@section('javascript')
<script type="text/javascript">
    var universityApply_url = "{{ route('University.applyUniversity') }}";
    var getStateUrl = "{{ route('getStates.by_country') }}";
    var getCityUrl = "{{ route('getCity.by_state') }}";
    var veryfyotp = "{{ route('University.send-otp') }}";
    var reviewUrl = "{{ route('ReviewRating.review_rating') }}";
    var viewAllReviewsUrl = "{{ route('University.viewAllReviews') }}";
    var mobileTextClass = "{{ $mobileTextClass }}";
    var jsDateFormat = "{{ JS_DATE_FORMAT }}";
    var maxLength = '<?php echo REVIEW_RATING_MAX_LENGTH; ?>';
    var country = "<?php echo COUNTRY; ?>";
    var old_state = "<?php echo $old_state; ?>";
</script>

{{ HTML::script(WEBSITE_JS_URL . 'slick.min.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'jquery.raty.js') }}
{{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
{{ Html::script(WEBSITE_JS_URL . 'apply_university_application.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'jquery.magnific-popup.min.js') }}
{{ HTML::script('plugins/admin/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}
{{ HTML::script('js/admin/custom_calendar.js') }}
{{ Html::script(WEBSITE_JS_URL . 'university_index.js') }}

{{-- Enquire Now Script --}}
<script>
    window.addEventListener('load', function() {
        setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById('enquireNowModel'));
            myModal.show();
        }, 2000);
    });
</script>
{{-- Enquire Now Script --}}
@stop