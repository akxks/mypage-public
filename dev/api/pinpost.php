
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');   

$userid = htmlspecialchars(stripslashes($_POST['userid'])); 

$postID = htmlspecialchars(stripslashes($_POST['postid'])); 
  
if (!is_numeric($userid)) {
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

$query = "SELECT `id` FROM `users` WHERE id='$userid' AND accountToken='$accountToken'";

$result = mysqli_query($con,$query) or die(mysqli_error($con)); 

$rows = mysqli_num_rows($result);  

if($rows!=1){  
   echo ' Wrong credentials! '; 
   exit;
} 
 
// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$useridpostCheck = $con->query("SELECT userid FROM posts WHERE id = '$postID';" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($useridpostCheck)) { 
   $useridpost = $rowsID['userid']; 
} 

if ($userid == $useridpost) {   

   $checkPinPost = $con->query("SELECT userid FROM pinPosts WHERE postid = '$postID';" ) or die($con->error); 
   while($rowsID = mysqli_fetch_assoc($checkPinPost)) { 
      $checkPinPostFinal = $rowsID['userid']; 
   } 

   if (empty($checkPinPostFinal)) {

      $sql = $con->query("SELECT COUNT(*) AS postid FROM pinPosts WHERE userid = '$userid';") or die($con->error);    
         while($row = mysqli_fetch_assoc($sql)) { 
         $param = ($row['postid']);
      }  

      if ($param < 10) {
         
         $sql = $con->query("INSERT INTO `pinPosts`(`userid`, `postid`) VALUES ('$userid', '$postID');" ) or die($con->error); 

      }

   }

}
?> 