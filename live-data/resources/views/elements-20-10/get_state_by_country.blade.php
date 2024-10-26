@php 
	$classname		=	isset($classname) ? $classname : ''; 
	$allclassname	=	'form-control '.$classname; 
@endphp
@if(isset($country_id) && $country_id != '')
	@if(! empty($sectionName))
		{{ Form::select($stateFieldName, [null=>trans("front_messages.global.placeholder.state").'*'] + $stateList, null, ['class'=>$allclassname, 'id'=>$stateFieldName,'onchange'=>"getMailingCity(this.value,'".$cityFieldName."','".$cityDiv."','".$formId."')"]) }}
	@else
		{{ Form::select($stateFieldName, [null=>trans("front_messages.global.placeholder.state").'*'] + $stateList, null, ['class'=>$allclassname, 'id'=>$stateFieldName,'onchange'=>"getCity(this.value,'".$cityFieldName."','".$cityDiv."','".$formId."', '','','".$classname."')"]) }}
	@endif
@else
	@if(! empty($sectionName))
		{{ Form::select($stateFieldName, [null=>trans("front_messages.global.placeholder.state").'*'] + $stateList, null, ['class'=>$allclassname, 'id'=>$stateFieldName,'onchange'=>"getMailingCity(this.value,'".$cityFieldName."','".$cityDiv."','".$formId."', '','','".$classname."')"]) }}
	@else
		{{ Form::select($stateFieldName, [null=>trans("front_messages.global.placeholder.state").'*'] + $stateList, null, ['class'=>$allclassname, 'id'=>$stateFieldName,'onchange'=>"getCity(this.value,'".$cityFieldName."','".$cityDiv."','".$formId."')"]) }}
	@endif
@endif

