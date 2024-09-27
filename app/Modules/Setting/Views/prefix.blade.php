@extends('admin.layouts.default')

@section('breadcrumbs')
	{{ Breadcrumbs::render('settings-prefix', ['title' => $prefix.' '.trans("messages.settings.setting"), 'type' => $prefix]) }}
@stop

@section('content')
<script>
	/**
	 * Function to get prefix of setting
	 */
	$(document).ready(function(){
		<?php 
		if($prefix == 'Email'){
		?>
			var emailTypeVal = $('.emailTypeSelect').val();
			if(emailTypeVal == 'Normal'){
				$("#CustomFormValidation").find('.mws-form-row').hide();
				$("#CustomFormValidation").find('.emailType').show();
			}
		<?php 
		} 
		?>	
		
		<?php 
		if($prefix == 'Email'){ 
		?>
		
			if($('.emailTypeSelect').val() == 'Normal'){
				$("#CustomFormValidation").find('input,textarea,label').hide();
				$('.emailDropDown').show();
				$('.emailDropDownlabel').show();
			}
			$('.emailTypeSelect').change(function(){
				var emailTypeVal = $(this).val();
				if(emailTypeVal == 'Normal'){
					$("#CustomFormValidation").find('input,textarea,label').hide();
					$("#CustomFormValidation").find('.mws-form-row').hide();
					$("#CustomFormValidation").find('.emailType').show();
					$('.emailDropDown').show();
					$('.emailDropDownlabel').show();
				}else{
					$("#CustomFormValidation").find('input,textarea,label').show();
					$("#CustomFormValidation").find('.mws-form-row').show();
				}
			});
		<?php 
		} 
		?>	
	});
</script>


<div class="container-fluid" id="main-container">
    <div class="row clearfix" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                      {{ $prefix }} {{ trans("messages.settings.setting") }}
                    </h2>
                </div>
				 <div class="body">
					{{ Form::open(['role' => 'form','url' =>route("Setting.prefix_update",array($prefix)),'class' => 'mws-form','id' =>'CustomFormValidation']) }}
					<div class="mt-20">	
						<?php $i = 0;
						if(!empty($result)){
						foreach ($result AS $setting) {
							$text_extention 	= 	'';
							$key				= 	$setting['key_value'];
							$asterisk			=	 '*';
							$keyE 				= 	explode('.', $key);
							$keyTitle 			= 	$keyE['1'];
					
							$label = $keyTitle;
							if ($setting['title'] != null) {
								$label = $setting['title'];
							}

							$inputType = 'text';
							if ($setting['input_type'] != null) {
								$inputType = $setting['input_type'];
							} 
                            
                        
                            $key_value		=	str_replace($prefix.".","", $setting['key_value']); 
                            $siteSettingKey	=	Config::get("SITE_SETTING_KEY");
                           
                            if(in_array($key_value, $siteSettingKey))
                            {
                            $required_field = '<span class="required"> * </span>';
                            }
                            else{
                                $required_field = '';
                            }
							
							
							$settingValue =	null;

							if(isset($setting['value'])){
								$settingValue	=	$setting['value'];
							}
							 
							if($oldval){
								$settingValue	=	isset($old_answer[$i]['value']) ? $old_answer[$i]['value'] : NULL;
							}

                            ?>
							
							{{ Form::hidden("Setting[$i][".'type'."]",$inputType) }}
							{{ Form::hidden("Setting[$i][".'id'."]",$setting['id']) }}
							{{ Form::hidden("Setting[$i][".'key_value'."]",$setting['key_value']) }}
							<?php 
								switch($inputType){
								case 'checkbox':
							?>	
							  <div class="row clearfix">
									<div class="col-sm-12">
											<div class="form-group">
													<div class="form-line">
														{{  Form::label('page_name', $label, ['class' => 'control-label'],false) }}	
														<?php 	
															$checked = ($settingValue == 1 )? true: false;
															$val	 = (!empty($settingValue)) ? $settingValue : 0;
														?>
														{{ Form::checkbox("Setting[$i][".'value'."]",$val,$checked,array('id'=>'checked_'.$i)) }} 
														<label for="checked_{{ $i }}" class="set_seeting_check"></label>
													</div>
											</div>
									</div>		
							</div>
							<?php
								break;	
								case 'textarea':	
								case 'text':
							?>
							 <div class="row clearfix">
									<div class="col-sm-12">
											<div class="form-group">
													<div class="form-line">
														{{  Form::label('page_name', $label.$required_field, ['class' => 'control-label'],false) }}	
														{{ Form::{$inputType}("Setting[$i][".'value'."]", $settingValue, ['class' => 'form-control','placeholder'=>$label]) }} 
													</div>
													@php
														$key_value	=	str_replace("Site.","", $setting['key_value']);
														echo '<span class="error help-inline">';
														echo $errors->first($key_value);
														echo '</span>';
													@endphp
													 
													
											</div>
									</div>		
							</div>
							<?php
								break;	
								case 'select':

							?>
							<div class="row clearfix emailType">
									<div class="col-sm-12">
											<div class="form-group">
													<div class="form-line">
														{{  Form::label("Setting.$i.value",$label.$required_field, ['class' => 'control-label emailDropDown'],false) }}	
														<?php
															$options		=	explode(',', $settingValue);
															$arrayValues	=	array_values($options);
															$options 		=	array_combine($arrayValues,$arrayValues);
															$emailClass		=	($prefix == 'Email') ? 'emailTypeSelect' : '';
															$selected		=	(in_array($setting['default_type'],$arrayValues)) ? $setting['default_type'] : '';
														?>
														{{ Form::select("Setting[$i][".'value'."]",$options,$selected,['class'=>$emailClass.' form-control','data-live-search'=>"true"])}} 
													</div>
											</div>
									</div>		
							</div>
							<?php 
								break;
								default:
							?>
							 <div class="row clearfix">
									<div class="col-sm-12">
											<div class="form-group">
													<div class="form-line">
														{{  Form::label('page_name', $label, ['class' => 'control-label'],false) }}	
														{{ Form::textarea("Setting[$i][".'value'."]", $settingValue, ['class' => 'form-control','placeholder'=>$label]) }} 
													</div>
											</div>
									</div>		
							</div>
								<?php	
									break;
										
								}
								$i++;
							}
						}
						?>	
						 <div>	
                            <button type="submit"  class="btn bg-pink btn-sm waves-effect btn-submit" ><i class="material-icons font-14">save</i> {{ trans('messages.global.save') }}</button>
                        </div>
						</div>
						{{ Form::close() }} 
					</div>
				 </div>
			</div>
		</div>	
</div>
@stop
