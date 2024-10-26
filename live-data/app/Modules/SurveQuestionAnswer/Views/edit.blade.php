@extends('admin.layouts.default')
@section('content')

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_edit") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.questions") }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">
                    {{ Form::model($question,['role'=>'form', 'route' => "$modelName.update", 'class'=>'mws-form', 'files'=>true]) }}

                    <input type="hidden" name="id" value="{{ $question->id }}">
                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('question', trans('messages.global.question') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('question', null, ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('question'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('category_id', trans("messages.$modelName.category_id").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                                        {{ Form::select('category_id',array(''=>trans("messages.$modelName.please_select_category_id"))+$category,null, ['class' => 'form-control show-tick','id'=>'category_id','data-live-search'=>"true"]) }}
                                    </div>
                                    <span class="error help-inline">
                                        {{ $errors->first('category_id') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('question_order', trans('messages.global.order') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('question_order', null, ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('question_order'); ?>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div>
                                    {{ Form::label('is_course_question', trans("messages.$modelName.is_course_question") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    <div class="form-check">
                                        @php
                                        $checked = '';
                                        $checked = isset($question->is_course_question) && ($question->is_course_question == 1) ? 'checked' : '';
                                        @endphp
                                        <div class="col-sm-6">
                                            <input class="form-check-input" type="checkbox" id="is_course_question" name="is_course_question" value="1" {{ $checked }}>
                                            <label class="form-check-label" for="is_course_question">{{ trans("messages.$modelName.is_course_question") }}</label>
                                        </div>
                                    </div>
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('is_course_question'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                            {{ trans('messages.global.save') }}</button>

                        <a href="{{ route($modelName . '.edit', $question->id) }}" class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop