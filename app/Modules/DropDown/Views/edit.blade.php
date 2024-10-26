@extends('admin.layouts.default')
@section('content')
    {{ HTML::script('js/admin/testimonial.js') }}
    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $pageTitle }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            @if ($dropdown_id != '' && $type == 'course')
                                <li>
                                    <a href='{{ route("$modelName.courseSpecifications", [$type,$dropdown_id]) }}'>
                                        <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href='{{ route("$modelName.index", $type) }}'>
                                        <button type="button" class="btn bg-indigo waves-effect"><i
                                                class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                    </a>

                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="body">
                        @if ($dropdown_id != '' && $type == 'course')
                            {{ Form::open(['role' => 'form', 'url' => route("$modelName.updateSpecification", [$model->id, $type, $dropdown_id]), 'class' => 'mws-form', 'files' => true]) }}
                        @else
                            {{ Form::open(['role' => 'form', 'url' => route("$modelName.update", [$model->id, $type]), 'class' => 'mws-form', 'files' => true]) }}
                        @endif
                        <input type="hidden" value="{{ $model->id }}" name="id">
                        @include('admin.elements.multilanguage_tab')
                        <div class="mt-20">

                            @if ($dropdown_id == '')
                                @if (in_array($type, DROPDOWN_TYPES_FOR_DEGREE) || $type == 'badges' ||  $type == 'placement_partners')
                                    <div class="row clearfix">
                                        <div class="col-sm-12 align-center">
                                            <div class="form-group add-image">
                                                <input name="image" id="profile_image" class="form-control image-input-file"
                                                    type="file" />
                                                <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                                    <?php
                                                    $oldImage = Request::old('image');
                                                    $image = isset($oldImage) ? $oldImage : $model->image;
                                                    ?>
                                                    <div id="pImage">
                                                        @if ($image != '' && File::exists(DROPDOWN_IMAGE_ROOT_PATH . $image))
                                                            {{ HTML::image(DROPDOWN_IMAGE_URL . $model->image, $model->image, ['class' => 'profileImage']) }}
                                                        @else
                                                            {{ HTML::image(WEBSITE_UPLOADS_URL . 'user-profile-not-available.jpeg', 'user-profile-not-available.jpeg', [
                                                                'class' => 'profileImage',
                                                            ]) }}
                                                        @endif
                                                    </div>
                                                </span>
                                                <br />
                                                <div>
                                                    <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip"
                                                        data-placement="bottom"
                                                        title="{{ trans('messages.global.image_tooltip_msg') }}"
                                                        class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
                                                        Upload Image <span class="required">*</span>
                                                    </a>
                                                </div>
                                                <span class="error  help-inline image_error image" id="image_error_div">
                                                    <?php echo $errors->first('image'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="tab-content">

                                @foreach ($languages as $langCode => $title)
                                    <?php $i = $langCode; ?>
                                    <div role="tabpanel"
                                        class="tab-pane animated {{ $i == $language_code ? 'active' : '' }} "
                                        id="{{ $i }}_div">

                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::label('name', trans("messages.$modelName.name") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                                        {{ Form::text("data[$i][" . 'name' . ']', isset($multiLanguage[$i]['name']) ? $multiLanguage[$i]['name'] : '', ['class' => 'form-control']) }}
                                                    </div>

                                                    <span id="name_error" class="error">
                                                        <?php echo $i == $language_code ? $errors->first('name') : ''; ?>
                                                    </span>

                                                </div>
                                            </div>

                                            @if (in_array($type, ['course']))
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        {{ Form::label('full_name', trans("messages.$modelName.full_name") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                                        {{ Form::text("data[$i][" . 'full_name' . ']', isset($multiLanguage[$i]['full_name']) ? $multiLanguage[$i]['full_name'] : '', ['class' => 'form-control']) }}
                                                    </div>
                                                    <span id="full_name_error" class="error">
                                                        <?php echo $i == $language_code ? $errors->first('full_name') : ''; ?>
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if ($type == 'course')
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div>
                                                    {{ Form::label('show_on_footer', trans("messages.$modelName.show_on_footer") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                                    <div class="form-check">
                                                        <div class="col-sm-6">
                                                            @php
                                                                $checked = isset($model->show_on_footer) && ($model->show_on_footer == (int)1) ? 'checked' : '';
                                                            @endphp
                                                            <input class="form-check-input" type="checkbox" id="show_on_footer" name="show_on_footer" value="1" {{$checked}}>
                                                            <label class="form-check-label" for="show_on_footer">Show On Footer</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="error help-inline">
                                                    <?php echo $errors->first('show_on_footer'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                @if ($dropdown_id != '' && $type == 'course')
                                    <a href='{{ route("$modelName.editSpecification", [$model->id,$type,$dropdown_id]) }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                                @else
                                    <a href='{{ route("$modelName.edit", [$model->id, $type]) }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                                @endif
                                {{ Form::close() }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
