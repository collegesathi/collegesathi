@extends('layouts.login')
@section('content')
@section('title', trans('front_messages.global.login'))
@php
if(!isset($_COOKIE['remember_user'])) {
$rememberUserData = "";
}else{
$value = $_COOKIE['remember_user'];
$rememberUserData = json_decode($value);
}
$remember_user_cookie = (isset($rememberUserData->user_remember) && !empty($rememberUserData->user_remember) ? 'checked':'');
$email_cookie = isset($rememberUserData->user_email) && !empty($rememberUserData->user_email) ? $rememberUserData->user_email:'';
@endphp
<div class="login-register">
   <div class="container">
      <div class="form-box">
         <h1>{{ trans('front_messages.global.login') }}</h1>
         <p>{{ trans('front_messages.global.please_enter_your_details') }}</p>
         <a href="{{ route('socialsignup',['google']) }}" class="google-login"><img src="{{ WEBSITE_IMG_URL }}google.svg" alt="{{ trans('front_messages.global.login_with_google') }}">
            {{ trans('front_messages.global.login_with_google') }}</a>
         <div class="login-divider"><span>or Login with Email</span></div>
         {{ Form::open(['role' => 'form', 'files' => true, 'id' => 'loginForm', 'class' => 'access_list_form']) }}
         {{ csrf_field() }}
         {{ Form::hidden('return_url', isset($redirectUrl) && !empty($redirectUrl) ? $redirectUrl : '') }}
         <div class="form_col_12">
            {{ Form::text('email', isset($email_cookie) ? $email_cookie : '', ['id' => 'formGroupExampleInput', 'class' => 'form-control userLoginEmail', 'placeholder' => trans('front_messages.global.email')]) }}
            <span class="error  help-inline customer_login_email_error" id="email_error_div">
               {{ $errors->first('email') }}
            </span>
         </div>
         <div class="form_col_12">
            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control pwd', 'placeholder' => trans('front_messages.global.password')]) }}
            <span class="error help-inline customer_login_password_error" id="password_error_div">
               {{ $errors->first('password') }}
            </span>
         </div>
         <div class="d-flex justify-content-between">
            <div class="form-check">
               <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember-me" {{$remember_user_cookie}}>
               <label class="form-check-label" for="remember-me">
                  Remember me
               </label>
            </div>
            <a href="{{ route('User.forgotPassword') }}" class="forgot-password">{{ trans('front_messages.global.forgot_password') }}</a>
         </div>
         <button type="submit" class="btn btn-primary">{{ trans('front_messages.global.login') }}</button>
         {{ Form::close() }}
         <div class="bottom-links">
            New to OnlineVidhya? <a href="{{route('User.signup')}}">{{ trans('front_messages.global.signup') }}</a>
         </div>
      </div>
   </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
   var user_login_url = "{{ route('User.login') }}";
</script>
{{ Html::script(WEBSITE_JS_URL . 'login_signup.js') }}
@stop