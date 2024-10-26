<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<title><?php echo Config::get("Site.title"); ?></title>
        <!-- Favicon-->
		<link rel="icon" type="image/x-icon" href="{{WEBSITE_IMG_URL}}favicon.ico">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core Css -->
		<?php /*	{{ HTML::style('plugins/admin/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('plugins/admin/node-waves/waves.css') }}
		{{ HTML::style('plugins/admin/animate-css/animate.css') }}

	      <!-- Jquery Core Js -->
		{{ HTML::script('plugins/admin/jquery/jquery.min.js') }}
		{{ HTML::script('plugins/admin/bootstrap/js/bootstrap.js') }}
      */ ?>

		<link href="{{asset('plugins/admin/bootstrap/css/bootstrap.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('plugins/admin/node-waves/waves.css') }}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('plugins/admin/animate-css/animate.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('css/admin/style.css')}}"  rel="stylesheet" type="text/css" />
		<link href="{{asset('css/admin/developer.css')}}" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="{{asset('plugins/admin/jquery/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('plugins/admin/bootstrap/js/bootstrap.js')}}"></script>


    </head>
 	<script>
			// for close the message
			$(document).ready(function(){

				$("#closemsg").click(function(){
					$(".alert").hide();
				})
			});
		</script>
	</head>
	 <body>
	 	@include('elements.javascript_disabled')

	 	<div class="login-page">

			<div class="login-box">
	            <div class="logo">
	                <a href="javascript:void(0);"><img src="{{ WEBSITE_IMG_URL }}logo-01.svg" alt="{{ Config::get("Site.title") }}"></a>
	                <small></small>
	            </div>


				<div class="card">
					<div class="body login-body">
						@if(Session::has('flash_notice'))

						<div class="alert alert-warning">
							<a href="javascript:void(0);" id="closemsg" class="close pull-right">x</a>
							{{ Session::get('flash_notice') }}
						</div>
						@endif

						@if(Session::has('error'))

						<div class="alert alert-danger">
							<a href="javascript:void(0);" class="close pull-right" id="closemsg" >x</a>
							<strong></strong> 	{{ Session::get('error') }}
						</div>

						@endif

						@if(Session::has('success'))
						<div class="alert alert-success">
							<a href="javascript:void(0);" id="closemsg" class="close pull-right">x</a>
							{{ Session::get('success') }}
						</div>

						@endif
						@yield('content')
					</div>
				</div>

			</div>
		 </div>
		 <script type="text/javascript" src="{{asset('plugins/admin/node-waves/waves.js')}}"></script>
		 <script type="text/javascript" src="{{asset('plugins/admin/jquery-validation/jquery.validate.js')}}"></script>
		 <script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>
	</body>
</html>

