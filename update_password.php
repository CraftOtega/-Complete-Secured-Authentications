<?php

 $page_title ="password-Page";
     
        
 include_once ('includes/dbcon.php' );   session_start();   include_once ('header.php' );  include_once ('authentication.php' );


$passwordErr = "" ;



$user_id = $_SESSION['auth_user']['id'];

if(isset($_POST['update_password'])){





//  $password = test_input($_POST['password']);
 // $pwdhash = test_input(password_hash($password, PASSWORD_DEFAULT));



   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($mysqli, $_POST['update_pass']);
   $new_pass = mysqli_real_escape_string($mysqli, $_POST['new_pass']);
   $confirm_pass = mysqli_real_escape_string($mysqli, $_POST['confirm_pass']);

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){


$checkhash = password_verify($update_pass, $old_pass);

      if(!$checkhash){
          $passwordErr = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $passwordErr = 'confirm password not matched!';
      }
       
       else if (strlen($_POST["confirm_pass"]  ) < 5){

       	 $passwordErr = 'password must contain at least 5 character';
       }
                    


      else{

          $pwdhash = password_hash($confirm_pass, PASSWORD_DEFAULT);

         mysqli_query($mysqli, "UPDATE `users` SET password = '$pwdhash' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

else{

	 $passwordErr = 'All field are required';


}






}















?>





















<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="update-profile">

   <?php
      $select = mysqli_query($mysqli, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

    <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>

 <div class="flex">


 	<div class="inputBox"  style="margin:0px 200px 0px 85px;">
 		        <span class="error" style="color:red;">* <?php echo $passwordErr;?></span>
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>


      </div>
      <input type="submit" value="update password" name="update_password" class="btns">
      <a href="profile.php" class="delete-btns">go back</a>
   </form>

</div>






</body>
</html>
