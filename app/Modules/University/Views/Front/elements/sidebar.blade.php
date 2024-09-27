

<div class="university_program_listing ">
    <div id="ProgramsListScroll" class="list-group bg-white box_shadow programs_listing">
        <ul>
            <li class="active">
                <a class="list-group-item list-group-item-action" href="#About">{{ trans('front_messages.global.about') }}</a>
            </li>
 
            <li>
                <a class="list-group-item list-group-item-action" href="#Approvals">{{ trans('front_messages.global.approvals') }}</a>
            </li>
			
            @if (!empty($result->universityCourses->toArray()) ) 
				@if (isset($slug) && !isset($course_slug))    
					<li>
						<a class="list-group-item list-group-item-action" href="#Courses">{{ trans('front_messages.global.courses') }}</a>
					</li>
				@endif
            @endif
            

            


            @if (isset($slug) && isset($course_slug))
                @if(count($result->universityCourses) > 1)
                    <li>
                        <a class="list-group-item list-group-item-action" href="#Courses">{{ trans('front_messages.global.other_courses') }}</a>
                    </li>
                @endif

                @if ($specification_slug == '')    
                    @if ($courseDetail->getCourseSpecifications->isNotEmpty())
                        <li>
                            <a class="list-group-item list-group-item-action" href="#Specifications">{{ trans('front_messages.global.specifications') }}</a>
                        </li>
                    @endif
                @endif

                @if (!empty($courseDetail->courseSemesters->toArray()) && !isset($specification_slug))
                    <li>
                        <a class="list-group-item list-group-item-action" href="#Syllabus">{{ trans('front_messages.global.syllabus') }}</a>
                    </li>
                @endif

                @if (isset($specification_slug))    
                    @if (!empty($specificationDetails->courseSemesters->toArray()))
                        <li>
                            <a class="list-group-item list-group-item-action" href="#Syllabus">{{ trans('front_messages.global.syllabus') }}</a>
                        </li>
                    @endif
                @endif
            @endif

            

            <li>
                <a class="list-group-item list-group-item-action" href="#Specialisations">{{ trans('front_messages.global.management_specialisations') }}</a>
            </li>

            @if (isset($slug) && !isset($course_slug))
            @if( $result->university_certificate_image !="" )
            <li>
                <a class="list-group-item list-group-item-action" href="#SampleCertificate">{{ trans('front_messages.global.sample_certificate') }}</a>
            </li>
            @endif
            @endif
            
            @if(isset($slug) && isset($course_slug))
            @if ($courseDetail->course_certificate_image != "")
            <li>
                <a class="list-group-item list-group-item-action" href="#SampleCertificate">{{ trans('front_messages.global.sample_certificate') }}</a>
            </li>
            @endif
            @endif
            <li>
                <a class="list-group-item list-group-item-action" href="#Ranking">{{ trans('front_messages.global.ranking') }}</a>
            </li>

            @if (!isset($specification_slug))
                <li>
                    <a class="list-group-item list-group-item-action" href="#EducationLoanEMI">{{ trans('front_messages.global.education_loan_monthly_emi') }}</a>
                </li>
            @endif

            <li>
                <a class="list-group-item list-group-item-action" href="#AdmissionOpen">{{ trans('front_messages.global.admission_open') }}</a>
            </li>
            <li>
                <a class="list-group-item list-group-item-action" href="#EligibilityCriteria">{{ trans('front_messages.global.eligibility_criteria') }}</a>
            </li>
            <li>
                <a class="list-group-item list-group-item-action" href="#ExaminationPattern">{{ trans('front_messages.global.examination_pattern') }}</a>
            </li>
            <li>
                <a class="list-group-item list-group-item-action" href="#PlacementPartners">{{ trans('front_messages.global.hiring_partners') }}</a>
            </li>

            @if (isset($slug) && !isset($course_slug))
                @if (!empty($indianCampuses) || !empty($internationalCampuses))
                    <li>
                        <a class="list-group-item list-group-item-action" href="#Campuses">{{ trans('front_messages.global.campuses') }}</a>
                    </li>
                @endif
            @endif
            
            <li>
                <a class="list-group-item list-group-item-action" href="#Advantages">{{ trans('front_messages.global.online_advantages') }}</a>
            </li>

            
            @if ((isset($slug) && !empty($result->faqs->toArray()) && !isset($course_slug)) || (isset($slug) && isset($course_slug) && !empty($courseDetail->courseFaqs->toArray())))    
                <li>
                    <a class="list-group-item list-group-item-action" href="#FAQ">{{ trans('front_messages.global.faq') }}</a>
                </li>
            @endif

            @if (isset($slug) && !isset($course_slug) && !empty($result->blogs->toArray()))    
                <li>
                    <a class="list-group-item list-group-item-action" href="#BlogVideo"> Blog</a>
                </li>
            @endif

            @if (!empty($otherUniversities->toArray()))     
                <li>
                    <a class="list-group-item list-group-item-action" href="#OtherUniversities">{{ trans('front_messages.global.similar_universities') }}</a>
                </li>
            @endif

            @if (isset($slug) && !isset($course_slug))    
                <li>
                    <a class="list-group-item list-group-item-action" href="#TestimonialsReviews">{{ trans('front_messages.global.reviews') }}</a>
                </li>
            @endif

            
        </ul>
    </div>
</div>