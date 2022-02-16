
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright Â© 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('api/db.php');
session_start(); 
//redirecting user if Already logged in.
if(isset($_SESSION["id"])){
  header("Location: home");
} 

// If form submitted, insert values into the database.
 
if (isset($_SESSION['tries'])) {
    
  if ($_SESSION['tries'] > 4) {

    $dontTry = 1;

  }

} 
if (isset($_POST['submitLogin'])) { 

  echo '<script>loadSpin() <script> '; 
  sleep(0.3);

  if (isset($_SESSION['tries'])) {

    $_SESSION['tries'] = $_SESSION['tries'] + 1;

    if (isset($_SESSION['tries'])) {
  
      if ($_SESSION['tries'] > 8) {

        echo '
        
        <script> 
        
        document.getElementById("idInputButtonCentered").style.display = "none";

        </script>';
        
        $dontTry = 1;

        $_SESSION['lastTry'] = date("Y-m-d H:i:s");
        
        // $_SERVER['REMOTE_ADDR'];

      }

    }

  else {

    $_SESSION['tries'] = 0;

  }

} 
if (!isset($dontTry)) {
 
    # Publish-button was clicked  
    $email = stripslashes($_REQUEST['email']); 
    //escapes special characters in a string
    $email = mysqli_real_escape_string($con,$email); 

    $sanitized_a = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {
       
      $password = stripslashes($_REQUEST['password']);
      $password = mysqli_real_escape_string($con,$password);
      //Checking hash 
  
      $hash = $con->query("SELECT password FROM users WHERE email='$email';") or die($con->error);   
      while($row = mysqli_fetch_assoc($hash)) { 
          $passwdhashed = ($row['password']);
      }  
      if (!isset($passwdhashed)) {
        $passwdhashed = '';
      }
       
      if (password_verify($password, $passwdhashed)) { 
        $query = "SELECT * FROM `users` WHERE email='$email' and password='".$passwdhashed."'";
        $result = mysqli_query($con,$query) or die(mysqli_error($con)); 
        $rows = mysqli_num_rows($result);   
        if($rows==1){ 

              // Ban Check

              $sql2 = $con->query("SELECT id FROM users WHERE email='$email';") or die($con->error);   
              while($row = mysqli_fetch_assoc($sql2)) { 
                  $idforbancheck = ($row['id']);
              } 

              $sql3 = $con->query("SELECT id FROM bans WHERE userid='$idforbancheck';") or die($con->error);   
              while($row = mysqli_fetch_assoc($sql3)) { 
                  $idEmptyCheck = ($row['id']);
              }   
              if (isset($idEmptyCheck)) {
                if ($idEmptyCheck == 1) {
  
                  // Banned
  
                  echo '
          
                  <script> 
                  
                  $.ajax({url: "api/cooldownBanned", success: function(result){ 
                
                    $("#tooMuch").html(result); 
                    
                    var modal = document.getElementById("bannedBox");  
                    modal.style.display = "block"; 
              
                    var modal = document.getElementById("bannedBoxModal");  
                    modal.classList.add("push") ;
              
                    document.getElementById("body").style.overflow = "hidden";
                  
                  }});
          
                  
                  </script> 
          
                  ';
  
                }}
              
              
              else {

                // LOG IN.
 
                while($rows = mysqli_fetch_array($result)) {
                    $_SESSION['firstname'] = $rows['firstname']; 
                    $_SESSION['lastname'] = $rows['lastname'];
                    $_SESSION['username'] = $rows['username'];
                } 
                $_SESSION['email'] = $email;

                $sql = $con->query("SELECT id FROM users WHERE email='$email';") or die($con->error);   
                while($row = mysqli_fetch_assoc($sql)) { 
                    $param = ($row['id']);
                } 
                $_SESSION['id'] = $param; 

                $sql = $con->query("SELECT accountToken FROM users WHERE email='$email';") or die($con->error);   
                while($row = mysqli_fetch_assoc($sql)) { 
                    $accT = ($row['accountToken']);
                }  
    
                // Authentication cookie 
                setcookie("accountToken", $accT, time() + (86400 * 183), "/"); // 86400 = 1 day (x 183 thats a year)
    
                // Redirect user to home
                header("Location: home");
                exit; 
              }


          }
      }
      else {
          
        echo '<script>
        document.getElementById("idInputButtonCentered").style.display = "block";  
        document.getElementById("loadSpinner").style.display = "none";  
        document.getElementById("idInputButton").style.display = "block";
        <script>
        '; 
        echo " <script> document.getElementById('incorrect').style.visibility = 'visible'; </script>";
      }   
    } 
    else 
    {          
      echo '<script>
      document.getElementById("idInputButtonCentered").style.display = "block";  
      document.getElementById("loadSpinner").style.display = "none";  
      document.getElementById("idInputButton").style.display = "block";
      <script>
      '; 
      echo " <script> document.getElementById('incorrect').style.visibility = 'visible'; </script>";
    } 
} 
else {
          
  echo '<script>
  document.getElementById("idInputButtonCentered").style.display = "block";  
  document.getElementById("loadSpinner").style.display = "none";  
  document.getElementById("idInputButton").style.display = "block"; 

  <script>
  '; 
  echo " <script> document.getElementById('incorrect').style.visibility = 'visible'; </script>";
      
} 
} 
?>  

