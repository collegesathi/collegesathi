@extends('admin.layouts.default')
@section('content')

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
						<a href='{{ route("$modelName.jobApplications", [$result->job->id])}}' >
							<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
						</a>
					</li>
				</ul>
			</div>

			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.name") }}</th>
						<td><p class="description_maintain" > {{ $result->full_name }} </p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.email") }}</th>
						<td><p class="description_maintain" > <a href="mailto:{{ $result->email }}">{{ $result->email }}</a></p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.phone_number") }}</th>
						<td><p class="description_maintain" >{{ isset($result->phone_number) ? $result->phone_number : 'N/A' }}</p></td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.linkedin_profile") }}</th>
						<td><p class="" >

                            <a href="{{ isset($result->linkedin_profile) ? $result->linkedin_profile : '#' }}">{{ isset($result->linkedin_profile) ? $result->linkedin_profile : 'N/A' }}</a>

                            </p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.course") }}</th>
						<td><p >

                               @php

                                 $specifications =isset($result->specifications) ? $result->specifications : 'N/A';

                                echo $courseType     = CustomHelper::getConfigValue('COURSE_TYPE.'.$specifications);


                                 @endphp

                        </p></td>
					</tr>

                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.state") }}</th>
						<td><p class="description_maintain" > {{ isset($result->stateName->state_name) ? $result->stateName->state_name : 'N/A' }}</p></td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.city") }}</th>
						<td><p class="description_maintain" >{{ isset($result->cityName->city_name) ? $result->cityName->city_name : 'N/A' }}</p></td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.message") }}</th>
						<td><p class="description_maintain" > {{ isset($result->message) ? $result->message : 'N/A' }}</p></td>
					</tr>



					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.resume") }}</th>
						<td>
							<a href='{{ route( "$modelName.downloadResume",$result->id)}}' class="text-decoration-none">
								<button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">download</i>{{ trans("messages.global.downloadResume") }}</button>
							</a>
						</td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.applied_on") }}</th>
						<td><p class="description_maintain" >{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p></td>
					</tr>
				</table>
			</div>


			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.title") }}</th>
						<td><p class="description_maintain" > {{ isset($result->job->title) ? $result->job->title : 'N/A' }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.total_applications") }}</th>
						<td><p class="description_maintain" > {{ isset($result->job->total_applications) ? $result->job->total_applications : 0 }}</p></td>
					</tr>

                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.department") }}</th>
						<td><p class="description_maintain" > {{ $result->job->department }}</p></td>
					</tr>

                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.job_type") }}</th>
						<td><p class="description_maintain" > {{ isset($result->job->jobType->name) ? $result->job->jobType->name : 'N/A' }}</p></td>
					</tr>
                    <tr>
						<th class="text-center" width="30%">{{ trans("messages.global.experience") }}</th>
						<td><p class="description_maintain" > {{ isset($result->job->experienceName->name) ? $result->job->experienceName->name : "N/A" }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.location") }}</th>
						<td><p class="description_maintain" > {{ !empty($result->job->location) ? $result->job->location : 'N/A' }}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.job_responsibilities") }}</th>
						<td><p class="description_maintain" > {!! !empty($result->job->job_responsibilities) ? $result->job->job_responsibilities : 'N/A' !!}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.qualification") }}</th>
						<td><p class="description_maintain" > {!! !empty($result->job->qualification) ? $result->job->qualification : 'N/A' !!}</p></td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
						<td>
							@if($result->job->is_active	== ACTIVE)
								<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
							@else
								<span class="label label-warning" >{{ trans("messages.global.inactive") }}</span>
							@endif
						</td>
					</tr>
					<tr>
						<th class="text-center" width="30%">{{ trans("messages.global.created_on") }}</th>
						<td><p class="description_maintain" >{{ isset($result->job->created_at) ?  CustomHelper::displayDate($result->job->created_at) : 'N/A' }}</p></td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
</div>
@stop
