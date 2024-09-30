@extends('layouts.default')
@section('content')


{{ Form::open(['role' => 'form', 'route' => "survey.getAssistStepsSave", 'files' => true, 'class' => 'mws-form', 'id' => 'formData']) }}  
<input type="hidden" name="next_question_slug" value="{{ $nextQuestionSlug }}">
<input type="hidden" name="current_question_id" value="{{ $SurveQuestion->id }}">
<section class="bg_gray course_process_section">
        <div class="container">
            <div class="progress_bar">
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width:{{$totalAnswerdInPercentage}}%"></div>
                </div>
            </div>
            <div class="degree_heading text-center">
                 <h1>{{ $SurveQuestion->question  }}</h1>
                
            </div>
            <div class="error help-inline current_answer_error">
                <?php echo $errors->first('current_answer'); ?>
            </div>

            @php
                if(count($SurveQuestion->getAnswers) > 6){
                    $processCurrentAnswerClass = 'process_particular';
                } else{
                    $processCurrentAnswerClass = 'current_answer_process';
                }
            @endphp

            <div class="degree_contant_box {{$processCurrentAnswerClass}}">
                <ul> 
                    @foreach ($SurveQuestion->getAnswers as $answer)
                        <li>
                            <input class="current_answer" name="current_answer" id="{{ $answer->answer }}" type="radio" value="{{ $answer->id }}"<?php if($saved_current_answer == $answer->id){ echo "checked"; }?>>
                            <label for="{{ $answer->answer }}">
                                @if(count($SurveQuestion->getAnswers) < 7)
                                    <span> <img class="main_img" src="{{WEBSITE_IMAGE_URL }}degree_icon.svg" alt="img"> </span>
                                    <span> <img class="white_img" src="{{ WEBSITE_IMAGE_URL }}degree_icon_white.svg" alt="img"></span>
                                @endif
                                <small>{{ !empty($answer->answer)? $answer->answer :'N/A' }}</small>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <footer class="footer_step">
        <div class="container">
            <div class="step_btn text-center">
				@if(empty($answerArray))
					<a href="{{ route('survey.getAssist', $expert_slug) }}" class="btn btn-white">Back</a>
				@else
					<a href="{{ route('survey.getAssistPreviousStep') }}" class="btn btn-white">Back</a>
				@endif
                
                <button type="submit" class="btn btn-next btn-submit">Next</button>
            </div>
        </div>
    </footer>
    {{ Form::close() }}
    <div class="overley_backdrop"></div>

@stop
