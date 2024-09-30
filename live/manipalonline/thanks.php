<?php
$from_fb		= isset($_REQUEST['from_fb']) ?  true : false;
$redirectURL 	= ($from_fb == true) ? "/manipalonline?from_fb=true" : "/manipalonline/";

define('REDIRECT_URL', $redirectURL);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel= "stylesheet" href= "css/style.css" type= "text/css" media= "all" />
	<title>Thanks</title>
</head>
	<body> 
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
			function changeURL() {
				setTimeout(function(){window.location.href = '<?php echo REDIRECT_URL; ?>'}, 2000);
			}
			changeURL();
		</script>
	</body>
</html>
 