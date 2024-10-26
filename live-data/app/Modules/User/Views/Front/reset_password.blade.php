@extends('layouts.login')
@section('content')
@section('title', trans('front_messages.global.reset_password'))
<div class="login-register">
   <div class="container">
      <div class="form-box">
         <h1>{{ trans('front_messages.global.reset_password') }}</h1>
         <p></p>
         {{ Form::open(['role' => 'form', 'files' => true, 'id' => 'resetPasswordForm', 'class'=>'access_list_form']) }}
         {{ Form::hidden('validate_string', isset($validateStr) ? $validateStr : '', []) }}
         {{ csrf_field() }}
         <form class="access_list_form">
         <div class="form_col_12">
            {{ Form::password('password', ['id' => 'formGroupExampleInput', 'class' => 'userPassword form-control pwd onlyRePass', 'placeholder' => trans('front_messages.User.new_password')]) }}
            <span class="error help-inline password user_signup_password_error">
            {{ $errors->first('password') }}
            </span>
         </div>
         <div class="form_col_12">
            {{ Form::password('confirm_password', ['id' => 'confirm_password', 'class' => 'userPassword form-control pwd onlyRePass', 'placeholder' => trans('front_messages.User.confirm_password')]) }}
            <span class="error  help-inline confirm_password user_signup_confirm_password_error">
            {{ $errors->first('confirm_password') }}
            </span>
         </div>
         <button  type="submit"  class="btn btn-primary">{{ trans('front_messages.global.submit') }}</button>
         {{ Form::close() }}
      </div>
   </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
   var reset_password_url = "{{ route('User.resetPassword', [$validateStr]) }}";
</script>
{{ Html::script(WEBSITE_JS_URL . 'login_signup.js') }}
@stop