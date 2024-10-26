@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('contact-enquiries') }}
@stop

@section('content')
<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form']) }}
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
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
										{{ Form::text('name',((isset($searchVariable['name'])) ? $searchVariable['name'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.name")]) }}

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                      {{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.email")]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
						 <div class="row clearfix ">
                            <!-- Search by Date Range -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">

                                       @php  $courseType     = CustomHelper::getConfigValue('COURSE_TYPE'); @endphp

                                       {{ Form::select('course_type',array(''=>trans('messages.global.select_course_type')) +  $courseType,((isset($searchVariable['course_type'])) ? $searchVariable['course_type'] : ''), ['class' => 'form-control' ,'data-live-search'=>"true"]) }}


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
						<th width="16%">
						{{link_to_route("$modelName.index",	trans("messages.$modelName.name"),array(								'records_per_page' => $recordPerPagePagination,'sortBy' => 'name',
								'order' => ($sortBy == 'name' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
						</th>
						<th width="25%">
						{{link_to_route("$modelName.index",	trans("messages.$modelName.email"),	array(						'records_per_page' => $recordPerPagePagination,'sortBy' => 'email',	'order' => ($sortBy == 'email' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
							array('class' => (($sortBy == 'email' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'email' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
							)
						}}
					</th>

					<th width="20%">
                        {{link_to_route("$modelName.index",	trans("messages.$modelName.phone"),	array(						'records_per_page' => $recordPerPagePagination,'sortBy' => 'phone_number',	'order' => ($sortBy == 'phone_number' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                        array('class' => (($sortBy == 'phone_number' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'phone_number' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
                        )
                    }}

                    </th>
                    <th width="15%">

                        {{trans("messages.$modelName.course_type") }}


                    </th>
					<th width="10%">

                        {{link_to_route("$modelName.index",	trans("messages.$modelName.created_on"),	array(						'records_per_page' => $recordPerPagePagination,'sortBy' => 'created_at',	'order' => ($sortBy == 'created_at' && $order == 'desc') ? 'asc' : 'desc') + $searchVariable,
                        array('class' => (($sortBy == 'created_at' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'created_at' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
                        )
                    }}

                    </th>
					<th>{{ trans("messages.global.action") }}</th>
					</tr>
					</thead>
					<tbody>
					@if(!$model->isEmpty())
					@foreach($model as $result)


					<tr>
						<td data-th='{{ trans("messages.$modelName.name") }}'>{{ $result->name }}</td>



						<td data-th='{{ trans("messages.$modelName.email") }}'><a href="mailTo: {{ $result->email }} "> {{ $result->email }} </a></td>

						<td data-th='{{ trans("messages.$modelName.phone") }}'>{{ $result->phone_number_with_dial_code }}</td>

                        <td data-th='{{ trans("messages.$modelName.course_type") }}'>


                            <?php
                            $course_type = $result->course_type;
                            echo CustomHelper::getConfigValue('COURSE_TYPE.'.$course_type)
                             ?>


                            </td>

						<td data-th='{{ trans("messages.$modelName.message") }}'>{{  CustomHelper::displayDate($result->created_at) }}</td>
						<td data-th='{{ trans("messages.global.action") }}'>
							<a href="javascript:void(0);" data-url='{{ route("$modelName.view","$result->id")}}' class="text-decoration-none view_contact">
                                <button type="button" class="btn bg-blue-grey  waves-effect btn-sm"><i class="material-icons font-14">visibility</i> {{ trans("messages.$modelName.view") }}</button>
                            </a>

                               <a href="javascript:void(0)" data-href='{{ route("$modelName.delete",array($result->id))}}' class="btn btn-danger waves-effect btn-sm confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_delete_this_record')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                               <i class="material-icons font-14">delete_sweep</i><?php echo trans('messages.global.delete');  ?>
                               </a>


                            <!-- <a href='{{ route("$modelName.reply","$result->id")}}' class="text-decoration-none">
                                <button type="button" class="btn btn-primary  waves-effect btn-sm"><i class="material-icons font-14">email</i> {{ trans("messages.$modelName.reply") }}</button>
                            </a> -->
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td align="center" width="100%" colspan="6">  {{ trans("messages.global.no_record_found_message") }} </td>
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

<!--pop div start here-->
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="contact_view" class="modal fade in" style="display: none;"></div>

<!--pop js start here-->
<script type="text/javascript">
	var csrf_token = '{{ csrf_token() }}';
	/* For open Email detail popup */

	$(document).on('click', '.view_contact', function(e){

		var page_url = $(this).attr('data-url');

		$.ajax({
			url: page_url,
			type: "GET",
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			success : function(r){
				$("#contact_view").html(r);
				$("#contact_view").modal('show');
			}
		});
	});

</script>


@stop
