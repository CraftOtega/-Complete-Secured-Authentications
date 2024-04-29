<?php 

if (!isset($_SESSION['authenticated'])) {


$_SESSION['message']="please login to  access user dashboard";
$_SESSION['msg_type'] ="info";
header('location:login.php');
exit(0);

	# code...
}


?>