@extends('layouts.default')
@section('content')


{{ Form::open(['role' => 'form', 'route' => 'survey.getAssistFinalStepSave', 'files' => true, 'class' => 'access_list_form', 'id' => 'surveyForm']) }}

<section class="bg_gray access_contact_section ">
    <div class="container">
        <div class="progress_bar">
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>

        <div class="degree_heading text-center">
            <!-- <span>Your best match is just 2 minutes away!</span> -->
            <h1>{{ trans('front_messages.global.lets_know_each_other') }}</h1>
        </div>

        <div class="details_access_main">
            <div class="details_logo_main access_column">
                <div class="bg-white details_logo_box">
                    <h2>{{ trans('front_messages.global.fill_details') }}</h2>
                    <p>297 {{ trans('front_messages.global.matches_found') }}</p>
                    <div class="details_logo_inner">
                        <ul>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg" alt="">
                                </figure>
                            </li>

                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg" alt="">
                                </figure>
                            </li>

                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg" alt="">
                                </figure>
                            </li>

                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg" alt="">
                                </figure>
                            </li>

                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>

                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>
                            <li>
                                <figure>
                                    <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="">
                                </figure>
                            </li>
                        </ul>
                    </div>
                    <div class="sign_up_access">
                        <h3> {{ trans('front_messages.global.signup_now') }}<br> {{ trans('front_messages.global.access_list') }}</h3>
                    </div>
                </div>
            </div>
            <div class="contact_details_box access_column">
                <div class="bg-white details_box_main">

                    <div class="access_list_box pb-30">
                        <div class="form-check icon_input ">
                            {{ Form::radio('gender', MALE, MALE, ['id' => 'Main']) }}
                            <label for="Main" class="input_icon_man">
                                <img class="icon_imgorange" src="{{ WEBSITE_IMG_URL }}man.svg" alt="">
                                <img class="icon_imgwhite" src="{{ WEBSITE_IMG_URL }}man_white.svg" alt="">
                                <span>{{ trans('front_messages.global.male') }}</span>
                            </label>
                        </div>
                        <div class="form-check icon_input ">
                            {{ Form::radio('gender', FEMALE, null, ['id' => 'Female']) }}
                            <label for="Female" class="input_icon_woman">
                                <img class="icon_imgorange" src="{{ WEBSITE_IMG_URL }}woman.svg" alt="">
                                <img class="icon_imgwhite" src="{{ WEBSITE_IMG_URL }}woman_white.svg" alt="">
                                <span>{{ trans('front_messages.global.female') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form_col_12">
                        {{ Form::label('full_name', trans('front_messages.User.full_name').'<span class="error"> *</span>' , ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('full_name', null, ['class' => 'form-control field_class']) }}
                        <span class="error help-inline full_name contact_us_full_name_error_div">
                            <?php echo $errors->first('full_name'); ?>
                        </span>
                    </div>
                    <div class="form_col_12">
                        {{ Form::label('contact_email_us', trans('front_messages.User.contact_email_us').'<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('email', null, ['class' => 'form-control field_class']) }}
                        <span class="error help-inline email contact_email_error">
                            <?php echo $errors->first('email'); ?>
                        </span>
                    </div>
                    <div class="access_list_box form_col_12 mobile_input">
                        <div class="form_column countrynumber number_select">
                            {{ Form::label('phone', trans('front_messages.global.phone').'<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            {{ Form::text('phone_number', null, [
                                        'class' => 'form-control contactno ' . $mobileTextClass,
                                        'id' => 'phoneNumberCustomer',
                                        'onpaste' => 'return false;',
                                        'oncopy' => 'return false;',
                                        'maxlength' => '10',
                                        'placeholder' => 'Mobile Number*',
                                        'onkeypress' => 'return isNum(event)',
                                        'style' => 'border-radius: 0;',
                                    ]) }}

                            {{ Form::hidden('otp_veryfy','',['id'=>'otp_veryfy'] )}}


                            {{-- {{ Form::text('phone_number', null, ['id' => 'phoneNumberCustomer', 'class' => 'form-control field_class', 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}"]) }} --}}
                            {{ Form::hidden('phone_number_with_dial_code', '', ['id' => 'phoneCustomer', 'class' => 'userphonecode']) }}
                            {{ Form::hidden('dial_code', '', ['id' => 'stu_dial_codeCustomer', 'class' => 'customer_dial_code']) }}
                            <span class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_error not_valid_mobile_customer  contact_us_phone_number_error">
                                {{ $errors->first('phone_number_with_dial_code') }}
                            </span>
                        </div>



                        <div class="form_column">
                            {{ Form::label('dob', trans('front_messages.global.dob').'<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            {{ Form::text('dob', null, ['class' => 'form-control field_class', 'id' => 'dob']) }}
                            <span class="error help-inline dob contact_us_dob_error_div">
                                <?php echo $errors->first('dob'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="form_col_12 otpAction">
                        <input type="text" id="txtotp<?php echo $mobileTextClass; ?>" maxlength="6" class="form-control txtotp txtotp<?php echo $mobileTextClass; ?>" placeholder="OTP" aria-required="true" style="border-radius: 0;">

                        <div class="otpActionBtn">
                            <input id="btnVerify<?php echo $mobileTextClass; ?>" class="btnVerify form-control" onclick="VerifyOTP('<?php echo $mobileTextClass; ?>');" type="button" value="Verify">
                            <input id="btnResend<?php echo $mobileTextClass; ?>" class="btnResend form-control" onclick="ResendCode('<?php echo $mobileTextClass; ?>');" type="button" value="Resend">
                            <input id="btnVerifySuccess<?php echo $mobileTextClass; ?>" class="btnVerifySuccess form-control" type="button" value="Verified" style="display:none;">
                        </div>
                        <span class="error help-inline  otp_error_div">
                            <?php echo $errors->first('dob'); ?>
                        </span>
                    </div>

                    <div class="access_list_box form_col_12">
                        <div class="form_column">
                            {{ Form::hidden('country', COUNTRY, ['id' => 'country']) }}
                            {{ Form::label('state', trans('front_messages.global.state').'<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            <div id="state_div">

                                {{ Form::select('state', ['' => trans("front_messages.$modelName.please_select_state")] + $stateList, $old_state, ['class' => 'form-select field_class', 'id' => 'state', 'onchange' => 'getCity(this.value,"city","city_div","surveyForm", "", "", "form-select")']) }}
                            </div>
                            <span class="error help-inline state contact_state_error">
                                <?php echo $errors->first('state'); ?>
                            </span>
                        </div>
                        <div class="form_column">
                            {{ Form::label('city', trans('front_messages.global.city').'<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            <div id="city_div">

                                {{ Form::select('city', ['' => trans("front_messages.$modelName.please_select_city")] + $cityList, null, ['class' => 'form-select show-tick field_class', 'id' => 'city', 'data-live-search' => 'true']) }}
                            </div>
                            <span class="error help-inline city contact_city_error">
                                <?php echo $errors->first('city'); ?>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6 g-recaptcha-box">
                            <input type="hidden" id="g-recaptcha-response-survey" name="g-recaptcha-response">
                            <span class="error  help-inline g-recaptcha-response_error g-recaptcha-response" id="g-recaptcha-response_error_div">
                                <?php echo $errors->first('g-recaptcha-response'); ?>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer_step">
    <div class="container">
        <div class="step_btn text-center">
            <a href="{{ route('survey.getAssistPreviousStep') }}" class="btn btn-white">Back</a>
            <button type="submit" id="submit1" class="btn btn-primary submit_btn">{{ trans('front_messages.global.submit') }}</button>
        </div>
    </div>
</footer>
{{ Form::close() }}


@section('javascript')
{{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'surveyValidation.js') }}
{{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
            document.getElementById('g-recaptcha-response-survey').value = token;
        });
    });

    window.onload = (event) => {
        var country = "<?php echo COUNTRY; ?>";
        var old_state = "<?php echo $old_state; ?>";
        if (old_state == '') {
            getState(country, "state", "city", "state_div", "city_div", "surveyForm", "", "form-select");
        }
    };

    var getStateUrl = "{{ route('getStates.by_country') }}";
    var getCityUrl = "{{ route('getCity.by_state') }}";
    var veryfyotp = "{{ route('University.send-otp') }}";

    phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer',
        'not_valid_mobile_customer');
    $(document).ready(function() {
        var dateOfBirth = 'dob';
        var calDateFormat = '{{ JS_DATE_FORMAT }}';
        showDateInPast(dateOfBirth, calDateFormat);



        $(document).on('blur', '.contactno', function() {
            // alert($(this).val());

            SendOTP('{{ $mobileTextClass }}');
        });
    });
</script>
@endsection
@stop