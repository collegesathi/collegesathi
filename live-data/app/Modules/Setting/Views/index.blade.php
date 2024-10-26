@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('setting-list') }}
@stop

@section('content')
<script type="text/javascript">
$(function(){
	$('[data-delete]').click(function(e){
		
	     e.preventDefault();
		// If the user confirm the delete
		if (confirm('Do you really want to delete the element ?')) {
			// Get the route URL
			var url = $(this).prop('href');
			// Get the token
			var token = $(this).data('delete');
			// Create a form element
			var $form = $('<form/>', {action: url, method: 'post'});
			// Add the DELETE hidden input method
			var $inputMethod = $('<input/>', {type: 'hidden', name: '_method', value: 'delete'});
			// Add the token hidden input
			var $inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
			// Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
			$form.append($inputMethod, $inputToken).hide().appendTo('body').submit();
		} 
	});
});
</script>



<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 {{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form']) }}
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
									   
									   
									   {{ Form::text('title',((isset($searchVariable['title'])) ? $searchVariable['title'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.title")]) }}
                               
                                    </div>
                               
                                </div>
                            </div>
                            
                            <!-- Search by Email -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                     
										{{ Form::text('key_value',((isset($searchVariable['key_value'])) ? $searchVariable['key_value'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.key") ]) }}
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



<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ trans("messages.$modelName.table_heading_index") }} 
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm">
                      <li>
                            <a href='{{route("$modelName.add")}}' >
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
                        <tr role="row">
							
					<th width="25%">
					{{
						link_to_route(
							"$modelName.index",
							trans("messages.$modelName.title"),
							array(
								'records_per_page' => $recordPerPagePagination,
								'sortBy' => 'title',
								'order' => ($sortBy == 'title' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'title' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'title' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
					</th>
					<th width="25%">
					{{
						link_to_route(
							"$modelName.index",
								trans("messages.$modelName.key"),
								array(
									'records_per_page' => $recordPerPagePagination,
									'sortBy' => 'key_value',
									'order' => ($sortBy == 'key_value' && $order == 'desc') ? 'asc' : 'desc'
								),
							   array('class' => (($sortBy == 'key_value' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'key_value' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
					}}
	                </th>
					<th width="25%">
					{{
						link_to_route(
							"$modelName.index",
							trans("messages.$modelName.value"),
							array(
								'records_per_page' => $recordPerPagePagination,
								'sortBy' => 'value',
								'order' => ($sortBy == 'value' && $order == 'desc') ? 'asc' : 'desc'
							),
						   array('class' => (($sortBy == 'value' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'value' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
						)
					}}
	                </th>
					<th>{{ trans("messages.global.action") }}</th>
                    </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if(!$model->isEmpty())
                        @foreach($model as $result)
                        <?php
					$key = $result->key_value;
					$keyE = explode('.', $key);
					$keyPrefix = $keyE['0'];
					if (isset($keyE['1'])) {
						$keyTitle = '.' . $keyE['1'];
					} else {
						$keyTitle = '';
					}
					?>
				<tr>
					
					<td data-th='{{ trans("messages.$modelName.title") }}'>{{ $result->title }}</td>
					<td data-th='{{ trans("messages.$modelName.key") }}'>
						<a target="_blank" href='{{ route("Setting.prefix_index",array($keyPrefix)) }}' >{{ $keyPrefix }}</a>{{ $keyTitle }}
					</td>
					<td data-th='{{ trans("messages.$modelName.value") }}'>
						{{ strip_tags(Str::limit($result->value, 20)) }}
					</td>	
					<td data-th='{{ trans("messages.global.action") }}'>
						<a href='{{route("$modelName.edit","$result->id")}}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">mode_edit</i>{{ trans("messages.global.edit") }}</button></a>
								
						<a data-href='{{route("$modelName.delete","$result->id")}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_delete_this_record')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}"  >
						
						<button type="button" class="btn  btn-danger  waves-effect btn-sm">
							<i class="material-icons font-14">delete</i>
						{{ trans("messages.global.delete") }}
						</button>
						</a>
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
