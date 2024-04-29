<?php

  include ('dbcon.php' );
 

if(isset($_POST['login'])){


if(!empty(trim($_POST['email'])) &&  !empty(trim($_POST['password']))){

$email=mysqli_real_escape_string($mysqli, $_POST['email']);
$password=mysqli_real_escape_string($mysqli, $_POST['password']);


$login_query =mysqli_query($mysqli, "SELECT * FROM users WHERE email ='".$email."' ");
             

	if(mysqli_num_rows ($login_query) >0){
		$row =mysqli_fetch_assoc($login_query);

         


		if( $row['verify_status'] == "1"){
         
         $checkhash = password_verify($password, $row['password']);

        if($checkhash){

   
			
			$_SESSION['authenticated'] = TRUE;
			$_SESSION['auth_user'] =[
				  'id'=>$row['id'],
				'username'=>$row['name'],
				'phone'=>$row['phone'],
				'email'=>$row['email'],
				'dob'=>$row['dob'],
				'address'=>$row['address'],
				'id_card'=>$row['id_card'],
				
            


			];

	$_SESSION['message']="you have logged sucesssfully";
	$_SESSION['msg_type'] ="success";
	header('location:dashboard.php');
	exit(0);
	}
	/* "wrong combination" is when  either of password or email is present coming from password (checkhash) */
	else{

		$_SESSION['message']="wrong combination";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);


	}

}


		

			else{


	$_SESSION['message']="please verify your email address to login";
	$_SESSION['msg_type'] ="info";
	header('location:login.php');
	exit(0);

			}


	 }
	 /* "invalid email or password" is when  both of password or email is not present coming from if(mysqli_num_rows ($login_query) >0) */

	else{


	$_SESSION['message']="invalid email or passsword";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);

	}


}


else{


	$_SESSION['message']="All field are required";
	$_SESSION['msg_type'] ="danger";
	header('location:login.php');
	exit(0);


}




}


















  ?>