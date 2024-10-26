

<div class="modal fade" id="enquireNowModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal_applynow">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{ trans('front_messages.global.enquire_now') }}</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                {{-- Enquire Now Form Element --}}
                @include('elements.enquire_now_form')
                {{-- Enquire Now Form Element --}}
                
            </div>
        </div>
    </div>
</div>