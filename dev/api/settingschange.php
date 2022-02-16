
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php  
require('db.php'); 
require('auth.php'); 

$sessionUserID = $_SESSION['id'];

if (!isset($sessionUserID)) { $sessionUserID = $_GET['session_id']; } 

$setting = $_GET['setting']; 
 
if (!is_numeric($sessionUserID)) {
   exit;
}

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$accountToken = $_COOKIE['accountToken']; 

if(preg_match("^[a-z0-9]+$", $accountToken) != false) { exit; }

// dreamhost fucks up adds a space -- quick fix remove last char 
$accountToken= rtrim($accountToken, ", "); 
// dreamhost fucks up adds a space -- quick fix remove last char 

$query = "SELECT `id` FROM `users` WHERE id='$sessionUserID' AND accountToken='$accountToken'";

$result = mysqli_query($con,$query) or die(mysqli_error($con)); 

$rows = mysqli_num_rows($result);  

if($rows!=1){  
    echo ' Wrong credentials! '; 
    exit;
} 

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

if ($setting == "hideAcc") {

   $sessionUserID = $_SESSION['id']; 

   $sql = $con->query("SELECT `hideAccount` FROM users WHERE id = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['hideAccount'];
   } 
   if ($preference == 0) {
      $preference = 1; 
   }
   else {
      $preference = 0; 
   } 

   $sqlupdate = $con->query("UPDATE users SET `hideAccount` = '$preference' WHERE id = '$sessionUserID';") or die ($con->error); 

   header("Location: ../settings?privacy");  
}

elseif ($setting == "changeprivate") {
   $sessionUserID = $_SESSION['id']; 
   $sql = $con->query("SELECT `private` FROM users WHERE id = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['private'];
   } 
   if ($preference == 0) {
      $preference = 1; 
   }
   else {
      $preference = 0; 
   }   
   $sqlupdate = $con->query("UPDATE users SET `private` = '$preference' WHERE id = '$sessionUserID';") or die ($con->error); 
   header("Location: ../settings?privacy");  
}


elseif ($setting == "likedposts") {
   $sessionUserID = $_SESSION['id']; 
   $sql = $con->query("SELECT `likedposts` FROM settings WHERE userid = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['likedposts'];
   } 
   if ($preference == 0) {
      $preference = 1; 
   }
   else {
      $preference = 0; 
   }   
   $sqlupdate = $con->query("UPDATE settings SET `likedposts` = '$preference' WHERE userid = '$sessionUserID';") or die ($con->error); 
   header("Location: ../settings?privacy");  
}

elseif ($setting == "disablerelationships") {
   $sessionUserID = $_SESSION['id']; 

   $sql = $con->query("SELECT `disablerelationships` FROM settings WHERE userid = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['disablerelationships'];
   } 
   if ($preference == 0) {
      $preference = 1; 
   }
   else {
      $preference = 0; 
   }   
   $sqlupdate = $con->query("UPDATE settings SET `disablerelationships` = '$preference' WHERE userid = '$sessionUserID';") or die ($con->error); 

   //deleteing existing rel

   $sql = $con->query("SELECT relationshipId FROM users WHERE id = '$sessionUserID';" ) or die($con->error); 
   
   while($rowsID = mysqli_fetch_assoc($sql)) { 
      $relationship = $rowsID['relationshipId']; 
   } 
 
   $sql = $con->query("DELETE FROM requests WHERE userIdRequester = '$relationship' AND userIdRequested = '$sessionUserID' AND request_state = 'WaitingRelationship' " ) or die($con->error); 
   $sql2 = $con->query("DELETE FROM requests WHERE userIdRequester = '$sessionUserID' AND userIdRequested = '$relationship' AND request_state = 'WaitingRelationship' " ) or die($con->error); 
   
   $relationshipId = -1;
   
   $sql4 = $con->query("UPDATE users SET relationshipId = '$relationshipId' WHERE id = '$sessionUserID'" ) or die($con->error);  
   $sql5 = $con->query("UPDATE users SET relationshipId = '$relationshipId' WHERE id = '$relationship'" ) or die($con->error); 
    
   $sqlDeletePostLover = $con->query("DELETE FROM posts WHERE userid = '$sessionUserID' AND type = '4' AND post = '$relationship'" ) or die($con->error);  
   $sqlDeletePostLover = $con->query("DELETE FROM posts WHERE userid = '$relationship' AND type = '4' AND post = '$sessionUserID'" ) or die($con->error); 

   unset($relationship);
   header("Location: ../settings?privacy");  
}


?> 