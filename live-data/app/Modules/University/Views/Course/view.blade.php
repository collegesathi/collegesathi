@extends('admin.layouts.default')
@section('content')

@section('breadcrumbs')
{{ Breadcrumbs::render('course_view', $uni_id) }}
@stop

<div class="container-fluid" id="main-container">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_view") }}

                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.listCourse", $uni_id)}}'>
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-striped table-hover ">
                        <tr>
                            <th class="text-center" width="30%">{{ trans("Image") }}</th>
                            <td>
                                @if ($course['image'] != '' && File::exists(COURSE_IMAGE_ROOT_PATH . $course['image']))
                                <a class="items-image" data-lightbox="roadtrip<?php echo $course['image']; ?>" href="<?php echo COURSE_IMAGE_URL . $course['image']; ?>">
                                    {!! CustomHelper::showImage(COURSE_IMAGE_ROOT_PATH, COURSE_IMAGE_URL, $course['image'], '', ['alt' => $course['image'], 'height' => '70', 'width' => '200', 'zc' => 1]) !!}
                                </a>
                                @else
                                {{ 'No Image' }}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.certificate_image") }}</th>
                            <td>
                                @if ($course['course_certificate_image'] != '' && File::exists(COURSE_CERTIFICATE_IMAGE_ROOT_PATH . $course['course_certificate_image']))
                                <a class="items-image" data-lightbox="roadtrip<?php echo $course['course_certificate_image']; ?>" href="<?php echo COURSE_CERTIFICATE_IMAGE_URL . $course['course_certificate_image']; ?>">
                                    {!! CustomHelper::showImage(COURSE_CERTIFICATE_IMAGE_ROOT_PATH, COURSE_CERTIFICATE_IMAGE_URL, $course['course_certificate_image'], '', ['alt' => $course['course_certificate_image'], 'height' => '70', 'width' => '200', 'zc' => 1]) !!}
                                </a>
                                @else
                                {{ 'No Image' }}
                                @endif

                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans("Name") }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['name'] }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.per_semester_fee') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['per_semester_fee'] }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.total_fee') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['total_fee'] }}</p>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.one_time_fee') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['one_time_fee'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.tag_line') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['tag_line'] }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.number_of_semesters') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['number_of_semesters'] ?? 'N/A' }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.about_course') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['about_course'] ?? 'N/A' }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.admission_process') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['admission_process'] ?? 'N/A' }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.eligibility_criteria') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['eligibility_criteria'] ?? 'N/A' }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans('messages.global.exam_pattern') }}</th>
                            <td>
                                <p class="description_maintain"> {{ $course['exam_pattern'] ?? 'N/A' }}</p>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
                            <td>
                                @if($course['active'] == ACTIVE)
                                <span class="label label-success">{{ trans("messages.global.activated") }}</span>
                                @else
                                <span class="label label-warning">{{ trans("messages.global.inactive") }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
                            <td>
                                <p class="description_maintain">{{ isset($course['created_at']) ?  CustomHelper::displayDate($course['created_at']) : 'N/A' }}</p>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop