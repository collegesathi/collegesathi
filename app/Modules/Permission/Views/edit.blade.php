@extends('admin.layouts.default')
@section('title', trans("messages.$modelName.table_heading_edit"))

@section('breadcrumbs')
	{{ Breadcrumbs::render('admin-user-edit') }}
@stop

@section('content')
<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> {{ trans("messages.$modelName.table_heading_edit") }}  </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.index")}}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
                </div>
                <div class="body">

					{{ Form::model($model, ['role'=>'form','route' => "$modelName.update", 'class'=>'mws-form', 'files'=>true]) }}
						{{ Form::hidden('id', null) }}
						{{ Form::hidden('user_id', null) }}

						<div class="mt-20">
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											 {{  Form::label('first_name', trans("messages.$modelName.first_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::text("first_name", (isset($model->user->first_name) ? $model->user->first_name : ''), ['class' => 'form-control']) }}
										</div>
										<span class="error help-inline">
											 {{ $errors->first('first_name') }}
										</span>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											 {{  Form::label('last_name', trans("messages.$modelName.last_name").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::text("last_name", (isset($model->user->last_name) ? $model->user->last_name : ''), ['class' => 'form-control']) }}
										</div>
										<span class="error help-inline">
											 {{ $errors->first('last_name') }}
										</span>
									</div>
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											{{  Form::label('role_id', trans("messages.$modelName.role").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::select('role_id', [null=>trans("messages.$modelName.select_user_role")]+$role, null, ['id'=>'AdminPermissionUserRoleId','class' => 'form-control']) }}
										</div>
										<span class="error help-inline">
											{{ $errors->first('role_id') }}
										</span>
									</div>
								</div>
							 
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											 {{  Form::label('email', trans("messages.$modelName.email").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
											{{ Form::text("email",(isset($model->user->email) ? $model->user->email : ''), ['class' => 'form-control','readonly']) }}
										</div>
										<span class="error help-inline">
											{{ $errors->first('email') }}
										</span>
									</div>
								</div>
							</div>

							<!-- For append module data -->
							<div class="getModule"></div>
							<div>
								<button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.update') }}</button>

								<a href=""  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
							</div>
						</div>
					{{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- For Modules Tree -->
{{ HTML::style(WEBSITE_ADMIN_CSS_URL.'module_tree.css') }}

<script type="text/javascript">
    $(document).ready(function(){
        /** For tooltip */
        $('[data-toggle="tooltip"]').tooltip();
        /*=========== When load page first time get module data ===========*/
        getModule();
    });

    /** Use for get Role permission based on module **/
    function getModule(){
        var id = $("#AdminPermissionUserRoleId option:selected").val();
        if(id){
            url = "{{ url('admin-system-manager/permission/editmodueledata') }}"+'/'+"{{$model->id}}";
            $.ajax({
                url         : url,
                type        : "GET",
                beforeSend  : function() {
                    $('#overlay').show();
                },
                success:function(data){
                    $('#overlay').hide();
                    $('.getModule').html(data);
                }
            });
        }
    }

    /*=========== When change role  get module data =========*/
    $('#AdminPermissionUserRoleId').on('change',function(){
        var id = $(this).val();
        if(id){
            url = "{{ url('admin-system-manager/permission/getmodueledata') }}"+'/'+id;
            $.ajax({
                url         : url,
                type        : "GET",
                beforeSend  : function() {
                    $('#overlay').show();
                },
                success:function(data){
                    $('#overlay').hide();
                    $('.getModule').html(data);
                }
            });
        }
    });
</script>
@stop
