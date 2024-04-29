
<?php

include_once('includes/dbcon.php');?>

<!DOCTYPE html>
<html>
<head>
	<title>
<?php if(isset($page_title)){echo "$page_title";}


?>


	</title>

		<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="extral/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="toastr.min.css">
  <link rel="stylesheet" type="text/css" href="styles/adjust.css">
  <script src="extral/jquery.min.js"></script>
<script src="extral/bootstrap.min.js"></script>
<script src="toastr.min.js"></script>
<link rel="stylesheet" href="extral/w3.css">
<script src="toastr.min.js"></script>
<!--reall one -->
<link rel="stylesheet" type="text/css" href="extral/font-awesome.4.7.0.css.font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



 <script src="js/myScript.js" type="text/javascript"></script>


</head>
<body>
  

<?php 




?>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
       
       
<?php
if (isset($_SESSION['authenticated'])):?>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">users <span class="caret"></span></a>
          <ul class="dropdown-menu">
<?php
$user_id =$_SESSION['auth_user']['id'];

  $select = mysqli_query($mysqli, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }

?>

    <li><a><?php   if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png" class="img-circle" style="width:30%;height:20%;margin-left:75px;justify-content:center;align-items: center;">';
         }else{
            echo '<img src="'.$fetch['image'].' "   class="img-circle"  style="width:30%;height:20%;margin-left:75px;justify-content:center;align-items: center;">';
         }
      ?></a></li>

           <li><a href="#"><h5>Hello Dear: <?=$_SESSION['auth_user']['username']; ?></h5></a></li>
          </ul>
        </li>
      
      <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
     </ul>
     <?php endif  ?>       

<?php
if (!isset($_SESSION['authenticated'])):?>
      <li class="active"><a href="index.php">Home</a></li>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">page <span class="caret"></span></a>
          <ul class="dropdown-menu">
           
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>

       
     
      </ul>
      <?php endif  ?>
<ul class="nav navbar-nav navbar-right">
         <li><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span>Dash-Board</a></li>

         <?php 
        

if(isset($_SESSION['authenticated'])){   
          echo'<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile page</a></li>'; 
          echo'<li><a href="update_profilephp"><span class="glyphicon glyphicon-user"></span> page</a></li>>';   
           echo'<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>'; 

         }

else{ 

 echo'<li ><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
     echo'<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>'; 
    

}



?>
    </ul>
    </div>
  </div>
</nav>




 






















  
        
<!--if(isset($_SESSION["username"])){

         echo" <li><a href='profile.php'><span class='glyphicon glyphicon-user'></span> profile page</a></li>";
        echo "<li><a href='includes/logout.inc.php'><span class='glyphicon glyphicon-log-in'></span> log out</a></li>";
      
}
else{
     echo" <li><a href='signup.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>";
        echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> log in</a></li>";
     

}

 if(isset($_SESSION['authenticated'])): ?>   







          <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile page</a></li>>   
           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
  
         

 
  (!isset($_SESSION['authenticated'])):?>

 <li ><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    

 



if(isset($_SESSION['authenticated'])){   
          echo'<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile page</a></li>>';   
           echo'<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>'; 

         }

else{ 

 echo'<li ><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
     echo'<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>'; 
    

}

        -->