@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('block') }}
@stop

@section('content')
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 {{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form']) }}
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
                <div id="panel-collapse-id" class="panel-collapse collapse {{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true" style="">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
									   {{ Form::text('page_name',((isset($searchVariable['page_name'])) ? $searchVariable['page_name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.$modelName.page_name")]) }}

                                    </div>

                                </div>
                            </div>

                            <!-- Search by Email -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">

										 {{ Form::text('block_name',((isset($searchVariable['block_name'])) ? $searchVariable['block_name'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.block_name")]) }}
                                    </div>
                                </div>
                            </div>

                        </div>

						<div class="row clearfix ">
							<div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
								<button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>

								<a href='{{ route("$modelName.index")}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
		 {{ Form::close() }}
    </div>
</div>
<!-- Search Panel -->

<!-- Hover Rows -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ trans("messages.$modelName.table_heading_index") }}

					<ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
					@if(env('APP_ENV') == 'local')	
                    <li>
							<a href='{{ route("$modelName.add")}}' >
								<button type="button" class="btn bg-indigo waves-effect">
									<i class="material-icons font-14">add</i> {{ trans("messages.$modelName.add_new") }}
								</button>
							</a>
						</li>
                        @endif
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
                        <tr role="row">
                            <th class="{{(($sortBy == 'page_name' && $order == 'desc') ? 'sorting_desc' : (($sortBy == 'page_name' && $order == 'asc') ? 'sorting_asc' : 'sorting')) }} ">
                            	{{link_to_route("$modelName.index",	trans("messages.$modelName.page_name"),	array(
									'records_per_page' => $recordPerPage,'sortBy' => 'page_name','order' => ($sortBy == 'page_name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
									array('class' => (($sortBy == 'page_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'page_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
                                }}
                            </th>
                            <th class="{{(($sortBy == 'block_name' && $order == 'desc') ? 'sorting_desc' : (($sortBy == 'block_name' && $order == 'asc') ? 'sorting_asc' : 'sorting'))}}">
                            	{{link_to_route("$modelName.index",trans("messages.$modelName.block_name"),	array(
									'records_per_page' => $recordPerPage,'sortBy' => 'block_name','order' => ($sortBy == 'block_name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
									array('class' => (($sortBy == 'block_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'block_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
                                }}
                            </th>
                            <th class="{{(($sortBy == 'created_at' && $order == 'desc') ? 'sorting_desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting_asc' : 'sorting'))}}">
                            	{{link_to_route("$modelName.index",	trans("messages.$modelName.created_at"),array(
									'records_per_page' => $recordPerPage,'sortBy' => 'created_at','order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
									array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
									)
                                }}
							</th>
                            <th>{{ trans("messages.global.action") }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if(!$model->isEmpty())
							@foreach($model as $result)
							<tr>
								<td data-th='{{ trans("messages.$modelName.page_name") }}'>{{ $result->page_name }}</td>
								<td data-th='{{ trans("messages.$modelName.block_name") }}'>{{ strip_tags(Str::limit($result->block_name, 300)) }}</td>
								<td data-th='{{ trans("messages.$modelName.created_at") }}'>{{ CustomHelper::displayDate($result->created_at) }}</td>
								<td data-th='{{ trans("messages.global.action") }}'>
									<a href='{{route("$modelName.edit","$result->id")}}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button></a>
								</td>
							</tr>
							@endforeach
						@else
						<tr>
							<td align="center" width="100%" colspan="5">{{ trans("messages.global.no_record_found_message") }} </td>
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

