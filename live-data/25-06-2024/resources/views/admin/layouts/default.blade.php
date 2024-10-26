<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="robots" content="noindex, nofollow">
		<link rel="icon" type="image/x-icon" href="{{WEBSITE_IMG_URL}}favicon.ico">
		<title><?php echo Config::get("Site.title"); ?></title>

		<!-- Favicon-->
		<link rel="icon" href="{{WEBSITE_IMG_URL}}favicon.ico" type="image/x-icon">

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
		<meta name="keywords" content="{{ Config::get('Site.meta_keywords') }}"/>
		<meta name="description" content=" {{ Config::get('Site.meta_description') }}"/>



		<link href="{{asset('plugins/admin/bootstrap/css/bootstrap.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/admin/font-awesome/css/font-awesome.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/admin/node-waves/waves.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/admin/animate-css/animate.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{ asset('plugins/admin/sweetalert/sweetalert.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('plugins/admin/bootstrap-select/css/bootstrap-select.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('css/admin/bootstrap.datepicker.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('plugins/admin/morrisjs/morris.css')}}"   rel="stylesheet" type="text/css" />
		<link href="{{asset('css/admin/style.css')}}"  rel="stylesheet" type="text/css" />
		<link href="{{asset('css/admin/themes/all-themes.css')}}"  rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/admin/developer.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/admin/lightbox.css')}}" rel="stylesheet" type="text/css" />

		<script>
			var WEBSITE_URL						=	"<?php echo WEBSITE_URL ?>";
			var WEBSITE_ADMIN_URL				=	"<?php echo WEBSITE_ADMIN_URL ?>";
			var csrf_token						= 	'{{csrf_token()}}';
			var PLEASE_ENTER_VALID_MOBILE_NO 	= 	'{{ trans("messages.global.PLEASE_ENTER_VALID_MOBILE_NO") }}';
			var IMAGE_UPLOAD_FILE_MAX_SIZE	 	= 	'{{IMAGE_UPLOAD_FILE_MAX_SIZE}}';
			var DATE_FORMAT 					= 	'{{ DATE_FORMAT }}';
            var IMAGE_UPLOAD_FILE_MAX_SIZE_TWO  = '{{IMAGE_UPLOAD_FILE_MAX_SIZE_TWO}}';
		</script>





		<!-- Jquery Core Js -->
		<!-- Jquery Core Js -->

		<script type="text/javascript" src="{{asset('plugins/admin/jquery/jquery.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('plugins/admin/bootstrap/js/bootstrap.js')}}"></script>
		<script type="text/javascript" src="{!! asset('plugins/admin/sweetalert/sweetalert.min.js') !!}"></script>
		<script type="text/javascript" src="{{asset('js/admin/pages/ui/dialogs.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/custom.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/bootbox.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/lightbox.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/global.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/admin/bootstrap.datepicker.js')}}"></script>

	</head>
<body class="theme-orange ls-closed">

	@include('elements.javascript_disabled')

	 <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
	  <!-- Overlay For Sidebars -->
	<div class="loading-cntant" id="overlay">
		<div class="loader"></div>
	</div>
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->


    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

	<!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars" ></a>
                <a class="navbar-brand" href="{{route('AdminDashBoard.index')}}">
					{{ Config::get("Site.title") }}
				</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
					<li class="pull-right">
						<a href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="js-right-sidebar color-fff"><i class="material-icons">more_vert</i></a>
						<ul class="dropdown-menu pull-right">
							<li><a href="{{route('Admin.account')}}"><i class="material-icons">person</i>{{ trans("messages.User.profile")}}</a></li>
							<li role="seperator" class="divider"></li>
							<li><a href="{{route('logout')}}"><i class="material-icons">input</i>{{ trans("messages.User.Signout")}}</a></li>
						</ul>
					</li>
				</ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->


   <section>
	  <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
		  <!-- User Info -->
            <div class="user-info">
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->full_name}}</div>
                    <div class="email">{{ Auth::user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
							<li><a href="{{route('Admin.account')}}"><i class="material-icons">person</i>{{ trans("messages.User.profile")}}</a></li>
							<li role="seperator" class="divider"></li>
                            <li><a href="{{route('logout')}}"><i class="material-icons">input</i>{{ trans("messages.User.Signout")}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->

			<div class="menu">
				<?php $segment2	=	Request::segment(2); ?>
				<?php $segment3	=	Request::segment(3); ?>
				<?php $segment4	=	Request::segment(4); ?>
				<!-- Sidebar Wrapper -->
				<ul class="list">
					{!! AdminMenuHelper::getAdminSidebar() !!}
				</ul>
			</div>

			      <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                   <?php echo Config::get("Site.copyright_text"); ?>
                </div>
            </div>
            <!-- #Footer -->
		</aside>
	</section>
	<!-- Main Container Start -->

	<!-- Main Container Start -->
	<section class="content">
		<div class="container-fluid">
			<div class="flash-msg">
				@if(Session::has('error'))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ Session::get('error') }}
				</div>
				@endif
				@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ Session::get('success') }}
				</div>
				@endif
				@if(Session::has('flash_notice'))
				<div class="alert alert-warning alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ Session::get('flash_notice') }}
				</div>
				{{Session::forget('apartment_added')}}
				@endif
			</div>

			<?php  /* if(isset($breadcrumbs)){   echo $breadcrumbs;   } */ ?>

			@yield('breadcrumbs')

			@yield('content')
		</div>
	</section>

	<script type="text/javascript">
		/* For set the time for flash messages */
		$(document).ready(function(){
			window.setTimeout(function () {
				$(".mws-form-message.success").hide('slow');
				$(".mws-form-message.error").hide('slow');
			}, 6000);
		});
	</script>

	<script type="text/javascript" src="{{asset('plugins/admin/node-waves/waves.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/admin/jquery-validation/jquery.validate.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/admin/bootstrap-select/js/bootstrap-select.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/admin/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
	<script type="text/javascript" src="{{asset('plugins/admin/jquery-countto/jquery.countTo.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/admin/admin.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/admin/demo.js')}}"></script>

	</body>
</html>
