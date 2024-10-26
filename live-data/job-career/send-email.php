<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "mukulanand651@gmail.com"; // Change this to your email address
    $subject = "New Job Application";

    // Form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Email body
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";
    $body .= "Cover Letter:\n$message\n";

    // File upload handling
    $file = $_FILES['resume'];
    $file_tmp = $file['tmp_name'];
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_error = $file['error'];
    $file_type = $file['type'];

    if ($file_error === UPLOAD_ERR_OK) {
        $boundary = md5(uniqid(time()));

        // Email headers
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        // Email message
        $message_body = "--$boundary\r\n";
        $message_body .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message_body .= $body . "\r\n";

        // Attachment
        $file_data = file_get_contents($file_tmp);
        $file_encoded = chunk_split(base64_encode($file_data));

        $message_body .= "--$boundary\r\n";
        $message_body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $message_body .= "Content-Transfer-Encoding: base64\r\n";
        $message_body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
        $message_body .= $file_encoded . "\r\n";
        $message_body .= "--$boundary--";

        // Send email
        if (mail($to, $subject, $message_body, $headers)) {
            echo "Your application has been sent successfully.";
        } else {
            echo "There was an error sending your application.";
        }
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "Invalid request.";
}
?>
