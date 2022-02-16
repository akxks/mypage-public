
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>
.circle-grid {  

  float:left; 
  display: grid;
  place-items: center; 
  grid-template-rows: repeat(10, 1fr);
  grid-template-columns: repeat(10, 1fr); 
  width: min(100vmin, 141px);
  height: min(100vmin, 145px);
  
  margin:-20px;
}

.circle-grid img {
  grid-column: 3 / span 5;
  grid-row: 3 / span 5;
  place-self: center;
  margin-bottom:18px;
  width: 88px; 
  height: 88px;
  
  border-radius: 50%; 
}

.circle-grid div {
  height: 100%;
  width: 100%;
  border-radius: 50%; 
}

.circle-grid div:where(:nth-of-type(1), :nth-of-type(3)){
  grid-row: 2;
}

.circle-grid div:first-of-type {
  grid-column: 2; 
}

.circle-grid div:nth-of-type(2){
  grid-column: 5;
}

.circle-grid div:nth-of-type(3) {
  grid-column: 8;
}

.circle-grid div:where(:nth-of-type(4), :nth-of-type(5)){
  grid-row: 5;
}

.circle-grid div:nth-of-type(5){
  grid-column: 9;
}

.circle-grid div:nth-last-of-type(-n+2){
  grid-row: 8;
}

.circle-grid div:nth-last-of-type(2){
  grid-column: 3;
}

.circle-grid div:last-of-type{
  grid-column: 7;
}
</style>

<?php 
require('db.php');  
require('lang.php');  
if(!isset($_SESSION["id"])){
	exit;
}
$noprofile = 0;
$sessionUserID = $_SESSION['id']; 
// TO HIDE USER ERROR IN URL, IF id is not PUT.
//error_reporting(E_ALL ^ E_NOTICE);
if(isset($_GET['u'])) {
  $requestedID = $_GET['u']; 
    //anti sql inject
    if(preg_match("/^[a-zA-Z0-9]+$/", $requestedID) != 1) {
    // string does not contain the a to z , A to Z, 0 to 9
    $requestedID = 00;
  }  
  $checkUsername = $con->query("SELECT id FROM users WHERE username='$requestedID';") or die($con->error);    
  while($row = mysqli_fetch_assoc($checkUsername)) { 
    $requestedID = ($row['id']);
  } 
}
else {
  $requestedID = $sessionUserID;
} 

if(1 === preg_match('~[0-9]~', $_GET['u'])){ 
  echo ' <div class="card-no-hover systemcolor" style="height:90px;margin-top:20px !important;"> '; 
  echo ' <center> '.$lang_core_profile_notexist.' </center>';
  echo ' </div> ';  
  exit; 
} 

include('modals.php'); 
include('button.php'); 

reportPerson($requestedID, $sessionUserID);  
if (isset($_SESSION['reported'])) { successReport($_SESSION['id']); }; 

sharePerson($requestedID, $sessionUserID);  
// if (isset($_SESSION['reported'])) { successReport($_SESSION['id']); }; 

$friendsn = 0;
$sql = $con->query("SELECT id,firstname,lastname,bio,create_date,verified,private,birthday,score,location,relationshipId,song,username FROM users WHERE id = '$requestedID';" ) or die($con->error);  
$info = array();

while($row = mysqli_fetch_assoc($sql)) {
   $info[] = array (
      array("UserID",$row['id']),
      array("Firstname",$row['firstname']),
      array("Lastname",$row['lastname']),
      array("Bio",$row['bio']), 
      array("CreateDate",$row['create_date']),
      array("Verified",$row['verified']),
      array("Private",$row['private']),
      array("Birthday",$row['birthday']),
      array("Score",$row['score']),
      array("Location",$row['location']),
      array("Relationshipid",$row['relationshipId']),
      array("Song",$row['song']),
      array("Username",$row['username'])
    ); 
} 
?> 
<?php


//  Full glow on whole header profile
// with background gradient
// background-image: linear-gradient(#ff3b5c, #de1641); opacity: 0.93; 


// For outside glow : (maybe for High score ppl?)

// border: 1px solid #de1641;

