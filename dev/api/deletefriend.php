
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

$sql = $con->query("DELETE FROM friends WHERE userid = '$requester' AND useridFriend = '$sessionUserID' " ) or die($con->error); 
$sql2 = $con->query("DELETE FROM friends WHERE userid = '$sessionUserID' AND useridFriend = '$requester' " ) or die($con->error); 


$usernameReqe = $con->query("SELECT username FROM users WHERE id='$requester';") or die($con->error);    
while($row = mysqli_fetch_assoc($usernameReqe)) { 
  $requestedUsername = ($row['username']);
} 

header("Location:../profile?u=$requestedUsername");
?> 