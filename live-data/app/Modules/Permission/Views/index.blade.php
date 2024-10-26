@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('admin-users') }}
@stop

@section('content')
<!-- Search Panel -->
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
                             <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
									   {{ Form::text('full_name',((isset($searchVariable['full_name'])) ? $searchVariable['full_name'] : ''), ['class' => 'form-control', 'placeholder'=>trans("messages.$modelName.full_name")]) }}
                                    </div>

                                </div>
                            </div>
							  <!-- Search by Email -->
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
										{{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.$modelName.email")]) }}
                                    </div>
                                </div>
                            </div>
							<!-- Search by Email -->
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <div class="form-line">
									{{	Form::select('role',[null=>trans("messages.$modelName.please_select_role")]+$role,((isset($searchVariable['role'])) ? $searchVariable['role'] : ''), ['class' => 'form-control']) }}

                                    </div>
                                </div>
                            </div>
						</div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ Request::url()}}'  ><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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

								<a href='{{ route("$modelName.add")}}'>
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
							<th>{{trans("messages.$modelName.full_name")}}</th>

                            <th>{{trans("messages.$modelName.email")}}</th>

                            <th>{{trans("messages.$modelName.role")}}</th>

                            <th>{{ trans("messages.global.status") }}</th>
                            <th>{{ trans("messages.global.action") }}</th>


                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
						@if(!$model->isEmpty())
							@foreach($model as $result)
                            <?php // pr($result);die; ?>
							<tr class="items-inner">
								<td data-th='{{ trans("messages.$modelName.full_name") }}'>{{ isset($result->user->full_name)?$result->user->full_name:'' }}</td>
								<td data-th='{{ trans("messages.$modelName.email") }}'>{{ isset($result->user->email)?$result->user->email:'' }}</td>
								<td data-th='{{ trans("messages.$modelName.role") }}'>{{ isset($result->role->role)?$result->role->role:'' }}</td>
                                <td   data-th='{{ trans("messages.global.status") }}'>
                                    @if(isset($result->user) && !empty($result->user) && $result->user->active == 1)
                                      <span class="label label-success" >{{ trans("messages.global.active") }}</span>
                                    @else
                                       <span class="label label-warning" >{{ trans("messages.global.inactive") }}</span>
                                    @endif

                                </td>
								<td data-th='{{ trans("messages.global.action") }}'>

                                    @if(isset($result->user) && !empty($result->user) && $result->user->active == 1)
                                    <a  data-href='{{ route("$modelName.updateActiveStatus",array($result->user_id,0) )}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >

                                        <button type="button" class="btn btn-success   waves-effect btn-sm"><i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}</button>
                                    </a>
                                    @else
                                    <a data-href='{{ route("$modelName.updateActiveStatus",array($result->user_id,1) )}}'  class="text-decoration-none confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                                    <button type="button" class="btn btn-warning  waves-effect btn-sm"><i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}</button>
                                </a>
                                @endif

									<a href='{{route("$modelName.edit", $result->id)}}' class="btn btn-info btn-small"><i class="material-icons font-14">mode_edit</i> {{ trans("messages.global.edit") }}</a>


									<a data-href='{{route("$modelName.delete","$result->id")}}'  class="text-decoration-none confirm_box" data-confirm-message="{{ trans('messages.admin.system.you_want_to_delete_this_record') }}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}"  >
										<button type="button" class="btn  btn-danger  waves-effect btn-sm">
											<i class="material-icons font-14">delete</i>
										{{ trans("messages.global.delete") }}
										</button>
									</a>



									<a href='{{ route("$modelName.sendCredential", $result->user_id) }}' class="btn btn-warning btn-small"><i class="material-icons font-14">trending_flat</i>{{ trans("messages.$modelName.send_login_credential") }}</a>
								</td>
							</tr>
							@endforeach
						@else
							<tr><td align="center" width="100%" colspan="5">
								{{ trans("messages.global.no_record_found_message") }}
							</td></tr>
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
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'multiple_delete.js') }}

@stop
