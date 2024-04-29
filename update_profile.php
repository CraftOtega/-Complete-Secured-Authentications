<?php  $page_title ="Profile-Page";
     
        
 include_once ('includes/dbcon.php' );  session_start(); /*ob_start();*/    include_once ('header.php' );     include_once ('authentication.php' );     
    ?>



<?php


/*if(!isset($user_id)){
   header('location:login.php');
};

*/
$imageErr="";


$user_id = $_SESSION['auth_user']['id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($mysqli, $_POST['update_name']);
  $update_phone = mysqli_real_escape_string($mysqli, $_POST['update_phone']);
   $update_email = mysqli_real_escape_string($mysqli, $_POST['update_email']);
   $update_dob = mysqli_real_escape_string($mysqli, $_POST['update_dob']);
  $update_address = mysqli_real_escape_string($mysqli, $_POST['update_address']);
   $update_id = mysqli_real_escape_string($mysqli, $_POST['update_id']);
  


  $query= mysqli_query($mysqli, "UPDATE `users` SET name = '$update_name', phone = '$update_phone', email = '$update_email',  dob = '$update_dob', address = '$update_address', id_card = '$update_id' WHERE id = '$user_id'") or die('query failed');

if($query){

   $message[] = 'somechanges updated succssfully!';
   //header('Refresh:7; url=profile.php');



}






  /* $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($mysqli, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($mysqli, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($mysqli, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($mysqli, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }
*/
  

   $file=  $_FILES['update_image'];

    $fileName= $_FILES['update_image']['name'];
    $fileTempName= $_FILES['update_image']['tmp_name'];
    $fileSize= $_FILES['update_image']['size'];
    $fileError= $_FILES['update_image']['error'];
    $fileType= $_FILES['update_image']['type'];
     $oldimage =  $_POST['oldimage'];

$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));


$allowed = array('jpg', 'jpeg', 'png', 'pdf');

if(!empty($fileName)){

if (in_array($fileActualExt, $allowed)){

   if ($fileError === 0){


if($fileSize <2000000){

$fileNameNew = uniqid('', true).".".$fileActualExt;

$fileDestination = 'uploaded_img/'.$fileNameNew;
// i put my own
 $image_update_query = mysqli_query($mysqli, "UPDATE `users` SET image = '$fileDestination' WHERE id = '$user_id'") or die('query failed');
if($image_update_query){
    unlink($oldimage);
move_uploaded_file( $fileTempName, 
$fileDestination );




   
$message[] = 'image updated succssfully!';
         $fileDestination=$oldimage;
    

}


//end  else
/*else{

//echo " insert failed";
$message[] = 'insert failed';

}

*/


}

else{

//echo " your file is too big";
   $imageErr = 'image is too large';

}


   }

   else{

      //echo "there are error uploading  your file!";
      $imageErr = 'there are errors uploading this image';
   }

}

else{
   //echo "you cannot upload file of this type ";
   $imageErr = 'you cannot upload image of this type';
}

}

/*else{

//echo "please select a file ";

   $message[] = 'please select a file';


}
*/


}






  /* $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;
   $oldimage =  $_POST['oldimage'];


   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($mysqli, "UPDATE `users` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');

         if($image_update_query){
            unlink($oldimage);
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'image updated succssfully!';
         $update_image=$oldimage;
      }
   }

}
*/
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
         <div class="inputBox">
            <span>Username :</span>
            <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box">
            <span>Your Email :</span>
            <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box">
            <span>Update Your Pic :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
             <span class="error"  style="color:red;">* <?php echo $imageErr;?></span>
             <input type="hidden" name="oldimage" value="<?php echo $fetch['image']; ?>" accept="image/jpg, image/jpeg, image/png" class="box" >
         </div>

         <div class="inputBox">
            <span>Phone :</span>
            <input type="text" name="update_phone" value="<?php echo $fetch['phone']; ?>" class="box">
            <span>Date of Birth :</span>
            <input type="date" name="update_dob" value="<?php echo $fetch['dob']; ?>" class="box">
             <span>Address :</span>
            <input type="text" name="update_address" value="<?php echo $fetch['address']; ?>" class="box">


         </div>


         <div class="inputBox">
            <span>ID :</span>
            <input type="text" name="update_id" value="<?php echo $fetch['id_card']; ?>" class="box">


         </div>




        <!-- <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>-->


      </div>
      <input type="submit" value="update profile" name="update_profile" class="btns">
      <a href="profile.php" class="delete-btns">go back</a>

      <span><a href="update_password.php" class="btn btn-danger">Edit Password</a></span>
   </form>



</div>









<script >
   
$(".message").delay(4000).slideUp(200, function(){

$(this).alert('close');


});



</script>


<script type="text/javascript">
   
   if(window.history.replaceState){
      
      window.history.replaceState(null, null, window.location.href);
  }

</script>

</body>
<?php// ob_end_flush(); 
        //ob_end_clean();
        //ob_flush();
        //ob_clean(); 
        
?>
</html>