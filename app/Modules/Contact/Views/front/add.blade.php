@extends('layouts.default')
@section('content')
@php
$address = CustomHelper::getConfigValue('Site.address');
$contact_number = CustomHelper::getConfigValue('Site.get_in_touch_phone');
$contact_email = CustomHelper::getConfigValue('Site.get_in_touch_email');
$map = CustomHelper::getConfigValue('Site.map');
$courseType = CustomHelper::getConfigValue('COURSE_TYPE');
if (Auth::check()) {
$full_name = Auth::user()->full_name;
$email = Auth::user()->email;
$phone = Auth::user()->phone;
} else {
$full_name = '';
$email = '';
$phone = '';
}
@endphp
<section class="common_banner contactus_banner">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="inner_page_banner text-center text-md-start">
               <span>{{trans('front_messages.Contact.contact_us')}}</span>
               <h1 class="m-auto m-md-0">{{trans('front_messages.Contact.we_would_love_to')}}<br>{{trans('front_messages.Contact.hear_from_you')}} </h1>
            </div>
         </div>
         <div class="col-md-6">
            <div class="contact_banner_img">
               <figure>
                  <img src="{{ WEBSITE_IMG_URL }}contact_banner.svg" alt="{{trans('front_messages.Contact.contact_us')}}">
               </figure>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="contact_info_box ">
   <div class="container">
      <div class="contact_info_main">
         <div class="contact_info_contant" style="
    margin-right: inherit;
