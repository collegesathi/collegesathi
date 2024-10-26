@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('access-role-edit') }}
@stop

@section('content')
<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_edit") }}
                    </h2>
                    <ul class="header-dropdown m-r--5 btn-right-top-margin">
                        <li>
                            <a href='{{ route("$modelName.index")}}' >
                                <button type="button" class="btn bg-indigo waves-effect"><i class="material-icons font-14">keyboard_backspace</i>{{ trans("messages.global.back") }}</button>
                            </a>

                        </li>
                    </ul>
				</div>
				<div class="body">
					{{ Form::model($roleData,['role' => 'form','url' => route("$modelName.update"),'class' => 'mws-form','files'=>true]) }} 
					{{ Form::hidden('id', $roleData['id']) }}
					 <div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{  Form::label('role', trans("messages.$modelName.role").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
                                        {{ Form::text('role',null, ['class' => 'form-control']) }}
									</div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('role'); ?>
                                    </span>
							    </div>
                            </div>
                        </div>
						 <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{  Form::label('module', trans("messages.$modelName.module").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
                                    </div>
                                    <span class="error help-inline">
                                        <?php echo $errors->first('module'); ?>
                                    </span>
									<button class="btn btn-success CheckAll" type="button">{{ trans("messages.global.check_all") }}</button>
									<button class="btn btn-info UnCheckAll" type="button">{{ trans("messages.global.uncheck_all") }}</button>
										<div class="inner-spacer">
												<div class="tree border_class margin-0px">
														<div class="inner-spacer">
															<div class="tree  margin-0px module">
																{!! AdminMenuHelper::EditTreeMenu($parentList, json_decode($roleData['jsondata'], true)) !!}
																
															</div>
														</div>
												</div>
										</div>
								</div>
                            </div>
                        </div>
						 <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                         <a href="{{ Request::url() }}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
					</div>	
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>	

<!-- For Modules Tree -->
{{ HTML::style('css/admin/module_tree.css') }}

<style type="text/css">
.tree > ul > li::before, .tree > ul > li::after {
    border: 0 !important; 
}
</style>

<script type="text/javascript">
	// Check and Uncheck Checkbox
	jQuery('.parentCheckbox, .childCheckbox').on('click',function(){
		var parent = $(this).closest("li");
		var len = jQuery(parent).find("input:checkbox:checked").length;
		if(len == 1){
			jQuery(this).closest('li').find('input').prop("checked",true);
			jQuery(this).parents('li').find('input:first').prop("checked",true);
			jQuery(this).closest('li').next('ul').find('input').prop("checked",true);
		}else{
			jQuery(this).closest('li').find('input').prop("checked",false);
			jQuery(this).closest('li').next('ul').find('input').prop("checked",false);
			lengthCount = (jQuery(this).parents('li').find('input:checkbox:checked').length)-1;
			if(lengthCount==0){
				jQuery(this).parents('li').find('input:first').prop("checked",false);
			}
		}
	});
	// Check and Uncheck child Checkbox
	jQuery('.childbox').on('click',function(){
		var parent = $(this).closest("div");
		var len = jQuery(parent).find("input:checkbox:checked").length;
		if(len >= 1){
			jQuery(this).closest('li').find('input:first').prop("checked",true);
			jQuery(this).parents('li').find('input:first').prop("checked",true);
			jQuery(this).closest('.parent_li').find('input:first').prop('checked',true);
			lengthCount = (jQuery(this).closest('.parent_li').find('input:checkbox:checked').length)-1;
			if(lengthCount == 0){
				jQuery(this).closest('.parent_li').find('input:first').prop('checked',false);
			}
			lengthAllCount = jQuery(this).parents('li.parent_li').find('input:checkbox:checked').length;
			
			if(lengthAllCount>=0){
				jQuery(this).parents('li.parent_li').find('input:first').prop("checked",true);
			}
		}else{
			jQuery(this).closest('li').find('input:first').prop("checked",false);
		
			lengthCount = jQuery(this).closest('.parent_li').find('input:checkbox:checked').length;
			if(lengthCount == 0){
				jQuery(this).closest('.parent_li').find('input:first').prop('checked',false);
			}
			lengthAllCount = (jQuery(this).parents('li.parent_li').find('input:checkbox:checked').length)-1;
			if(lengthAllCount==0){
				jQuery(this).parents('li.parent_li').find('input:first').prop("checked",false);
			}
		}
	});
	// Check all Checkbox
	jQuery('.CheckAll').on('click',function(){
		jQuery('.parent_li').find('input').prop('checked',true);
	});
	// Uncheck all Checkbox
	jQuery('.UnCheckAll').on('click',function(){
		jQuery('.parent_li').find('input').prop('checked',false);
		jQuery('.dashboard_class').prop('checked',true);
	});
	
	$('.plusbtn').on('click', function(){
		
			$(this).toggleClass('fa-plus-circle fa-minus-circle');
			var par = $(this).parent();
		
			par.children('.childTree').toggle('slow');
	});
</script>
@stop
