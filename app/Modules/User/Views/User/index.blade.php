@extends('admin.layouts.default')

@section('breadcrumbs')
{{ Breadcrumbs::render('customer-list') }}
@stop

@section('content')
@php
$customer_types = CustomHelper::getConfigValue('CustomerType');
$search_first_name = isset($searchVariable['first_name']) ? $searchVariable['first_name'] : '';
$search_last_name = isset($searchVariable['last_name']) ? $searchVariable['last_name'] : '';
$search_email = isset($searchVariable['email']) ? $searchVariable['email'] : '';
$search_phone = isset($searchVariable['phone']) ? $searchVariable['phone'] : '';
$search_user_start_date = isset($searchVariable['user_start_date']) ? $searchVariable['user_start_date'] : '';
$search_user_end_date = isset($searchVariable['user_end_date']) ? $searchVariable['user_end_date'] : '';
$search_subject_id = isset($searchVariable['subject_id']) ? $searchVariable['subject_id'] : '';
$search_grade = isset($searchVariable['grade']) ? $searchVariable['grade'] : '';
$search_curriculum = isset($searchVariable['curriculum']) ? $searchVariable['curriculum'] : '';
$search_enroll_in = isset($searchVariable['enroll_in']) ? $searchVariable['enroll_in'] : '';
$search_active = isset($searchVariable['active']) ? $searchVariable['active'] : '';
$search_page = isset($searchVariable['page']) ? $searchVariable['page'] : '';
$search_records_per_page = isset($searchVariable['records_per_page']) ? $searchVariable['records_per_page'] : '';

$search_start_date = isset($searchVariable['user_start_date']) ? $searchVariable['user_start_date'] : '';
$search_end_date = isset($searchVariable['user_end_date']) ? $searchVariable['user_end_date'] : '';
$date_range_picker = !empty($date_range_picker) ? $date_range_picker : '';


