@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('review-page-view') }}
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
					<th class="text-center" width="30%">{{ trans("messages.global.university_name") }}</th>
					<td><p class="description_maintain" > {{ isset($result->uni_id) ? CustomHelper::getUniversiryNameById($result->uni_id) : 'N/A' }}</p></td>
				</tr>

				<tr>
					<th class="text-center">{{ trans("messages.$modelName.user_name") }}</th>
					<td>
							{{ isset($result->user_id) ? CustomHelper::getUserNameById($result->user_id) : 'N/A' }}
					</td>
				</tr>
				
				<tr>
					<th class="text-center">{{ trans("messages.$modelName.message") }}</th>
					<td>
							{{ isset($result->message) ? strip_tags($result->message) : 'N/A' }}
					</td>
				</tr>
				<tr>
					<th class="text-center">{{ trans("messages.$modelName.rating") }}</th>
					<td>
							{{ isset($result->review_rating) ? strip_tags($result->review_rating) : 'N/A' }}
					</td>
				</tr>
				<tr>
					<th class="text-center" width="30%">{{ trans("messages.global.status") }}</th>
					<td>
						@if($result->is_status	== ACTIVE)
							<span class="label label-success" >{{ trans("messages.global.approved") }}</span>
						@elseif($result->is_status  == REJECT)
							<span class="label label-danger" >{{ trans("messages.global.rejected") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.global.pending") }}</span>
						@endif
					</td>
				</tr>
				@if($result->is_status  == REJECT)
					<tr>
						<th class="text-center">{{ trans("messages.$modelName.rejected_reason") }}</th>
						<td>
							{{ isset($result->rejected_reason) ? strip_tags($result->rejected_reason) : 'N/A' }}
						</td>
					</tr>
				@endif
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
