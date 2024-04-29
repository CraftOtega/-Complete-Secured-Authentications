<?php  $page_title ="Dash-Board";   session_start();   include_once ('header.php' );  include_once ('authentication.php' );   include_once ('includes/mail.inc.php' );  ?>




 <?php 
 if(isset($_SESSION['message'])): ?>

<div style="z-index: +9999;"  class="text-size text-center  navbar-fixed-top alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a style="float:right;" href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<?php echo $_SESSION['message'];
unset( $_SESSION['message']);?>

 </div>



<?php endif ?>



<!--<?php
if(isset($_SESSION['message'])):
 ?>



<div style="z-index: +9999;"  class="text-center  alert alert-dismissible fade in alert-<?=$_SESSION['msg_type']?>">
    <a  href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

<b><?php echo $_SESSION['message'];?></b>

<?php unset( $_SESSION['message']);?>
</div>
<?php endif ?>

      </div>-->



  
<div class="jumbotron text-center">
  <h1>Company</h1> 
  <p>We specialize in blablabla</p> 


   <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
    <?php 
//check for email error
    if(isset($error)){

      foreach($error as $errors) {
         echo '<div class="text-size1 short-alert alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
    .$errors.
  '</div>';
        # code...
      }
    }
 ?>

 <div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Email Address" name="email"  value="<?php if(isset($error)){ echo$email; }?>" required>
      <div class="input-group-btn">
        <button type="submit"  name="submit"  class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>
    <!--<div class="input-group">
      <input type="email" class="form-control" size="50" placeholder="Email Address" name="email"  value="<?php if(isset($error)){ echo $_POST['email']; }?>" required>
      <div class="input-group-btn">
        <button type="button" class="btn btn-primary" name="subscribers-btn">Subscribe</button>
      </div>
    </div>
  </form>
</div>-->

  <!-- About Section -->
  <div class="w3-container w3-padding-32" id="about">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">About</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
      occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
      laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  </div>

  <div class="w3-row-padding w3-grayscale">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="styles/images/tega.jpg" alt="John" style="width:100%">
      <h3>John Doe</h3>
      <p class="w3-opacity">CEO & Founder</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="styles/images/tega1.jpg" alt="Jane" style="width:100%">
      <h3>Jane Doe</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="styles/images/man.png" alt="Mike" style="width:100%">
      <h3>Mike Ross</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <img src="styles/images/man2.png" alt="Dan" style="width:100%">
      <h3>Dan Star</h3>
      <p class="w3-opacity">Architect</p>
      <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
      <p><button class="w3-button w3-light-grey w3-block">Contact</button></p>
    </div>
  </div>

  <!-- Contact Section -->
  <div class="w3-container w3-padding-32" id="contact">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Contact</h3>
    <p>Lets get in touch and talk about your and our next project.</p>
    <form action="https://www.w3schools.com/action_page.php" target="_blank">
      <input class="w3-input" type="text" placeholder="Name" required name="Name">
      <input class="w3-input w3-section" type="text" placeholder="Email" required name="Email">
      <input class="w3-input w3-section" type="text" placeholder="Subject" required name="Subject">
      <input class="w3-input w3-section" type="text" placeholder="Comment" required name="Comment">
      <button class="w3-button w3-black w3-section" type="submit">
        <i class="fa fa-paper-plane"></i> SEND MESSAGE
      </button>
    </form>
  </div>
  
<!-- End page content -->
</div>

<!-- Google Map -->
<div id="googleMap" class="w3-grayscale" style="width:100%;height:450px;"></div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>Powered by <a href="default.html" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>

<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_architect&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 16:57:53 GMT -->
</html>

