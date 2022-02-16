
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');

$sessionUserID = htmlspecialchars(stripslashes($_GET['userid']));
$word = htmlspecialchars(stripslashes($_GET['word']));

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
  
$sql = $con->query("SELECT id FROM blockedWords WHERE userid = '$sessionUserID' AND word = '$word';" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) { 
   $blocked[] = array($rowsID['id']); 
}  
 
if (!empty($blocked)) {   
 
        echo $word;
        $sql = $con->query("DELETE FROM `blockedWords` WHERE userid = $sessionUserID AND word = '$word'; " ) or die($con->error);   
 

}
else {
    exit;  
}
?> 