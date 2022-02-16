
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
---> 
<script> 

$(document).ready(function() { 
$("#friendButton").click(function() {
  $.ajax({ 
      type: "POST", 
      url: "api/notifread",
      success: function(click){ 
        if (document.getElementById('friendButton').classList.contains("show")) { loadLatestResults("friendButton"); }  
      } 
  }); 
}); 
}); 
 
$(document).ready(function() { 
$("#notif").click(function() {
  $.ajax({ 
      type: "POST", 
      url: "api/notifread",
      success: function(click){ 
        if (document.getElementById('notif').classList.contains("show")) { loadLatestResults("notif"); }  
      } 
  }); 
}); 
}); 
</script> 

<?php 

//SETUP FOR NOTIF FETCHING
require('db.php');
require('lang.php');

if (!empty($_POST['session_id'])) { 
    $sessionUserID = $_POST['session_id'];
    $requestedID = $sessionUserID; 
    $refresh = 1;

    // ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 
    if(!isset($accountToken)) { 
      $accountToken = $_POST['account_token'];  
    } 
     
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
 
 $sql = $con->query("SELECT COUNT(*) AS useridRequested FROM requests WHERE useridRequested = $sessionUserID;") or die($con->error);    
    while($row = mysqli_fetch_assoc($sql)) { 
    $countfriendsreqs = ($row['useridRequested']); 
    if ($countfriendsreqs > 99) {
    $countfriendsreqs = "99+";
    }
}

 $sqlnotifs = $con->query("SELECT COUNT(*) AS userid FROM notifications WHERE userid = $sessionUserID AND `read` = 0;") or die($con->error);    
 while($notifrow = mysqli_fetch_assoc($sqlnotifs)) { 
    $countnotifs = ($notifrow['userid']); 
    if ($countnotifs > 99) {
       $countnotifs = "99+";
    }
 } 
 $sqlnotifsEXIST = $con->query("SELECT COUNT(*) AS userid FROM notifications WHERE userid = $sessionUserID;") or die($con->error);    
 while($notifrowE = mysqli_fetch_assoc($sqlnotifsEXIST)) { 
    $countnotifsExist = ($notifrowE['userid']);  
 } 

?> 

<?php  

// FRIEND REQ

$sqlCheck = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$sessionUserID' AND request_state = 'WaitingRelationship' ;") or die($con->error);    
while($row = mysqli_fetch_assoc($sqlCheck)) {
$friendsReqLoveCheck[] = array ( 
    array($row['useridRequester'])
); 
}
if (isset($friendsReqLoveCheck)) {  
$emoji = "❤️";   
}   
else {
$emoji = "😄"; 
} 
?>


<?php  
 
  $idnameNotif2 = "friendButton";
  $idnameNotifMenu2 = "friends"; 
  $id2nameNotif2 = "friends"; 

?>

<button id="<?php echo $idnameNotif2; ?>"  onclick="menu('<?php echo $idnameNotifMenu2; ?>')" style="padding-top:-2px;font-size:20px;background-color: transparent;color:white;text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6); float:left;" class="dropbtn"> <?php echo $emoji; ?> <p style='position:absolute;margin-top:-10px;margin-left:15px;font-size:15px;'  class='notiftextColor'> <?php if ($countfriendsreqs != 0) {echo $countfriendsreqs; } ?> </p> </button>
<div class="dropdown" style="z-index:998;"> 
<?php   
if ($countfriendsreqs == 0) { 
    echo '<div id="'.$id2nameNotif2.'" class="dropdown-content systemcolor-noborder" style="width: 230px;  height: 100px; overflow: scroll;">' ; 
}
else {
    echo '<div id="'.$id2nameNotif2.'" class="dropdown-content systemcolor-noborder" style="width: 450px;  height: 400px; overflow: scroll;">'  ;
} 
?>  

<a href="#" class="hrefColor"  style='pointer-events: none;'><?php echo $lang_header_friendsreqs;?> <?php echo number_format($countfriendsreqs); ?></a> 
<hr>
          
<?php 

if ($refresh != 0) {

    if ($countfriendsreqs != 0) {
        echo '<script> play(); </script>' ;
    }
    $refresh = 0;

}

?>
     
<?php
$ids = array(); 
$requests = array();
$requestsEach = array();   
unset($firstnames);
unset($lastnames);
unset($verified);
unset($private); 
$sql = $con->query("SELECT useridRequester,request_date,request_state FROM requests WHERE useridRequested = '$sessionUserID' AND type = 0 ORDER BY request_date DESC;" ) or die($con->error); 
while($rowsID = mysqli_fetch_assoc($sql)) {    
$sqlNames = $con->query("SELECT firstname, lastname , verified , private FROM users WHERE id = '$rowsID[useridRequester]';") or die($con->error);    
while($rowNames = mysqli_fetch_assoc($sqlNames)) {  
    $firstnames[] = array($rowNames['firstname']); 
    $lastnames[] = array($rowNames['lastname']);
    $private[] = array($rowNames['private']);
    $verified[] = array($rowNames['verified']);
}
$requests[] = array(
    array("UserID",$rowsID['useridRequester']),
    array("CreateDate",$rowsID['request_date']),
    array("Friendstate",$rowsID['request_state'])
); 
}  
if (empty($requests)) { 
echo ' <a class="hrefColor"> '.$lang_requestsfetch_nofound.' </a> '; 
} else {  

    $_SESSION['beforeurl'] = $_SERVER["REQUEST_URI"];   

    $requestsNo = count($requests) - 1; 
    while ($requestsNo != -1) {    
    echo "<div>";     
    $relationship = $requests[0][2][$requestsNo + 1]; 
    $date = $requests[0][1][$requestsNo + 1]; 

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

    $returndata = $return;

    if ($returndata == "0m") { $returndata = $lang_just_now; }
    if ($relationship == "WaitingRelationship") { 
    $returndata = ("❤️ $lang_just_now "); 
    echo "<p style = 'float:left;margin-top:-2px;'> ", '<form style="padding-bottom:50px;float:right; padding-left:10px;padding-right:10px;" action="api/deleteRelationshipRequest?name="' . $requests[0][0][$requestsNo + 1]. '"" method="post"> <input type="hidden" name="name" value="' .$requests[0][0][$requestsNo + 1]. '">  <input type="hidden" name="postid" value="' .$requests[0][0][$requestsNo + 1]. '"> <input class="float" style="float:right;padding-right:20px;" type="submit" name="submit" value="'.$lang_get_profile_deny_request.'"> </form>', '<form action="api/acceptRelationshipRequest?name="' . $requests[0][0][$requestsNo + 1]. '"" method="post"> <input type="hidden" name="name" value="' .$requests[0][0][$requestsNo + 1]. '">  <input type="hidden" name="postid" value="' .$requests[0][0][$requestsNo + 1]. '"> <input class="float" style="float:right;" type="submit" name="submit" value="'.$lang_get_profile_add_request.'"> </form>';
    } 
    else {
    echo "<p style = 'float:left;margin-top:-2px;'> ", '<form style="padding-bottom:50px;float:right; padding-left:10px;padding-right:10px;" action="api/deleterequest?name="' . $requests[0][0][$requestsNo + 1]. '"" method="post"> <input type="hidden" name="name" value="' .$requests[0][0][$requestsNo + 1]. '">  <input type="hidden" name="postid" value="' .$requests[0][0][$requestsNo + 1]. '"> <input class="float" style="float:right;padding-right:20px;" type="submit" name="submit" value="'.$lang_get_profile_deny_request.'"> </form>', '<form action="api/acceptrequest?name="' . $requests[0][0][$requestsNo + 1]. '"" method="post"> <input type="hidden" name="name" value="' .$requests[0][0][$requestsNo + 1]. '">  <input type="hidden" name="postid" value="' .$requests[0][0][$requestsNo + 1]. '"> <input class="float" style="float:right;" type="submit" name="submit" value="'.$lang_get_profile_add_request.'"> </form>';
    } 
?> 
<?php 
$person = $requests[0][0][$requestsNo + 1];
$contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$person'") or die($con->error); 
while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 
?> 

<?php 

$temppostidforusername = $requests[0][0][$requestsNo + 1];
$usernameReqe = $con->query("SELECT username FROM users WHERE id='$temppostidforusername';") or die($con->error);    
while($row = mysqli_fetch_assoc($usernameReqe)) { 
$requestedUsername = ($row['username']);
} 

?>

    <?php echo "<a href='profile?u=" .$requestedUsername. "'> <img src='".$contenturlimg."' height= '50px;' width='50px;' class='imageshadow nodrag' style='float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'> <p> ". $firstnames[0][$requestsNo ]; ?> <?php if ($verified[0][$requestsNo] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; } ?>  <?php echo " • " . $returndata . "</p>  </a>  ";   ?>
    <?php 
    unset($contenturlimg);
    unset($returndata);
    unset($person);
    echo "</div>";
    //if ($requestsNo == 0) {
    //echo ' 🚫 End ';
    //}  
    $requestsNo = $requestsNo - 1;  
}  
} 
?>


</div>  


<?php 

// NOTIFICATION FETCH:

?> 

<?php  
 
  $idnameNotif2 = "notif";
  $idnameNotifMenu2 = "notifications"; 
  $id2nameNotif2 = "notifications"; 
  
?>

<button id="<?php echo $idnameNotif2; ?>" onclick="menu('<?php echo $idnameNotifMenu2; ?>')" style="margin-right:20px;font-size:20px;background-color: transparent;color:white;text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6); float:left;" class="dropbtn">🔔 <p style='position:absolute;margin-top:-10px;margin-left:15px;font-size:15px;' class='notiftextColor '> <?php if ($countnotifs != 0) {echo $countnotifs; } ?> </p> </button>

<div class="dropdown" style="z-index:998;"> 
    <?php   
    if ($countnotifsExist == 0) { 
        echo '<div id="'.$id2nameNotif2.'" class="dropdown-content systemcolor-noborder" style="width: 230px; height: 400px; overflow: scroll;">' ; 
    }
    else {
        echo '<div id="'.$id2nameNotif2.'" class="dropdown-content systemcolor-noborder" style="width: 367px; height: 400px; overflow: scroll; margin-left:-100px;">'  ;
    } 
    ?> 
    
    <a href="#" class="hrefColor" style='pointer-events: none;'><?php echo $lang_header_notifications; ?> <?php echo $countnotifs; ?> </a> 
   
   <?php 

    if ($refresh != 0) { 
        if ($countnotifs != 0) {
            echo '<script> play(); </script>' ;
        }
        $refresh = 0; 
    }

    ?>
    
    <hr>
    <?php  

     $ids = array(); 
     $notifications = array(); 
     
     $sql = $con->query("SELECT post,userid,create_date,type FROM notifications WHERE userid = '$sessionUserID' ORDER BY create_date ASC;" ) or die($con->error); 
     while($rowsID = mysqli_fetch_assoc($sql)) {    
        $sqlNames = $con->query("SELECT username, lastname FROM users WHERE id = '$rowsID[userid]';") or die($con->error);    
        while($rowNames = mysqli_fetch_assoc($sqlNames)) {  
           $firstnames[] = array($rowNames['username']);   
           $lastnames[] = array($rowNames['lastname']);
        }
        $notifications[] = array(
           array("Post",$rowsID['post']),
           array("Date",$rowsID['create_date']),
           array("Type",$rowsID['type']) 
        ); 
     }  
     if (empty($notifications)) { 
        echo ' <a class="hrefColor">'.$lang_notifsfetch_none.'</a> '; 
     } else { 
         $notificationsNo = count($notifications) - 1;   
          
         while ($notificationsNo != -1) {    
           echo "<div>";   
           $date = $notifications[$notificationsNo][1][1]; 

           // have to use copied function and taken out of funct, as it wouldnt load website with function. 
           // we are using ajax on this whole php file.

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

           $returndata = $return;
     
           $notification = $notifications[$notificationsNo][0][1];
           if (str_contains($notification, "accepted your friend request")) { 
              $notif = "🎉". ("$notification");
           }
           if (str_contains($notification, "You have joined mypage")) {  
              $notif = "📩". ("$notification");
           }
           if (str_contains($notification, "report")) {  
              $notif = "📝". ("$notification");
           }
           if (str_contains($notification, "has joined MyPage with your invite!")) {  
              $notif = "✨". ("$notification");
           }
           if (str_contains($notification, "accepted your love request")) {  
              $notif = "❤️". ("$notification");
           }
       
           if ($returndata == "0m") { $returndata = $lang_just_now; }
     
           echo " <a class='notifsColor'> <b> ".$notifications[$notificationsNo][2][1] ."</b> · " .  $returndata ."<br>" .  $notif . " </a>  " ;   
           unset($returndata);
           echo "</div>"; 
          $notificationsNo = $notificationsNo - 1;  
         // $sql = $con->query("UPDATE notifications SET `read` = 1 WHERE userid = '$sessionUserID';" ) or die($con->error);  
     }  
     } 
     echo "</div>"; 
     echo "</div>"; 

    ?>

<script type="text/javascript">

function play() {
  var audio = new Audio('sound/sound.mp3');
  audio.play();
} 

</script>


</div> 