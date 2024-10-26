@php
$testimonialList = CustomHelper::getTestimonial();
@endphp
@if (!empty($testimonialList))
<section class="industry-experts my-3">
    <div class="container">
        <div class="text-center">
            <h1>Insights from the <strong style="
    color: #EC1C24;
">Industry experts</strong></h1>
        </div>
        <div class="body mt-4">
            <div class="swiper my-expert">
                <!-- Swiper Wrapper -->
                <div class="swiper-wrapper">
                @foreach ($testimonialList as $record)

                    <!-- Swiper Slide 1 -->
                    <div class="swiper-slide">
                        <div class="card d-flex align-items-center justify-content-center ps-5">
                            <div class="row d-flex align-items-center flex-reverse-rap">
                                <div class="col-md-6">
                                    <div class="content">
                                    <p><strong>{{ isset($record->descriptionData->comment) ?  CustomHelper::getStringLimit($record->descriptionData->comment,200) : '' }}</strong>
                                        <a data-href="{{ route('Home.readMore') }}" class="btn testimonial-modal-box" data-id="{{ $record->id }}">Read More</a>
                                    </p>                                        
                                    <div class="red-box d-flex align-items-center">
                                            <img src="assets/icons/redbox.svg" class="red-icon" alt="icon">
                                            <div class="name-info ms-4">
                                                <b>{{ isset($record->descriptionData->client_name) ? $record->descriptionData->client_name : '' }}</b><br>
                                                <small>{{ isset($record->descriptionData->designation) ? $record->descriptionData->designation : '' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                @php
                        $root_path = TESTIMONIAL_IMAGE_ROOT_PATH;
                        $http_path = TESTIMONIAL_IMAGE_URL;
                        $attribute = [];
                        $type = '';
                        $attribute['alt'] = $record->title;
                        $attribute['width'] = '295';
                        $attribute['height'] = '354';
                        $attribute['zc'] = '1';
                        $attribute['type'] = '3';
                        $image_name = $record->image;

                        $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
                        @endphp
                       <img class="owner-img"                                   
                                    {!! $image !!} >
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Swiper Slide 2 -->
                    <!-- <div class="swiper-slide">
                        <div class="card d-flex align-items-center justify-content-center ps-5">
                            <div class="row d-flex align-items-center flex-reverse-rap">
                                <div class="col-md-6">
                                    <div class="content">
                                        <p><b>It’s been 16 years in Banking and financial industry. I believe Online education offers flexibility and convenience, allowing students to access courses and materials from...</b></p>
                                        <div class="red-box d-flex align-items-center">
                                            <img src="assets/icons/redbox.svg" class="red-icon" alt="icon">
                                            <div class="name-info ms-4">
                                                <strong>Mohit Nagpal</strong><br>
                                                <small>National Sales Manager</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img src="assets/others/owner.png" class="owner-img" alt="">
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- Swiper Pagination (Optional) -->
                <div class="swiper-pagination"></div>
                
                <!-- Swiper Navigation Buttons -->
                <div class="swiper-button-next custom-next"></div>
                <div class="swiper-button-prev custom-prev"></div>
            </div>
        </div>
    </div>
        <div class="modal testimonialModal fade" id="testimonialModalBox" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="appendModalBox"></div>
</div>
</section>
<style>


/* .swiper-slide img {
    width: 100%;
    height: auto;
} */

.btn-red {
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    cursor: pointer;
}

.btn-red small {
    font-size: 12px;
}

.red-icon {
    width: 75px !important;
}

.owner-img {
    width: 356px !important;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('.my-expert')) {
    var expert = new Swiper('.my-expert', {
        slidesPerView: 1,
        spaceBetween: 31,
        loop: true,
        autoplay: {
            delay: 3300,
            disableOnInteraction: true,
            pauseOnMouseEnter: true,
            pauseOnMouseLeave: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
        };
    })
</script>

<script>
    $(document).on('click', '.testimonial-modal-box', function(){
        var url = $(this).data('href');
        var id = $(this).data('id');

        $.ajax({
			type: 'POST',
			url: url,
			data: {
                id : id
            },
			headers: {
				'X-CSRF-TOKEN': csrf_token
			},
			beforeSend: function() {
				blockedUI();
			},
			success: function(r) {
				// $(".error-message").empty();
				unblockedUI();
				if (r.status == 'success') {
					$(".appendModalBox").html(r.html)
					$("#testimonialModalBox").modal('show');
				}
			}
		});
    })
</script>
@endif