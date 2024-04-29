<?php include_once 'header.php' ;     $page_title ="Resend  Verification";  session_start();   include_once ('includes/resend-code.inc.php' );    ?>


<?php



if(isset($_SESSION['message'])):
 ?>



<div style="z-index: +9999;"  class="text-center  alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<b><?php echo $_SESSION['message'];?></b>

<?php unset( $_SESSION['message']);?>
</div>
<?php endif ?>

      </div>

<div class="container">
  <section class="content" style="margin-top:150px;">
  <h2>Resend Email Verification  </h2>

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  	<div class="form-group">
      <label for="name">Email:</label>
      <input type="text" class="form-control" name="email"  placeholder="Enter  email....">
    </div>
    <button type="submit" class="btn btn-primary" name="resend-email-btn">Resend</button>
   
  </form>
</section>

</div>
<br><br>
<br><br>
<br><br>




<?php include_once 'footer.php' ;      ?>