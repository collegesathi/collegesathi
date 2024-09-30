<?php
if (isset($_POST['form-submit'])) {
    $error = false;

  
            if (empty($_POST['name'])) {
                $name_error = NAME_EMPTY_MESSAGE;
                $error = true;
            } else {
                if (!preg_match("/^[A-Za-z ]+$/", $_POST['name'])) {
                    $name_error = NAME_ERROR_MESSAGE;
                    $error = true;
                } else {
                    $data['name'] = $_POST['name'];
                }
            }

            if (empty($_POST['email'])) {
                $email_error = EMAIL_EMPTY_MESSAGE;
                $error = true;
            } else {
                if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $_POST['email'])) {
                    $email_error = EMAIL_ERROR_MESSAGE;
                    $error = true;
                } else {
                    $data['email'] = $_POST['email'];
                }

            }
           

            if (empty($_POST['phone_number'])) {
                $phone_number_error = PHONE_EMPTY_MESSAGE;
                $error = true;
            } else {
                if (!preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/", $_POST['phone_number'])) {
                    $phone_number_error = PHONE_ERROR_MESSAGE;
                    $error = true;
                } else {
                    $data['phone_number'] = $_POST['phone_number'];
                }

            }

 




            if ($error == false) {
                require 'PHPMailerAutoload.php';

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 4;                               // Enable verbose debug output

                $mail->isSMTP();

                $mail->Host = SMTP_HOST;
                $mail->SMTPAuth = SMTP_AUTH;
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                $mail->SMTPSecure = SMTP_SECURE;
                $mail->SMTPAutoTLS = SMTP_AUTO_TLS;
                $mail->Port = SMTP_PORT;
                $mail->setFrom(SMTP_MAIL_FROM, SMTP_MAIL_FROM_NAME);
                $mail->addAddress(SMTP_MAIL_TO, SMTP_MAIL_TO_NAME);

                $mail->isHTML(true);
                $mail->Subject = SMTP_MAIL_SUBJECT;
                $mail->Body = SMTP_MAIL_BODY_START_MESSAGE . '<br/>
											Name :' . $data['name'] . '<br/>
											Email :' . $data['email'] . '<br/>
											Contact No :' . $data['phone_number'] . '<br/>
											Company   :' . $data['company_name'] . '<br/>
											Message :' . $data['message'] . '<br/><br/><br/><br/>Regards,<br/>Team Squawki';

                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $_POST = array();
                    echo "<script>swal({
								   icon: 'success',
								   title: '" . MAIL_THANKS_MESSAGE . "',
								   button: {text: 'Close'},
							  }).then((value) => {
									window.location.href=window.location.href;
								});
							  </script>";
                }

            }
 } 

