@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
{{ Breadcrumbs::render('course_add', $univercityId) }}
@stop
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
                        {{ isset($univercityId) && !empty($univercityId) ? CustomHelper::getUniversiryNameById($univercityId)." -> " : '' }}{{ trans("messages.$modelName.table_heading_add") }}

                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.listCourse", $univercityId) }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>

                <div class="body">
                    {{ Form::open(['role' => 'form', 'route' => "Course.save", 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}

                    <input type="hidden" name="univercity_id" value="{{ $univercityId }}">
                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
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
                                    <div class="form-group add-image image align-center">
                                        <input name="course_certificate_image" id="course_certificate_image" class="form-control image-input-file" type="file" />
                                        <span class="help-inline required course_certificate_image" id="ContentTypeNameSpan">
                                            <div id="pMImage">
                                                <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="Profile image" class="profileImage" />
                                            </div>
                                        </span>
                                        <br />
                                        <div>
                                            <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhotoCertificate" rel="image">
                                                {{ trans('messages.global.upload_course_image') }} <span class="required">
                                                </span></a>
                                        </div>
                                        <span class="error  help-inline image_error" id="image_error_div_course_certificate_image">
                                            <?php echo $errors->first('course_certificate_image'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('course_id', trans("messages.$modelName.course_id").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::select('course_id',array(''=>trans("messages.$modelName.please_select_course_id"))+$courseDropdown,null, ['class' => 'form-control show-tick','id'=>'course_id','data-live-search'=>"true"]) }}
                                    </div>
                                    <span class="error help-inline">
                                        {{ $errors->first('course_id') }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('course_category', trans("messages.$modelName.course_category").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::select('course_category',array(''=>trans("messages.$modelName.please_select_course_category"))+$courseCategoryDropdown,null, ['class' => 'form-control show-tick','id'=>'course_category','data-live-search'=>"true"]) }}
                                    </div>
                                    <span class="error help-inline">
                                        {{ $errors->first('course_category') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('per_semester_fee', trans('messages.global.per_semester_fee') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('per_semester_fee', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('per_semester_fee'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('total_fee', trans('messages.global.total_fee') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('total_fee', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('total_fee'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('one_time_fee', trans('messages.global.one_time_fee') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('one_time_fee', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('one_time_fee'); ?>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('number_of_semesters', trans('messages.global.number_of_semesters') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('number_of_semesters', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('number_of_semesters'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('about_course', trans('messages.global.about_course') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('about_course', '', ['class' => 'form-control','rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('about_course', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('about_course'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
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
                                                    height: 250,
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('eligibility_criteria', trans('messages.global.eligibility_criteria') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('eligibility_criteria', '', ['class' => 'form-control','rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('eligibility_criteria', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('eligibility_criteria'); ?>
                                    </span>
                                </div>
                            </div>

                            <!-- <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('exam_pattern', trans('messages.global.exam_pattern') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('exam_pattern', '', ['class' => 'form-control','rows' => 2]) }}
                                        <script>
                                            $(function() {
                                                CKEDITOR.replace('exam_pattern', {
                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                    filebrowserImageWindowWidth: '640',
                                                    filebrowserImageWindowHeight: '480',
                                                    height: 250,
                                                    enterMode: CKEDITOR.ENTER_BR
                                                });
                                            });
                                        </script>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('exam_pattern'); ?>
                                    </span>
                                </div>
                            </div> -->
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


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('specialization', trans("messages.$modelName.specialization") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            @php
                                            $checked = '';
                                            @endphp
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="checkbox" id="specialization" name="specialization" value="1" {{ $checked }}>
                                                <label class="form-check-label" for="specialization">Specialization</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('specialization'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('is_admission_open', trans("messages.$modelName.is_admission_open") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">

                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="is_admission_open" name="is_admission_open" value="1">
                                                <label class="form-check-label" for="is_admission_open">Admission Open</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('is_admission_open'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('is_featured', trans("messages.$modelName.is_featured") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                                                <label class="form-check-label" for="is_featured">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('is_featured'); ?>
                                    </span>
                                </div>
                            </div>

                        </div>


                        <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName . '.add', $univercityId) }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

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
            if (!$(".add-image #course_certificate_image").hasClass("added")) {
                $(".add-image #course_certificate_image").trigger("click");
                $(".add-image #course_certificate_image").addClass("added");

                window.setTimeout(function() {
                    $(".add-image #course_certificate_image").removeClass("added");
                }, 500);
            }
        });

        $('#course_certificate_image').on('change', function() {

            checkImageSize('course_certificate_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div_course_certificate_image', 'pMImage');
        });
    });
</script>

@stop