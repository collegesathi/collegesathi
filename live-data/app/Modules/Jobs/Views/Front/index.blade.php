@extends('layouts.default')
@section('content')


    <section class="common_banner contactus_banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="inner_page_banner text-center text-md-start">
                        <span>{{ trans('front_messages.Careers.careers') }}</span>
                        <h1 class="m-auto m-md-0">{{ trans('front_messages.Careers.join_our_world_class_message') }}</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact_banner_img">
                        <figure>
                            <img src="{{ WEBSITE_IMG_URL }}career_img.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="career_section">
        <div class="container">
            <div class="bg-white">
                <h2>{{ trans('front_messages.global.open_positions') }}</h2>


                @if (!$model->isEmpty())
                    <div class="department accordion accordion-flush" id="accordionFlushExample">

                        @foreach ($model as $key => $record)
                            <div class="accordion-item {{ $key == 0 ? 'panel-open' : '' }}">
                                <div class="d-flex accordion-header">
                                    <div class="department_accordion">
                                        <h3>{{ isset($record->title) ? $record->title : 'N/A' }}</h3>
                                        <ul class="positions_listing">
                                            <li>
                                                <div class="department_details">
                                                    <h4>{{ trans('front_messages.global.department') }}</h4>
                                                    <p>{{ isset($record->department) ? $record->department : 'N/A' }}</p>
                                                </div>

                                            </li>
                                            <li>
                                                <div class="department_details">
                                                    <h4>{{ trans('front_messages.global.job_posted') }}</h4>
                                                    <p>on
                                                        {{ isset($record->created_at) ? CustomHelper::displayDate($record->created_at, BLOG_DETAIL_DATE_FORMAT) : 'N/A' }}
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="department_details">
                                                    <h4>{{ trans('front_messages.global.employee_type') }}</h4>
                                                    <p>{{ isset($record->jobType->name) ? $record->jobType->name : 'N/A' }}
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="department_details">
                                                    <h4>{{ trans('front_messages.global.experience') }} </h4>
                                                    <p>{{ isset($record->experienceName->name) ? $record->experienceName->name : 'N/A' }}
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="department_details">
                                                    <h4>{{ trans('front_messages.global.location') }} </h4>
                                                    <p>{{ isset($record->location) ? $record->location : 'N/A' }}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="accordion_btn">
                                        <button id="accordion1__{{ $key }}"
                                            class="accordion-button  btn btn-outline-primary hide view_details {{ $key == 0 ? 'show' : '' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne_{{ $key }}"
                                            aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                            aria-controls="flush-collapseOne_{{ $key }}">
                                            <span>{{ trans('front_messages.global.view_details') }}</span>
                                        </button>

                                        <a href="javascript:void(0);" id="firstapply" class="btn btn-primary apply_now show"
                                            onclick="getDetailsPopup('{{ $record->id }}','{{ $record->title }}')">
                                            <span>{{ trans('front_messages.global.apply_for_this_job') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="flush-collapseOne_{{ $key }}"
                                    class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }} accordion_content"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="career_responsibilities responsibilities_listing">
                                            <h4>{{ trans('front_messages.global.job_responsibilities') }}</h4>
                                            {!! !empty($record->job_responsibilities) ? $record->job_responsibilities : 'N/A' !!}
                                        </div>

                                        <div class="career_responsibilities responsibilities_listing">
                                            <h4>{{ trans('front_messages.global.qualification') }}</h4>
                                            {!! !empty($record->qualification) ? $record->qualification : 'N/A' !!}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="text-center mt-5"> {{ trans('front_messages.global.no_record_found_message') }} </h4>

                @endif
            </div>
        </div>
    </section>




    <!-- Modal -->
    <div class="modal fade" id="apply_Job_Model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal_applynow">
            <div class="modal-content">
                <div class="modal-header">

                    <h2 class="modal-title" id="exampleModalLabel"> Apply Now</h2>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="apply_now_modal_box leave_message">
                        <div class="bg-white details_box_main box_shadow">


                            {{ Form::open(['role' => 'form', 'id' => 'applyJobForm', 'class' => 'access_list_form', 'files' => true]) }}

                            {{ Form::hidden('job_id', null, ['class' => 'form-control', 'id' => 'job_id']) }}
                            <!-- <h3 id="job_title_heading"></h3> -->

                            @php

                                if (Auth::check()) {
                                    $first_name = Auth::user()->first_name;
                                    $last_name = Auth::user()->last_name;
                                    $email = Auth::user()->email;
                                    $phone = Auth::user()->phone;
                                } else {
                                    $first_name = '';
                                    $last_name = '';
                                    $email = '';
                                    $dial_code = '';
                                    $phone_number = '';
                                    $phone = '';
                                }

                            @endphp


                            <div class="access_list_box form_col_12">
                                <div class="form_column">
                                    {{ Form::text('first_name', $first_name, ['class' => 'form-control', 'placeholder' => trans('front_messages.global.first_name')]) }}
                                    <span class="error help-inline first_name">
                                        <?php echo $errors->first('first_name'); ?>
                                    </span>
                                </div>
                                <div class="form_column">
                                    {{ Form::text('last_name', $last_name, ['class' => 'form-control', 'placeholder' => trans('front_messages.global.last_name')]) }}
                                    <span class="error help-inline last_name">
                                        <?php echo $errors->first('last_name'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="access_list_box form_col_12">
                                <div class="form_column">
                                    {{ Form::text('email', $email, ['class' => 'form-control', 'placeholder' => trans('messages.global.email')]) }}
                                    <span class="error help-inline email recipient_email_error">
                                        <?php echo $errors->first('email'); ?>
                                    </span>
                                </div>
                                <div class="form_column mobile_input">
                                    <div class="number_select contact_number">
                                        {{ Form::text('phone_number', isset($phone) ? $phone : '', ['id' => 'phoneNumber', 'class' => 'form-control']) }}
                                        {{ Form::hidden('phone', isset($phone) ? $phone : '', ['id' => 'phone', 'class' => 'userphonecode']) }}
                                        {{ Form::hidden('dial_code', isset($dile_code) ? $dile_code : '', ['id' => 'stu_dial_code', 'class' => 'dial_code']) }}

                                        <span class="error help-inline phone_number not_valid_mobile">
                                            {{ $errors->first('phone_number') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="access_list_box form_col_12">
                                <div class="form_column">
                                    {{ Form::text('linkedin_profile', '', ['class' => 'form-control', 'placeholder' => trans('front_messages.global.linkedin_profile')]) }}
                                    <span class="error help-inline linkedin_profile linkedin_profile_error_div" id="linkedin_profile_error_div">
                                        {{ $errors->first('linkedin_profile') }}
                                    </span>
                                </div>
                                <div class="form_column">

                                    <div class="form-group">
                                        <div class="attached-group">
                                            <span
                                                class="d-flex align-items-center attach-name input-file-name-resume">{{ trans('front_messages.global.upload_your_cv') }}
                                            </span>
                                            <span class="uploadButton">
                                                <a href="javascript:void(0);" class="btn upload-btn">{{ trans('front_messages.global.browse') }}</a>
                                                {{ Form::file('resume', ['id' => 'resume', 'class' => 'upload-control']) }}

                                            </span>
                                        </div>
                                    </div>
                                    <span class="error help-inline resume" id="resume_error_div">
                                        {{ $errors->first('resume') }}
                                    </span>
                                </div>
                            </div>

                            <div class="form_col_12">
                                    @php  $courseType     = CustomHelper::getConfigValue('COURSE_TYPE');   @endphp
                                    {{ Form::select('course_type', ['' => trans("front_messages.$modelName.please_select_course")] + $courseType, null, ['class' => 'form-select show-tick', 'id' => 'course_type', 'data-live-search' => 'true']) }}
                                    <span class="error help-inline course_type course_type_error">
                                        <?php echo $errors->first('course_type'); ?>
                                    </span>
                            </div>
                            <div class="access_list_box form_col_12">
                                <div class="form_column">
                                        {{ Form::hidden('country', COUNTRY, ['id' => 'country']) }}
                                        <div id="state_div">
                                            {{ Form::select('state', ['' => trans("front_messages.$modelName.please_select_state")] + $stateList, $old_state, ['class' => 'form-select', 'id' => 'state', 'onchange' => 'getCity(this.value,"city","city_div","contactUsForm", "", "", "form-select")']) }}

                                    </div>
                                    <span class="error help-inline state state_error help-block">
                                        <?php echo $errors->first('state'); ?>
                                    </span>
                                </div>
                                <div class="form_column">
                                        <div id="city_div">
                                            {{ Form::select('city', ['' => trans("front_messages.$modelName.please_select_city")] + $cityList, null, ['class' => 'form-select show-tick', 'id' => 'city', 'data-live-search' => 'true']) }}


                                    </div>
                                    <span class="error help-inline city city_error">
                                        <?php echo $errors->first('city'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form_col_12">
                                    {{ Form::textarea('message', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => trans('front_messages.global.message')]) }}
                                    <span class="error help-inline message ">
                                        <?php echo $errors->first('message'); ?>
                                    </span>
                            </div>
                            <div class="apply_now_btn">
                                <button type="submit" class="btn btn-primary">{{ trans('front_messages.global.submit') }}</button>
                            </div>

                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
<!--pop js start here-->
@section('javascript')
    <script type="text/javascript">
        var jobApply_url = "{{ route('Job.applyJob') }}";
    </script>

    {{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
    {{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}

     {{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'apply_job_application.js') }}
    <script>
        window.onload = (event) => {
            var country = "<?php echo COUNTRY; ?>";
            var old_state = "<?php echo $old_state; ?>";
            if (old_state == '') {
                getState(country, "state", "city", "state_div", "city_div", "applyJobForm", "", "form-select");
            }
        };

        var getStateUrl = "{{ route('getStates.by_country') }}";
        var getCityUrl = "{{ route('getCity.by_state') }}";
        phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer',
            'not_valid_mobile_customer');
        $(document).ready(function() {
            var dateOfBirth = 'dob';
            var calDateFormat = '{{ JS_DATE_FORMAT }}';
            showDateInPast(dateOfBirth, calDateFormat);
        });
    </script>
@stop
