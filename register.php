<?php   $page_title ="register page"; session_start();
  include_once 'header.php' ; include_once ('includes/signup.inc.php' ); ?>


 

<?php

if(isset($_SESSION['message'])):
$name = $email = $phone = $password= $confirmpassword =   "";
 ?>



<div style="z-index: +9999;"  class="text-size text-center  alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<b><?php echo $_SESSION['message'];?></b>

<?php unset( $_SESSION['message']);?>
</div>
<?php endif ?>

      </div>

<div class="container">

  <section class="content">
  <h2>sign-up</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  


  	<div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" value="<?php echo $name;?>" placeholder="Enter name">
       <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
    </div>


    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control"  name="phone" value="<?php echo $phone;?>"  placeholder="Enter phone">
       <span class="error">* <?php echo $phoneErr;?></span>
  <br><br>

    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" value="<?php echo $email;?>"   placeholder="Enter email">
       <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control"  name="password"  placeholder="Enter password">
       <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
    </div>
   <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control"  name="confirmpassword" placeholder="Enter password">
       <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
    </div>

    <button type="submit" class="btn btn-primary" name="register">Register</button>
    <P class="text-center">Already a member?<span style="text-decoration: none;color:blue;"><a href="login.php">login</a></span></P>
  </form>

</section>


</div>




<?php include_once 'footer.php' ;      ?>