@extends('admin.layouts.default')
@section('content')



<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => "$modelName.questions", 'class' => 'mws-form']) }}
        {{ Form::hidden('display', 1) }}
        {{ Form::hidden('sortBy', $sortBy) }}
        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('records_per_page', $recordPerPagePagination) }}


        <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
            <div class="panel panel-col-pink">
                <div class="panel-heading" role="tab" id="panel-heading-id">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-target="#panel-collapse-id" data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true" aria-controls="panel-collapse-id" class="{{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? '' : 'collapsed' }}">
                            <i class="material-icons">search</i> Search
                            <span class="pull-right collapse-toggle-icon"></span>
                            <span>
                                {{ trans('messages.global.click_here_to_expand') }}
                            </span>
                        </a>
                    </h4>
                </div>

                <div id="panel-collapse-id" class="panel-collapse collapse {{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('question', isset($searchVariable['question']) ? $searchVariable['question'] : '', ['class' => 'form-control', 'placeholder' => trans("messages.$modelName.page_name")]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('active', ['' => trans('messages.global.please_select_status'), 0 => 'Inactive', 1 => 'Active'], isset($searchVariable['active']) ? $searchVariable['active'] : '', ['class' => 'form-control', 'data-live-search' => 'true']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                    {{ Form::select('category_id',array(''=>trans("messages.$modelName.please_select_category_id"))+$category,((isset($searchVariable['category_id'])) ? $searchVariable['category_id'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.questions") }}'><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
                    {{ trans("messages.$modelName.table_heading_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        <li>
                            <a href='{{ route("$modelName.add") }}'>
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i>
                                    {{ trans("messages.global.add_new") }}
                                </button>
                            </a>
                        </li>
                    </ul>
                </h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr role="row">
                            <th class="{{ $sortBy == 'question' && $order == 'desc' ? 'sorting_desc' : ($sortBy == 'page_name' && $order == 'asc' ? 'sorting_asc' : 'sorting') }} ">
                                {{ link_to_route(
                                        'SurveQuestionAnswer.questions',
                                        trans("messages.$modelName.question"),
                                        [
                                            'records_per_page' => $recordPerPagePagination,
                                            'sortBy' => 'question',
                                            'order' => $sortBy == 'question' && $order == 'desc' ? 'asc' : 'desc',
                                        ] + $searchVariable,
                                        [
                                            'class' =>
                                                $sortBy == 'question' && $order == 'desc'
                                                    ? 'sorting desc'
                                                    : ($sortBy == 'question' && $order == 'asc'
                                                        ? 'sorting asc'
                                                        : 'sorting'),
                                        ],
                                    ) }}

                            </th>
                            <th>{{ trans("messages.$modelName.category") }}</th>
                            <th>{{ trans("messages.global.order") }}</th>
                            <th>{{ trans("messages.global.created_at") }}</th>
                            <th class="text-center">
                                {{ trans("messages.global.status") }}
                            </th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                        @foreach ($model as $record)
                        <tr class="items-inner">
                            </td>
                            <td data-th='{{ trans("messages.$modelName.page_name") }}'>{{ $record->question }}
                            </td>

                            <td>
                                {{ Config::get('SURVE_QUESTION_CATEGORY.'.$record->category_id) }}
                            </td>

                            <td>
                                {{ $record->question_order	 }}
                            </td>
                            <td data-th='{{ trans("messages.global.created") }}'>
                                {{ CustomHelper::displayDate($record->created_at) }}

                            </td>
                            <td align="center" data-th='{{ trans("messages.global.status") }}'>
                                @if ($record->is_active == ACTIVE)
                                <span class="label label-success">{{ trans("messages.global.activated") }}</span>
                                @else
                                <span class="label label-warning">{{ trans("messages.global.deactivated") }}</span>
                                @endif
                            </td>
                            <td data-th='{{ trans("messages.global.action") }}'>
                                <div class="btn-group m-l-5 m-t-5">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ trans('messages.global.action') }} <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu  min-width-220">
                                        <li>
                                            <a href='{{ route("$modelName.edit", $record->id) }}' class="waves-effect waves-block">
                                                <i class="material-icons">mode_edit</i>{{ trans('messages.global.edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href='{{ route("$modelName.answers", "$record->id") }}' class="waves-effect waves-block"><i class="material-icons">add</i>{{ trans('messages.global.add_answer') }}</a>
                                        </li>
                                        @if ($record->is_active)
                                        <li>
                                            <a href="javascript:void(0)" data-href='{{ route("$modelName.status", [$record->id, INACTIVE]) }}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}" data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}" title="<?php echo trans('messages.global.mark_as_inactive'); ?>">
                                                <i class="material-icons">do_not_disturb</i><?php echo trans('messages.global.inactive'); ?>
                                            </a>
                                        </li>
                                        @else
                                        <li>
                                            <a href="javascript:void(0)" data-href='{{ route("$modelName.status", [$record->id, ACTIVE]) }}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}" data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}" title="<?php echo trans('messages.global.mark_as_active'); ?>">
                                                <i class="material-icons">verified_user</i><?php echo trans('messages.global.active'); ?>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" width="100%" colspan="5">
                                {{ trans('messages.global.no_record_found_message') }}
                            </td>
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

<!-- #END# Hover Rows -->
@stop