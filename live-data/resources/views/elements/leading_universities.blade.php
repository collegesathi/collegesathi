<?php
$collaborationUniversity = CustomHelper::getCoallborationUniversity(); ?>



@if($collaborationUniversity->isNotEmpty())
<section class="leading-universities my-5">
    <div class="container">
        <div class="header d-flex align-items-center justify-content-between">
            <div>
            <h2 class="mb-1">Discover Leading Universities</h2>
                    <p class="mb-0">
                        Compare programs from 100+ verified institutions to make informed, decisions with us
                    </p>
            </div>
            <a href="{{ route('University.getAllNewUniversity') }}" class="btn btn-red sm-ds-none">View All ></a>
        </div>
        <div class="body mt-5">
            <div class="swiper my-leading">
            <div class="swiper-wrapper">              
                     <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-1">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/amity-university-online">                                  
                                    <img src="./assets/unis/unilogoamity.png" alt="u-logo">
                                    
                                    <p class="mb-0" style="
    color: white;
">Amity University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-2">
                                <div class="body p-2">                             
                                <a href="https://www.collegesathi.com/university/nmims-online">  
                                    <img src="./assets/unis/unilogoNMIMS.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">NMIMS University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-3">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/manipal-university-online">  
                                    <img src="./assets/unis/unilogomanipal.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">Manipal University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-4">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/chandigarh-university">
                                    <img src="./assets/unis/unilogoCU.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">Chandigarh University Online</p></a>
                                </div>
                            </div>
                            </div>                        
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-5">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/sharda-university">
                                    <img src="./assets/unis/unilogoSHARDA.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">Sharda University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-1">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/jain-university">
                                    <img src="./assets/unis/unilogoJAIn.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">Jain University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-2">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/lovely-professional-universitylpu">
                                    <img src="./assets/unis/unilogoLPU.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">LPU University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-3">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/dr-dy-patil-vidyapeeth-university">
                                    <img src="./assets/unis/unilogoDPU.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">DPU University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-4">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/vgu-vivekananda-global-university">
                                    <img src="./assets/unis/unilogoVGU.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">VGU University Online</p></a>
                                </div>
                            </div>
                            </div>
                            <div class="swiper-slide">
                            <div class="card-content cards p-0 border-0 c-5">
                                <div class="body p-2">
                                <a href="https://www.collegesathi.com/university/manipal-university-online">
                                    <img src="./assets/unis/unilogoSMU.png" alt="u-logo">
                                    <p class="mb-0" style="
    color: white;
">Sikkim Manipal University</p>
</a>
                                </div>
                            </div>
                            </div>
                            
                
                </div>

                <!-- Navigation Buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>
</section>


@endif

<style>

.cards {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f0f0f0;
    height: 200px;
    width: 200px;
    border-radius: 10px;
}

.card-content {
   
    text-align: center;
}


@media(max-width: 500px) {

    .cards {
        width: 180px !important;
    }

    .body {
        margin-top: 1rem !important;
    }

}
.my-swiper .swiper-slide {
    margin: 0; /* Ensure no additional margin */
    padding: 0; /* Ensure no additional padding */
}
</style>

<script>
	// Initialize Swiper
    let swiper = new Swiper('.my-leading', {
    loop: true,
    autoplay: {
        delay: 3400,
        disableOnInteraction: true,
    },
   slidesPerView: 5,
    spaceBetween: 20,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        320: { slidesPerView: 2, spaceBetween: 38 }, // Mobile
        450: { slidesPerView: 3, spaceBetween: 128 }, // Mobile
        768: { slidesPerView: 3, spaceBetween: -14 }, // Tablet
        1024: { slidesPerView: 4, spaceBetween: 40 }, // Desktop
        1200: { slidesPerView: 5, spaceBetween: 30 }, // Desktop
        1400: { slidesPerView: 5, spaceBetween: 20 }, // Desktop
    },
});


</script>