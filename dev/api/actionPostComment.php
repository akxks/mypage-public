
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');

if (!isset($sessionUserID)) { $sessionUserID = $_GET['session_id']; }  
  
$userIDPost = htmlspecialchars(stripslashes($_GET['userid_post'])); 
$postID = htmlspecialchars(stripslashes($_GET['post_id']));
$postLocation = htmlspecialchars(stripslashes($_GET['location']));
$postInteraction = htmlspecialchars(stripslashes($_GET['interaction']));

$requestedID = $userIDPost;

if (!is_numeric($sessionUserID)) {
   exit;
}

if (!is_numeric($postID)) {
   exit;
} 

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$accountToken = $_GET['account_token']; 

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

function mysqli_result($search, $row, $field){
   $i=0; while($results=mysqli_fetch_array($search)){
   if ($i==$row){$result=$results[$field];}
   $i++;}
   return $result;
} 

//checking if user has access to content.
$checkCredentials = $con->query("SELECT private FROM users WHERE id = $userIDPost;" ) or die($con->error); 
$checkC=mysqli_result($checkCredentials, 0, "private"); 
 
// if private, and if not friends, no access
if ($checkC == 1) { 
   
   // if not friends 
   $sqlCheckFriends = $con->query("SELECT userid FROM friends WHERE useridFriend = '$requestedID' AND userid = '$sessionUserID' AND friendstate = 'Friends';") or die($con->error);    
   while($row = mysqli_fetch_assoc($sqlCheckFriends)) {
      $friendsCheck = $row['userid'];
   }  
   if (!isset($friendsCheck)) {  
     exit;
   } 
 
} 
//if u blocked them, deny access
$sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$requestedID' AND useridBlocker = '$sessionUserID';" ) or die($con->error);  
$infoBlocked = array();

while($row = mysqli_fetch_assoc($sqlBlocked)) {
   $infoBlocked[] = array (
      array("UserID",$row['id']));
   }
if (!empty($infoBlocked)) {  
   exit;
}   

// if they blocked you, deny access
$sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$sessionUserID' AND useridBlocker = '$requestedID';" ) or die($con->error);  
$infoBlocked2 = array();

while($row = mysqli_fetch_assoc($sqlBlocked)) {
   $infoBlocked2[] = array (
      array("UserID",$row['id']));
   } 
if (!empty($infoBlocked2)) {  
   exit;
}   

// after checks: do the action

if ($postInteraction == "DeleteComment") {


   if ($userIDPost == $sessionUserID) { 
      $test = -1;
      $sql = "DELETE FROM comments WHERE id=$postID AND userId= $sessionUserID AND commentId = $test";  
      $sql2 = "DELETE FROM interactions WHERE postid=$postID AND userId = $sessionUserID AND type = 'Comment'";  

      if (($con->query($sql) === TRUE)) { 
         echo 'Success';
      }

      if (($con->query($sql2) === TRUE)) { 
         echo 'Success';
      }

   }

}

$sql = $con->query("SELECT userid FROM interactions WHERE postid = $postID AND `type` = '$postInteraction' AND userid = $sessionUserID AND comment = '1';" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) { 
   $action[] = array(array("UserID",$rowsID['userid'])); 
}  
if (empty($action)) { 
      $sql = $con->query("INSERT INTO `interactions`(`postid`, `userid`, `type`, `comment`, `create_date`) VALUES ('$postID','$sessionUserID','$postInteraction','1',NOW());" ) or die($con->error); 
      if ($postInteraction == "Like") {
         
         $sqlActionNumber = $con->query("SELECT likes FROM comments WHERE id = $postID;" ) or die($con->error); 
         $no=mysqli_result($sqlActionNumber, 0, "likes"); 
         $no = $no + 1;
         $con->query("UPDATE comments SET likes = $no WHERE id = $postID;" ) or die($con->error); 

      } 

      $sqlUserScore = $con->query("SELECT score FROM users WHERE id = $sessionUserID;" ) or die($con->error); 
      $no = mysqli_result($sqlUserScore, 0, "score"); 
      $no = $no + 1;
      $con->query("UPDATE users SET score = $no WHERE id = $sessionUserID;" ) or die($con->error); 
 
}
else { 
   $sql = $con->query("DELETE FROM interactions WHERE userid = '$sessionUserID' AND postid = '$postID' AND `type` = '$postInteraction' AND comment = '1';" ) or die($con->error); 
  
   if ($postInteraction == "Like") {
      $sqlActionNumber = $con->query("SELECT likes FROM comments WHERE id = $postID;" ) or die($con->error); 
      $no=mysqli_result($sqlActionNumber, 0, "likes"); 
      $no = $no - 1;
      $con->query("UPDATE comments SET likes = $no WHERE id = $postID;" ) or die($con->error); 
   } 

   $sqlUserScore = $con->query("SELECT score FROM users WHERE id = $sessionUserID;" ) or die($con->error); 
   $no = mysqli_result($sqlUserScore, 0, "score"); 
   $no = $no - 1;
   $con->query("UPDATE users SET score = $no WHERE id = $sessionUserID;" ) or die($con->error);  
}
?> 