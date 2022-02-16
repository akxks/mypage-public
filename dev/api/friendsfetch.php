
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

function datedifferencee($date) {
date_default_timezone_set('Europe/London');  
$date1 = (DateTime::createFromFormat('Y-m-d H:i:s', ($date)));  
$date2 = new DateTime(date("Y-m-d H:i:s"));
$interval = $date1->diff($date2); 
if (($interval->y) == 0) {
   if (($interval->m) == 0) {
      if (($interval->d) == 0) {
      if (($interval->h) == 0) {
         $return = $interval->i . "m";
      }
      else {
         $return = $interval->h . "h";
      } 
      }
      else {
      $return = $interval->d . "d";
      } 
   }
   else {
      $return = $interval->m . "mo";
   } 
}
else {
   $return = $interval->y . "yr";
}
return $return; 
} 

require('db.php');  
require('lang.php');  
unset($lastnames); 
unset($usernames); 
unset($firstnames);
unset($relationshipId);
if (!empty($_POST['session_id'])) { 
   $sessionUserID = $_POST['session_id'];
   $requestedID = $sessionUserID;
   $fetch = $_POST['fetchid'];


   // ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

   if (!isset($accountToken)) { $accountToken = $_POST['account_token']; }

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

}
else {
   $sessionUserID = $_SESSION['id'];
} 

if ($fetch == "ID") { 
   if ($requestedID == $sessionUserID) {
      $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$sessionUserID' AND friendstate = 'Friends' ORDER BY since_date DESC; " ) or die($con->error); 
   }
   else {  
      $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$requestedID' AND friendstate = 'Friends' ORDER BY since_date DESC; " ) or die($con->error); 
      $result = $con->query("SELECT userid FROM friends WHERE useridFriend = '$requestedID' AND userid = '$sessionUserID' AND friendstate = 'Friends' ORDER BY since_date DESC; " ) or die($con->error); 
      $resultFriends = mysqli_fetch_row($result);   
   }
}
if ($fetch == "home") {  
   $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$sessionUserID' AND friendstate = 'Friends' ORDER BY since_date DESC; " ) or die($con->error); 
}

$private = array();
$friends = array(); 
while($row = mysqli_fetch_assoc($sql)) {  
   $sqlNames = $con->query("SELECT username,firstname,lastname,verified,relationshipId FROM users WHERE id = '$row[userid]';") or die($con->error);    
   while($rowNames = mysqli_fetch_assoc($sqlNames)) {  
      $usernames[] = array($rowNames['username']);   
      $firstnames[] = array($rowNames['firstname']);   
      $lastnames[] = array($rowNames['lastname']); 
      $verified[] = array($rowNames['verified']);  
   }
   $friends[] = array ( 
      array("UserID",$row['userid'])
    ); 
}

