@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('admin-modules') }}
@stop

@section('content')
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'multiple_delete.js') }}

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                   {{ trans("messages.$modelName.table_heading_index") }}
                   <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                       
                        <li>
                            <a href='{{ route("$modelName.add")}}' >
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
                       <tr>
						<th >{{ trans("messages.$modelName.module_title") }}</th>
						<th>{{ trans("messages.$modelName.module_parent_name") }}</th>
						<th>{{ trans("messages.$modelName.module_order") }}</th>
						<th >{{ trans("messages.$modelName.module_status") }}</th>
						<th>{{ trans("messages.global.action") }}</th>
					</tr>
                    </thead>
                    <tbody id="powerwidgets">
                        	@if(count($moduleList))
						@foreach($moduleList as $result)
                       <tr class="items-inner">
								<td data-th='{{ trans("messages.$modelName.page_name") }}'>
									@if($result['parentid'] == PARENT_ID)
										{{$result['title']}}
									@else
										<span>_{{$result['title']}}</span>
									@endif
								</td>
								<td data-th='{{ trans("messages.global.select") }}'>
									{{$result['parent']}}
								</td>
								<td data-th='{{ trans("messages.$modelName.block_name") }}'>
									<div class="order_by_number" id="link_{{ $result['module_order'] }}_{{$result['id']}}" onclick="change(this)">{{$result['module_order']}}</div>
									<div id="change_div{{$result['id']}}" class="hide">
										{{ Form::text(
												'order_by',
												$result['module_order'],
												['class'=>'span1','id'=>'order_by_'.$result['id'], 'style'=>'width:50px']
											)
										}}
										<a class="btn btn btn-success"  id="link_{{$result['module_order']}}_{{$result['id']}}" onclick="order(this)"  href="javascript:void(0);">
											<i class="fa fa-check"></i>
										</a>
									</div>
								</td>
								<td data-th='{{ trans("messages.$modelName.module_status") }}'>
									@if($result['status']==ACTIVE)
										<span class="label label-success">{{ trans("messages.$modelName.activate") }}</span>
									@else
										<span class="label label-warning">{{ trans("messages.$modelName.deactivate") }}</span>
									@endif
								</td>
								<td data-th='{{ trans("messages.global.action") }}'>
									<center>
										@if($result['status']==ACTIVE)
											<a href="{{route("$modelName.status", $result['id'])}}" class="status_user btn btn-warning btn-small status_manager" rel="tooltip" title="" data-original-title="{{ trans("messages.$modelName.deactivate") }}">{{ trans("messages.$modelName.deactivate") }}</a>
										@else
											<a href="{{route("$modelName.status", $result['id'])}}" class="status_user btn btn-success btn-small status_manager" rel="tooltip" title="" data-original-title="{{ trans("messages.$modelName.activate") }}">{{ trans("messages.$modelName.activate") }}</a>
										@endif
										<a href="{{route("$modelName.edit", $result['id'])}}" class=" btn btn-info btn-small">{{ trans("messages.global.edit") }} </a>
										@if(Config::get('app.debug'))
											<a href="{{route("$modelName.delete", $result['id'])}}" data-delete="delete" type="submit" class="delete_user btn btn-danger btn-small">{{ trans("messages.global.delete") }}</a>
										@endif
									</center>
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
		</div>
	</div>
</div>
<script>
		$(".delete_user").on("submit", function(){
			return confirm('{{ trans("messages.$modelName.admin_modules_delete") }}');
		});

		// for change order
		function change(obj){
			id_array		=	obj.id.split("_");
			current_id		=	id_array[2];
			current_order	=	id_array[1];
			order_by		=	$("#order_by_"+current_id).val();
			$("#change_div"+current_id).removeClass('hide');
			$("#link_"+current_order+"_"+current_id).hide();
			return false;
		}

		// for update the orderby value
		function order(obj){
			id_array		=	obj.id.split("_");
			current_id		=	id_array[2];
			current_order	=	id_array[1];
			order_by		=	$("#order_by_"+current_id).val();
			$.ajax({
				type: "GET",
				url: '{{ route("$modelName.changeOrder") }}',
				data: { current_id: current_id,current_order: current_order,order_by: order_by },
				success : function(res){
					if(res.success != 1) {
						alert(res.message); return false;
					}else{
						$("#order_by_"+current_id).css({'border-color':'#CCCCCC'});
						$("#change_div"+current_id).addClass('hide');
						$("#link_"+current_order+"_"+current_id).html(res.order_by);
						$("#link_"+current_order+"_"+current_id).show();
						return true;
					}
			 	}
			})
			return false;
		}
	</script>
@stop