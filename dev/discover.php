
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
<link rel="stylesheet" href="css/charts.min.css">
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body id="body"> 
<?php   
include('api/internetalive.php');
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
    <?php include 'api/button.php';?>

    <div class="main width-center" style = "margin-top:5vh;width: auto; max-width:1000px; border-radius:2px;"> 
    <div class="row">
    <?php
    $sessionUserID = $_SESSION['id'];   
    include 'api/getDiscover.php'; 
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