@extends('admin.layouts.login_layout')

@section('content')

	<div class="msg"><b>{{ trans("messages.global.forgot_password") }}</b></div>
	 <div class="msg">
        {{ trans("messages.global.enter_your_email_address_We_send_you_an_email") }}

                    </div>


		{{ Form::open(['role' => 'form','route' => 'Admin.send_password']) }}

			<div class="input-group">
				<span class="input-group-addon">
						<i class="material-icons">person</i>
				</span>
				<div class="form-line">
					{{ Form::text('email', null, ['placeholder' => 'Email *', 'style'=>'width:100%','class'=>'form-control  required']) }}
				</div>
				<label class="error" for="email"><?php echo $errors->first('email'); ?></label>
			</div>


			<button class="btn btn-block bg-pink waves-effect" type="submit">{{ trans("messages.global.send_reset_password_link") }}</button>
			<div class="row m-t-20 m-b--5 align-center">
                      <a href="{{ route('login')}}" >{{ trans("messages.global.sign_in") }}!</a>
			</div>
			<div class="row m-t-15 m-b--20">
				<div class="col-xs-6">


				</div>
				<div class="col-xs-6 align-right">

				</div>
			</div>

		{{ Form::close() }}







@stop
