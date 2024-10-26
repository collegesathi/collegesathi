@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('city-list', $data) }}
@stop

@section('content')
<script type="text/javascript">
 var action_url = '<?php echo route("City.Multipleaction"); ?>';
 var csrf_token = '{{ csrf_token()}}';
</script>
<script type="text/javascript" src="{!! asset('js/admin/multiple_delete.js') !!}"></script>
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       {{ Form::open(['method' => 'get','role' => 'form',route("City.index","$stateId"),'class' => 'mws-form']) }}

       {{ Form::hidden('display',1) }}
		{{ Form::hidden('sortBy', $sortBy) }}
		{{ Form::hidden('order', $order) }}
		{{ Form::hidden('records_per_page', $recordPerPagePagination) }}

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
										{{ Form::text('city_name',((isset($searchVariable['city_name'])) ? $searchVariable['city_name'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.City.city_name")]) }}
                                    </div>
                                </div>
                            </div>
                             <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('status',array(''=>trans('messages.global.please_select_status'),0=>'Inactive',1=>'Active'),((isset($searchVariable['status'])) ? $searchVariable['status'] : ''), ['class' => 'form-control','data-live-search'=>"true"]) }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href="{{ route('City.index',$stateId) }}"><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
                  {{ trans("messages.City.table_heading_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                       <li>
                            <a href="{{ route('City.add',$stateId) }}" >
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i> {{ trans("messages.City.add_new") }}
                                </button>
                            </a>
                            <a href="{{ route('State.index',$countryId) }}" >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
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
                </div>
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                   <tr>
					<!--<th width="5%"></th>-->
					<th width="15%">
						{{ 	link_to_route('City.index',	trans("messages.City.city_name"),array($stateId,'sortBy' => 'city_name','order' => ($sortBy == 'city_name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'city_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'city_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>

					<th width="20%">{{ trans("messages.Country.country_name") }}</th>
					<th width="20%">{{ trans("messages.State.state_name") }}</th>
					<th width="10%">{{ trans("messages.global.status") }}</th>
					<th>{{ trans("messages.global.action") }}</th>
				</tr>
                    </thead>
                    <tbody id="powerwidgets">
                       @if(!$result->isEmpty())
					   @foreach($result as $record)
						<tr class="items-inner">
							<td data-th='{{ trans("messages.City.city_name") }}'>{{ $record->city_name }}</td>
							<td data-th='{{ trans("messages.Country.country_name") }}'>
							<?php if(!empty($record->country_id)){
									$country_name =	CustomHelper::get_country_name($record->country_id);
									echo $country_name;
								}
								?>
							</td>
							<td data-th='{{ trans("messages.State.state_name") }}'>
							<?php if(!empty($record->state_id)){
									$state_name =	CustomHelper::get_state_name($record->state_id);
									echo $state_name;
								}
								?>
							</td>
							<td data-th='{{ trans("messages.global.status") }}'>
								@if($record->status==1)
									<span class="label label-success">{{ trans("messages.global.activated") }}</span>
								@else
									<span class="label label-warning">{{ trans("messages.global.deactivated") }}</span>
								@endif
							</td>
							<td data-th='{{ trans("messages.global.action") }}'>
								<a href="{{ route('City.edit',array($stateId,$record->id)) }}" class="text-decoration-none">
									<button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button>
								</a>

								@if($record->status == 1)
									<a class="text-decoration-none confirm_box"   data-href="{{ route('City.status',array($record->id,INACTIVE)) }}"  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >
											<button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}</button>
									</a>
								@else
									 <a class="text-decoration-none confirm_box"  data-href="{{ route('City.status',array($record->id,ACTIVE)) }}"  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
											<button type="button" class="btn btn-warning  waves-effect btn-sm"><i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}</button>
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
                <div class="row">
                    @include('pagination.default', ['paginator' => $result,'searchVariable'=>$searchVariable])
                </div>
            </div>
		</div>
	</div>
</div>
@stop
