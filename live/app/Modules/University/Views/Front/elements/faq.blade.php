<section id="FAQ" class="faq_main_section">
    <!-- <span id="FAQ" class="anchorslide"></span> -->
    <div class="faq_content">
        <h2 class="heading_program_details">{{ trans('front_messages.global.faq_ask_question') }}</h2>

        <div class="faq_content_box accordion accordion-flush" id="accordionFlushExample">

            @if(!empty($result->faqs))
            @foreach($result->faqs as $faqData)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $faqData->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $faqData->id }}">
                        {{ $faqData->question }}
                    </button>
                </h2>
                <div id="flush-collapse{{ $faqData->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        {!! $faqData->answer !!}
                    </div>
                </div>
            </div>
            @endforeach
            @endif

        </div>
    </div>
</section>