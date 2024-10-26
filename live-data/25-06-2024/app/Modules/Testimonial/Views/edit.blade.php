@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('testimonial-page-edit') }}
@stop
<!-- CKeditor start here-->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!-- CKeditor ends-->

<script type="text/javascript">
    var maxLength =   '<?php echo TESTIMONIAL_MESSAGE_LENGTH; ?>';
</script>
{{ HTML::script('js/admin/testimonial.js') }}

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
                            @if($universityTestimonial)
                            <a href='{{ route("UniversityTestimonial.index",$uni_id) }}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>
                            @else
                                <a href='{{ route("$modelName.index")}}' >
                                    <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                                </a>
                            @endif

                        </li>
                    </ul>
                </div>
                <div class="body">

                    @if($universityTestimonial)
                    {{ Form::open(['role' => 'form','url' =>  route("UniversityTestimonial.edit",[$result->id,$uni_id]),'files'=>true,'class' => 'mws-form']) }}
                    @else
                    {{ Form::open(['role' => 'form','url' => route("$modelName.edit","$result->id"),'files'=>true,'class' => 'mws-form']) }}
                    @endif


                    @include('admin.elements.multilanguage_tab')
                    <div class="mt-20">

                        <div class="row clearfix">
                            <div class="col-sm-12 align-center">
                                <div class="form-group add-image">
                                    <input name="image" id="profile_image" class="form-control image-input-file"
                                        type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <?php
									$oldImage   =   Request::old('image');
									$image      =   isset($oldImage) ? $oldImage : $result->image;
								    ?>
                                        <div id="pImage">
                                            @if($image !=''&& File::exists(TESTIMONIAL_IMAGE_ROOT_PATH.$image))
                                            {{ HTML::image( TESTIMONIAL_IMAGE_URL.$result->image, $result->image ,
                                            array("class"=>"profileImage" )) }}
                                            @else
                                            {{ HTML::image( WEBSITE_UPLOADS_URL."user-profile-not-available.jpeg",
                                            "user-profile-not-available.jpeg" , array("class"=>"profileImage" )) }}
                                            @endif
                                        </div>
                                    </span>
                                    <br />
                                    <div>
                                        <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip"
                                            data-placement="bottom"
                                            title="{{ trans('messages.global.image_tooltip_msg')}}"
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

                        <div class="tab-content">

                            @foreach($languages as $langCode => $title)

                            <?php $i = $langCode; ?>
                            <div role="tabpanel" class="tab-pane animated {{ ($i ==  $language_code ) ? 'active':'' }} "
                                id="{{ $i }}_div">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label('client_name',
                                                trans("messages.$modelName.client_name").'<span class="required"> *
                                                </span>', ['class' => 'control-label'],false) }}
                                                {{
                                                Form::text("data[$i][".'client_name'."]",isset($multiLanguage[$i]['client_name'])?$multiLanguage[$i]['client_name']:'',
                                                ['class' => 'form-control']) }}
                                            </div>
                                            <span class="error help-inline client_name">
                                                <?php echo ($i ==  $language_code ) ? $errors->first('client_name') : ''; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label($i.'_designation', trans("messages.$modelName.designation").'<span
                                                    class="required"> * </span>', ['class' => 'control-label'],false) }}
                                                {{ Form::text("data[$i][".'designation'."]",isset($multiLanguage[$i]['designation'])?$multiLanguage[$i]['designation']:'', ['class' =>
                                                'form-control',]) }}
                                            </div>
                                            <span id="description_error" class="error designation">
                                                <?php echo ($i == $language_code ) ? $errors->first('designation') : ''; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label($i.'_company', trans("messages.$modelName.company").'<span
                                                    class="required"> * </span>', ['class' => 'control-label'],false) }}
                                                {{ Form::text("data[$i][".'company'."]",isset($multiLanguage[$i]['company'])?$multiLanguage[$i]['company']:'', ['class' =>
                                                'form-control',]) }}
                                            </div>
                                            <span id="description_error" class="error company">
                                                <?php echo ($i == $language_code ) ? $errors->first('company') : ''; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label($i.'_batch', trans("messages.$modelName.batch").'<span
                                                    class="required"> * </span>', ['class' => 'control-label'],false) }}
                                                {{ Form::text("data[$i][".'batch'."]",isset($multiLanguage[$i]['batch'])?$multiLanguage[$i]['batch']:'', ['class' =>
                                                'form-control',]) }}
                                            </div>
                                            <span id="description_error" class="error batch">
                                                <?php echo ($i == $language_code ) ? $errors->first('batch') : ''; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label($i.'_body', trans("messages.$modelName.comment").'<span
                                                    class="required"> * </span>', ['class' => 'control-label'],false) }}
                                                {{
                                                Form::textarea("data[$i][".'comment'."]",isset($multiLanguage[$i]['comment'])?$multiLanguage[$i]['comment']:'',
                                                ['class' => 'form-control tesitmonial_length
                                                ','maxlength'=>TESTIMONIAL_MESSAGE_LENGTH,'id' => 'comment'.$i]) }}

                                            </div>
                                            <span id="description_error" class="error comment">
                                                <?php echo ($i == $language_code ) ? $errors->first('comment') : ''; ?>
                                            </span>
                                            <span id="rchars<?php echo $i;?>">{{ TESTIMONIAL_MESSAGE_LENGTH }}</span> {{
                                            trans("messages.global.character_remaining") }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                        <div>

                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                    class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
                            @if($universityTestimonial)
                                <a href='{{ route("UniversityTestimonial.edit",[$result->id,$uni_id]) }}' class="text-decoration-none"><button
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
                checkImageSize('profile_image', IMAGE_UPLOAD_FILE_MAX_SIZE_TWO, 'form', 'image_error_div',
                    'pImage');
            });
        });
    </script>

@stop
