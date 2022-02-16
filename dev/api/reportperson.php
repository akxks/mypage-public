<?php
require('db.php');  
require('auth.php');

if (isset($_POST['submitReport'])) { 
  if (isset($_GET['person'])) {    
      if (isset ($_REQUEST['report'])) {  

          $sessionUserID = $_SESSION['id']; 
          $reported = htmlspecialchars(stripslashes($_GET['person']));
 
          if (!is_numeric($reported)) {


            $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_GET[person]';") or die($con->error);    
            while($row = mysqli_fetch_assoc($usernameReqe)) { 
              $requestedUsername = ($row['username']);
            } 


            header("Location: ../profile?u=".$requestedUsername ."");
            exit; 
          }

          $reportType = $_REQUEST['report']; 
          
          //if ($reportType !== "spam" || "hacked" || "pretend" || "hateful" || "harmful") {
          //  header("Location: ../proBfile?id=".$_GET['person'] ."");
          //  exit; 
          //}
           
          $sql = $con->query("SELECT id FROM reports WHERE reporter = '$sessionUserID' AND reported = '$reported';" ) or die($con->error); 
          while($rowsID = mysqli_fetch_assoc($sql)) { 
            $reports[] = array($rowsID['id']); 
          }  
          if (empty($reports)) { 

              //reportType 1 = post 
              $sessionUserID = intval($sessionUserID); 
              $reported = intval($reported);
              
              $sql = $con->query("INSERT INTO `reports`(`reportType`, `reporter`, `reported`, `reason`, `create_date`) VALUES (false, $sessionUserID, $reported, '$reportType', NOW()); " ) or die($con->error); 
             
              $notif = "You successfully reported " . $_SESSION['firstnameofReported']  ." ";

              $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($sessionUserID,'Reported','$notif','0',NOW());" ) or die($con->error);

              unset($_SESSION['firstnameofReported']);

              //header("Location:../home");

              $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_GET[person]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($usernameReqe)) { 
                $requestedUsername = ($row['username']);
              } 

              header("Location: ../profile?u=".$requestedUsername."");
              $_SESSION['reported'] = 'true';
          }
          else { // FAKE REPORT, DOESNT OVERLOAD DATABASE  WITH THEIR REPORT FROM same account

              //reportType 1 = post 
              $sessionUserID = intval($sessionUserID); 
              $reported = intval($reported);
              
           //   $sql = $con->query("INSERT INTO `reports`(`reportType`, `reporter`, `reported`, `reason`, `create_date`) VALUES (false, $sessionUserID, $reported, '$reportType', NOW()); " ) or die($con->error); 
             
              $notif = "You successfully reported " . $_SESSION['firstnameofReported']  ." ";

              $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($sessionUserID,'Reported','$notif','0',NOW());" ) or die($con->error);

              unset($_SESSION['firstnameofReported']);

              //header("Location:../home");

              $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_GET[person]';") or die($con->error);    
              while($row = mysqli_fetch_assoc($usernameReqe)) { 
                $requestedUsername = ($row['username']);
              } 
              
              header("Location: ../profile?u=".$requestedUsername."");
              $_SESSION['reported'] = 'true';
          }
          
      }
      else {
        $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_GET[person]';") or die($con->error);    
        while($row = mysqli_fetch_assoc($usernameReqe)) { 
           $requestedUsername = ($row['username']);
        } 
      
        header("Location: ../profile?u=".$requestedUsername."");
      } 
    }
}
else {


  $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_GET[person]';") or die($con->error);    
  while($row = mysqli_fetch_assoc($usernameReqe)) { 
     $requestedUsername = ($row['username']);
  } 

  header("Location: ../profile?u=".$_requestedUsername."");
}

?>