@extends('admin.layouts.default')
@section('content')

{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'jquery.raty.css') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'jquery.raty.js') }}

<!-- Search Panel -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{ Form::open(['method' => 'get', 'role' => 'form', 'route' => ["$modelName.index"], 'class' => 'mws-form']) }}
        {{ Form::hidden('display', 1) }}
        {{ Form::hidden('sortBy', $sortBy) }}
        {{ Form::hidden('order', $order) }}
        {{ Form::hidden('records_per_page', $recordPerPagePagination) }}

        <div class="panel-group" id="panel-group-id" role="tablist" aria-multiselectable="true">
            <div class="panel panel-col-pink">
                <div class="panel-heading" role="tab" id="panel-heading-id">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-target="#panel-collapse-id"
                            data-parent="#panel-group-id" href="javascript:void(0)" aria-expanded="true"
                            aria-controls="panel-collapse-id"
                            class="{{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? '' : 'collapsed' }}">
                            <i class="material-icons">search</i> Search
                            <span class="pull-right collapse-toggle-icon"></span>
                            <span>
                                {{ trans('messages.global.click_here_to_expand') }}
                            </span>
                        </a>
                    </h4>
                </div>

                <div id="panel-collapse-id"
                    class="panel-collapse collapse {{ isset($searchVariable['display']) && $searchVariable['display'] == 1 ? 'in' : '' }}"
                    role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
                    <div class="panel-body">
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{ Form::select('university_id',array(''=>trans('messages.global.please_select_university'))+$universityDropdown,((isset($searchVariable['university_id'])) ? $searchVariable['university_id'] : ''), ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
									<div class="form-group">
										<div class="form-line">
										   {{ Form::select('rating',array(''=>trans('messages.global.please_select_rating')) + $rating_list,((isset($searchVariable['rating'])) ? $searchVariable['rating'] : ''), ['class' => 'form-control']) }}
										</div>
									</div>
								</div>
                        </div>
                        <div class="row clearfix ">
                            <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                                <button type="submit"
                                    class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i
                                        class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                                <a href='{{ route("$modelName.index") }}'><button type="button"
                                        class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i
                                            class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
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
                    {{ trans("messages.$modelName.table_heading_review_rating_index") }}
                    <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                        
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
                <table class="table table-bordered table-striped table-hover ">
                    <thead>
                        <tr role="row">
                            <th> {{ trans('messages.global.user') }} </th>
                            <th> {{ trans('messages.global.university') }} </th>
                            <th>{{ trans('messages.global.rating') }}</th>
                            {{-- <th> {{ trans('messages.global.status') }} </th> --}}
                            <th> {{ trans('messages.global.admin_approval') }} </th>
                            <th>{{ trans('messages.global.created_at') }}</th>
                            <th>{{ trans('messages.global.action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="powerwidgets">
                        @if (!$model->isEmpty())
                            @foreach ($model as $record)
                                <tr class="items-inner">
                                    <td>{{ ucwords($record->getUserDetails->full_name) }}</td>

                                    <td>{{ ucwords($record->getUniversityDetails->title) }}</td>
                                    
                                    <td>
                                        <span class="rating" data-score='{{$record->rating}}'></span>
                                    </td>

                                    {{-- <td>
                                        @if($record->status	== ACTIVE)
                                            <span class="label label-success" >{{ trans("messages.global.activated") }}</span>
                                        @else
                                            <span class="label label-warning" >{{ trans("messages.global.deactivated") }}</span>
                                        @endif
                                    </td> --}}

                                    <td>
                                        @if($record->is_approved	== REQAPPROVE)
                                            <span class="label label-success" >{{ trans("messages.global.approved") }}</span>
                                        @else
                                            <span class="label label-warning" >{{ trans("messages.global.pending") }}</span>
                                        @endif
                                    </td>

                                    <td>{{ $record->created_at }}</td>

                                    <td>
                                        <div class="btn-group m-l-5 m-t-5">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ trans("messages.global.action") }} <span class="caret"></span></button>
                                            <ul class="dropdown-menu  min-width-190">
            
                                        @if($record->is_approved != REQAPPROVE)
											<li>
												<a class="waves-effect waves-block confirm_box" data-href='{{route("$modelName.approveReviewRating",[$type, $record->id,REQAPPROVE])}}' data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >
													<i class="material-icons font-14">done</i> {{ trans("messages.global.approve") }}
												</a>
											</li>
										@endif


                                        {{-- @if($record->status)
											<li>
												<a class="waves-effect waves-block confirm_box" data-href='{{ route("$modelName.updateStatus",array($type, $record->id,INACTIVE))}}' data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" >
													<i class="material-icons font-14">block</i> {{ trans("messages.global.mark_as_inactive") }}
												</a>
											</li>
										@else
											<li>
												<a class="waves-effect waves-block confirm_box" data-href='{{ route("$modelName.updateStatus",array($type, $record->id,ACTIVE) )}}' data-confirm-message="{{trans('messages.admin.system.you_want_to_perform_this_action')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
													<i class="material-icons font-14">done</i>  {{ trans("messages.global.mark_as_active") }}
												</a>
											</li>
										@endif --}}
            
            
                                                <li>
                                                    <a href='{{route("$modelName.view",[$type, $record->id])}}' class="waves-effect waves-block">
                                                        <i class="material-icons">visibility</i>{{ trans("messages.global.view") }}
                                                    </a>
                                                </li>
                                                
                                                
            
                                                <li>
                                                    <a href="javascript:void(0)" data-href='{{route("$modelName.delete",array($type,  $record->id) )}}' class="waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.ReviewRating.you_want_to_delete_this_rating')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                                                        <i class="material-icons">delete_sweep</i> {{trans('messages.global.delete')}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td align="center" width="100%" colspan="7">
                                    {{ trans('messages.global.no_record_found_message') }} </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="row">
                    @include('pagination.default', [
                        'paginator' => $model,
                        'searchVariable' => $searchVariable,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
		$('.rating').raty({
			path       	: '{{ WEBSITE_IMG_URL }}',
			targetKeep 	: true,
			readOnly   	: true,
			score		: function() {
				return $(this).attr('data-score');
			}
		});
    });
</script>


@stop
