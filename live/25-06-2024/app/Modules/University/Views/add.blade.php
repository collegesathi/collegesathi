@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
{{ Breadcrumbs::render('university-page-add') }}
@stop

<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
{{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}

<!--- ckeditor js end  here -->

<style>
    .changePhotoCertificate {
        width: 234px !important;
    }
</style>

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_add") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.index") }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    {{ Form::open(['role' => 'form', 'route' => "$modelName.save", 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}


                    <div class="mt-20">

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">

                                    {{ Form::label('image', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                    <div class="form-group add-image image align-center">
                                        <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                        <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                            <div id="pImage">
                                                <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="image" class="profileImage" />
                                            </div>
                                        </span>
                                        <br />
                                        <div>
                                            <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto" rel="image">
                                                {{ trans('messages.global.upload_image') }} <span class="required">
                                                    * </span></a>
                                        </div>
                                        <span class="error help-inline image_error" id="image_error_div">
                                            <?php echo $errors->first('image'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <div class="form-group ">
                                    {{ Form::label('image', trans('messages.global.upload_university_image') . '<span class="">  </span>', ['class' => 'control-label'], false) }}
                                    <div class="form-group add-image image align-center">
                                        <input name="university_certificate_image" id="university_certificate_image" class="form-control image-input-file" type="file" />
                                        <span class="help-inline required university_certificate_image" id="ContentTypeNameSpan">
                                            <div id="pMImage">
                                                <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="Profile image" class="profileImage" />
                                            </div>
                                        </span>
                                        <br />
                                        <div>
                                            <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhotoCertificate" rel="image">
                                                {{ trans('messages.global.upload_university_image') }} <span class="required">
                                                     </span></a>
                                        </div>
                                        <span class="error  help-inline image_error" id="image_error_div_university_certificate_image">
                                            <?php echo $errors->first('university_certificate_image'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix other_document_div">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('file', trans("messages.$modelName.prospectus") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-group add-image">
                                            <input name="file" id="upload_document" class="form-control image-input-file" type="file" />
                                            <div>
                                                <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.file_tooltip_msg', ['file_extension' => PDF_EXTENSION, 'file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]) }}" class="btn bg-teal btn-block btn-sm waves-effect upload-photo-action_4">
                                                    Upload File
                                                </a>
                                                <div class="input-file-name-upload_document"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="error  help-inline image_error upload_document" id="upload_document_error_div">
                                        {{ $errors->first('file') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 university_title">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('title', trans('messages.global.university_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('title', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('title'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('short_text', trans('messages.global.short_title') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('short_text', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('short_text'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('nirf_ranking', trans('messages.global.nirf_ranking') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('nirf_ranking', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('nirf_ranking'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('tag_line', trans('messages.global.tag_line') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('tag_line', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('tag_line'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('description', trans("messages.$modelName.description") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('description', {
                                                    filebrowserUploadUrl: '<?php echo URL::to("base/uploder"); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('description'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('short_description', trans("messages.$modelName.short_description_one") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('short_description', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('short_description'); ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('short_description_two', trans("messages.$modelName.short_description_two") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('short_description_two', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description_two', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('short_description_two'); ?></span>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('short_description_three', trans("messages.$modelName.short_description_three") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('short_description_three', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description_three', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('short_description_three'); ?></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('university_facts', trans("messages.$modelName.university_facts") . '<span class="required">  </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('university_facts', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('university_facts', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('university_facts'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('university_approval', trans("messages.$modelName.university_approval") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('university_approval', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('university_approval', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('university_approval'); ?></span>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('certificate_content', trans("messages.$modelName.certificate_content") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('certificate_content', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('certificate_content', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('certificate_content'); ?></span>
                                </div>
                            </div>
                        </div> -->
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('emi_detail', trans("messages.$modelName.emi_detail") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('emi_detail', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('emi_detail', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('emi_detail'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('admission_process', trans("messages.$modelName.admission_process") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('admission_process', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('admission_process', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('admission_process'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('examination_pattern', trans("messages.$modelName.examination_pattern") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('examination_pattern', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('examination_pattern', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('examination_pattern'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('placement_partners', trans("messages.$modelName.placement_partners") . '<span class="required"> * </span>', ['class' => 'mws-form-label'], false) }}
                                        {{ Form::textarea('placement_partners', null, ['class' => 'form-control', 'rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('placement_partners', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="description_error" class="error"><?php echo $errors->first('placement_partners'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('management_specialisations', trans('messages.global.university_management_specialisations') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} 
                                        {{ Form::textarea('management_specialisations','', ['class' => 'form-control ', 'id' => 'management_specialisations']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('management_specialisations', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="management_specialisations_error" class="error"><?php echo $errors->first('management_specialisations'); ?></span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('ranking', trans('messages.global.university_ranking') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('ranking',
                                            '', ['class' => 'form-control ', 'id' => 'ranking']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('ranking', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="ranking_error" class="error"><?php echo $errors->first('ranking'); ?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('eligibility_criteria', trans('messages.global.university_eligibility_criteria') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('eligibility_criteria',
                                            '', ['class' => 'form-control ', 'id' => 'eligibility_criteria']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('eligibility_criteria', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="eligibility_criteria_error" class="error"><?php echo $errors->first('eligibility_criteria'); ?></span>
                                </div>
                            </div>
                        </div>




                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('university_advantages', trans('messages.global.university_university_advantages') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('university_advantages',
                                            '', ['class' => 'form-control ', 'id' => 'university_advantages']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('university_advantages', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span id="university_advantages_error" class="error"><?php echo $errors->first('university_advantages'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix"> 
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('placement_partners', trans("messages.$modelName.placement_partners") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            @foreach ($placementPartners as $key => $value)

                                            @php
                                            $checked = '';
                                            if(in_array($key,$selectedPlacementPartners)){
                                            $checked = 'checked="checked"';
                                            }
                                            @endphp

                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="placementPartners_{{$key}}" name="university_placement_partners[]" value="{{ $key }}" {{ $checked }}>
                                                <label class="form-check-label" for="placementPartners_{{$key}}">
                                                    {{ $value }}
                                                </label>
                                                &nbsp;&nbsp;&nbsp;
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('university_placement_partners'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('university_badges', trans("messages.$modelName.university_badges") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            @foreach ($badges as $key => $value)

                                            @php
                                            $checked = '';
                                            if(in_array($key,$selectedBadges)){
                                            $checked = 'checked="checked"';
                                            }
                                            @endphp

                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="badges_{{$key}}" name="university_badges_id[]" value="{{ $key }}" {{ $checked }}>
                                                <label class="form-check-label" for="badges_{{$key}}">
                                                    {{ $value }}
                                                </label>
                                                &nbsp;&nbsp;&nbsp;
                                            </div>

                                            @endforeach
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('university_badges_id'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('program', trans("messages.$modelName.program") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="program" name="program" value="1">
                                                <label class="form-check-label" for="program">Program</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('program'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('display_order', trans("messages.$modelName.display_order") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('display_order', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('display_order'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('meta_title', trans("messages.$modelName.meta_title") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('meta_title', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('meta_title'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('meta_description', trans("messages.$modelName.meta_description") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('meta_description', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('meta_description'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('meta_keywords', trans("messages.$modelName.meta_keyword") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('meta_keywords', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('meta_keywords'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>






                        <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName . '.add') }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $(".upload-photo-action_4").click(function() {
            $('#upload_document').trigger('click');
        });

        $("input[name=file]").on('change', function() {
            $('.input-file-name-upload_document').text(this.files[0].name);
        });

    });
</script>  
<script>
    $(document).ready(function() {
        $('#profile_image').change(function() {
            checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div',
                'pImage');
        });

        /**
         *Show user image after select
         */
        $(document).on("click", ".changePhoto", function() {
            if (!$(".add-image #profile_image").hasClass("added")) {
                $(".add-image #profile_image").trigger("click");
                $(".add-image #profile_image").addClass("added");
                window.setTimeout(function() {
                    $(".add-image #profile_image").removeClass("added");
                }, 500);
            }
        }); 

        $(document).on("click", ".changePhotoCertificate", function() {
            if (!$(".add-image #university_certificate_image").hasClass("added")) {
                $(".add-image #university_certificate_image").trigger("click");
                $(".add-image #university_certificate_image").addClass("added");

                window.setTimeout(function() {
                    $(".add-image #university_certificate_image").removeClass("added");
                }, 500);
            }
        });

        $('#university_certificate_image').on('change', function() {
           
            checkImageSize('university_certificate_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form','image_error_div_university_certificate_image','pMImage');
        });
    });
</script>
<!-- for tooltip -->
{{ HTML::style(WEBSITE_ADMIN_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL . 'intl-tel-input/intlTelInput.js') }}
@stop