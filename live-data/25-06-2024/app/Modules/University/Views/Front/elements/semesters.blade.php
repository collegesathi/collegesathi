<h2 class="heading_program_details">{{ $courseDetail->name }} {{ trans('front_messages.glabal.syllabus') }} </h2>
@for ($i = 1; $i <= $courseDetail->number_of_semesters; $i++)
    <div class="accordion" id="semesters{{ $i }}">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button {{ $i > 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse"
                    data-bs-target="#semester_{{ $i }}" aria-expanded="{{ $i == 1 ? 'true' : 'false' }}"
                    aria-controls="semester_{{ $i }}">
                    {{ trans('front_messages.glabal.semester') }}
                    {{ $i }} <span
                        class="ms-auto text-end">{{ CustomHelper::getSemesterCreditTotal($courseDetail->id, $i) . ' Credits' }}</span>
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
                        @foreach ($courseDetail->courseSemesters as $semesters)
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



    {{-- <div class="semestersection">
                                        <h4 class="innerheading_bar mb-3">{{ trans('front_messages.glabal.semester') }}
                                            {{ $i }} <span
                                                class="text-end">{{ CustomHelper::getSemesterCreditTotal($courseDetail->id, $i) . ' Credits' }}</span>
                                        </h4>
                                        <ul class="syllabus-listing">
                                            @foreach ($courseDetail->courseSemesters as $semesters)
                                                @if ($i == $semesters->semester)
                                                    <li>
                                                        <div class="syllabus-card">
                                                            <strong>{{ $semesters->subject }}</strong>
                                                            <span>{{ $semesters->credit_score }}</span>
                                                            {!! $semesters->description !!}
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div> --}}
@endfor