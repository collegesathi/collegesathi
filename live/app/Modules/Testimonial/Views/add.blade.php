@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('testimonial-page-add') }}
@stop
<!-- CKeditor start here-->
{{ HTML::script('plugins/admin/ckeditor/ckeditor.js') }}
<!-- CKeditor ends-->

<script type="text/javascript">
    // var maxLength =   '<?php echo TESTIMONIAL_MESSAGE_LENGTH; ?>';
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
                                <a href='{{ route("UniversityTestimonial.index",$uni_id)}}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans("messages.global.back") }}</button>
                                </a>
                            @else
                                <a href='{{ route("Testimonial.index")}}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{
                                        trans("messages.global.back") }}</button>
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="body">


                    @if($universityTestimonial)
                    {{ Form::open(['role' => 'form','url' =>  route("UniversityTestimonial.save","$uni_id"),'files'=>true,'class' => 'mws-form']) }}
                    @else
                    {{ Form::open(['role' => 'form','route' => "Testimonial.save",'files'=>true,'class' => 'mws-form']) }}
                    @endif

                    {{ Form::hidden('uni_id', $uni_id, ['class' => 'form-control']) }}
                    <div class="mt-20">

                        <div class="row clearfix">
                            <div class="col-sm-12 align-center">
                                <div class="form-group add-image">
                                    <input name="image" id="profile_image" class="form-control image-input-file"
                                        type="file" />
                                    <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                        <div id="pImage">
                                            <img src="{{WEBSITE_UPLOADS_URL}}user-profile-not-available.jpeg"
                                                alt="Profile image" class="profileImage" />
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
                                                {{ Form::text("data[$i][".'client_name'."]",'', ['class' =>
                                                'form-control']) }}
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
                                                {{ Form::text("data[$i][".'designation'."]",'', ['class' =>
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
                                                {{ Form::text("data[$i][".'company'."]",'', ['class' =>
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
                                                {{ Form::text("data[$i][".'batch'."]",'', ['class' =>
                                                'form-control',]) }}
                                            </div>

                                            <span id="description_error" class="error batch">
                                                <?php echo ($i == $language_code ) ? $errors->first('batch') : ''; ?>
                                            </span>


                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {{ Form::label($i.'_linkedin_url', trans("messages.$modelName.linkedin_url").'<span
                                                    class="required"> * </span>', ['class' => 'control-label'],false) }}
                                                {{ Form::text("data[$i][".'linkedin_url'."]",'', ['class' =>
                                                'form-control',]) }}
                                            </div>

                                            <span id="description_error" class="error linkedin_url">
                                                <?php echo ($i == $language_code ) ? $errors->first('linkedin_url') : ''; ?>
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
                                                {{ Form::textarea("data[$i][".'comment'."]",'', ['class' =>
                                                'form-control
                                                testimonial_limit','id' =>
                                                'comment'.$i]) }}
                                            </div>

                                            <span id="description_error" class="error comment">
                                                <?php echo ($i == $language_code ) ? $errors->first('comment') : ''; ?>
                                            </span>
                                            {{-- <span class="max_length_comment" id="rchars{{$i}}">{{ TESTIMONIAL_MESSAGE_LENGTH }}</span> {{
                                            trans("messages.global.character_remaining") }} --}}

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
                                <a href="{{ route('UniversityTestimonial.add',$uni_id) }}" class="text-decoration-none"><button type="button"
                                        class="btn bg-blue-grey btn-sm waves-effect"><i
                                            class="material-icons font-14">refresh</i>{{
                                        trans('messages.global.reset')}}</button></a>
                            @else
                                <a href="{{ route($modelName.'.add')}}" class="text-decoration-none"><button type="button"
                                class="btn bg-blue-grey btn-sm waves-effect"><i
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


            // $('.testimonial_limit').keyup(function() {
            //     var textlen = maxLength - $(this).val().length;
            //     $('.max_length_comment').text(textlen);
            // });

        });


    </script>

@stop
