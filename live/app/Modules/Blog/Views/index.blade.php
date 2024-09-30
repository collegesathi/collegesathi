@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
    {{ Breadcrumbs::render('blog-list') }}
@stop

<script type="text/javascript">
    var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>
{{ HTML::script('js/admin/multiple_delete.js') }}


<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


        @if ($universityBlog)
        {{ Form::open(['method' => 'get', 'role' => 'form', 'url' =>  route("UniversityBlog.index","$uni_id"), 'class' => 'mws-form']) }}
        @else
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => "$modelName.index", 'class' => 'mws-form']) }}
       @endif


        {{ Form::hidden('display', 1) }}
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
                    role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true" style="">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('title', isset($searchVariable['title']) ? $searchVariable['title'] : '', ['class' => 'form-control', 'placeholder' => trans("messages.$modelName.title")]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('is_active', ['' => trans('messages.global.please_select_status'), 0 => 'Inactive', 1 => 'Active'], isset($searchVariable['is_active']) ? $searchVariable['is_active'] : '', ['class' => 'form-control', 'data-live-search' => 'true']) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>


                             @if ($universityBlog)

                                <a href='{{ route("UniversityBlog.index",$uni_id) }}'><button type="button"
                                        class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                             @else

                             <a href='{{ route("$modelName.index") }}'><button type="button"
                                class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i
                                    class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>

                             @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">

                        <li>
                            @if ($universityBlog)
                                <a href='{{ route("University.index")}}' >
                                    <button type="button" class="btn bg-indigo waves-effect">
                                        <i class="material-icons font-14">keyboard_backspace</i> {{ trans("messages.global.back") }}
                                    </button>
                                </a>
                                <a href='{{ route('UniversityBlog.add', $uni_id) }}'>
                                    <button type="button" class="btn bg-indigo waves-effect">
                                        <i class="material-icons font-14">add</i>
                                        {{ trans("messages.$modelName.add_new") }}
                                    </button>
                                </a>
                            @else
                                <a href='{{ route("$modelName.add") }}'>
                                    <button type="button" class="btn bg-indigo waves-effect">
                                        <i class="material-icons font-14">add</i>
                                        {{ trans("messages.$modelName.add_new") }}
                                    </button>
                                </a>
                            @endif
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
                    <div class="col-sm-3 pull-right">
                        <div class="form-group">
                            <div class="form-line">
                                <?php
                                $actionTypes = [
                                    'inactive' => trans('messages.global.mark_as_inactive'),
                                    'active' => trans('messages.global.mark_as_active'),
                                ];
                                ?>
                                {{ Form::open() }}
                                {{ Form::select('action_type', ['' => trans('messages.global.select_action')] + $actionTypes, $actionTypes, ['class' => 'deleteall selectUserAction form-control', 'data-live-search' => 'true']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr role="row">
                            @if (!$result->isEmpty())
                                <th>{{ Form::checkbox('is_checked', '', null, ['class' => 'left checkAllUser filled-in', 'id' => 'remember_me']) }}
                                    <label for="remember_me" class="table_checkbox"></label>
                                </th>
                            @endIf


                            <th>
                                {{ link_to_route("$modelName.index", trans("messages.$modelName.title"), ['records_per_page' => $recordPerPage, 'sortBy' => 'title', 'order' => $sortBy == 'title' && $order == 'desc' ? 'asc' : 'desc'] + $searchVariable, ['class' => $sortBy == 'title' && $order == 'desc' ? 'sorting desc' : ($sortBy == 'title' && $order == 'asc' ? 'sorting asc' : 'sorting')]) }}
                            </th>

                            <th>
                                {{ trans('messages.global.status') }}
                            </th>
                            @if (!$universityBlog)
                                <th>
                                    {{ trans('messages.global.featured') }}
                                </th>
                            @endif
                            <th>
                                {{ link_to_route("$modelName.index", trans('messages.global.created_on'), ['records_per_page' => $recordPerPage, 'sortBy' => 'created_at', 'order' => $sortBy == 'created_at' && $order == 'desc' ? 'asc' : 'desc'] + $searchVariable, ['class' => $sortBy == 'created_at' && $order == 'desc' ? 'sorting desc' : ($sortBy == 'created_at' && $order == 'asc' ? 'sorting asc' : 'sorting')]) }}
                            </th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$result->isEmpty())
                            @foreach ($result as $record)
                                <tr class="items-inner">
                                    <td data-th='{{ trans('messages.global.select') }}'>
                                        {{ Form::checkbox('status', $record->id, null, ['class' => 'userCheckBox filled-in', 'id' => 'selected_all_' . $record->id]) }}
                                        <label for="selected_all_{{ $record->id }}"></label>
                                    </td>

                                    <td data-th='{{ trans("messages.$modelName.title") }}'>
                                        {{ isset($record->title) ? $record->title : 'N/A' }}</td>




                                    <td data-th='{{ trans('messages.global.status') }}'>
                                        @if ($record->is_active == ACTIVE)
                                            <span
                                                class="label label-success">{{ trans('messages.global.activated') }}</span>
                                        @else
                                            <span
                                                class="label label-warning">{{ trans('messages.global.inactive') }}</span>
                                        @endif
                                        <br>

                                    </td>

                                    @if (!$universityBlog)
                                        <td data-th='{{ trans('messages.global.featured') }}'>

                                            @if ($record->is_featured == ACTIVE)
                                                <span
                                                    class="label label-success">{{ trans('messages.global.yes') }}</span>
                                                <br>
                                            @else
                                                <span
                                                    class="label label-warning">{{ trans('messages.global.no') }}</span>
                                                <br>
                                            @endif

                                        </td>
                                    @endif

                                    <td data-th="{{ trans('messages.global.created_on') }}">
                                        {{ CustomHelper::displayDate($record->created_at) }}
                                    </td>
                                    <td data-th="{{ trans('messages.global.action') }}">

                                        <div class="btn-group m-l-5 m-t-5">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">{{ trans('messages.global.action') }} <span
                                                    class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu  min-width-220">

                                                @if ($universityBlog)
                                                    <li>
                                                        <a href='{{ route("UniversityBlog.edit", [$record->id,$uni_id]) }}'
                                                            class="waves-effect waves-block">
                                                            <i class="material-icons">mode_edit</i><?php echo trans('messages.global.edit'); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href='{{ route("UniversityBlog.view",[$record->id,$uni_id]) }}'
                                                            class="waves-effect waves-block">
                                                            <i
                                                                class="material-icons">find_in_page</i><?php echo trans('messages.global.view'); ?>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a data-href='{{ route("UniversityBlog.delete", [$record->id,$uni_id]) }}'
                                                            class="confirm_box waves-effect waves-block"
                                                            data-confirm-message="{{ trans('messages.admin.system.you_want_to_delete_this_blog') }}"
                                                            data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                            <i class="material-icons">delete_sweep</i>
                                                            {{ trans('messages.global.delete') }}
                                                        </a>
                                                    </li>

                                                    @if ($record->is_active)
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("UniversityBlog.status", [$record->id, INACTIVE,$uni_id]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">block</i>{{ trans('messages.global.mark_as_inactive') }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("UniversityBlog.status", [$record->id, ACTIVE,$uni_id]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">done</i>{{ trans('messages.global.mark_as_active') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li>
                                                        <a href='{{ route("$modelName.edit", $record->id) }}'
                                                            class="waves-effect waves-block">
                                                            <i class="material-icons">mode_edit</i><?php echo trans('messages.global.edit'); ?>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href='{{ route("$modelName.view", "$record->id") }}'
                                                            class="waves-effect waves-block">
                                                            <i
                                                                class="material-icons">find_in_page</i><?php echo trans('messages.global.view'); ?>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a data-href='{{ route("$modelName.delete", "$record->id") }}'
                                                            class="confirm_box waves-effect waves-block"
                                                            data-confirm-message="{{ trans('messages.admin.system.you_want_to_delete_this_blog') }}"
                                                            data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                            <i class="material-icons">delete_sweep</i>
                                                            {{ trans('messages.global.delete') }}
                                                        </a>
                                                    </li>

                                                    @if ($record->is_active)
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("$modelName.status", [$record->id, INACTIVE]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">block</i>{{ trans('messages.global.mark_as_inactive') }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("$modelName.status", [$record->id, ACTIVE]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">done</i>{{ trans('messages.global.mark_as_active') }}
                                                            </a>
                                                        </li>
                                                    @endif

                                                    @if ($record->is_featured)
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("$modelName.featured", [$record->id, INACTIVE]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">block</i>{{ trans('messages.global.mark_as_not_featured') }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="confirm_box waves-effect waves-block"
                                                                data-href='{{ route("$modelName.featured", [$record->id, ACTIVE]) }}'
                                                                class="text-decoration-none confirm_box"
                                                                data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                                data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                                                                <i
                                                                    class="material-icons">done</i>{{ trans('messages.global.mark_as_featured') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif


                                            </ul>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td align="center" width="100%" colspan="6">
                                    {{ trans('messages.global.no_record_found_message') }} </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    @include('pagination.default', [
                        'paginator' => $result,
                        'searchVariable' => $searchVariable,
                    ])
                </div>

            </div>
        </div>
    </div>
</div>





@stop
