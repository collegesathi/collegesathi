@extends('admin.layouts.default')
@section('content')
<script type="text/javascript">
	var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>

{{ HTML::script('js/admin/multiple_delete.js') }}


<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if ($id != '' && $type == 'course')
            {{ Form::open(['method' => 'get','role' => 'form','url' => route("$modelName.courseSpecifications",[$type,$id]),'class' => 'mws-form']) }}
        @else
            {{ Form::open(['method' => 'get','role' => 'form','url' => route("$modelName.index",$type),'class' => 'mws-form']) }}
        @endif
       {{ Form::hidden('display',1) }}
       {{ Form::hidden('sortBy', $sortBy) }}
       {{ Form::hidden('order', $order) }}
       {{ Form::hidden('records_per_page', $recordPerPage) }}
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
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control', 'placeholder'=>'Name']) }}
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
                                
                                @if ($id != '' && $type == 'course')
                                    <a href='{{ route("$modelName.courseSpecifications",[$type,$id])}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                                @else
                                    <a href='{{ route("$modelName.index",$type)}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>


<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    @if ($id != '' && $type == 'course')
                        {{ trans("messages.$modelName.$type.specification_table_heading_index") }}
                    @else
                        {{ trans("messages.$modelName.$type.table_heading_index") }}
                    @endif
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                    @if(env('APP_ENV') == 'local')
                        @if ($id != '' && $type == 'course')    
                            <li>
                                <a href='{{ route("$modelName.index",$type)}}' >
                                    <button type="button" class="btn bg-black waves-effect">
                                        <i class="material-icons font-14">arrow_back</i> {{ trans("messages.global.back") }}
                                    </button>
                                </a>
                            </li>
                            <li>
                                <a href='{{ route("$modelName.addSpecification",[$type,$id])}}' >
                                    <button type="button" class="btn bg-indigo waves-effect">
                                        <i class="material-icons font-14">add</i> {{ trans("messages.$modelName.add_new") }}
                                    </button>
                                </a>
                            </li>
                        @else
                            <li>
                                <a href='{{ route("$modelName.add",$type)}}' >
                                    <button type="button" class="btn bg-indigo waves-effect">
                                        <i class="material-icons font-14">add</i> {{ trans("messages.$modelName.add_new") }}
                                    </button>
                                </a>
                            </li>
                        @endif
                    @endif
                    </ul>
                </h2>
            </div>
			 <div class="body">
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
                                    'active' => trans('messages.global.mark_as_active'),
                                );
                                ?>
                                {{ Form::open() }}


								{{Form::select('action_type',array(''=>trans("messages.global.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control','data-live-search'=>"true"])}}
								{{ Form::hidden('dropdown_type',$type,['id'=>'dropdown_type']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                        <tr role="row">
							@if(!$model->isEmpty())
								<th>{{ Form::checkbox('is_checked','',null,['class'=>'left checkAllUser filled-in','id'=>'remember_me'])}}
								<label for="remember_me" class="table_checkbox"></label></th>
							@endIf
                            
                            @if ($id != '' && $type == 'course')
                                <th width="10%">{{ trans("messages.$modelName.$type.name") }}</th>
                            @else
                                <th width="10%">
                                    {{ link_to_route("$modelName.index",trans("messages.$modelName.$type.name"),array($type,'records_per_page' => $recordPerPage,'sortBy' => 'name','order' => ($sortBy == 'name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable, array('class' => (($sortBy == 'name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )) }}
                                </th>
                            @endif

                            @if ($id != '' && $type == 'course')
                                <th width="10%">{{ trans("messages.$modelName.$type.full_name") }}</th>
                            @else
                                @if (in_array($type, ['course']))
                                <th width="20%">
                                    {{	link_to_route("$modelName.index",trans("messages.$modelName.$type.full_name"),array(
                                            $type,'records_per_page' => $recordPerPage,'sortBy' => 'full_name','order' => ($sortBy == 'full_name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                                    array('class' => (($sortBy == 'full_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'full_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
                                    )
                                    }}
                                    </th>
                                @endif
                            @endif

                            @if(in_array($type, DROPDOWN_TYPES_FOR_ORDER))
							<th>
								{{	link_to_route("$modelName.index",trans("messages.$modelName.order"),array(
										$type,'records_per_page' => $recordPerPage,'sortBy' => 'dropdown_order',
										'order' => ($sortBy == 'dropdown_order' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
								   array('class' => (($sortBy == 'dropdown_order' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'dropdown_order' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
								)
							}}
							</th>
							@endif



							<th width="20%">{{ trans("messages.global.status") }}</th>

                            @if ($id != '' && $type == 'course')
                                <th width="10%">{{ trans("messages.global.created") }}</th>
                            @else
							<th width="20%">
						        {{	link_to_route("$modelName.index",trans("messages.global.created"),array($type,					'records_per_page' => $recordPerPage,'sortBy' => 'created_at',	'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
									   array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
								}}
							</th>
                            @endif

							<th>{{trans("messages.global.action")}}</th>
						</tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if(!$model->isEmpty())
                        @foreach($model as $record)
                        <tr class="items-inner">
							<td data-th='{{ trans("messages.global.select") }}'>
								{{ Form::checkbox('status',$record->id,null,['class'=> 'userCheckBox filled-in','id'=>'selected_all_'.$record->id] )}}
								<label for="selected_all_{{ $record->id }}"></label>
							</td>
                            <td data-th='{{ trans("messages.$modelName.name") }}'>{{$record->name }}</td>

                            @if (in_array($type, ['course']))
                                <td data-th='{{ trans("messages.$modelName.full_name") }}'>{{$record->full_name }}</td>
                            @endIf
							@if(in_array($type, DROPDOWN_TYPES_FOR_ORDER))
								<td data-th='{{ trans("messages.$modelName.order") }}'>{{$record->dropdown_order }}</td>
							@endIf

						<td data-th='{{ trans("messages.global.status") }}'>
							@if($record->status	== ACTIVE)
								<span class="label label-success" >{{ trans("messages.global.activated") }}</span>
							@else
								<span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
							@endif
						</td>
						<td data-th='{{ trans("messages.global.created") }}'>{{ CustomHelper::displayDate($record->created_at) }}</td>
						<td data-th='{{ trans("messages.global.action") }}'>
                            @if ($type == 'course' && $id != '')
                                <a href='{{ route( "$modelName.editSpecification",array($record->id,$type,$id))}}' class="text-decoration-none">
                                    <button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button>
                                </a>
                            @else
                                <a href='{{ route( "$modelName.edit",array($record->id,$type))}}' class="text-decoration-none">
                                    <button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button>
                                </a>
                            @endif

						    @if($record->status)
                                <a class="text-decoration-none confirm_box"   data-href='{{ route("$modelName.status",array($record->id,INACTIVE,$type,$id))}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >

                                    <button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}</button>
                                </a>
                            @else
                                <a class="text-decoration-none confirm_box"  data-href='{{ route("$modelName.status",array($record->id,ACTIVE,$type) )}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                                    <button type="button" class="btn btn-warning  waves-effect btn-sm"><i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}</button>
                                </a>
                            @endif

                            @if ($type == 'course' && $id == '')
                                <a href='{{ route( "$modelName.courseSpecifications",array($type,$record->id))}}' class="text-decoration-none">
                                    <button type="button" class="btn bg-blue  waves-effect btn-sm"><i class="material-icons font-14">list</i>{{ trans("messages.global.course_specifications") }}</button>
                                </a>
                            @endif
						</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td align="center" width="100%" colspan="5">  {{ trans("messages.global.no_record_found_message") }} </td>
						</tr>
                        @endif
                    </tbody>
                </table>
                </div>
                <div class="row">
                    @include('pagination.default', ['paginator' => $model,'searchVariable'=>$searchVariable])
                </div>
            </div>
		</div>
	</div>
</div>
@stop
