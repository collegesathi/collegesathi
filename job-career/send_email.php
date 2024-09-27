<?php


include 'constant.php';
ob_start();
require_once 'PHPMailerAutoload.php';
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);

try {
	//Server settings
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = SMTP_HOST;
	$mail->SMTPAuth = SMTP_AUTH;
	$mail->Username = SMTP_USERNAME;
	$mail->Password = SMTP_PASSWORD;
	$mail->SMTPSecure = SMTP_SECURE;
	$mail->Port = SMTP_PORT;
	$mail->setFrom('mukulanand651@gmail.com', 'mukul'); // Set the sender's email and name
    $mail->addAddress('hr@collegesathi.com', 'HR');
	$name = $conn->real_escape_string($_POST['name']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$email = $conn->real_escape_string($_POST['email']);
	$job_role = $conn->real_escape_string($_POST['job_role']); // Static value in this example
	$experience = $conn->real_escape_string($_POST['experience']);
	$resume = file_get_contents($_FILES['resume']['tmp_name']);

	$resume = $conn->real_escape_string($resume); // Ensure resume is properly escaped

	// SQL query
	$sql = "INSERT INTO `job_detail` (`name`, `phone_no`, `email`, `job_role`,`experience`, `resume`)
			VALUES ('$name', '$phone', '$email', '$job_role',$experience, '$resume')";

	// Execute the query
	if ($conn->query($sql) === TRUE) {
		echo "Record inserted successfully";
		//header("Location: thanks.php");

	} else {
		echo "Error: " . $conn->error;
	}

	//Attachments
	if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
		$mail->addAttachment($_FILES['resume']['tmp_name'], $_FILES['resume']['name']);
	}

	// Content
	// $name = $_POST['name'];
	// $email = $_POST['email'];
	// $phone = $_POST['phone'];
	// $message = $_POST['message'];

	$mail->isHTML(true);
	$mail->Subject = 'New Job Application';
	$mail->Body = "<p>Name: $name</p>
                          <p>Email: $email</p>
                          <p>Phone: $phone</p>
                          <p>Cover Letter:</p>
                          <p>$message</p>";
	$mail->SMTPDebug = 2;

	$mail->send();
	echo "<pre>";
	print_r($mail);
	echo "</pre>";
	echo 'Your application has been sent successfully.';
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
