@extends('layouts.default')
@section('content')
    

    {{-- Banner section --}}
    {!! $referal_banner->description !!}
    {{-- Banner section --}}


    <section class="referal-section">
        <div class="container">
            {{ Form::open(['role' => 'form', 'files' => true, 'id' => 'referal_form']) }}
            {!! $referal_heading->description !!}
            <div class="referal-form-start d-flex flex-wrap">
                <div class="form-content">
                    <h3>{{ trans('front_messages.global.referee_details') }}<span>({{ trans('front_messages.global.yours') }})</span></h3>
                    <div class="access_list_form">
                        <div class="form_col_12">
                            {{ Form::text('referee_name', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.global.full_name").'*', 'id' => 'referee_name']) }}
                            <div class="error error_referee_name text-danger"></div>
                        </div>
                        <div class="form_col_12 mobile_input">
                            <div class="number_select contact_number">
                                <div class="country_code ">
                                    <span><img src="{{ WEBSITE_IMG_URL }}india.png" alt=""></span>
                                    <span>{{ trans('front_messages.global.country_code_ind') }}</span>
                                </div>
                                {{ Form::text('referee_phone', '', ['class' => 'form-control', 'id' => 'referee_phone']) }}
                                <div class="error error_referee_phone text-danger"></div>
                            </div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::text('referee_email', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.global.email_address").'*', 'id' => 'referee_email']) }}
                            <div class="error error_referee_email text-danger"></div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::select('referee_city', ['' => trans('messages.global.select_city').'*']+$cityList, '', ['class' => 'form-control','id'=>'referee_city']) }}
                            <div class="error error_referee_city text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="form-content">
                    <h3>{{trans("front_messages.global.reference_details")}}<span>({{trans("front_messages.global.whom_you_need_to_refer")}})</span></h3>
                    <div class="access_list_form">
                        <div class="form_col_12">
                            {{ Form::text('reference_name', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.global.full_name").'*', 'id' => 'reference_name']) }}
                            <div class="error error_reference_name text-danger"></div>
                        </div>
                        <div class="form_col_12 mobile_input">
                            <div class="number_select contact_number">
                                <div class="country_code ">
                                    <span><img src="{{ WEBSITE_IMG_URL }}india.png" alt=""></span>
                                    <span>{{ trans('front_messages.global.country_code_ind') }}</span>
                                </div>
                                {{ Form::text('reference_phone', '', ['class' => 'form-control', 'id' => 'reference_phone']) }}
                                <div class="error error_reference_phone text-danger"></div>
                            </div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::text('reference_email', '', ['class' => 'form-control', 'placeholder' => trans("front_messages.global.email_address").'*', 'id' => 'reference_email']) }}
                            <div class="error error_reference_email text-danger"></div>
                        </div>
                        <div class="form_col_12">
                            {{ Form::select('reference_city', ['' => trans('messages.global.select_city').'*']+$cityList, '', ['class' => 'form-control','id'=>'reference_city']) }}
                            <div class="error error_reference_city text-danger"></div>
                        </div>

                        <div class="form_col_12">
                            <div class="form-group col-sm-6 g-recaptcha-box">
                            <input type="hidden" id="g-recaptcha-response-referral" name="g-recaptcha-response">
                            <span class="error  help-inline g-recaptcha-response_error referral-g-recaptcha-response_error" id="g-recaptcha-response_error_div">
                                <?php echo $errors->first('g-recaptcha-response'); ?>
                            </span>
                            </div>
                        </div>

                        <div class="contact_btn">
                            <button type="submit" class="btn btn-primary" id="referal_form_btn">{{trans("front_messages.global.submit")}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tearm_condition_details">
                {!! $referal_terms_and_conditions->description !!}
            </div>
            {{ Form::close() }}
        </div>
    </section>
@stop



@section('javascript')
    <script type="text/javascript">
        var apply_referal_url = '{{ route("$modelName.add_referal_details") }}';
    </script>
    {{ Html::script(WEBSITE_JS_URL . 'referral_request.js') }}
@stop
