@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('country-edit') }}
@stop

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans('messages.Country.table_heading_edit') }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href="{{ route('Country.index') }}">
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form', route('Country.update', "$model->id"), 'class' => 'mws-form','files' => true]) }}
                        <div class="mt-20">


                        <div class="row clearfix">
                            <div class="col-sm-6 align-center">
                                <div class="form-group add-image">
                                    {{ Form::label('image', trans("messages.Country.image") . '<span
                                        class="required"> * </span>', ['class' => 'control-label'], false) }}

                                    <input name="image" id="profile_image" class="form-control image-input-file"
                                        type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <?php
                                            $image = Request::old('image');
                                            $image = isset($image) ? $image : $model->flag_name;
                                            ?>
                                        <div id="pImage">
                                            @if ($image != '' && File::exists(COUNTRY_FLAG_PATH . $image))
                                            <img src="{{ asset(COUNTRY_FLAG_URL . $model->flag_name, $model->flag_name) }}"
                                                class="profileImage">
                                            @else
                                            <img src='{{ asset(WEBSITE_UPLOADS_URL . '
                                                user-profile-not-available.jpeg', 'user-profile-not-available.jpeg' )
                                                }}' class="profileImage">
                                            @endif
                                        </div>
                                    </span>
                                    <br />
                                    <div>
                                        <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip"
                                            data-placement="bottom"
                                            title="{{ trans('messages.global.image_tooltip_msg', ['width' => SLIDER_IMAGE_WIDTH, 'height' => SLIDER_IMAGE_HEIGHT]) }}"
                                            class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
                                            Upload Image
                                        </a>
                                    </div>
                                    <span class="error  help-inline image_error image" id="image_error_div">
                                        <?php echo $errors->first('image'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_name', trans('messages.Country.country_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_name', $model->country_name, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_iso_code', trans('messages.Country.country_iso_code') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_iso_code', $model->country_iso_code, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_iso_code'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_code', trans('messages.Country.country_code') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_code', $model->country_code, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_code'); ?>
                                        </span>
                                    </div>
                                </div>

                                 
                            </div>

                            
 

                            {{-- <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('country_order', trans("messages.Country.country_order").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
									   {{ Form::text('country_order',$model->country_order, ['class' => 'form-control']) }}
									</div>
								</div>
                            </div>
                        </div> --}}




                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href="{{ route('Country.edit', $model->id) }}" class="text-decoration-none"><button
                                        type="button" class="btn bg-blue-grey btn-sm waves-effect"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            </div>
                        </div>
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
