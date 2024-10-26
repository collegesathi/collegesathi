@extends('admin.layouts.default')
@section('content')


@section('breadcrumbs')
	{{ Breadcrumbs::render('job-view') }}
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
						<th class="text-center" width="30%">{{ trans("messages.global.title") }}</th>
						<td><p class="description_maintain" > {{ isset($result->title) ? strip_tags($result->title) : 'N/A' }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.total_applications") }}</th>
						<td><p class="description_maintain" > {{ isset($result->total_applications) ? $result->total_applications : 0 }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.department") }}</th>
						<td><p class="description_maintain" > {{ $result->department }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.job_type") }}</th>
						<td><p class="description_maintain" > {{ isset($result->jobType->name) ? $result->jobType->name : 'N/A' }}</p></td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.experience") }}</th>
						<td><p class="description_maintain" > {{ isset($result->experienceName->name) ? $result->experienceName->name : "N/A" }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.location") }}</th>
						<td><p class="description_maintain" > {{ !empty($result->location) ? $result->location : 'N/A' }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.job_responsibilities") }}</th>
						<td><p class="description_maintain" > {!! !empty($result->job_responsibilities) ? $result->job_responsibilities : 'N/A' !!}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.qualification") }}</th>
						<td><p class="description_maintain" > {!! !empty($result->qualification) ? $result->qualification : 'N/A' !!}</p></td>
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
