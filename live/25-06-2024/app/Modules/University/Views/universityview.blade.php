@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('university-application-page-view') }}
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
					@if($uni_id)
						<li>
							<a href='{{ route("$modelName.applicationindex",$uni_id)}}' >
								<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
							</a>
						</li>
					@else
						<li>
							<a href='{{ route("$modelName.applicationindex")}}' >
								<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
							</a>
						</li>
					@endif
				</ul>
			</div>
			<div class="body table-responsive">
				<table class="table table-bordered table-striped table-hover ">

				<tr>
					<th class="text-center" width="25%">{{ trans("messages.global.name") }}</th>
					<td>{{ isset($result->name) ? strip_tags($result->name) : 'N/A' }}</td>
					<th class="text-center" width="25%">{{ trans("messages.global.gender") }}</th>
					<td>

					<?php if(isset($result->gender)) {
							if($result->gender == 1){
								echo "Male";
							}else{
								echo "Female";
							}

					} ?>
					</td>
				</tr>

				<tr>
					<th class="text-center" width="25%">{{ trans("messages.global.email") }}</th>
					<?php 
						if(isset($result->email) && !empty($result->email)){ ?>
							<td><p class="description_maintain" ><a href="mailto:{{ $result->email }}">{{  $result->email }}</a></p></td>
						<?php
					}else{ ?>
						<td><p class="description_maintain" >{{  'N/A' }}</p></td>
					<?php }
					?>
					<th class="text-center" width="25%">{{ trans("messages.global.phone") }}</th>
					<?php 
						if(isset($result->phone) && !empty($result->phone)){ ?>
						<td>
							<p class="description_maintain" ><a href="tel:{{  $result->phone }}"> {{ isset($result->phone) ? $result->phone : 'N/A' }}</a></p>
						</td>
						<?php
					}else{ ?>
						<td><p class="description_maintain" >{{  'N/A' }}</p></td>
						<?php
					} ?>
				</tr>

				<tr>
					<th class="text-center" width="25%">{{ trans("messages.global.date_of_birth") }}</th>
					<td>
						<p class="description_maintain" > {{ isset($result->date_of_birth) ? $result->date_of_birth : 'N/A' }}</p>
					</td>
					<th class="text-center" width="25%">{{ trans("messages.global.state_search") }}</th>
					<td><p class="description_maintain" >{{ isset($result->state) ?   CustomHelper::get_state_name($result->state) : 'N/A' }}</p></td>
				</tr>
	
				<tr>
					<th class="text-center" width="25%">{{ trans("messages.global.city_search") }}</th>
					<td><p class="description_maintain" >{{ isset($result->city) ?  CustomHelper::get_city_name($result->city) : 'N/A' }}</p></td>
					<th class="text-center" width="25%">{{ trans("messages.global.university_name") }}</th>
					<td><p class="description_maintain" >{{ isset($result->uni_id) ?  CustomHelper::getUniversiryNameById($result->uni_id) : 'N/A' }}</p></td>
				</tr>
				
				<tr>
					<th class="text-center" width="25%">{{ trans("messages.global.course") }}</th>
					<td><p class="description_maintain" >{{ isset($result->course) ? CustomHelper::getConfigValue('COURSE_TYPE.'.$result->course) : 'N/A' }}</p></td>
					<th class="text-center" width="25%">{{ trans("messages.global.created_on") }}</th>
					<td><p class="description_maintain" >{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p></td>
				</tr>

				</table>
			</div>
		</div>
	</div>
</div>
</div>
@stop
