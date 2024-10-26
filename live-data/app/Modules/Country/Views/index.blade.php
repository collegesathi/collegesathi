@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('country-list') }}
@stop

@section('content')
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get','role' => 'form','route' => array('Country.index'),'class' => 'mws-form']) }}

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
                            <!-- Search by Date Range -->
                            {{--
	                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
	                                <div class="form-group">
	                                    <div class="form-line">

											{{ Form::select('active',array(''=>trans('messages.AdminUser.please_select_status'),0=>'Inactive',1=>'Active'),((isset($searchVariable['active'])) ? $searchVariable['active'] : ''), ['class' => 'form-control','data-live-search'=>"true"]) }}
	                                    </div>
	                                </div>
	                            </div>
							--}}
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                      {{ Form::text('country_name',((isset($searchVariable['country_name'])) ? $searchVariable['country_name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.Country.country_name")]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{ Form::text('country_iso_code',((isset($searchVariable['country_iso_code'])) ? $searchVariable['country_iso_code'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.Country.country_iso_code")]) }}

									</div>
                                </div>
                            </div>

                        </div>
						<div class="row clearfix ">
                            <!-- Search by Date Range -->

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                     {{ Form::text('country_code',((isset($searchVariable['country_code'])) ? $searchVariable['country_code'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.Country.country_code")]) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                     {{ Form::text('currency',((isset($searchVariable['currency'])) ? $searchVariable['currency'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.Country.currency")]) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("Country.index")}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
                    {{ trans("messages.Country.table_heading_index") }}


                    <!-- <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm">
                       <li>
                            <a href='{{route("Country.add")}}' >
                                <button type="button" class="btn bg-indigo waves-effect">
                                    <i class="material-icons font-14">add</i> {{ trans("messages.Country.add_new") }}
                                </button>
                            </a>
                        </li>
                    </ul> -->
                </h2>
            </div>
			 <div class="body">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            @include('admin.elements.admin_paging_dropdown')
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                        <tr>
					<!--<th width="5%"></th>-->
					<th>
						{{	link_to_route('Country.index',trans("messages.Country.country_name"),array(						'records_per_page' => $recordPerPagePagination,	'sortBy' => 'country_name','order' => ($sortBy == 'country_name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'country_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'country_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th >
						{{ link_to_route('Country.index',trans("messages.Country.country_iso_code"),array(				'records_per_page' => $recordPerPagePagination,'sortBy' => 'country_iso_code','order' => ($sortBy == 'country_iso_code' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'country_iso_code' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'country_iso_code' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th >
						{{	link_to_route('Country.index',trans("messages.Country.country_code"),array(					'records_per_page' => $recordPerPagePagination,'sortBy' => 'country_code','order' => ($sortBy == 'country_code' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'country_code' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'country_code' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					 
					
					
					<th>{{ trans("messages.global.status") }}</th>
					{{--<th >
						{{
							link_to_route(
							'Country.index',
							 trans("messages.global.status"),
							 array(
								'records_per_page' => $recordPerPagePagination,
								'sortBy' => 'status',
								'order' => ($sortBy == 'status' && $order == 'desc') ? 'asc' : 'desc'
							 ),
							 array('class' => (($sortBy == 'status' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'status' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							 )
						}}

					</th>--}}



					<th>{{ trans("messages.global.action") }}</th>
					</tr>
                    </thead>
                    <tbody id="powerwidgets">
                       @if(!$result->isEmpty())
					   @foreach($result as $record)
                       <tr class="items-inner">
							<!--<td data-th=' {{ trans("messages.system_management.select") }}'>
							{{ Form::checkbox('status',$record->id,null,['class'=> 'userCheckBox'] )}}
							</td>-->
							<td data-th='{{ trans("messages.Country.country_name") }}'>{{ $record->country_name }}</td>
							<td data-th='{{ trans("messages.Country.country_iso_code") }}'>{{ $record->country_iso_code }}</td>
							<td data-th='{{ trans("messages.Country.country_code") }}'>{{ $record->country_code }}</td>
							 
							 
							
							<td data-th='{{ trans("messages.global.status") }}'>
								@if($record->status==1)
									<span class="label label-success">{{ trans("messages.global.activated") }}</span>
								@else
									<span class="label label-warning">{{ trans("messages.global.deactivated") }}</span>
								@endif
							</td>

							<td data-th='{{ trans("messages.global.action") }}'>

								 <a href='{{ route( "Country.edit",$record->id)}}' class="text-decoration-none">
									<button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button>
								 </a>

								 @if($record->status == 1)
									@if($record->is_default == 0)

										 <a class="text-decoration-none confirm_box"   data-href='{{ route("Country.status",array($record->id,INACTIVE))}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >
												<button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}</button>
										</a>


									@endif
								@else
									 <a class="text-decoration-none confirm_box"  data-href='{{ route("Country.status",array($record->id,ACTIVE) )}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
										<button type="button" class="btn btn-warning  waves-effect btn-sm"><i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}</button>
									</a>
								@endif



								<a href="{{ route('State.index',$record->id) }}" class="btn btn-info btn-small">{{ trans("messages.Country.states") }} </a>

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
                    @include('pagination.default', ['paginator' => $result,'searchVariable'=>$searchVariable])
                </div>
            </div>
		</div>
	</div>
</div>
@stop
