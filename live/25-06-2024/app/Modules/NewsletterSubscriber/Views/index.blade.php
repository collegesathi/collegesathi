@extends('admin.layouts.default')


@section('breadcrumbs')
	{{ Breadcrumbs::render('news-letter-subscribers') }}
@stop

@section('content')
    {{ HTML::script('js/admin/bootstrap-modal.min.js') }}
    {{ HTML::style('css/admin/bootmodel.css') }}

    @php
    $search_start_date = isset($searchVariable['user_start_date']) ? $searchVariable['user_start_date'] : '';
    $search_end_date = isset($searchVariable['user_end_date']) ? $searchVariable['user_end_date'] : '';
    $date_range_picker = !empty($date_range_picker) ? $date_range_picker : '';

    @endphp



    <!-- Search Panel -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => "$modelName.index", 'class' => 'mws-form']) }}

            {{ Form::hidden('display',1) }}
		    {{ Form::hidden('sortBy', $sortBy) }}
		    {{ Form::hidden('order', $order) }}
		    {{ Form::hidden('records_per_page', $recordPerPage) }}

            <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
                <div class="panel panel-col-pink">
                    <div class="panel-heading" role="tab" id="panel-heading-id">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-target="#panel-collapse-id"
                                data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true"
                                aria-controls="panel-collapse-id"
                                class="{{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? '' : 'collapsed' }}">
                                <i class="material-icons">search</i> Search
                                <span class="pull-right collapse-toggle-icon"></span>
                                <span>
                                    {{ trans('messages.global.click_here_to_expand') }}
                                </span>
                            </a>
                        </h4>
                    </div>
                    <div id="panel-collapse-id"
                        class="panel-collapse collapse {{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? 'in' : '' }}"
                        role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true" style="">
                        <div class="panel-body">
                            <div class="row clearfix ">
                                <!-- Search by Date Range -->

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            {{ Form::text('email', isset($searchVariable['email']) ? $searchVariable['email'] : '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => trans('messages.global.email')]) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                    <div class="form-group">
                                       <div class="form-line">
                                          {{ Form::text('date_range_picker', $date_range_picker, ['id' => 'date_range_picker', 'readonly', 'class' => 'form-control', 'placeholder' => trans('messages.global.date_range')]) }}

                                          {{ Form::hidden('user_start_date', $search_start_date, array('id' => 'start_date')) }}
                                          {{ Form::hidden('user_end_date', $search_end_date, array('id' => 'end_date')) }}

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
    <!-- Search Panel -->

    <!-- Hover Rows -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_index") }}


                        <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">


                            @php

                               $queryStringArray = Request::query();
                               $queryStringArray['display'] = ACTIVE;
                               $queryStringArray['download_csv'] = ACTIVE;

                            @endphp

                            <li>
                               <a href='{{ route("$modelName.index", $queryStringArray) }}'>
                                  <button type="button" class="btn bg-pink waves-effect"> <i
                                          class="material-icons font-14">file_download</i>{{ trans('messages.global.export_csv') }}
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

                                <th
                                    class="{{ $sortBy == 'email' && $order == 'desc' ? 'sorting_desc' : ($sortBy == 'created_at' && $order == 'asc' ? 'sorting_asc' : 'sorting') }}">
                                    {{ link_to_route("$modelName.index", trans("messages.$modelName.email"), ['records_per_page' => $recordPerPage, 'sortBy' => 'email', 'order' => $sortBy == 'email' && $order == 'desc' ? 'asc' : 'desc'], ['class' => $sortBy == 'email' && $order == 'desc' ? 'sorting desc' : ($sortBy == 'email' && $order == 'asc' ? 'sorting asc' : 'sorting')]) }}
                                </th>

                                <th
                                    class="{{ $sortBy == 'created_at' && $order == 'desc' ? 'sorting_desc' : ($sortBy == 'created_at' && $order == 'asc' ? 'sorting_asc' : 'sorting') }}">
                                    {{ link_to_route("$modelName.index", trans("messages.$modelName.created_at"), ['records_per_page' => $recordPerPage, 'sortBy' => 'created_at', 'order' => $sortBy == 'created_at' && $order == 'desc' ? 'asc' : 'desc'], ['class' => $sortBy == 'created_at' && $order == 'desc' ? 'sorting desc' : ($sortBy == 'created_at' && $order == 'asc' ? 'sorting asc' : 'sorting')]) }}
                                </th>
                                <th>{{ trans('messages.global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody id="powerwidgets">
                            @if (!$model->isEmpty())
                                @foreach ($model as $result)
                                    <tr>

                                        <td data-th='{{ trans("messages.$modelName.email") }}'>
                                            <a href="mailto::{{ $result->email }}">{{ $result->email }}</a>
                                        </td>
                                        <td data-th='{{ trans("messages.$modelName.created_at") }}'>
                                            {{ CustomHelper::displayDate($result->created_at) }}
                                        </td>
                                        <td>
                                            <a class="text-decoration-none confirm_box"
                                                data-href='{{ route("$modelName.delete", $result->id) }}'
                                                class="text-decoration-none confirm_box"
                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_delete_this_record') }}"
                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                <button type="button" class="btn btn-danger  waves-effect btn-sm"><i
                                                        class="material-icons font-14">delete_sweep</i>
                                                    {{ trans('messages.global.delete') }}</button>
                                            </a>


                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td align="center" width="100%" colspan="5">
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

{{ HTML::script('plugins/admin/momentjs/moment.js') }}
{{ HTML::script('js/daterange/daterangepicker.js') }}
{{ HTML::style('css/daterange/daterangepicker.css') }}
{{ HTML::script('js/daterange/custom_range.js') }}

<script type="text/javascript">
	var cal_date_format = '{{JS_DATE_FORMAT_FOR_DATE_SEARCH}}';

	$(document).ready(function(){
		showStartEndDateInPast('date_range_picker', 'start_date', 'end_date', cal_date_format);
	});
</script>

@stop
