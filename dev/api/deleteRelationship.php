
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id'];
$requester = htmlspecialchars(stripslashes($_GET['name']));

if (!is_numeric($requester)) {
    exit; 
} 

$sql = $con->query("DELETE FROM requests WHERE userIdRequester = '$requester' AND userIdRequested = '$sessionUserID' AND request_state = 'WaitingRelationship' " ) or die($con->error); 
$sql2 = $con->query("DELETE FROM requests WHERE userIdRequester = '$sessionUserID' AND userIdRequested = '$requester' AND request_state = 'WaitingRelationship' " ) or die($con->error); 

$relationshipId = -1;

$sql4 = $con->query("UPDATE users SET relationshipId = '$relationshipId' WHERE id = '$sessionUserID'" ) or die($con->error);  
$sql5 = $con->query("UPDATE users SET relationshipId = '$relationshipId' WHERE id = '$requester'" ) or die($con->error); 
 
$sqlDeletePostLover = $con->query("DELETE FROM posts WHERE userid = '$sessionUserID' AND type = '4' AND post = '$requester'" ) or die($con->error);  
$sqlDeletePostLover = $con->query("DELETE FROM posts WHERE userid = '$requester' AND type = '4' AND post = '$sessionUserID'" ) or die($con->error); 
 

$usernameReqe = $con->query("SELECT username FROM users WHERE id='$requester';") or die($con->error);    
while($row = mysqli_fetch_assoc($usernameReqe)) { 
  $requestedUsername = ($row['username']);
} 

header("Location:../profile?u=$requestedUsername");
?> 