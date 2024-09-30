@extends('layouts.default')
@section('content')
{{ HTML::style(WEBSITE_CSS_URL . 'jquery.raty.css') }}
{{ HTML::script(WEBSITE_JS_URL . 'jquery.raty.js') }}
<?php
$firstUniversityCompusesLocation = CustomHelper::getUniversityCampuses($universityOne['get_all_university_details']['id'], INDIAN_CAMPUS);
$secondUniversityCompusesLocation = CustomHelper::getUniversityCampuses($universityTwo['get_all_university_details']['id'], INDIAN_CAMPUS);
?>
<div class="compare-page">
    <div class="container">
        <table class="table  box_shadow">
            <thead>
                <tr>
                    <th>{{ trans('front_messages.glabal.universities') }}</th>
                    @foreach ($data as $key => $value)
                    <td>

                        <div class="course_details card flex-grow-1">
                            <a href="javascript:void(0);" class="remove-btn" data-university_id="{{ $value['univercity_id'] }}" data-type="remove" data-course_id="{{ $value['course_id'] }}" data-page="compare"><img src="{{ WEBSITE_IMG_URL }}close.svg" alt="Img"></a>
                            <div class="otheruniversities_img">
                                <figure>
                                    <?php
                                    echo $image = CustomHelper::showImage(UNIVERSITY_IMAGE_ROOT_PATH, UNIVERSITY_IMAGE_URL, $value['get_all_university_details']['image'], '', ['alt' => $value['get_all_university_details']['image'], 'height' => '43', 'width' => '120', 'zc' => 2]);
                                    ?>
                                </figure>
                            </div>
                            <div class="card-body text-center">
                                <h5>{{ $value['get_all_university_details']['title'] }}</h5>
                            </div>
                        </div>

                    </td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr class="tableHeading">
                    <th class="text-center" colspan="3">{{ trans('front_messages.glabal.about') }}</th>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.rank_nirf') }}</th>
                    <td data-content="Rank (NIRF)">{{ $universityOne['get_all_university_details']['nirf_ranking'] }}
                    </td>
                    <td data-content="Rank (NIRF)">{{ $universityTwo['get_all_university_details']['nirf_ranking'] }}
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.approvals') }}</th>
                    <td data-content="Approvals">
                        @foreach (explode(',', $universityOne['get_all_university_details']['university_badges']['university_badges_id']) as $badges)
                        @php $badgeNames = CustomHelper::getMasterDropdownNameById($badges);
                        echo strtoupper($badgeNames);
                        @endphp
                        @if (!$loop->last)
                        ,
                        @endif
                        @endforeach
                    </td>
                    <td data-content="Approvals">
                        @foreach (explode(',', $universityTwo['get_all_university_details']['university_badges']['university_badges_id']) as $badgestwo)
                        @php $badgeTwoNames = CustomHelper::getMasterDropdownNameById($badgestwo);
                        echo strtoupper($badgeTwoNames);
                        @endphp
                        @if (!$loop->last)
                        ,
                        @endif
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.location') }}</th>
                    <td data-content="Location">
                        @foreach ($firstUniversityCompusesLocation as $first_indian_campuses_list)
                            {{ $first_indian_campuses_list }}
                        @endforeach
                    </td>
                    <td data-content="Location">

                        @foreach ($secondUniversityCompusesLocation as $second_indian_campuses_list)
                            {{ $second_indian_campuses_list }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.review_rating') }}</th>
                    <td class="text-center">
                        <span class="rating" data-score='{{$universityOne['get_all_university_details']['avg_rating']}}'></span>
                    </td>
                    <td class="text-center">
                        <span class="rating" data-score='{{$universityTwo['get_all_university_details']['avg_rating']}}'></span>
                    </td>
                </tr>

                <tr class="tableHeading">
                    <th class="text-center" colspan="3">{{ trans('front_messages.glabal.course') }}</th>
                </tr>

                <tr>
                    <th>{{ trans('front_messages.glabal.semester') }}</th>
                    <td data-content="Duration">{{ $universityOne['number_of_semesters'] }}</td>
                    <td data-content="Duration">{{ $universityTwo['number_of_semesters'] }}</td>
                </tr>
                
                <tr class="tableHeading">
                    <th class="text-center" colspan="3">{{ trans('front_messages.global.fee_payment') }}</th>
                </tr>

                <tr>
                    <th>{{ trans('front_messages.glabal.one_time') }}</th>
                    <td data-content="One Time">{{ CustomHelper::displayPrice($universityOne['one_time_fee']) }}</td>
                    <td data-content="One Time">{{ CustomHelper::displayPrice($universityTwo['one_time_fee']) }}</td>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.semester_wise') }} </th>
                    <td data-content="Semester Wise">
                        {{ CustomHelper::displayPrice($universityOne['per_semester_fee']) }}
                    </td>
                    <td data-content="Semester Wise">
                        {{ CustomHelper::displayPrice($universityTwo['per_semester_fee']) }}
                    </td>
                </tr>
              
                <tr>
                    <th>{{ trans('front_messages.glabal.total_fee') }} </th>
                    <td data-content="Monthly EMI">{{ CustomHelper::displayPrice($universityOne['total_fee']) }}</td>
                    <td data-content="Monthly EMI">{{ CustomHelper::displayPrice($universityTwo['total_fee']) }}</td>
                </tr>
                <tr class="tableHeading">
                    <th class="text-center" colspan="3">{{ trans('front_messages.glabal.placement') }}</th>
                </tr>
                <tr>
                    <th>{{ trans('front_messages.glabal.placement_partner') }}</th>
                    <td>{{ isset($universityOne['get_all_university_details']['get_university_placement_partners']) ? count(explode(',',$universityOne['get_all_university_details']['get_university_placement_partners']['university_placement_partners'])) : 'N/A' }}</td>
                    <td>{{ isset($universityTwo['get_all_university_details']['get_university_placement_partners']) ?  count(explode(',',$universityTwo['get_all_university_details']['get_university_placement_partners']['university_placement_partners'])) : 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>




<script>
    $(document).on('click', '.remove-btn', function() {
        var universityId = $(this).data('university_id');
        var courseId = $(this).data('course_id');
        var type = $(this).data('type');
        var page = $(this).data('page');
        var route = "{{ route('University.addCompareUniversity') }}";
        addRemoveUniversityCompare(courseId, universityId, type, '', page, route);
    });



        $('.rating').raty({
            path        : '{{ WEBSITE_IMG_URL }}',
            targetKeep  : true,
            readOnly    : true,
            score       : function() {
                return $(this).attr('data-score');
            }
        });
</script>
@stop