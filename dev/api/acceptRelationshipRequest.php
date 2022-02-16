
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id']; 
$usernamesession = $_SESSION['username'];
$requester = htmlspecialchars(stripslashes($_POST['name']));

if (!is_numeric($requester)) {
    exit; 
}

$sql = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$sessionUserID' AND useridRequester = $requester AND request_state = 'WaitingRelationship';" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) { 
   $requests[] = array($rowsID['useridRequester']); 
}  
if (!empty($requests)) { 


    // CHECK IF ALL RELATIONSHIPS ARE ENABLED IN THEIR SETTINGS

    $sqlCheckRels = $con->query("SELECT disablerelationships FROM `settings` WHERE userid = '$sessionUserID';") or die ($con->error); 

    $sqlCheckRels2 = $con->query("SELECT disablerelationships FROM `settings` WHERE userid = '$requestedID';") or die ($con->error); 

    // if that person has rels enabled to 
    while($row = mysqli_fetch_assoc($sqlCheckRels)) {
    $sqlCheckRelse = $row['disablerelationships']; 

    }

    while($row = mysqli_fetch_assoc($sqlCheckRels2)) {
    $sqlCheckRels2e = $row['disablerelationships']; 
    }

    if ($sqlCheckRelse = 1) {


        $usernameReqe = $con->query("SELECT username FROM users WHERE id='$requestedID';") or die($con->error);    
        while($row = mysqli_fetch_assoc($usernameReqe)) { 
          $requestedUsername = ($row['username']);
        } 

        header("Location:../profile?u=$requestedUsername");  
        exit;

    }

    if ($sqlCheckRels2e = 1) {

        $usernameReqe = $con->query("SELECT username FROM users WHERE id='$requestedID';") or die($con->error);    
        while($row = mysqli_fetch_assoc($usernameReqe)) { 
          $requestedUsername = ($row['username']);
        } 
        
        header("Location:../profile?u=$requestedUsername");  
        exit;

    }


    $sql = $con->query("SELECT relationshipId FROM users WHERE id = '$sessionUserID';" ) or die($con->error); 
    while($rowsID = mysqli_fetch_assoc($sql)) { 
    $requests2[] = array($rowsID['useridRequester']); 
    } 
    if ($requests2 !== -1) { 
        $sql = $con->query("UPDATE users SET relationshipId = $requester WHERE id = $sessionUserID;" ) or die($con->error);
        $sql2 = $con->query("UPDATE users SET relationshipId = $sessionUserID WHERE id = $requester;" ) or die($con->error); 
    
        $notif = "". ("$usernamesession") . " accepted your love request!";
        $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($requester,'Lovers','$notif','0',NOW());" ) or die($con->error);

        // posting first 

        $userid = $_SESSION['id']; 

        $sqlSCORE = $con->query("SELECT score FROM users WHERE id = '$userid';" ) or die($con->error);  
        $scoreinfo = array(); 
        while($row = mysqli_fetch_assoc($sqlSCORE)) {
        $scoreinfo[] = array (array("Score",$row['score'])); } 
        $no = ($scoreinfo[0][0][1] + 2);
        $con->query("UPDATE users SET score = $no WHERE id = '$userid';") or die($con->error); 
    
        $userid = mysqli_real_escape_string($con,$userid);   
        $likes = 0;
        $comments = 0;
        $shares = 0;
        $dislikes = 0;
        $post = $requester;
        $state = 'Public'; 
        $locationtext = NULL; 
        $create_date = date("Y-m-d H:i:s"); 

        $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
        VALUES ('$userid', '4', ' ', '$likes', '$comments', '$shares', '$dislikes', '$post', '$state', '$create_date', '$locationtext', 0, 0)";

        $result = mysqli_query($con,$query); 
        
        // second post 
        $sqlSCORE = $con->query("SELECT score FROM users WHERE id = '$requester';" ) or die($con->error);  
        $scoreinfo = array(); 
        while($row = mysqli_fetch_assoc($sqlSCORE)) {
        $scoreinfo[] = array (array("Score",$row['score'])); } 
        $no = ($scoreinfo[0][0][1] + 2);
        $con->query("UPDATE users SET score = $no WHERE id = '$requester';") or die($con->error); 
    
        $requester = mysqli_real_escape_string($con,$requester);   
        $likes = 0;
        $comments = 0;
        $shares = 0;
        $dislikes = 0;
        $post = $_SESSION['id'];
        $state = 'Public'; 
        $locationtext = NULL; 
        $create_date = date("Y-m-d H:i:s"); 

        $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
        VALUES ('$requester', '4', ' ', '$likes', '$comments', '$shares', '$dislikes', '$post', '$state', '$create_date', '$locationtext', 0, 0)";

        $result = mysqli_query($con,$query); 

        include 'deleteRelationshipRequest.php';

        header('Location:'. $_SESSION['beforeurl'] .  ''); 
    }
    else {
        header('Location:'. $_SESSION['beforeurl'] .  ''); 
    }
}
else {
    header('Location:'. $_SESSION['beforeurl'] .  ''); 
}
?> 