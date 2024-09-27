<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
echo 'hello';
date_default_timezone_set('Asia/Kolkata');
$from_fb			= 	isset($_REQUEST['from_fb']) ?  true : false;
$source 			= 	isset($_REQUEST['source']) ? $_REQUEST['source'] : "";
$source_campaign 	= 	isset($_REQUEST['source_campaign']) ? $_REQUEST['source_campaign'] : "";
$source_medium 		= 	isset($_REQUEST['source_medium']) ? $_REQUEST['source_medium'] : "";

$redirectURL	=	"/amityonline";
$redirectparams	=	[];
$redirectStr	=	'';

if ($from_fb == true) {
	$redirectparams['from_fb']	=	'true';
}

if ($source != "") {
	$redirectparams['source']	=	$source;
}

if ($source_campaign != "") {
	$redirectparams['source_campaign']	=	$source_campaign;
}

if ($source_medium != "") {
	$redirectparams['source_medium']	=	$source_medium;
}

if(!empty($redirectparams)){
	foreach($redirectparams as $redirectKey => $redirectValue){
		$redirectStr	.= 	$redirectKey.'='.$redirectValue.'&';	
	}
	
	/*REMOVE & ADDED IN LAST */
	$redirectStr	=	rtrim($redirectStr, "&");
}

if($redirectStr !=""){
	$redirectURL	=	$redirectURL.'?'.$redirectStr;
}
define('REDIRECT_URL', $redirectURL);

?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-W8M6DZM');</script>
		<!-- End Google Tag Manager -->
		
		<link rel="icon" href="images/favicon.png" type="image/x-icon">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel= "stylesheet" href= "css/custom.css" type= "text/css" media= "all" />
		<title>Thanks</title>
		 
	</head>
	<body>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W8M6DZM"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->
		 

		<!-- START -->
		<section>
			<div class="col m12 s12">
				<div class="container">

					<div class="col m12 s12 form_box thankBox">
						<div class="col m12 s12 thankImg">
							<img src="images/tick-mark.png">
						</div>
						<div class="col m12 s12 thankHeading">
							<h1>Thank You !</h1>
							<p>Our experts will get back to you shortly.</p>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!-- END -->
		<script>
			// function changeURL() {
			// setTimeout(function(){window.location.href = '<?php echo REDIRECT_URL; ?>'}, 2000);
			// }

			// changeURL();

		</script>
	</body>
</html>