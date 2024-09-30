<!-- meta tags and other links -->
<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ ($pageTitle) ?? "" }}</title>
  <link rel="icon" type="image/x-icon" href="{{ WEBSITE_IMG_URL }}favicon.ico">
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
          <img src="{{ WEBSITE_IMG_URL }}error/error-419.png" alt="@lang('image')">
          <h2><b>@lang('419')</b> @lang('Sorry your session has expired.')</h2>
          <p>@lang('Please go back and refresh your browser and try again')</p>
          <a href="{{ route('home.index') }}" class="cmn-btn mt-4">@lang('Go to Home')</a>
        </div>
      </div>
    </div>
  </div>
  <!-- error-404 end -->


  </body>
</html>
