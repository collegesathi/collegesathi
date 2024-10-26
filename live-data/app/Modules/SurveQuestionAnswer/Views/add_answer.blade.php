@extends('admin.layouts.default')
@section('content')

@php
    $getQuestionDetails = CustomHelper::getQuestionDetails($question_id);
@endphp

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_add_answer") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.answers",$question_id) }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    {{ Form::open(['role' => 'form', 'route' => ["$modelName.saveAnswer",$question_id], 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}

                    {{ Form::hidden('question_slug',$getQuestionDetails->slug) }}

                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('answer', trans('messages.global.answer') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('answer', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('answer'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('answer_order', trans('messages.global.answer_order') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('answer_order', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('answer_order'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                            <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                                {{ trans('messages.global.save') }}</button>

                            <a href="{{ route($modelName . '.add') }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>



@stop