<?php
$from_fb 			= 	isset($_REQUEST['from_fb']) ? true : false;
$source 			= 	isset($_REQUEST['source']) ? $_REQUEST['source'] : "Website";
$source_campaign 	= 	isset($_REQUEST['source_campaign']) ? $_REQUEST['source_campaign'] : "Multi";
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
    //$conn = new mysqli('localhost', 'collegesathi_live', '5SE9fLzA1!V%', 'collegesathi_live');
     
    include 'constant.php';
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
    ob_start();

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
			
			$name	=	$fname.' '.$lname;	
			
			
			
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
				array("Attribute" => 'mx_City', "Value" => ""),
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
			
			$created_at	=	date("Y-m-d H:i:s");
			 
			$sql= "INSERT INTO `leads` (`type`,`name`, `email`, `contactno`, `program`,`leadtype`, `admission`,`qualification`,`specialization`,`university`,`city`,`ipaddress`,`source`,`source_campaign`,`source_medium`,`mx_Website_Page`,`lsq_response`,`created_at`)VALUES ('$pageurl','$name', '$email', '$contactno', '','$leadtype', '','$qualification','$specialization','$university_name','$city','$ipaddress','$source','$source_campaign','$source_medium','$mx_Website_Page','$response','$created_at')";
			$result = mysqli_query($conn,$sql);
			 
        
		
		
			$from_email 		= SMTP_MAIL_FROM;
			$to_email 			= $mailtoID;
			$from_name 			= SMTP_MAIL_FROM_NAME;
			$attachment_info 	= 0;
			$name               = $fname . ' ' . $lname;

			if ($from_fb == true) {
				$subject = "Online All Mba Colleges India Social Media Lead";
			} 
			else {
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
			
			
			$tempsql= "INSERT INTO `temp_emails` (`type`,`email`, `to_name`, `subject`, `message`,`from_email`, `from_name`,`attachment_info`)VALUES ('$pageurl','$to_email', '$name', '$subject','$message', '$from_email','$from_name','$attachment_info')";
				 
			$resultEmail = mysqli_query($conn,$tempsql);


			mysqli_close($conn);
		
		
		}

        

        

        
     
        $result['status'] = true;
        $result['message'] = 'Request has been send successfully.';
        echo json_encode($result, true);
        exit;

    } else {
        // header('Location:' . $_SERVER['HTTP_REFERER']);
        $result['success'] = false;
        $result['message'] = 'Something is wrong,Please try again.';
        echo json_encode($result, true);
        exit;
    }

} ?>