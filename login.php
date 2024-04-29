<?php include_once 'header.php' ;     $page_title ="Login";   session_start();
 include_once ('includes/login.inc.php' );    ?>



<?php

if (isset($_SESSION['authenticated'])) {


$_SESSION['message']="you are already logged in";
$_SESSION['msg_type'] ="success";
header('location:dashboard.php');
exit(0);

  # code...
}



if(isset($_SESSION['message'])):
 ?>



<div style="z-index: +9999;"  class=" text-size text-center  alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<b><?php echo $_SESSION['message'];?></b>

<?php unset( $_SESSION['message']);?>
</div>
<?php endif ?>

      </div>

<div class="container">
  <section class="content">
  <h2>login </h2>

 <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" > 
  <P class="text-center">Not yet a member?<span style="text-decoration: none;color:blue;">
  <a href="register.php">Sign up</a></span></P> 
  

  	<div class="form-group">
      <label for="name">Email:</label>
      <input type="text" class="form-control " name="email"  placeholder="Enter  email....">

    </div>

   <div class="form-group form">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="show" name="password" placeholder="Enter password">
    

    </div>

    <div class="checkbox">
      <label><input type="checkbox"  onclick="myfunction()">Show  Password</label>
    </div>
     <button type="submit" class="btnlogin" name="login">Login</button>
      </form>
   </section>
</div>






<div class="container">
  <section class="content" style="margin-top: 80px;">
  <span style="margin-left:150px;font-size:18px;">I Need?<a   href="#" style="text-decoration: none;color:blue;" onclick="document.getElementById('id01').style.display='block'" >&nbsp; Help</a></span>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>Questions Page</h2>
      </header>
     
      
<button class="accordions">I didn't received my email verification?</button>
<div class="panel">
  <em>If you haven't yet received your email verification,please kindly click on the below.
  <P>I Did not received my email verification ?
<span style="text-decoration: none;color:blue;"><a href="resend-email-verification.php">Resend.</a></span>
</P></em>
</div>

<button class="accordions">I forgot my password?</button>
<div class="panel">
  <em>If you cann't remember your password, please kindly click on the link below to update your password
    <P>I forgot my password?<span style="text-decoration: none;color:blue;"><a href="password-reset.php">Recover.</a></span></P></em>
</div>


      <footer class="w3-container w3-teal">
        <p>Questions/Answered</p>
      </footer>
    </div>
  </div>
</div>

</section>
</div>






<!--<div class="container">
  <section class="content" style="margin-top: 80px;">
<button class="accordions">I didn't received my email verification?</button>
<div class="panel">
  <em>If you haven't yet received your email verification,please kindly click on the below.
  <P>I Did not received my email verification ?
<span style="text-decoration: none;color:blue;"><a href="resend-email-verification.php">Resend.</a></span>
</P></em>
</div>

<button class="accordions">I forgot my password?</button>
<div class="panel">
  <em>If you cann't remember your password, please kindly click on the link below to update your password
    <P>I forgot my password?<span style="text-decoration: none;color:blue;"><a href="password-reset.php">Recover.</a></span></P></em>
</div>
</section>
</div>-->









<!------------------------------------------script pages in login.php ------------------------------------------->
<!-- first accordions in login page -->
<script>
/*accordion setup in login page */
var acc = document.getElementsByClassName("accordions");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}




//password hide and show 
/*function show(){

  var pswd = document.getElementById('pswd');
  var icon = document.querySelector('fa');

  if(pswd.type === "password"){
    pswd.type = "text";
    pswd.style.marginTop = "20px";
    icon.style.color ="#7f2092";
  }


  else{

        pswd.type = "password";
    pswd.style.marginTop = "20px";
    icon.style.color ="grey";


  }

}
*/













</script>












<?php include_once 'footer.php' ;      ?>