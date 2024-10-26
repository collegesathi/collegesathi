@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('advertisement-page-view') }}
@stop
<div class="container-fluid" id="main-container">
<div class="row clearfix" >
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					{{ trans("messages.$modelName.table_heading_view") }}
				</h2>
				<ul class="header-dropdown m-r--5 btn-right-top-margin">
					<li>
						<a href='{{ route("$modelName.index")}}' >
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
                            @if ($result->image != '' && File::exists(ADVERTISEMENT_IMAGE_ROOT_PATH . $result->image))

                                @php  echo CustomHelper::showUserImage(ADVERTISEMENT_IMAGE_ROOT_PATH, ADVERTISEMENT_IMAGE_URL,  $result->image,  $result->gender, ['alt' => $result->full_name, 'height' =>'60', 'width' =>'60']);  @endphp

                            @else
                                {{ 'No Image' }}
                            @endif
                        </td>
                    </tr>

				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.title") }}</th>
					<td><p class="description_maintain" > {{ isset($result->title) ? strip_tags($result->title) : 'N/A' }}</p></td>
				</tr>

				<tr>
					<th class="text-center">{{ trans("messages.$modelName.advertisement_url") }}</th>
					<td>
							{{ isset($result->advertisement_url) ? strip_tags($result->advertisement_url) : 'N/A' }}
					</td>
				</tr>
				
				<tr>
					<th class="text-center">{{ trans("messages.$modelName.display_location") }}</th>
					<td>
							{{ isset($result->location) ? strip_tags($result->location) : 'N/A' }}
					</td>
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
