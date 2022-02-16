
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');   

$sessionUserID = htmlspecialchars(stripslashes($_POST['userid']));
$userIDPost = htmlspecialchars(stripslashes($_POST['useridpost']));
$postID = htmlspecialchars(stripslashes($_POST['postid'])); 
  
if (!is_numeric($userIDPost)) {
   exit; 
}

if (!is_numeric($postID)) {
   exit; 
} 

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$accountToken = $_POST['account_token']; 

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

if ($userIDPost == $sessionUserID) {   
   

 // remove - 1 from shared post 
   $sharedPostid = $con->query("SELECT sharePostid FROM posts WHERE id = $postID;" ) or die($con->error); 

   while($row = mysqli_fetch_assoc($sharedPostid)) { 
      $sharedpostidReal = ($row['sharePostid']);
   }  

   $sqlActionNumber = $con->query("SELECT shares FROM posts WHERE id = $sharedpostidReal;" ) or die($con->error); 

   while($row = mysqli_fetch_assoc($sqlActionNumber)) { 
      $no = ($row['shares']);
   } 
   
   $no = $no - 1;
   
   $con->query("UPDATE posts SET shares = $no WHERE id = $sharedpostidReal;" ) or die($con->error); 
   
   // remove - 1 from shared post 


   $deleteContent = $con->query("SELECT imgurl FROM posts WHERE id = '$postID';" ) or die($con->error); 
   while($rowsID = mysqli_fetch_assoc($deleteContent)) { 
      $contenturl[] = array(array("Contenturl",$rowsID['imgurl'])); 
   } 
   unlink("../".$contenturl[0][0][1]);  
   $sql = "DELETE FROM posts WHERE id=$postID";  
   $sql2 = "DELETE FROM interactions WHERE postid=$postID";  
   if (($con->query($sql) === TRUE) && ($con->query($sql2) === TRUE)) { 

      exit;
   
   }

}
?> 