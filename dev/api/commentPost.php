
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
require('db.php'); 

  $userid = $_POST['sessionuserid'];
  $postid = $_POST['postid'];
  $postLocation = $_POST['loc'];
 
  if (!is_numeric($postid)) {
    exit; 
  }

  if (!is_numeric($userid)) {
    exit; 
  }
 

  // ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

  $accountToken = $_POST['account_token']; 

  if(preg_match("^[a-z0-9]+$", $accountToken) != false) { exit; }

// dreamhost fucks up adds a space -- quick fix remove last char 
$accountToken= rtrim($accountToken, ", "); 
// dreamhost fucks up adds a space -- quick fix remove last char 

  $query = "SELECT `id` FROM `users` WHERE id='$userid' AND accountToken='$accountToken'";

  $result = mysqli_query($con,$query) or die(mysqli_error($con)); 

  $rows = mysqli_num_rows($result);  

  if($rows!=1){  
      echo ' Wrong credentials! '; 
      exit;
  } 
  
  // ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 
 
  $sqlSCORE = $con->query("SELECT score FROM users WHERE id = '$userid';" ) or die($con->error);  
  $scoreinfo = array(); 
  while($row = mysqli_fetch_assoc($sqlSCORE)) {
  $scoreinfo[] = array (array("Score",$row['score'])); } 
  $no = ($scoreinfo[0][0][1] + 3);
  $con->query("UPDATE users SET score = $no WHERE id = '$userid';") or die($con->error); 

  $userid = mysqli_real_escape_string($con,$userid); 
  $comments = 0;
  $shares = 0; 

  $post = stripslashes($_POST['commenttext']);
  $post = htmlspecialchars($post);
  $post = mysqli_real_escape_string($con,$post); 

  $create_date = date("Y-m-d H:i:s"); 
  $query = "INSERT into `comments` (userid, likes, dislikes, post, postId, commentId, create_date)
  VALUES ('$userid', 0, 0, '$post', '$postid', -1, '$create_date')";
  $result = mysqli_query($con,$query); 

  $fetchedCommentsSize = $con->query("SELECT comments FROM posts WHERE id = '$postid';" ) or die($con->error); 
  while($rowsID = mysqli_fetch_assoc($fetchedCommentsSize)) { $fetchedCommentsSizeReal = $rowsID['comments']; }  

  $query = "UPDATE `posts` SET comments = $fetchedCommentsSizeReal + 1 WHERE id = '$postid'";
  $result = mysqli_query($con,$query); 

  //if ($postLocation == "home") {
  //  header('Location:../home');
  //}
  //else {
  //  header("Location:../profile?id=$personId"); 
  //}  
 
?> 