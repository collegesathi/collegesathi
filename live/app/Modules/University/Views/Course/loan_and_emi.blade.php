@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
{{-- {{ Breadcrumbs::render('course_add', $univercityId) }} --}}
@stop

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.loan_and_emi") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.listCourse", $loan_and_emi_data['univercity_id']) }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                    </ul>
                </div>

                <div class="body">
                    {{ Form::open(['role' => 'form', 'route' => ["Course.saveLoanAndEmi",$course_id], 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}

                    {{ Form::hidden('course_id', $course_id) }}
                    {{ Form::hidden('uni_id', $loan_and_emi_data['univercity_id']) }}

                    <div class="mt-20">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('semester_total_fee', trans('messages.global.semester_total_fee') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('semester_total_fee', (isset($loan_and_emi_data['semester_total_fee']) && !empty($loan_and_emi_data['semester_total_fee']) ? $loan_and_emi_data['semester_total_fee'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('semester_total_fee'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('semester_loan_amount', trans('messages.global.semester_loan_amount') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('semester_loan_amount', (isset($loan_and_emi_data['semester_loan_amount']) && !empty($loan_and_emi_data['semester_loan_amount']) ? $loan_and_emi_data['semester_loan_amount'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('semester_loan_amount'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('semester_tenure', trans('messages.global.semester_tenure') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('semester_tenure', (isset($loan_and_emi_data['semester_tenure']) && !empty($loan_and_emi_data['semester_tenure']) ? $loan_and_emi_data['semester_tenure'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('semester_tenure'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('semester_interest', trans('messages.global.semester_interest') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('semester_interest', (isset($loan_and_emi_data['semester_interest']) && !empty($loan_and_emi_data['semester_interest']) ? $loan_and_emi_data['semester_interest'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('semester_interest'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('semester_monthly_emi', trans('messages.global.semester_monthly_emi') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('semester_monthly_emi', (isset($loan_and_emi_data['semester_monthly_emi']) && !empty($loan_and_emi_data['semester_monthly_emi']) ? $loan_and_emi_data['semester_monthly_emi'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('semester_monthly_emi'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <hr style="height:3px; background-color:green;">
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('annually_total_fee', trans('messages.global.annually_total_fee') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('annually_total_fee', (isset($loan_and_emi_data['annually_total_fee']) && !empty($loan_and_emi_data['annually_total_fee']) ? $loan_and_emi_data['annually_total_fee'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('annually_total_fee'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('annually_loan_amount', trans('messages.global.annually_loan_amount') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::text('annually_loan_amount', (isset($loan_and_emi_data['annually_loan_amount']) && !empty($loan_and_emi_data['annually_loan_amount']) ? $loan_and_emi_data['annually_loan_amount'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('annually_loan_amount'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('annually_tenure', trans('messages.global.annually_tenure') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('annually_tenure', (isset($loan_and_emi_data['annually_tenure']) && !empty($loan_and_emi_data['annually_tenure']) ? $loan_and_emi_data['annually_tenure'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('annually_tenure'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('annually_interest', trans('messages.global.annually_interest') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('annually_interest', (isset($loan_and_emi_data['annually_interest']) && !empty($loan_and_emi_data['annually_interest']) ? $loan_and_emi_data['annually_interest'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('annually_interest'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('annually_monthly_emi', trans('messages.global.annually_monthly_emi') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('annually_monthly_emi', (isset($loan_and_emi_data['annually_monthly_emi']) && !empty($loan_and_emi_data['annually_monthly_emi']) ? $loan_and_emi_data['annually_monthly_emi'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('annually_monthly_emi'); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <hr style="height:3px; background-color:green;">
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('one_time_total_fee', trans('messages.global.one_time_total_fee') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('one_time_total_fee', (isset($loan_and_emi_data['one_time_total_fee']) && !empty($loan_and_emi_data['one_time_total_fee']) ? $loan_and_emi_data['one_time_total_fee'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('one_time_total_fee'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('one_time_loan_amount', trans('messages.global.one_time_loan_amount') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('one_time_loan_amount', (isset($loan_and_emi_data['one_time_loan_amount']) && !empty($loan_and_emi_data['one_time_loan_amount']) ? $loan_and_emi_data['one_time_loan_amount'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('one_time_loan_amount'); ?>
                                </span>
                            </div>
                        </div>
                    </div>



                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('one_time_tenure', trans('messages.global.one_time_tenure') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('one_time_tenure', (isset($loan_and_emi_data['one_time_tenure']) && !empty($loan_and_emi_data['one_time_tenure']) ? $loan_and_emi_data['one_time_tenure'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('one_time_tenure'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('one_time_interest', trans('messages.global.one_time_interest') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('one_time_interest', (isset($loan_and_emi_data['one_time_interest']) && !empty($loan_and_emi_data['one_time_interest']) ? $loan_and_emi_data['one_time_interest'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('one_time_interest'); ?>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::label('one_time_monthly_emi', trans('messages.global.one_time_monthly_emi') . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    {{ Form::text('one_time_monthly_emi', (isset($loan_and_emi_data['one_time_monthly_emi']) && !empty($loan_and_emi_data['one_time_monthly_emi']) ? $loan_and_emi_data['one_time_monthly_emi'] : ''), ['class' => 'form-control']) }}
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('one_time_monthly_emi'); ?>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <hr style="height:3px; background-color:green;">
                    </div>

                    <div class="row clearfix">

                        @php
                        $checked = isset($loan_and_emi_data['show_on_front']) && $loan_and_emi_data['show_on_front'] != 0 ? 'checked' : '';
                        @endphp

                        <div class="col-sm-6">
                            <div class="form-group">
                                <div>
                                    {{ Form::label('show_on_front', trans("messages.$modelName.show_on_front") . '<span class="required">  </span>', ['class' => 'control-label'], false) }}
                                    <div class="form-check">
                                        <div class="col-sm-6">
                                            <input class="form-check-input" type="checkbox" id="show_on_front" name="show_on_front" value="1" {{$checked}}>
                                            <label class="form-check-label" for="show_on_front">{{ trans("messages.$modelName.show_on_front") }}</label>
                                        </div>
                                    </div>
                                </div>
                                <span class="error help-inline">
                                    <?php echo $errors->first('show_on_front'); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i class="material-icons font-14">save</i>
                            {{ trans('messages.global.save') }}</button>

                        <a href='{{ route("$modelName.loanAndEmi", $course_id) }}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</div>


@stop