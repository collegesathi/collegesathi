@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('city-edit', $stateData) }}
@stop

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans('messages.City.table_heading_edit') }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href="{{ route('City.index', $stateId) }}">
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>

                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ Form::open(['role' => 'form', 'url' => route('City.update', [$stateId, $cityId]), 'class' => 'mws-form']) }}
                        <div class="mt-20">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('country_name', trans('messages.Country.country_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}

                                            <div> {{ $model->countryName->country_name }}</div>

                                            
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('country_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('state_name', trans('messages.State.state_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}

                                            <div> {{ $model->stateName->state_name }}</div>

                                             
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('state_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::label('city_name', trans('messages.City.city_name') . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                            {{ Form::text('city_name', $model->city_name, ['class' => 'form-control']) }}
                                        </div>
                                        <span class="error help-inline">
                                            <?php echo $errors->first('city_name'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit"><i
                                        class="material-icons font-14">save</i>
                                    {{ trans('messages.global.save') }}</button>

                                <a href="{{ route('City.edit', [$stateId, $model->id]) }}"
                                    class="text-decoration-none"><button type="button"
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