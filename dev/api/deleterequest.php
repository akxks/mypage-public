
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php'); 
$sessionUserID = $_SESSION['id'];
$requester = htmlspecialchars(stripslashes($_POST['name']));

if (!is_numeric($requester)) {
   exit; 
} 

$sql = "DELETE FROM requests WHERE userIdRequester =$requester AND userIdRequested =$sessionUserID AND request_state = 'Waiting'";  
if ($con->query($sql) === TRUE) {
   header('Location:'. $_SESSION['beforeurl'] . ''); 
   exit;
} else {
   exit;
}

?> 