
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

$sql = $con->query("SELECT id FROM blocked WHERE useridblocked = '$requester' AND useridBlocker = $sessionUserID;" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) { 
   $blocked[] = array($rowsID['useridRequester']); 
}  

if (!empty($blocked)) {  
    if ($sessionUserID != $requester) {
        $sql = $con->query("DELETE FROM `blocked` WHERE useridblocked = '$requester' AND useridBlocker = $sessionUserID;" ) or die($con->error); 
        header("Location:../settings?blockedusers");
    }
}
else {
    exit; 
}
?> 