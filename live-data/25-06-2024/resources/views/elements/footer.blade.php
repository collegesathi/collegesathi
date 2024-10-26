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


@if (in_array($currentRoute, [
'survey.getAssist',
'survey.getAssistSteps',
'survey.getAssistFinalStep'
]) == false)
<footer>
    <div class="container">
        <div class="footer_navigation_main accordion" id="accordionExample">
            <div class="footer-navigation_listing">
                <div class="footer_navigation">
                    <h4>{{trans('front_messages.global.home')}}</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                        {{trans('front_messages.global.home')}}
                    </a>
                    <div class="collapse accordion-collapse" id="collapseProducts" data-bs-parent="#accordionExample">
                        <ul>
                            <li><a href="{{ WEBSITE_URL }}">{{trans('front_messages.global.home')}}</a></li>
							<li><a href="{{ route('Career.list') }}">{{ trans('front_messages.global.careers') }}</a></li>
							<li><a href="{{ route('Contact.add') }}">{{ trans('front_messages.global.contact_us') }}</a></li>
							
							<?php /*
                           
                            <li><a href="javascript:void(0);">Degree Courses</a></li>
                            
							*/ ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-navigation_listing">
                <div class="footer_navigation">
                    <h4>collegesathi</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#collapsetechnology_solutions" aria-expanded="false" aria-controls="collapsetechnology_solutions">
                        collegesathi
                    </a>
                    <div class="collapse accordion-collapse" id="collapsetechnology_solutions" data-bs-parent="#accordionExample">
                        <ul>
                            <li><a href="{{ route('Scholarship.form') }}">{{ trans('front_messages.global.scholarships') }}</a></li>
                            <li><a href='{{ route("Referral.form") }}'> {{ trans('front_messages.global.referral') }}</a></li>
							 <li><a href="{{ route('Blog.frontIndex') }}">{{ trans('front_messages.global.blogs') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
			
			<div class="footer-navigation_listing">
                <div class="footer_navigation">
                    <h4>Other Links</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#OtherLinks" aria-expanded="false" aria-controls="OtherLinks">
                        Other Links
                    </a>
                    <div class="collapse accordion-collapse" id="OtherLinks" data-bs-parent="#accordionExample">
                        <ul>
                            <li><a href="{{ route('Page.cmsPages', 'about-us') }}">{{ trans('front_messages.global.about_us') }}</a></li>
							<li><a href="{{ route('Page.cmsPages', 'terms-conditions') }}">{{ trans('front_messages.global.terms_conditions') }}</a></li>
                            <li><a href="{{ route('Page.cmsPages', 'privacy-policy') }}">{{ trans('front_messages.global.privacy_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
			
			
            <div class="footer-navigation_listing">
                <div class="footer_navigation">
                    <h4>Universities</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#collapseCompany" aria-expanded="false" aria-controls="collapseCompany">
                        Universities
                    </a>
                    <div class="collapse accordion-collapse" id="collapseCompany" data-bs-parent="#accordionExample">
                        <ul>
                            <li><a href="{{ route('University.listing') }}">Browse Universities</a></li>
							 <li><a href="{{ route('Faq.frontIndex') }}">{{ trans('front_messages.global.faq') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="navigation_get_in_touch">
                <div class="footer_navigation">
                    <h4>Get in Touch</h4>
                    <a class="btn collapsed accordion_filter" data-bs-toggle="collapse" href="#collapsegetintouch" aria-expanded="false" aria-controls="collapsegetintouch">
                        {{ trans('front_messages.global.get_in_touch') }}
                    </a>
                    <div class="collapse information accordion-collapse" id="collapsegetintouch" data-bs-parent="#accordionExample">
                        <p>{{ trans('front_messages.global.enter_you_email_and_well_send_you_more_information') }}
                        </p>

                        <div class="subscribe_form">
                            {{ Form::open(['role' => 'form', 'class' => 'mws-form', 'id' => 'newsletterForm', 'name' => 'newsletterForm']) }}
                            {!! Form::text('email', '', [
                            'class' => 'form-control news_letter_email',
                            'placeholder' => trans('front_messages.global.enter_email_address'),
                            ]) !!}
                            <div class="news-letter-error-message"></div>
                            <div class="news-letter-succ-message"></div>

                            
							<div class="row">
								<div class="form-group col-sm-6 g-recaptcha-box">
								   <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
								   <span class="error  help-inline g-recaptcha-response_error g-recaptcha-response"   id="g-recaptcha-response_error_div">
									  <?php echo $errors->first('g-recaptcha-response'); ?>
								   </span>
								</div>
							</div>
							
							<?php /*
							<div class="contact-captcha form-group g-recaptcha-box">
                                <p>{{ trans('front_messages.contact.captcha_message') }}</p>
                                <div class="form-line">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
                                </div>
                                </div>
                                <span class="error help-inline newsletter_g-recaptcha-response_error" id="newsletter_g-recaptcha-response_error_div">
                                <?php echo $errors->first('g-recaptcha-response'); ?>
                                </span>
                            </div>
							*/ ?>

                            <button class="btn btn-primary subscribe_btn">{{ trans('front_messages.global.subscribe') }}</button>
                            
                            {{ Form::close() }}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		 
		
        <div class="social_icon">
            <figure>
                <a href="{{ WEBSITE_URL }}">
                    <img src="{{ WEBSITE_IMG_URL }}logo-bottom-01.svg" alt="logo">
                </a>
            </figure>
            <ul class="social_listing">
                @if($facebook_link)
				<li>
                    <a target="_blank" href="{{ $facebook_link }}"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
                </li>
				@endif
				
				@if($youtube_link)
                <li>
                    <a target="_blank" href="{{ $youtube_link }}"> <i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </li>
				@endif
				
				@if($linkedin_link)
                <li>
                    <a target="_blank" href="{{ $linkedin_link }}"> <i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </li>
				@endif
				
				@if($twitter_link)
                <li>
                    <a target="_blank" href="{{ $twitter_link }}"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
                </li>
				@endif
				
				@if($google_plus_link)
                <li>
                    <a target="_blank" href="{{ $google_plus_link }}"> <i class="fa fa-google-plus" aria-hidden="true"></i></a>
                </li>
				@endif
				
				@if($instagram_link)
				<li>
                    <a target="_blank" href="{{ $instagram_link }}"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
				@endif
				
            </ul>
            <h5>{!! $copyright_text !!}</h5>
        </div>
    </div>
</footer>


<div class="menubar-strip">
    <div class="container">
        <ul class="d-flex flex-wrap align-items-center justify-content-between p-0 m-0">
            <li class="active"><a href="{{ route('home.index') }}">
                    <figure><img src="{{ WEBSITE_IMG_URL }}home-icon.svg" alt="Home"></figure> {{ trans('front_messages.global.home') }}
                </a></li>
            <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchpopup">
                    <figure><img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="search"></figure> {{ trans('front_messages.global.search') }}
                </a></li>
            <li><a href="{{ route('survey.getAssist') }}">
                    <figure><img src="{{ WEBSITE_IMG_URL }}survey_icon-01.svg" alt="survay"></figure> {{ trans('front_messages.global.survey') }}
                </a></li>

            @if (Auth::user())

            <li class="profile-menu"><a href="{{ route('User.logout') }}">
                    <figure><i class="fa fa-user-o" aria-hidden="true"></i></figure> {{ trans('front_messages.global.logout') }}
                </a></li>
            @else
            <li class="profile-menu"><a href="{{route('User.login')}}">
                    <figure><i class="fa fa-user-o" aria-hidden="true"></i></figure> {{ trans('front_messages.global.login') }}
                </a></li>

            @endif

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
            <button type="button" class="btn btn-outline-secondary close-toast" data-bs-dismiss="toast" onclick="setCookie('toastMessage', 'yes', 1)">Close</button>
        </div>
    </div>
</div>
--}}


<!-- Modal -->
<div class="modal fade fade-flip search-popup" id="searchpopup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="searchpopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg_gray">
                <div class="search-section-start">
                    <a class="navbar-brand" href="index.html">
                        <figure>
                            <img class="img-fluid" src="{{ WEBSITE_IMG_URL }}logo-01.svg" alt="logo">
                        </figure>
                    </a>
                    <div class="search-bar d-flex align-items-center">
                        <button class="search-icon"><img src="{{ WEBSITE_IMG_URL }}search_icon.png" alt="img"></button>
                        <input type="text" placeholder="Search for Best Universities, Courses & more...">
                    </div>
                    <div class="trending-search-box text-center mt-4">
                        <h3 class="mb-4">Recent Searches...</h3>
                        <ul class="trending-list d-flex flex-wrap align-items-center justify-content-center mb-0 p-0">
                            <li><a href="#">Online MBA</a></li>
                            <li><a href="#">Online Executive MBA</a></li>
                            <li><a href="#">Online MBA Dual</a></li>
                            <li><a href="#">M.Tech</a></li>
                            <li><a href="#">Online MCA</a></li>
                            <li><a href="#">Online M.Com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    grecaptcha.ready(function() {
        grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });

	 
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

    function showCookie(){
        document.write(document.cookie);
    }
	
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    }

    var cookieString = getCookie("toastMessage");
    if(cookieString == "yes"){
        $('#toastMessageBox').hide();
    }

    var newsletterSubscriberURL = '{{ route("NewsletterSubscriber.subscribe") }}';

    $(document).ready(function($) {
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
        }).on('click', '.subscribe_btn', function(e) {
            var captcha = $('#newsletterForm').find('[name="g-recaptcha-response"]').val();
            if(captcha===''){
                $(".newsletter_g-recaptcha-response_error").html('Please fill recaptcha.');
            }
            else{
                $(".newsletter_g-recaptcha-response_error").html('');
                $(".subscribe_btn").removeClass("disabled");
                $(".subscribe_btn").removeAttr("disabled");
            }
        }).on('success.form.fv', function(e) {
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
            beforeSend: function() {
                blockedUI(); 
            },
            success: function(data) {
                grecaptcha.execute(reCAPTCHASiteKey).then(function(token) {
					document.getElementById('g-recaptcha-response').value = token;
				});
                 
				unblockedUI();
                if (typeof(data.errors) != "undefined" && data.errors !== null && data.errors !== '') {
                    
                    $.each(data.errors, function(index, value) {
                        /* $("." + index).html(value); */
                        $(".news-letter-error-message").html(value);
                    });
                }
				else {
                    showSuccessMessageTopRight(data.success);
                    $('.news_letter_email').val("");
                   
                }

            },
        });
    }
</script>

@endif