// box-shadow: 0px 0px 10px #de1641, 
//             inset 0px 0px 10px #de1641; 


// maybe ??? Text above header for profile, might look cool.
// <h3 class='hrefColor' style='margin-top:110px;'> Your Profile</h3>


?>

<div class="form card-no-hover systemcolor-noborder profilePhone" style="width:100%;height:auto;padding:30px; margin-top:110px;border-radius:6px;


 "> 
          

            <?php 
            $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$requestedID'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 

            $emojiStyle = $con->query("SELECT emojistyle FROM users WHERE id = '$requestedID'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($emojiStyle)) { $emojiStyleEmoji = $rowsID['emojistyle']; } 
            ?>  

            <div class="circle-grid">
            <?php  $emojiRound = $emojiStyleEmoji; ?>

            <?php 
            
            if (isset($emojiRound)) {
              
              echo '  <img class="imageshadow float nodrag " src="'.$contenturlimg.'" height= "90px;" width="90px;" style=" border-radius:50%;   margin: -35px;" alt="Profile Picture"> ' ;

            }
            else {
              
             echo '  <img class="imageshadow float nodrag " src="'.$contenturlimg.'" height= "90px;" width="90px;" style=" border-radius:50%;  " alt="Profile Picture"> ' ; 
            
            }
            
            ?>
              <div style="  transform: rotate(20deg); font-size:18px; "><?php echo $emojiRound; ?></div> 
               <div style=" margin-top: -15px;transform: rotate(29deg); font-size:17px; ">  </div>  
              <div style=" margin-right: 5px; transform: rotate(-50deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
              <div style=" transform: rotate(-17deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
              <div style=" margin-right: 15px; transform: rotate(28deg); font-size:19px; "><?php echo $emojiRound; ?></div> 
              <div style=" margin-bottom: 15px; transform: rotate(-71deg); font-size:20px; "><?php echo $emojiRound; ?></div> 
              <div style=" transform: rotate(22deg); font-size:16px; ">  </div> 
            </div>  
 
              <div style='float:right !important;'>   
                <div id="dropdown" style="padding: 0px !important; margin: 0px; border: 0px solid red;">  
                  <?php  
                  unset($contenturlimg);
                  if ($sessionUserID != $requestedID && !isset($_SESSION['newuser'])) { 
                    
                    $sqlCheckFriends = $con->query("SELECT userid FROM friends WHERE useridFriend = '$requestedID' AND userid = '$sessionUserID' AND friendstate = 'Friends';") or die($con->error);    
                    while($row = mysqli_fetch_assoc($sqlCheckFriends)) {
                       $friendsCheck[] = array ( 
                          array("UserID",$row['userid'])
                        ); 
                    } 

                    if (isset($friendsCheck)) { 
                      echo ' 
                      <div class="dropbtn hoverColor" id="menuIcon" style="border: -5px solid transparent; cursor: pointer;" onclick="menu(\'profile\');">
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;" onclick="menu(\'profile\');"></p>
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'profile\');"></p>
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'profile\');"></p> 
                      </div>
                      ';
                    }
                    else {
                      echo ' 
                      <div class="dropbtn hoverColor" id="menuIcon" style="border: -5px solid transparent; cursor: pointer;" onclick="menu(\'profile2\');">
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;" onclick="menu(\'profile2\');"></p>
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'profile2\');"></p>
                        <p class="dot dropbtn" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'profile2\');"></p> 
                      </div>
                      ';
                    } 
                  } 
                  ?> 
                </div>  
                
                <div class="dropdown" style="z-index:998;"> 
                  <?php   
                  echo '<div id="profile" class="dropdown-content systemcolor-noborder" style="width: 190px;margin-top:-66px;">' ;  
                  ?> 
                  
                  <a href="#" class="hrefColor" style='pointer-events: none;'> <?php echo $lang_get_profile_actions; ?> </a>  
                  <hr>  
                  <?php echo '<a class="hrefColor" style="cursor:pointer;color: #ff483b !important;" href="api/deletefriend?name='.$requestedID.'">'. $lang_get_profile_actions_remove_friend .'</a> ' ?> 
                  <?php echo '<a class="hrefColor " style="cursor:pointer;color: #ff483b !important;" href="api/blockperson?name='.$requestedID.'">'. $lang_get_profile_actions_block_friend .'</a> ' ?>  

                  <a onclick="menu('report')" class="hrefColor " style="cursor:pointer; " > 📝 Report </a>  
                  <a onclick="menu('sharePerson')" class="hrefColor " style="cursor:pointer; " > 📤 Share </a>  
                  
                  <?php 
                  // if they not in relationship give them the love button


                  // IF you have rels enabled

                  $sqlCheckRels = $con->query("SELECT disablerelationships FROM `settings` WHERE userid = '$sessionUserID';") or die ($con->error); 

                  $sqlCheckRels2 = $con->query("SELECT disablerelationships FROM `settings` WHERE userid = '$requestedID';") or die ($con->error); 

                  // if that person has rels enabled to 
                  while($row = mysqli_fetch_assoc($sqlCheckRels)) {
                    $sqlCheckRelse = $row['disablerelationships']; 

                  }

                  while($row = mysqli_fetch_assoc($sqlCheckRels2)) {
                    $sqlCheckRels2e = $row['disablerelationships']; 
                  }

                  if ($sqlCheckRelse != 1) {

                    if ($sqlCheckRels2e != 1) {


                      if ($info[0][10][1] !== -1) {   

                        if ($info[0][10][1] == $_SESSION['id']) {
                          echo '<a class="hrefColor " style="cursor:pointer; ;" href="api/deleteRelationship?name='.$requestedID.'"> 💔 Break Up </a> ' ;   
                        }
    
                        else { 
                        //if u havent sent them a req yet
                        $sqlCheck = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$sessionUserID' AND useridRequester = '$requestedID' AND request_state = 'WaitingRelationship' ;") or die($con->error);    
                        while($row = mysqli_fetch_assoc($sqlCheck)) {
                          $friendsLove[] = array ( 
                              array($row['useridRequester'])
                            ); 
                        }
                        
                        if (!isset($friendsLove)) { 
                            //if thez havent sent u a req yet
                            $sqlCheck = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$requestedID' AND useridRequester = '$sessionUserID' AND request_state = 'WaitingRelationship' ;") or die($con->error);    
                            while($row = mysqli_fetch_assoc($sqlCheck)) {
                              $friendsLoveThem[] = array ( 
                                  array($row['useridRequester'])
                                ); 
                            } 
                            if (!isset($friendsLoveThem)) { 
                                echo '<a class="hrefColor " style="cursor:pointer; " href="api/sendRelationshipRequest?name='.$requestedID.'">'. $lang_get_profile_actions_love_friend .'</a> ' ; 
                            }
    
                       } 
                      } 

                    }

                  }

                } 
                  ?> 
                  <a class="hrefColor" style='cursor:pointer;'> <?php echo $lang_get_profile_actions_message_friend; ?> </a> 
                </div>  

                <div class="dropdown2" style="z-index:998;"> 
                  <?php   
                  echo '<div id="profile2" class="dropdown-content systemcolor-noborder" style="width: 190px;margin-top:-66px;">' ;  
                  ?>  
                  <a href="#" class="hrefColor" style='pointer-events: none;'> <?php echo $lang_get_profile_actions; ?> </a>  
                  <hr>  
                  <?php echo '<a class="hrefColor " style="cursor:pointer;color: #ff483b !important;" href="api/blockperson?name='.$requestedID.'"> '. $lang_get_profile_actions_block_friend .' </a> ' ?>   
                  <a class="hrefColor " style="cursor:pointer; " onclick="menu('report')"  > 📝 Report </a>  
                  <a onclick="menu('sharePerson')" class="hrefColor " style="cursor:pointer; " > 📤 Share </a>  
                  </div> 
                  </div> </div> </div>  

       <?php   
        $_SESSION['beforeurl'] = $_SERVER["REQUEST_URI"]; 

        if (!isset($_SESSION['newuser'])) { 
            if ($sessionUserID == $requestedID) { 
              echo "<form action='edit' method='get' name='editprofile'>  
              <input class='float' style='float:right;' id='editProfile' name='' type='submit' value='". $lang_get_profile_edit."' />
              </form>"; 
          }
          else {
            $sqlCheckReq = $con->query("SELECT useridRequester FROM requests WHERE useridRequested = '$requestedID' AND userIdRequester = '$sessionUserID'  AND request_state = 'Waiting';") or die($con->error);    
            while($row = mysqli_fetch_assoc($sqlCheckReq)) {
              $friends[] = array ( 
                  array("UserID",$row['useridRequester'])
                ); 
            } 
            if (!isset($friends)) {
                // sql on like 86
              if (isset($friendsCheck)) { 
                $friendsn = 1;
                echo '<form action="api/deletefriend?" method="get"> <input type="hidden" name="name" value="' . $requestedID . '">  <input style="float:right;" class="float mobileRemoveFrienddisable" type="submit" name="submit" value="'.$lang_get_profile_delete_friend.'"> </form>';
              }
              else {
                $sqlCheckFriendsReqThem = $con->query("SELECT id FROM requests WHERE userIdRequester = '$requestedID' AND useridRequested = '$sessionUserID' AND request_state = 'Waiting';") or die($con->error);    
                while($row = mysqli_fetch_assoc($sqlCheckFriendsReqThem)) {
                  $friendsReqThem[] = array ( 
                      array("id",$row['id'])
                    ); 
                } 
                if (!isset($friendsReqThem)) {
                  echo '<form action="api/sendrequest?" method="get"> <input type="hidden" name="request" value="' . $requestedID . '">  <input style="float:right;" class="float" type="submit" name="submit" value="'.$lang_get_profile_add_friend.'"> </form>';
                }
                else {
                  echo "<div>"; 
                  $_SESSION['beforeurl'] = $_SERVER["REQUEST_URI"]; 
                  echo "<p style = 'float:left;margin-top:-2px;'> ", '<form action="api/deleterequest?name="' . $requestedID. '"" method="post"> <input type="hidden" name="name" value="' .$requestedID . '">  <input type="hidden" name="postid" value="' .$requestedID. '"> <input class="float" style="float:right;margin-left:10px;" type="submit" name="submit" value="'.$lang_get_profile_deny_request.'"> </form>', '<form action="api/acceptrequest?name="' . $requestedID. '"" method="post"> <input type="hidden" name="name" value="' .$requestedID. '">  <input type="hidden" name="postid" value="' .$requestedID. '"> <input class="float" style="float:right;" type="submit" name="submit" value="'.$lang_get_profile_add_request.'"> </form>';
                  echo "</div>";
                }
              }
            } 
            else { 
              $sqlCheckFriendsReqThem = $con->query("SELECT id FROM requests WHERE userIdRequester = '$requestedID' AND useridRequested = '$sessionUserID' AND request_state = 'Waiting';") or die($con->error);    
              while($row = mysqli_fetch_assoc($sqlCheckFriendsReqThem)) {
                $friendsReqThem[] = array ( 
                    array("id",$row['id'])
                  ); 
              }  

          if (!isset($friendsReqThem)) {
            echo '<input style="float:right;cursor: default !important;" type="submit" name="submit" value="'. $lang_get_profile_requested .'">'; 
              }
              else {
                echo "<div>";
                $_SESSION['beforeurl'] = $_SERVER["REQUEST_URI"]; 
                echo "<p style = 'float:left;margin-top:-2px;'> ", '<form action="api/deleterequest?name="' . $requestedID. '"" method="post"> <input type="hidden" name="name" value="' .$requestedID . '">  <input type="hidden" name="postid" value="' .$requestedID. '"> <input class="float" style="float:right;padding-right:20px;" type="submit" name="submit" value="Deny"> </form>', '<form action="api/acceptrequest?name="' . $requestedID. '"" method="post"> <input type="hidden" name="name" value="' .$requestedID. '">  <input type="hidden" name="postid" value="' .$requestedID. '"> <input class="float" style="float:right;" type="submit" name="submit" value="Add"> </form>';
                echo "</div>";
              }
            }
          }
        } 
        ?>  
        <div> 
          
        <b><p><?php echo '<p style="display:inline;";>'; if (isset($info[0][1][1])) { echo $info[0][1][1]; }  ?> <?php if (isset($info[0][2][1])) { echo $info[0][2][1]; } ?> <?php echo '</b> <p style="color:gray;display:inline;";> @'; echo $info[0][12][1]; echo '</p>'; ?> <?php if ($info[0][5][1] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'; } ?> </p></b>
        <?php list($one, $two) = explode(" ", $info[0][4][1], 2);?> 
        
        <?php  
        if (isset($info[0][7][1])) {
          list($onebday, $twobday) = explode(" ", $info[0][7][1], 2);
          $emoji = '🎁';
          $date = $info[0][7][1]; 
          include_once 'api/datedifference.php';
          $returndata = datedifference($date);  
          if ($returndata == "1d") { 
             $emoji = '🎂';
          }
          if (strpos($returndata, 'h') or (strpos($returndata, 'm'))) { 
             $emoji  = '🎂';
          } 
          unset($returndata); 
        } 
        ?> 
        <p class="biotextphone"><?php echo $info[0][3][1]; ?> </p> </div>  

    </div>

    <div id="profileInfo" style="float:left;width:38%;margin-top:1.5vw;margin-right:10px;">
    <?php 
        if ($sessionUserID == $requestedID) {
            echo "<b><p>".$lang_get_profile_your_info."</p></b>";
        }
        else {
            echo "<b><p>".$lang_get_profile_info." </p></b>"; 
        }
        ?> 
      <div class="card-no-hover systemcolor" style="height:auto ; padding:5px 15px;border: 22px solid transparent !important;">
       <?php // <br><p style='margin-bottom:5px;display:inline;'> ⭐ ⭐ ⭐ ⭐ </p> <p style='opacity:0.5; display:inline;'> ⭐ </p> <p style='display:inline;'> (4,201,119) </p>
     
    // echo "<br><br>" ?>
 
      <?php 
        if ($info[0][6][1] == 1 && $friendsn == 0 && $sessionUserID !== $requestedID) {   
            echo "<p>".$lang_get_profile_thisaccount_isprivate."</p>"; 
          }
        else {
 
          // ADD ACCOUNT VIEW 
          $sqladdView = $con->query("SELECT profileViews FROM users WHERE id = $requestedID;" ) or die($con->error); 
          while($row = mysqli_fetch_assoc($sqladdView)) { 
            $paramView = ($row['profileViews']);
           }
          $view = $paramView; 
          $view = $view + 1; 
 
          // $_SESSION['profileView'] = $requestedID; 
          // $_SESSION['profileViewDate'] = 1;

          $con->query("UPDATE users SET profileViews = $view WHERE id = $requestedID;" ) or die($con->error);  
          $viewsnum = 0;   
 
          // Profileviews
          $profileviews = 0; 
          $sql = $con->query("SELECT profileViews FROM users WHERE id=$requestedID ;") or die($con->error);    
          while($row = mysqli_fetch_assoc($sql)) { 
           $param = ($row['profileViews']);
          }
          $n = $param;
          if($n>=1000000000) {
            $n = round(($n/1000000000),1).'B';
          } 
          else if($n>=1000000) {
            $n = round(($n/1000000),1).'M';
          } 
          else if($n>=1000) {
            $n = round(($n/1000),1).'K'; 
          } 
          else { 
            $n = $param;
          }
          $profileviews = $n; 

          // Liked num 
          $sqllikes = $con->query("SELECT SUM(likes) AS sum FROM posts WHERE userid=$requestedID ; ") or die($con->error);  
          $row = mysqli_fetch_assoc($sqllikes); 
          $sum = $row['sum']; 
          $n = $sum;
          if($n>=1000000000) {
            $n = round(($n/1000000000),1).'B';
          } 
          else if($n>=1000000) {
            $n = round(($n/1000000),1).'M';
          } 
          else if($n>=1000) {
            $n = round(($n/1000),1).'K'; 
          } 
          else { 
            $n = $sum;
          }
          $likesnum = $n; 

          if (!isset($n)) {
            $likesnum = 0;
          }

          // Loved Num
          $lovedsnum = 0; 
 
          echo '   <center> <p style="font-size:18px;">
          
           🤩 '.$profileviews.'
           👍 '.$likesnum.'
           ❤️ '.$lovedsnum.' 
         
          </p> </center>  <hr>  ';
 

          echo "<p style='padding-top:-20px;'> ".$lang_get_profile_joined."" . $one . " </p> "; 
          if (isset($onebday)) {
            if ($info[0][7][1] != "0000-00-00 00:00:00") { 
              echo ' <p style="padding-top:-20px;"> '.$emoji.' '.$lang_get_profile_birthday.' '. $onebday .' </p>';
            }
           
          }
          if (isset($info[0][9][1])) {
            //'.$lang_get_profile_location.'
            if ($info[0][9][1] != "" && " ") {
              echo ' <p style="padding-top:-20px;"> 🌎 '. $info[0][9][1] .' </p>'; 
            }
          }  
          if ($info[0][6][1] == 1) {
            echo ' <p style="padding-top:-20px;"> '.$lang_get_profile_privateaccount.'</p>';
          }  
          if (isset($info[0][10][1])) { 
            // if they in relationship with you 
            if ($info[0][10][1] != -1) {
              if ($info[0][10][1] == $sessionUserID) { 
                echo ' <p style="padding-top:-20px;"> ❤️ You </p>';
              }
              else {  
                $relId = $info[0][10][1]; 
                $sqlNames = $con->query("SELECT username FROM users WHERE id = '$relId';" ) or die($con->error);    
                while($rowNames = mysqli_fetch_assoc($sqlNames)) {   
                   $names[] = array (
                      array($rowNames['username'])
                    ); 
                } 
                echo ' <p style="padding-top:-20px;"> ❤️ '. $names[0][0][0] .' </p>'; 
                unset($names);
              }
            } 
          }  
          $num = $info[0][8][1];   
          if (isset($info[0][11][1])) { 
            if ($info[0][11][1] != "" and " ") {
              echo ' <p style="padding-top:-20px;"> 🎶 '.$info[0][11][1] .'</p>'; 
            } 
          }
          echo "<p style='padding-top:-20px;'> 💯 ". number_format($num) . " </p> ";  
        } 
        ?>
      </div>
      <?php 
        $sql = $con->query("SELECT COUNT(*) AS userid FROM friends WHERE userid = $requestedID;") or die($con->error);    
        while($row = mysqli_fetch_assoc($sql)) { 
          $count = ($row['userid']);  
        } 
      
        if ($sessionUserID == $requestedID) { 
            echo "<b><p>".$lang_get_profile_yourfriends."".number_format($count)." </p></b>";
        }
        else {  
            if ($info[0][6][1] == 0) {  
              $sqlCountMutual = $con->query("SELECT f1.`useridFriend` as common_friend
              FROM friends as f1 join friends as f2
                  USING (`useridFriend`)
              WHERE f1.`userid` = '$requestedID' and f2.`userid` = '$sessionUserID' 
              AND f1.friendstate = 'Friends' and f2.friendstate = 'Friends';") or die($con->error); 
              while($row = mysqli_fetch_assoc($sqlCountMutual)) {   
                 $common_friends[] = array($row['common_friend']);
              }
              if (isset($common_friends)) {
                $mutualcount = count($common_friends);  
                
                echo "<b> <p> ". $lang_get_profile_theirfriends ." ". number_format($count)." </b>";
                if (!isset($_SESSION['newuser'])) {  
                  echo "<br> <p> ".$lang_get_profile_incommon1." " . $mutualcount . " ".$lang_get_profile_incommon2."</p> ";
                }
              }
              else {  
                echo "<b><p>".$lang_get_profile_theirfriends."". number_format($count)." </b>";
                if (!isset($_SESSION['newuser'])) { 
                  echo "<br> <p>".$lang_get_profile_noneincommon."</p> "; 
                } 
               } 
            } 
            else {
              if ($friendsn == 1) { 
                $sqlCountMutual = $con->query("SELECT f1.`useridFriend` as common_friend
                FROM friends as f1 join friends as f2
                    USING (`useridFriend`)
                WHERE f1.`userid` = '$requestedID' and f2.`userid` = '$sessionUserID' 
                AND f1.friendstate = 'Friends' and f2.friendstate = 'Friends';") or die($con->error); 
                while($row = mysqli_fetch_assoc($sqlCountMutual)) {   
                   $common_friends[] = array($row['common_friend']);
                }

                if(isset($common_friends)) {
                  $mutualcount = count($common_friends);     

                }
                else {
                  $mutualcount=0;
                }

 
                echo "<b><p>".$lang_get_profile_theirfriends."". number_format($count)." </b>";
                echo "<br> <p>".$lang_get_profile_incommon1."" . number_format($mutualcount) . "".$lang_get_profile_incommon2."</p> ";
              }
              else { 
                echo "<b><p>".$lang_get_profile_theirfriendsnodot."</p></b>"; 
              } 
            }

        }
        ?> 
 
      <div style="border: 0px solid transparent;" id='fetchfriends' class="friends "> 
        <?php 
        $private = $info[0][6][1];
        $requestedID = $info[0][0][1]; 
        $fetch = "ID";
        $accountToken = $_COOKIE['accountToken']; 
        if ($noprofile != 1) { include 'api/friendsfetch.php';  } 
        
        ?>  <?php include('api/links.php'); ?>
      </div>    
    <div id='profilePosts' style="float:right;width:60%;margin-top:1.5vw;">  
          <script type="text/javascript">
              var session_id = '<?php echo $_SESSION["id"];?>';
              var setting = 'feedpreference';
          </script>
        <div> <h2>  <script type="text/javascript" src="api/feedchange.js"></script></h2></div>  

        <?php    
          if (!isset($_SESSION['newuser'])) {  
            $sqlpost = $con->query("SELECT COUNT(*) AS userid FROM posts WHERE userid = $requestedID;") or die($con->error);    
            while($row = mysqli_fetch_assoc($sqlpost)) { 
              $countp = ($row['userid']);  
            }  
            $sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
              $preference = $row['feedtype'];
            } 
            if ($preference == 0) {
              $preference = 1;
              echo '<button id="changefeed2" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;"><p style="margin-top:-10px;position: relative;overflow: hidden;"> 💭 </p></button>';
            }
            else {
              $preference = 0;
              echo '<button id="changefeed2" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;"><p style="margin-top:-10px;position: relative;overflow: hidden;"> 💫 </p></button>';
            } 
          }
          else {
            $preference = 1;
          }  
          ?> 
          <?php  
        if ($sessionUserID == $requestedID) {    

            echo "<b><p>". $lang_get_profile_yourposts ."". number_format($countp)." </b> <a class='hoverAnimation' style='float:right;text-decoration:none;cursor:pointer;'>".$lang_get_profile_likedposts."</a></p>";
            echo "<div class='card-no-hover systemcolor' style='border: 25px solid transparent !important; height:140px;margin-bottom:40px;border-bottom: 0px solid transparent !important;' >";
            include 'api/post.php'; 
            echo "</div>";
          }
        else { 
          if ($info[0][6][1] == 0) {
            if (!isset($_SESSION['newuser'])) { 
              echo "<b><p>".$lang_get_profile_posts ."". number_format($countp)." </b> <a class='hoverAnimation' style='float:right;text-decoration:none;cursor:pointer;'>".$lang_get_profile_likedposts."</a></p>";  
            }
            else { 
              echo "<b><p>".$lang_get_profile_posts ."". number_format($countp)." </b> </p>";
            }
          } 
          else {
            if ($friendsn == 1) {
              echo "<b><p>".$lang_get_profile_posts ."". number_format($countp)." </b> <a class='hoverAnimation' style='float:right;text-decoration:none;cursor:pointer;'>".$lang_get_profile_likedposts."</a></p>";
            }
            else {
              echo "<b><p>".$lang_get_profile_postsnodot." </b> </p>";
            } 
          } 
        } 
        ?> 
      <?php 
        $requestedID = $info[0][0][1]; 
        $private = $info[0][6][1] == 0;
        $fetch = "ID";
        if ($noprofile != 1) { include 'api/postfetch.php'; } ?> 
    </div> 
    </div>
    </div>
</div> 