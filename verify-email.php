<?php
 include ('includes/dbcon.php' );
session_start();


if(isset($_GET['token'])){
$token = $_GET['token'];


$result=mysqli_query($mysqli, "SELECT `verify_token`, `verify_status` FROM  `users`  WHERE verify_token='$token' LIMIT 1   ");


if(mysqli_num_rows($result) >0 ){
$row=mysqli_fetch_assoc($result);

 if($row['verify_status'] == "0" ){

$click_token = $row['verify_token'];
$update_query=mysqli_query($mysqli, "UPDATE users SET verify_status='1' WHERE verify_token='$click_token' LIMIT 1  ");
if($update_query){$_SESSION['message']="your account has been verify successfull";


	$_SESSION['msg_type'] ="success";
    header('location:login.php');
	exit(0);}


else{
	$_SESSION['message']="verification failed";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);
}

}

	else{
		$_SESSION['message']="email aready verified,please log in.";
	$_SESSION['msg_type'] ="info";
	header('location:login.php');
	exit(0);
}

	}


	else{
		$_SESSION['message']="this token does exist.";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);
}
}

	
 
	




else{

	$_SESSION['message']="Not Allow 404error!!!!!.";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);
}







?>