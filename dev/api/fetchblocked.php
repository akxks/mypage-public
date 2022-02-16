
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require("api/db.php");  
require("api/auth.php"); 
require('api/lang.php');  
$blocked = array();   
unset($username);
unset($lastnames);
unset($verified);
unset($private); 
unset($id); 
$sessionUserID = $_SESSION['id']; 
$sql = $con->query("SELECT useridblocked FROM blocked WHERE useridBlocker = '$sessionUserID' ORDER BY since_date ASC;" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) {    
  $sqlNames = $con->query("SELECT username, verified , private , id FROM users WHERE id = '$rowsID[useridblocked]';") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($sqlNames)) {  
      $username[] = array($rowNames['username']);  
      $private[] = array($rowNames['private']);
      $verified[] = array($rowNames['verified']);
      $id[] = array($rowNames['id']);
  } 
}   
if (empty($username)) { 
  echo $lang_fetch_blocked_none; 
} else { 
    $blockedNo = count($username) - 1;
    while ($blockedNo != -1) { 
      unset($currentid);  
      echo "<div>"; 
      $currentid = $id[0][$blockedNo];  
      echo "<p style = 'float:left;margin-top:-2px;'> ", '<form style=" float:right; padding-left:10px;padding-right:10px;" action="api/unblockperson?name='.$currentid.'" method="post"> <input class="float" style="float:right;padding-right:20px;" type="submit" name="submit" value="Unblock"> </form>' ; ?> 
 
      <?php 
      $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$currentid'") or die($con->error); 
      while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 
      ?> 
 
      <?php echo "<img src='".$contenturlimg."' height= '50px;' width='50px;' class='imageshadow nodrag' style='float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'> <p> ". $username[$blockedNo][0]; ?> <?php if ($verified[0][$requestsNo] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; } "</p>  </p>   ";   ?>
      <?php 
      unset($contenturlimg);
      unset($returndata);
      echo "</div> "; 
      echo "<br><br> <hr> ";
      $blockedNo = $blockedNo - 1;  
    }   
} 
?>