@if (!empty($allCourses))
    @foreach ($allCourses as $coursesId => $coursesName)
        @if (isset($queryString['courses']) && !empty(explode(',', $queryString['courses'])))
            <div class="form-check">
                <input class="form-check-input send_request" type="radio" name="courses[]" id="{{ $coursesName['name'] }}"
                    value="{{ $coursesName['id'] }}"
                    {{ in_array($coursesName['slug'], explode(',', $queryString['courses'])) ? 'checked' : '' }}
                    data-slug ="{{ $coursesName['slug'] }}">
                <label class="form-check-label ms-4 text-dark" for="{{ $coursesName['name'] }}">
                    {{ CustomHelper::getStringLimit($coursesName['name'], 15) }}
                </label>
            </div>
        @else
            <div class="form-check">
                <input class="form-check-input send_request" type="radio" name="courses[]"
                    id="{{ $coursesName['name'] }}" value="{{ $coursesName['id'] }}"
                    data-slug="{{ $coursesName['slug'] }}">
                <label class="form-check-label ms-4 text-dark" for="{{ $coursesName['name'] }}">
                    {{ CustomHelper::getStringLimit($coursesName['name'], 15) }}
                </label>
            </div>
        @endif
    @endforeach
@endif
