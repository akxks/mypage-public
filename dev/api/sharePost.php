
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
require('db.php');

if (isset($_POST['submit'])) {

  $userid = $_POST['sessionuserid'];
  $postid = $_POST['postid'];
  $postLocation = $_POST['loc'];

  if (!is_numeric($postid)) {
    exit; 
  }

  if (!is_numeric($userid)) {
    exit; 
  }

  $accountToken = $_COOKIE['accountToken']; 
     
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

  $userid = mysqli_real_escape_string($con,$userid);   
  $likes = 0;
  $comments = 0;
  $shares = 0;
  $dislikes = 0;
  $post = stripslashes($_REQUEST['sharetext']);
  $state = 'Public';
  $post = htmlspecialchars($post);
  $post = mysqli_real_escape_string($con,$post);
  $locationtext = NULL; 

  $create_date = date("Y-m-d H:i:s"); 
  $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
  VALUES ('$userid', '1', ' ', '$likes', '$comments', '$shares', '$dislikes', '$post', '$state', '$create_date', '$locationtext', 1, $postid)";
  $result = mysqli_query($con,$query); 

  $sqlActionNumber = $con->query("SELECT shares FROM posts WHERE id = $postid;" ) or die($con->error); 

  while($row = mysqli_fetch_assoc($sqlActionNumber)) { 
     $no = ($row['shares']);
  } 

  $no = $no + 1;
  
  $con->query("UPDATE posts SET shares = $no WHERE id = $postid;" ) or die($con->error); 

  if ($postLocation == "home") {
    header('Location:../home');
  }
  else {

    $usernameReqe = $con->query("SELECT username FROM users WHERE id='$personId';") or die($con->error);    
    while($row = mysqli_fetch_assoc($usernameReqe)) { 
      $requestedUsername = ($row['id']);
    } 

    header("Location:../profile?u=$requestedUsername"); 
  }  

}
?> 