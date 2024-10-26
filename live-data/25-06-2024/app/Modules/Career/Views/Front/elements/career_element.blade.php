@if (!empty($result->toArray()))
@foreach ($result as $career)
<li>
    <div class="career-box">
        <div class="left-content">
            <h3>{{ $career->job_title }}</h3>
            <p>{{ $career->description }}</p>
        </div>
        <div class="right-content">
            <div class="jop-type">{{ Config::get('JOB_TYPE.' . $career->job_type) }}</div>
            <a class="btn-primary viewDetailsBtn" data-bs-toggle="collapse" href="#collapseExample{{ $career->id }}" aria-expanded="false" aria-controls="collapseExample">
                <span class="viewDetailsText">{{ trans('front_messages.global.view_details') }}</span>
                <span class="viewcancle-text">{{ trans('front_messages.global.close') }}</span>
            </a>
        </div>

    </div>
    <div class="collapse" id="collapseExample{{ $career->id }}">
        <div class="detailsJob">
            <div class="details-list">
                <ul>
                    <li class="flex-100">
                        <div class="details-listInner">
                            <figure>
                                <img src="{{ WEBSITE_IMG_URL }}task_alt.svg" alt="Job position">
                            </figure>
                            <span>{{ trans('front_messages.global.skill') }}</span>
                            <div class="skill-set">
                                {{ $career->skill }}
                            </div>
                        </div>
                    </li>
                    <li class="flex-100">
                        <div class="details-listInner">
                            <figure>
                                <img src="{{ WEBSITE_IMG_URL }}school_black.svg" alt="Job position">
                            </figure>
                            <span>{{ trans('front_messages.global.education') }}</span>
                            <strong>{{ $career->education }}</strong>
                        </div>
                    </li>
                    <li class="flex-100">
                        <div class="details-listInner">
                            <figure>
                                <img src="{{ WEBSITE_IMG_URL }}badge_black.svg" alt="Job position">
                            </figure>
                            <span>{{ trans('front_messages.global.work_experience') }}</span>
                            <strong>{{ $career->work_experience }}</strong>
                        </div>
                    </li>

                    <li class="flex-100">
                        <div class="details-listInner">
                            <figure>
                                <img src="{{ WEBSITE_IMG_URL }}room_black.svg" alt="Job position">
                            </figure>
                            <span>{{ trans('front_messages.global.work_location') }}</span>
                            <strong>{{ $career->work_location }}</strong>
                        </div>
                    </li>
                </ul>
                <div class="d-flex justify-content-end">
                    <a href="javascript:voide(0);" class="btn-primary apply_career" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-career_id="{{ $career->id }}" data-job_title="{{ $career->job_title }}">{{ trans('front_messages.global.apply') }}</a>
                </div>
            </div>
        </div>
    </div>
</li>
@endforeach
@endif
 
