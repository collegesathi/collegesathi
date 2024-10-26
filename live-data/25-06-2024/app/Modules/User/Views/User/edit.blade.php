@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('customer-edit') }}
@stop

@section('content')
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'intl-tel-input/intlTelInput.js') }}
@php

   $timezone_Data = '';
   if(!$errors->first('time_zone')){
     $timezone_Data = 	isset($userDetails->time_zone)?$userDetails->time_zone:'';
   }
   $address_data = '';
   if(!$errors->first('address_one')){
     $address_data = 	isset($userDetails->address_one)?$userDetails->address_one:'';
   }

@endphp
<div class="container-fluid" id="main-container">
   <div class="row clearfix" >
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="card">
            <div class="header">
               <h2> {{$heading}} </h2>
               <ul class="header-dropdown m-r--5 btn-right-top-margin">
                  <li>
                     <a href='{{ route("$customerModel.index")}}' >
                     <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                     </a>
                  </li>
               </ul>
            </div>
            <div class="body">
               <div class="mt-20">
                  {{ Form::model($userDetails,['role'=>'form', 'url'=>route("$customerModel.update",array($userDetails->id)), 'class'=>'mws-form', 'files'=>true]) }}
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{  Form::label('first_name', trans("messages.$modelName.first_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                              {{ Form::text('first_name',null, ['class' => 'form-control']) }}
                           </div>
                           <span class="error help-inline">
                           {{ $errors->first('first_name') }}
                           </span>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="form-group">
                           <div class="form-line">
                              {{  Form::label('last_name', trans("messages.$modelName.last_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                              {{ Form::text('last_name',null, ['class' => 'form-control']) }}
                           </div>
                           <span class="error help-inline">
                           {{ $errors->first('last_name') }}
                           </span>
                        </div>

                     </div>
                     <div class="col-sm-6 align-center">
                        <div class="form-group add-image">
                           <input name="image" id="profile_image" class="form-control image-input-file" type="file"/>
                           <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                              @php
                              $oldImage   =   Request::old('image');
                              $image      =   isset($oldImage) ? $oldImage : $userDetails->image;
                              @endphp
                              <div id="pImage">
                                 {!! CustomHelper::showUserImage(USER_PROFILE_IMAGE_ROOT_PATH, USER_PROFILE_IMAGE_URL,  $userDetails->image,  $userDetails->gender, ['alt' => $userDetails->full_name, 'height' =>'120', 'width' =>'120', 'zc' => 1 ]) !!}
                              </div>
                           </span>
                           <br/>
                           <div>
                              <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg')}}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
                              Upload Image
                              </a>
                              @if($image !=''  && File::exists(USER_PROFILE_IMAGE_ROOT_PATH.$image))
                              {{--<a href="javascript:void(0)" data-href='{{ route("$customerModel.removeImage",array($userDetails->id))}}' class="margin-top-0 btn bg-red btn-block btn-sm waves-effect remove-img confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_remove_image')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" title="<?php echo trans('messages.global.remove_image');  ?>">
                              <?php echo trans('messages.global.remove_image');  ?>
                              </a>--}}
                              @endif
                           </div>
                           <span class="error  help-inline image_error" id="image_error_div">
                           {{ $errors->first('image') }}
                           </span>
                        </div>
                     </div>
                  </div>
					<div class="row clearfix">

                        <div class="col-sm-6">
                            <div class="form-group">
                               <div class="form-line">
                                  {{  Form::label('email', trans("messages.$modelName.email").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                  {{ Form::text('email',null, ['class' => 'form-control']) }}
                               </div>
                               <span class="error help-inline">
                               {{ $errors->first('email') }}
                               </span>
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                               <div class="form-line">
                                  {{  Form::label('phone_number', trans("messages.$modelName.phone").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                  {{ Form::text('phone_number',isset($userDetails->phone) ? $userDetails->phone :'',array('id'=>'userMobile','class'=>'form-control')) }}
                                  {{ Form::hidden('phone',null,array('id'=>'userPhone','class'=>'userphonecode')) }}
                                  {{ Form::hidden('dial_code',isset($userDetails->dial_code) ? $userDetails->dial_code :'',array('id'=>'dial_code','class'=>'dial_code')) }}
                               </div>
                               <span class="error help-inline UserPhone_error">
                               {{ $errors->first('phone') }}
                               </span>
                            </div>
                        </div>


                        @php
                        /*
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('country', trans("messages.$modelName.country") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                       {{Form::select('country', ['' => trans("messages.$modelName.please_select_country")] + $countryList, null, ['class' => 'form-control show-tick', 'id' => 'country', 'data-live-search' => 'true'])}}

                                </div>
                                <span class="error help-inline">
                                    {{ $errors->first('country') }}
                                </span>
                            </div>
                        </div>





						<div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('state', trans("messages.$modelName.state") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                    <div id="state_div">
                                        {{ Form::select('state', ['' => trans("messages.$modelName.please_select_state")] + $stateList, null, ['class' => 'form-control show-tick', 'id' => 'state', 'data-live-search' => 'true']) }}

                                    </div>
                                </div>
                                <span class="error help-inline">
                                    {{ $errors->first('state') }}
                                </span>
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('city', trans("messages.$modelName.city") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                    <div id="city_div">
                                        {{ Form::select('city', ['' => trans("messages.$modelName.please_select_city")] + $cityList, null, ['class' => 'form-control show-tick', 'id' => 'city', 'data-live-search' => 'true']) }}

                                    </div>
                                </div>
                                <span class="error help-inline">
                                    {{ $errors->first('city') }}
                                </span>
                            </div>
                        </div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{  Form::label('address_one', trans("messages.$modelName.address_one").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}

                                    {{ Form::text('address_one',null, ['class' => 'form-control']) }}

                                </div>
                                <span class="error help-inline">
                                    {{ $errors->first('address_one') }}
                                </span>
                            </div>
                        </div>

                    </div>

				<div class="row clearfix">
				    <div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								{{  Form::label('dob', trans("messages.$modelName.dob").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
								{{ Form::text('dob', $dob, ['class' => 'form-control', 'id' => 'dob']) }}
							</div>
							<span class="error help-inline">
								{{ $errors->first('dob') }}
							</span>
						</div>
					</div>
				</div>

                */

                @endphp

</div>

                  <div class="row clearfix">
                     <div class="alert alert-warning">{{ trans("messages.global.password_blank_msg") }}  </div>
                  </div>
                  <div class="row clearfix">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{  Form::label('password', trans("messages.$modelName.password").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                              <span class='tooltipHelp' title="" data-html="true" data-toggle="tooltip"  data-original-title="{{ trans('messages.global.password_help_message') }}" style="cursor:pointer;">
                              <i class="fa fa-question-circle fa-1x"> </i>
                              </span>
                              {{ Form::password('password',['class'=>'userPassword form-control']) }}
                           </div>
                           <span class="error help-inline">
                           {{ $errors->first('password') }}
                           </span>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{  Form::label('confirm_password', trans("messages.$modelName.repassword").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                              {{ Form::password('confirm_password',['class'=>'form-control']) }}
                           </div>
                           <span class="error help-inline">
                           {{ $errors->first('confirm_password') }}
                           </span>
                        </div>
                     </div>
                  </div>
                  <div>
                     <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
                     <a href=""  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                  </div>
                  {{ Form::close() }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
	var getStateUrl 			= 	'{{ route("AdminAjax.getStates") }}';
   	var getCityUrl 				= 	'{{ route("AdminAjax.getCities") }}';
   	var country_id 				=   $("#country").val();

	$(document).ready(function(){
		showDob('#dob', '{{ DATE_OF_BIRTH_MIN_AGE }}', '{{ JS_DATE_FORMAT }}')
	});
</script>
<!-- for tooltip -->
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'intl-tel-input/intlTelInput.js') }}
{{ Html::script(WEBSITE_ADMIN_JS_URL.'user_add_edit.js') }}
{{ Html::script(WEBSITE_ADMIN_JS_URL.'get_state_city.js') }}

{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'daterange/moment.min.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'daterange/daterangepicker.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'daterange/custom_range.js') }}
{{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'daterange/daterangepicker.css') }}

@stop