<style> 

@media only screen and (max-width: 800px) { 

  .mainform {
    margin-top:50%;
  }
  #idInputLog {
    width:100%;
    height:55px;
    font-size: 22px;
  }   
  #idInputButton { 
    display:none; 
  }
  #idInputButtonCentered { 
    display:block; 
    font-size:22px;
    margin-top: 30px;
    
  }
}

@media only screen and (min-width: 880px) { 
  #idInputLog {
  max-width:220px !important;
  }    

  #idInputButtonCentered { 
    display:none;
    
  }
} 
</style>

</style> 

<form class="mainform" action="" method="post" name="login"> 
  <input id="idInputLog" type="email" name="email" placeholder="Your Email" required />
  <input id="idInputLog" type="password" name="password" placeholder="Password" required />
  <?php // <p style='color:white;font-size:15px;'> Forgot Password </p> ?> 
  <?php 

  if (isset($_SESSION['lastTry'])) {


    $date1 = (DateTime::createFromFormat('Y-m-d H:i:s', ($_SESSION['lastTry'])));  
    $date2 = new DateTime(date("Y-m-d H:i:s"));
  
    $interval = $date1->diff($date2); 
    
//    echo $interval->s.' seconds<br>';

    if ($interval->s > 45) {

      unset ($_SESSION['lastTry']);
      unset ($dontTry);
      unset ($_SESSION['tries']);

    }
  
    if ($dontTry == 1) {

        $_SESSION['secondsTried'] = $interval->s ;
  
        echo '
        
        <script> 
        
        $.ajax({url: "api/cooldown", success: function(result){ 
      
          $("#tooMuch").html(result); 
          
          var modal = document.getElementById("cooldownBox");  
          modal.style.display = "block"; 
    
          var modal = document.getElementById("cooldownBoxModal");  
          modal.classList.add("push") ;
    
          document.getElementById("body").style.overflow = "hidden";
        
        }});

        
        </script> 

        ';
  
    }
  
  }

?>

<a onclick='loadSpin()'>
<button id="idInputButton" class="hoverAnimation" name="submitLogin" type="submit" value="Login" style=" font-size: 17px; margin-left: 5px; margin-top: 13px; cursor:pointer; background-color: transparent;color:white;border: 3px solid transparent;"  class="dropbtn">Login </button> <img id ='loadSpinner' src="image/load.gif" alt="Loading Gif" width="22" height="22" style ='margin:10px;margin-top:15px;float:right;display:none !important;'>   
<center> <button  id="idInputButtonCentered" class="hoverAnimation" name="submitLogin" type="submit" value="Login" style=" cursor:pointer; background-color: transparent;color:white;border: 3px solid transparent;"  class="dropbtn">Login </button> </center> 
</a>
 



</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 


<p style="font-size:15px;cursor:pointer; color:white; display:inline; "  id="forgot" > Forgot Password </p> 
<p style='color:white;font-size:15px;  visibility:hidden; display:inline;' id="incorrect">  · Incorrect details. Try again? </p>
<p style='color:white;font-size:15px;  visibility:hidden; display:inline;' id="banned">  · Banned </p>
<script> 

$(document).ready(function() { 

  if (window.location.hash == "#reset") { 
 
    $.ajax({url: "api/modalsForgotPassword", success: function(result){ 
      
      $("#forgotPs").html(result); 
      
      var modal = document.getElementById("forgotBox");  
      modal.style.display = "block"; 

      var modal = document.getElementById("forgotBoxModal");  
      modal.classList.add('push') ;

      document.getElementById("body").style.overflow = "hidden";
      
    
    }});

  }

  });
  
$("#forgot").click(function(){
  $.ajax({url: "api/modalsForgotPassword", success: function(result){ 
    
    $("#forgotPs").html(result); 
    
    var modal = document.getElementById("forgotBox");  
    modal.style.display = "block"; 

    var modal = document.getElementById("forgotBoxModal");  
    modal.classList.add('push') ;

    document.getElementById("body").style.overflow = "hidden";
    
  
  }});
});
</script> 

<div id="forgotPs"> </div>
<div id="tooMuch"> </div> 