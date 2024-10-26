@extends('admin.layouts.default')
@section('content')
<?php
   $userInfo	=	Auth::user();
   $full_name  	=  	(isset($userInfo->full_name)) ? $userInfo->full_name : '';
   $email		=	(isset($userInfo->email)) ? $userInfo->email : '';
   ?>
<div class="container-fluid" id="main-container">
<div class="row clearfix" >
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="header">
            <h2>
               {{ trans("messages.Account.table_heading_index") }}
            </h2>
         </div>
         <div class="body">
            {{ Form::open(['role' => 'form','route' => 'Admin.account_update','class' => 'mws-form','files'=>'true']) }}
            <div class="mt-20">
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{Form::label('full_name', trans("messages.Account.user_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
                           {{ Form::text('full_name', $full_name,['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline">
                        <?php echo $errors->first('full_name'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{Form::label('email', trans("messages.Account.email").'<span class="required"> * </span>', ['class' => 'mws-form-label'],false) }}
                           {{ Form::text('email', $email, ['class' => 'form-control','readonly' => 'readonly']) }}
                           <span class="error help-inline">
                           <?php echo $errors->first('email'); ?>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
               
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{ Form::label('old_password', trans("messages.Account.old_password"), ['class' => 'mws-form-label'],false) }}
                          
                           <!-- Toll tip div end here -->
                           {{ Form::password('old_password',['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline">
                        <?php echo $errors->first('old_password'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{ Form::label('new_password', trans("messages.Account.new_password"), ['class' => 'mws-form-label'],false) }}
						    <span class='tooltipHelp' title="" data-html="true" data-toggle="tooltip"  data-original-title="<?php echo trans("messages.global.password_help_message"); ?>" style="cursor:pointer;">
                           <i class="fa fa-question-circle fa-2x"> </i>
                           </span>
                           {{ Form::password('new_password', ['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline">
                        <?php echo $errors->first('new_password'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="row clearfix">
                  <div class="col-sm-12">
                     <div class="form-group">
                        <div class="form-line">
                           {{Form::label('confirm_password', trans("messages.Account.confirm_password"), ['class' => 'mws-form-label'],false) }}
                           {{ Form::password('confirm_password',['class' => 'form-control']) }}
                        </div>
                        <span class="error help-inline">
                        <?php echo $errors->first('confirm_password'); ?>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="mws-button-row">
                  <div class="input" >
                     <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
                     <a href='{{ Request::url()}}' class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
                  </div>
               </div>
               {{ Form::close() }}
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   /** For tooltip */
   $('[data-toggle="tooltip"]').tooltip();   	
</script>
@stop
