@php $classname	=	isset($classname) ? 'form-control '.$classname : 'form-control'; @endphp

@if (isset($state_id) && $state_id != '')
    {{ Form::select($cityFieldName, [null => trans('front_messages.global.placeholder.city').'*'] + $citylist, null, ['class' => $classname, 'id' => 'city']) }}
@else
    {{ Form::select($cityFieldName, [null => trans('front_messages.global.placeholder.city').'*'] + $citylist, null, ['class' => $classname, 'id' => 'city']) }}
@endif
