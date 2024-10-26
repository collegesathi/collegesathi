@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
{{ Breadcrumbs::render('survey-page-list') }}
@stop
<script type="text/javascript">
	var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>
{{ HTML::script('js/admin/multiple_delete.js') }}



<!-- Search Panel -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		{{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form','id'=>'surveySearch']) }}
		{{ Form::hidden('display',1) }}
		{{ Form::hidden('sortBy', $sortBy) }}
		{{ Form::hidden('order', $order) }}
		{{ Form::hidden('records_per_page', $limit) }}


		<div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
			<div class="panel panel-col-pink">
				<div class="panel-heading" role="tab" id="panel-heading-id">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-target="#panel-collapse-id" data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true" aria-controls="panel-collapse-id" class="{{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? '' : 'collapsed' }}">
							<i class="material-icons">search</i> Search
							<span class="pull-right collapse-toggle-icon"></span>
							<span>
								{{ trans("messages.global.click_here_to_expand") }}
							</span>
						</a>
					</h4>
				</div>

				<div id="panel-collapse-id" class="panel-collapse collapse {{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
					<div class="panel-body">
						<div class="row clearfix ">

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
								<div class="form-group">
									<div class="form-line">
										{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.name")]) }}
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
								<div class="form-group">
									<div class="form-line">
										{{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.email")]) }}
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
								<div class="form-group">
									<div class="form-line">
										{{ Form::text('phone',((isset($searchVariable['phone'])) ? $searchVariable['phone'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.phone")]) }}
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('state', ['' => trans('messages.global.please_select_status')]+$stateList, isset($searchVariable['state']) ? $searchVariable['state'] : '', ['class' => 'form-control', 'data-live-search' => 'true']) }}
                                    </div>
                                </div>
                            </div>
							
						</div>
						<div class="row clearfix ">
							<div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
								<button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
								<a href='{{ route("$modelName.index")}}'><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

<!-- Hover Rows -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>
					{{ trans("messages.$modelName.table_heading_index") }}

				</h2>
			</div>
			<div class="body table-responsive">
				<div class="row">
					<div class="col-sm-8">
						<div class="dataTables_length" id="DataTables_Table_0_length">
							@include('admin.elements.admin_paging_dropdown')
						</div>
					</div>
					<div class="col-sm-3 pull-right">
						<div class="form-group">
							<div class="form-line">
								<?php
								$actionTypes = array(
									'delete' => trans('messages.global.delete'),
								);
								?>
								{{ Form::open() }}
								{{Form::select('action_type',array(''=>trans("messages.global.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control','data-live-search'=>"true"])}}
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>

				<table class="table table-bordered table-striped table-hover ">
					<thead>
						<tr role="row">
							@if(!$model->isEmpty())
							<th class="align-center valign-middle">{{ Form::checkbox('is_checked','',null,['class'=>'left checkAllUser filled-in','id'=>'remember_me'])}}
								<label for="remember_me" class="table_checkbox"></label>
							</th>
							@endIf

							<th> {{ trans("messages.$modelName.name") }} </th>
							<th width="10%">{{ trans("messages.global.gender") }}</th>
							<th width="20%">{{ trans("messages.global.contact") }}</th>
							<th width="10%">{{ trans("messages.global.date_of_birth") }}</th>
							<th width="20%">{{ trans("messages.global.location") }}</th>
							<th>{{ trans("messages.global.action") }}</th>
						</tr>
					</thead>
					<tbody id="powerwidgets">
						@if(!$model->isEmpty())
						@foreach($model as $record)
						<tr class="items-inner">
							<td data-th='{{ trans("messages.global.select") }}' class="align-center">
								{{ Form::checkbox('status',$record->id,null,['class'=> 'userCheckBox filled-in','id'=>'selected_all_'.$record->id] )}}
								<label for="selected_all_{{ $record->id }}"></label>
							</td>

							<td data-th='{{ trans("messages.$modelName.page_name") }}'>{{ isset($record->name) ? $record->name : 'N/A'}}</td>

							<td data-th='{{ trans("messages.$modelName.page_name") }}'>

								<?php if (isset($record->gender)) {
									if ($record->gender == 1) {
										echo "Male";
									} else {
										echo "Female";
									}
								} ?>
							</td>
							<td data-th='{{ trans("messages.$modelName.page_name") }}'>
								{{ trans("messages.global.email_detail") }}
								<a href="mailto:{{  $record->email }}">{{ $record->email }}</a></br>
								{{ trans("messages.global.contact_number") }}
								<a href="tel:{{  $record->phone }}">{{ $record->phone  }}</a>
							</td>
							<td data-th='{{ trans("messages.global.status") }}'>
								{{ isset($record->date_of_birth	) ? $record->date_of_birth	 : 'N/A'}}
							</td>
							<td data-th='{{ trans("messages.global.created") }}'>
								{{ trans("messages.global.state") }}
								{{ isset($record->state	) ? CustomHelper::get_state_name($record->state) : 'N/A'}}</br>
								{{ trans("messages.global.city") }}
								{{ isset($record->city	) ? CustomHelper::get_city_name($record->city)	 : 'N/A'}}
							</td>
							<td data-th='{{ trans("messages.global.action") }}'>
								<a href='{{route("$modelName.view","$record->id")}}' class="text-decoration-none"><button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">visibility</i>{{ trans("messages.global.view") }}</button></a>
							</td>
						</tr>
						@endforeach
						@else
						<tr>
							<td align="center" width="100%" colspan="5"> {{ trans("messages.global.no_record_found_message") }} </td>
						</tr>
						@endif
					</tbody>
				</table>
				<div class="row">
					@include('pagination.default', ['paginator' => $model,'searchVariable'=>$searchVariable])
				</div>
			</div>
		</div>
	</div>
</div>


<!-- #END# Hover Rows -->
@stop