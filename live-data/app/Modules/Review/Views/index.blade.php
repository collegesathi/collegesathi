@extends('admin.layouts.default')
@section('content')
@section('breadcrumbs')
	{{ Breadcrumbs::render('review-page-list') }}
@stop
<script type="text/javascript">
var action_url = '<?php echo route("$modelName.Multipleaction"); ?>';
</script>
{{ HTML::script('js/admin/multiple_delete.js') }}



<!-- Search Panel -->
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    {{ Form::open(['method' => 'get','role' => 'form','route' => "$modelName.index",'class' => 'mws-form']) }}
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
									{{ Form::text('university_name',((isset($searchVariable['university_name'])) ? $searchVariable['university_name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.global.university_name")]) }}
								</div>
							</div>
						</div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                            <div class="form-group">
                                <div class="form-line">
                                    {{ Form::select('active',array(''=>trans('messages.global.please_select_status'),0=>'Pending',1=>'Approved',2=>'Rejected'),((isset($searchVariable['active'])) ? $searchVariable['active'] : ''), ['class' => 'form-control','data-live-search'=>"true"]) }}
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
					<div class="col-sm-3 pull-right" >
						<div class="form-group">
							<div class="form-line">
								<?php
								$actionTypes = array(
									'delete' => trans('messages.global.delete'),
								);
								?>
								{{ Form::open() }}
								{{Form::select('action_type',array(''=>trans("messages.global.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control','data-live-search'=>"true"])}}
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

			<th width="15%">{{ trans("messages.global.university_name") }}</th>
			<th width="15%">{{ trans("messages.global.reviewer_name") }}</th>
			<th width="10%">{{ trans("messages.global.created_on") }}</th>
			<th width="10%">{{ trans("messages.global.status") }}</th>
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

					<td data-th='{{ trans("messages.$modelName.university_name") }}'>{{ CustomHelper::getUniversiryNameById($record->uni_id) }}</td>
					<td data-th='{{ trans("messages.$modelName.user_name") }}'>{{ CustomHelper::getUserNameById($record->user_id) }}</td>
					<td  data-th='{{ trans("messages.global.created") }}'>
						{{ CustomHelper::displayDate($record->created_at) }}

					</td>
					<td data-th='{{ trans("messages.global.status") }}'>
						@if($record->is_status  == ACTIVE)
							<span class="label label-success" >{{ trans("messages.global.approved") }}</span>
						@elseif($record->is_status  == REJECT)
							<span class="label label-danger" >{{ trans("messages.global.rejected") }}</span>
						@else
							<span class="label label-warning" >{{ trans("messages.global.pending") }}</span>
						@endif
					</td>
					<td data-th='{{ trans("messages.global.action") }}'>
						<div class="btn-group m-l-5 m-t-5">
							<button type="button" class="btn btn-primary dropdown-toggle"
								data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="true">{{ trans('messages.global.action') }} <span
									class="caret"></span>
							</button>
							<ul class="dropdown-menu  min-width-220">
								<li>
									<a href='{{ route("$modelName.view","$record->id") }}'
										class="waves-effect waves-block">
										<i class="material-icons">find_in_page</i><?php echo trans('messages.global.view'); ?>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)"
										data-href='{{ route("$modelName.status", [$record->id,ACTIVE]) }}'
										class=" waves-effect waves-block confirm_box"
										data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
										data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}"
										title="<?php echo trans('messages.global.mark_as_approved'); ?>">
										<i
											class="material-icons">verified_user</i><?php echo trans('messages.global.mark_as_approved'); ?>
									</a>
								</li>
								<li>
									<a href="javascript:void(0)" rel="{{$record->id}}"
										data-type=""
										class=" waves-effect waves-block updateRequest"
										data-confirm-message="{{ trans('messages.admin.system.you_want_to_perform_this_action') }}"
										data-confirm-heading="{{ trans('messages.admin.system.are_you_sure') }}"
										title="<?php echo Config::get('REJECT') ?>">
										<i class="material-icons">do_not_disturb</i>{{ trans("messages.global.mark_as_reject") }}
									</a>
								</li>
							</ul>
						</div>
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

<div class="modal fade" id="update_application_status" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <span class="modal-header modalheading">
                    <button type="button" class="close closedlink" data-dismiss="modal">&times;</button>
                </span>

                <div class="modal-body modalbody">
                    <div class="mt-20">
                        {{ Form::open(['role' => 'form', 'url' => route("$modelName.review_status"), 'class' => 'mws-form', 'files' => true, 'id' => 'modal_form_application_status']) }}
						{{ Form::hidden('id', null, ['class' => 'id']) }}
                        {{ Form::hidden('application_action', null, ['class' => 'application_action']) }}

                        <div class="row clearfix reason_div">
                            <div class="col-sm-12 ">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::label('reason', trans("messages.$modelName.reason") . '<span class="required"> * </span>', ['class' => 'control-label'], false) }}
                                        {{ Form::textarea('reason', '', ['class' => 'form-control']) }}
                                    </div>
                                    <span class="error help-inline reason send_msg_action_approve_error">
                                        <?php echo $errors->first('reason'); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 ">
                            </div>
                            <div>
                                <input type="button" value="Submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit send_application_action">
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- #END# Hover Rows -->

<script>
       
        $(document).on('click', '.updateRequest', function(e) {
            $('.error').html('');
			var id = $(this).attr('rel');
            var application_action = $(this).attr('data-type');
			$('.id').attr('value', id);
            $('.application_action').attr('value', application_action);
            confirmMessage = $(this).attr('data-confirm-message');
            confirmHeading = $(this).attr('data-confirm-heading');
            swal({
                title: confirmHeading,
                text: confirmMessage,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function() {
                $('.cancel').trigger('click');
                $("#update_application_status").modal('show');

            });
        });

        $(document).on('click', '.send_application_action', function(e) {
            $('.error').html('');
            var data = $("#modal_form_application_status").serialize();
            $.ajax({
                type: "POST",
                url: '{{ route("$modelName.review_status") }}',
                data: data,
                beforeSend: function() {
                    $("#overlay").show();
                },
                success: function(result) {
                    $(".error").html("");
                    if (result.status == "error") {
                        $.each(result.errors, function(key, value) {
                            $("." + key).html(value);
                        });
                    } else {
                        location.reload(true);
                    }
                    $("#overlay").hide();
                }
            });
        });
    </script>
@stop
