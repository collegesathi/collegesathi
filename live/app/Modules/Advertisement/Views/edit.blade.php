@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('advertisement-page-edit') }}
@stop
    <!-- Ckeditor -->

    {{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}

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
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form', 'url' => route("$modelName.update", "$result->id"), 'class' => 'mws-form', 'id' => 'formSubmitData', 'files' => true]) }}

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
                                                    @if ($image != '' && File::exists(ADVERTISEMENT_IMAGE_ROOT_PATH . $image))
                                                        <img src="{{ asset(ADVERTISEMENT_IMAGE_URL . $result->image, $result->image) }}"
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
                                            {{ Form::label('title', trans('messages.global.title') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('name', $result->title, ['class' => 'form-control']) }}
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
                                            {{ Form::label('advertisement_url', trans("messages.$modelName.advertisement_url"), ['class' => 'control-label'], false) }}
                                            {{ Form::text('advertisement_url',  $result->advertisement_url, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline advertisement_url">
                                            <?php echo $errors->first('advertisement_url'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href='{{ route("$modelName.edit", "$result->id") }}'
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
