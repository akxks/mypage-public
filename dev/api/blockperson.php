
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

if (empty($blocked)) {  
    if ($sessionUserID != $requester) {
        
        $sql = $con->query("SELECT relationshipId FROM users WHERE id = '$requester';" ) or die($con->error);  
        $info = array();
        
        while($row = mysqli_fetch_assoc($sql)) {
           $info[] = array ( 
              array("Relationshipid",$row['relationshipId'])
            ); 
        } 
 
        if ($info[0][0][1] == $_SESSION['id']) {
        
            $sql = $con->query("INSERT INTO `blocked`(`useridblocked`, `useridBlocker`, `since_date`) VALUES ($requester,$sessionUserID,NOW());" ) or die($con->error); 
        
            $sqldeletefriend = $con->query("DELETE FROM friends WHERE userid = '$requester' AND useridFriend = '$sessionUserID'" ) or die($con->error); 
            $sqldeletefriend2 = $con->query("DELETE FROM friends WHERE userid = '$sessionUserID' AND useridFriend = '$requester'" ) or die($con->error); 
    
            //removing relationship + friend 
            $sqldeletrequest = $con->query("DELETE FROM requests WHERE useridRequester = '$sessionUserID' AND useridRequested = '$requester'" ) or die($con->error); 
            $sqldeletrequest = $con->query("DELETE FROM requests WHERE useridRequester = '$requester' AND useridRequested = '$sessionUserID'" ) or die($con->error);  

            //removing relationship 
            $relationshipId = -1;
            
            $sql4 = $con->query("UPDATE users SET relationshipId = $relationshipId WHERE id = $sessionUserID" ) or die($con->error);  
            $sql5 = $con->query("UPDATE users SET relationshipId = $relationshipId WHERE id = $requester" ) or die($con->error); 

            header("Location:../home?successblock");
        }

        else { 
        
            $sql = $con->query("INSERT INTO `blocked`(`useridblocked`, `useridBlocker`, `since_date`) VALUES ($requester,$sessionUserID,NOW());" ) or die($con->error); 
        
            $sqldeletefriend = $con->query("DELETE FROM friends WHERE userid = '$requester' AND useridFriend = '$sessionUserID'" ) or die($con->error); 
            $sqldeletefriend2 = $con->query("DELETE FROM friends WHERE userid = '$sessionUserID' AND useridFriend = '$requester'" ) or die($con->error); 
    
            $sqldeletrequest = $con->query("DELETE FROM requests WHERE useridRequester = '$sessionUserID' AND useridRequested = '$requester'" ) or die($con->error); 
            $sqldeletrequest = $con->query("DELETE FROM requests WHERE useridRequester = '$requester' AND useridRequested = '$sessionUserID'" ) or die($con->error);  

            header("Location:../home?successblock");
        }

    }
}
else {
    exit;  
}
?> 