">
            <div class="card box_shadow">
               <figure>
                  <img src="{{ WEBSITE_IMG_URL }}phone-call-01.svg" alt="img">
               </figure>
               <div class="contact_details">
                  <h6>
                     <a href="tel:{{$contact_number}}">{{$contact_number}}</a>
                  </h6>
                  <p>Helpline</p>
               </div>
            </div>
         </div>
         <div class="contact_info_contant">
            <div class="card box_shadow">
               <figure>
                  <img src="{{ WEBSITE_IMG_URL }}email-01.svg" alt="img">
               </figure>
               <div class="contact_details">
                  <h6>
                     <a href="mailto:{{$contact_email}}">{{$contact_email}}</a>
                  </h6>
               </div>
            </div>
         </div>
      <!--  <div class="contact_info_contant">
            <div class="card box_shadow">
               <figure>
                  <img src="{{ WEBSITE_IMG_URL }}location-01.svg" alt="img">
               </figure>
               <div class="contact_details">
                  <p>
                     {{$address}}
                  </p>
               </div>
            </div>
         </div>-->
      </div>
      <div class="contact_info">
         <div class="contact_map access_column">
            <div class="bg-white box_shadow">
               <iframe src="{{$map}}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
         </div>
         <div class="contact_details_box access_column leave_message">
            <div class="bg-white details_box_main box_shadow"> 
               <h2>{{trans('front_messages.Contact.leave_a_message')}}</h2>
               {{ Form::open(['role' => 'form', 'route' => 'Contact.savedata', 'id' => 'contactUsForm', 'class' => 'access_list_form']) }}

               <div class="form_col_12">
                  {{ Form::text('full_name', $full_name, ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_full_name").'*']) }}
                  <span class="error help-inline full_name contact_us_full_name_error_div">
                     <?php echo $errors->first('full_name'); ?>
                  </span>
               </div>

               <div class="form_col_12 mobile_input">
                  <div class="number_select contact_number">
                     {{ Form::text('phone_number', null, ['id' => 'phoneNumberCustomer', 'class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.mobile_number").'*', 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}"]) }}
                     {{ Form::hidden('phone_number_with_dial_code', '', ['id' => 'phoneCustomer', 'class' => 'userphonecode']) }}
                     {{ Form::hidden('dial_code', '', ['id' => 'stu_dial_codeCustomer', 'class' => 'customer_dial_code']) }}
                     <span class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_error not_valid_mobile_customer  contact_us_phone_number_error">
                        {{ $errors->first('phone_number_with_dial_code') }}
                     </span>
                  </div>
               </div>
               <div class="form_col_12">
                  {{ Form::text('email', $email, ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_email").'*']) }}
                  <span class="error help-inline email contact_email_error">
                     <?php echo $errors->first('email'); ?>
                  </span>
               </div>
               <div class="form_col_12">
                  {{ Form::select('university_id',array(''=>trans("front_messages.$modelName.please_select_university").'*')+$universities,null, ['class' => 'form-select show-tick','id'=>'university_id','data-live-search'=>"true"]) }}
                  <span class="error help-inline university_id contact_university_error">
                     <?php echo $errors->first('university_id'); ?>
                  </span>
               </div>
               <div class="form_col_12">
                  {{ Form::select('course_type',array(''=>trans("front_messages.$modelName.please_select_course").'*')+$courseType,null, ['class' => 'form-select show-tick','id'=>'course_type','data-live-search'=>"true"]) }}
                  <span class="error help-inline course_type contact_course_type_error">
                     <?php echo $errors->first('course_type'); ?> 
                  </span>
               </div>
               <div class="access_list_box form_col_12">
                  <div class="form_column">
                     {{ Form::hidden('country', COUNTRY, ['id' => 'country']) }}
                     <div id="state_div">
                        {{ Form::select('state', ['' => trans("front_messages.$modelName.please_select_state").'*'] + $stateList, $old_state, ['class' => 'form-select', 'id' => 'state', 'onchange' => 'getCity(this.value,"city","city_div","contactUsForm", "", "", "form-select")']) }}
                     </div>
                     <span class="error help-inline state contact_state_error">
                        <?php echo $errors->first('state'); ?>
                     </span>
                  </div>
                  <div class="form_column"> 
                     <div id="city_div">
                        {{ Form::select('city',array(''=>trans("front_messages.$modelName.please_select_city").'*')+$cityList,null, ['class' => 'form-select show-tick','id'=>'city','data-live-search'=>"true"]) }}
                     </div>
                     <span class="error help-inline city contact_city_error">
                        <?php echo $errors->first('city'); ?>
                     </span>
                  </div>
               </div>
               <div class="form_col_12">
                  {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => trans('front_messages.contact.enter_message').'*']) }}
                  <span class="error help-inline message contact_message_error">
                     <?php echo $errors->first('message'); ?>
                  </span>
				</div>
                
				<div class="row">
					<div class="form-group col-sm-6 g-recaptcha-box">
					   <input type="hidden" id="g-recaptcha-response-contact" name="g-recaptcha-response">
					   <span class="error  help-inline g-recaptcha-response_error g-recaptcha-response" id="g-recaptcha-response_error_div">
						  <?php echo $errors->first('g-recaptcha-response'); ?>
					   </span>
					</div>
				</div>
			    
               <div class="contact_btn">
                  <button class="btn btn-primary submit_btn" type="submit">{{trans('front_messages.global.submit')}}</button>
               </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
</section>

@section('stylesheet')
{{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
@endsection

@section('javascript')
   {{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
	{{ HTML::script(WEBSITE_JS_URL . 'contactValidation.js') }}
	{{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
	<script> 
         
		grecaptcha.ready(function() {
			grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
				document.getElementById('g-recaptcha-response-contact').value = token;
			});
		});
	 

		window.onload = (event) => {
			var country = "<?php echo COUNTRY ?>";
			var old_state = "<?php echo $old_state ?>";
			if (old_state == '') {
				getState(country, "state", "city", "state_div", "city_div", "contactUsForm", "", "form-select");
			}
		};

	   var getStateUrl = "{{ route('getStates.by_country') }}";
	   var getCityUrl = "{{ route('getCity.by_state') }}";
	   
		phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer', 'not_valid_mobile_customer');
		$(document).ready(function() {
			var dateOfBirth = 'dob';
			var calDateFormat = '{{JS_DATE_FORMAT}}';
			showDateInPast(dateOfBirth, calDateFormat);
		});
	</script>
@endsection
@stop