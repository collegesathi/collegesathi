@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('university-page-list') }}
@stop
<script type="text/javascript">
    var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>
{{ HTML::script('js/admin/multiple_delete.js') }}
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => ["$modelName.campuses", $id], 'class' => 'mws-form']) }}
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
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('campus_name', isset($searchVariable['campus_name']) ? $searchVariable['campus_name'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_campus_name')]) }}

                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('campus_type', ['' => trans('messages.global.filter_by_campus_type')] + $campusType, isset($searchVariable['campus_type']) ? $searchVariable['campus_type'] : '', ['class' => 'form-control', 'data-live-search' => 'true', 'id' => 'campus_type']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.campuses", $id) }}'><button type="button"
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
                    {{ $universityName . ' -> ' . trans("messages.$modelName.table_heading_campus_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        <li>
                            <a href='{{ route('University.index') }}'>
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">arrow_back</i>
                                    {{ trans('messages.global.back') }}
                                </button>
                            </a>
                            <a href='javascript:void(0);' data-toggle="modal" data-target="#campusModal">
                                <button type="button" class="btn bg-indigo waves-effect campus_button">
                                    <i class="material-icons font-14">add</i>
                                    {{ trans('messages.global.add_campus') }}
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
                            <th> {{ trans('messages.global.campus_name') }} </th>
                            <th> {{ trans('messages.global.campus_type') }} </th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">
                                    <td data-th='{{ trans('messages.global.campus_name') }}'>
                                        {{ $record->campus_name }}
                                    </td>
                                    <td data-th='{{ trans('messages.global.campus_type') }}'>
                                        {{ Config::get('CAMPUS_TYPE.' . $record->campus_type) }}
                                    </td>
                                    <td data-th='{{ trans('messages.global.action') }}'>
                                        <div class="btn-group m-l-5 m-t-5">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">{{ trans('messages.global.action') }} <span
                                                    class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu  min-width-220">
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        data-href='{{ route("$modelName.deleteCampus", [$record->id, $id]) }}'
                                                        class="waves-effect waves-block confirm_box"
                                                        data-confirm-message="{{ trans('messages.admin.system.you_want_to_delete_this_record') }}"
                                                        data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                        <i class="material-icons">delete_sweep</i><?php echo trans('messages.global.delete'); ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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






<!-- Campus form modal -->
<div class="modal fade" id="campusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Campus</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['role' => 'form', 'files' => true, 'class' => 'mws-form', 'id' => 'campusForm']) }}

                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::select('campus_type', ['' => trans('messages.global.please_select_campus_type')] + $campusType, '', ['class' => 'form-control', 'data-live-search' => 'true', 'id' => 'campus_type']) }}
                            </div>
                            <span class="error error_campus_type help-inline text-danger"></span>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                {{ Form::text('campus_name', '', ['class' => 'form-control', 'placeholder' => 'Campus Name', 'id' => 'campus_name']) }}
                            </div>
                            <span class="error error_campus_name help-inline text-danger"></span>
                        </div>
                    </div>
                </div>


                {{ Form::hidden('university_id', $id, ['class' => 'form-control', 'id' => 'university_id']) }}
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
                <button type="button" class="btn btn-primary" id="campus_save">Save</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        $(document).on('click', '.campus_button',function() {
            $('.error').empty();
        });

        $(document).on('click', '#campus_save', function() {
            var campusFormRoute = '{{ route('University.saveCampus') }}';
            var formData = $("#campusForm").serialize();
            $.ajax({
                url: campusFormRoute,
                data: formData,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                beforeSend: function() {},
                success: function(data) {
                    $('.error').empty();
                    if (data.status == "success") {
                        window.location.reload();
                    } else {
                        $.each(data.errors, function(key, value) {
                            console.log(key);
                            $('.error_' + key).html(value);
                        });
                    }
                }
            });
        });

    });
</script>

@stop
