
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require ("db.php"); 
require ("auth.php"); 
require('lang.php');  
if (isset($_POST['search'])) {  
   $Name = $_POST['search']; 
   
   $Name = str_replace("@", "", $Name);

   //$Query = "SELECT firstname,lastname,pfpurl,id,private,verified,location,score,create_date,relationshipId FROM users WHERE firstname LIKE '%$Name%' OR lastname LIKE '%$Name%' ORDER BY verified DESC LIMIT 5";
  $Query = "SELECT firstname,lastname,pfpurl,id,private,verified,location,score,create_date,relationshipId,username FROM users WHERE username LIKE '%$Name%' AND hideAccount = 0 ORDER BY verified ";
   $ExecQuery = MySQLi_query($con, $Query);  
   while ($result = MySQLi_fetch_array($ExecQuery)) {
       ?>   
   <?php  
   $Counter = "SELECT COUNT(*) AS username FROM users WHERE username LIKE '%$Name%'";
   $ExecQueryC = MySQLi_query($con, $Counter);  
   while($row = mysqli_fetch_assoc($ExecQueryC)) { 
      $count = ($row['username']);  
    } ?>  

   <?php 

   if ($result['id'] == $_SESSION['id'])  {
      // $sameuser = 'You' ; 
      // echo "<a class='hrefColor' style='height:70px; ' href='profile?id=" .$result['id'] ."'><img src=" .$result['pfpurl'] ." height= '50px;' width='50px;' style='box-shadow: 0 2px 10px 0 rgba(0,0,0,0.3); float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'>  ". $result['firstname'] . " ". $result['lastname']; 
      // if ($result['verified'] == 1) {  
      //    echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:NONE; " alt="Verified Sticker">'; 
      // }  
      // echo  " • <b> ". $sameuser . " </b>  ";
   }
   else {

    //if u blocked them, dont show  
    $requested = $result['id'];
    $sessionuser = $_SESSION['id'];
    $relationshipId = $result['relationshipId'];

    $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$requested' AND useridBlocker = '$sessionuser';" ) or die($con->error);  
    $infoBlocked = array();
    
    while($row = mysqli_fetch_assoc($sqlBlocked)) {
       $infoBlocked[] = array (
          array("UserID",$row['id']));
       } 
    if (!empty($infoBlocked)) {   
      $blocked = 1;
      $count = $count - 1;
    } 

    // if they blocked you, dont show. 
    $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$sessionuser' AND useridBlocker = '$requested';" ) or die($con->error);  
    $infoBlocked2 = array();
    
    while($row = mysqli_fetch_assoc($sqlBlocked)) {
       $infoBlocked2[] = array (
          array("UserID",$row['id']));
       } 
    if (!empty($infoBlocked2)) {      
      $blocked = 1;
      $count = $count - 1;
    }   

   if ($blocked != 1) {

      $usernameReqe = $con->query("SELECT username FROM users WHERE id='$result[id]';") or die($con->error);    
      while($row = mysqli_fetch_assoc($usernameReqe)) { 
         $requestedUsername = ($row['username']);
      } 

      echo "<a class='hrefColor' style='height:63px; ' href='profile?u=" .$requestedUsername."'><img src=" .$result['pfpurl'] ." height= '47px;' width='47px;' class='imageshadow nodrag' style=' float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'>  @". $result['username'] . " ". " ". "  ";
      if ($result['verified'] == 1) {  
         echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:NONE; " alt="Verified Sticker">'; 
      }   
    } 
   } 
   if ($blocked != 1) {
   if ($result['id'] != $_SESSION['id'])  {

   $sqlCheckFriends = $con->query("SELECT userid FROM friends WHERE useridFriend = '$result[id]' AND userid = '$_SESSION[id]' AND friendstate = 'Friends';") or die($con->error);    
   while($row = mysqli_fetch_assoc($sqlCheckFriends)) {
      $friendsCheck[] = array ( 
         array("UserID",$row['userid'])
       ); 
   }   
 
   if ($relationshipId == $sessionUserID) {
      echo  " • <b> Lover </b>  ";
   }
   else {

      if (isset($friendsCheck)) {  
         echo  " • <b> ".$lang_searchajax_friend." </b>  ";
      }
   }

   if ($result['private'] == 1 && (!isset($friendsCheck)) && $result['id'] !== $_SESSION['id']) {   
      echo " <br> 🔒 "; 
    }
   else { 
    if (isset($result['location'])) {
       if ($result['location'] !== " " or "") { 
         echo ' <br> 🌎 '. $result['location'] .' ';
       } 
      else {
         echo ' <br>  '; 
      }
    }  
    else {
       echo ' <br>  '; 
    }

    $num = $result['score'];
    $formattedNum = number_format($num);  
    echo " • ". $formattedNum . "  ";  
     //echo " 💯 ". $formattedNum . "  ";  
   }  
   echo '</p> </a> ';
   unset($friendsCheck);
   unset($relationshipId);
  } 
   ?> 
   <?php
} unset($blocked); }
if ($count > 7) {
   include 'numberformat';   
   echo '<a class="hrefColor" href="search?q='.$Name.'" style="height:35px; "> '.$lang_searchajax_viewmore.' ' . number_format($count -5). ' '.$lang_searchajax_viewmore2.' </p> </a>';
}} 
?>