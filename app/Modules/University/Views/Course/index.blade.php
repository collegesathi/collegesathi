@extends('admin.layouts.default')
@section('content')
    {{ HTML::script('js/admin/multiple_delete.js') }}

@section('breadcrumbs')
    {{ Breadcrumbs::render('course', $univercityId) }}
@stop


@php
    if (Session::has('semester')) {
        Session::forget('semester');
    }
@endphp

<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'url' => route("$modelName.listCourse", $univercityId), 'class' => 'mws-form']) }}
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
                                        {{ Form::text('name', isset($searchVariable['name']) ? $searchVariable['name'] : '', ['class' => 'form-control', 'placeholder' => trans("messages.$modelName.name")]) }}

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
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.listCourse", $univercityId) }}'><button type="button"
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
                    {{ isset($univercityId) && !empty($univercityId) ? CustomHelper::getUniversiryNameById($univercityId) . '->' : '' }}{{ trans("messages.$modelName.table_heading_index") }}

                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        <li>
                            <a href='{{ route('University.index') }}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i
                                        class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                            </a>

                        </li>
                        <li>
                            <a href='{{ route("$modelName.add", $univercityId) }}'>
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i>
                                    {{ trans("messages.$modelName.add_new") }}
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

                            <th>{{ trans("messages.$modelName.image") }}</th>
                            <th>{{ trans('messages.global.name') }} </th>
                            <th>{{ trans('messages.global.status') }}</th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">

                                    <td data-th='{{ trans("messages.$modelName.small_image") }}'>

                                        @if ($record->image != '' && File::exists(COURSE_IMAGE_ROOT_PATH . $record->image))
                                            <a class="items-image" data-lightbox="roadtrip<?php echo $record->image; ?>"
                                                href="<?php echo COURSE_IMAGE_URL . $record->image; ?>">
                                                {!! CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $record->image, '', [
                                                    'alt' => $record->image,
                                                    'height' => '70',
                                                    'width' => '70',
                                                    'zc' => 1,
                                                ]) !!}
                                            </a>
                                        @else
                                            {{ 'No File' }}
                                        @endif
                                    </td>
                                    <td data-th='{{ trans("messages.$modelName.name") }}'>
                                        {{ $record->name }}
                                    </td>

                                    <td data-th='{{ trans('messages.global.status') }}'>
                                        @if ($record->active == 1)
                                            <span
                                                class="label label-success">{{ trans('messages.global.activated') }}</span>
                                        @else
                                            <span
                                                class="label label-warning">{{ trans('messages.global.deactivated') }}</span>
                                        @endif
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
                                                    <a href='{{ route("$modelName.edit", "$record->id") }}'
                                                        class="waves-effect waves-block">
                                                        <i class="material-icons">mode_edit</i><?php echo trans('messages.global.edit'); ?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='{{ route("$modelName.view", [$record->id, $univercityId]) }}'
                                                        class="waves-effect waves-block">
                                                        <i class="material-icons">visibility</i><?php echo trans('messages.global.view'); ?>
                                                    </a>
                                                </li>
                                                @if ($record->active)
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            data-href='{{ route("$modelName.status", [$record->id, INACTIVE, $record->univercity_id]) }}'
                                                            class=" waves-effect waves-block confirm_box"
                                                            data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                            data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}"
                                                            title="<?php echo trans('messages.global.mark_as_inactive'); ?>">
                                                            <i
                                                                class="material-icons">do_not_disturb</i><?php echo trans('messages.global.inactive'); ?>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            data-href='{{ route("$modelName.status", [$record->id, ACTIVE, $record->univercity_id]) }}'
                                                            class=" waves-effect waves-block confirm_box"
                                                            data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
                                                            data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}"
                                                            title="<?php echo trans('messages.global.mark_as_active'); ?>">
                                                            <i
                                                                class="material-icons">verified_user</i><?php echo trans('messages.global.active'); ?>
                                                        </a>
                                                    </li>
                                                @endif

                                                <li>
                                                    <a href='{{ route('CourseFaq.index', [$record->univercity_id, $record->id]) }}'
                                                        class="waves-effect waves-block">
                                                        <i class="material-icons">list</i><?php echo trans('messages.global.faq'); ?>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href='{{ route("$modelName.semester", [$record->univercity_id, $record->id]) }}'
                                                        class="waves-effect waves-block">
                                                        <i class="material-icons">mode_edit</i><?php echo trans('messages.global.semester'); ?>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href='{{ route("$modelName.loanAndEmi", $record->id) }}'
                                                        class="waves-effect waves-block">
                                                        <i class="material-icons">real_estate_agent</i><?php echo trans('messages.global.loan_and_emi'); ?>
                                                    </a>
                                                </li>

                                                @if ($record->getCourseSpecificationDetails->isNotEmpty())
                                                    @foreach ($record->getCourseSpecificationDetails as $courseSpecifications)
                                                        <li>
                                                            <a href='{{ route("$modelName.courseSpecification", [$record->id,$univercityId,$courseSpecifications->id]) }}'
                                                                class="waves-effect waves-block">
                                                                <i class="material-icons">stars</i>{{ $courseSpecifications->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
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



@stop
