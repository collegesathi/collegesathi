@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('email-logs') }}
@stop


@section('content')

{{ HTML::script('js/admin/bootstrap-modal.min.js') }}
{{ HTML::style('css/admin/bootmodel.css') }}

<!--pop js start here-->
<script type="text/javascript">
	var csrf_token = '{{ csrf_token() }}';
	/* For open Email detail popup */

	function getPopupClient(id){
		$.ajax({
			url: '<?php echo route('EmailLog.detail'); ?>',
			type: "POST",
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			data: { 'sliderId':id },
			success : function(r){
				$("#getting_basic_list_popover").html(r);
				$("#getting_basic_list_popover").modal('show');
			}
		});
	}

</script>
<!--pop js end here-->

<!--pop div start here-->
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="getting_basic_list_popover" class="modal fade in" style="display: none;">
</div>





<!-- popup div end here-->


<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get','role' => 'form','route' =>"$modelName.index",'class' => 'mws-form']) }}
        {{ Form::hidden('display',1) }}
		{{ Form::hidden('sortBy', $sortBy) }}
		{{ Form::hidden('order', $order) }}
		{{ Form::hidden('records_per_page', $recordPerPagePagination) }}


		<?php
			$email_to	=	Request::get('email_to');
			$subject	=	Request::get('subject');
		?>
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
										{{ Form::text(
												'email_to',
												 isset($email_to) ? $email_to :'',
												 ['class' =>'form-control', 'placeholder'=>trans("messages.$modelName.email_to")])
										}}
									</div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
										{{ Form::text(
												'subject',
												 isset($subject) ? $subject :'',
												 ['class' =>'form-control','placeholder'=>trans("messages.$modelName.subject")])
										}}
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
                </div>
                <table class="table table-bordered table-striped table-hover "  >
                    <thead>
                     <tr role="row">
							<th>
                                {{ link_to_route("$modelName.index",	trans("messages.$modelName.email_to"),array(					'records_per_page' => $recordPerPagePagination,'sortBy' => 'email_to','order' => ($sortBy == 'email_to' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                                array('class' => (($sortBy == 'email_to' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'email_to' && $order == 'asc') ? 'sorting asc' : 'sorting')) ))
                                   }}
                            </th>
							<th width='25%'>
                                {{ link_to_route("$modelName.index",trans("messages.$modelName.email_from"),array(					'records_per_page' => $recordPerPagePagination,'sortBy' => 'email_from','order' => ($sortBy == 'email_from' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                                array('class' => (($sortBy == 'email_from' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'email_from' && $order == 'asc') ? 'sorting asc' : 'sorting')) ))
                                   }}

                            </th>
							<th  width='20%'>
                                {{ link_to_route("$modelName.index",trans("messages.$modelName.subject"),array(					'records_per_page' => $recordPerPagePagination,'sortBy' => 'subject','order' => ($sortBy == 'subject' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                                array('class' => (($sortBy == 'subject' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'subject' && $order == 'asc') ? 'sorting asc' : 'sorting')) ))
                                   }}

                            </th>
							<th>
                                {{ link_to_route("$modelName.index",	trans('messages.global.created'),array(					'records_per_page' => $recordPerPagePagination,'sortBy' => 'created_at','order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							 array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) ))
								}}
							</th>
							<th> {{ trans("messages.global.action") }}</th>
                    </tr>
                    </thead>
                    <tbody id="powerwidgets">
                         @if(!$model->isEmpty())
                        @foreach($model as $result)
                        <tr>
							<td data-th='{{ trans("messages.$modelName.email_to") }}'>{{ $result->email_to }}</td>
							<td data-th='{{ trans("messages.$modelName.email_from") }}'>{{ $result->email_from }}</td>
							<td data-th='{{ trans("messages.$modelName.subject") }}'>{{ $result->subject}}</td>
							<td  data-th='{{ trans("messages.global.created") }}'>{{ CustomHelper::convert_timestamp_to_date_time(CustomHelper::convert_date_to_timestamp($result->created_at)) }}</td>
							<td  data-th='{{ trans("messages.global.action") }}'>

								 <a  href="javascript:void(0);" onclick="getPopupClient('{{ $result->id }}')">
									<button type="button" class="btn btn-success  waves-effect btn-sm"><i class="material-icons font-14">visibility</i> {{ trans("messages.global.view") }}</button>
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
