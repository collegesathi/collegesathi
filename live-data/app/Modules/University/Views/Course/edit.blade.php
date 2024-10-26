@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
    @if ($result && $specification_id == '')
        {{ Breadcrumbs::render('course_edit', $result->univercity_id) }}
    @elseif($result && $specification_id != '')
        {{ Breadcrumbs::render('course_specification', $result->univercity_id) }}
    @elseif(!$result && $specification_id != '')
        {{ Breadcrumbs::render('course_specification', $uni_id) }}
    @endif
@stop

@php
    if ($specification_id != '') {
        $specificationName = CustomHelper::getMasterDropdownNameById($specification_id);
    }
@endphp

<style>
    .changePhotoCertificate {
        width: 234px !important;
    }
</style>
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        @if ($result && $specification_id == '')
                            {{ isset($result->univercity_id) && !empty($result->univercity_id) ? CustomHelper::getUniversiryNameById($result->univercity_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_edit") }}
                        @elseif($result && $specification_id != '')
                            {{ isset($result->univercity_id) && !empty($result->univercity_id) ? CustomHelper::getUniversiryNameById($result->univercity_id)." -> " : '' }}{{ "$specificationName -> " }}{{ trans("messages.$modelName.table_heading_edit_specification") }}
                        @elseif(!$result && $specification_id != '')
                            {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ "$specificationName -> " }}{{ trans("messages.$modelName.table_heading_add_specification") }}
                        @endif
                        

                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            @if (isset($specification_id) && $specification_id != '' && (isset($result->number_of_semesters) && $result->number_of_semesters != ''))
                                <li>
                                    <a href='{{ route("$modelName.semester", [$result->univercity_id, $result->university_course_id,$result->specification_id]) }}'>
                                        <button type="button" class="btn bg-green waves-effect"><i class="material-icons font-14">add</i>{{ trans('messages.global.add_semester') }}</button>
                                    </a>
                                </li>
                            @endif


                            <li>
                                <a href='{{ route("$modelName.listCourse", $uni_id) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>
                            </li>
                    </ul>
                </div>

                <div class="body">
                    @if ($result && $specification_id == '')
                        {{ Form::model($result, ['role' => 'form', 'url' => route("$modelName.update", $result->id), 'class' => 'mws-form', 'files' => true]) }}
                    @elseif($result && $specification_id != '')
                        {{ Form::model($result,[
                            'role' => 'form', 
                            'route' => ['Course.updateCourseSpecification', $result->id,$id, $specification_id], 
                            'files' => true, 
                            'class' => 'mws-form', 
                            'id' => 'formData'
                        ]) }}
                    @elseif(!$result && $specification_id != '')
                        {{ Form::open([
                            'role' => 'form', 
                            'route' => ['Course.saveCourseSpecification', $id, $specification_id], 
                            'files' => true, 
                            'class' => 'mws-form', 
                            'id' => 'formData'
                        ]) }}
                    @endif

                    <input type="hidden" name="univercity_id" value="{{ $uni_id }}">
                    

                    

                    <input type="hidden" name="univercity_slug" value="{{ $unislug->slug }}">

                    <div class="mt-20">
                        <div class="row clearfix">
                            @if ($result) 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <!-- {{ Form::label('name', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }} -->

                                        
                                        <div class="form-group add-image image align-center">
                                            <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                            <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                                <?php
                                                $image = Request::old('image');
                                                $image = isset($image) ? $image : $result->image;
                                                ?>
                                                <div id="pImage">
                                                    @if ($image != '' && File::exists(COURSE_IMAGE_ROOT_PATH . $image))
                                                    <img src="{{ asset(COURSE_IMAGE_URL . $result->image, $result->image) }}" class="profileImage">
                                                    @else
                                                    <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg' class="profileImage">
                                                    @endif
                                                </div>
                                            </span>
                                            <br />
                                            <div>
                                                <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
                                                    Upload Image
                                                    <span class="required"> * </span> 
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
                                        <div class="form-group add-image image align-center">
                                            <input name="course_certificate_image" id="course_certificate_image" class="form-control image-input-file" type="file" />
                                            <span class="help-inline required course_certificate_image" id="ContentTypeNameSpan">
                                                <?php
                                                $image = Request::old('course_certificate_image');
                                                $image = isset($image) ? $image : $result->course_certificate_image;
                                                ?>
                                                <div id="pMImage">
                                                    @if ($image != '' && File::exists(COURSE_CERTIFICATE_IMAGE_ROOT_PATH . $image))
                                                    <img src="{{ asset(COURSE_CERTIFICATE_IMAGE_URL . $result->course_certificate_image, $result->course_certificate_image) }}" class="profileImage">
                                                    @else
                                                    <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg' class="profileImage">
                                                    @endif
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
                            @else
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
                            @endif
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('course_id', trans("messages.$modelName.course_id").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}

                                        @if ($specification_id == '')
                                            {{ Form::select('course_id',array(''=>trans("messages.$modelName.please_select_course_id"))+$courseDropdown,null, ['class' => 'form-control show-tick','id'=>'course_id','data-live-search'=>"true"]) }}
                                        @else
                                            {{ Form::select('course_id',array(''=>trans("messages.$modelName.please_select_course_id"))+$courseDropdown,$selectedCourse, ['class' => 'form-control show-tick','id'=>'course_id','data-live-search'=>"true",'disabled' => 'disabled']) }}
                                            <input type="hidden" name="course_id" value="{{$selectedCourse}}">
                                        @endif
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
                                        @if ($specification_id == '')
                                            {{ Form::select('course_category',array(''=>trans("messages.$modelName.please_select_course_category"))+$courseCategoryDropdown,null, ['class' => 'form-control show-tick','id'=>'course_category','data-live-search'=>"true"]) }}
                                        @else
                                            {{ Form::select('course_category',array(''=>trans("messages.$modelName.please_select_course_category"))+$courseCategoryDropdown,$selectedCourseCategory, ['class' => 'form-control show-tick','id'=>'course_category','data-live-search'=>"true",'disabled' => 'disabled']) }}
                                            <input type="hidden" name="course_category" value="{{$selectedCourseCategory}}">
                                        @endif
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
                                        {{ Form::text('per_semester_fee', null, ['class' => 'form-control']) }}
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
                                        {{ Form::text('total_fee', null, ['class' => 'form-control']) }}
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
                                        {{ Form::text('one_time_fee', null, ['class' => 'form-control']) }}
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
                                        {{ Form::text('tag_line', null, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('tag_line'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('number_of_semesters', trans('messages.global.number_of_semesters') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('number_of_semesters', null, ['class' => 'form-control']) }}
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
                                        {{ Form::text('display_order', null, ['class' => 'form-control']) }}
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
                                        {{ Form::textarea('about_course', null, ['class' => 'form-control','rows' => 2]) }}
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
                                        {{ Form::textarea('management_specialisations',null, ['class' => 'form-control ', 'id' => 'management_specialisations']) }}
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
                                        {{ Form::textarea('eligibility_criteria', null, ['class' => 'form-control','rows' => 2]) }}
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
                                        {{ Form::textarea('exam_pattern', null, ['class' => 'form-control','rows' => 2]) }}
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


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div>
                                        {{ Form::label('specialization', trans("messages.$modelName.specialization") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-check">
                                            @php
                                            $checked = '';
                                            $checked = isset($result->specialization) && ($result->specialization == 1) ? 'checked' : '';
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
                                            @php
                                            $checked = '';
                                            $checked = isset($result->is_admission_open) && ($result->is_admission_open == 1) ? 'checked' : '';
                                            @endphp
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="is_admission_open" name="is_admission_open" value="1" {{ $checked }}>
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
                                            @php
                                            $checked = '';
                                            $checked = isset($result->is_featured) && ($result->is_featured == 1) ? 'checked' : '';
                                            @endphp
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ $checked }}>
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
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>{{ trans('messages.global.save') }}</button>

                            @if ($result && $specification_id == '')
                                <a href="{{ route($modelName . '.edit', $id) }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            @else
                                <a href="{{ route($modelName . '.courseSpecification', [$id, $uni_id, $specification_id]) }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            @endif

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
            checkImageSize('course_certificate_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form','image_error_div_course_certificate_image','pMImage');
        });
    });


</script>

@stop