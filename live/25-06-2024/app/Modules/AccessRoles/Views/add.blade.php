@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('access-role-add') }}
@stop

@section('content')
<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ trans("messages.$modelName.table_heading_add") }}
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
				 {{ Form::open(['role'=>'form', 'route'=>"$modelName.add", 'class'=>'mws-form']) }}
					 <div class="mt-20">		 	
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        {{  Form::label('role', trans("messages.$modelName.role").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}	
                                        {{ Form::text('role','', ['class' => 'form-control']) }}
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
												<div class="tree margin-0px module">
													<ul class="module_ul">
														@foreach($parentList as $value)
														@if(!empty($value['children']))
													
													<div class="markhere">
														<li class="parent_li">
															<i title="Expand this branch" class="fa fa-plus-circle plusbtn"></i>
															<label class="parent_child_label">
																<input value="1" type="checkbox" class="parentCheckbox filled-in" name="module[{{$value['id']}}][allow]">
																
															    {{$value['title']}}
															</label>
															<div class="childTree">
																<ul class="children_ul">
																@foreach($value['children'] as $children)
																	<li class="parent_li">
																		<span class="children_span"><input value="1" type="checkbox" class="parentCheckbox" name="module[{{$children['id']}}][allow]">
																		{{$children['title']}}</span>
																	</li>
																@endforeach
																</ul>
															</div>
														</li>
													</div>
												@else
													<li class="parent_li">
													  	<label class="dashboard">
													  		@if($value['path']!='AdminDashBoard.index') 
													  			<input type="checkbox" name="module[{{$value['id']}}][allow]" value="1" class="parentCheckbox filled-in">
													  		@else
													  			<input type="checkbox" checked="checked" disabled="disabled" class="parentCheckbox dashboard_class">
													  			<input type="hidden" name="module[{{$value['id']}}][allow]" value="1" class="parentCheckbox">
													  		@endif
													  		{{$value['title']}}
													  	</label>
														
														@if($value['path'] != 'AdminDashBoard.index')
														@endif
													</li>  
												@endif											
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
									
								
								
								</div>
                            </div>
                        </div>
						 <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>

                         <a href="{{ route($modelName.'.add')}}"  class="text-decoration-none"><button type="button" class="btn bg-blue-grey btn-sm waves-effect"><i class="material-icons font-14">refresh</i>{{ trans('messages.global.reset')}}</button></a>
						
						
					</div>	
				 {{ Form::close() }} 
				 </div>
			</div>	
		</div>	
	</div>	
</div>	
				




<!-- For Modules Tree -->
{{ HTML::style('css/admin/module_tree.css') }}
<script>
	$(document).ready(function(){
		$('.parentCheckbox, .childCheckbox').on('click',function(){		
			var parent = $(this).closest("li");
			var len = $(parent).find("input:checkbox:checked").length;
			if(len == 1){
				$(this).closest('li').find('input').prop("checked",true);
				$(this).parents('li').find('input:first').prop("checked",true);
				$(this).closest('li').next('ul').find('input').prop("checked",true);
			}
			else{
				$(this).closest('li').find('input').prop("checked",false);
				$(this).closest('li').next('ul').find('input').prop("checked",false);
				lengthCount = ($(this).parents('li').find('input:checkbox:checked').length)-1;
				if(lengthCount==0){
					$(this).parents('li').find('input:first').prop("checked",false);
				}
			}
		});
		/*========= Check and Uncheck checkbox =========*/
		$('.childbox').on('click',function(){
			var parent = $(this).closest("div");
			var len = $(parent).find("input:checkbox:checked").length;
			if(len >= 1){
				$(this).closest('li').find('input:first').prop("checked",true);
				$(this).parents('li').find('input:first').prop("checked",true);
				$(this).closest('.parent_li').find('input:first').prop('checked',true);
				lengthCount = ($(this).closest('.parent_li').find('input:checkbox:checked').length)-1;
				if(lengthCount == 0){
					$(this).closest('.parent_li').find('input:first').prop('checked',false);
				}
				lengthAllCount = $(this).parents('li.parent_li').find('input:checkbox:checked').length;
				
				if(lengthAllCount>=0){
					$(this).parents('li.parent_li').find('input:first').prop("checked",true);
				}
			}else{
				$(this).closest('li').find('input:first').prop("checked",false);
			
				lengthCount = $(this).closest('.parent_li').find('input:checkbox:checked').length;
				if(lengthCount == 0){
					$(this).closest('.parent_li').find('input:first').prop('checked',false);
				}
				lengthAllCount = ($(this).parents('li.parent_li').find('input:checkbox:checked').length)-1;
				if(lengthAllCount==0){
					$(this).parents('li.parent_li').find('input:first').prop("checked",false);
				}
			}
		});

		$('.plusbtn').on('click', function(){
			$(this).toggleClass('fa-plus-circle fa-minus-circle');
			var par = $(this).parent();
			par.children('.childTree').toggle('slow');
		});

		$('.CheckAll').on('click',function(){
			$('.parent_li').find('input').prop('checked',true);
		});
		$('.UnCheckAll').on('click',function(){
			$('.parent_li').find('input').prop('checked',false);
			$('.dashboard_class').prop('checked',true);
		});
	});
</script>
@stop
