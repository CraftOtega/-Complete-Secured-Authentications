<?php
include_once ('dbcon.php' );


//resend email verification

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//define names spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


function resend_email_verify($name, $email, $verify_token){

  //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//Server settings
    //$mail->SMTPDebug = 2;not use                      //Enable verbose debug output
   { 
   

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'examplea@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     //Recipients
    $mail->setFrom('examplea@gmail.com', 'mailer');
    $mail->addAddress($email);

     //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resend Email verification with Weblift';


    

    $email_template = '
    <em>You have register with WebLift</em>
    <h5 style="color:green;font-size:12px;">verify your email address to login with the below given link  </h5>
    <br><br>

    <button  style="border-radius:.25em;background-color:#4582e8;font-weight:400;min-width:180px;font-size:16px;line-height:100%;padding-top:18px;padding-right:30px;padding-bottom:18px;padding-left:30px;color:#fffffftext-decoration:none"> <a    href="http://localhost/youzone/verify-email.php?token=$verify_token">click me</a>
</button>';


    $mail->Body=$email_template;
    $mail->send();
   // echo 'Message has been sent';
}
    


}







if(isset($_POST['resend-email-btn'])){

	$email =$_POST['email'];

	if(!empty(trim($_POST['email']))){

$checkemail=mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email' LIMIT 1");

if(mysqli_num_rows($checkemail)){

$row=mysqli_fetch_assoc($checkemail);


if($row['verify_status'] =="0"){

     $name = $row['name'];
     $email = $row['email'];
     $verify_token =$row['verify_token'];

resend_email_verify($name, $email, $verify_token);
     
     
	$_SESSION['message']="verification link has been sent to your email address. ";
	$_SESSION['msg_type'] ="info";
	header('location:login.php');
	exit(0);






}


else{


	$_SESSION['message']="email already verify please login. ";
	$_SESSION['msg_type'] ="info";
	header('location:resend-email-verification.php');
	exit(0);


}




}



else{

	$_SESSION['message']="this email is not yet registered,please register now. ";
	$_SESSION['msg_type'] ="danger";
	header('location:register.php');
	exit(0);


	}


}
 
else{
  $_SESSION['message']="please enter the email address";
	$_SESSION['msg_type'] ="info";
	header('location:resend-email-verification.php');
	exit(0);

	  }




}















?>