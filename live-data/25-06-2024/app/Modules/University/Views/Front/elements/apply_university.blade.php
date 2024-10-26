<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <!-- OTP IN HIDDEN -->
    <!-- OTP IN HIDDEN -->
    <div class="modal-dialog modal-dialog-centered modal-lg modal_applynow">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ trans('front_messages.global.download_prospectus') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="apply_now_modal_box">
                    <div class="bg-white details_box_main">
                        {{ Form::open(['role' => 'form', 'id' => 'applyUniversityForm', 'class' => 'access_list_form', 'files' => true]) }}
                        {{ Form::hidden('uni_id', isset($result->id) && !empty($result->id) ? $result->id : '', ['class' => 'form-control', 'id' => 'uni_id']) }}
                        {{ Form::hidden('slug', isset($result->slug) && !empty($result->slug) ? $result->slug : '', ['class' => 'form-control', 'id' => 'slug']) }}
                        
                        @php

                        if (Auth::check()) {
                        $first_name = Auth::user()->first_name;
                        $last_name = Auth::user()->last_name;
                        $full_name = $first_name .' '. $last_name;
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
                        <span class="error help-inline gender  help-block">
                            <?php echo $errors->first('gender'); ?>
                        </span>
                        <div class="form_col_12">
                            {{ Form::text('full_name', $full_name ?? null, ['class' => 'form-control field_class','placeholder'=>'Full Name*']) }}
                            <span class="error help-inline full_name contact_us_full_name_error_div">
                                <?php echo $errors->first('full_name'); ?>
                            </span>
                        </div>
                        <div class="form_col_12">
                            {{ Form::text('dob', null, ['class' => 'form-control field_class', 'id' => 'dob', 'placeholder'=>'Date of birth*']) }}
                            <span class="error help-inline dob contact_us_dob_error_div">
                                <?php echo $errors->first('dob'); ?>
                            </span>
                        </div>
                        <div class="form_col_12 mobile_input">
                            <div class="number_select contact_number">
                                <!-- <input type="text" name="phone_number" class="form-control contactno <?php echo $mobileTextClass; ?>" id="phoneNumber<?php echo $mobileTextClass; ?>" onchange="SendOTP('<?php echo $mobileTextClass; ?>')" onpaste="return false;" oncopy="return false;" maxlength="10" placeholder="Mobile Number*" onkeypress="return isNum(event)" style="border-radius: 0;" />  -->
                                {{ Form::text('phone_number', null, [
                                'class' => 'form-control contactno ' . $mobileTextClass,
                                'id' => 'phoneNumber',
                                'onpaste' => 'return false;',
                                'oncopy' => 'return false;',
                                'maxlength' => '10',
                                'placeholder' => 'Mobile Number*',
                                'onkeypress' => 'return isNum(event)',
                                'style' => 'border-radius: 0;',
                            ]) }}

                                <!-- {{ Form::text('phone_number', isset($phone) ? $phone : '', ['id' => 'phoneNumber', 'class' => 'form-control']) }} -->
                                {{ Form::hidden('phone', isset($phone) ? $phone : '', ['id' => 'phone', 'class' => 'userphonecode']) }}
                                {{ Form::hidden('dial_code', isset($dile_code) ? $dile_code : '', ['id' => 'stu_dial_code', 'class' => 'dial_code']) }}
                                {{ Form::hidden('otp_veryfy','',['id'=>'otp_veryfy'] )}}
                                <span class="error help-inline phone_number not_valid_mobile">
                                    {{ $errors->first('phone_number') }}
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
                        <div class="form_col_12">
                            {{ Form::text('email', $email, ['class' => 'form-control', 'placeholder' => trans('messages.global.email').'*']) }}
                            <span class="error help-inline email recipient_email_error">
                                <?php echo $errors->first('email'); ?>
                            </span>
                        </div>
                        <div class="form_col_12">
                            @php $courseType = CustomHelper::getConfigValue('COURSE_TYPE'); @endphp
                            {{ Form::select('course_type', ['' => trans("front_messages.$modelName.please_select_course").'*'] + $courseType, null, ['class' => 'form-select show-tick', 'id' => 'course_type', 'data-live-search' => 'true']) }}
                            <span class="error help-inline course_type course_type_error">
                                <?php echo $errors->first('course_type'); ?>
                            </span>
                        </div>
                        <div class="access_list_box form_col_12">
                            <div class="form_column">
                                {{ Form::hidden('country', COUNTRY, ['id' => 'country']) }}
                                <div id="state_div">
                                    {{ Form::select('state', ['' => trans("front_messages.global.please_select_state").'*'] + $stateList, $old_state, ['class' => 'form-select', 'id' => 'state', 'onchange' => 'getCity(this.value,"city","city_div","applyUniversityForm", "", "", "form-select")']) }}

                                </div>
                                <span class="error help-inline state state_error help-block">
                                    <?php echo $errors->first('state'); ?>
                                </span>
                            </div>
                            <div class="form_column">
                                <div id="city_div">
                                    {{ Form::select('city', ['' => trans("front_messages.global.please_select_city").'*'] + $cityList, null, ['class' => 'form-select show-tick', 'id' => 'city', 'data-live-search' => 'true']) }}
                                </div>
                                <span class="error help-inline city error_reference_city city_error">
                                    <?php echo $errors->first('city'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="contact_btn">
                            <button class="btn btn-primary">{{ trans('front_messages.global.submit') }}</button>
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
{{ HTML::style('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
{{ HTML::script('plugins/momentjs/moment.js') }}
{{ HTML::script('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}