@extends('layouts.default')
@section('content')

@php

$name = isset($result->descriptionData->title) ? $result->descriptionData->title : '';
$description = isset($result->descriptionData->description) ? $result->descriptionData->description : '';

@endphp

<!--term and condition-->


@if ($slug == 'about-us')

@if(!empty($blockData))
{!! $blockData->description !!}
@endif

@if (!empty($description))
{!! $description !!}
@else
N/A
@endif


<!-- ################ Learner Support ################ -->

@include('elements.learner_support',['about_learner'=> "about_learner_section"])

<!-- ################ Learner Support ################ -->




@else

@if (!empty($description))
{!! $description !!}
@else
N/A
@endif

@endif
@stop