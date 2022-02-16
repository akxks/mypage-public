
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<?php
require('api/db.php'); 
require('api/button.php'); 
require('api/lang.php'); 
session_start();
if(!isset($_SESSION["id"])){
  $_SESSION['id'] = 0; 
  $_SESSION['newuser'] = 1;
}
else {
  if($_SESSION['id'] !== 0) {
    unset($_SESSION['newuser']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">  
<head>
<meta
  name="description"           
  content="A new generation social media
          network built for Privacy, Security
          and communication.">
<link rel="manifest" href="manifest.json" crossorigin="use-credentials">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" /> 
<meta name="HandheldFriendly" content="true"> 
<meta name="theme-color" content="#ff2449"/>
<link rel="apple-touch-icon" href="/icons/apple-icon-180.png">
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body> 
<?php 
include("api/internetalive.php");
?> 

<div id='hider' class="wrapper hider">
<?php  
    if (!isset($_SESSION['newuser'])) { 
      include 'api/header.php'; 
    }
    else {
      include 'api/headernew.php';
    }
    ?> 
    <div class="main width-center">
        <div id="hideSmallerScreen" class="column" style=" width: 25% ; ">
          <div style="width:100%;max-width:350px; float:right;">
          </div>
        </div>
        <div id="hideSmallerScreenMain" class="column" style="width:50%">
         <div style="width:100%;max-width:500px;display: block;margin-left: auto;margin-right: auto;">
            <h2>Feedback</h2>  
            <p> To report bugs or give suggestions and feedback, fill out the form below. </p> 
            <div class="row">

            <script src="https://www.google.com/recaptcha/api.js"></script>

            <?php 
            // fetch FEEDBACK form

            require('api/db.php');  
 
            echo '
            <form action="api/sendfeedback" method="POST">  
            '; // HAS TO BE PLACED HERE FOR GOOGLE RECAPTCHA TO WORK

            echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   
 
            echo "<div class='systemcolor-Noborder feedbackpaddingforPhone' style='padding:40px;padding-bottom:0px;padding-top:0px;width:100%;'>";   
             
            
             if (isset($_GET['success'])) { echo ' <p> ✅ Your form has been sent  </p> '; }  
             if (isset($_GET['error'])) { echo '<p> ❌ The form has not been sent </p>'; } 


             if (!isset($_SESSION['newuser'])) { 
            
              $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($usernameReqe)) { 
              $requestedUsername = ($row['username']);
              } 

              $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($usernameReqe)) { 
              $requestedUsername = ($row['username']);
              } 
              
              $firstnameReqe = $con->query("SELECT firstname FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($firstnameReqe)) { 
              $requestedFirstname = ($row['firstname']);
              } 


              $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$_SESSION[id]'") or die($con->error); 
              while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
      
              echo "  <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '55px;' width='55px;' style='float:left;margin-top:20px;margin-right:20px;border-radius:50%;$marginImg' alt='Profile Picture'> </a> <br> <p>Giving feedback as $requestedFirstname </p> ";
              
              $lastnameReqe = $con->query("SELECT lastname FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($lastnameReqe)) { 
              $requestedLastname = ($row['lastname']);
              } 

              $emailReqe = $con->query("SELECT email FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($emailReqe)) { 
              $requestedEmailReqe = ($row['email']);
              } 

              $prefillName = $requestedFirstname . " ". $requestedLastname. " (@". $requestedUsername . ")" ;
              $prefillEmail = $requestedEmailReqe;

              echo '<br> 

              <input type="text" id="firstname" name="firstname" placeholder="Name" value="'.$prefillName.'" required> 
             
              <input type="email" id="email" name="email" placeholder="Email" value='.$prefillEmail.' required> 
              ';

             }
             else {

              echo '<br>
 
              <input type="text" id="firstname" name="firstname" placeholder="Name" required> 
             
              <input type="email" id="email" name="email" placeholder="Email" required> 
              ';
              
             }

            echo '  

            <br>
            <br>

            <label for="contactChoice1" style="margin-top:0px;">Bug</label>
            <input type="radio" id="contactChoice1"
            name="contactChoice2" value="phone">  


            <br>

            <br>

            <input type="radio" id="contactChoice2"
            name="contactChoice2" value="mail">  
            <label for="contactChoice2" style="margin-top:0px;">Suggestion</label>

              <br><br>
              
              <textarea type="text" spellcheck="true" autocomplete="off" type="posttext" maxlength="500" name="posttext" class="form-control" rows="2" id="postText" name="text" placeholder="Message" style="
              
              float: none;
              display: block;
              text-align: left;
              width: 305px ;
              margin: 0;
              padding: 14px;
              background-color: white;

              color: black;
              border: 1px solid #ccc;  
              border-radius:4px;
              font-size:15px;

              " required></textarea>
              <br> 
              
              <div class="g-recaptcha brochure__form__captcha" data-sitekey="6LdvZu0bAAAAAGHrhM7YE_OUBDpSZku003puvt0n"></div>

              <input type="submit" value="Submit" class="float">
          
            </form>

            '; 
            

            echo '</div>  ';  
 
            // fetch FEEDBACK form

            ?>


            </div>   
            <p style="text-decoration:none;color:gray;font-size:15px;">   <?php include('api/links.php'); ?>  </p>  
          </div>
        </div>
        </div> 
        <div id="hideSmallerScreen"  class="column" style="width:25%;">
        <div style="width:100%;max-width:350px; float:left;"> 
            </div> 
          </div>
        </div>
      </div>
    </div>
    </div> 
</div> 

<script type="text/javascript" src="api/mobilesupport"></script>  

</body>
</html>