@extends('layouts.login')
@section('content')
@section('title', trans('front_messages.global.login'))
@php
$email_cookie 		= 	Cookie::get('email');
@endphp
<div class="login-register">
   <div class="container">
      <div class="form-box">
         <h1>{{ trans('front_messages.global.forgot_password') }}</h1>
         <p></p>
         {{ Form::open(['role' => 'form', 'files' => true, 'id' => 'forgotPasswordForm', 'class'=>'access_list_form']) }}
         {{ csrf_field() }}
         <form class="access_list_form">
         <div class="form_col_12">
            {{ Form::text('email', isset($email_cookie) ? $email_cookie : '', ['id' => 'formGroupExampleInput', 'class' => 'form-control userLoginEmail', 'placeholder' => trans('front_messages.global.email')]) }}
            <span class="error  help-inline user_account_email_error" id="email_error_div">
            {{ $errors->first('email') }}
            </span>
         </div>
         <button  type="submit"  class="btn btn-primary">{{ trans('front_messages.global.submit') }}</button>
         {{ Form::close() }}
         <div class="bottom-links">
            {{ trans('front_messages.global.back_to') }} <a href="{{ route('User.login') }}">{{ trans('front_messages.global.login') }}</a>
         </div>
      </div>
   </div>
</div>
@stop 
@section('javascript')
<script type="text/javascript">
   var user_forgot_password_url = "{{ route('User.forgotPassword') }}";
</script>
{{ Html::script(WEBSITE_JS_URL . 'login_signup.js') }} 
@stop