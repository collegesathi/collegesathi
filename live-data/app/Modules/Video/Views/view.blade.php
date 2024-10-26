@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('video-page-view') }}
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
						<a href='{{ route("UniversityVideo.index",$uni_id) }}' >
							<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
						</a>

					</li>
				</ul>
			</div>
			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">

                    <tr>
                        <th class="text-center" width="30%">{{ trans("messages.global.image") }}</th>
                        <td>
                            @if ($result->image != '' && File::exists(VIDEO_IMAGE_ROOT_PATH . $result->image))

                                @php  echo CustomHelper::showUserImage(VIDEO_IMAGE_ROOT_PATH,VIDEO_IMAGE_URL,  $result->image,  $result->gender, ['alt' => $result->full_name, 'height' =>'60', 'width' =>'60']);  @endphp

                            @else
                                {{ 'No Image' }}
                            @endif
                        </td>
                    </tr>

				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.name") }}</th>
					<td><p class="description_maintain" > {{ isset($result->name) ? strip_tags($result->name) : 'N/A' }}</p></td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.duration") }}</th>
					<td><p class="description_maintain" > {{ isset($result->duration) ? strip_tags($result->duration) : 'N/A' }}</p></td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.youtube_id") }}</th>
					<td><p class="description_maintain" > {{ isset($result->youtube_id) ? strip_tags($result->youtube_id) : 'N/A' }}</p></td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.description_short") }}</th>
					<td><p class="description_maintain" > {{ $result->short_description }}</p></td>
				</tr>

				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
					<td>
						@if($result->is_active	== ACTIVE)
							<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.global.inactive") }}</span>
						@endif
					</td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
					<td><p class="description_maintain" >{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p></td>
				</tr>

				</table>
			</div>
		</div>
	</div>
</div>
</div>
@stop
