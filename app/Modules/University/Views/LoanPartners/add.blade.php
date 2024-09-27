@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('university-add-loan-partners',$universityName,$id) }}
@stop


<style>
    .changePhotoCertificate {
        width: 234px !important;
    }
</style>

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
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    {{ Form::open(['role' => 'form', 'route' => "$modelName.save_loan_partners", 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}

                    {{ Form::hidden('university_id',$id) }}

                    <div class="mt-20">

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    {{ Form::label('image', trans('messages.global.image') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                    <div class="form-group add-image image align-center">
                                        <input name="image" id="profile_image" class="form-control image-input-file" type="file" />
                                        <span class="help-inline required profile_image" id="ContentTypeNameSpan">
                                            <div id="pImage">
                                                <img src="{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg" alt="image" class="profileImage" />
                                            </div>
                                        </span>
                                        <br />
                                        <div>
                                            <a href="javascript:void(0)" data-placement="right" data-toggle="tooltip" data-placement="bottom" title="{{ trans('messages.global.image_tooltip_msg') }}" class="btn bg-teal btn-block btn-sm waves-effect changePhoto" rel="image">
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
                        <div class="row clearfix other_document_div">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('loan_partner', trans('messages.global.loan_partner') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('loan_partner', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('loan_partner'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName . '.add') }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

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