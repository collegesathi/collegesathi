@extends('admin.layouts.default')
@section('content')


<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_view_job_request") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.job_requests",[$type,$career_id])}}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover ">
                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.full_name') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $jobRequest['full_name'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.email_address') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $jobRequest['email_address'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.mobile_number') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $jobRequest['mobile_number'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.job_position') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $jobRequest['job_position'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.description') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $jobRequest['description'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.upload_cv') }}</th>
                            <td>
                                <p class="description_maintain"><a href='{{ route("$modelName.download_cv", [$jobRequest['id'],$jobRequest['upload_cv']]) }}'>{{ $jobRequest['upload_cv'] }}</a></p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
                            <td>
                                <p class="description_maintain">{{ isset($jobRequest['created_at']) ?  CustomHelper::displayDate($jobRequest['created_at']) : 'N/A' }}</p>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop