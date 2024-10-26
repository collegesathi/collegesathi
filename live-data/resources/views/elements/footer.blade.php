@php
    $currentRoute = Route::currentRouteName();
    $facebook_link = CustomHelper::getConfigValue('Social.facebook');
    $twitter_link = CustomHelper::getConfigValue('Social.twitter');
    $linkedin_link = CustomHelper::getConfigValue('Social.linkedin');
    $youtube_link = CustomHelper::getConfigValue('Social.youtube');
    $google_plus_link = CustomHelper::getConfigValue('Social.google_plus');
    $instagram_link = CustomHelper::getConfigValue('Social.instagram');
    $copyright_text = CustomHelper::getConfigValue('Site.copyright_text');
@endphp


@if (
        in_array($currentRoute, [
            'survey.getAssist',
            'survey.getAssistSteps',
            'survey.getAssistFinalStep'
        ]) == false
    )

    <footer class="footer pt-5 pb-4">
        <div class="container">
            <!-- Top Stuff -->
            <div class="top-stuff">
                <div class="row">
                    <div class="col-md-6">
                        <div class="w-50">
                            <img src="/assets/lightlogo.png" alt="logo">
                            <p class="mt-3">Connect with Collegesathi and start your journey</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="socials d-flex align-items-center justify-content-end">
                            <a href="{{ $twitter_link }}" class="social-btn">
                                <img src="/assets/socials/x.svg" alt="">
                            </a>
                            <a href="{{ $youtube_link }}" class="social-btn mx-2">
                                <img src="/assets/socials/utube.svg" alt="">
                            </a>
                            <a href="{{ $facebook_link }}" class="social-btn">
                                <img src="/assets/socials/fb.svg" alt="">
                            </a>
                            <a href="{{ $instagram_link }}" class="social-btn ms-2">
                                <img src="/assets/socials/in.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Stuff / -->
            <!-- Center Stuff -->
            <div class="center-stuff">
                <!-- Row -->
                <div class="row">
                    <!-- Col -->
                    <div class="col-xl-4">
                        <div class="ratings d-flex align-items-center justify-content-between px-4">
                            <p class="text-muted mb-0">4.2 Rating</p>
                            <img src="/assets/icons/greenstr.svg" alt="icon">
                        </div>
                        <!-- <div class="follows my-3 px-2 py-1 pb-2 text-center">
                            <img src="/assets/icons/follows.svg" alt="icon">
                        </div> -->
                    </div>
                    <!-- Col / -->

                    <div class="col-xl-8">
                        <div class="row">
                            <!-- Col -->
                            <div class="col-md-6">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="heading">
                                            <h6 class="mb-3">Home</h6>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('Career.list') }}" class="nav-link ps-0 pt-0">Careers</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Contact.add') }}" class="nav-link ps-0 pt-0">Contact Us</a>
                                            </li>                                          
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <div class="heading">
                                            <h6 class="mb-3">Collegesathi</h6>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('Scholarship.form') }}" class="nav-link ps-0 pt-0">Scholarships</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route("Referral.form") }}" class="nav-link ps-0 pt-0">Referral</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Blog.frontIndex') }}" class="nav-link ps-0 pt-0">Blogs</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <!-- Row / -->
                            </div>
                            <!-- Col / -->

                            <!-- Col -->
                            <div class="col-md-6">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="heading">
                                            <h6 class="mb-3">Universities</h6>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('University.listing') }}" class="nav-link ps-0 pt-0">Browse Universities</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('survey.getAssist') }}" class="nav-link ps-0 pt-0">Experts</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Faq.frontIndex') }}" class="nav-link ps-0 pt-0">FAQ</a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <div class="heading">
                                            <h6 class="mb-3">Other Links</h6>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="{{ route('Page.cmsPages', 'about-us') }}" class="nav-link ps-0 pt-0">About Us</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Page.cmsPages', 'terms-conditions') }}" class="nav-link ps-0 pt-0">Terms & Conditions</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('Page.cmsPages', 'privacy-policy') }}" class="nav-link ps-0 pt-0">Privacy Policy</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <!-- Row / -->
                            </div>
                            <!-- Col / -->
                        </div>
                    </div>

                </div>
                <!-- Row / -->
            </div>
            <!-- Center Stuff / -->

            <!-- Bottom Stuff -->
            <div class="bottom-stuff mt-3">
                <ul class="nav flex-row justify-content-between">
                    <li class="nav-item">
                        <a href="{{ route('Page.cmsPages', 'about-us') }}" class="nav-link ps-0 py-0 pe-0">About us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Blog.frontIndex') }}" class="nav-link ps-0 py-0 pe-0">Blog</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link ps-0 py-0 pe-0">For Corporates</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="#" class="nav-link ps-0 py-0 pe-0">Sitemap</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Contact.add') }}" class="nav-link ps-0 py-0 pe-0">Contact us</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center ps-0 py-0 pe-0">
                            <img src="/assets/icons/tick.svg" alt="icon">
                            <span class="ms-2">CV Checklist</span>
                        </a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center ps-0 py-0 pe-0">
                            <img src="/assets/icons/exprt.svg" alt="icon">
                            <span class="ms-1">Our Trust</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ route('Career.list') }}" class="nav-link d-flex align-items-center ps-0 py-0 pe-0">
                            <span>CS Careers </span>
                            <span class="ms-2 badge badge-success">We are Hiring</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link d-flex align-items-center ps-0 py-0 pe-0">
                            <span>Ask any Question - CV Panel </span>
                            <span class="ms-2 badge badge-success">New</span>
                        </a>
                    </li> -->
                </ul>
            </div>
            <!-- Bottom Stuff / -->

            <!-- Other Courses Links -->
           <!-- Course Specifications List -->
