<?php
$from_fb 			= 	isset($_REQUEST['from_fb']) ? true : false;
$source 			= 	isset($_REQUEST['source']) ? $_REQUEST['source'] : "";
$source_campaign 	= 	isset($_REQUEST['source_campaign']) ? $_REQUEST['source_campaign'] : "";
$source_medium 		= 	isset($_REQUEST['source_medium']) ? $_REQUEST['source_medium'] : "";

$mailtoID   	=  "cs.pgdm@gmail.com";
$redirectURL	=	"/online-all-mba-colleges-india";
$redirectparams	=	[];
$redirectStr	=	'';

if ($from_fb == true) {
	$mailtoID 					= 	"fb.collegesathi@gmail.com";
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

if (isset($_POST) && !empty($_POST)) {
    $conn = new mysqli('localhost', 'collegesathi_live', '5SE9fLzA1!V%', 'collegesathi_live');
    ob_start();
    include 'constant.php';

    extract($_POST);

    require_once 'PHPMailerAutoload.php';

    date_default_timezone_set('Asia/Calcutta');
    $name_error = "";
    $email_error = "";
    $contactno_error = "";
    $university_name_error = "";

    $pageurl = "online-all-mba-colleges-india";
    $leadtype = $from_fb ? "YES" : "NO";

 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['fotemail'];
    $contactno = $_POST['fotmobile'];
    $ipaddress = trim($_SERVER['REMOTE_ADDR']);

    $mx_Website_Page = isset($_POST['mx_Website_Page']) ? $_POST['mx_Website_Page'] : "";
    $university_name = isset($_POST['mx_University_Name']) ? $_POST['mx_University_Name'] : "";

    $reg = '/^[A-Za-z ]+$/';
    $reg_two = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    $reg_three = '/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/';
    $check = true;

    if ($fname != "" && $lname != "" && $email != "" && $contactno != "" && strlen($contactno) >= 10 && $university_name != "") {

        if (empty($fname)) {
            $fname_error = "First Name is required";
            $check = false;
        } elseif (!preg_match($reg, $name)) {
            $fname_error = "Only Character Are Allowed";
            $check = false;
        }
        if (empty($lname)) {
            $lname_error = "Last Name is required";
            $check = false;
        } elseif (!preg_match($reg, $name)) {
            $lname_error = "Only Character Are Allowed";
            $check = false;
        }
        if (empty($email)) {
            $email_error = "E-mail is required";
            $check = false;
        } elseif (!preg_match($reg_two, $email)) {
            $email_error = "Invalid E-mail";
            $check = false;
        }
        if (empty($university_name)) {
            $university_name_error = "University name is required";
            $check = false;
        }

        if (empty($contactno)) {
            $contactno_error = "Number is required";
            $check = false;
        } elseif (!preg_match($reg_three, $contactno)) {
            $contactno_error = "Invalid Number";
            $check = false;
        } else {

            /* $sql= "INSERT INTO `leads` (`type`,`name`, `email`, `contactno`, `program`,`leadtype`, `admission`,`qualification`,`specialization`,`university`,`city`,`ipaddress`,`source`,`source_campaign`,`source_medium`,`mx_Website_Page`)VALUES ('$pageurl','$name', '$email', '$contactno', '','$leadtype', '','$qualification','$specialization','$university_name','$city','$ipaddress','$source','$source_campaign','$source_medium','$mx_Website_Page')";
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn); */
        }

        if ($from_fb == true) {
            $subject = "Online All Mba Colleges India Social Media Lead";
        } else {
            $subject = "Online All Mba Colleges India Lead";
        }

        $message = "Following Enquiry received from free counselling.<br/>";
        $message .= "Full Name : " . $fname . ' ' . $lname . "<br/>";
        $message .= "Email : " . $email . "<br/>";
        $message .= "Mobile : " . $contactno . "<br/>";
        if ($university_name != "") {
            $message .= "University Name : " . $university_name . "<br/>";
        }
        if ($source != "") {
            $message .= "Source : " . $source . "<br/>";
        }
        if ($source_campaign != "") {
            $message .= "Source Campaign : " . $source_campaign . "<br/>";
        }
        if ($source_medium != "") {
            $message .= "Source Medium : " . $source_medium . "<br/>";
        }


        $secretKey = SECRET_KEY;
        $accessKey = ACCESS_KEY;
        $apiURL = API_URL . 'Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;

        $request = array(
            array("Attribute" => 'FirstName', "Value" => $fname),
            array("Attribute" => 'LastName', "Value" => $lname),
            array("Attribute" => 'EmailAddress', "Value" => $email),
            array("Attribute" => 'Phone', "Value" => $contactno),
            array("Attribute" => 'mx_Specialization', "Value" => ""),
            array("Attribute" => 'mx_Course_Applying_For', "Value" => ""),
            array("Attribute" => 'mx_City_1', "Value" => ""),
            array("Attribute" => 'from_fb', "Value" => $leadtype),
            array("Attribute" => 'Source', "Value" => $source),
            array("Attribute" => 'SourceCampaign', "Value" => $source_campaign),
            array("Attribute" => 'SourceMedium', "Value" => $source_medium),
            array("Attribute" => 'mx_University_Name', "Value" => $university_name),
            array("Attribute" => 'mx_Website_Page', "Value" => $mx_Website_Page),
            array("Attribute" => 'SearchBy', "Value" => 'Phone'),
        );

        $request = json_encode($request, true);
        echo ($request);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $apiURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "accept: application/json",
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $jsonResult = json_decode($response, true);

     
        /* if ($jsonResult['Status'] == "Success") { */

            try {

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = SMTP_AUTH;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->Port = SMTP_PORT;
                $mail->SMTPAutoTLS = SMTP_AUTO_TLS;

                $mail->setFrom(SMTP_MAIL_FROM);
                $mail->addAddress(SMTP_MAIL_TO);
                //$mail->AddReplyTo(SMTP_MAIL_FROM);

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->SMTPDebug = false;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    $result['status'] = false;
                    $result['message'] = 'Something is wrong,Please try again.';
                    echo json_encode($result, true);
                    exit;
                } else {
                    $result['status'] = true;
                    $result['message'] = 'Request has been send successfully.';
                    echo json_encode($result, true);
                    exit;
                }
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
            }
        /* 
		} else {

            $result = [];
            $result['status'] = false;
            $result['message'] = 'Something is wrong,Please try again.';
            echo json_encode($result, true);
            exit;
        } 
		*/

    } else {
        // header('Location:' . $_SERVER['HTTP_REFERER']);
        $result['success'] = false;
        $result['message'] = 'Something is wrong,Please try again.';
        echo json_encode($result, true);
        exit;
    }

} else {
    ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PDV6QZM');</script>
	<!-- End Google Tag Manager -->

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel= "stylesheet" href= "css/style.css" type= "text/css" media= "all" />
	<title>Thanks</title>

</head>
<body>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDV6QZM"
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
	  setTimeout(function(){window.location.href = '<?php echo REDIRECT_URL; ?>'}, 5000);
	}

	changeURL();

	</script>
</body>
</html>

<?php }?>