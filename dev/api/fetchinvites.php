
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>
.img-with-text {
   text-align: justify;
   width: 0px;
} 
</style>
<?php 
require('db.php'); 
include('lang.php');
unset($usernames);
unset($lastnames); 
if(!isset($_SESSION["id"])){
	exit;
}
$sessionUserID = $_SESSION['id'];   
$sql = $con->query("SELECT codeuser,code FROM invites WHERE codemaker = '$sessionUserID' ORDER BY used DESC; " ) or die($con->error); 

$private = array();
$invites = array();
while($row = mysqli_fetch_assoc($sql)) { 
   $sqlNames = $con->query("SELECT username,create_date FROM users WHERE id = '$row[userid]';") or die($con->error);    
   while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
      $usernames[] = array($rowNames['usernames']); 
      $dates[] = array($rowNames['create_date']); 
   }
   $invites[] = array ( 
      array("UserID",$row['codeuser']),
      array("Code",$row['code'])
    ); 
}  
 
$sql = $con->query("SELECT COUNT(*) AS codemaker FROM invites WHERE codemaker = $sessionUserID;" ) or die($con->error); 
while($row = mysqli_fetch_assoc($sql)) { 
   $countinvitesmade = ($row['codemaker']);  
} 

$ifadmin = $con->query("SELECT admin FROM users WHERE id = $sessionUserID;") or die($con->error);    
while($ifadmin2 = mysqli_fetch_assoc($ifadmin)) { 
   $admin = ($ifadmin2['admin']);  
}   

if ($admin == 1) {
   echo "
   <div class='card-no-hover systemcolor' style='margin-top:20px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
   <h2> ". $lang_fetch_invites_header ." ". ($countinvitesmade) ." </h2>  
   <p style='font-size:20px;'>". $lang_fetch_invites_desc ."</p>
   <p style='font-size:20px;'> <b> Bypassing the limit with Admin permissions </b> </p> 
   </div> 
   ";  
}

else {

   if ((20 - $countinvitesmade) == 0) {   
      echo "
      <div class='card-no-hover systemcolor' style='margin-top:20px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
      <h2>". $lang_fetch_invites_header_reach_limit ."</h2>  
      <p style='font-size:20px;'>". $lang_fetch_invites_desc_reach_limit ."</p>
      </div> 
      "; 
      
   }
   else { 
      echo "
      <div class='card-no-hover systemcolor' style='margin-top:20px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
      <h2> ". $lang_fetch_invites_header ." ". (20 - $countinvitesmade) ." ". $lang_fetch_invites_header2 ." </h2>  
      <p style='font-size:20px;'>". $lang_fetch_invites_desc ."</p>
      </div> 
      ";  
   }

}

if (empty($invites)) { 
   echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   
   echo "<form action='api/generatecode' method='get' name='sendpost'>  ";


   if ($admin == 1) {
      echo "<input class='float' style='margin-top:50px;display: block;margin-left: auto;margin-right: auto;' id='makefriendbutton' type='submit' value='". $lang_fetch_invites_generatecode ."' />";
   }
   else {

      if ($countinvitesmade < 20) {  
         echo "<input class='float' style='margin-top:50px;display: block;margin-left: auto;margin-right: auto;' id='makefriendbutton' type='submit' value='". $lang_fetch_invites_generatecode ."' />";
      } 
   
   }


   echo "</form> ";  
   echo '</div>';

}  
else {
   $invitesnum = count($invites) - 1;  
   $invitesamount = count($invites) - 1; 
   echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   
   while ($invitesnum != -1) { 
 
      unset($lastname2);
      unset($user);


      if ($admin == 1) {
       
         if ($invitesamount == $invitesnum ) {

            echo "<form action='api/generatecode' method='get' name='sendpost'>  "; 
 
            echo "<input class='float' style='margin: 30px; display: block; margin-left: auto;margin-right: auto;' id='makefriendbutton' type='submit' value='".  $lang_fetch_invites_generatecode ."' />";
    
            echo "</form> ";  
         }
         
      }

      else {

      
         if ($invitesamount == $invitesnum && $invitesamount < 20) { 
            echo "<form action='api/generatecode' method='get' name='sendpost'>  "; 
   
            if ($countinvitesmade < 20) { 
               echo "<input class='float' style='margin: 30px; display: block; margin-left: auto;margin-right: auto;' id='makefriendbutton' type='submit' value='".  $lang_fetch_invites_generatecode ."' />";
            }  
   
            echo "</form> "; 
         }  
         
      }

      echo '<hr>'; 
 
      $user = $invites[$invitesnum][0][1];

      $getUserdetails = $con->query("SELECT username,lastname FROM users WHERE id='$user';") or die($con->error);    
      while($row = mysqli_fetch_assoc($getUserdetails)) { 
         $username2 = ($row['username']);
         $lastname2 = ($row['lastname']); 
      } 
  
      echo "<div class='systemcolor-Noborder' style='padding:40px;padding-bottom:0px;padding-top:0px;width:100%; '>";   
       
      $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$user'") or die($con->error); 
      while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
   
      if (!isset($contenturlimg)) {
         $contenturlimg = 'image/default.jpeg';
      }
      else {

         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$user';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
         $requestedUsername = ($row['username']);
         } 

         echo "<a style='text-decoration:none;' href='profile?u=" .$requestedUsername. "'>"; 
      }

      if (isset($username2)) {   
         echo "<img class='float nodrag imageshadow' src='".$contenturlimg."' height= '52px;' width='52px;' style=' border-radius:50%; margin: 5px !important;' alt='Profile Picture'> </a> "; 
         echo " ". $lang_fetch_invites_usedby ." ". $username2 ." <p class='inviteTextColorGrey' style='float:right;'>".$invites[$invitesnum][1][1] ." </p> ";  
      }
      else { 
         echo "<img class='float nodrag imageshadow' src='".$contenturlimg."' height= '52px;' width='52px;' style=' border-radius:50%; margin: 5px !important;' alt='Profile Picture'> </a>"; 
         echo " ". $lang_fetch_invites_unused ." <p class='inviteTextColor' style='float: right;'>".$invites[$invitesnum][1][1] ." </p>"; 
      } 
      echo '</div>';  
      unset($contenturlimg);

      $invitesnum = $invitesnum - 1;   
   } 
   echo '<hr>'; 
   echo '</div>';
} 
?>