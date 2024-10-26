<section class="courses_main_section DegreeCourses-section mb-5" id="Syllabus">
    <h2 class="heading_program_details">{{ $specificationDetails->name }} {{ trans('front_messages.glabal.syllabus') }} </h2>

    @for ($i = 1; $i <= $specificationDetails->number_of_semesters; $i++)
        <div class="accordion" id="semesters{{ $i }}">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button {{ $i > 1 ? 'collapsed' : '' }}" type="button"
                        data-bs-toggle="collapse" data-bs-target="#semester_{{ $i }}"
                        aria-expanded="{{ $i == 1 ? 'true' : 'false' }}" aria-controls="semester_{{ $i }}">
                        <strong>{{ trans('front_messages.glabal.semester') }}
                            {{ $i }}</strong> <span
                            class="ms-auto text-end">{{ CustomHelper::getSemesterCreditTotal($specificationDetails->university_course_id, $i, $specificationDetails->specification_id) . ' Credits' }}</span>
                    </button>
                </h2>
                <div id="semester_{{ $i }}"
                    class="accordion-collapse {{ $i == 1 ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#semesters{{ $i }}">
                    <div class="accordion-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Subjects</th>
                                    <th scope="col">Credits</th>
                                </tr>
                            </thead>


                            @foreach ($specificationDetails->courseSemesters as $semesters)
                                @if ($i == $semesters->semester)
                                    <tbody>
                                        <tr>
                                            <td>{{ $semesters->subject }}</td>
                                            <td>{{ $semesters->credit_score }}</td>
                                        </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endfor
</section>
