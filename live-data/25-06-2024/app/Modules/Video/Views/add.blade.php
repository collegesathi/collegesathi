@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('video-page-add') }}
@stop
    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_index") }}

                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href='{{ route("UniversityVideo.index",$uni_id) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        {{ Form::open(['role' => 'form','url' =>  route("UniversityVideo.save","$uni_id"),'files'=>true,'class' => 'mws-form']) }}
                        {{ Form::hidden('uni_id', $uni_id, ['class' => 'form-control']) }}
                        <div class="mt-20">

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">

                                        {{ Form::label('image', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        <div class="form-group add-image image align-center">
                                            <input name="image" id="profile_image" class="form-control image-input-file"
                                                type="file" />
                                            <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                                <div id="pImage">
                                                    <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg"
                                                        alt="image" class="profileImage" />
                                                </div>
                                            </span>
                                            <br />
                                            <div>
                                                <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="{{ trans('messages.global.image_tooltip_msg') }}"
                                                    class="btn bg-teal btn-block btn-sm waves-effect changePhoto"
                                                    rel="image">
                                                    {{ trans('messages.global.upload_image') }} <span class="required">
                                                        * </span></a>
                                            </div>
                                            <span class="error help-inline image_error" id="image_error_div">
                                                <?php echo $errors->first('image'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('name', trans('messages.global.title') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('duration', trans("messages.$modelName.duration") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('duration', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('duration'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('youtube_id', trans("messages.$modelName.youtube_id") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('youtube_id', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('youtube_id'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('short_description', trans("messages.$modelName.short_description") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('short_description', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('short_description'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href="{{ route('UniversityVideo.add',$uni_id) }}" class="text-decoration-none"><button
                                        type="button" class="btn bg-blue-grey btn-sm waves-effect"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

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

        });


    </script>

@stop
