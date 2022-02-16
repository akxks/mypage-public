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
<title>Reset </title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 

</head>  

<body id="body">

<?php

$getToken = $_GET['t'];

//if token not set
if (!isset($getToken)) {
  header("Location: first");  exit; 
}

//if token is NOT a token A-z-0-9
if(preg_match("^[a-z0-9]+$", $getToken) != false) {  header("Location: first");   exit; }

//if TOKEN is not in DB
$query = "SELECT `id` FROM `resetPassword` token='$getToken'";

$result = mysqli_query($con,$query) or die(mysqli_error($con)); 

$rows = mysqli_num_rows($result);  

if($rows!=1){   
  header("Location: first"); exit;
} 

//if token is NOT older than  48 hours

/// do that here

?> 

<div class='card' style='background-image: linear-gradient(#ff3b5c, #de1641);  border-radius: 5px; height:70px !important;'> 
 
<div id = "middlebox">
<a href="home"> <img class="nodrag" id="logo" src="image/logo.png" height= "auto;" width="125px;" style="
   text-align: center;
   display: block; margin-left: auto; margin-right: auto;  padding-top:15px !important;   -webkit-tap-highlight-color: transparent;
outline: none;
-ms-touch-action: manipulation;
touch-action: manipulation; " alt="Logo"> </img>

</a>  
</div>  
</div>  


<div id="mainnophone"> 
 
  <div class="main width-center" style = "margin-top:40px;width: auto;overflow: hidden;border: 0px solid red; padding-top:20px; height: 55%;  "> 

    <div class="column " style=" max-width:700px;border: 0px solid red;  "> 
    
        <h2>Reset Password </h2> 
        <p>Just type in a new password, and you will be <br>ready to go back in to your account. </p>   
       
         <form name="resetPass" action="" method="post">

            <input id="idInput" type="password" name="password" placeholder="New Password" required />
            <input class="float" style=" width: 305px;" type="submit" name="submitRegister" value="Change Password" />  
            <input id="idInput" type="radio" name="logoutofallotherdevices" value="logout" />  Log out of all other Devices

          </form>


            <?php 

            if (isset($_REQUEST['password'])) {

             if ((strlen($_REQUEST['password'])) < 4) {
                echo " <h3>Password must be at least 4 characters.</h3> ";  
             } 

              else {
                
                  $newpasswordConfirm = stripslashes($_REQUEST['password']);
                  $newpasswordConfirm = htmlspecialchars($password);
                  $newpasswordConfirm = mysqli_real_escape_string($con,$password);
          
                  $sql = "UPDATE users SET password = '".password_hash($newpasswordConfirm, PASSWORD_DEFAULT)."' WHERE id = '$sessionUserID'";

                  if ($answer == "logout") {          
                    
                      $token = bin2hex(random_bytes(360/2)); 
            
                      setcookie("accountToken", "", time() - 3600); // delete cookie
          
                      setcookie("accountToken", $token, time() + (86400 * 183), "/"); // 86400 = 1 day (x 183 thats a year) // MAKE NEW COOKIE WITH NEW TOKEN
          
                      $sql = "UPDATE users SET accountToken = '$token' WHERE id = '$sessionUserID'";
          
                  } 
          
                  if (mysqli_query($con, $sql)) { // Success.
                
                    $sql = $con->query("SELECT id FROM users WHERE email='$email';") or die($con->error);   
                    while($row = mysqli_fetch_assoc($sql)) { 
                        $param = ($row['id']);
                    } 
                    
                    $_SESSION['id'] = $param; 

                    header("Location:../home"); 
                
                  }

             }


            }

            ?> 
        
      </div> 

  </div>

  <br>
  <hr>
  <br>
  
  <center> <?php include('api/links.php'); ?> </center>

</div>  


<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>