<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$from_fb		= isset($_REQUEST['from_fb']) ?  true : false;
 
include 'constant.php';

$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
ob_start();
require_once 'PHPMailerAutoload.php';

$sql = "SELECT * FROM temp_emails WHERE is_sent = 0 LIMIT 5" ;
$result = mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
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
			$mail->addAddress($row['email']);
			$mail->isHTML(true);
			$mail->Subject = $row['subject'];
			$mail->Body = $row['message'];
			$mail->SMTPDebug = false;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->send();

			$id = $row["id"];
			mysqli_query($conn,"UPDATE temp_emails SET is_sent = '1'  WHERE id = $id");
		} 
		catch (phpmailerException $e) {
			echo $e->errorMessage(); 
		} 
		catch(Exception $e) {
			echo 'Message: ' .$e->getMessage();
		}
	}
	echo "Sucessfully";
  } else {
	echo "0 results";
  }
  mysqli_close($conn);	
