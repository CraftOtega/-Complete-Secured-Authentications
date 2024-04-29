<?php
session_start();


unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);

$_SESSION['message']="logout successfully";
$_SESSION['msg_type'] ="info";
header('location:login.php');
exit(0);







?>