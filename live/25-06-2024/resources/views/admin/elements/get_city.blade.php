{{ Form::select("city",[null=>'Please select city']+$cityList,null,['class'=>'form-control show-tick','id'=>'city','data-live-search'=>"true"]) }}

<div class="error-message help-inline">
	<?php echo $errors->first('city'); ?>
</div>