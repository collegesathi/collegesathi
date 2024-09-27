@extends('layouts.default')
@section('content')



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
                    <h3>Just one more step! <br> Enter your details to view your personalized recommendations</h3>
                    <div class="swiper-container">
                        <div class="swiper-wrapper"
                            style="width: 762px; transition-duration: 5000ms; transform: translate3d(-304.667px, 0px, 0px);">
                            <div class="swiper-slide" style="width: 132.333px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide swiper-slide-prev" style="width: 132.333px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide swiper-slide-active" style="width: 132.333px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide swiper-slide-next" style="width: 132.333px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-top: 20px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-top: 20px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-top: 20px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-top: 20px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg" alt=""></span>
                                </div>
                            </div>
                            <div class="swiper-slide" style="width: 132.333px; margin-top: 20px; margin-right: 20px;">
                                <div class="shadow-1 position-relative px-2 py-2 card"><span
                                        style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                            style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                                alt="" aria-hidden="true"
                                                src="{{ WEBSITE_IMG_URL }}Online-Education-logo3.jpg" alt=""
                                                style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                            alt="" src="{{ WEBSITE_IMG_URL }}Online-Education-logo3.jpg" alt=""
                                            decoding="async" data-nimg="intrinsic" class="rounded w-100"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                            srcset="{{ WEBSITE_IMG_URL }}Online-Education-logo3.jpg" alt=""></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center"><span
                            style="box-sizing: border-box; display: inline-block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: relative; max-width: 100%;"><span
                                style="box-sizing: border-box; display: block; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; max-width: 100%;"><img
                                    alt="" aria-hidden="true"
                                    src="{{ WEBSITE_IMG_URL }}global.gif"
                                    style="display: block; max-width: 100%; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px;"></span><img
                                alt="global" src="{{ WEBSITE_IMG_URL }}global.gif"
                                decoding="async" data-nimg="intrinsic"
                                style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;"
                                srcset="{{ WEBSITE_IMG_URL }}global.gif"></span>
                    </div>
                    <div class="sign_up_access">
                        <h3> {{ trans('front_messages.global.signup_now') }}<br>
                            {{ trans('front_messages.global.access_list') }}</h3>
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
                    <button type="submit" id="submit1"
                        class="btn btn-primary submit_btn">{{ trans('front_messages.global.submit') }}</button>
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
    .swiper-container {
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
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,        // Number of visible slides at once
            spaceBetween: 20,        // Space between slides
            loop: true,              // Enable looping
            speed: 500,              // Transition speed
            autoplay: {
                delay: 3000,           // Autoplay delay
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
            },
        });
    });



</script>