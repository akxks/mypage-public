<?php
require('db.php');  
require('auth.php');
 
$sessionUserID = htmlspecialchars(stripslashes($_POST['session_id']));
$reported = htmlspecialchars(stripslashes($_POST['postid']));
$reportType = htmlspecialchars(stripslashes($_POST['report']));

if (!is_numeric($sessionUserID)) {
  exit; 
}

if (!is_numeric($reported)) {
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
 
  
$sql = $con->query("SELECT id FROM reports WHERE reporter = '$sessionUserID' AND reported = '$reported' AND reportType = true;" ) or die($con->error); 

while($rowsID = mysqli_fetch_assoc($sql)) { 
  $reports[] = array($rowsID['id']); 
} 
 

if (empty($reports)) { 
 
    //reportType 1 = post 
    $sessionUserID = intval($sessionUserID); 
    $reported = intval($reported);
    
    $sql = $con->query("INSERT INTO `reports`(`reportType`, `reporter`, `reported`, `reason`, `create_date`) VALUES (true, $sessionUserID, $reported, '$reportType', NOW()); " ) or die($con->error); 
    
    $notif = "You successfully reported " . $_SESSION['firstnameofReported']  ."s post ";

    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($sessionUserID,'ReportedPost','$notif','0',NOW());" ) or die($con->error);

    unset($_SESSION['firstnameofReported']);

    //header("Location:../home");
    // header("Location: ../profile?id=".$_GET['person'] ."");
 
}
else { // FAKE REPORT, DOESNT OVERLOAD DATABASE  WITH THEIR REPORT FROM same account
 
    //reportType 1 = post 
    $sessionUserID = intval($sessionUserID); 
    $reported = intval($reported);
    
    // $sql = $con->query("INSERT INTO `reports`(`reportType`, `reporter`, `reported`, `reason`, `create_date`) VALUES (true, $sessionUserID, $reported, '$reportType', NOW()); " ) or die($con->error); 
    
    $notif = "You successfully reported " . $_SESSION['firstnameofReported']  ."s post ";

    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($sessionUserID,'ReportedPost','$notif','0',NOW());" ) or die($con->error);
 
    //header("Location:../home");
    //header("Location: ../profile?id=".$_GET['person'] ."");
 
}
  

?>