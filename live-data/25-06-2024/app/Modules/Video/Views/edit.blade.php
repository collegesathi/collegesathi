@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('video-page-edit') }}
@stop
    <!-- Ckeditor -->

    {{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}

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
                                <a href='{{ route("UniversityVideo.index",$uni_id) }}' >
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form','url' =>  route("UniversityVideo.update",[$result->id,$uni_id]),'files'=>true,'class' => 'mws-form']) }}

                        <div class="mt-20">

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        {{ Form::label('name', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}

                                        <div class="form-group add-image image align-center">
                                            <input name="image" id="profile_image" class="form-control image-input-file"
                                                type="file" />
                                            <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                                <?php
                                                $image = Request::old('image');
                                                $image = isset($image) ? $image : $result->image;
                                                ?>
                                                <div id="pImage">
                                                    @if ($image != '' && File::exists(VIDEO_IMAGE_ROOT_PATH . $image))
                                                        <img src="{{ asset(VIDEO_IMAGE_URL . $result->image, $result->image) }}"
                                                            class="profileImage">
                                                    @else
                                                        <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg'
                                                            class="profileImage">
                                                    @endif
                                                </div>
                                            </span>
                                            <br />
                                            <div>
                                                <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip"
                                                    data-placement="bottom"
                                                    title="{{ trans('messages.global.image_tooltip_msg') }}"
                                                    class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
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
                            </div>

                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('name', trans('messages.global.title') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('name', $result->name, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline name">
                                            <?php echo $errors->first('name'); ?>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('duration', trans('messages.global.duration') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('duration', $result->duration, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline duration">
                                            <?php echo $errors->first('duration'); ?>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('youtube_id', trans('messages.global.youtube_id') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('youtube_id', $result->youtube_id, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline youtube_id">
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
                                            {{ Form::text('short_description', $result->short_description, ['class' => 'form-control']) }}
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

                                <a href='{{ route("UniversityVideo.edit",[$result->id,$uni_id]) }}'
                                    class="text-decoration-none"><button type="button"
                                        class="btn bg-blue-grey btn-sm waves-effect"><i
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
        });
    </script>
@stop
