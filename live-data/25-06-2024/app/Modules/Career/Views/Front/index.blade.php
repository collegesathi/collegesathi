@extends('layouts.default')
@section('content')

    <div class="career-banner">
        <div class="container">
            {!! $career_page_block_image->description !!}
        </div>
    </div>

    <div class="career-section py-5">
        <div class="container">
            <div class="career-section-heading text-center mb-5">
                {!! $career_page_block_heading->description !!}
            </div>
            <div class="career-list">
                <ul class="career_list">
                    @include('Career::Front.elements.career_element') 
                </ul>
                @if ($result->currentPage() != $result->lastPage())
                    <div class="seemore">
                        <span class="d-flex">{{ trans('front_messages.global.showing') }}&nbsp;<span
                                id="total_count">{{ count($result) }}</span>&nbsp;{{ trans('front_messages.global.out_of') }}
                            {{ $totalCareerCount }}</span>
                        <a class="btn btn-primary load_more" data-page="{{ $result->currentPage() + 1 }}"
                            href="javascript:void(0);">{{ trans('front_messages.global.load_more_jobs') }}</a>
                    </div>
                @endif
            </div> 
        </div>
    </div>




    <div class="modal fade modalJob" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ trans('front_messages.global.apply_jobs') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-box">
                        <form class="form" id="career_apply_form" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden"  name="career_id" id="career_id">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="{{ trans('front_messages.global.full_name') }}*"
                                    name="full_name" id="full_name">
                                <div class="error error_full_name text-danger"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="{{ trans('front_messages.global.email_address') }}*"
                                    name="email_address" id="email_address">
                                <div class="error error_email_address text-danger"></div>
                            </div>
                            <div class="form-group">
                                <input type="number" placeholder="{{ trans('front_messages.global.mobile_number') }}*"
                                    name="mobile_number" id="mobile_number">
                                <div class="error error_mobile_number text-danger"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="{{ trans('front_messages.global.job_position') }}*"
                                    name="job_position" id="job_position" readonly>
                                <div class="error error_job_position text-danger"></div>
                            </div>
                            <div class="form-group">
                                <textarea type="text" placeholder="{{ trans('front_messages.global.job_apply_description') }}*" name="description"
                                    id="description"></textarea>
                                <div class="error error_description text-danger"></div>
                            </div>
                            <div class="form-group">
                             
                                <label for="upload_cv" class="uploadFile">
                                    <input type="file" name="upload_cv" id="upload_cv">
                                    <span>
                                        <img src="{{ WEBSITE_IMG_URL }}cloud_upload.svg" alt="Img">
                                        <div>{{ trans('front_messages.global.upload_cv') }}</div>
                                    </span>
                                </label>
                                <div class="error error_upload_cv text-danger"></div>
                            </div>

                            
                             <div class="form-group col-sm-6 g-recaptcha-box">
                                <input type="hidden" id="g-recaptcha-response-career" name="g-recaptcha-response">
                                <span class="error  help-inline g-recaptcha-response_error career-g-recaptcha-response_error" id="g-recaptcha-response_error_div">
                                    <?php echo $errors->first('g-recaptcha-response'); ?>
                                </span>
                            </div>
                        


                            <button type="submit" class="btn btn-primary"
                                id="career_apply">{{ trans('front_messages.global.apply') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop




@section('javascript')
    <script type="text/javascript">
        var load_more_career_page_url = '{{ route("$modelName.load_more_career_page") }}';
        var apply_career_url = '{{ route("$modelName.apply_career_url") }}';
    </script>
    {{ Html::script(WEBSITE_JS_URL . 'job_applications.js') }} 
@stop