<?php  $youtube_link = CustomHelper::getConfigValue('Social.youtube'); ?>
<section class="quick-tips my-5">
    <div class="container">
        <div class="header d-flex align-items-center justify-content-between txt-center-sm">
            <h2 class="mb-0">Quick Tips & Insights</h2>
            <a href="{{ $youtube_link }}" class="btn btn-red txt-uper sm-ds-none">Watch More on YouTube</a>
        </div>
        <div class="body mt-4">
            <div class="swiper quick-tip">
                <!-- Swiper -->
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail1" src="assets/reels/Multitasking.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video1" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/Balancing-Work.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay1">
                                <button onclick="playVideo(1)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail2" src="./assets/reels/didi-cover.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video2" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/Thousands-students.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay2">
                                <button onclick="playVideo(2)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail3" src="assets/reels/calling.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video3" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/Ready-to-Learn.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay3">
                                <button onclick="playVideo(3)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail4" src="assets/reels/Topuniversities.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video4" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/MBA-Dream.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay4">
                                <button onclick="playVideo(4)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail5" src="assets/reels/Online-Budget.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video5" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/MBA-Flexible.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay5">
                                <button onclick="playVideo(5)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card d-block border-0 p-0">
                            <div class="video-reel">
                                <img id="thumbnail6" src="assets/reels/Reel-pattern.png" alt="Video Thumbnail" class="img-fluid">
                                <video id="video6" width="100%" height="auto" controls style="display:none;">
                                    <source src="./assets/reels/Achieve-more.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="video-reel-overlay" id="overlay6">
                                <button onclick="playVideo(6)">
                                    <img src="./assets/icons/playbtn.svg" alt="Play">
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Add more slides as needed -->
                </div>
                <div class="swiper-button-next custom-next"></div>
                    <div class="swiper-button-prev custom-prev"></div>
            </div>
        </div>
    </div>
</section>


<style>
.quick-tips .card {
    position: relative;
    width: 270px;
    height: 470px;
    border-radius: 10px;
    overflow: hidden; /* Ensure that everything inside stays within the rounded corners */
}

.video-reel {
    position: relative;
    width: 100%;
    height: 100%;
}

.video-reel img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures the thumbnail covers the entire area */
    border-radius: 10px;
}

.video-reel-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1;
    cursor: pointer;
    border-radius: 10px;
}

.video-reel-overlay button {
    background: none;
    border: none;
    cursor: pointer;
    outline: none;
}

.video-reel-overlay button img {
    width: 60px;
    height: 60px;
}

.video-reel video {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    display: none; /* Hidden until play button is clicked */
}

.my-swiper {
    display: flex;
    gap: 20px;
}

@media (max-width: 500px) {
    .card {
        width: 100%;
        height: auto;
        margin-left: 0;
    }

    .header.justify-content-between {
        justify-content: center;
    }
}
</style>

<script>
   
   function playVideo(index) {
    // Pause all videos first
    let videos = document.querySelectorAll('video');
    videos.forEach((video) => {
        video.pause();       
    });

    // Hide all overlays
    let overlays = document.querySelectorAll('.video-reel-overlay');
    overlays.forEach((overlay) => {
        overlay.style.display = "flex"; // Show play button overlay
    });

    // Get the specific video and overlay using the passed index
    let video = document.getElementById('video' + index);
    let overlay = document.getElementById('overlay' + index);
    let thumbnail = document.getElementById('thumbnail' + index);

    // Hide the thumbnail and overlay for the clicked video
    thumbnail.style.display = "none";
    overlay.style.display = "none"; // Hide play button overlay

    // Display the video and start playing
    video.style.display = "block"; // Show video
    video.play();
}


</script>
<script>

    if (document.querySelector('.quick-tip')) {
        let tips = new Swiper('.quick-tip', {
            slidesPerView: 3, // Adjust the slides per view based on screen size
            spaceBetween: 1, // Adjust space between slides
            loop: true,
            // autoplay: {
            //     delay: 6000,
            //     disableOnInteraction: true,
            // },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: { // Adjust number of slides per view at different screen sizes
                320: { slidesPerView: 1, spaceBetween: 0 }, /* For mobile */
                            450: { slidesPerView: 2, spaceBetween: 20 }, /* For mobile */
                            768: { slidesPerView: 3, spaceBetween: 60 }, /* For tablet */
                            1024: { slidesPerView: 4, spaceBetween: 10 } /* For desktop */

            },
            on: {
                init: function () {
                    console.log('Swiper initialized');
                },
                slideChange: function () {
                    console.log('Slide changed');
                },
            },
        });
    }



</script>

