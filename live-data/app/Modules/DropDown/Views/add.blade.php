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
                        @if ($id != '' && $type == 'course')
                            <li>
                                <a href='{{ route("$modelName.courseSpecifications", [$type,$id]) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href='{{ route("$modelName.index", [$type]) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="body">
                    @if ($type == 'course' && $id != '')
                        {{ Form::open(['role' => 'form', 'url' => route("$modelName.saveSpecification", [$type,$id]), 'class' => 'mws-form', 'files' => true]) }}
                    @else
                        {{ Form::open(['role' => 'form', 'url' => route("$modelName.add", $type), 'class' => 'mws-form', 'files' => true]) }}
                    @endif

                    @include('admin.elements.multilanguage_tab')
                    <div class="mt-20">

                        @if($type == 'badges' ||  $type == 'placement_partners')
                        <div class="row clearfix">
                            <div class="col-sm-12 align-center">
                                <div class="form-group add-image">
                                    <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <div id="pImage">
                                            <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="Profile image" class="profileImage" />
                                        </div>
                                    </span>
                                    <br />
                                    <div>
                                        <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
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


                        @if (in_array($type, DROPDOWN_TYPES_FOR_DEGREE) && $id == '')
                        <div class="row clearfix">
                            <div class="col-sm-12 align-center">
                                <div class="form-group add-image">
                                    <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <div id="pImage">
                                            <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="Profile image" class="profileImage" />
                                        </div>
                                    </span>
                                    <br />
                                    <div>
                                        <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto">
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

                        <div class="tab-content">

                            @foreach ($languages as $langCode => $title)
                            <?php $i = $langCode; ?>
                            <div role="tabpanel" class="tab-pane animated {{ $i == $language_code ? 'active' : '' }} " id="{{ $i }}_div">

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label('name', trans("messages.$modelName.name") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                                {{ Form::text("data[$i][" . 'name' . ']', '', ['class' => 'form-control']) }}
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
                                                {{ Form::text("data[$i][" . 'full_name' . ']', '', ['class' => 'form-control']) }}
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
                                                        <input class="form-check-input" type="checkbox" id="show_on_footer" name="show_on_footer" value="1">
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
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            @if ($id != '' && $type == 'course')
                                <a href='{{ route("$modelName.addSpecification", [$type,$id]) }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            @else
                                <a href='{{ route("$modelName.add", "$type") }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            @endif

                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop