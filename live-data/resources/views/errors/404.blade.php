<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ ($pageTitle) ?? "" }}</title>
  <link rel="icon" type="image/x-icon" href="{{ WEBSITE_IMG_URL }}favicon.svg">
  <!-- bootstrap 4  -->
  {{ HTML::style(WEBSITE_CSS_URL . 'bootstrap.min.css') }}
  <!-- dashdoard main css -->
  {{ HTML::style(WEBSITE_CSS_URL . 'errors/main.css') }}
  </head>
  <body>


  <!-- error-404 start -->
  <div class="error">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7 text-center">
          <img src="{{ WEBSITE_IMG_URL }}error/error-404.png" alt="@lang('image')">
          <h2><b>@lang('404')</b> @lang('Page not found')</h2>
          <p>@lang('page you are looking for doesn\'t exit or an other error ocurred') <br> @lang('or temporarily unavailable.')</p>
          <a href="{{ route('home.index') }}" class="cmn-btn mt-4">@lang('Go to Home')</a>
        </div>
      </div>
    </div>
  </div>
  <!-- error-404 end -->


  </body>
</html>
