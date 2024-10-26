@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
    {{ Breadcrumbs::render('university-loan-partners', $universityName, $id) }}
@stop

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
                                        {{ Form::text('loan_partner', isset($searchVariable['loan_partner']) ? $searchVariable['loan_partner'] : '', ['class' => 'form-control', 'placeholder' => trans('messages.global.filter_by_loan_partner')]) }}

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
                    {{ $universityName . '->' . trans("messages.$modelName.table_heading_loan_partner_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        <li>
                            <a href='{{ route('University.index') }}'>
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">arrow_back</i>
                                    {{ trans('messages.global.back') }}
                                </button>
                            </a>
                            <a href='{{ route('University.add_loan_partners', $id) }}'>
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i>
                                    {{ trans('messages.global.add_loan_partner') }}
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
                            <th> {{ trans('messages.global.loan_partner_name') }} </th>
                            <th> {{ trans('messages.global.image') }} </th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">
                                    <td data-th='{{ trans('messages.global.campus_name') }}'>
                                        {{ $record->loan_partner }}
                                    </td>
                                    <td data-th='{{ trans('messages.global.image') }}'>
                                        <a class="items-image" data-lightbox="roadtrip<?php echo $record->image; ?>" href="<?php echo LOAN_PARTNER_IMAGE_URL . $record->image; ?>">
                                            {!! CustomHelper::showImage(LOAN_PARTNER_IMAGE_ROOT_PATH, LOAN_PARTNER_IMAGE_URL, $record->image, '', [
                                            'alt' => $record->image,
                                            'height' => '70',
                                            'width' => '70',
                                            'zc' => 1,
                                            ]) !!}
                                        </a>
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
                                                        data-href='{{ route("$modelName.deleteLoanPartner", [$record->id,$id]) }}'
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
                                <td align="center" width="100%" colspan="3">
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