@php
    $courses = CustomHelper::getCoursesListWithUniversities(); // Fetching the courses list with universities
@endphp

<div class="footer_navigation_main footer_mega_menu accordion" id="accordionExample">
    @if ($courses->isNotEmpty())
        @foreach ($courses as $coursesList)
            <div class="footer-navigation_listing">
                <div class="footer_navigation">
                    <h4>{{ $coursesList->name }}</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#collapse{{ $coursesList->slug }}"
                        aria-expanded="false" aria-controls="collapse{{ $coursesList->name }}">
                        {{ $coursesList->name }}
                    </a>
                    <div class="collapse accordion-collapse" id="collapse{{ $coursesList->slug }}" data-bs-parent="#accordionExample">
                        @if ($coursesList->universityCourses->isNotEmpty())
                        <ul class="university-list" id="universityList{{ $coursesList->slug }}">
                            @foreach ($coursesList->universityCourses->take(5) as $universities)
                            <?php 
                            if($universities->university->title=='Lovely Professional University(LPU)'){
                                $universities->university->title= 'Lovely Professional University';
                            }
                            
                            ?>
                                <li><a href="{{ route('University.frontIndex',$universities->university->slug) }}">{{ $universities->university->title }}</a></li>
                            @endforeach
                            @if ($coursesList->universityCourses->count() > 5)
                                <li class="view-all-btn" id="viewAllBtn{{ $coursesList->slug }}">
                                    <a href="javascript:void(0)" onclick="showAllUniversities('{{ $coursesList->slug }}')">View All</a>
                                </li>
                            @endif
                        </ul>
                        <!-- Hidden full list -->
                        <ul class="university-list d-none" id="fullUniversityList{{ $coursesList->slug }}">
                            @foreach ($coursesList->universityCourses as $universities)
                                <li><a href="{{ route('University.frontIndex',$universities->university->slug) }}">{{ $universities->university->title }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
<!-- Course Specifications List -->
            <!-- Other Courses Links / -->

            <!-- Very Bottom -->
            <div class="v-bottom my-4">
                <ul class="nav flex-row text-center justify-content-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link px-0 me-2">Disclaimer</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Page.cmsPages', 'terms-conditions') }}" class="nav-link px-0 me-2">/ Terms & Conditions</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link px-0 me-2">/ Refund Policy</a>
                    </li> -->
                    <li class="nav-item">
                        <a href="{{ route('Page.cmsPages', 'privacy-policy') }}" class="nav-link px-0 me-2">/ Our Policy</a>
                    </li>
                </ul>
                <div class="long-txt text-center">
                    <small>College Sathi aims to provide unbiased and precise information, along with comparative
                        guidance on universities and their programs, to admission aspirants. The content on the College
                        Sathi website—encompassing texts, graphics, images, blogs, videos, and university logos—is
                        intended solely for informational purposes and should not be viewed as a substitute for
                        offerings from academic partners. While we strive for accuracy and present information in good
                        faith, College Sathi makes no warranties regarding the completeness or reliability of the
                        content and will not be liable for any errors, omissions, or resulting damages from its
                        use.</small>
                </div>
                <p class="text-center copyright mt-3 mb-0">© Collegesathi 2024. All Right Reserved.</p>
            </div>
            <!-- Very Bottom / -->

        </div>
    </footer>


<style>
footer.footer {
    min-height: 781px;
}

footer .social-btn {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 40px;
}

footer .ratings {
    width: 362px;
    min-height: 60px;
    border-radius: 6px;
    background: #FFFF;
}

footer .ratings p {
    font-weight: 600 !important;
    font-size: 22px !important;
}


footer .follows {
    width: 227px;
    min-height: 70px;
    border-radius: 6px;
    background: #FFFF;
}

footer .bottom-stuff .nav-link {
    color: #B5B7BC !important;

}

footer .badge-success {
    font-weight: 200 !important;
    font-size: 12px;
    background: #16B1A2;
}

footer .bottom-stuff {
    padding-bottom: 12px;
    border-bottom: 1px solid #B5B7BC;
}

.v-bottom ul .nav-link {
    font-size: 12px !important;
    color: #B5B7BC !important;
}

footer .long-txt small {
    color: #B5B7BC !important;
}

footer p.copyright {
    font-size: 14px !important;
    color: #B5B7BC !important;
}

@media(max-width: 500px) {

    .top-stuff .justify-content-end {
        justify-content: center !important;
    }

    .top-stuff .w-50 {
        text-align: center;
        width: 100% !important;
        margin-bottom: 1rem;
    }

    .top-stuff {
        margin-bottom: 1rem
    }

    footer .justify-content-between {
        justify-content: center !important;
    }


    footer .justify-content-between .nav-link {
        margin-right: 10px;
    }


}
</style>


    <div class="menubar-strip">
        <div class="container">
            <ul class="d-flex flex-wrap align-items-center justify-content-between p-0 m-0">
                <li class="active"><a href="{{ route('home.index') }}">
                        <figure><img src="{{ WEBSITE_IMG_URL }}home-icon.svg" alt="Home"></figure>
                        {{ trans('front_messages.global.home') }}
                    </a>
                <!-- </li>
                         <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchpopup">
                        <figure><img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="search"></figure> {{ trans('front_messages.global.search') }}
                    </a></li>  -->
                <li>                  
                    <a href="tel:+919785800008" class="phone-number">
                    <figure><img src="{{ WEBSITE_IMG_URL }}call-us.svg" alt="survay"></figure>call us
                    </a>
                </li>
                <li>                  
                    <a href="https://wa.me/+919785800008?text=Hello%20there!" class="whatsapp-button" target="_blank">
                    <figure><img src="{{ WEBSITE_IMG_URL }}whtsapp-logo.svg" alt="survay"></figure>chat with us
                    </a>
                </li>
                <li><a href="{{ route('survey.getAssist') }}">
                        <figure><img src="{{ WEBSITE_IMG_URL }}survey_icon-01.svg" alt="survay"></figure>
                        Expert Advice
                    </a></li>

                <!-- @if (Auth::user())

                <li class="profile-menu"><a href="{{ route('User.logout') }}">
                        <figure><i class="fa fa-user-o" aria-hidden="true"></i></figure> {{ trans('front_messages.global.logout') }}
                    </a></li>
                @else
                <li class="profile-menu"><a href="{{route('User.login')}}">
                        <figure><i class="fa fa-user-o" aria-hidden="true"></i></figure> {{ trans('front_messages.global.login') }}
                    </a></li>

                @endif -->

            </ul>
        </div>
    </div>

    {{--
    <div class="toast toast_message" role="alert" aria-live="assertive" aria-atomic="true" id="toastMessageBox">
        <div class="toast-body">
            <figure>
                <img src="{{ WEBSITE_IMG_URL }}online-manipal_img.png" alt="">
            </figure>
            <div class="border-top toast_btn">
                <a type="button" class="btn btn-primary btn-sm">View Program</a>
                <button type="button" class="btn btn-outline-secondary close-toast" data-bs-dismiss="toast"
                    onclick="setCookie('toastMessage', 'yes', 1)">Close</button>
            </div>
        </div>
    </div>
    --}}


    <!-- Modal -->
    <div class="modal fade fade-flip search-popup" id="searchpopup" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="searchpopupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg_gray">
                    <form action="{{ route('University.listing') }}">
                        <div class="search-section-start">
                            <a class="navbar-brand" href="{{ route('home.index') }}">
                                <figure>
                                    <img class="img-fluid" src="{{ WEBSITE_IMG_URL }}Collegesaathilogo.svg" alt="logo">
                                </figure>
                            </a>
                            <div class="search-bar d-flex align-items-center">

                                <button class="search-icon"><img src="{{ WEBSITE_IMG_URL }}search_icon.png"
                                        alt="img"></button>
                                <input type="text" name="search"
                                    placeholder="Search for Best Universities, Courses & more..."
                                    value="{{ isset($queryString['search']) && !empty($queryString['search']) ? $queryString['search'] : '' }}">

                            </div>
                            <div class="trending-search-box text-center mt-4">
                                <h3 class="mb-4">&nbsp;</h3>
                                <?php    /*
                               <ul class="trending-list d-flex flex-wrap align-items-center justify-content-center mb-0 p-0">
                                   <li><a href="#">Online MBA</a></li>
                                   <li><a href="#">Online Executive MBA</a></li>
                                   <li><a href="#">Online MBA Dual</a></li>
                                   <li><a href="#">M.Tech</a></li>
                                   <li><a href="#">Online MCA</a></li>
                                   <li><a href="#">Online M.Com</a></li>
                               </ul>
                               */ ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
 /* .view-all-btn {
    text-align: center;
    margin-top: 10px;
} */

.view-all-btn a {
    font-weight: bold;
    color: #007bff;
    text-decoration: underline;
    cursor: pointer;
}

.view-all-btn a:hover {
    color: #0056b3;
}

/* To ensure proper alignment within different containers */

    
    .d-none {
        display: none;
    }
</style>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            grecaptcha.execute(reCAPTCHASiteKey).then(function (token) {
                document.getElementById('g-recaptcha-response').value = token;
            });
        });


        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        function showCookie() {
            document.write(document.cookie);
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }

        var cookieString = getCookie("toastMessage");
        if (cookieString == "yes") {
            $('#toastMessageBox').hide();
        }

        var newsletterSubscriberURL = '{{ route("NewsletterSubscriber.subscribe") }}';

        $(document).ready(function ($) {
            $('#newsletterForm').formValidation({
                message: 'This value is not valid',
                fields: {
                    'email': {
                        row: '.form-group',
                        err: '.news-letter-error-message',
                        validators: {
                            notEmpty: {
                                message: ERROR_ENTER_EMAIL_ADDRESS
                            },
                            emailAddress: {
                                message: ERROR_ENTER_VALID_EMAIL_ADDRESS
                            }
                        }
                    },
                }
            }).on('click', '.subscribe_btn', function (e) {
                var captcha = $('#newsletterForm').find('[name="g-recaptcha-response"]').val();
                if (captcha === '') {
                    $(".newsletter_g-recaptcha-response_error").html('Please fill recaptcha.');
                } else {
                    $(".newsletter_g-recaptcha-response_error").html('');
                    $(".subscribe_btn").removeClass("disabled");
                    $(".subscribe_btn").removeAttr("disabled");
                }
            }).on('success.form.fv', function (e) {
                e.preventDefault();
                subscribeEmailAddress();
            });
        });

        function subscribeEmailAddress() {
            var form = $('#newsletterForm')[0];
            var formData = new FormData(form);
            var email = $('.news_letter_email').val();
            var recaptchaToken = $('#recaptcha-token').val();


            $(".news-letter-error-message").html('');
            $(".news-letter-succ-message").html('');
            $(".newsletter_g-recaptcha-response_error").html('');
            $.ajax({
                type: 'POST',
                url: newsletterSubscriberURL,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                processData: false,
                contentType: false,
                dataType: 'JSON',
                beforeSend: function () {
                    blockedUI();
                },
                success: function (data) {
                    grecaptcha.execute(reCAPTCHASiteKey).then(function (token) {
                        document.getElementById('g-recaptcha-response').value = token;
                    });

                    unblockedUI();
                    if (typeof (data.errors) != "undefined" && data.errors !== null && data.errors !== '') {

                        $.each(data.errors, function (index, value) {
                            /* $("." + index).html(value); */
                            $(".news-letter-error-message").html(value);
                        });
                    } else {
                        showSuccessMessageTopRight(data.success);
                        $('.news_letter_email').val("");

                    }

                },
            });
        }
    </script>
<script>
    function showAllUniversities(slug) {
        console.log('----->',slug);
        // Hide the "View All" button and truncated list
        document.getElementById('universityList' + slug).classList.add('d-none');
        document.getElementById('viewAllBtn' + slug).classList.add('d-none');
        
        // Show the full university list
        document.getElementById('fullUniversityList' + slug).classList.remove('d-none');
    }
</script>

@endif