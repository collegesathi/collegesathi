@php
$getSemesterData = CustomHelper::getSemesterData($uni_id, $course_id, $i + 1, $specification_id);
@endphp

<table class="table table-bordered table-striped table-hover ">
    <thead>
        <tr role="row">
            <th width="25%"> {{ trans('messages.global.subject') }} </th>
            <th width="25%"> {{ trans('messages.global.credit_score') }} </th>
            <th width="25%"> {{ trans('messages.global.status') }} </th>
            <th width="25%"> {{ trans('messages.global.action') }} </th>

        </tr>
    </thead>  
    <tbody id="powerwidgets">
        @if (!$getSemesterData->isEmpty())
        @foreach ($getSemesterData as $semesterData)
        <tr class="items-inner">
            <td data-th="{{ trans('messages.global.subject') }}">
                {{ $semesterData->subject }}
            </td>
            <td data-th="{{ trans('messages.global.subject') }}">
                {{ $semesterData->credit_score ?? 'N/A'}}
            </td>
            <td data-th="{{ trans('messages.global.subject') }}">
                @if ($semesterData->is_active == ACTIVE)
                <span class="label label-success">{{ trans('messages.global.activated') }}</span>
                @else
                <span class="label label-warning">{{ trans('messages.global.deactivated') }}</span>
                @endif
            </td>
            <td data-th="{{ trans('messages.global.action') }}">
                <a class="text-decoration-none confirm_box" data-href='{{ route("$modelName.deleteSemester", [$semesterData->id,$semesterData->semester]) }}' class="text-decoration-none confirm_box" data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}" data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}">
                    <button type="button" class="btn btn-danger  waves-effect btn-sm" title="{{ trans('messages.global.delete') }}" data-toggle="tooltip"><i class="material-icons font-14">delete</i></button>
                </a>

                <a class="text-decoration-none view_subject_detail" data-href='javascript:void(0);' data-subject="{{ $semesterData->subject }}" data-description="{{ $semesterData->description }}" data-credit_score="{{ $semesterData->credit_score }}"><button type="button" class="btn btn-info waves-effect btn-sm" title="{{ trans('messages.global.view') }}" data-toggle="tooltip"><i class="material-icons font-14">visibility</i></button>
                </a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td align="center" width="100%" colspan="7">
                {{ trans('messages.global.no_record_found_message') }}
            </td>
        </tr>
        @endif
    </tbody>
</table>