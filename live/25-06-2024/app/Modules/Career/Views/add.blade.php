@extends('admin.layouts.default')
@section('content')

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
                    {{ Form::open(['role' => 'form', 'route' => "Career.save_career", 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}

                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('job_title', trans('messages.global.job_title') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('job_title', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('job_title'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('job_type', trans("messages.global.job_type").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::select('job_type',array(''=>trans("messages.$modelName.please_select_job_type"))+$job_type,null, ['class' => 'form-control show-tick','id'=>'job_type','data-live-search'=>"true"]) }}
                                    </div>
                                    <span class="error help-inline">
                                        {{ $errors->first('job_type') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('skill', trans('messages.global.skill') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        <span class='tooltipHelp' title="" data-html="true" data-toggle="tooltip"  data-original-title="{{ trans('messages.global.skill_help_message') }}" style="cursor:pointer;">
                                            <i class="fa fa-question-circle fa-1x"> </i>
                                            </span>
                                        {{ Form::text('skill', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('skill'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('education', trans('messages.global.education') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('education', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('education'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('work_experience', trans('messages.global.work_experience') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('work_experience', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('work_experience'); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('work_location', trans('messages.global.work_location') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('work_location', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('work_location'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('description', trans('messages.global.description') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('description', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('description'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName . '.add_career') }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop