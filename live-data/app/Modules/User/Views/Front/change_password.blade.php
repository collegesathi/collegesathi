@extends('layouts.default')
@section('content')
<div class="login-register change-password">
   <div class="container">
      <div class="form-box">
         <h1>{{ trans('front_messages.global.change_password') }}</h1>
         <p></p>
         {{ Form::open(['role' => 'form','route' =>"User.change_password",'id'=>'changePasswordForm', 'class'=>'access_list_form', 'files' => true]) }}
         {{ csrf_field() }}
         <div class="form_col_12">
            {{ Form::password('old_password', ['class' => 'form-control','placeholder' => trans("front_messages.$modelName.enter_old_password")]) }}
            <span class="error help-inline old_password user_edit_old_password_error">
               {{ $errors->first('old_password') }}
            </span>
         </div>
         <div class="form_col_12">
            {{ Form::password('new_password',  ['class' => 'form-control','placeholder' => trans("front_messages.$modelName.enter_new_password")]) }}
            <span class="error help-inline new_password user_edit_new_password_error">
               {{ $errors->first('new_password') }}
            </span> 
         </div>
         <div class="form_col_12">
            {{ Form::password('confirm_password', ['class' => 'form-control','placeholder' => trans("front_messages.$modelName.enter_confirm_password")]) }}
            <span class="error help-inline confirm_password user_edit_confirm_password_error">
               {{ $errors->first('confirm_password') }}
            </span>
         </div>
         <button type="submit" class="btn btn-primary">{{ trans('front_messages.global.save_change') }}</button>
         {{ Form::close() }}
      </div>
   </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
   var change_password_url = '{{ route("User.change_password")}}';
   var csrf_token = '{{ csrf_token()}}';
</script>
{{ Html::script(WEBSITE_JS_URL . 'login_signup.js') }}
@stop