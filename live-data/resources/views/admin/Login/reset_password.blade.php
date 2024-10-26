@extends('admin.layouts.login_layout')

@section('content')


	 <div class="msg"><b>{{ trans("messages.global.reset_password") }}?<b></div>


		{{ Form::open(['role' => 'form','route' => 'Admin.save_password']) }}
			{{ Form::hidden('validate_string',$validate_string, []) }}


			<div class="input-group">
				<span class="input-group-addon">
						<i class="material-icons">person</i>
				</span>
				<div class="form-line">
					{{ Form::password('new_password',  ['placeholder' => 'New Password *', 'class' => 'form-control resetPassword required']) }}
				</div>
				<label class="error" for="new_password"><?php echo $errors->first('new_password'); ?></label>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
						<i class="material-icons">person</i>
				</span>
				<div class="form-line">
					{{ Form::password('new_password_confirmation', ['placeholder' => 'Confirm Password *', 'class' => 'form-control resetPassword required']) }}
				</div>
				<label class="error" for="new_password_confirmation"><?php echo $errors->first('new_password_confirmation'); ?></label>
			</div>


			<button class="btn btn-block bg-pink waves-effect" type="submit">{{ trans("messages.global.reset_password") }}</button>
			<div class="row m-t-20 m-b--5 align-center">
				 <a href="{{ route('login')}}" >{{ trans("messages.global.sign_in") }}!</a>
			</div>
	{{ Form::close() }}
</div>

@stop

