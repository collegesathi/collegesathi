@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('testimonial-page-view') }}
@stop
<div class="container-fluid" id="main-container">
<div class="row clearfix" >
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">

		<div class="header">
			<h2>
			{{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_index") }}
			</h2>
			<ul class="header-dropdown m-r--5 btn-right-top-margin">
				<li>
					@if($universityTestimonial)
						<a href='{{ route("UniversityTestimonial.index",$uni_id) }}' >
							<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
						</a>
					@else
						<a href='{{ route("$modelName.index")}}' >
							<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
						</a>
					@endif
				</li>
			</ul>
		</div>

		<div class="body table-responsive">
			<table class="table table-bordered table-striped table-hover ">

			 <tr>
				<th class="text-right" width="30%">{{ trans("messages.$modelName.image") }}</th>
				<td data-th='{{ trans("messages.$modelName.profile_image") }}'>

				@php
					$root_path = TESTIMONIAL_IMAGE_ROOT_PATH;
					$http_path = TESTIMONIAL_IMAGE_URL;
					$attribute = array();
					$types = '';
					$attribute['alt'] = 'user-profile';
					$attribute['class'] = "userProfileImage circle-img";
					$attribute['width'] = "75";
					$attribute['height'] = "75";
					$attribute['cropratio'] = "1:1";
					$attribute['zc'] = "1";
					$image_name = isset($result->image) ? $result->image :'';
					$image = CustomHelper::showImageWithLightBox($root_path,$http_path,$image_name,$types,$attribute);
				@endphp

				{!! $image !!}



				</td>
			</tr>

			<tr>
				<table class="row-border hover table table-bordered" cellspacing="0" width="100%">
					@if(count($languages) > 1)
                        <tr>
                            <th colspan="" class="text-center"></th>

                            @foreach($languages as $langCode => $title)
                                <th colspan="" class="text-center">{{ $title }}</th>
                            @endforeach
                        </tr>
                    @endif

					<tr>
						<th  class="text-right">{{ trans("Client Name") }}</th>

						@foreach($languages as $langCode => $title)
                            <td>
                                {{ isset($multiLanguage[$langCode]['client_name']) ? $multiLanguage[$langCode]['client_name'] : 'N/A' }}
                            </td>
                        @endforeach

					</tr>

					<tr>
						<th  class="text-right">{{ trans("messages.$modelName.comment") }}</th>

						@foreach($languages as $langCode => $title)
                            <td>
                                {!! isset($multiLanguage[$langCode]['comment']) ? $multiLanguage[$langCode]['comment'] : 'N/A' !!}
                            </td>
                        @endforeach

					</tr>

                    <tr>
						<th  class="text-right">{{ trans("messages.$modelName.designation") }}</th>

						@foreach($languages as $langCode => $title)
                            <td>
                                {!! isset($multiLanguage[$langCode]['designation']) ? $multiLanguage[$langCode]['designation'] : 'N/A' !!}
                            </td>
                        @endforeach

					</tr>

					<tr>
						<th  class="text-right">{{ trans("messages.$modelName.company") }}</th>

						@foreach($languages as $langCode => $title)
                            <td>
                                {!! isset($multiLanguage[$langCode]['company']) ? $multiLanguage[$langCode]['company'] : 'N/A' !!}
                            </td>
                        @endforeach

					</tr>

					<tr>
						<th  class="text-right">{{ trans("messages.$modelName.batch") }}</th>

						@foreach($languages as $langCode => $title)
                            <td>
                                {!! isset($multiLanguage[$langCode]['batch']) ? $multiLanguage[$langCode]['batch'] : 'N/A' !!}
                            </td>
                        @endforeach

					</tr>

                    <th class="text-right" width="30%">{{ trans("messages.global.created_on") }}</th>
				<td><p class="description_maintain" >{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p></td>
				</table>
			</tr>
			</table>
			</div>
	</div>
</div>
</div>
</div>
@stop
