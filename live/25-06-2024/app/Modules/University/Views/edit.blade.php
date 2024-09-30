@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
{{ Breadcrumbs::render('university-page-edit') }}
@stop
<!-- Ckeditor -->
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'intl-tel-input/intlTelInput.js') }}

{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
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
                        {{ trans("messages.$modelName.table_heading_edit") }}
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
                    {{ Form::open(['role' => 'form', 'url' => route("$modelName.update", "$result->id"), 'class' => 'mws-form', 'id' => 'formSubmitData', 'files' => true]) }}

                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('name', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}

                                    <div class="form-group add-image image align-center">
                                        <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                        <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                            <?php
                                            $image = Request::old('image');
                                            $image = isset($image) ? $image : $result->image;
                                            ?>
                                            <div id="pImage">
                                                @if ($image != '' && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $image))
                                                <img src="{{ asset(UNIVERSITY_IMAGE_URL . $result->image, $result->image) }}" class="profileImage">
                                                @else
                                                <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg' class="profileImage">
                                                @endif
                                            </div>
                                        </span>
                                        <br />
                                        <div>
                                            <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
                                                Upload Image
                                                {{-- <span class="required"> * </span> --}}
                                            </a>
                                        </div>
                                        <span class="error  help-inline image_error image" id="image_error_div">
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
                                            <?php
                                            $image = Request::old('university_certificate_image');
                                            $image = isset($image) ? $image : $result->university_certificate_image;
                                            ?>
                                            <div id="pMImage">
                                                @if ($image != '' && File::exists(UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH . $image))
                                                <img src="{{ asset(UNIVERSITY_CERTIFICATE_IMAGE_URL . $result->university_certificate_image, $result->university_certificate_image) }}" class="profileImage">
                                                @else
                                                <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg' class="profileImage">
                                                @endif
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
                                        {{ Form::label('file', trans("messages.$modelName.prospectus").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}



                                        @if(!empty($result->file) && file_exists(UNIVERSITY_IMAGE_ROOT_PATH.$result->file))
                                        <a href='{{ route( "$modelName.downloadDocument",[$result->id])}}' class="text-decoration-none">
                                            <button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">download</i>{{ trans("messages.global.download") }}</button>
                                        </a>
                                        @endif


                                        <div class="form-group add-image">
                                            <input name="file" id="upload_document" class="form-control image-input-file" type="file" />
                                            <div>
                                                <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.file_tooltip_msg',['file_extension' => PDF_EXTENSION,'file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO ])}}" class="btn bg-teal btn-block btn-sm waves-effect upload-photo-action_4">
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
                            <div class="col-sm-6 edit_university_title">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('title', trans('messages.global.university_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('title', $result->title, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline name">
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
                                        {{ Form::text('short_text', $result->short_text, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline name">
                                        <?php echo $errors->first('short_text'); ?>
                                    </span>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('nirf_ranking', trans('messages.global.nirf_ranking') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('nirf_ranking', $result->nirf_ranking, ['class' => 'form-control']) }}
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
                                        {{ Form::text('tag_line', $result->tag_line, ['class' => 'form-control']) }}
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
                                        {{ Form::label('description', trans('messages.global.university_description') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('description',
                                            $result->description, ['class' => 'form-control ', 'id' => 'description']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('description', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('short_description',  trans("messages.$modelName.short_description_one") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('short_description',
                                            $result->short_description, ['class' => 'form-control ', 'id' => 'short_description']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('short_description_two', trans('messages.global.short_description_two') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('short_description_two',
                                            $result->short_description_two, ['class' => 'form-control ', 'id' => 'short_description_two']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description_two', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('short_description_three', trans('messages.global.short_description_three') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('short_description_three',
                                            $result->short_description_three, ['class' => 'form-control ', 'id' => 'short_description_three']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('short_description_three', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('university_facts', trans('messages.global.university_facts') . '<span class="required">  </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('university_facts',
                                            $result->university_facts, ['class' => 'form-control ', 'id' => 'university_facts']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('university_facts', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('university_approval', trans('messages.global.university_approval') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('university_approval',
                                            $result->university_approval, ['class' => 'form-control ', 'id' => 'university_approval']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('university_approval', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('certificate_content', trans('messages.global.certificate_content') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('certificate_content',
                                            $result->certificate_content, ['class' => 'form-control ', 'id' => 'certificate_content']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('certificate_content', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('emi_detail', trans('messages.global.emi_detail') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('emi_detail',
                                            $result->emi_detail, ['class' => 'form-control ', 'id' => 'emi_detail']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('emi_detail', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('admission_process', trans('messages.global.admission_process') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('admission_process',
                                            $result->admission_process, ['class' => 'form-control ', 'id' => 'admission_process']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('admission_process', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('examination_pattern', trans('messages.global.examination_pattern') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('examination_pattern',
                                            $result->examination_pattern, ['class' => 'form-control ', 'id' => 'examination_pattern']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('examination_pattern', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('placement_partners', trans('messages.global.placement_partners') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('placement_partners',
                                            $result->placement_partners, ['class' => 'form-control ', 'id' => 'placement_partners']) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('placement_partners', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 450,
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
                                        {{ Form::label('management_specialisations', trans('messages.global.university_management_specialisations') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} {{ Form::textarea('management_specialisations',
                                            $result->management_specialisations, ['class' => 'form-control ', 'id' => 'management_specialisations']) }}
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
                                            $result->ranking, ['class' => 'form-control ', 'id' => 'ranking']) }}
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
                                            $result->eligibility_criteria, ['class' => 'form-control ', 'id' => 'eligibility_criteria']) }}
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
                                            $result->university_advantages, ['class' => 'form-control ', 'id' => 'university_advantages']) }}
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
                                            if(!empty($result->universityPlacementPartners)){
                                            if(in_array($key,explode(',',$result->universityPlacementPartners->university_placement_partners))){
                                            $checked = 'checked="checked"';
                                            }
                                            }
                                            @endphp
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="placementPartners_{{$key}}" name="university_placement_partners[]" value="{{ $key }}" {{ $checked }}>
                                                <label class="form-check-label" for="placementPartners_{{$key}}">
                                                    {{ $value }}
                                                </label>
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
                                            if(!empty($result->universityBadges)){
                                            if(in_array($key,explode(',',$result->universityBadges->university_badges_id))){
                                            $checked = 'checked="checked"';
                                            }
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
                                            @php
                                            $checked = '';
                                            $checked = isset($result->program) && ($result->program == 1) ? 'checked' : '';
                                            @endphp
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="program" name="program" value="1" {{ $checked }}>
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
                                        {{ Form::text('display_order', $result->display_order, ['class' => 'form-control']) }}
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
                                        {{ Form::text('meta_title', $result->meta_title, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline meta_title">
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
                                        {{ Form::textarea('meta_description', $result->meta_description, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline meta_description">
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
                                        {{ Form::text('meta_keywords', $result->meta_keywords, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline meta_keywords">
                                        <?php echo $errors->first('meta_keywords'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>





                        <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href='{{ route("$modelName.edit", "$result->id") }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

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

        checkImageSize('university_certificate_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div_university_certificate_image', 'pMImage');
    });
</script>
<!-- for tooltip -->
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'intl-tel-input/intlTelInput.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'intl-tel-input/intlTelInput.js') }}
@stop