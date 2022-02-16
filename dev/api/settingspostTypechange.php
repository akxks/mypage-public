
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
 
$sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
while($row = mysqli_fetch_assoc($sql)) {
   $preference = $row['feedtype'];
}
if ($preference == 0) {
   $preference = 1;
   echo '<button id="changefeed" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;padding:none !important;">💭</button>';
}
else {
   $preference = 0;
   echo '<button id="changefeed" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;padding:none !important;">💫</button>';
}
 
$sqlupdate = $con->query("UPDATE users SET feedtype = '$preference' WHERE id = '$sessionUserID';") or die ($con->error); 

?> 