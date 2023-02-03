<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

ob_start();

	include 'include/session.php';

	if(isset($_POST['reset'])){
		$email = $_POST['email'];

		$conn = $ftdb->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM customers WHERE email=:email");
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			//generate code
			$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code=substr(str_shuffle($set), 0, 15);
			try{
				$stmt = $conn->prepare("UPDATE customers SET reset_code=:code WHERE id=:id");
				$stmt->execute(['code'=>$code, 'id'=>$row['id']]);
				
				$message = "
					<h2>Password Reset</h2>
					<p>Your Account:</p>
					<p>Email: ".$email."</p>
					<p>Please click the link below to reset your password.</p>
					<a href='http://localhost/fastech/password_reset.php?code=".$code."&user=".$row['id']."'>Reset Password</a>
				";

                require 'vendor/autoload.php';

                $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'fastechbusiness@gmail.com';
                        $mail->Password   = 'fastech123';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = 587;

                        //Recipients
                        $mail->setFrom('no-reply@yourdomain.com', 'FasTech');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Forgot Password';
                        $mail->Body    = $message;
                        $mail->AltBody = $message;

                        $mail->send();

                        $_SESSION['success'] = 'Forget Password link successfully sent.';

                    } catch (Exception $e) {
                        $_SESSION['error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                        header('location: signup.php');
                    }
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                    header('location: register.php');
                }
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}
		else{
			$_SESSION['error'] = 'Email not found';
		}

		$ftdb->close();

	}
	else{
		$_SESSION['error'] = 'Input email associated with account';
	}

	header('location: password_forgot.php');

ob_end_flush();
?>