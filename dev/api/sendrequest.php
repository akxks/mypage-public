
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id'];  
$requestedID = htmlspecialchars(stripslashes($_GET['request'])); 
 
if (!is_numeric($requestedID)) {
   exit;
}

$fromhome = $_GET['fromhome'];

//check if the person has not got a request from the requestedid.
$sqlCheck = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$sessionUserID' AND useridRequester = '$requestedID';") or die($con->error);    
while($row = mysqli_fetch_assoc($sqlCheck)) {
   $friends[] = array ( 
      array($row['useridRequester'])
    ); 
}
if (isset($friends)) { 
   if (isset($fromhome)) { header("Location:../home");    }
   else { 
      

      $usernameReqe = $con->query("SELECT username FROM users WHERE id='$requestedID';") or die($con->error);    
      while($row = mysqli_fetch_assoc($usernameReqe)) { 
         $requestedUsername = ($row['username']);
      } 

      header("Location:../profile?u=$requestedUsername"); }
   exit;
}
else {

   //check if the person has not sent a request from other device.
   $sqlCheck = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$requestedID' AND useridRequester = '$sessionUserID';") or die($con->error);    
   while($row = mysqli_fetch_assoc($sqlCheck)) {
      $friendsReqCheck[] = array ( 
         array($row['useridRequester'])
       ); 
   }
   if (isset($friendsReqCheck)) { 
      
      if (isset($fromhome)) { header("Location:../home");    }
      else { 
         

         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$requestedID';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
            $requestedUsername = ($row['username']);
         } 

         header("Location:../profile?u=$requestedUsername"); }
      exit;
   }

   $sql = "INSERT INTO requests (useridRequester, useridRequested, request_state, request_date, type) VALUES ($sessionUserID, $requestedID, 'Waiting', NOW(), 0)";
   if (mysqli_query($con, $sql)) { 
      if (isset($fromhome)) { header("Location:../home");    }
      else { 
         
         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$requestedID';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
            $requestedUsername = ($row['username']);
         } 
         
         header("Location:../profile?u=$requestedUsername"); }
    } else {
      exit;
      //echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>