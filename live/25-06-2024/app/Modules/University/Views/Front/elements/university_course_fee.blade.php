@if (!empty($result->universityCourses->toArray()))    

<h2 class="heading_program_details">{{ trans('front_messages.glabal.updated_course_fee') }}</h2>
<div class="table-responsive tableformat">
    <table class="table table-striped">
        <thead>
            <tr class="tophead">
                <th>{{ trans('front_messages.glabal.course') }}</th>
                <th colspan="2" class="text-center">{{ trans('front_messages.glabal.semester_wise') }}</th>
                <th class="text-end">{{ trans('front_messages.glabal.one_time') }}</th>
            </tr>
            <tr class="secondhead">
                <th></th>
                <th class="text-center">{{ trans('front_messages.glabal.per_semester') }}</th>
                <th class="text-center">{{ trans('front_messages.glabal.total_fee') }}</th>
                <th class="text-end"></th>
            </tr>
        </thead>
        <tbody>
            @if (isset($slug) && !isset($course_slug))    
                @if (!empty($result->universityCourses->toArray()))    
                    @foreach ($result->universityCourses as $courses)    
                        <tr>
                            <th>{{ $courses->name }}</th>
                            <td class="text-center">{{ CustomHelper::displayPrice($courses->per_semester_fee)}}</td>
                            <td class="text-center">{{CustomHelper::displayPrice($courses->total_fee)}}</td>
                            <td class="text-end">{{CustomHelper::displayPrice($courses->one_time_fee)}}</td>
                        </tr>  
                    @endforeach
                @endif
            @elseif(isset($slug) && isset($course_slug))
                <tr>
                    <th>{{ $courseDetail->name }}</th>
                    <td class="text-center">{{ CustomHelper::displayPrice($courseDetail->per_semester_fee)}}</td>
                    <td class="text-center">{{CustomHelper::displayPrice($courseDetail->total_fee)}}</td>
                    <td class="text-end">{{CustomHelper::displayPrice($courseDetail->one_time_fee)}}</td>
                </tr>
            @endif
        </tbody>

    </table>
</div>
@endif