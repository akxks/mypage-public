
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
require('email/phpmail.php');
require('email/deleteAccountVerify.php');

$to = "sorrydreamy@gmail.com";
$type 'deleteAccountVerify';
$message = $message;

sendMail($message, $to, $type); 

function deleteAccount() { 

  $sessionUserID = $_SESSION['id'];

  $sql = $con->query("DELETE FROM users WHERE id = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM posts WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM hidePosts WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM pinPosts WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM reports WHERE reporter = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM interactions WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM shared WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM notifications WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM friends WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM friends WHERE useridFriend = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM blocked WHERE useridBlocker = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM blocked WHERE useridblocked = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM blockedWords WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM requests WHERE useridRequester = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM requests WHERE useridRequested = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM comments WHERE userid = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM invites WHERE codemaker = '$sessionUserID'") or die($con->error); 
  
  $sql = $con->query("DELETE FROM settings WHERE userid = '$sessionUserID'") or die($con->error); 
  
  session_start(); 
  if(session_destroy()) { 
    header("Location:../first#deletedAccount");
  exit; }  
  
} 

?> 