@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
{{ Breadcrumbs::render('survey-page-view') }}
@stop
<div class="container-fluid" id="main-container">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>
						{{ trans("messages.$modelName.table_heading_view") }}
					</h2>
					<ul class="header-dropdown m-r--5 btn-right-top-margin">
						<li>
							<a href='{{ route("$modelName.index")}}'>
								<button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
							</a>

						</li>
					</ul>
				</div>
				<div class="body table-responsive">
					<table class="table table-bordered table-striped table-hover ">

						<tr>
							<th class="text-center" width="25%">{{ trans("messages.global.name") }}</th>
							<td>{{ isset($result->name) ? strip_tags($result->name) : 'N/A' }}</td>
							<th class="text-center" width="25%">{{ trans("messages.global.gender") }}</th>
							<td>

								<?php if (isset($result->gender)) {
									if ($result->gender == 1) {
										echo "Male";
									} else {
										echo "Female";
									}
								} ?>
							</td>
						</tr>

						<tr>
							<th class="text-center" width="25%">{{ trans("messages.global.email") }}</th>
							<?php
							if (isset($result->email) && !empty($result->email)) { ?>
								<td>
									<p class="description_maintain"><a href="mailto:{{ $result->email }}">{{ $result->email }}</a></p>
								</td>
							<?php
							} else { ?>
								<td>
									<p class="description_maintain">{{ 'N/A' }}</p>
								</td>
							<?php }
							?>
							<th class="text-center" width="25%">{{ trans("messages.global.phone") }}</th>
							<?php
							if (isset($result->phone) && !empty($result->phone)) { ?>
								<td>
									<p class="description_maintain"><a href="tel:{{  $result->phone }}"> {{ isset($result->phone) ? $result->phone : 'N/A' }}</a></p>
								</td>
							<?php
							} else { ?>
								<td>
									<p class="description_maintain">{{ 'N/A' }}</p>
								</td>
							<?php
							} ?>
						</tr>

						<tr>
							<th class="text-center" width="25%">{{ trans("messages.global.date_of_birth") }}</th>
							<td>
								<p class="description_maintain"> {{ isset($result->date_of_birth) ? $result->date_of_birth : 'N/A' }}</p>
							</td>
							<th class="text-center" width="25%">{{ trans("messages.global.state_search") }}</th>
							<td>
								<p class="description_maintain">{{ isset($result->state) ?   CustomHelper::get_state_name($result->state) : 'N/A' }}</p>
							</td>
						</tr>

						<tr>
							<th class="text-center" width="25%">{{ trans("messages.global.city_search") }}</th>
							<td>
								<p class="description_maintain">{{ isset($result->city) ?  CustomHelper::get_city_name($result->city) : 'N/A' }}</p>
							</td>
							<th class="text-center" width="25%">{{ trans("messages.global.degree") }}</th>
							<td>
								<p class="description_maintain">{{ isset($result->degree) && !empty(Config::get('SURVE_QUESTION_CATEGORY.'.$result->degree)) ?  Config::get('SURVE_QUESTION_CATEGORY.'.$result->degree) : 'N/A' }}</p>
							</td>
						</tr>

						<tr>
							@if($result->expert_id)
							<th class="text-center" width="25%">{{ trans("messages.global.expert") }}</th>
							<td>
							<p class="description_maintain">{{ isset($result->getExpertName->name) ?  $result->getExpertName->name : 'N/A' }}</p>
							</td>
							@endif
							<th class="text-center" width="25%">{{ trans("messages.global.created_on") }}</th>
							<td>
								<p class="description_maintain">{{ isset($result->created_at) ?  CustomHelper::displayDate($result->created_at) : 'N/A' }}</p>
							</td>
						</tr>

					</table>
					@if($result->getAllSurveyQuestionAnswer->isNotEmpty() )
					<table class="table table-bordered table-striped table-hover">
						<?php
						$srNo = 1;
						?>
						@foreach($result->getAllSurveyQuestionAnswer as $value)
						<tr>
							<th>{{ trans('messages.global.question').' '.$srNo }}</th>
							<td>{{ $value->question }}</td>
						</tr>
						<tr>
							<th>{{ trans('messages.global.answer') }}</th>
							<td>{{ $value->answer }}</td>
						</tr>
						<?php $srNo++; ?>
						@endforeach
					</table>
					@else
					<table class="table table-bordered table-striped table-hover">
						<tr>
							<td align="center" width="100%" colspan="15"> {{ trans("messages.global.no_record_found_message") }} </td>
						</tr>
					</table>
					@endif
				</div>

			</div>
		</div>
	</div>
</div>
@stop