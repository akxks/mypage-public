
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
require('lang.php');  
unset($usernames); 

if(!isset($_SESSION["id"])){
	exit;
}
$sessionUserID = $_SESSION['id']; 
$suggestedfriends = array(); 
$fetch = "home"; 
$posts = array();

if (empty($friends)) {   
   echo '<p style="padding:20px; " > '.$lang_suggestedfriends_nosuggestions.' </p> '; 
 } else { 
   if ($fetch == "home") {
      //FETCHING FOR HOME PAGES 
      // GETTING FRIENDS for SUGGESTED array 
      $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$sessionUserID' AND friendstate = 'Friends'; " ) or die($con->error); 
      $friends = array(); 
      while($row = mysqli_fetch_assoc($sql)) { 
         unset($mutualcount);
            $individualfriend = $row['userid']; 
            $sqlCountMutual = $con->query("SELECT f1.`useridFriend` as common_friend
            FROM friends as f1 join friends as f2
               USING (`useridFriend`)
            WHERE f1.`userid` = '$individualfriend' and f2.`userid` = '$sessionUserID' 
            AND f1.friendstate = 'Friends' and f2.friendstate = 'Friends';") or die($con->error); 
            while($row = mysqli_fetch_assoc($sqlCountMutual)) {   
               $common_friends[] = array($row['common_friend']);
            }
            if (isset($common_friends)) {
               $mutualcount = count($common_friends);  
            }
            else {
               $mutualcount = 0;
            } 
         $friends[] = array($individualfriend, $mutualcount); 
      }  
      
      // FETCHING FRIENDS SUGGESTED
      // COUNTING FRIENDS FOR THE LOOP
      $friendscount = count($friends);   
      $loopnum = $friendscount - 1;  
      
      // SORTING THEM BY AMOUNT OF MUTUAL
      // $size of friends 
      $size = count($friends)-1;
      //BUBBLE SORT LOOP
      for ($i=0; $i<$size; $i++) {
         for ($j=0; $j<$size-$i; $j++) {
            //Bubble Sort Adding
            $k = $j+1;
            // CHECKING THE MUTUAL WHICH IS MORE
            if ($friends[$j][1] < $friends[$k][1]) {
               // SWAPPING THE VARIABLES AND PLACING THEM IN THE RIGHT PLACE
               list($friends[$j], $friends[$k]) = array($friends[$k], $friends[$j]);
            } 
            //// sghould work nowww!!!!! try itt/ // //  / / / / // / / / //  /Cus i added j and K 
         }
      } 
      //FINALLY SORTED $friends   BY THE AMOUNT OF MUTUALS
    //  var_dump($friends);
     
   $reccomendedFriends = array();

    $i = 0;
    foreach ($friends as $row) { 
   
      //echo "userid:";
      //echo $row[0];
      //echo "mutual count:";
      //echo $row[1]; 

      //$friendTemp = $row[0];
      //if ($row[1] == 0) {
      //   break;
      //}

      // if the results are more than 5, just stop the loop 
      if ($i > 5) {
         break;
      }
      $i++;
      //echo $row[0];
      //gett all of the top mutuals friends friends
      $getfriends = $con->query("SELECT userid FROM friends WHERE useridFriend = '$row[0]' AND friendstate = 'Friends';") or die($con->error);    
      
      while($rowz = mysqli_fetch_assoc($getfriends)) {
         // check if the mutuals friends friend is friends with you 
         $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$rowz[userid]' AND userid = '$sessionUserID' AND friendstate = 'Friends';" ) or die($con->error); 
         while($rows = mysqli_fetch_assoc($sql)) { 
            $friendCheck = $rows['userid'];
         } 
 
         //if u blocked them, dont show  
         $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$rowz[userid]' AND useridBlocker = '$sessionUserID';" ) or die($con->error);  
         $infoBlocked = array();
         
         while($row = mysqli_fetch_assoc($sqlBlocked)) {
            $infoBlocked[] = array (
               array("UserID",$row['id']));
            }
         if (!empty($infoBlocked)) {  
            $blocked = 1;
         }   

         // if they blocked you, dont show. 
         $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$sessionUserID' AND useridBlocker = '$rowz[userid]';" ) or die($con->error);  
         $infoBlocked2 = array();
         
         while($row = mysqli_fetch_assoc($sqlBlocked)) {
            $infoBlocked2[] = array (
               array("UserID",$row['id']));
            } 
         if (!empty($infoBlocked2)) {  
            $blocked = 1;
         } 

         // check if you sent them a friend req
         $sqlCheckFriendsReqThem = $con->query("SELECT id FROM requests WHERE userIdRequester = '$sessionUserID' AND useridRequested = '$rowz[userid]' AND request_state = 'Waiting';") or die($con->error);    
         while($row = mysqli_fetch_assoc($sqlCheckFriendsReqThem)) {
           $friendsReqThem[] = $row['id']; 
         } 

         //if not friends with you, add them to the RECCOMENDED FRIENDS array
         if (!isset($friendCheck)) { 

            // IF you havent sent them a friend request yet. 
             if (!isset($friendsReqThem)) {
 
               // if person is not them. 
               if ($rowz['userid'] != $sessionUserID) {
                     
                  // if the person is not blocked or the one is blocker
                  if ($blocked != 1) { 
                     // IF The person is NOT already in the array, add them to the list.
                     if (!in_array($rowz['userid'], $reccomendedFriends)) {
                        array_push($reccomendedFriends, $rowz['userid']); 
                     }  
                  }
               } 
            } 
         } 
         unset($friendsReqThem); 
         unset($friendCheck);  
      } 
   } 
   if (empty($reccomendedFriends)) {   
      echo '<p style="padding:20px; " > '.$lang_suggestedfriends_nosuggestions.' </p> ';  
   }  
   // show all the reccomended friends 
   $a = 0; 
   foreach ($reccomendedFriends as $eachreccomend) { 

      if ($a > 5) {
         break;
      }
      $a++;

      $private = array();
      $friends = array();  
      $sqlNames = $con->query("SELECT username,verified,private,location,score FROM users WHERE id = '$eachreccomend';") or die($con->error);    
      while($rowNames = mysqli_fetch_assoc($sqlNames)) {  
         $usernames[] = array($rowNames['username']);   
         $verified[] = array($rowNames['verified']); 
         $private[] = array($rowNames['private']); 
         $location[] = array($rowNames['location']); 
         $score[] = array($rowNames['score']); 
      }  

      if ($private[0][0] == 1) {   
         $underneath = " 🔒 "; 
       }
      else { 
       if (isset($location[0][0])) { 
         $underneathLoc = ' 🌎 '. $location[0][0] .' ';
       } 

       $num = $score[0][0]; 
       $formattedNum = number_format($num);  
       $underneath =  " • ". $formattedNum . "  ";  

      }
 

      $usernameReqe = $con->query("SELECT username FROM users WHERE id='$eachreccomend';") or die($con->error);    
      while($row = mysqli_fetch_assoc($usernameReqe)) { 
        $requestedUsername = ($row['username']);
      } 

      echo "<a style='cursor:pointer;' href='profile?u=".$requestedUsername."'>  <div style='padding: 0px 12px;'>"; 
 
      $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$eachreccomend'") or die($con->error); 
      while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
   
      if ($verified[0][0] == 1) {
         //with add button. removed due to being too big and text overflowing 
         //echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow' alt='Profile Picture' ><p style='padding-left:10px;margin-top:6px;padding-top:3px;float:left;'> ". $firstnames[0][0], " ", $lastnames[0][0], '<img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'." <br> ". $underneath ."<form action='api/sendrequest?' method='get'> <input type='hidden' name='request' value='" . $eachreccomend . "'>  <input type='hidden' name='fromhome' value='home'>  <input style='float:right;' class='float' type='submit' name='submit' value='".$lang_get_profile_add_request."'> </form> </p> <br> <br> <br> </div>";
         echo "<div style='padding: 5px;'> <img class='nodrag imageshadow' src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow' alt='Profile Picture' ><p style='padding-left:10px;margin-top:6px;padding-top:3px;float:left;color:gray;'> @". $usernames[0][0], '<img class="float nodrag" src="image/verified.png" height= "auto;" width="18px;" style="float:none; " alt="Verified Sticker"> '." <br> ". $underneath ." </p> <br> <br> <br> </div> ";
      }
      else {
         //with add button. removed due to being too big and text overflowing 
         //echo "<div style='padding: 5px;'> <img src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow' alt='Profile Picture' ><p style='padding-left:10px;margin-top:6px;padding-top:3px;float:left;'> ". $firstnames[0][0], " ", $lastnames[0][0]." <br> ". $underneathLoc, $underneath . "<form action='api/sendrequest?' method='get'> <input type='hidden' name='request' value='" . $eachreccomend . "'> <input type='hidden' name='fromhome' value='home'> <input style='float:right;' class='float' type='submit' name='submit' value='".$lang_get_profile_add_request."'> </form> </p> <br> <br> <br> </div>";
         echo "<div style='padding: 5px;'> <img class='nodrag imageshadow' src='".$contenturlimg."' height= '50px;' width='50px;' style='border-radius:50%;float:left; ' class='imageshadow' alt='Profile Picture' ><p style='padding-left:10px;margin-top:6px;padding-top:3px;float:left;color:gray;'> @". $usernames[0][0], " <br> ". $underneathLoc, $underneath . " </p> <br> <br> <br> </div>";
      }
      
      unset($contenturlimg);  
      unset($usernames);
      unset($verified);
      unset($location);
      unset($underneathLoc);
      unset($score);
      echo "</div></a>"; 
   } 
   } 
}   
?>