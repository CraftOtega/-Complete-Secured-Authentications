<?php
include_once ('dbcon.php' );

//this check and connect to password change.php AND password email send
//password update

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//define names spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;  

//Load Composer's autoloader
require 'vendor/autoload.php';

//require "PHPMailer/PHPMailerAutoload.php";
//require "PHPMailer/class.phpmailer.php";



function send_password_reset($get_name, $get_email, $token){

	 //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//Server settings
     //$mail->SMTPDebug = 2;not use 


                          //Enable verbose debug output
   { 

   //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   //$mail->SMTPAutoTLS = false;
  // $mail->SMTPDebug = false;
  // $mail->do_debug = 0;

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';                     //SMTP username
    $mail->Password   = ''; //PHPM-oueyuopsycicpefk- ehbhcpoplgfsyvod  SMTP password bzexjbjjzrnsxfdi
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     //Recipients
    $mail->setFrom('example@gmail.com', 'hoster');
    $mail->addAddress($get_email);

     //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';


    

    $email_template = "
    <h2>hello</h2>
    <em style='color:green;font-size:12px;'>you receive this message because we received a password reset link from your mail account</em>
    <br><br>
<a style='font-size:24px;' class='btn btn-info' href='http://localhost/youzone/password-change.php?token='".$token."'&email='".$get_email."'>click me</a>";

    $mail->Body=$email_template;
    $mail->send();
   // echo 'Message has been sent';
}
   


}


if(isset($_POST['password-reset-btn'])){

 $email=mysqli_real_escape_string($mysqli, $_POST['email']);
 $token=md5(rand());

 $check_email=mysqli_query($mysqli, "SELECT `name`, `email` FROM users WHERE email='$email' LIMIT 1 ");

if(mysqli_num_rows($check_email) >0 ){

	$row=mysqli_fetch_assoc($check_email);

	$get_name=$row['name'];
    $get_email=$row['email'];

date_default_timezone_set('Africa/Lagos');

/* if the user failed to click on link before 5minute the  token wiil be failed  */
$update_token=mysqli_query($mysqli, "UPDATE users SET verify_token='$token', tokenExpire= DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email='$get_email'  LIMIT 1");

if($update_token){
	send_password_reset($get_name, $get_email, $token);

	$_SESSION['message']="password reset link has been sent to your email address. ";
	$_SESSION['msg_type'] ="info";
	header('location:password-reset.php');
	exit(0);
 

}

else{


	$_SESSION['message']="something went wrong,try again!!!!. ";
	$_SESSION['msg_type'] ="danger";
	header('location:password-reset.php');
	exit(0);

}

 
}

else{



	$_SESSION['message']="no email found . ";
	$_SESSION['msg_type'] ="danger";
	header('location:password-reset.php');
	exit(0);
}




}







     /*
  echo '<pre>';
  print_r($_GET);
  echo '</pre>';
  
*/




  ?>