@endphp
<!-- Searching div -->
<div class="row clearfix">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div id="mws-themer-toggle" class="{{ ($searchVariable && !isset($searchVariable['records_per_page'])) ? 'opened' : '' }}">
         <i class="icon-bended-arrow-left"></i>
         <i class="icon-bended-arrow-right"></i>
      </div>
      {{ Form::open(['method' => 'get','role' => 'form','route' =>array("$customerModel.index"),'class' => 'mws-form']) }}
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
            <div id="panel-collapse-id" class="panel-collapse collapse {{ (isset($searchVariable['display']) && ($searchVariable['display'] == 1)) ? 'in' : '' }}" role="tabpanel" aria-labelledby="panel-heading-id" aria-expanded="true">
               <div class="panel-body">
                  <div class="row clearfix ">
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::text('first_name',((isset($searchVariable['first_name'])) ? $searchVariable['first_name'] : ''), ['class' => 'form-control','placeholder'=> trans("messages.global.filter_by_first_name")]) }}
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::text('last_name',((isset($searchVariable['last_name'])) ? $searchVariable['last_name'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.global.filter_by_last_name")]) }}
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::text('email',((isset($searchVariable['email'])) ? $searchVariable['email'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.global.filter_by_email")]) }}
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::text('phone',((isset($searchVariable['phone'])) ? $searchVariable['phone'] : ''), ['class' => 'form-control','placeholder'=>trans("messages.global.filter_by_phone")]) }}
                           </div>
                        </div>
                     </div>
                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::text('date_range_picker', $date_range_picker, ['id' => 'date_range_picker', 'readonly', 'class' => 'form-control', 'placeholder' => trans('messages.global.date_range')]) }}

                              {{ Form::hidden('user_start_date', $search_start_date, array('id' => 'start_date')) }}
                              {{ Form::hidden('user_end_date', $search_end_date, array('id' => 'end_date')) }}

                           </div>
                        </div>
                     </div>

                     <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                        <div class="form-group">
                           <div class="form-line">
                              {{ Form::select('active',array(''=>trans('messages.global.please_select_status'),0=>trans('messages.global.login_deactivate'),1=>trans('messages.global.login_activate')),((isset($searchVariable['active'])) ? $searchVariable['active'] : ''), ['class' => 'form-control' ,'data-live-search'=>"true"]) }}
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="row clearfix ">
                     <div class="col-xs-12 col-sm-6 col-md-4 pull-right set_button">
                        <button type="submit" class="btn bg-pink btn-sm waves-effect btn-submit text-decoration-none"><i class="material-icons font-14">search</i>{{ trans('messages.global.search') }}</button>
                        <a href='{{ route("$customerModel.index")}}'><button type="button" class="btn bg-blue-grey text-decoration-none  waves-effect btn-sm"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset') }}</button></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{ Form::close() }}
   </div>
</div>
<!-- End here -->
<!-- Hover Rows -->
<div class="row clearfix">
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="header">
            <h2>
               {{ $heading }}
               <ul class="header-dropdown m-r--5 btn-right-top-margin visible-md visible-lg visible-sm visible-xs">
                  <li>
                     <a href='{{ route("$customerModel.add")}}'>
                        <button type="button" class="btn bg-indigo waves-effect">
                           <i class="material-icons font-14">add</i> {{ trans("messages.global.add") }}
                        </button>
                     </a>
                  </li>
                  @php
                  $queryStringArray = Request::query();
                  $queryStringArray['display'] = ACTIVE;
                  $queryStringArray['download_csv'] = ACTIVE;
                  @endphp
                  <li>
                     <a href='{{ route("$customerModel.index", $queryStringArray) }}'>
                        <button type="button" class="btn bg-pink waves-effect"> <i class="material-icons font-14">file_download</i>{{ trans('messages.global.export_csv') }}
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
               <div class="col-sm-3 pull-right">
                  <div class="form-group form_group_upper_checkbox">
                     <div class="form-line">
                        @php
                        $actionTypes = array(
                        'inactive' => trans('messages.global.login_deactivate'),
                        'active' => trans('messages.global.login_activate'),
                        );
                        @endphp
                        {{ Form::open() }}
                        {{ Form::select('action_type',array(''=>trans("messages.global.select_action"))+$actionTypes,$actionTypes,['class'=>'deleteall selectUserAction form-control' ,'data-live-search'=>"true"]) }}
                        {{ Form::close() }}
                     </div>
                  </div>
               </div>
            </div>
            <table class="table table-bordered table-striped table-hover ">
               <thead>
                  <tr role="row">
                     <th class="align-center">
                        {{ Form::checkbox('is_checked','',null,['class'=>'left checkAllUser filled-in','id'=>'rememberme'])}}
                        <label for="rememberme" class="table_checkbox"></label>
                     </th>
                     <th class="align-center {{(($sortBy == 'full_name' && $order == 'desc') ? 'sorting_desc' : (($sortBy == 'full_name' && $order == 'asc') ? 'sorting_asc' : 'sorting')) }} ">
                        {{ link_to_route("$customerModel.index",trans("messages.global.name"),array(                     'records_per_page' => $recordPerPage,'sortBy' => 'full_name','order' => ($sortBy == 'full_name' && $order == 'desc') ? 'asc' : 'desc' ) + $searchVariable,
                        array('class' => (($sortBy == 'full_name' && $order == 'desc') ? 'sorting desc' : (($sortBy == 'full_name' && $order == 'asc') ? 'sorting asc' : 'sorting')) )
                        )
                        }}
                     </th>
                     <th>{{ trans("messages.Contact.phone") }}</th>
                     <th>{{ trans("messages.global.status") }}</th>
                     <th>{{ trans("messages.global.action") }}</th>
                  </tr>
               </thead>
               <tbody id="powerwidgets">
                  @if(!$result->isEmpty())
                  @foreach($result as $key => $record)
                  <tr class="items-inner">
                     <td data-th='{{ trans("messages.global.select") }}' class="align-center valign-middle">
                        {{ Form::checkbox('status',$record->id,null,['class'=> 'userCheckBox filled-in','id'=>'selected_all_'.$record->id] )}}
                        <label for="selected_all_{{ $record->id }}"></label>
                     </td>
                     <td data-th='{{ trans("messages.$modelName.image") }}' class="align-center">
                        @php echo CustomHelper::showUserImage(USER_PROFILE_IMAGE_ROOT_PATH, USER_PROFILE_IMAGE_URL, $record->image, $record->gender, ['alt' => $record->full_name, 'height' =>'60', 'width' =>'60']); @endphp
                        <br />
                        <span>{{ $record->full_name }}</span>
                        <br />
                        <small class="small-font">{{ trans("messages.$modelName.created_on") }} : {{ CustomHelper::displayDate($record->created_at) }}</small>
                     </td>
                     <td data-th='{{ trans("messages.$modelName.email") }}'>
                        <a href="mailto:{{ $record->email }}" class="redicon">{{ $record->email }}</a>

                        @if($record->is_verified == ACTIVE )
                        <span class="btn-circle tooltipHelp color-success" data-html="true" data-toggle="tooltip" data-original-title="<?php echo trans('messages.global.email_verified');  ?>">
                           <i class="material-icons">verified_user</i>
                        </span>
                        @else
                        <span class="btn-circle tooltipHelp color-danger" data-html="true" data-toggle="tooltip" data-original-title="<?php echo trans('messages.global.email_not_verified');  ?>">
                           <i class="material-icons">report_problem</i>
                        </span>
                        @endif
                        <br />
                        {{ $record->phone }}
                        @if($record->is_mobile_verified == ACTIVE )
                        <span class="btn-circle tooltipHelp color-success" data-html="true" data-toggle="tooltip" data-original-title="<?php echo trans('messages.global.mobile_verified'); ?>">
                           <i class="material-icons">verified_user</i>
                        </span>
                        @else
                        <span class="btn-circle tooltipHelp color-danger" data-html="true" data-toggle="tooltip" data-original-title="<?php echo trans('messages.global.mobile_not_verified');  ?>">
                           <i class="material-icons">report_problem</i>
                        </span>
                        @endif
                     </td>
                     <td data-th='{{ trans("messages.global.status") }}'>
                        @if($record->active == ACTIVE)
                        <span class="label label-success">{{ trans("messages.global.login_activated") }}</span>
                        @else
                        <span class="label label-warning">{{ trans("messages.global.login_deactivated") }}</span>
                        @endif
                        <br />
                     </td>
                     <td data-th='{{ trans("messages.global.action") }}'>
                        <div class="btn-group m-l-5 m-t-5">
                           <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ trans("messages.global.action") }} <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu  min-width-220">
                              <li>
                                 <a href='{{route("$customerModel.edit",array($record->id))}}' class="waves-effect waves-block">
                                    <i class="material-icons">mode_edit</i><?php echo trans('messages.global.edit');  ?>
                                 </a>
                              </li>
                              <li>
                                 <a href='{{route("$customerModel.view",array($record->id))}}' class="waves-effect waves-block">
                                    <i class="material-icons">find_in_page</i><?php echo trans('messages.global.view');  ?>
                                 </a>
                              </li>

                              @if($record->is_verified == INACTIVE )

                              <li>
                                 <a href="javascript:void(0)" data-href='{{ route("$customerModel.emailVerify",array($record->id,ACTIVE))}}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_email_verify')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" title="<?php echo trans('messages.global.email_verify');  ?>">
                                    <i class="material-icons">verified_user</i><?php echo trans('messages.global.email_verify');  ?>
                                 </a>
                              </li>
                              @endif
                              @if($record->active)
                              <li>
                                 <a href="javascript:void(0)" data-href='{{ route("$customerModel.status",array($record->id,INACTIVE))}}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_login_deactivate')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" title="<?php echo trans('messages.global.mark_as_inactive');  ?>">
                                    <i class="material-icons">do_not_disturb</i><?php echo trans('messages.global.login_deactivate');  ?>
                                 </a>
                              </li>
                              @else
                              <li>
                                 <a href="javascript:void(0)" data-href='{{ route("$customerModel.status",array($record->id,ACTIVE))}}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_login_activate')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}" title="<?php echo trans('messages.global.mark_as_active');  ?>">
                                    <i class="material-icons">verified_user</i><?php echo trans('messages.global.login_activate');  ?>
                                 </a>
                              </li>
                              @endif
                              <li>
                                 <a href="javascript:void(0)" data-href='{{ route("$customerModel.delete",array($record->id))}}' class="waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_delete_this_record')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                                    <i class="material-icons">delete_sweep</i><?php echo trans('messages.global.delete');  ?>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void(0)" data-href='{{ route("$customerModel.send-credential",array($record->id))}}' class=" waves-effect waves-block confirm_box" data-confirm-message="{{trans('messages.admin.system.you_want_to_send_login_credential')}}" data-confirm-heading="{{trans('messages.admin.system.are_you_sure')}}">
                                    <i class="material-icons">verified_user</i><?php echo trans('messages.global.send_login_credential');  ?>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                     <td align="center" width="100%" colspan="9"> {{ trans("messages.global.no_record_found_message") }} </td>
                  </tr>
                  @endif
               </tbody>
            </table>
            <div class="row">
               @include('pagination.default',['paginator' => $result,'searchVariable'=>$searchVariable])
            </div>
         </div>
      </div>
   </div>
</div>


{{ HTML::script('plugins/admin/momentjs/moment.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'daterange/daterangepicker.js') }}
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'daterange/custom_range.js') }}
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'daterange/daterangepicker.css') }}


<script type="text/javascript">
   var action_url = '<?php echo route("$customerModel.Multipleaction"); ?>';
   var cal_date_format = '{{JS_DATE_FORMAT_FOR_DATE_SEARCH}}';

   $(document).ready(function() {
      showStartEndDateInPast('date_range_picker', 'start_date', 'end_date', cal_date_format);
   });
</script>
{{ HTML::script(WEBSITE_ADMIN_JS_URL.'multiple_delete.js') }}

@stop