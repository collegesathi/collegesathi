<?php


session_start();
$from_fb			= 	isset($_REQUEST['from_fb']) ?  true : false;
$source 			= 	isset($_REQUEST['source']) ? $_REQUEST['source'] : "NMIMS MBA";
$source_campaign 	= 	isset($_REQUEST['source_campaign']) ? $_REQUEST['source_campaign'] : "landing page";
$source_medium 		= 	isset($_REQUEST['source_medium']) ? $_REQUEST['source_medium'] : "";


$mailtoID   		=  "cs.pgdm@gmail.com";
if ($from_fb == true) {
	$mailtoID	= 	"fb.collegesathi@gmail.com";
}

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
	$pageurl         = "NMIMS-Online-MBA";
	$qualification = NULL;
	$specialization = NULL;
	$university_name = isset($_POST['university_name']) ? $_POST['university_name'] : "";
	$city = $_POST['city'];
	$download_brochure =isset($_POST['download_broch'])? $_POST['download_broch']:'' ;
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
			
			$university_name	=	'NMIMS University';
			$mx_Website_Page	=	'';
			
			$secretKey = SECRET_KEY;
            $accessKey = ACCESS_KEY;
            $apiURL = API_URL . 'Lead.Capture?accessKey=' . $accessKey . '&secretKey=' . $secretKey;

            $request = array(
                array("Attribute" => 'FirstName', "Value" => $name),
                array("Attribute" => 'LastName', "Value" => ''),
                array("Attribute" => 'EmailAddress', "Value" => $email),
                array("Attribute" => 'Phone', "Value" => $contactno),
                array("Attribute" => 'mx_Specialization', "Value" => $specialization),
                array("Attribute" => 'mx_Course_Applying_For', "Value" => $qualification),
                array("Attribute" => 'mx_City', "Value" => $city),
                array("Attribute" => 'from_fb', "Value" => $from_fb),
				array("Attribute" => 'Source', "Value" => $source),
				array("Attribute" => 'mx_Opportunity_source', "Value" => "Opportunity source"),
				array("Attribute" => 'SourceCampaign', "Value" => $source_campaign),
				array("Attribute" => 'SourceMedium', "Value" => $source_medium),
				array("Attribute" => 'mx_University_Name', "Value" => $university_name),
				array("Attribute" => 'mx_Website_Page', "Value" => $mx_Website_Page),
                array("Attribute" => 'SearchBy', "Value" => 'Phone'),
            );

            $request = json_encode($request, true);
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

           echo $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            $jsonResult = json_decode($response, true);
			

			if($from_fb == true){
				$subject = "NMIMS Online MBA Social Media Lead";
			}
			else{
				$subject = "NMIMS Online MBA Lead";
			}
			
			$message = "Following Enquiry received<br/>";
			$message .= "Name : " . $name . "<br/>";
			$message .= "Email : " . $email . "<br/>";
			$message .= "Mobile : " . $contactno . "<br/>";
			$message .= "City : " . $city . "<br/>";
			$message .= "Source : NMIMS Online  <br/>";

			$from_email 		= 	SMTP_MAIL_FROM;
			$to_email 			= 	$mailtoID;
			$from_name 			= 	SMTP_MAIL_FROM_NAME;
			$attachment_info 	= 	0;
			$created_at			=	date("Y-m-d H:i:s");

			$sql= "INSERT INTO `leads` (`type`,`name`, `email`, `contactno`, `program`,`leadtype`, `admission`,`qualification`,`specialization`,`university`,`city`,`ipaddress`,`source`,`source_campaign`,`source_medium`,`mx_Website_Page`,`lsq_response`, `created_at`)VALUES ('$pageurl','$name', '$email', '$contactno', '','$leadtype', '','$qualification','$specialization','$university_name','$city','$ipaddress','$source','$source_campaign','$source_medium','$mx_Website_Page','$response','$created_at')";
			$result = mysqli_query($conn,$sql);


			$tempsql= "INSERT INTO `temp_emails` (`type`,`email`, `to_name`, `subject`, `message`,`from_email`, `from_name`,`attachment_info`)VALUES ('$pageurl','$to_email', '$name', '$subject','$message', '$from_email','$from_name','$attachment_info')";
			 
			
			$resultEmail = mysqli_query($conn,$tempsql);

			mysqli_close($conn);
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
	else {
       // header('Location:' . $_SERVER['HTTP_REFERER']);
        $result['success'] = false;
        $result['message'] = 'Something is wrong,Please try again.';
        echo json_encode($result,true);
    	exit;
    }
}