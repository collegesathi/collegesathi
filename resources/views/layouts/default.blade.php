@php
    $currentRoute = Route::currentRouteName();
    $meta_keywords = isset($meta_keywords) ? $meta_keywords : Config::get('Site.meta_keywords');
    $meta_description = isset($meta_description) ? $meta_description : Config::get('Site.meta_description');
    $pageTitle = isset($pageTitle) ? $pageTitle : Config::get('Site.title');
    $ogImage = isset($ogImage) ? $ogImage : '';

    if (Auth::user()) {
        $loginuserid = Auth::user()->id;
        $userDetails = CustomHelper::getLoginUserData($loginuserid);
        $image = isset($userDetails['image']) ? $userDetails['image'] : '';
        $showName = $userDetails['first_name'];
    }
@endphp
<!doctype html>
<html lang="en">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-58QTTBBB');
    </script>
    <!-- End Google Tag Manager -->


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>{{ isset($metaTitle) && !empty($metaTitle) ? $metaTitle : $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ WEBSITE_IMG_URL }}favicon.svg">
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="description" content="{{ $meta_description }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:type" content="website" />
    @if (!empty($ogImage))
        <meta property="og:image" content="{{ $ogImage }}" />
    @endif
    <link rel="canonical" href="{{ url()->current() }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
   
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'bootstrap.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'style.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'owl.carousel.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'owl.theme.default.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'slick.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'responsive.css') }}


    {{ HTML::style(WEBSITE_CSS_URL . 'magnific-popup.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'select2.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'jquery.noty.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'noty_theme_default.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'font-awesome.min.css') }}
    @yield('stylesheet')

    {{ HTML::style(WEBSITE_CSS_URL . 'developer.css') }}
    {{ HTML::style('plugins/admin/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.min.js') }}
    <!-- <script src="https://www.google.com/recaptcha/api.js?render={{env('GOOGLE_RECAPTCHA_KEY')}}"></script>-->
    <meta name="google-site-verification" content="ctjrYS8CcMeQyNfXySZCPvY052PLTpVzFkVJw1QMLmM" />
    
</head>

<body>
    <input id="OTPCode" name="OTPCode" type="hidden" value="" />


    <!-- Overlay For Sidebars -->
    <div class="loading-cntant" id="overlay" style="display: none">
        <div class="loader"></div>
    </div>
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58QTTBBB" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    @php
        if (Session::has('download_prospectus_messages')) {
            Session::flash(SUCCESS, Session::get('download_prospectus_messages'));
            Session::forget('download_prospectus_messages');
            Session::save();
        }
    @endphp

    @include('elements.javascript_disabled')
    @include('elements.js_messages')
    @include('elements.flash_message')

    <!-- Main Content -->
    @include('elements.header')
    @yield('content')
    @include('elements.footer')

    {{ HTML::script(WEBSITE_JS_URL . 'FormValidation/formValidation.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'FormValidation/bootstrap.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'bootstrap.bundle.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'owl.carousel.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'slick.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'custome.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'select2.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'global.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.noty.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.magnific-popup.min.js') }}
    {{ HTML::script('plugins/admin/momentjs/moment.js') }}
    {{ HTML::script('plugins/admin/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'otp_send_verify.js') }}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('javascript')

    <script type="text/javascript">
        var universityCompareRoute = "{{ route('University.addCompareUniversity') }}";

        document.querySelectorAll('#nav-tab>[data-bs-toggle="tab"]').forEach(el => {
            el.addEventListener('shown.bs.tab', () => {
                const target = el.getAttribute('data-bs-target')
                const scrollElem = document.querySelector(`${target} [data-bs-spy="scroll"]`)
                bootstrap.ScrollSpy.getOrCreateInstance(scrollElem).refresh()
            })
        })



        $("#ProgramsListScroll").on('click', 'a', function () {
            $("#ProgramsListScroll .list-group-item.active").removeClass("active");
            $(this).addClass("active");
        });

        $(window).scroll(function () {
            var windscroll = $(window).scrollTop();
            if (windscroll >= 0) {
                $('.scrollspy-example section').each(function (i) {
                    if ($(this).position().top <= windscroll - -100) {
                        $('#ProgramsListScroll li.active').removeClass('active');
                        $('#ProgramsListScroll li').eq(i).addClass('active');
                    }
                });
            } else {
                $('#ProgramsListScroll li.active').removeClass('active');
                $('#ProgramsListScroll li:first').addClass('active');
            }
        }).scroll();

        $(document).ready(function () {
            $('#ProgramsListScroll li a').on('click', function () {
                var page = $(this).attr('href'); // Page cible
                var offset = 85;
                $('html, body').animate({
                    scrollTop: $(page).offset().top - offset
                }); // Go
                return false;
            });
        });
    </script>

    <!--Start of Tawk.to Script-->
    <?php /*
   <script type="text/javascript">
       var Tawk_API = Tawk_API || {},
           Tawk_LoadStart = new Date();
       (function() {
           var s1 = document.createElement("script"),
               s0 = document.getElementsByTagName("script")[0];
           s1.async = true;
           s1.src = 'https://embed.tawk.to/6603c665a0c6737bd1255393/1hpvbtvbg';
           s1.charset = 'UTF-8';
           s1.setAttribute('crossorigin', '*');
           s0.parentNode.insertBefore(s1, s0);
       })();
   </script>
   */ ?>
    <!--End of Tawk.to Script-->

    {{-- Enquire Now Script --}}
    <script>
        var enquire_now_url = "{{ route('EnquireNow.enquireNow') }}";
    </script>
    {{ HTML::style(WEBSITE_CSS_URL . 'intl-tel-input/intlTelInput.css') }}
    {{ HTML::script(WEBSITE_JS_URL . 'intl-tel-input/intlTelInput.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'get_state_city.js') }}
    {{ Html::script(WEBSITE_JS_URL . 'enquire_now.js') }}
    <script>
        var country = "<?php echo COUNTRY; ?>";
        var getStateUrl = "{{ route('getStates.by_country') }}";
        var getCityUrl = "{{ route('getCity.by_state') }}";
        var veryfyotp = "{{ route('University.send-otp') }}";
        var calDateFormat = '{{ JS_DATE_FORMAT }}';
        var mobileTextClassEnquiry = '{{ isset($mobileTextClassEnquiry) ? $mobileTextClassEnquiry : '' }}';
    </script>
    {{ Html::script(WEBSITE_JS_URL . 'enquiry.js') }}
    {{-- Enquire Now Script --}}
</body>

</html>