$sqlpriv = $con->query("SELECT private FROM users WHERE id = '$requestedID';") or die($con->error);    
while($rowNames = mysqli_fetch_assoc($sqlpriv)) {  
   $private[] = array($rowNames['private']);  
} 
if ($fetch == "ID" && $requestedID !== $sessionUserID && (!isset($resultFriends)) && $private[0][0] == 1) {   
   echo ' <div class="card-no-hover systemcolor"> ';  
   echo ' <p>'.$lang_friends_fetch_cantseetheirfriends.'</p> '; 
   echo ' </div></div> ';   
} 
else {
   if (empty($friends)) { 
      if ($fetch == "ID") { 
         echo ' <div class="card-no-hover systemcolor"> ';  
         echo ' <p>'.$lang_friends_fetch_nofriendsfound.'</p>';
         echo ' </div></div> '; 
      } 
      else { 
         echo '<div class="friends-content card-no-hover systemcolor-noborder" style="width: 100%; padding: 25px;border-radius: 5px;"> '; 
 
         echo "<center> <p style='margin-left:-5px;' >".$lang_friends_fetch_nofriendsfound."</p> </center>";
         echo "<form action='friends' method='get' name='sendpost'> ";
         echo "<input class='float' style='display: block;margin-left: auto;margin-right: auto;' id='makefriendbutton' name='submitMakeFriends' type='submit' onclick='makeFriends()' value='Make Friends' />";
         echo "</form> ";
         echo '</div>';
      } 
    } else { 
      $friendsnum = count($friends) - 1;  
      $friendsamount = count($friends) - 1;   
      if (1 == 1) {
         echo '<div id=" " class="friends-content card-no-hover systemcolor-noborder" style="width: 100%; padding: 8px;border-radius: 5px; "> ';  
         //FETCHING FOR HOME PAGES 
         while ($friendsnum != -1) { 
            
            $emoji = '';
            $friendsid = $friends[$friendsnum][0][1];  

            // emojis for main page 
            if ($fetch == "home") {
               // Checking for Plant Emoji (if they are a new user less than 5 days)
               $friendInfo = $con->query("SELECT create_date,relationshipId FROM users WHERE id = '$friendsid';") or die($con->error);    
               while($rowNames = mysqli_fetch_assoc($friendInfo)) {  
                  $dates = array($rowNames['create_date']);
                  $relationshipIds = array($rowNames['relationshipId']);
               }

               $date = $dates[0];  
               $relationshipId = $relationshipIds[0];  
               
               $returndata = datedifferencee($date); 
               if ($returndata == "1d" or $returndata == "2d" or $returndata == "3d" or $returndata == "4d") { 
                  $emoji = '🌱';
                  $glow = 'text-shadow: 0px 0px 20px green,0px 0px 20px green;';
               }
               if (strpos($returndata, 'h') or (strpos($returndata, 'm')) && (!strpos($returndata, 'mo'))) { 
                  $emoji  = '🌱';
                  $glow = 'text-shadow: 0px 0px 20px green,0px 0px 20px green;';
               }
               unset($returndata); 

               // Checking if they just posted in less than an hour (Spark emoji)
               $friendInfoPOST = $con->query("SELECT create_date FROM posts WHERE userid = '$friendsid' ORDER BY create_date ASC;") or die($con->error);    
               while($rowNames = mysqli_fetch_assoc($friendInfoPOST)) {  
                  $dates = array($rowNames['create_date']);
               } 
               $date = $dates[0];
               $returndata = datedifferencee($date);
               if (!strpos($returndata, 'mo')) { 
                  if (strpos($returndata, 'm') or (strpos($returndata, 'h'))) { 
                     if (strpos($returndata, 'h')) {
                        if ($returndata == "1h") {
                           $emoji = '✨';
                           $glow = 'text-shadow: 0px 0px 20px #ffc800,0px 0px 20px #ffc800;';
                        }
                     }
                     else {
                        $emoji = '✨'; 
                        $glow = 'text-shadow: 0px 0px 20px #ffc800,0px 0px 20px #ffc800;';
                     } 
                  }
               } 

               // Checking if its their birthday (cake with candles emoji)  
               $friendInfoPOST = $con->query("SELECT birthday FROM users WHERE id = '$friendsid';") or die($con->error);    
               while($rowNames = mysqli_fetch_assoc($friendInfoPOST)) {  
                  $datesbday = array($rowNames['birthday']);
               } 

               $datesbday = $datesbday[0]; 
               if (isset($datesbday)) { 
                  $returndata = datedifferencee($datesbday); 
                  if (strpos($returndata, 'h') or (strpos($returndata, 'm'))) { 
                     $emoji  = '🎂';
                     $glow = 'text-shadow: 0px 0px 17px white;';
                  } 
               }

               // Message Score - Awkward (they are closer friends with someone else) but you talk to them too much.
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '😬';
                  $glow = 'text-shadow: 0px 0px 17px rgba(255, 221, 0, 0.5);';
               }

               // Message Score - Spy (they look at your profile more than three times in one hour)
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '😎';
                  $glow = 'text-shadow: 0px 0px 17px rgba(255, 221, 0, 0.5);';
               } 

               // Message Score - Friend 
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '😃';
                  $glow = 'text-shadow: 0px 0px 17px rgba(255, 221, 0, 0.5);';
               }

               // Message Score - Close Friend
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '😁';
                  $glow = 'text-shadow: 0px 0px 17px rgba(255, 221, 0, 0.5);';
               } 

               // Message Score - Best friend +2 week
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '🤗';
                  $glow = 'text-shadow: 0px 0px 17px rgba(255, 221, 0, 0.5);';
               }

               // Message Score - Best friend +2 mo  
               $relationship = 0;
               if ($relationship == 1) { 
                  $emoji  = '💕';
                  $glow = 'text-shadow: 0px 0px 17px #ff00ae;';
               } 
   
               // Message Score - Lover 
               if ($relationshipId[0] == $friendsid) { 
                  $emoji  = '❤️';
                  $glow = 'text-shadow: 0px 0px 17px red;';
               } 

               // Adrian Only 
               if ($friendsid == 72) { 
                  $emoji  = '🦋';
                  $glow = 'text-shadow: 0px 0px 17px #34a4eb;';   
               }


            }

            //Showing the friend  

            //getting their pfp  
            $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$friendsid'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  


            if ($fetch != "home") {
               $emoji = ''; 


               $usernameReqe = $con->query("SELECT username FROM users WHERE id='$friendsid';") or die($con->error);    
               while($row = mysqli_fetch_assoc($usernameReqe)) { 
               $requestedUsername = ($row['username']);
               } 

               echo "<a href='profile?u=".$usernames[$friendsnum - 0 ][0]."' style='cursor:pointer;'>  <div style='padding: 0px 12px;'>"; 
               if ($verified[$friendsnum][0] == 1) {
                  if ($friendsid == $sessionUserID) {
                     echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '55px;' width='55px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;'> <b> You </b> ", " ", '<img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'."</p><p class='glowEmoji' style='" . $glow ."float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";
                  }
                  else  {
                     echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '55px;' width='55px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;;'> ". $firstnames[$friendsnum - 0 ][0], "<p class='glowEmoji' style='color:gray;float:left;font-size:15px;margin-top:15px;margin-left:5px;'>  @". $usernames[$friendsnum - 0 ][0],  ' <img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'."</p><p class='glowEmoji' style='" . $glow ."float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";

                  }
               }
               else {
                  if ($friendsid == $sessionUserID) {
                     echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '55px;' width='55px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;'>  <b> You </b> ", " ", "<p class='glowEmoji' style=' ". $glow ." float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";

                  }
                  else {
                     echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '55px;' width='55px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;;'>". $firstnames[$friendsnum - 0 ][0], " <p class='glowEmoji' style='color:gray;float:left;font-size:15px;margin-top:15px;margin-left:5px;'>  @". $usernames[$friendsnum - 0 ][0] , "</p> <p class='glowEmoji' style=' ". $glow ." float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";

                  }
               }
            }
            else { 
               
               echo "<a style='cursor:pointer;' id='messagefriend' href='profile?u=".$usernames[$friendsnum - 0 ][0]."'>  <div style='padding: 0px 12px;'>"; 
               if ($verified[$friendsnum][0] == 1) {
                  echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;;'>". $firstnames[$friendsnum - 0 ][0], "<p class='glowEmoji' style='color:gray;float:left;font-size:15px;margin-top:15px;margin-left:5px;'>  @". $usernames[$friendsnum - 0 ][0], ' <img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'."</p><p class='glowEmoji' style='" . $glow ."float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";
               }
               else {
                  echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;;'>". $firstnames[$friendsnum - 0 ][0], "<p class='glowEmoji' style='color:gray;float:left;font-size:15px;margin-top:15px;margin-left:5px;'>  @". $usernames[$friendsnum - 0 ][0], "</p> <p class='glowEmoji' style=' ". $glow ." float:right;font-size:19px;margin-top:10px;'> " , $emoji , "</p> <br> <br> <br> </div>";
               }
            } 
               
            //IF U WANT TO ADD TEXT BELOW NAME
            //}
 
            unset ($person); 
            echo "</div></a>";
            $friendsnum = $friendsnum - 1;   
         }
         echo "</div>";
      } 
      
      echo "</div>";
   }
} 
?>