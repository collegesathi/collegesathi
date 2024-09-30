@extends('layouts.default')
@section('content')

    
    <style>
        .scholarship-banner.common_banner {
            background-color: transparent;
        }
        .scholarship-banner {
            padding: 30px 0;
        }
        .scholarship-banner {
            background-image: url('{{ WEBSITE_IMG_URL }}army-page-banner.jpg');
            background-repeat: no-repeat;
            background-position: center;
        }
        .scholarship-banner {
            min-height: 444px;
            display: flex;
            align-items: center;
        }
    </style>

    {{-- Banner section --}}
    {!! $scholarship_banner->description !!}
    {{-- Banner section --}}




    <section class="referal-section scholarship-section">
        <div class="container">
            {!! $scholarship_heading->description !!}
            <div class="referal-form-start d-flex flex-wrap justify-content-center">
                <div class="form-content">
                    <h3>{{ trans('front_messages.global.personal_information') }}<span>({{ trans('front_messages.global.yours') }})</span></h3>
                    {{ Form::open(['role' => 'form', 'files' => true, 'class' => 'access_list_form', 'id' => 'scholarship_form']) }}
                        <div class="form_col_12">
                            {{ Form::text('full_name', '', ['class' => 'form-control', 'placeholder' => trans('front_messages.global.full_name').'*', 'id' => 'full_name']) }}
                            <div class="error error_full_name text-danger"></div>
                        </div>
                        <div class="form_col_12 mobile_input">
                            <div class="number_select contact_number">
                                <div class="country_code ">
                                    <span><img src="{{ WEBSITE_IMG_URL }}india.png" alt=""></span>
                                    <span>{{ trans('front_messages.global.country_code_ind') }}</span>
                                </div>
                                {{ Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone']) }}
                                <div class="error error_phone text-danger"></div>
                            </div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::text('email', '', ['class' => 'form-control', 'id' => 'email','placeholder' => trans('front_messages.global.email_addresss').'*']) }}
                            <div class="error error_email text-danger"></div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::select('course', ['' => trans('messages.global.please_select_course_you_interested').'*']+$courseList, '', ['class' => 'form-control','id'=>'course']) }}
                            <div class="error error_course text-danger"></div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::select('city', ['' => trans('messages.global.select_city').'*']+$cityList, '', ['class' => 'form-control','id'=>'city']) }}
                            <div class="error error_city text-danger"></div>
                        </div>

                        <div class="form_col_12">
                            <div class="form-group col-sm-6 g-recaptcha-box">
                            <input type="hidden" id="g-recaptcha-response-scholarship" name="g-recaptcha-response">
                            <span class="error  help-inline g-recaptcha-response_error scholarship-g-recaptcha-response_error" id="g-recaptcha-response_error_div">
                                <?php echo $errors->first('g-recaptcha-response'); ?>
                            </span>
                            </div>
                        </div>


                        <div class="contact_btn">
                            <button type="submit" class="btn btn-primary" id="scholarship_form_btn">{{ trans('front_messages.global.submit') }}</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
@stop

  

@section('javascript')
    <script type="text/javascript">
        var apply_scholarship_url 	= 	'{{ route("$modelName.apply_scholarship") }}';
    </script>
    {{ Html::script(WEBSITE_JS_URL . 'scholarship_request.js') }}
@stop
