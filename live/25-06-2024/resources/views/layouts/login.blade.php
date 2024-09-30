@php
    $currentRoute = Route::currentRouteName();
    $meta_keywords = isset($meta_keywords) ? $meta_keywords : Config::get('Site.meta_keywords');
    $meta_description = isset($meta_description) ? $meta_description : Config::get('Site.meta_description');
    $pageTitle = isset($pageTitle) ? $pageTitle : Config::get('Site.title');
    $ogImage = isset($ogImage) ? $ogImage : '';
@endphp
@php
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{ WEBSITE_IMG_URL }}favicon.ico">
    <meta name="keywords" content="{{ $meta_keywords }}" />
    <meta name="description" content="{{ $meta_description }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta property="og:type" content="website" />
    @if (!empty($ogImage))
        <meta property="og:image" content="{{ $ogImage }}" />
    @endif
    {{ HTML::style(WEBSITE_CSS_URL . 'bootstrap.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'style.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'select2.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'jquery.noty.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'noty_theme_default.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'owl.carousel.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'owl.theme.default.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'responsive.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'developer.css') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.min.js') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>  
<body>
      <!-- Overlay For Sidebars -->
      <div class="loading-cntant" id="overlay" style="display: none">
        <div class="loader"></div>
    </div>
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    
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
    {{ HTML::script(WEBSITE_JS_URL . 'custome.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'select2.min.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'global.js') }}
    {{ HTML::script(WEBSITE_JS_URL . 'jquery.noty.js') }}
    
    @yield('javascript')
</body>
</html>