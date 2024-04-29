<?php

//modify page2


// change password session /coding

//modification

if(!isset($_GET['token'])){


	$_SESSION['message']="no token avaliable. ";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);

}





$token =mysqli_real_escape_string($mysqli, $_GET['token']);





if(isset($_POST['password_update'])){



$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$new_password =mysqli_real_escape_string($mysqli, $_POST['new_password']);
$confirm_password =mysqli_real_escape_string($mysqli, $_POST['confirm_password']);







if(empty($new_password)){
 

	$_SESSION['message']="password is required. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);
}

if(empty($confirm_password)){
 
	$_SESSION['message']="password is required. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);
}

 
else if ($new_password != $confirm_password){

	$_SESSION['message']="password didn't match. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);
}

elseif (strlen($new_password  ) < 5) {
  
 	$_SESSION['message']="password must contain at least 5 character. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);
}

elseif (strlen($confirm_password
  ) < 5) {


 	$_SESSION['message']="password must contain at least 5 character. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-reset.php?token=$token&email=$email");
	exit(0);
     
  # code...
}
 

  // (isset($token))
//if(isset($_GET['token'])){

	if(!empty($email) && !empty($new_password) && !empty($confirm_password)){

		$newpassword=password_hash($new_password, PASSWORD_DEFAULT);
// checking if token is valid or not
       
date_default_timezone_set('Africa/Lagos');

       
		$check_token=mysqli_query($mysqli, "SELECT verify_token FROM users WHERE verify_token='$token' AND tokenExpire > NOW() LIMIT 1");
    if(mysqli_num_rows($check_token)>0){


if($new_password == $confirm_password){

	$update_password = mysqli_query($mysqli, "UPDATE users SET password='$newpassword' WHERE verify_token='$token' LIMIT 1 ");

	if($update_password){
$new_token=md5(rand())."funda";
$update_to_new_token = mysqli_query($mysqli, "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1 ");


	$_SESSION['message']="new password is updated, you can now login. ";
	$_SESSION['msg_type'] ="success";
	header('location:login.php');
	exit(0);

	}
  
else{

 
	$_SESSION['message']="password is not updated,something went wrong!!!. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);



} 

}


else{


	$_SESSION['message']="password and retype password does not match. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);



}


    }

else{


	$_SESSION['message']="invalid token. ";
	$_SESSION['msg_type'] ="danger";
	header("location:password-change.php?token=$token&email=$email");
	exit(0);



}



	}

else{


	$_SESSION['message']="all field are required. ";
	$_SESSION['msg_type'] ="danger";
	
	   header("location:password-change.php?token=$token&email=$email" );
	exit(0);


}

/*}

else{


	$_SESSION['message']="no token avaliable. ";
	$_SESSION['msg_type'] ="danger";
	header('location:index.php');
	exit(0);


}

*/



}















?>