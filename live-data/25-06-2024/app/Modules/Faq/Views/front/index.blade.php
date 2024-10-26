@extends('layouts.default')
@section('content')

    @if (!$faqData->isEmpty())

        <section class="blog_details_section common_background_img faq-banner">
            <div class="container">
                <div class="faq-sction-start">
                    <div class="left-col">
                        <span>{{ trans('front_messages.global.help_center') }}</span>
                        <h1>{!! trans('front_messages.global.frequently_asked_questions') !!}</h1>
                    </div>
                    <div class="right-col">

                    </div>
                </div>
            </div>
        </section>
        <div class="faq-box-start">
            <div class="container">
                <div class="faq_content">
                    <div class="faq_content_box accordion accordion-flush" id="accordionFlushExample">
                        @foreach ($faqData as $key => $record)
                            @php
                                $questionId = isset($record->id) ? $record->id : '';
                                $question = isset($record->question) ? $record->question : '';
                                $answer = isset($record->answer) ? $record->answer : '';

                                $calClass = '';  
                                $ariaExpanded = false;
                                $collapse = 'collapsed';

                                if ($key == 0) {
                                    $calClass = 'show';
                                    $ariaExpanded = true;
                                    $collapse = '';
                                }

                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{$collapse}}" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne_{{ $questionId }}" aria-expanded="{{$ariaExpanded}}"
                                        aria-controls="flush-collapseOne_{{ $questionId }}">
                                        {!! html_entity_decode($question) !!}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne_{{ $questionId }}" class="accordion-collapse collapse {{$calClass}}"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                       {!! html_entity_decode($answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
