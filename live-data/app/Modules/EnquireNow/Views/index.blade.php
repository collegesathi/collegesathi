@extends('admin.layouts.default')
@section('content')

<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => ["$modelName.index"], 'class' => 'mws-form']) }}
        {{ Form::hidden('display', 1) }}
        {{ Form::hidden('sortBy', $sortBy) }}
        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('records_per_page', $recordPerPagePagination) }}

        <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
            <div class="panel panel-col-pink">
                <div class="panel-heading" role="tab" id="panel-heading-id">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-target="#panel-collapse-id"
                            data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true"
                            aria-controls="panel-collapse-id"
                            class="{{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? '' : 'collapsed' }}">
                            <i class="material-icons">search</i> Search
                            <span class="pull-right collapse-toggle-icon"></span>
                            <span>
                                {{ trans('messages.global.click_here_to_expand') }}
                            </span>
                        </a>
                    </h4>
                </div>

                <div id="panel-collapse-id"
                    class="panel-collapse collapse {{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? 'in' : '' }}"
                    role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('full_name', isset($searchVariable['full_name']) ? $searchVariable['full_name'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_full_name')]) }}

                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.index") }}'><button type="button"
                                        class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ trans("messages.$modelName.table_heading_career_index") }}
                </h2>
            </div>
            <div class="body table-responsive">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            @include('admin.elements.admin_paging_dropdown')
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr role="row">
                            <th> {{ trans('messages.global.full_name') }} </th>
                            <th>{{ trans('messages.global.email') }}</th>
                            <th> {{ trans('messages.global.dob') }} </th>
                            <th> {{ trans('messages.global.gender') }} </th>
                            <th>{{ trans("messages.global.phone") }}</th>
                            <th> {{ trans('messages.global.country') }} </th>
                            <th> {{ trans('messages.global.state') }} </th>
                            <th> {{ trans('messages.global.city') }} </th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">
                                    <td data-th="{{ trans('messages.global.full_name') }}">{{ $record->full_name }}</td>
                                    <td data-th="{{ trans('messages.global.email') }}">{{ $record->email }}</td>
                                    <td data-th="{{ trans('messages.global.dob') }}">{{ $record->dob }}</td>
                                    <td data-th="{{ trans('messages.global.gender') }}">{{ Config::get('GENDER.'.$record->gender) }}</td>
                                    <td data-th="{{ trans('messages.global.phone') }}">{{ $record->phone_number_with_dial_code }}</td>
                                    <td data-th="{{ trans('messages.global.country') }}">{{ $record->countryName->country_name }}</td>
                                    <td data-th="{{ trans('messages.global.state') }}">{{ $record->stateName->state_name }}</td>
                                    <td data-th="{{ trans('messages.global.city') }}">{{ $record->cityName->city_name }}</td>
                                    <td data-th="created:">{{ $record->created_at }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td align="center" width="100%" colspan="8">
                                    {{ trans('messages.global.no_record_found_message') }} </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    @include('pagination.default', [
                        'paginator' => $model,
                        'searchVariable' => $searchVariable,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>





@stop