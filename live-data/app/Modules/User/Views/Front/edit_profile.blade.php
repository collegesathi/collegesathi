@extends('layouts.default')
@section('content')
@section('title', $pageTitle)
<div class="login-register">
   <div class="container">
      <div class="form-box">
         <h1>{{ trans('front_messages.global.edit_profile') }}</h1>
         <p></p>
         {{ Form::model($userDetails, ['role' => 'form', 'class' => 'access_list_form', 'route' => 'User.updateProfile', 'files' => true, 'id' => 'updateUserProfileForm']) }}
         <div class="form_col_12">
         <div class="edit-profile-content">
            <div class="edit-profile-image">
               <?php
                  $image = Request::old('image');
                  $image = isset($image) ? $image : $userDetails['image'];
                  
                  ?>
               <figure class="profile_pic userProfileImageFigure " id="pImage">
                  @if ($image != '' && File::exists(USER_PROFILE_IMAGE_ROOT_PATH . $image))
                  @php
                  $root_path = USER_PROFILE_IMAGE_ROOT_PATH;
                  $http_path = USER_PROFILE_IMAGE_URL;
                  $attribute = [];
                  $type = '';
                  $attribute['alt'] = 'user-profile';
                  $attribute['class'] = 'userProfileImage';
                  $attribute['width'] = '50';
                  $attribute['height'] = '50';
                  $attribute['cropratio'] = '1:1';
                  $attribute['zc'] = '1';
                  $attribute['type'] = '3';
                  $image_name = isset($userDetails['image']) ? $userDetails['image'] : '';
                  $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                  @endphp
                  {!! $image !!}
                  @else
                  <img src='{{ asset(WEBSITE_UPLOADS_URL .'user-profile-not-available.jpeg','user-profile-not-available.peg') }}' class="profileImage">
                  @endif
               </figure>
               <div class="img-upload_box">
                  {{ Form::file('image', ['id' => 'profileImages', 'class' => 'form-control']) }}
                </div>
               <span class="error help-inline image_error image" id="image_error_div">
               <?php echo $errors->first('image'); ?>
               </span>
            </div>
         </div>
         </div>
         <div class="form_col_12">
            {{ Form::text('first_name',null, ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_first_name")]) }}
            <span class="error help-inline user_edit_profile_first_name_error first_name">
            {{ $errors->first('first_name') }}
            </span>
         </div>
         <div class="form_col_12">
            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_last_name")]) }}
            <span class="error help-inline user_edit_profile_last_name_error last_name">
            {{ $errors->first('last_name') }}
            </span>
         </div>
         <div class="form_col_12">
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans("front_messages.$modelName.enter_email"), 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}", 'readOnly']) }}
            <span class="error help-inline email user_edit_profile_signup_email_error">
            {{ $errors->first('email') }}
            </span>
         </div>
         <div class="form_col_12 mobile_input">
            <div class="number_select contact_number">
               {{ Form::text('phone_number', null, ['id' => 'phoneNumberCustomer', 'class' => 'form-control', 'placeholder' => trans('front_messages.User.mobile_number'), 'onkeydown' => "if(['Space'].includes(arguments[0].code)){return false}"]) }}
               {{ Form::hidden('phone', null, ['id' => 'phoneCustomer', 'class' => 'userphonecode']) }}
               {{ Form::hidden('dial_code',  null , ['id' => 'stu_dial_codeCustomer', 'class' => 'customer_dial_code']) }}
               <span
                  class="error help-inline phone_error phone student_signup_phone_error UserPhoneCustomer_error not_valid_mobile_customer  user_edit_profile_phone_number_error">
               {{ $errors->first('phone') }}
               </span>
            </div>
         </div>
         <button type="submit" class="btn btn-primary">{{ trans('front_messages.global.save_change') }}</button>
         {{ Form::close() }}
      </div>
   </div>
</div>
@stop
@section('javascript')
{{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
<script type="text/javascript">
phoneNumValidate('phoneNumberCustomer', 'UserPhoneCustomer_error', 'phoneCustomer', 'stu_dial_codeCustomer');
    
/** update form validate here */
$('#updateUserProfileForm').formValidation('destroy', true);
$('#updateUserProfileForm').formValidation({
    message: 'This value is not valid',
    fields: {
        'first_name': {
            err: '.user_edit_profile_first_name_error',
            validators: {
            notEmpty: {
                message: ERROR_ENTER_FIRST_NAME
            },
            }
        },
        'last_name': {
            err: '.user_edit_profile_last_name_error',
            validators: {
            notEmpty: {
                message: ERROR_ENTER_LAST_NAME
            },
            }
        },
        'email': {
            err: '.user_edit_profile_signup_email_error',
            validators: {
                notEmpty: {
                    message: ERROR_ENTER_EMAIL_ADDRESS
            },
            emailAddress: {
                message: ERROR_ENTER_VALID_EMAIL_ADDRESS
            },
            }
        },
        'phone_number': {
            err: '.user_edit_profile_phone_number_error',
            validators: {
                notEmpty: {
                    message: ERROR_ENTER_MOBILE_NO
                },
                numeric: {
                    message: ERROR_VALID_MOBILE_NO
                },
            }
        }
    }
});
   
</script>
@stop