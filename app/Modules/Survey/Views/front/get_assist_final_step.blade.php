@extends('layouts.default')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



{{ Form::open(['role' => 'form', 'route' => 'survey.getAssistFinalStepSave', 'files' => true, 'class' => 'access_list_form', 'id' => 'surveyForm']) }}

<section class="bg_gray access_contact_section ">
    <div class="container">
        <div class="progress_bar">
            <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100">
                <div class="progress-bar" style="width: 100%"></div>
            </div>
        </div>

        <div class="degree_heading text-center">
            <!-- <span>Your best match is just 2 minutes away!</span> -->
            <h1>{{ trans('front_messages.global.lets_know_each_other') }}
                <img src="{{ WEBSITE_IMG_URL }}hand-shake.png" alt="">
            </h1>
        </div>

        <div class="details_access_main">
            <div class="details_logo_main access_column">
                <div class="bg-white details_logo_box">
                    <h3 class="chhh">Just one more step! <br> Enter your details to view your personalized
                        recommendations</h3>
                        <div class="logo-center">
            <img src="http://localhost/mukul/images/step-img.gif" alt="Centered Logo">
        </div>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="grid-container">
                                    <!-- First Row -->
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg"
                                            alt="Logo 1"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg"
                                            alt="Logo 2"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg"
                                            alt="Logo 3"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg"
                                            alt="Logo 1"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg"
                                            alt="Logo 2"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg"
                                            alt="Logo 3"></div>
                                    <!-- Second Row -->
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg"
                                            alt="Logo 4"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg"
                                            alt="Logo 5"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg"
                                            alt="Logo 6"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg"
                                            alt="Logo 4"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo3.jpg"
                                            alt="Logo 5"></div>
                                    <div class="grid-item"><img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg"
                                            alt="Logo 6"></div>
                                </div>
                            </div>
                            <!-- Add more slides as needed -->
                        </div>
          
                    </div>
                    
                    <div class="sign_up_access">
                        <h3> {{ trans('front_messages.global.signup_now') }}<br>
                            {{ trans('front_messages.global.access_list') }}</h3>
                    </div>
                </div>
            </div>
            <div class="contact_details_box access_column">
                <div class="bg-white details_box_main">
                <div class="bg-light d-flex fs-11 align-items-center justify-content-center gap-2 mt-0 flex-wrap py-3 shadow-sm rounded"
                                style="background: #f9f9f9; border: 1px solid #ddd;">
                                <img src="http://localhost/mukul/images/expertimages-01.svg" alt="Team image"
                                    style="width: 50px; height: auto;" class="rounded-circle">
                                <span class="fw-bold fs-12 text-dark">Consult with our Collegesathi experts.</span>
                                <span class="text-warning"><i class="fas fa-handshake"></i></span>
                            </div>
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
                        {{ Form::label('full_name', trans('front_messages.User.full_name') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('full_name', null, ['class' => 'form-control field_class']) }}
                        <span class="error help-inline full_name contact_us_full_name_error_div">
                            <?php echo $errors->first('full_name'); ?>
                        </span>
                    </div>
                    <div class="form_col_12">
                        {{ Form::label('contact_email_us', trans('front_messages.User.contact_email_us') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('email', null, ['class' => 'form-control field_class']) }}
                        <span class="error help-inline email contact_email_error">
                            <?php echo $errors->first('email'); ?>
                        </span>
                    </div>
                    <div class="access_list_box form_col_12 mobile_input">
                        <div class="form_column countrynumber number_select">
                            {{ Form::label('phone', trans('front_messages.global.phone') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            {{ Form::text('phone_number', null, [
    'class' => 'form-control contactno ' . $mobileTextClass,
    'id' => 'phoneNumberCustomer',
    'onpaste' => 'return false;',
    'oncopy' => 'return false;',
    'maxlength' => '10',
    'placeholder' => 'Mobile Number*',
    'onchange' => "return SendOTP('mobile02')",
    'onkeypress' => 'return isNum(event)',
    'style' => 'border-radius: 0;',
]) }}

                            {{ Form::hidden('otp_veryfy', '', ['id' => 'otp_veryfy'])}}


                            {{-- {{ Form::text('phone_number', null, ['id' => 'phoneNumberCustomer', 'class' =>
                            'form-control field_class', 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return
                            false}"]) }} --}}
                            {{ Form::hidden('phone_number_with_dial_code', '', ['id' => 'phoneCustomer', 'class' => 'userphonecode']) }}
                            {{ Form::hidden('dial_code', '', ['id' => 'stu_dial_codeCustomer', 'class' => 'customer_dial_code']) }}
                            <span
                                class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_error not_valid_mobile_customer  contact_us_phone_number_error">
                                {{ $errors->first('phone_number_with_dial_code') }}
                            </span>
                        </div>
                        <div class="form_column otpAction">
                            <label> OTP*</label>
                            <div class="otpInputContainer">
                                <input type="text" id="txtotp<?php echo $mobileTextClass; ?>" maxlength="6"
                                    class="form-control field_class txtotp txtotp<?php echo $mobileTextClass; ?>"
                                    placeholder="OTP" aria-required="true" style="border-radius: 0;">

                                <div class="otpActionBtn">
                                    <input id="btnVerify<?php echo $mobileTextClass; ?>" class="btnVerify form-control"
                                        onclick="VerifyOTP('<?php echo $mobileTextClass; ?>');" type="button"
                                        value="Verify">
                                    <input id="btnResend<?php echo $mobileTextClass; ?>" class="btnResend form-control"
                                        onclick="ResendCode('<?php echo $mobileTextClass; ?>');" type="button"
                                        value="Resend">
                                    <input id="btnVerifySuccess<?php echo $mobileTextClass; ?>"
                                        class="btnVerifySuccess form-control" type="button" value="Verified"
                                        style="display:none;">
                                </div>
                                <span class="error help-inline  otp_error_div">
                                    <?php echo $errors->first('dob'); ?>
                                </span>
                            </div>
                        </div>



                    </div>


                    <div class="form_col_12">
                        {{ Form::label('dob', trans('front_messages.global.dob') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('dob', null, ['class' => 'form-control field_class', 'id' => 'dob']) }}
                        <span class="error help-inline dob contact_us_dob_error_div">
                            <?php echo $errors->first('dob'); ?>
                        </span>
                    </div>
                    <div class="access_list_box form_col_12">
                        <div class="form_column">
                            {{ Form::hidden('country', COUNTRY, ['id' => 'country']) }}
                            {{ Form::label('state', trans('front_messages.global.state') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            <!-- <div id="state_div">

                                {{ Form::select('state', ['' => trans("front_messages.$modelName.please_select_state")] + $stateList, $old_state, ['class' => 'form-select field_class', 'id' => 'state', 'onchange' => 'getCity(this.value,"city","city_div","surveyForm", "", "", "form-select")']) }}
                            </div> -->
                            <div id="state_div"><select class="form-control form-select" id="state"
                                    onchange='getCity(this.value,"city","city_div","surveyForm", "", "", "form-select")'
                                    name="state" data-fv-field="state">
                                    <option value="" selected="selected">Please Select State*</option>
                                    <option value="4023">Andaman and Nicobar Islands</option>
                                    <option value="4017">Andhra Pradesh</option>
                                    <option value="4024">Arunachal Pradesh</option>
                                    <option value="4027">Assam</option>
                                    <option value="4037">Bihar</option>
                                    <option value="4031">Chandigarh</option>
                                    <option value="4040">Chhattisgarh</option>
                                    <option value="4033">Dadra and Nagar Haveli and Daman and Diu</option>
                                    <option value="4021">Delhi</option>
                                    <option value="4009">Goa</option>
                                    <option value="4030">Gujarat</option>
                                    <option value="4007">Haryana</option>
                                    <option value="4020">Himachal Pradesh</option>
                                    <option value="4029">Jammu and Kashmir</option>
                                    <option value="4025">Jharkhand</option>
                                    <option value="4026">Karnataka</option>
                                    <option value="4028">Kerala</option>
                                    <option value="4852">Ladakh</option>
                                    <option value="4019">Lakshadweep</option>
                                    <option value="4039">Madhya Pradesh</option>
                                    <option value="4008">Maharashtra</option>
                                    <option value="4010">Manipur</option>
                                    <option value="4006">Meghalaya</option>
                                    <option value="4036">Mizoram</option>
                                    <option value="4018">Nagaland</option>
                                    <option value="4013">Odisha</option>
                                    <option value="4011">Puducherry</option>
                                    <option value="4015">Punjab</option>
                                    <option value="4014">Rajasthan</option>
                                    <option value="4034">Sikkim</option>
                                    <option value="4035">Tamil Nadu</option>
                                    <option value="4012">Telangana</option>
                                    <option value="4038">Tripura</option>
                                    <option value="4022">Uttar Pradesh</option>
                                    <option value="4016">Uttarakhand</option>
                                    <option value="4853">West Bengal</option>
                                </select>

                            </div>
                            <span class="error help-inline state contact_state_error">
                                <?php echo $errors->first('state'); ?>
                            </span>
                        </div>
                        <div class="form_column">
                            {{ Form::label('city', trans('front_messages.global.city') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                            <div id="city_div">

                                {{ Form::select('city', ['' => trans("front_messages.$modelName.please_select_city")] + $cityList, null, ['class' => 'form-select show-tick field_class', 'id' => 'city', 'data-live-search' => 'true']) }}
                            </div>
                            <span class="error help-inline city contact_city_error">
                                <?php echo $errors->first('city'); ?>
                            </span>
                        </div>
                    </div>
                    <div class="pt-1 row">
                        <div class="col">
                            <!-- Secure Information Section -->
                            <div class="text-center form_desc" style="
    margin-top: -24px; margin-bottom: -16px;
">
                                <div class="mt-3 text-center bg-gradient d-inline-block rounded p-2"
                                    style="background: linear-gradient(45deg, #6ab7ff, #007bff);">
                                    <span class="fs-12 fw-bold px-3">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                            viewBox="0 0 448 512" class="lock-icon" height="1em" width="1em"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                                            </path>
                                        </svg>
                                        Your information is safe and protected with us.
                                    </span>
                                </div>
                            </div>

                            <!-- Connect with Experts Section -->
                            

                                                        <!-- Authorization Statement -->
                            <p class="fs-11 text-center mt-3" style="padding: 0 15px;">
                            I authorize Collegesathi to contact me via Phone, Email, WhatsApp or SMS. This will take precedence over any DND or NDNC requests. 
                                <a href="http://localhost/mukul/pages/privacy-policy" target="_blank" style="color: #007bff;">Privacy Policy</a>,
                                <a href="http://localhost/mukul/pages/term-and-conditions/" target="_blank" style="color: #007bff;">Terms of Use</a>
                            </p>
                        </div>
                    </div>

                    <button type="submit" id="submit1"
                        class="btn btn-primary submit_btn stp" style="
    margin-top: 14px;
        width: 153px;
">{{ trans('front_messages.global.submit') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
{{ Form::close() }}


@section('javascript')
{{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
{{ HTML::script(WEBSITE_JS_URL . 'surveyValidation.js') }}
{{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
<script>
    // grecaptcha.ready(function () {
    //     grecaptcha.execute(reCAPTCHASiteKey).then(function (token) {
    //         document.getElementById('g-recaptcha-response-survey').value = token;
    //     });
    // });

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
    $(document).ready(function () {
        var dateOfBirth = 'dob';
        var calDateFormat = '{{ JS_DATE_FORMAT }}';
        showDateInPast(dateOfBirth, calDateFormat);



        $(document).on('blur', '.contactno', function () {
            // alert($(this).val());

            SendOTP('{{ $mobileTextClass }}');
        });
    });
</script>
@endsection
@stop

<style>
    .logo-center {
    text-align: center;
    /* margin-top: 20px; */
}
    .otpInputContainer {
        position: relative;
        display: flex;
        flex-direction: column;
    }



    .otpActionBtn input {
        flex: 1;
        /* Adjust button styles as needed */
    }
</style>

<style>
      .contact_details_box button.stp{
        margin-left: 142px;
        }
  
    /* .swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .swiper-wrapper {
        display: flex;
        transition: transform 0.3s ease-in-out;
    }

    .swiper-slide {
        flex-shrink: 0;
        width: auto;
    } */
    .swiper-slide {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .grid-item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h3.chhh {
        font-family: 'Poppins', sans-serif;
        /* Use a modern font */
        font-size: 28px;
        /* Make the text larger */
        color: #333;
        /* Darker color for good contrast */
        text-align: center;
        /* Keep it centered */
        line-height: 1.4;
        /* Add line height for better readability */
        letter-spacing: 1px;
        /* Space out the letters slightly */
        background: black;
        /* Gradient text */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        /* Make the gradient apply only to the text */
        font-weight: 600;
        /* Make it semi-bold for a strong look */
        margin-bottom: 20px;
        /* Add some spacing below the heading */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        /* Subtle shadow to give depth */
    }

    .text-center {
    text-align: center;
}

.fs-11 {
    font-size: 11px;
}

.fs-12 {
    font-size: 12px;
}

.fw-bold {
    font-weight: bold;
}

.shadow-sm {
    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
}

.bg-gradient {
    background: linear-gradient(45deg, #6ab7ff, #007bff);
}

.rounded-circle {
    border-radius: 50%;
}

a {
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
.fas.fa-handshake {
    font-size: 18px; /* Adjust the size as per your need */
    color: #EC1C24;  /* Change the color if you want */
}
</style>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1, // Or the number of grids you want visible at a time
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
    });



</script>