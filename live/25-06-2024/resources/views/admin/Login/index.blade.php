@extends('admin.layouts.login_layout')

@section('content')
<?php

if(!isset($_COOKIE['remember_admin'])) {
  $rememberdata = "";
}else{
   $value = $_COOKIE['remember_admin'];
   $rememberdata = json_decode($value);
}

$email_cookie 	 = Cookie::get('email');
$remember_cookie = Cookie::get('remember');
?>

        <form method="post" action="{{ route('login') }}">
			<div class="msg"><b>{{ trans("messages.global.sign_in") }}</b></div>
			<div class="input-group">
				<span class="input-group-addon">
						<i class="material-icons">person</i>
				</span>
				<div class="form-line">
					{{ Form::text('email', (isset($rememberdata->email) && !empty($rememberdata->email) ? $rememberdata->email:''), ['placeholder' => 'Email *', 'class' => 'form-control ',"autofocus"])}}
				</div>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				<i class="material-icons">lock</i>
				</span>
				<div class="form-line">
					{{Form::password('password', ['placeholder' => 'Password *', 'class' => 'form-control'])}}
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8 p-t-5">
					<input type="checkbox" class="filled-in chk-col-pink" name="remember" id="rememberme" <?php echo (isset($rememberdata->remember_me) && !empty($rememberdata->remember_me) ? 'checked':'');	 ?>>

					<label for="rememberme">{{ trans("messages.global.remember_me") }}</label>
				</div>
				<div class="col-xs-4">
					<button class="btn btn-block bg-pink waves-effect" type="submit">{{ trans("messages.global.sign_in_cap") }}</button>
				</div>
			</div>
            @csrf
		</form>
			<div class="row m-t-15 m-b--20">
				<div class="col-xs-6">


				</div>
				<div class="col-xs-6 align-right">
					<a href="{{ route('Admin.forget_password')}}" >{{ trans("messages.global.forgot_password") }}</a>
				</div>
			</div>


@stop

