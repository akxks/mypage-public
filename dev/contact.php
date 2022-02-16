
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
         <div style="width:100%;max-width:600px;display: block;margin-left: auto;margin-right: auto;">
            <h2>Contact</h2>  
            <p> To report bugs or give suggestions and feedback, go to <a href='feedback'> feedback. </a> To contact us for any other reasons, fill out the form below. </p> 
            <div class="row">

            <script src="https://www.google.com/recaptcha/api.js"></script>

            <?php 
            // fetch FEEDBACK form

            require('api/db.php');  
 
            echo '
            <form action="api/sendfeedback" method="POST">  
            '; // HAS TO BE PLACED HERE FOR GOOGLE RECAPTCHA TO WORK

            echo "<div id='colorC' class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   
 
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
      
              echo "  <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '55px;' width='55px;' style='float:left;margin-top:20px;margin-right:20px;border-radius:50%;$marginImg' alt='Profile Picture'> </a> <br> <p>Contacting us as $requestedFirstname. </p> ";
              
              $lastnameReqe = $con->query("SELECT lastname FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($lastnameReqe)) { 
              $requestedLastname = ($row['lastname']);
              } 

              $emailReqe = $con->query("SELECT email FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($emailReqe)) { 
              $requestedEmailReqe = ($row['email']);
              } 

              $prefillName = $requestedFirstname . " ". $requestedLastname. " (@". $requestedUsername . ")" ;
              $prefillNameForverif = $requestedFirstname . " ". $requestedLastname .  "  <p style='color:gray;display:inline-block;'>  @". $requestedUsername . " </p>" ;
              $prefillEmail = $requestedEmailReqe;

              echo '<br>

              <input type="text" id="firstname" name="firstname" placeholder="Name" value="'.$prefillName.'" required> 
             
              <input type="email" id="email" name="email" placeholder="Email" value='.$prefillEmail.' required> 
              ';

             }
             else {

              echo '<br>

              <p> If you are logged in, it is easier for us to help you and contact you. <a href="first"> Login here </a>. </p>
 
              <input type="text" id="firstname" name="firstname" placeholder="Name" required> 
             
              <input type="email" id="email" name="email" placeholder="Email" required> 
              ';
              
             }

            echo '  

            <br>             
              <p style="font-size:15px; padding-left:3px;"> Contact Type</p> 
              <select onChange="dropdownTip(this.value)" name="helpType" id="helpType" style="
              float: none; 
              text-align: left;
              width: 305px ;
              margin: 0;
              padding: 10px;
              background-color: white;

              color: black;
              border: 1px solid #ccc;  
              border-radius:4px;
              font-size:15px;
">
                <option value="none">None</option>
                <option value="removal">Content Removal Request</option>
                <option value="copyright">Copyright</option>
                <option value="payments">Payment Billing</option>
                <option value="ban">Account Banned</option>
                <option value="verify">Verify My Account</option>
                <option value="email">Email Enquiries</option>
                <option value="media">Press/Media Enquiries</option>
              </select>    
            <br> 

              <script type="text/javascript">
              function dropdownTip(value){ 

                if (value == "email") { 
                  document.getElementById("result").innerHTML = "";

                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 
                  document.getElementById("resultVerif").style.display = "none";
                }; 

                if (value == "removal") { 
                  document.getElementById("result").innerHTML = "<br>We take content removal very seriously and our team is always working to remove any content that is illegal and goes against our Terms of Service and Community Guidelines. Please provide as much information as you can, your report is confidential and no one else will see your report, we will make sure to protect your details. When you are reporting a user or a post, your report is confidential and is not seen by the other user. <br> <br> Please continue filling out the form below if you think that you are the victim of: <br> • Illegal Content <br> • Non consentual Production or distribution of your image <br> • Content that can personally identify you such as Names, email addresses, IPs and more. <br><br> If your Content removal is about something else, such as giving feedback, or a copyright issue, or reporting a specific post or a person, use our other features such as (reporting posts/users by going to their profile and pressing the three dots) or by giving us feedback here, or about copyright issues (select Copyright) from the dropdown list above. <br> <br><b> By filling out the form below, you agree to our Terms of Service and Community Guidelines and you understand and read all of the above text, and wish to continue to report content that violates our Community Guidelines. </b>";
                  document.getElementById("contenturi").style.display = "block"; 
                  document.getElementById("contenturi2").style.display = "block"; 

                  document.getElementById("resultVerif").style.display = "none";
                }; 

                if (value == "verify") { 
                  document.getElementById("result").innerHTML = "<br><p> By filling out the form below you are requesting a Verification Badge to your profile and you agree with the Terms of Service and Community Guidelines.  <br> <br> Make sure that before filling out a form you have: not received any warnings or bans on your account. Otherwise, your appeal might get rejected and you will not be able to resend a request.<br><br> Tip: your appeal has a higher chance of being accepted if you have many followers and a high profile score. <br> <br> When you receive a Verification Badge, it will look like this: </p> ";

                  document.getElementById("resultVerif").style.display = "block";
                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 

                }; 
                if (value == "ban") { 
                  document.getElementById("result").innerHTML = "<br><p> By filling out the form below you agree that you have not violated our community guidelines and you agree that this is the first time you are filling out the form, we will review the form and if we think that you have violated the community guidelines, we will not reinstate your account and all of its contents will be deleted forever, without any more appeals. </p> <p> Please send us a detailed message so we can quickly and easily help you deal with the account suspension, as your account will automatically be deleted by the system if you do not send us an appeal. If you have any further details to discuss or ask, please write it, as it is your one and only chance.  </p>";

                  document.getElementById("resultVerif").style.display = "none";
                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 

                }; 

                if (value == "copyright") { 
                  document.getElementById("result").innerHTML = "";

                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 
                  document.getElementById("resultVerif").style.display = "none";
                }; 


                if (value == "payments") { 
                  document.getElementById("result").innerHTML = "";

                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 
                  document.getElementById("resultVerif").style.display = "none";
                }; 

                if (value == "media") { 
                  document.getElementById("result").innerHTML = "";

                  document.getElementById("contenturi").style.display = "none";
                  document.getElementById("contenturi2").style.display = "none"; 
                  document.getElementById("resultVerif").style.display = "none";
                }; 

              }</script>
   
            <div id="result"></div>
            <div id="resultVerif" style="display:none"> 
            <img class="float nodrag imageshadow" src="'.$contenturlimg.'" height= "45px;" width="45px;" style="float:left;margin-top:20px;margin-right:20px;border-radius:50%;" alt="Profile Picture"> </a> <br> <p style="display:inline-block;"> </p> '.$prefillNameForverif.' <img class="float nodrag imageshadow" src="image/verified.png" height= "20px;" width="20px;" style=";margin-top:0px;margin-right:20px;border-radius:50%;display:inline-block;" alt="Verif Badge "> 
            <p> To get verified easier, in your message below talk about yourself and other social media accounts you own, with appropriate links. Look out for an email message from us after you have sent your request. </p>
            </div>

            <br>

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
              
              <textarea id="contenturi" type="text" spellcheck="true" autocomplete="off" type="posttext" maxlength="500" name="posttext" class="form-control" rows="2" name="text" placeholder="URL (Link) of the content that you are reporting" style="
               
              float: none;
              display: none;
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

              <br id="contenturi2" style="display:none;">
              

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