@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('TextSetting', ['title' => trans("messages.$modelName.table_heading_index_$type"), 'type' => $type]) }}
@stop

@section('content')
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       	{{ Form::open(['method' => 'get','role' => 'form',route("$modelName.index",$type),'class' => 'mws-form']) }}
		{{ Form::hidden('display',1) }}
        <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
            <div class="panel panel-col-pink">
                <div class="panel-heading" role="tab" id="panel-heading-id">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-target="#panel-collapse-id" data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true" aria-controls="panel-collapse-id" class="{{ ($searchVariable && !isset($searchVariable['records_per_page'])) ? '' : 'collapsed' }}">
                            <i class="material-icons">search</i> Search
                            <span class="pull-right collapse-toggle-icon"></span>
                            
								<span>
								{{ trans("messages.global.click_here_to_expand") }}	
								</span>
                        </a>
                    </h4>
                </div>

                <div id="panel-collapse-id" class="panel-collapse collapse {{ ($searchVariable && !isset($searchVariable['records_per_page'])) ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true" style="">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
										{{ Form::text('key_value',((isset($searchVariable['key_value'])) ? $searchVariable['key_value'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.key")]) }}
									</div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                       {{ Form::text('value',((isset($searchVariable['value'])) ? $searchVariable['value'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.value")]) }}
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.index",$type) }}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                       
                        <li>
                            <a href='{{ route("$modelName.add",$type)}}' >
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
                </div>
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                        <th>{{ trans("messages.$modelName.language") }}</th>
					<th width="35%">
						{{
							link_to_route(
							"$modelName.index",
							trans("messages.$modelName.key"),
							array(
								'type'	=>	$type,
								'records_per_page' => $recordPerPagePagination,

								'sortBy' => 'key_value',
								'order' => ($sortBy == 'key_value' && $order == 'desc') ? 'asc' : 'desc'
							),
							array('class' => (($sortBy == 'key_value' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'key_value' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
					<th width="35%">
						{{
							link_to_route(
							"$modelName.index",
							trans("messages.$modelName.value"),
							array(
								'type'	=>	$type,
								'records_per_page' => $recordPerPagePagination,

								'sortBy' => 'value',
								'order' => ($sortBy == 'value' && $order == 'desc') ? 'asc' : 'desc'
							),
							array('class' => (($sortBy == 'value' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'value' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>
						
					<th>{{ trans("messages.global.action") }}</th>
                    </thead>
                    <tbody id="powerwidgets">
                         @if(!$model->isEmpty())
                        @foreach($model as $result)
                        <tr>
							<td data-th='{{ trans("messages.$modelName.language")}}'>
								@if(array_key_exists($result->language_id ,$languageArray))
									{{ $languageArray[$result->language_id] }}
								@endif
							</td>
							<td data-th='{{ trans("messages.$modelName.key") }}'>{{ $result->key_value }}</td>
							<td data-th=' {{ trans("messages.$modelName.value") }}'>{{ $result->value }}</td>
							<td data-th='{{ trans("messages.global.action") }}'>
								<a href='{{route("$modelName.edit",array("$type","$result->id"))}}'  class="btn btn-info btn-small"><i class="material-icons font-14">mode_edit</i>{{trans("messages.global.edit") }} </a>
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
                    @include('pagination.default', ['paginator' => $model,'searchVariable'=>$searchVariable])
                </div>

            </div>
			
		</div>
	</div>
</div>
@stop
