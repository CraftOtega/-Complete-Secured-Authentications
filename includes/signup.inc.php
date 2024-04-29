<?php 


  include ('dbcon.php' );



  // define variables and set to empty values
 $name = $email = $phone = $password= $confirmpassword =   "";
$nameErr  = $emailErr = $phoneErr =$passwordErr = $confirmpasswordErr =   "";
$password=$confirmpassword;
//include required phpmailer files
//require_once 'includes/PHPMailer.php';
//require_once 'includes/SMTP.php';
//require_once 'includes/Exception.php';


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
//define names spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


// function for email verification
function sendemail_verify($name, $email, $verify_token){
  //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//Server settings
    //$mail->SMTPDebug = 2;not use                      //Enable verbose debug output
   { 
   

    $mail->isSMTP();   
     //$mail->Host = "ssl://smtp.gmail.com";                                         //Send using SMTP
   $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

     //Recipients
    $mail->setFrom('example@gmail.com', 'hoster');
    $mail->addAddress($email);

     //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email verification with hoster ';

    

    $email_template = "
    <em>You have register with Hoster</em>
    <h3 style='color:green;font-size:12px;'>verify your email address to login with the below given link  </h3>
    <br><br>
<a style='font-size:24px;' class='btn btn-info' href='http://localhost/youzone/verify-email.php?token=$verify_token'>click me</a>";

    $mail->Body=$email_template;
    $mail->send();
   // echo 'Message has been sent';
}
   

}


if(isset($_POST['register'])){



  date_default_timezone_set('Africa/Lagos');
$time=date(" D M Y, \a\\t  h:i:sa", time());  



  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }




 
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }



  if (empty($_POST["phone"])) {
  $phoneErr = "Phone is required";
} else {
  $phone = test_input($_POST["phone"]);
  //check if phone number is well-formed
  if (!preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/",$phone)) {
    $phone_Err = "Invalid phone number";
  }
}



 /*$password = test_input(password_hash($_POST["password"],PASSWORD_BCRYPT));*/
 $password = $_POST['password'];
 



if(empty($_POST["password"])){
  $passwordErr ="password is required";
}

if(empty($_POST["confirmpassword"])){
  $passwordErr ="password is required";
}


else if ($_POST["password"] != $_POST["confirmpassword"]){
  $passwordErr ="password didn't match";
}

elseif (strlen($_POST["password"]  ) < 5) {
    $passwordErr ="password must contain at least 5 character";
  # code...
}

elseif (strlen($_POST["confirmpassword"]
  ) < 5) {
    $passwordErr ="password must contain at least 5 character";
  # code...
}






if($nameErr ==''  and $emailErr =='' and   $phoneErr =='' and $passwordErr == ''  and $confirmpasswordErr ==''){

unset($_POST['submit']);



  $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE  `email`='".$email."' || `phone`= '".$phone."' " );


  if (mysqli_num_rows($result) !=0){
    $row =mysqli_fetch_assoc($result);
if($email==$row['email']){
  $emailErr = "email already exist";

}

else if ($phone==$row['phone']) {
  $phoneErr  = "phone already exist";
  # code...
}

}



  else{
    /*  $mysqli->query is use to insert a record into database
  $mysqli->query("INSERT INTO usere (username, password) VALUES('$username', '$password')") or 
          die($mysqli->error);*/
 //$pwdhash = test_input(password_hash($password, PASSWORD_DEFAULT));
 $verify_token=md5(rand());





  $password = test_input($_POST['password']);
  $pwdhash = test_input(password_hash($password, PASSWORD_DEFAULT));

  $mysqli->query("INSERT INTO users (name, phone, email, password, verify_token, date ) VALUES('$name', '$phone', '".$email."', '".$pwdhash."', '$verify_token', '$time'  )");
if ($mysqli){


  sendemail_verify($name, $email, $verify_token);
  $_SESSION['message'] = "registration successfully,kindly verify your email address";
    $_SESSION['msg_type'] = "success";
}



else{


  $_SESSION['message'] = "registration failed ";
    $_SESSION['msg_type'] = "danger";


  }


}


}

}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>