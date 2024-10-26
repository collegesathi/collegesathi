@if (isset($slug) && !isset($course_slug))
    @if ($result->universityCourseEmiDetail->isNotEmpty())
        @foreach ($result->universityCourseEmiDetail as $courseEmiDetails)
            <div class="course_fees pt-4">
                <h2 class="heading_program_details">{{ $courseEmiDetails->name }}</h2>
                <div class="course_fees-scroll Education_fees-scroll">
                    <ul>
                        <li class="course_heading">
                            <div class="course">
                                <h3>{{ trans('front_messages.global.mode') }}</h3>
                            </div>
                            <div class="full_fees">
                                <h3>{{ trans('front_messages.global.total_fees') }}</h3>
                            </div>
                            <div class="full_fees">
                                <h3>{{ trans('front_messages.global.loan_amount') }}</h3>
                            </div>

                            <div class="course">
                                <h3>{{ trans('front_messages.global.tenure') }}</h3>
                            </div>
                            <div class="full_fees">
                                <h3>{{ trans('front_messages.global.interest') }}</h3>
                            </div>
                            <div class="full_fees">
                                <h3>{{ trans('front_messages.global.monthly_emi') }}</h3>
                            </div>

                        </li>
                        <li>
                            <div class="course">
                                <h4>{{ trans('front_messages.global.semester_wise') }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->semester_total_fee) ? CustomHelper::displayPrice($courseEmiDetails->semester_total_fee) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->semester_loan_amount) ? CustomHelper::displayPrice($courseEmiDetails->semester_loan_amount) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="course">
                                <h4>{{ !empty($courseEmiDetails->semester_tenure) ? $courseEmiDetails->semester_tenure : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->semester_interest) ? $courseEmiDetails->semester_interest . '%' : 'N/A' }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->semester_monthly_emi) ? $courseEmiDetails->semester_monthly_emi : 'N/A' }}
                                </h4>
                            </div>
                        </li>

                        <li>
                            <div class="course">
                                <h4>{{ trans('front_messages.global.annually') }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->annually_total_fee) ? CustomHelper::displayPrice($courseEmiDetails->annually_total_fee) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->annually_loan_amount) ? CustomHelper::displayPrice($courseEmiDetails->annually_loan_amount) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="course">
                                <h4>{{ !empty($courseEmiDetails->annually_tenure) ? $courseEmiDetails->annually_tenure : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->annually_interest) ? $courseEmiDetails->annually_interest . '%' : 'N/A' }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->annually_monthly_emi) ? $courseEmiDetails->annually_monthly_emi : 'N/A' }}
                                </h4>
                            </div>
                        </li>

                        <li>
                            <div class="course">
                                <h4>{{ trans('front_messages.global.one_time') }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->one_time_total_fee) ? CustomHelper::displayPrice($courseEmiDetails->one_time_total_fee) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->one_time_loan_amount) ? CustomHelper::displayPrice($courseEmiDetails->one_time_loan_amount) : 'N/A' }}
                                </h4>
                            </div>
                            <div class="course">
                                <h4>{{ !empty($courseEmiDetails->one_time_tenure) ? $courseEmiDetails->one_time_tenure : 'N/A' }}
                                </h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->one_time_interest) ? $courseEmiDetails->one_time_interest . '%' : 'N/A' }}</h4>
                            </div>
                            <div class="full_fees">
                                <h4>{{ !empty($courseEmiDetails->one_time_monthly_emi) ? $courseEmiDetails->one_time_monthly_emi : 'N/A' }}
                                </h4>
                            </div>
                        </li>


                    </ul>
                </div>

            </div>
        @endforeach
    @endif
@elseif(isset($slug) && isset($course_slug))
    @if ($courseDetail->show_on_front == ACTIVE)
        <div class="course_fees pt-4">
            <h2 class="heading_program_details">{{ $courseDetail->name }}</h2>
            <div class="course_fees-scroll Education_fees-scroll">
                <ul>
                    <li class="course_heading">
                        <div class="course">
                            <h3>{{ trans('front_messages.global.mode') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.total_fees') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.loan_amount') }}</h3>
                        </div>

                        <div class="course">
                            <h3>{{ trans('front_messages.global.tenure') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.interest') }}</h3>
                        </div>
                        <div class="full_fees">
                            <h3>{{ trans('front_messages.global.monthly_emi') }}</h3>
                        </div>

                    </li>
                    <li>
                        <div class="course">
                            <h4>{{ trans('front_messages.global.semester_wise') }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->semester_total_fee) ? CustomHelper::displayPrice($courseDetail->semester_total_fee) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->semester_loan_amount) ? CustomHelper::displayPrice($courseDetail->semester_loan_amount) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="course">
                            <h4>{{ !empty($courseDetail->semester_tenure) ? $courseDetail->semester_tenure : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->semester_interest) ? $courseDetail->semester_interest . '%' : 'N/A' }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->semester_monthly_emi) ? $courseDetail->semester_monthly_emi : 'N/A' }}
                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="course">
                            <h4>{{ trans('front_messages.global.annually') }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->annually_total_fee) ? CustomHelper::displayPrice($courseDetail->annually_total_fee) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->annually_loan_amount) ? CustomHelper::displayPrice($courseDetail->annually_loan_amount) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="course">
                            <h4>{{ !empty($courseDetail->annually_tenure) ? $courseDetail->annually_tenure : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->annually_interest) ? $courseDetail->annually_interest . '%' : 'N/A' }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->annually_monthly_emi) ? $courseDetail->annually_monthly_emi : 'N/A' }}
                            </h4>
                        </div>
                    </li>

                    <li>
                        <div class="course">
                            <h4>{{ trans('front_messages.global.one_time') }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->one_time_total_fee) ? CustomHelper::displayPrice($courseDetail->one_time_total_fee) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->one_time_loan_amount) ? CustomHelper::displayPrice($courseDetail->one_time_loan_amount) : 'N/A' }}
                            </h4>
                        </div>
                        <div class="course">
                            <h4>{{ !empty($courseDetail->one_time_tenure) ? $courseDetail->one_time_tenure : 'N/A' }}
                            </h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->one_time_interest) ? $courseDetail->one_time_interest . '%' : 'N/A' }}</h4>
                        </div>
                        <div class="full_fees">
                            <h4>{{ !empty($courseDetail->one_time_monthly_emi) ? $courseDetail->one_time_monthly_emi : 'N/A' }}
                            </h4>
                        </div>
                    </li>


                </ul>
            </div>

        </div>
    @endif
@endif
