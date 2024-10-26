@extends('admin.layouts.default')
@section('content')

<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => ["$modelName.index",$type], 'class' => 'mws-form']) }}
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
                                        {{ Form::text('referee_name', isset($searchVariable['referee_name']) ? $searchVariable['referee_name'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_referee_name')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('reference_name', isset($searchVariable['reference_name']) ? $searchVariable['reference_name'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_reference_name')]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('referee_email', isset($searchVariable['referee_email']) ? $searchVariable['referee_email'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_referee_email')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('reference_email', isset($searchVariable['reference_email']) ? $searchVariable['reference_email'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_reference_email')]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('referee_phone', isset($searchVariable['referee_phone']) ? $searchVariable['referee_phone'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_referee_phone')]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('reference_phone', isset($searchVariable['reference_phone']) ? $searchVariable['reference_phone'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_reference_phone')]) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.index",$type) }}'><button type="button"
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
                    {{ trans("messages.$modelName.table_heading_referral_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        <li>
                            <a href='{{ route("Referral.index", EXPORT_TYPE) . '?' . $queryString }}'>
                                <button type="button" class="btn bg-indigo waves-effect campus_button">
                                    <i class="material-icons font-14">file_download</i>
                                    {{ trans('messages.global.export_referrals') }}
                                </button>
                            </a>
                        </li>
                    </ul>
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
                            <th> {{ trans('messages.global.referee_name') }} </th>
                            <th> {{ trans('messages.global.referee_phone') }} </th>
                            <th> {{ trans('messages.global.referee_email') }} </th>
                            <th>{{ trans('messages.global.referee_city') }}</th>

                            <th> {{ trans('messages.global.reference_name') }} </th>
                            <th> {{ trans('messages.global.reference_phone') }} </th>
                            <th> {{ trans('messages.global.reference_email') }} </th>
                            <th>{{ trans('messages.global.reference_city') }}</th>
                            <th>{{ trans('messages.global.created_at') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">
                                    <td data-th="{{ trans('messages.global.full_name') }}">
                                        {{ $record->referee_name }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.email_address') }}">
                                        {{ $record->referee_phone }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.mobile_number') }}">
                                        {{ $record->referee_email }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.mobile_number') }}">
                                        {{ $record->getRefereeCityName->city_name }}
                                    </td>

                                    <td data-th="{{ trans('messages.global.full_name') }}">
                                        {{ $record->reference_name }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.email_address') }}">
                                        {{ $record->reference_phone }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.mobile_number') }}">
                                        {{ $record->reference_email }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.mobile_number') }}">
                                        {{ $record->getReferenceCityName->city_name }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.mobile_number') }}">
                                        {{ $record->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td align="center" width="100%" colspan="9">
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
