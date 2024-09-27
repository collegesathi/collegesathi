@extends('layouts.default')
@section('content')



    <section class="allUniversties-section">
        <div class="container">

            <div class="headingCard mb-5">
                <h2 class="heading text-center">{!! trans('front_messages.global.allNewUniversitiesHeading') !!}</h2>
                <p class="paragraphline text-center">{{ trans('front_messages.global.allNewUniversitiesText') }}</p>
            </div>

            {{-- @php
				   pr($result->toArray());die;
			   @endphp --}}

			<ul class="leading-universitiesList allUniverstiesList university-data">
				@include('University::Front.elements.new_universities')
			</ul>


            @if ($lastPage != $currentPage)
                <div class="collage_listing_btn seemore">
                    <a class="btn btn-primary view_more" data-page="{{ $result->currentPage() + 1 }}"
                        href="javascript:void(0);">{{ trans('front_messages.global.view_more') }}</a>
                </div>
            @endif

        </div>




    {{-- Enquire Now Form Model --}}
    @include('elements.enquire_now')
    {{-- Enquire Now Form Model --}}

    {{-- Enquire Now Sticky Button Element --}}
    @include('elements.enquire_now_sticky_button')
    {{-- Enquire Now Sticky Button Element --}}
    </section>



    <script type="text/javascript">
    	var universityListURL = "{{ route('University.getAllNewUniversity') }}";
        $(document).on('click', '.view_more', function() {
            var page = $(this).attr('data-page');
            $.ajax({
                url: universityListURL,
                data: {
                    page: page
                },
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                beforeSend: function() {
                    blockedUI();
                },
                success: function(data) {
					console.log(data);
                    unblockedUI();
                    if (data.status == "success") {
                        $(".university-data").append(data.html);
                        if (data.lastPage == data.currentPage) {
                            $(".seemore").hide();
                        } else {
                            $(".seemore").show();
                            $(".view_more").attr('data-page', data.currentPage + 1);
                        }
                    }
                }
            });
        });
    </script>



{{-- Enquire Now Script --}}
<script>
    window.addEventListener('load', function() {
        setTimeout(function () {
        var myModal = new bootstrap.Modal(document.getElementById('enquireNowModel'));
            myModal.show();
        }, 2000);
    });
</script>
{{-- Enquire Now Script --}}
@stop
