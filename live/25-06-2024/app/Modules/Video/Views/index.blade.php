@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('video-page-list') }}
@stop
<script type="text/javascript">
var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>
{{ HTML::script('js/admin/multiple_delete.js') }}



<!-- Search Panel -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		{{ Form::open(['method' => 'get','role' => 'form','url' =>  route("UniversityVideo.index","$uni_id"),'class' => 'mws-form']) }}
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
					<div id="panel-collapse-id" class="panel-collapse collapse {{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true" style="">
						<div class="panel-body">
							<div class="row clearfix ">
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.title")]) }}
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
									<div class="form-group">
										<div class="form-line">
											{{ Form::text('youtube_id',((isset($searchVariable['youtube_id'])) ? $searchVariable['youtube_id'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.youtube_id")]) }}
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
									<div class="form-group">
										<div class="form-line">
											{{ Form::select('active',array(''=>trans('messages.global.please_select_status'),0=>'Inactive',1=>'Active'),((isset($searchVariable['active'])) ? $searchVariable['active'] : ''), ['class' => 'form-control','data-live-search'=>"true"]) }}
										</div>
									</div>
								</div>
							</div>
							<div class="row clearfix ">
								<div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
									<button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
										<a href='{{ route("UniversityVideo.index",$uni_id)}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
					{{ isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id)." -> " : '' }}{{ trans("messages.$modelName.table_heading_index") }}
					<ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
						<li>
							<a href='{{ route("University.index")}}' >
								<button type="button" class="btn bg-indigo waves-effect">
									<i class="material-icons font-14">keyboard_backspace</i> {{ trans("messages.global.back") }}
								</button>
							</a>
							<a href='{{ route( "UniversityVideo.add",$uni_id) }}' >
								<button type="button" class="btn bg-indigo waves-effect">
									<i class="material-icons font-14">add</i> {{ trans("messages.$modelName.add_new") }}
								</button>
							</a>
						</li>
					</ul>
				</h2>
			</div>
			<div class="body table-responsive">
				<div class="row">
					<div class="col-sm-8">
						<div class="dataTables_length" id="DataTables_Table_0_length">
							@include('admin.elements.admin_paging_dropdown')
						</div>
					</div>
					<div class="col-sm-3 pull-right" >
						<div class="form-group">
							<div class="form-line">
								<?php
									$actionTypes = array(
										'inactive' => trans('messages.global.mark_as_inactive'),
										'active'   => trans('messages.global.mark_as_active'),
										'delete'   => trans('messages.global.delete'),
									);
								?>
								{{ Form::open() }}
									{{	Form::select('action_type',array(''=>trans("messages.global.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control','data-live-search'=>"true"])	}}
								{{ Form::close() }}
							</div>
						</div>
					</div>
				</div>
				<table class="table table-bordered table-striped table-hover "  >
					<thead>
						<tr role="row">
							@if(!$model->isEmpty())
								<th class="align-center valign-middle">{{ Form::checkbox('is_checked','',null,['class'=>'left checkAllUser filled-in','id'=>'remember_me'])}}
								<label for="remember_me" class="table_checkbox"></label></th>
							@endIf

							<th> {{ trans("messages.$modelName.image") }} </th>

							<th  width="15%" class="{{(($sortBy == 'name' && $order == 'desc') ? 'sorting_desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting_asc' : 'sorting')) }} ">
								{{ trans("messages.global.title") }}
							</th>
							<th width="15%">{{ trans("messages.global.duration") }}</th>
							<th width="15%">{{ trans("messages.global.youtube_id") }}</th>
							<th width="10%">{{ trans("messages.global.status") }}</th>
							<th>
								{{ trans("messages.global.created") }}
							</th>
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

									<td data-th='{{ trans("messages.$modelName.small_image") }}'>

										@if ($record->image != '' && File::exists(VIDEO_IMAGE_ROOT_PATH . $record->image))

											@php  echo CustomHelper::showUserImage(VIDEO_IMAGE_ROOT_PATH, VIDEO_IMAGE_URL,  $record->image,  $record->gender, ['alt' => $record->full_name, 'height' =>'60', 'width' =>'60']);  @endphp


										@else
											{{ 'No Image' }}
										@endif
									</td>

									<td data-th='{{ trans("messages.$modelName.name") }}'>{{ $record->name }}</td>
									<td data-th='{{ trans("messages.$modelName.duration") }}'>{{ $record->duration }}</td>
									<td data-th='{{ trans("messages.$modelName.youtube_id") }}'>{{ $record->youtube_id }}</td>

								
									<td data-th='{{ trans("messages.global.status") }}'>
										@if($record->is_active  == ACTIVE)
											<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
										@else
											<span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
										@endif
									</td>
									<td  data-th='{{ trans("messages.global.created") }}'>
										{{ CustomHelper::displayDate($record->created_at) }}

									</td>
									<td data-th='{{ trans("messages.global.action") }}'>

										<a href='{{ route( "UniversityVideo.edit",[$record->id,$uni_id]) }}' class="text-decoration-none">
											<button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button>
										</a>

										<a href='{{route("UniversityVideo.view",[$record->id,$uni_id]) }}' class="text-decoration-none"><button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">visibility</i>{{ trans("messages.global.view") }}</button></a>

										@if($record->is_active == 1)
											<a class="text-decoration-none confirm_box"   data-href='{{ route("UniversityVideo.status",array($record->id,INACTIVE,$uni_id))}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >
												<button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}</button>
											</a>
										@else
											<a class="text-decoration-none confirm_box"  data-href='{{ route("UniversityVideo.status",array($record->id,ACTIVE,$uni_id) )}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
												<button type="button" class="btn btn-warning  waves-effect btn-sm"><i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}</button>
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td align="center" width="100%" colspan="7">  {{ trans("messages.global.no_record_found_message") }} </td>
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
