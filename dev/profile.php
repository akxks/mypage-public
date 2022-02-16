
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
require('api/db.php'); 
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

<?php include_once("config/analyticstracking.php") ?>

</script>
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
<title><?php echo $lang_core_html_titles_profile;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body id="body">  
<div id='hider' class="wrapper hider">
    <?php  
    if (!isset($_SESSION['newuser'])) { 
      include 'api/header.php'; 
    }
    else {
      include 'api/headernew.php';
    }
    ?>
    <?php include 'api/button.php';?>

    <div class="main width-center" style = "margin-top:5vh;width: auto; max-width:1000px; border-radius:2px;"> 
    <div class="row">
    <?php
    $sessionUserID = $_SESSION['id'];  
    if(isset($_GET['u'])) {
    $requestedID = $_GET['u'];  
       if(1 === preg_match('~[0-9]~', $_GET['u'])){  
        $requestedID = 00;
     }  
     //anti sql inject
    if(preg_match("/^[a-zA-Z0-9]+$/", $requestedID) != 1) {
      // string does not contain the a to z , A to Z, 0 to 9
      $requestedID = 00;
    }  
    $checkUsername = $con->query("SELECT id FROM users WHERE username='$requestedID';") or die($con->error);    
    while($row = mysqli_fetch_assoc($checkUsername)) { 
      $requestedID = ($row['id']);
    } 


    }
    else {
    $requestedID = $sessionUserID;
    }  

    
    //if u blocked them, dont show  
    $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$requestedID' AND useridBlocker = '$sessionUserID';" ) or die($con->error);  
    $infoBlocked = array();
    
    while($row = mysqli_fetch_assoc($sqlBlocked)) {
       $infoBlocked[] = array (
          array("UserID",$row['id']));
       }
    if (!empty($infoBlocked)) { 
      echo ' <div class="card-no-hover systemcolor" style="height:90px; margin-top:110px;"> '; 
      echo ' <center> '.$lang_core_profile_notexist.' </center>';
      echo ' </div> ';   
      $blocked = 1;
    }   

    // if they blocked you, dont show. 
    $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$sessionUserID' AND useridBlocker = '$requestedID';" ) or die($con->error);  
    $infoBlocked2 = array();
    
    while($row = mysqli_fetch_assoc($sqlBlocked)) {
       $infoBlocked2[] = array (
          array("UserID",$row['id']));
       } 
    if (!empty($infoBlocked2)) { 
      echo ' <div class="card-no-hover systemcolor" style="height:90px; margin-top:110px;"> '; 
      echo ' <center> '.$lang_core_profile_notexist.' </center>';
      echo ' </div> '; 
      $blocked = 1;
    }   
    // if their account doesnt exist.
    $sql = $con->query("SELECT id,firstname,lastname,bio,create_date,verified,private,birthday,score,location,username FROM users WHERE id = '$requestedID';" ) or die($con->error);  
    $info = array();
    
    while($row = mysqli_fetch_assoc($sql)) {
       $info[] = array (
          array("UserID",$row['id']),
          array("Firstname",$row['firstname']),
          array("Lastname",$row['lastname']),
          array("Bio",$row['bio']), 
          array("CreateDate",$row['create_date']),
          array("Verified",$row['verified']),
          array("Private",$row['private']),
          array("Birthday",$row['birthday']),
          array("Score",$row['score']),
          array("Location",$row['location']),
          array("Username",$row['username'])
        ); 
    }
    if (empty($info)) { 
      echo ' <div class="card-no-hover systemcolor" style="height:90px; margin-top:110px;"> '; 
      echo ' <center> '.$lang_core_profile_notexist.' </center>';
      echo ' </div> ';   
    }  
    else {
      if ($blocked != 1) {
        include 'api/getprofile.php';
      } 
    } 
    ?> 

    <div class='footermargin'> 
    <?php  
    if (!isset($_SESSION['newuser'])) { 
      include 'api/mobilefooter.php';
    } 
    ?> 
  
  </div>
    
</div> 
</div> 
<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>