<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
if (!empty($_POST['name']) && !empty(($_POST['email']) && !empty($_POST['experience']))) {

	$conn = new mysqli('localhost', 'onlinevidhya_user', 'wXqc2p1R#9YEW4Dw', 'collegesathi_new');	
	$name = $conn->real_escape_string($_POST['name']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$email = $conn->real_escape_string($_POST['email']);
	$job_role = $conn->real_escape_string($_POST['job_role']); // Static value in this example
	$experience=$conn->real_escape_string($_POST['experience']);
	$resume = file_get_contents($_FILES['resume']['tmp_name']);

	$resume = $conn->real_escape_string($resume); // Ensure resume is properly escaped

	// SQL query
	$sql = "INSERT INTO `job_detail` (`name`, `phone_no`, `email`, `job_role`,`experience`, `resume`)
			VALUES ('$name', '$phone', '$email', '$job_role',$experience, '$resume')";

	// Execute the query
	if ($conn->query($sql) === TRUE) {
		echo "Record inserted successfully";
		header("Location: thanks.php");

	} else {
		echo "Error: " . $conn->error;
	}
}
