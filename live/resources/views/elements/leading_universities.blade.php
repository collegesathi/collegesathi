<?php
$collaborationUniversity = CustomHelper::getCoallborationUniversity();
function getDeviceType()
{
	$userAgent = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';

	// Check for mobile devices
	if (preg_match('/Mobile|Android|iPhone|iPad|iPod|IEMobile|Mobile Safari|BlackBerry/', $userAgent)) {
		return 'Mobile';
	}

	// Check for tablets
	if (preg_match('/Tablet|iPad|PlayBook/', $userAgent)) {
		return 'Tablet';
	}

	// Default to desktop
	return 'Desktop';
}
$deviceType = getDeviceType();
?>
@if($collaborationUniversity->isNotEmpty())
	<section class="universitiesView_section">
		<div class="container">
			<div class="universities-wrapper">
				<div class="universities-col-left">
					<div class="headingCard">
						<h2 class="heading">
							{!! trans("front_messages.global.collaboration_heading") !!}
						</h2>
						@php
							if ($deviceType == 'Desktop') {
						@endphp
						<p class="paragraphline">
							{!! trans("front_messages.global.collaboration_paragraph") !!}
						</p>
						@php } @endphp
					</div>
					@php
						if ($deviceType == 'Desktop') {
					@endphp
					<div class="viewmore"><a href="{{ route('University.getAllNewUniversity') }}"
							class="btn btn-primary">View All Universities</a></div>
					@php } @endphp
				</div>
				@php
					if ($deviceType == 'Desktop') {
				@endphp
				<div class="universities-col-right">
					<ul class="leading-universitiesList">
						@php
							$groupings = [
								'first' => [0, 1],
								'middle' => [2, 3, 4],
								'last' => [5, 6]
							];
						@endphp

						@foreach ($groupings as $key => $indices)
									@php
										$class = '';
										if ($key === 'middle') {
											$class = 'middleCard';
										} elseif ($key === 'last') {
											$class = 'lastCard';
										}
									@endphp
									<li class="{{ $class }}">
										<div class="leading-row">
											@foreach ($indices as $index)
														@if (isset($collaborationUniversity[$index]))
																	@php
																		$value = $collaborationUniversity[$index];
																	@endphp
																	<div class="leadingBox">
																		<a href="{{ route('University.frontIndex', $value->slug) }}">
																			<figure class="collaborationUniversityLogo">
																				@if ($value->image != '' && File::exists(UNIVERSITY_IMAGE_ROOT_PATH . $value->image))
																					<img src="{{ UNIVERSITY_IMAGE_URL . $value->image }}" alt="image">
																				@else
																					<img src='{{ WEBSITE_UPLOADS_URL }}user-profile-not-available.jpeg'
																						class="profileImage">
																				@endif
																			</figure>
																			<strong>{{ $value->title }}</strong>
																			<p>{{ CustomHelper::getStringLimit($value->tag_line, 20) }}</p>
																		</a>
																	</div>
														@endif
											@endforeach
										</div>
									</li>
						@endforeach
					</ul>
				</div>
				@php } else { @endphp
				<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 mt-4">
					@php
						$groupings = [
							'first' => [0, 1],
							'middle' => [2, 3],
							'last' => [4, 5]
						];
					@endphp

					@foreach ($groupings as $key => $indices)
							@php
								$class = '';
								if ($key === 'middle') {
									$class = 'middleCard';
								} elseif ($key === 'last') {
									$class = 'lastCard';
								}
							@endphp
							@foreach ($indices as $index)
								@if (isset($collaborationUniversity[$index]))
									@php
										$value = $collaborationUniversity[$index];
									@endphp
									<div class="mb-3 col"><a class="border border-2 rounded-lg d-inline-block w-100 h-100 p-3"
									style="background-color: #f0f8ff; box-shadow: 0 4px 8px rgba(0,0,0,0.2); text-decoration: none; border-radius: 12px;"
											href="{{ route('University.frontIndex', $value->slug) }}"> <span
												style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%"><span
													style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%"><img
														style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0"
														alt="" aria-hidden="true"
														src="data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%27110%27%20height=%2756%27/%3e"></span><img
													alt="manipal online university logo" src="{{ UNIVERSITY_IMAGE_URL . $value->image }}"
													decoding="async" data-nimg="intrinsic"
													style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%;object-fit:contain"
													srcset="{{ UNIVERSITY_IMAGE_URL . $value->image }}"><noscript><img
														alt="manipal online university logo"
														srcSet="{{ UNIVERSITY_IMAGE_URL . $value->image }}"
														src="{{ UNIVERSITY_IMAGE_URL . $value->image }}" decoding="async"
														data-nimg="intrinsic"
														style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%;object-fit:contain"
														loading="lazy" /></noscript></span>
											<p class="mb-1 text-dark fs-12 text-truncate fw-bold">{{ $value->title }}</p>
											<p class="mb-1 text-secondary fs-12 text-truncate">
												{{ CustomHelper::getStringLimit($value->tag_line, 20) }}
											</p>
										</a></div>
								@endif
							@endforeach
					@endforeach
				</div>
				<div class="viewmore"><a href="{{ route('University.getAllNewUniversity') }}" class="btn btn-primary">View
						All Universities</a></div>
			</div>
			@php } @endphp
		</div>
		</div>
	</section>
@endif