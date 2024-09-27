@if ($result->isNotEmpty())
    @foreach ($result as $universities)
        <li>
            <a href="{{ route('University.frontIndex', $universities->slug) }}" class="leadingBox">
                <figure>
                    @if ($universities->image != '' && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $universities->image))
                        <img src="{{ UNIVERSITY_IMAGE_URL . $universities->image }}" alt="image">
                    @else
                        <img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg' class="profileImage">
                    @endif
                </figure>
                <strong>{{ $universities->title }}</strong>
                <p>{{ CustomHelper::getStringLimit($universities->tag_line, 15) }}</p>
            </a>
        </li>
    @endforeach
@endif
