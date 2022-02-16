
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id'];
$username = $_SESSION['username'];

$requester = htmlspecialchars(stripslashes($_POST['name']));

if (!is_numeric($requester)) {
    exit; 
}

$sql = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$sessionUserID' AND useridRequester = $requester;" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) { 
   $requests[] = array($rowsID['useridRequester']); 
}  
if (!empty($requests)) { 
    $sql = $con->query("INSERT INTO `friends`(`userid`, `useridFriend`, `friendstate`, `since_date`) VALUES ($requester,$sessionUserID,'Friends',NOW());" ) or die($con->error); 
    $sql2 = $con->query("INSERT INTO `friends`(`userid`, `useridFriend`, `friendstate`, `since_date`) VALUES ($sessionUserID,$requester,'Friends',NOW());" ) or die($con->error);
    $notif = "". ("$username") . " accepted your friend request!";
    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($requester,'Friends','$notif','0',NOW());" ) or die($con->error);
    include 'deleterequest.php';
    //header("Location:../home");
    header('Location:'. $_SESSION['beforeurl'] . ''); 
}
else {
    //header("Location:../home"); 
    header('Location:'. $_SESSION['beforeurl'] . ''); 
}
?> 