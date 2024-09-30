<div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-body">
            <div class="testimonials-fulldecription pb-4">

                <figure>
                    <img src="{{ TESTIMONIAL_IMAGE_URL. $testimonialList->image }}" alt="image">
                </figure>
                <div class="headingDetail">
                    <div class="nameView">{{ $testimonialList->client_name }}</div>
                    <div class="positionview">{{ $testimonialList->designation }}</div>
                    <div class="workview">{{ $testimonialList->company }}</div>
                    <div class="linkview"><a href="{{ $testimonialList->linkedin_url }}"><i
                                class="fa fa-linkedin-square me-2"
                                aria-hidden="true"></i>{{ $testimonialList->linkedin_url }}</a></div>
                </div>

                <div class="detailparagraphview testimonials_decription pt-0 text-center ">
                    {!!  $testimonialList->comment !!}
                </div>
                <div class="quote-icon mt-2 text-center"> <img src="{{ WEBSITE_IMG_URL }}quote.svg" alt="image">
                </div>
            </div>

        </div>

    </div>
</div>
