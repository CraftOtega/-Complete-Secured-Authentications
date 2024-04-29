<?php

include_once('dbcon.php');



  // define variables and set to empty values
  $email =  "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';



function sendemail_verify( $email){
 
$mail = new PHPMailer(true);
//Server settings
    //$mail->SMTPDebug = 2;not use                      //Enable verbose debug output
   { 
   

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     //Recipients
    $mail->setFrom('example@gmail.com', 'mailer');
    $mail->addAddress($email);

     //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email subcription with hoster ';

    $email_template = "
    <em><h1 style='font-size:14px;'>You can now get notification on latest--- All<h1></em>
    <h5 style='color:green;font-size:12px;'>thanks for subscribing  </h5>";

    $mail->Body=$email_template;
    $mail->send();
   // echo 'Message has been sent';
}
   

}


if (isset($_POST['submit'])) {

  date_default_timezone_set('Africa/Lagos');
  $time=date(" D M Y, \a\\t  h:i:sa", time());  

  $email =mysqli_real_escape_string($mysqli, $_POST['email']);






 
  if (empty($_POST["email"])) {
    $error[] = "Email is required";
  } else {
    $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = "Invalid email format"; 
    }
  }

/*(!isset($error)) or !error=="" */

//if no error have been found carry on
if (!isset($error)){


  unset($_POST['submit']);


   $result = mysqli_query($mysqli, "SELECT * FROM `subscribers` WHERE  `email`='".$email."' LIMIT 1 " );


  if (mysqli_num_rows($result) !=0){
    $row =mysqli_fetch_assoc($result);
if($email==$row['email']){
  //"email already exist";
  $error[]  = "you  have already subscribed to our mail.thank you!.";

}


}


else{

$mysqli=mysqli_query($mysqli, "INSERT INTO `subscribers` (email, date) VALUES('$email', '$time')");

if($mysqli){


  sendemail_verify( $email);
  $_SESSION['message'] = "You  have succesfully subscribed to our mail!";
    $_SESSION['msg_type'] = "success";

  


}
else{

    $_SESSION['message'] = "Error in receiving your mail, kindly contact us!";
    $_SESSION['msg_type'] = "danger";
    
}

}

}
}
?>
















<?php

if (isset($_POST['subscribe-btn'])){


	$email  =$_POST['email'];


if($mysqli->query( "INSERT INTO mail ( email)  VALUES('$email')")){
    $_SESSION['message']= 'Your  have succesfully subscribed to our mail!';
$_SESSION['msg_type'] = 'info';
header("location: index.php");

}


else{
    die(mysqli_error($mysqli));
    

  $_SESSION['message']= 'Error in receiving your mail, kindly contact us!';
 $_SESSION['msg_type'] = 'danger';
 header("location: index.php");
}




}
?>