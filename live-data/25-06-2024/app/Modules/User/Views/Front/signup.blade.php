@extends('layouts.login')
@section('content')
    <div class="login-register">
        <div class="container">
            <div class="form-box">
                <h1>{{ trans('front_messages.global.sign_up') }}</h1>
                <p>{{ trans('front_messages.global.create_a_new_onlinevidhya_account') }}</p>
                <a href="{{ route('socialsignup',['google']) }}" class="google-login"><img src="{{ WEBSITE_IMG_URL }}google.svg"
                        alt="{{ trans('front_messages.global.login_with_google') }}">
                    {{ trans('front_messages.global.login_with_google') }}</a>
                <div class="login-divider"><span>{{ trans('front_messages.global.or_sign_up_with_email') }}</span></div>
                {{ Form::open(['role' => 'form', 'class' => 'access_list_form', 'route' => ['User.user_signup'], 'id' => 'customerSignUpForm', 'files' => true]) }}
                <div class="form_col_12">
                    {{ Form::text('first_name', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_first_name")]) }}
                    <span class="error help-inline user_signup_first_name_error first_name">
                        {{ $errors->first('first_name') }}
                    </span>
                </div> 

                <div class="form_col_12">
                    {{ Form::text('last_name', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_last_name")]) }}
                    <span class="error help-inline user_signup_last_name_error last_name">
                        {{ $errors->first('last_name') }}
                    </span>
                </div>

                <div class="form_col_12">
                    {{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_email"), 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}"]) }}
                    <span class="error help-inline email user_signup_email_error">
                        {{ $errors->first('email') }}
                    </span>
                </div>
                <div class="form_col_12 mobile_input">
                    <div class="number_select contact_number">
                        {{ Form::text('phone_number', null, ['id' => 'phoneNumberCustomer', 'class' => 'form-control', 'placeholder' => trans('front_messages.User.mobile_number'), 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}"]) }}
                        {{ Form::hidden('phone', '', ['id' => 'phoneCustomer', 'class' => 'userphonecode']) }}
                        {{ Form::hidden('dial_code', '', ['id' => 'stu_dial_codeCustomer', 'class' => 'customer_dial_code']) }}
                        <span
                            class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_error not_valid_mobile_customer  user_signup_phone_number_error">
                            {{ $errors->first('phone') }}
                        </span>
                    </div>
                </div>
                <div class="form_col_12">
                    {{ Form::password('password', ['class' => 'userPassword form-control', 'placeholder' => trans("front_messages.$modelName.atleast_password")]) }}
                    <span class="error help-inline user_signup_password_error password">
                        {{ $errors->first('password') }}
                    </span>
                </div>
                <div class="form_col_12">
                    {{ Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.atleast_password")]) }}
                    <span class="error  help-inline user_signup_confirm_password_error confirm_password">
                        {{ $errors->first('confirm_password') }}
                    </span>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        {{ Form::checkbox('terms', null, '', ['class' => 'form-check-input']) }}
                        <label class="form-check-label" for="terms">
                            {{ trans('front_messages.global.i_agree_to_the') }}
                        </label>
                        <a href="{{ route('Page.cmsPages', 'terms-conditions') }}"
                            class="terms-link" target="_blank">{{ trans('front_messages.global.terms_conditions') }}</a>
                        <br />
                        <span class="error help-inline terms_error">
                            {{ $errors->first('terms') }}
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ trans('front_messages.global.register_now') }}</button>
                {{ Form::close() }}
                <div class="bottom-links">
                    {{ trans('front_messages.global.Already_have_an_account') }} <a
                        href="{{ route('User.login') }}">{{ trans('front_messages.global.login') }}</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    {{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
    {{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
    <script type="text/javascript">
        var customer_signup_url = "{{ route('User.user_signup') }}";
        phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer',
            'not_valid_mobile_customer');
    </script>
    {{ Html::script(WEBSITE_JS_URL . 'login_signup.js') }}
@stop
