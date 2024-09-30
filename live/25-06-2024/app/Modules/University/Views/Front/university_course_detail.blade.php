@extends('layouts.default')
@section('content')

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
                            <!-- <span  class="anchorslide"></span> -->
                            <div class="about">
                                <h2 class="heading_program_details">
                                    {{ trans('front_messages.global.about_course') . ' ' . $courseDetail->name }} </h2>
                                <p>{!! $courseDetail->about_course !!}</p>
                                <div class="course_fees">
                                    @include('University::Front.elements.university_course_fee')
                                </div>
                            </div>
                        </section>

                        <section id="Approvals" class="university_approved_main_section">
                            <!-- <span id="Approvals" class="anchorslide"></span> -->
                            @if ($result->university_approval)
                                <div class="university_approved">
                                    <h2 class="heading_program_details mb-2">{{ trans('front_messages.global.approvals') }}
                                    </h2>
                                    {!! $result->university_approval !!}
                                </div>
                            @endif

                            <div class="university_approved_crousel">
                                <div class="slider approved_crousel ">
                                    @foreach (explode(',', $result->universityBadges->university_badges_id) as $badges)
                                        @php
                                            $badgeImages = CustomHelper::getFieldValueByFieldName(
                                                $badges,
                                                'id',
                                                'DropDown',
                                                'image',
                                                'DropDown',
                                            );
                                            $badgeNames = CustomHelper::getMasterDropdownNameById($badges);
                                        @endphp

                                        <div class="approved_logo_box">
                                            <div class="approved_logo">
                                                <figure>
                                                    <?php
                                                    echo $image = CustomHelper::showImage(DROPDOWN_IMAGE_ROOT_PATH, DROPDOWN_IMAGE_URL, $badgeImages, '', ['alt' => $badgeImages, 'height' => '57', 'width' => '57', 'zc' => 0]);
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
                        @if (count($result->universityCourses) > 1)
                            <section class="courses_main_section" id="Courses">
                                @include('University::Front.elements.university_courses_slider')
                            </section>
                        @endif

                        @if (!empty($courseDetail->courseSemesters->toArray()))
                            <section class="courses_main_section DegreeCourses-section mb-5" id="Syllabus">
                                @include('University::Front.elements.semesters')
                            </section>
                        @endif

                        @if ($courseDetail->management_specialisations)
                            <section class="specialisations_section pb-4 pt-2" id="Specialisations">
                                <div class="courses_box">
                                    <h2 class="heading_program_details pb-0">
                                        {{ trans('front_messages.global.management_specialisations') }}</h2>
                                </div>
                                <div class="certificate_listing mb-0">
                                    {!! $courseDetail->management_specialisations !!}
                                </div>
                            </section>
                        @endif


                        {{-- Sample Certificate from Amity University Online --}}
                        @if (isset($courseDetail->course_certificate_image) && $courseDetail->course_certificate_image != '')
                            <section class="certificate_main_section mt-4" id="SampleCertificate">
                                <div class="certificate">
                                    <div class="row align-items-center">
                                        <h2 class="heading_program_details">
                                            {{ trans('front_messages.global.certificate_text_front') }}</h2>
                                        <div class="certificate_img">
                                            <figure>
                                                <a href="{{ COURSE_CERTIFICATE_IMAGE_URL . $courseDetail->course_certificate_image }}"
                                                    class="image-popup-no-margins">
                                                    <?php
                                                    echo $image = CustomHelper::showImage(COURSE_CERTIFICATE_IMAGE_ROOT_PATH, COURSE_CERTIFICATE_IMAGE_URL, $courseDetail->course_certificate_image, '', ['alt' => $courseDetail->course_certificate_image, 'height' => '296', 'width' => '213', 'zc' => 2]);
                                                    ?>
                                                </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                        {{-- Sample Certificate from Amity University Online --}}


                        @if ($result->ranking)
                            <section class="certificate_main_section mt-5" id="Ranking">
                                <div class="courses_box">
                                    <h2 class="heading_program_details pb-0">{{ trans('front_messages.global.ranking') }}
                                    </h2>
                                </div>
                                <div class="certificate_listing mb-0">
                                    {!! $result->ranking !!}
                                </div>
                            </section>
                        @endif


                        <section id="EducationLoanEMI" class="educationloanemi_main_section">
                            <div class="university_approved">
                                <h2 class="heading_program_details">
                                    {{ trans('front_messages.global.education_loan_emi_detail') }}</h2>
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
                                        <span class="d-block d-md-inline-flex">{{ trans('front_messages.global.few_more_options') }}</span>
                                    </div>
                                </div>
                            @endif
                            </div>
                        </section>

                        @if ($result->admission_process)
                            <section id="AdmissionOpen" class="admissionopen_main_section">
                                <div class="admissionopen">
                                    <h2 class="heading_program_details">
                                        {{ trans('front_messages.global.admission_process') }}</h2>
                                    {!! $result->admission_process !!}
                                </div>
                            </section>
                        @endif

                        @if ($courseDetail->eligibility_criteria)
                            <section id="EligibilityCriteria" class="criteria_main_section">
                                <div class="criteriaCard">
                                    <h2 class="heading_program_details">
                                        {{ trans('front_messages.gobal.eligibility_criteria') }}</h2>
                                    {!! $courseDetail->eligibility_criteria !!}
                                </div>
                            </section>
                        @endif



                        @if ($result->examination_pattern)
                            <section class="examinationpattern_main_section" id="ExaminationPattern">
                                <div class="examinationpattern">
                                    <h2 class="heading_program_details pb-0">
                                        {{ trans('front_messages.gobal.examination_pattern') }}</h2>
                                </div>
                                <div class="certificate_listing mb-0">
                                    {!! $result->examination_pattern !!}
                                </div>
                            </section>
                        @endif

                        @if ($result->placement_partners || !empty($result->getUniversityPlacementPartners))
                            <section id="PlacementPartners" class="placementpartners_main_section">
                                <!-- <span id="PlacementPartners" class="anchorslide"></span> -->
                                <div class="placementpartners">
                                    <h2 class="heading_program_details">
                                        {{ trans('front_messages.global.placement_partners') }}</h2>
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
                        @include('University::Front.elements.campuse')
                        <!-- Campuses  -->


                        {{-- University Advantages --}}
                        @if ($result->university_advantages)
                            <section id="Advantages" class="advantages-section mb-5">
                                <div class="advantages-card">
                                    <h2 class="heading_program_details pb-2">
                                        {{ trans('front_messages.global.online_advantages') }}</h2>
                                    <div class="certificate_listing mb-0">
                                        {!! $result->university_advantages !!}
                                    </div>
                                </div>
                            </section>
                        @endif
                        {{-- University Advantages --}}


                        {{-- Frequently Asked Questions? --}}
                        @include('University::Front.elements.course_faq')
                        {{-- Frequently Asked Questions? --}}


                        {{-- Similar and other university  --}}
                        @include('University::Front.elements.similar_and_other_universities')
                        {{-- Similar and other university  --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('elements.learner_support')
    @include('University::Front.elements.apply_university')
    @include('University::Front.elements.compare_modal')

@stop


@section('stylesheet')
    {{ HTML::style(WEBSITE_CSS_URL . 'slick-theme.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'slick.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'jquery.raty.css') }}
    {{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
@stop

@section('javascript')
    <script type="text/javascript">
        var universityApply_url = "{{ route('University.applyUniversity') }}";
        var getStateUrl = "{{ route('getStates.by_country') }}";
        var getCityUrl = "{{ route('getCity.by_state') }}";
        var veryfyotp = "{{ route('University.send-otp') }}";
        var country = "<?php echo COUNTRY; ?>";
        var old_state = "<?php echo $old_state; ?>";
        var jsDateFormat = "{{ JS_DATE_FORMAT }}";
        var mobileTextClass = "{{ $mobileTextClass }}";
    </script>
    {{ HTML::script(WEBSITE_JS_URL . 'slick.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.raty.js') }}
    {{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}

    {{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'apply_university_application.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'course_index.js') }}

@stop
