<div class="profileb">
<?php  $page_title ="Profile-Page";
 include_once ('includes/dbcon.php' );   session_start();   include_once ('header.php' );  include_once ('authentication.php' );     ?>

<?php
        $user_id =$_SESSION['auth_user']['id'];
?>

 <?php 
 if(isset($_SESSION['message'])): ?>

<div style="z-index: +9999;"  class="text-size text-center  navbar-fixed-top alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a style="float:right;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<?php echo $_SESSION['message'];
unset( $_SESSION['message']);?>

 </div>



<?php endif ?>







<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">


  <?php
         $select = mysqli_query($mysqli, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png"  class="img-circle" height="100" width="100" alt="Avatar">';
         }else{
            echo '<img src="'.$fetch['image'].'"  class="img-circle" height="100" width="100" alt="Avatar">';
         }
      ?>
        

    
<h4><b><?=$_SESSION['auth_user']['username']; ?></b></h4>
  <br>

  <div class="row ">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off logo-small"></span>
       <h4>Username: <?=$_SESSION['auth_user']['username']; ?></h4>
<hr>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h5>Email: <?=$_SESSION['auth_user']['email']; ?></h5>

    </div>
    <br>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h5>Phone: <?=$_SESSION['auth_user']['phone']; ?></h5>
    <hr>
    </div>
  </div>
  <br><br>
  <div class="row ">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h5>Date of Birth: <?=$_SESSION['auth_user']['dob']; ?></h5>
      <hr>

    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
       <h5>Address: <?=$_SESSION['auth_user']['address']; ?></h5>
    </div>
    <br>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h5>ID: <?=$_SESSION['auth_user']['id_card']; ?></h5>
      <hr>

    </div>
  </div>
</div>



<section class="content">

  <a href="update_profile.php"class="btn btn-primary btn-block">Update</a>
  <br>

  <a href="dashboard.php"class="btn btn-danger btn-block">Back Home</a>

</section>


</div>




















<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include_once 'footer.php' ;      ?>

 </div>
