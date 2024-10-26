@extends('admin.layouts.default')
@section('content')


@section('breadcrumbs')
	{{ Breadcrumbs::render('job-add') }}
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

                        <div class="mt-20">
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('title', trans("messages.global.title") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('title', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('title'); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('Department', trans("messages.global.department") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('department', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('department'); ?>
                                        </span>
                                    </div>
                                </div>

                            </div>
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('job_type', trans("messages.global.job_type").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::select('job_type',array(''=>trans("messages.global.please_select_job_type"))+$jobTypeList,null, ['class' => 'form-control show-tick','id'=>'job_type','data-live-search'=>"true"]) }}
										</div>
										<span class="error help-inline">
											{{ $errors->first('job_type') }}
										</span>
									</div>
								</div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('experience', trans("messages.global.experience") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::select('experience',array(''=>trans("messages.global.please_select_experience"))+$experienceList,null, ['class' => 'form-control show-tick','id'=>'experience','data-live-search'=>"true"]) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('experience'); ?>
                                        </span>
                                    </div>
                                </div>


                            </div>
							<div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('location', trans("messages.global.location") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('location', '', ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('location'); ?>
                                        </span>
                                    </div>
                                </div>

                            </div>

							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{ Form::label('job_responsibilities', trans("messages.global.job_responsibilities") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
											{{ Form::textarea('job_responsibilities', '', ['class' => 'form-control ', 'id' => 'job_responsibilities']) }}
											  <script>
												$(function() {
													CKEDITOR.replace('job_responsibilities', {
														filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth: '640',
														filebrowserImageWindowHeight: '480',
														height: 450,
														enterMode: CKEDITOR.ENTER_BR
													});
												});
											</script>
										</div>
										<span id="job_responsibilities_error"
											class="error"><?php echo $errors->first('job_responsibilities'); ?></span>
									</div>
								</div>
							</div>

							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											{{ Form::label('qualification', trans("messages.global.qualification") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
											{{ Form::textarea('qualification', '', ['class' => 'form-control ', 'id' => 'qualification']) }}
											 <script>
												$(function() {
													CKEDITOR.replace('qualification', {
														filebrowserUploadUrl: '<?php echo URL::to('base/uploder'); ?>',
														filebrowserImageWindowWidth: '640',
														filebrowserImageWindowHeight: '480',
														height: 450,
														enterMode: CKEDITOR.ENTER_BR
													});
												});
											</script>
										</div>
										<span id="qualification_error"
											class="error"><?php echo $errors->first('qualification'); ?></span>
									</div>
								</div>
							</div>

                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>{{ trans('messages.global.save') }}</button>
                                <a href="{{ route($modelName . '.add') }}" class="text-decoration-none">
									<button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button>
								</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
