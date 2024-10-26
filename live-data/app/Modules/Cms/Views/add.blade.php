@extends('admin.layouts.default')
@section('content')


@section('breadcrumbs')
	{{ Breadcrumbs::render('cms-page-add') }}
@stop
    <?php $langCode = ''; ?>
    <!-- Ckeditor -->
    {{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}

    <!--- ckeditor js end  here -->

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
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form', 'route' => "$modelName.save",'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}
                        @include('admin.elements.multilanguage_tab')
                        <div class="mt-20">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('name', trans("messages.$modelName.page_name") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('name', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                          <!--  <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('name', trans("messages.$modelName.featured_image") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}


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
                                                        class="btn bg-teal btn-block btn-sm waves-effect changePhoto" rel="image">
                                                        {{ trans('messages.global.upload_image') }} <span class="required">
                                                            * </span></a>
                                                </div>
                                                <span class="error help-inline image_error">
                                                    <?php echo $errors->first('image'); ?>
                                                </span>
                                            </div>



                                          </div>

                                    </div>
                                </div>
                            </div> -->

                            <div class="tab-content">

                                @foreach ($languages as $langCode => $title)
                                    <?php $i = $langCode; ?>
                                    <div role="tabpanel"
                                        class="tab-pane animated {{ $i == $language_code ? 'active' : '' }} "
                                        id="{{ $i }}_div">
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::label('title', trans("messages.$modelName.page_title") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                                        {{ Form::text("data[$i][" . 'title' . ']', '', ['class' => 'form-control']) }}
                                                    </div>
                                                    <span class="error help-inline">
                                                        <?php echo $errors->first('title'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-12">
                                                <div class="form-group">

                                                    <div class="form-line">
                                                        {{ Form::label($i . '_body', trans("messages.$modelName.page_description") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                                        {{ Form::textarea("data[$i][" . 'description' . ']', '', ['class' => 'form-control ', 'id' => 'description' . $i]) }}
                                                        <script>
                                                            $(function() {
                                                                CKEDITOR.replace('description{{ $i }}', {
                                                                    filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
                                                                    filebrowserImageWindowWidth: '640',
                                                                    filebrowserImageWindowHeight: '480',
                                                                    height: 450,
                                                                    enterMode: CKEDITOR.ENTER_BR
                                                                });
                                                            });
                                                        </script>
                                                    </div>


                                                    <span id="description_error"
                                                        class="error"><?php echo $errors->first('description'); ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

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

                            </div>
                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href="{{ route($modelName . '.add') }}" class="text-decoration-none"><button
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
                checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div', 'pImage');
            });

            $('#profile_image2').change(function() {
                checkImageSize('profile_image2', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image2_error_div', 'pImage2');
            });
        });
    </script>
@stop
