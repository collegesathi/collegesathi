@extends('admin.layouts.default')
@section('content')


<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_view") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.index")}}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover ">
                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.job_title') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['job_title'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.job_type') }}</th>
                            <td>
                                <p class="description_maintain"> {{ Config::get('JOB_TYPE.' . $career['job_type']) }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.skill') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['skill'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.education') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['education'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.work_experience') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['work_experience'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.work_location') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['work_location'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.description') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $career['description'] }}</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
                            <td>
                                @if($career['is_active'] == ACTIVE)
                                <span class="label label-success">{{ trans("messages.global.activated") }}</span>
                                @else
                                <span class="label label-warning">{{ trans("messages.global.inactive") }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
                            <td>
                                <p class="description_maintain">{{ isset($career['created_at']) ?  CustomHelper::displayDate($career['created_at']) : 'N/A' }}</p>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop