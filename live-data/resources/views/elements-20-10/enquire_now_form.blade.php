@php
    $currentRouteName = Route::currentRouteName();
@endphp

<div class="enquire_now_modal_box">
    <div class="bg-white details_box_main">
        {{ Form::open(['role' => 'form', 'route' => 'EnquireNow.enquireNow', 'id' => 'enquireNowForm', 'class' => 'access_list_form', 'files' => true]) }}

        @if($currentRouteName == 'University.listing' || $currentRouteName == 'University.frontIndex' || $currentRouteName == 'University.universityCourseDetail' || $currentRouteName == 'University.universityCourseSpecificationDetail')
            {{ Form::hidden('current_route', $currentRouteName, ['class' => 'form-control field_class']) }}
        @endif

        <div class="access_list_box pb-30">
            <div class="form-check icon_input ">
                {{ Form::radio('gender', MALE, MALE, ['id' => 'EnquiryMale']) }}
                <label for="EnquiryMale" class="input_icon_man">
                    <img class="icon_imgorange" src="{{ WEBSITE_IMG_URL }}man.svg" alt="">
                    <img class="icon_imgwhite" src="{{ WEBSITE_IMG_URL }}man_white.svg" alt="">
                    <span>{{ trans('front_messages.global.male') }}</span>
                </label>
            </div>
            <div class="form-check icon_input ">
                {{ Form::radio('gender', FEMALE, null, ['id' => 'EnquiryFemale']) }}
                <label for="EnquiryFemale" class="input_icon_woman">
                    <img class="icon_imgorange" src="{{ WEBSITE_IMG_URL }}woman.svg" alt="">
                    <img class="icon_imgwhite" src="{{ WEBSITE_IMG_URL }}woman_white.svg" alt="">
                    <span>{{ trans('front_messages.global.female') }}</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form_col_12">
                    {{ Form::label('full_name', trans('front_messages.User.full_name') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                    {{ Form::text('full_name', null, ['class' => 'form-control field_class']) }}
                    <span class="error help-inline full_name contact_us_full_name_error_div">
                        <?php echo $errors->first('full_name'); ?>
                    </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form_column form_col_12 w-100">
                    {{ Form::label('dob', trans('front_messages.global.dob') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                    {{ Form::text('dob', null, ['class' => 'form-control field_class', 'id' => 'date_of_birth']) }}
                    <span class="error help-inline dob contact_us_dob_error_div"></span>
                </div>
            </div>

        </div>

        <div class="access_list_box form_col_12 mobile_input d-block">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form_column countrynumber number_select w-100">
                        {{ Form::label('phone', trans('front_messages.global.phone') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('phone_number', null, [
    'class' => ' w-100 form-control contactnoEnquiry ' . $mobileTextClassEnquiry,
    'id' => 'phoneNumberCustomerEnquiry',
    'onpaste' => 'return false;',
    'oncopy' => 'return false;',
    'maxlength' => '10',
    'placeholder' => 'Mobile Number*',
    'onchange' =>"return SendOTP('mobile02')",
    'onkeypress' => 'return isNum(event)',
    'style' => 'border-radius: 0;',
]) }}

                        {{ Form::hidden('otp_veryfy', '', ['id' => 'enquiry_otp_veryfy']) }}
                        {{ Form::hidden('phone_number_with_dial_code', '', ['id' => 'phoneCustomerEnquiry', 'class' => 'userphonecode']) }}
                        {{ Form::hidden('dial_code', '', ['id' => 'stu_dial_codeCustomer_enquiry', 'class' => 'customer_dial_code']) }}
                        <span
                            class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_enquiry_error not_valid_mobile_customer_enquiry  contact_us_phone_number_error"></span>
                            <span class="fw-bold fs-11 position-absolute end-0 me-2 px-3 rounded-bottom text-success z-index-1" style="bottom: -24px;background-color:#d4fee8"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" font-size="12" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"></path></svg>Privacy assured<!-- --> </span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="phone" class="form-label label_class">OTP<span class="error">*</span></label>
                    <div class="form_col_12 otpAction">
                        <input type="text" id="txtotp<?php echo $mobileTextClassEnquiry; ?>" maxlength="6"
                            class="form-control txtotp txtotp<?php echo $mobileTextClassEnquiry; ?>" placeholder="OTP"
                            aria-required="true" style="border-radius: 0;">

                        <div class="otpActionBtn">
                            <input id="enquiryBtnVerify<?php echo $mobileTextClassEnquiry; ?>"
                                class="btnVerify form-control"
                                onclick="VerifyOTP('<?php echo $mobileTextClassEnquiry; ?>');" type="button"
                                value="Verify">
                            <input id="enquiryBtnResend<?php echo $mobileTextClassEnquiry; ?>"
                                class="btnResend form-control"
                                onclick="ResendCode('<?php echo $mobileTextClassEnquiry; ?>');" type="button"
                                value="Resend">
                            <input id="enquiryBtnVerifySuccess<?php echo $mobileTextClassEnquiry; ?>"
                                class="btnVerifySuccess form-control" type="button" value="Verified"
                                style="display:none;">
                        </div>
                        <span class="error help-inline  otp_error_div"></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form_col_12 pb-0">
                        {{ Form::label('contact_email_us', trans('front_messages.User.contact_email_us') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                        {{ Form::text('email', null, ['class' => 'form-control field_class']) }}
                        <span class="error help-inline email contact_email_error">
                            <?php echo $errors->first('email'); ?>
                        </span>
                    </div>
                </div>
            </div>

        </div>




        <div class="access_list_box form_col_12">
            <div class="form_column">
                <input id="country" name="country" type="hidden" value="101">
                <label for="state" class="form-label label_class">State<span class="error"> *</span></label>
                <div id="enquiry_state_div"><select class="form-control form-select" id="state"
                        onchange="getCity(this.value,'city','enquiry_city_div','enquireNowForm', '','','form-select')"
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
                <span class="error help-inline state contact_state_error help-block"><small class="help-block"
                        data-fv-validator="notEmpty" data-fv-for="state" data-fv-result="NOT_VALIDATED"
                        style="display: none;">Please select state.</small></span>
            </div>
            <div class="form_column">
                {{ Form::label('city', trans('front_messages.global.city') . '<span class="error"> *</span>', ['class' => 'form-label label_class'], false) }}
                <div id="enquiry_city_div">

                    {{ Form::select('city', ['' => trans('front_messages.global.please_select_city')] + $cityList, null, ['class' => 'form-select show-tick field_class', 'id' => 'enquiry_city', 'data-live-search' => 'true']) }}
                </div>
                <span class="error help-inline city contact_city_error"></span>
            </div>
        </div>



        <div class="row">
            <div class="form-group col-sm-6 g-recaptcha-box">
                <input type="hidden" id="g-recaptcha-response-survey" name="g-recaptcha-response">
                <span class="error  help-inline g-recaptcha-response_error g-recaptcha-response"
                    id="g-recaptcha-response_error_div">
                    <?php echo $errors->first('g-recaptcha-response'); ?>
                </span>
            </div>
        </div>

        <div class="contact_btn">
            <button type="submit" class="btn btn-primary"
                id="enquire_now_btn">{{ trans('front_messages.global.submit') }}</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
<!-- OTP IN HIDDEN -->
<input id="OTPCode" name="OTPCode" type="hidden" value="" /> 
<!-- OTP IN HIDDEN -->