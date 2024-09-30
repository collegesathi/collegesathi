@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('slider-page-edit') }}
@stop
<!-- Ckeditor -->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!--- ckeditor js end  here -->

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
                            @if($universitySlider)
                                <a href='{{ route("UniversitySlider.index",$uni_id)}}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans('messages.global.back') }}</button>
                                </a>
                            @else
                                <a href='{{ route("$modelName.index") }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans('messages.global.back') }}</button>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="body">

                    @if($universitySlider)
                    {{ Form::open(['role' => 'form','url' =>  route("UniversitySlider.edit",[$result->id,$uni_id]),'files'=>true,'class' => 'mws-form']) }}
                    @else
                    {{ Form::open(['role' => 'form','url' => route("$modelName.edit","$result->id"),'files'=>true,'class' => 'mws-form']) }}
                    @endif


                    @include('admin.elements.multilanguage_tab')
                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-12 align-center">
                                <div class="form-group add-image">
                                    {{ Form::label('image', trans("messages.$modelName.image") . '<span
                                        class="required"> * </span>', ['class' => 'control-label'], false) }}

                                    <input name="image" id="profile_image" class="form-control image-input-file"
                                        type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <?php
                                            $image = Request::old('image');
                                            $image = isset($image) ? $image : $result->slider_image;
                                            ?>
                                        <div id="pImage">
                                            @if ($image != '' && File::exists(SLIDER_ROOT_PATH . $image))
                                            <img src="{{ asset(SLIDER_URL . $result->slider_image, $result->slider_image) }}"
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
                                            {{-- <span class="required"> * </span> --}}
                                        </a>
                                    </div>
                                    <span class="error  help-inline image_error image" id="image_error_div">
                                        <?php echo $errors->first('image'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('order', trans("messages.$modelName.order") . '<span
                                            class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('order', $result->slider_order, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline order">
                                        <?php echo $errors->first('order'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="tab-content">

                            @foreach ($languages as $langCode => $title)
                            <?php $i = $langCode; ?>
                            <div role="tabpanel" class="tab-pane animated {{ $i == $language_code ? 'active' : '' }} "
                                id="{{ $i }}_div">
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label('slider_title', trans("messages.$modelName.slider_title")
                                                . '<span class="required"> * </span>', ['class' => 'control-label'],
                                                false) }}


                                                {{ Form::text("data[$i][" . 'slider_title' . ']',
                                                isset($multiLanguage[$i]['slider_title']) ?
                                                $multiLanguage[$i]['slider_title'] : '', ['class' => 'form-control']) }}
                                            </div>
                                            <span class="error help-inline slider_title">
                                                <?php echo $errors->first('slider_title'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label('slider_description',
                                                trans("messages.$modelName.slider_description") . '<span
                                                    class="required"> * </span>', ['class' => 'control-label'], false)
                                                }}

                                                <span class='tooltipHelp' title="" data-html="true" data-toggle="tooltip"  data-original-title="Description must not be greater than 200 characters." style="cursor:pointer;">
                                                    <i class="fa fa-question-circle fa-1x"> </i>
                                                </span>

                                                {{ Form::textarea("data[$i][" . 'slider_text' . ']',
                                                isset($multiLanguage[$i]['slider_text']) ?
                                                $multiLanguage[$i]['slider_text'] : '', ['class' => 'form-control']) }}
                                            </div>
                                            <span class="error help-inline slider_text">
                                                <?php echo $errors->first('slider_text'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('slider_url', trans("messages.$modelName.slider_url"), ['class' => 'control-label'], false) }}
                                            {{ Form::text('slider_url',  $result->slider_url, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline slider_url">
                                            <?php echo $errors->first('slider_url'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                    class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>
                            
                            @if($universitySlider)
                                <a href='{{ route("UniversitySlider.edit",[$result->id,$uni_id]) }}' class="text-decoration-none"><button
                                    type="button" class="btn bg-blue-grey btn-sm waves-effect"><i
                                        class="material-icons font-14">refresh</i>{{
                                    trans('messages.global.reset')}}</button></a>
                            @else
                                <a href='{{ route("$modelName.edit","$result->id")}}' class="text-decoration-none"><button
                                    type="button" class="btn bg-blue-grey btn-sm waves-effect"><i
                                        class="material-icons font-14">refresh</i>{{
                                    trans('messages.global.reset')}}</button></a>
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
			checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div', 'pImage');
		});
	});
</script>

@stop
