
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');
$sessionUserID = htmlspecialchars(stripslashes($_POST['session_id']));  
$commentid = htmlspecialchars(stripslashes($_POST['comment_id'])); 
$postid =  htmlspecialchars(stripslashes($_POST['post_id'])); 

if (!is_numeric($sessionUserID)) {
   exit; 
}

if (!is_numeric($commentid)) {
   exit; 
}  
 
if (!is_numeric($postid)) {
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
 
$sql = "DELETE FROM comments WHERE id = $commentid";  

$sqlActionNumber = $con->query("SELECT comments FROM posts WHERE id = $postid;" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sqlActionNumber)) { 
   $no = $rowsID['comments']; 
}   

$no = $no - 1;

$con->query("UPDATE posts SET comments = $no WHERE id = $postid;" ) or die($con->error); 

if (($con->query($sql) === TRUE)) {  
   //finished deletion 
   exit;
} else {
   exit;
} 

?> 