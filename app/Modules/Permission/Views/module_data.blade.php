<div class="mws-form-row">
	{{ Form::label('modules', trans("messages.$modelName.module_allowed").'<span class="required"> * </span>', ['class' => 'control-label'],false) }}
	<div class="parsley-errors"> {{ $errors->first('modules') }} </div>

	<div class="mws-form-item permission_modules">
		<!--Check and Uncheck Buttons -->
		<button class="btn btn-info CheckAll" type="button">{{ trans("messages.global.check_all") }}</button>
		<button class="btn btn-success UnCheckAll" type="button">{{ trans("messages.global.uncheck_all") }}</button>
		
		<div class="inner-spacer">
			<div class="trees margin-0px">
				<div class="inner-spacer">						
					<div class="trees well margin-0px module">					
						<ul>
							@if(count($menus)>0)
								@foreach($menus as $menu)
									@php 
										$title 	= $menu['title'];
										$id 	= $menu['id'];
										$route	= $menu['path'];
									@endphp
									<li class="parent_li">
										@if(isset($module[$id]['allow']) && ($module[$id]['allow'] == PERMISSION_ALLOW))
											@if(!empty($menu['children']))
												<span class="parent_child_span" title="Expand this branch"><i class="fa fa-plus-circle"></i></span><label class="parent_child_label" for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" checked="checked">
											@else
												<label class="dashboard"  for="AdminRoleModuleId{{ $id }}Allow">
												@if($route != 'AdminDashBoard.index')
													<input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" checked="checked">
												@else
													<input type="checkbox" class="parentCheckbox dashboard_class" disabled="disabled" checked="checked">
													<input type="hidden" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]">
												@endif
											@endif
										@else
											@if(!empty($menu['children']))
												<span class="parent_child_span" title="Expand this branch"><i class="fa fa-plus-circle"></i></span><label class="parent_child_label" for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" >
											@else
												<label class="parent_child_label" for="AdminRoleModuleId{{ $id }}Allow">
												@if($route != 'AdminDashBoard.index')
													<input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" >
												@else
													<input type="checkbox" class="parentCheckbox dashboard_class" disabled="disabled" checked="checked">
													<input type="hidden" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" >
												@endif
											@endif
										@endif
										
										&nbsp; {{ $title }} </label>
										@if(!empty($menu['children']))
											<ul>
											@foreach($menu['children'] as $child)
												@php 
													$childId 	= $child['id'];	
													$childTitle = $child['title'];
												@endphp
												<li class="hide">
													<span class="label label-success">
													@if(isset($module[$childId]['allow']) && ($module[$childId]['allow'] == PERMISSION_ALLOW))
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}Allow"><input type="checkbox" value="1" id="AdminRoleModuleId{{ $childId }}Allow" class="childCheckbox" name="module[{{ $childId }}][allow]" checked="checked">
													@else
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}Allow"><input type="checkbox" value="1" id="AdminRoleModuleId{{ $childId }}Allow" class="childCheckbox" name="module[{{ $childId }}][allow]">
													@endif
													
													&nbsp; {{ $childTitle }} </label></span>
													
													<div class="btn-group btn-group-xs parentManagement" style="font-size:12px; display:none;">
														@if(isset($module[$childId]['list_permission']) && ($module[$childId]['list_permission'] == PERMISSION_ALLOW))
															&nbsp; 
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" checked="checked">&nbsp;{{ trans("messages.global.list") }}</label>	
														@else
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.list") }}</label>	
														@endif
														
														@if(isset($module[$childId]['add_permission']) && ($module[$childId]['add_permission'] == PERMISSION_ALLOW))
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.add") }}</label>
														@else
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.add") }}</label> 
														@endif
														
														@if(isset($module[$childId]['edit_permission']) && ($module[$childId]['edit_permission'] == PERMISSION_ALLOW))
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.edit") }}</label>
														@else
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.edit") }}</label>	
														@endif
														
														@if(isset($module[$childId]['delete_permission']) && ($module[$childId]['delete_permission'] == PERMISSION_ALLOW))	
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId'.$childId.'DeletePermission" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.delete") }}</label>
														@else
															&nbsp;
															<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" id="AdminRoleModuleId{{ $childId }}DeletePermission" class="childbox" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.delete") }}</label>
														@endif
													</div>
													
													@if(!empty($child['children']))
														@if(is_array($child['children']))
															<ul>
																@foreach($child['children'] as $menu)
																	@php 
																		$title 	= $menu['title'];
																		$id 	= $menu['id'];
																	@endphp
																	<li  class="parent_li">
																	@if(isset($module[$id]['allow']) && ($module[$id]['allow'] == PERMISSION_ALLOW))
																		@if(!empty($menu['children']))
																			<span title="Expand this branch"><i class="fa fa-plus-circle"></i></span><label class="label label-danger parent_child_label" for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" checked="checked">
																		@else
																			<label class="label label-danger parent_child_label"  for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" checked="checked">
																		@endif
																	@else
																		@if(!empty($menu['children']))
																			<span title="Expand this branch"><i class="fa fa-plus-circle"></i></span><label class="label label-danger parent_child_label" for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" >
																		@else
																			<label class="label label-danger parent_child_label" for="AdminRoleModuleId{{ $id }}Allow"><input type="checkbox" id="AdminRoleModuleId{{ $id }}Allow" value="1" class="parentCheckbox" name="module[{{ $id }}][allow]" >
																		@endif
																	@endif
																	
																	&nbsp; {{ $title }} </label>
																	@if(!empty($menu['children']))
																		<ul>
																		@foreach($menu['children'] as $child)
																			@php 
																				$childId 	= $child['id'];	
																				$childTitle = $child['title'];
																			@endphp
																			
																			<li>
																			<span class="label label-success">
																			@if(isset($module[$childId]['allow']) && ($module[$childId]['allow'] == PERMISSION_ALLOW))
																				<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}Allow"><input type="checkbox" value="1" id="AdminRoleModuleId{{ $childId }}Allow" class="childCheckbox" name="module[{{ $childId }}][allow]" checked="checked">
																			@else
																				<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}Allow"><input type="checkbox" value="1" id="AdminRoleModuleId{{ $childId }}Allow" class="childCheckbox" name="module[{{ $childId }}][allow]">
																			@endif
																			
																			&nbsp; {{ $childTitle }} </label></span>
																			
																			<div class="btn-group btn-group-xs parentManagement">
																				@if(isset($module[$childId]['list_permission']) 
																				&& ($module[$childId]['list_permission'] == PERMISSION_ALLOW))
																					&nbsp; 
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" checked="checked">&nbsp;{{ trans("messages.global.list") }}</label>	
																				@else
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.list") }}</label>
																				@endif
																				
																				@if(isset($module[$childId]['add_permission']) && ($module[$childId]['add_permission'] == PERMISSION_ALLOW))
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.add") }}</label>
																				@else
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.add") }}</label> 
																				@endif
																				
																				@if(isset($module[$childId]['edit_permission']) 
																				&& ($module[$childId]['edit_permission'] == PERMISSION_ALLOW))
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.edit") }}</label>
																				@else
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.edit") }}</label>
																				@endif
																				
																				@if(isset($module[$childId]['delete_permission']) && ($module[$childId]['delete_permission'] == PERMISSION_ALLOW))	
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId'.$childId.'DeletePermission" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.delete") }}</label>
																				@else
																					&nbsp;
																					<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" id="AdminRoleModuleId{{ $childId }}DeletePermission" class="childbox" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.delete") }}</label>
																				@endif
																			</div>
																			@if(!empty($child['children']))
																				@if(is_array($child['children']))
																					$result .= AdminSideMenu::EditTreeMenu($child['children'],$module);	
																					
																				@endif
																			@endif
																			</li>
																		@endforeach
																		</ul>
																	@endif
																	</li>			
																@endforeach
															</ul>
														@endif
													@endif
												</li>
											@endforeach
											</ul>
										@else
										
											@php
												$childId 	= $menu['id'];	
												$childTitle = $menu['title'];
												$path 		= $menu['path'];
											@endphp

											@if($path != 'AdminDashBoard.index')
												<div class="btn-group btn-group-xs parentManagement" style="font-size:12px; display:none;">
													@if(isset($module[$childId]['list_permission']) && ($module[$childId]['list_permission'] == PERMISSION_ALLOW))
														&nbsp; 
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" checked="checked">&nbsp;{{ trans("messages.global.list") }}</label>	
													@else
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}ListPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}ListPermission" value="1" name="module[{{ $childId }}][list_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.list") }}</label>	
													@endif
													
													@if(isset($module[$childId]['add_permission']) && ($module[$childId]['add_permission'] == PERMISSION_ALLOW))
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.add") }}</label>
													@else
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}AddPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}AddPermission" value="1" name="module[{{ $childId }}][add_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.add") }}</label> 
													@endif
													
													@if(isset($module[$childId]['edit_permission']) && ($module[$childId]['edit_permission'] == PERMISSION_ALLOW))
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.edit") }}</label>
													@else
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}EditPermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId{{ $childId }}EditPermission" value="1" name="module[{{ $childId }}][edit_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.edit") }}</label>	
													@endif
													
													@if(isset($module[$childId]['delete_permission']) && ($module[$childId]['delete_permission'] == PERMISSION_ALLOW))	
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" class="childbox" id="AdminRoleModuleId'.$childId.'DeletePermission" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" checked/>&nbsp;{{ trans("messages.global.delete") }}</label>
													@else
														&nbsp;
														<label class="cursor_pointer" for="AdminRoleModuleId{{ $childId }}DeletePermission"><input type="checkbox" id="AdminRoleModuleId{{ $childId }}DeletePermission" class="childbox" value="1" name="module[{{ $childId }}][delete_permission]" class="btn btn-default" />&nbsp;{{ trans("messages.global.delete") }}</label>
													@endif
												</div>
											@endif
										@endif
									</li>			
								@endforeach
							@else
								<li>{{ trans("messages.global.no_record_found_message") }}</li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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

	$(document).ready(function () {
		$(function treeview() {
			$('.trees li.parent_li > span').on('click', function (e) {
				var children = $(this).parent('li.parent_li').find(' > ul > li');
				if (children.is(":visible")) {
					children.addClass('hide');
					$(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus-circle').removeClass('fa-minus-circle');
				} else {
					children.removeClass('hide');
					$(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-circle').removeClass('fa-plus-circle');
				}
				e.stopPropagation();
			});
		});
	});
</script>
