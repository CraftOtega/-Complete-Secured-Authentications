<?php include_once 'header.php' ;     $page_title =" Password Change update";  session_start();    include_once ('includes/password-change-inc//.php' ); 



 $passwordErr =   "";
 $email="";



//modification


  ?>




<?php 
//modification



if(isset($_SESSION['message'])):

  $email="";
 ?>



<div style="z-index: +9999;"  class="text-center  alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<b><?php echo $_SESSION['message'];?></b>

<?php unset( $_SESSION['message']);?>
</div>
<?php endif ?>

      </div>

     
<div class="container">
  <section class="content">
  <h2>Change Password </h2>

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

  	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>"  placeholder="Enter  email....">
    </div>

   <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control"  name="new_password" placeholder="Enter password">
       <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
    </div>
 <div class="form-group">
      <label for="pwd">Retype password:</label>
      <input type="password" class="form-control"  name="confirm_password" placeholder="Enter password">
       <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
    </div>
 <button type="submit" class="btn btn-primary" name="password_update">Update password</button>
 
  </form>
   
</section>

</div>
<br><br>
<br><br>
<br><br>





<?php include_once 'footer.php' ;      ?>