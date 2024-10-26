@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('country-add') }}
@stop

@section('content')
    <style>
        .margin_left {
            margin-left: 156px !important;
        }

    </style>


    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans('messages.Country.table_heading_add') }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href="{{ route('Country.index') }}">
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form', 'route' => array('Country.save'), 'class' => 'mws-form']) }}

                        <div class="mt-20">

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_name', trans('messages.Country.country_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_name', null, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_name'); ?>
                                        </span>
                                    </div>
                                </div>
                             
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_iso_code', trans('messages.Country.country_iso_code') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_iso_code', null, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_iso_code'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_code', trans('messages.Country.country_code') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('country_code', null, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_code'); ?>
                                        </span>
                                    </div>
                                </div> 
                            </div>
                             
							
							 

                            {{-- <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{  Form::label('country_order', trans("messages.Country.country_order").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
									   {{ Form::text('country_order',null, ['class' => 'form-control']) }}
									</div>
								</div>
                            </div>
                        </div> --}}
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_status', trans('messages.global.status') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::select('country_status', ['' => trans('messages.global.please_select_status'), ACTIVE => 'Active', INACTIVE => 'Inactive'], null, ['class' => 'form-control autocomplete', 'data-live-search' => 'true']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_status'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href="{{ route('Country.add') }}" class="text-decoration-none"><button type="button"
                                        class="btn bg-blue-grey btn-sm waves-effect"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
