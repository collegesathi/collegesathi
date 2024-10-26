@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('customer-view') }}
@stop

@section('content')
    <div class="container-fluid" id="main-container">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ trans("messages.$customerModel.table_heading_view") }}
                        </h2>
                        <ul class="header-dropdown m-r--5 btn-right-top-margin">
                            <li>
                                <a href='{{ route("$customerModel.index") }}'>
                                    <button type="button" class="btn bg-indigo waves-effect"><i
                                            class="material-icons font-14">keyboard_backspace</i>{{ trans('messages.global.back') }}</button>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered table-striped table-hover ">
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.profile_image") }}</th>
                                <td data-th='{{ trans("messages.$modelName.profile_image") }}'>
                                    @php  echo CustomHelper::showUserImage(USER_PROFILE_IMAGE_ROOT_PATH, USER_PROFILE_IMAGE_URL,  $userDetails->image,  $userDetails->gender, ['alt' => $userDetails->full_name, 'height' =>'60', 'width' =>'60', 'zc' => 1]);  @endphp
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.first_name") }}</th>
                                <td data-th='{{ trans("messages.$modelName.first_name") }}'>
                                    {{ isset($userDetails->first_name) ? ucfirst($userDetails->first_name) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.last_name") }}</th>
                                <td data-th='{{ trans("messages.$modelName.last_name") }}'>
                                    {{ isset($userDetails->last_name) ? $userDetails->last_name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.email") }}</th>
                                <td data-th='{{ trans("messages.$modelName.email") }}'><a
                                        href="mailTo:{{ $userDetails->email }}"
                                        class="redicon">{{ $userDetails->email }}</a></td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.phone") }}</th>
                                <td data-th='{{ trans("messages.$modelName.phone") }}'>
                                    {{ isset($userDetails->phone) ? $userDetails->phone : 'N/A' }}</td>
                            </tr>

                            @php
                            /*

                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.country") }}</th>
                                <td data-th='{{ trans("messages.$modelName.country") }}'>
                                    {{ isset($userDetails->countryName->country_name) ? $userDetails->countryName->country_name : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.state") }}</th>
                                <td data-th='{{ trans("messages.$modelName.state") }}'>
                                    {{ isset($userDetails->stateName->state_name) ? $userDetails->stateName->state_name : 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.city") }}</th>
                                <td data-th='{{ trans("messages.$modelName.city") }}'>
                                    {{ isset($userDetails->cityName->city_name) ? $userDetails->cityName->city_name : 'N/A' }}
                                </td>
                            </tr>

                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.address_one") }}</th>
                                <td data-th='{{ trans("messages.$modelName.address_one") }}'>
                                    {{ isset($userDetails->address_one) ? $userDetails->address_one : 'N/A' }}</td>
                            </tr>
*/
@endphp
                            <tr>
                                <th class="text-right" width="30%">{{ trans("messages.$modelName.created_on") }}</th>
                                <td data-th='{{ trans("messages.$modelName.created_on") }}'>
                                    {{ CustomHelper::displayDate($userDetails->created_at) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
