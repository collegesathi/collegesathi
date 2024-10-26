<?php
session_start();
$from_fb		= isset($_REQUEST['from_fb']) ?  true : false;
$redirectURL 	= ($from_fb == true) ? "/amityonline/?from_fb=true" : "/amityonline/";
$mailtoID 		= ($from_fb == true) ? "fb.collegesathi@gmail.com" : "cs.pgdm@gmail.com";

define('REDIRECT_URL', $redirectURL);

if(isset($_POST) && !empty($_POST)){
    
	include 'constant.php';
	
	$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
	ob_start();
	
	extract($_POST);

	require_once 'PHPMailerAutoload.php';

	date_default_timezone_set('Asia/Calcutta');
	$name_error      = "";
	$email_error     = "";
	$contactno_error = "";
 
	$leadtype        = $from_fb ? "YES" : "NO";
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contactno = $_POST['contactno'];
	$pageurl         = "Amity-Online-MBA";
	$qualification = NULL;
	$specialization = NULL;
	$university_name = isset($_POST['university_name']) ? $_POST['university_name'] : "";
	$city = $_POST['city'];
	$download_brochure = $_POST['download_broch'];
	$ipaddress       = trim($_SERVER['REMOTE_ADDR']);
 
	$reg             = '/^[A-Za-z ]+$/';
	$reg_two         = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
	$reg_three       = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
	$check = true;

	if ($name != "" && $email != "" && $contactno != "" && strlen($contactno) >= 10 && $city != "" && $conn== TRUE){

		if(empty($name)){
			$name_error = "Name is required";
			$check = false;       
		}
		elseif(!preg_match($reg,$name)){
			$name_error = "Only Character Are Allowed";
			$check = false;        
		}
		if(empty($email)){
			$email_error = "E-mail is required";
			$check = false;       
		}
		elseif(!preg_match($reg_two,$email)){
			$email_error = "Invalid E-mail";
			$check = false;        
		}
		if(empty($contactno)){
			$contactno_error = "Number is required";
			$check = false;       
		}
		elseif(!preg_match($reg_three,$contactno)){
			$contactno_error = "Invalid Number";
			$check = false;        
		}
		else{
			$sql= "INSERT INTO `leads` (`type`,`name`, `email`, `contactno`, `program`,`leadtype`, `admission`,`qualification`,`specialization`,`university`,`city`,`ipaddress`)VALUES ('$pageurl','$name', '$email', '$contactno', '','$leadtype', '','$qualification','$specialization','$university_name','$city','$ipaddress')";
			$result = mysqli_query($conn,$sql);
			mysqli_close($conn);
		}

		if($from_fb == true){
			$subject = "Amity Online MBA Social Media Lead";
		}else{
			$subject = "Amity Online MBA Lead";
		}
	    
		$message = "Following Enquiry received<br/>";
		$message .= "Name : " . $name . "<br/>";
		$message .= "Email : " . $email . "<br/>";
		$message .= "Mobile : " . $contactno . "<br/>";
		$message .= "City : " . $city . "<br/>";
		$message .= "Source : Amity Online  <br/>";
		
		try {
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->Host = SMTP_HOST;
			$mail->SMTPAuth = SMTP_AUTH;
			$mail->Username = SMTP_USERNAME;
			$mail->Password = SMTP_PASSWORD;
			$mail->SMTPSecure = SMTP_SECURE;
			$mail->Port = SMTP_PORT;
			$mail->SMTPAutoTLS 	= 	SMTP_AUTO_TLS;
			$mail->setFrom(SMTP_MAIL_FROM);
			$mail->addAddress(SMTP_MAIL_TO);
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			$mail->SMTPDebug = false;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if (!$mail->send()) {
				$result	=	[];
				$result['status'] = false;
				$result['message'] = 'Something is wrong,Please try again.';
				echo json_encode($result,true);
				exit;
			} 
			else {
				$result	=	[];
				if($download_brochure == "yes"){
				   $result['url'] = $university_name; 
				}
				$result['status'] = true;
				$result['message'] = 'Request has been send successfully.';
				echo json_encode($result,true);
				exit;
			} 
		} 
		catch (phpmailerException $e) {
			echo $e->errorMessage(); 
		} 
		catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	} 
	else {
       // header('Location:' . $_SERVER['HTTP_REFERER']);
        $result['success'] = false;
        $result['message'] = 'Something is wrong,Please try again.';
        echo json_encode($result,true);
    	exit;
    }
} 
else{
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
			function changeURL() {
			setTimeout(function(){window.location.href = '<?php echo REDIRECT_URL; ?>'}, 2000);
			}

			changeURL();

		</script>
	</body>
</html>
<?php } ?>