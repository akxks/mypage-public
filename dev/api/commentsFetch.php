
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
---> 
<script> 

function actionComment(session_id, userid_post, post_id, location, interaction, account_token, comment_id) { 
   var data = {session_id, userid_post, post_id, location, interaction, account_token, comment_id};

   $(document).ready(function() {  
         $.ajax({ 
               type: "GET", 
               cache: false,
               data: data,
               url: "api/actionPostComment",  
               success: function(html) {  

                  if (interaction == "Like") { 
                     var str = document.getElementById("likebuttonComment" + post_id).value;
                     var stringArray = str.split(/(\s+)/);  
                     var newNum = parseInt(stringArray[0]);

                     var text = (document.getElementById("likebuttonComment" + post_id).getAttribute("style")); 
                     
                     (newNum = newNum || 0);
                     if (text == null) { 

                        document.getElementById("likebuttonComment" + post_id).value = ((newNum + 1) + " 👍");   
                        document.getElementById("likebuttonComment" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 
                     }
                     else {

                        if (text == "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") {
                           document.getElementById("likebuttonComment" + post_id).value = ((newNum + 1) + " 👍");   
                           document.getElementById("likebuttonComment" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 


                        }
                        else {
                           
                           if (newNum == 1) {
                              document.getElementById("likebuttonComment" + post_id).value = (" 👍"); 
                           }
                           else {
                              document.getElementById("likebuttonComment" + post_id).value = ((newNum - 1) + " 👍"); 
                           }
                             
                           document.getElementById("likebuttonComment" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                        }
                        
                     }
                     
                  } 
                   
                  if (interaction == "DeleteComment")  {
 
                        var dataforsuccess = {session_id, post_id, account_token};
 
                        $.ajax({ 
                           type: "POST", 
                           url: "api/deletecomment", 
                           data: { 
                              session_id: session_id, 
                              account_token: account_token,
                              comment_id: comment_id ,
                              post_id: post_id
                           }, 


                        success: function(html) { 

                           $.ajax({ 
                           type: "GET", 
                           cache: false,
                           data: dataforsuccess,
                           url: "api/commentsFetch",  
                           success: function(html) {$("#commentsection").html(html).show(); document.getElementById("commenttext").value = "";  document.getElementById("postCommentButton").style.display = "none";}
                           });  
                        
                        } 
                        
                        }); 
                  }
               }
         }); 
   });
} 
</script>


<style>
.fit-image { 
   border-right-width: 0px !important;border-left-width: 0px !important;
}  
.text-border {
   overflow-wrap:anywhere;overflow-wrap: break-word;border-left: 35px solid transparent !important;border-right: 35px solid transparent !important;
}
.size{
   color:black;
}
</style> 

<?php
require('db.php');  
require('lang.php'); 
include('button.php'); 

//if (isset($_SESSION['shared'])) { successShare(); }; 

$sessionUserID = $_GET['session_id'];
$postId = $_GET['postid'];

if (!is_numeric($sessionUserID)) {
  exit; 
}

if (!is_numeric($postId)) {
  exit; 
} 

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$accountToken = $_GET['account_token']; 
     
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
 
// unsetting the variables, for a fresh Home page -- with no errors

unset($names);
//getting the session user id  
//assigning the comments array
unset($comments);
$comments = array(); 
$postEach = array();  

   // GET WHAT TO SORT , LIKES OR TIME
   $sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['feedtype'];
   }
 
   $comments = $comments;
   // for specific people (Ids) for specific profiles, we can use the ORDER BY create_date DESCENDING function of MySQL, it makes the process simpler.

    if ($preference == 0) { 
        $sql = $con->query("SELECT * FROM comments WHERE postId = '$postId' ORDER BY likes DESC;" ) or die($con->error);
    }
    else {
        $sql = $con->query("SELECT * FROM comments WHERE postId = '$postId' ORDER BY create_date DESC;" ) or die($con->error); 
    } 

   while($row = mysqli_fetch_assoc($sql)) {   
      $sqlNames = $con->query("SELECT username FROM users WHERE id = '$row[userid]';" ) or die($con->error);    
      while($rowNames = mysqli_fetch_assoc($sqlNames)) {   
         $names[] = array (
            array($rowNames['username']),
            array($rowNames['username']) 
          ); 
      } 
      $comments[] = array ( array("Comment", 
         array("UserID",$row['userid']),
         array("comments",$row['post']),
         array("commentid",$row['id']),
         array("Shares",$row['likes']),
         array("Comments",$row['likes']),
         array("CreateDate",$row['create_date']),
         array("PostID",$row['postId']),
         array("type",$row['likes']),
         array("imgurl",$row['likes']), 
         array("isShare",$row['likes']),
         array("sharePostId",$row['likes']) 
         )
       ); 
   } 

   //var_dump($comments[1][0][1][1]); //  id 
   //var_dump($comments[1][0][2][0]); // comments 
   //var_dump($comments[1][0][3][0]); // likes 
   //var_dump($comments[1][0][4][0]); // shares 
   //var_dump($comments[1][0][5][0]); // comments 
   //var_dump($comments[1][0][6][0]);  // create date 
   //var_dump($comments[1][0][7][0]);  // postid 
   // 8 type
   // 9 imgurl 
   // 10 state 
   // 11 isShare 
   // 12 sharePostId   

   $postnum = count($comments); 
   $commentsloopnum = 0;  
   
   while ($commentsloopnum != $postnum) {   
      unset($names);     
      unset($returndata);
      unset($date);
      unset($locationdata);
      unset($fetchedLocation);
      unset($namesRel);  
      unset($deleteC);

      $userid = $comments[$commentsloopnum][0][1][1]; 
      $sqlNames = $con->query("SELECT username, verified, private FROM users WHERE id = '$userid';" ) or die($con->error);  
      while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
         $names[] = array (
            array($rowNames['username']),
            array($rowNames['username']), 
            array($rowNames['verified']),
            array($rowNames['private']) 
            ); 
      }   
      $date = $comments[$commentsloopnum][0][6][1]; 
      //$returndata = datedifference($date); 

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
  
      $margin = 'margin-top:10px;';
            
      $postid = $comments[$commentsloopnum][0][7][1];
  
              
         $isLikedAlreadyComment = $con->query("SELECT id FROM interactions WHERE postid = '$postid' AND userid = $sessionUserID AND type = 'Like' AND comment = 1;" ) or die($con->error); 

         while($rowsID = mysqli_fetch_assoc($isLikedAlreadyComment)) { $isLikedAlreadyCommentFinal = $rowsID['id']; }  
   
         if ($comments[$commentsloopnum][0][1][1] == $sessionUserID) { 
           
            $deleteC = '
            
            <a class="deleteComment" onclick="actionComment(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$comments[$commentsloopnum][0][7][1].'\',\''."home".'\',\''."DeleteComment".'\',\''.$_COOKIE["accountToken"].'\',\''.$comments[$commentsloopnum][0][3][1].'\' )">  <input id="deleteCommentComment'.$comments[$commentsloopnum][0][7][1].'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="🗑️"> </form> </a>
            
            ';

         }


         $responseC = '
            
         <a class="responseComment" onclick="actionComment(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$comments[$commentsloopnum][0][7][1].'\',\''."home".'\',\''."DeleteComment".'\',\''.$_COOKIE["accountToken"].'\',\''.$comments[$commentsloopnum][0][3][1].'\')">  <input id="responseCommentComment'.$comments[$commentsloopnum][0][7][1].'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="🔄"> </form> </a>
         
         ';

         if (isset($isLikedAlreadyCommentFinal)) {
            echo '
            
            '.$deleteC.'
            
            <a class="interactComment" onclick="actionComment(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$comments[$commentsloopnum][0][7][1].'\',\''."home".'\',\''."Like".'\',\''.$_COOKIE["accountToken"].'\',\''.$comments[$commentsloopnum][0][3][1].'\')">  <input id="likebuttonComment'.$comments[$commentsloopnum][0][7][1].'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedLike.' 👍" style="text-shadow: 0px 0px 13px rgba(247, 155, 67, 0.9) !important;"> </form> </a>

            '; 
         }

         else {

            echo '
            

            '.$deleteC.'

            <a class="interactComment" onclick="actionComment(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$comments[$commentsloopnum][0][7][1].'\',\''."home".'\',\''."Like".'\',\''.$_COOKIE["accountToken"].'\',\''.$comments[$commentsloopnum][0][1][3].'\')">  <input id="likebuttonComment'.$comments[$commentsloopnum][0][7][1].'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedLike.' 👍"> </form> </a>

            ';  
         } 

         $poster = $comments[$commentsloopnum][0][1][1]; 
         $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$poster'") or die($con->error); 
         while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
 
         $tempreqid = $comments[$commentsloopnum][0][1][1];
         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$tempreqid';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
           $requestedUsername = ($row['username']);
         } 

         echo "<div style='border-left: 22px solid'> <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '45px;' width='45px;' style=' margin-bottom:10px;float:left;margin-right:10px;border-radius:50%;' alt='Profile Picture'> </a> </div>";
 
         unset($contenturlimg);   

         if ($comments[$commentsloopnum][0][1][1] == $sessionUserID) { 

            if ($returndata == "0m") { 
               echo "<b> <p style='". $margin ."'> ". $names[0][0][0] . "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo $shared; echo " <br> ".$lang_just_now." ". $locationdata . "  <b> <a style=' text-decoration: none !important;' onclick='replyComment'> </a> </b> </br> </p> <a> </a> ";  
            }
            else {
               echo "<b> <p style='". $margin ."'> ". $names[0][0][0] . "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }   echo $shared;  echo " <br> ". $returndata . " ago ". $locationdata . "  <b> <a style=' text-decoration: none !important;' onclick='replyComment'> </a> </b> </br> </p> <a> </a> ";  
            }
         } 

         else { 
            if ($returndata == "0m") { 
               echo "<b> <p style='". $margin ."'> ". $names[0][0][0] . "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }   echo $shared;   echo " <br> ".$lang_just_now. "". $locationdata . "  <b> <a style=' text-decoration: none !important;' onclick='replyComment'>  </a> </b> </br> </p> <a> </a> ";  
           }
            else {
               echo "<b> <p style='". $margin ."'> ". $names[0][0][0] . "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }   echo $shared;  echo " <br> ". $returndata . " ago ". $locationdata . " <b> <a style=' text-decoration: none !important;' onclick='replyComment'>  </a> </b> </br> </p> <a> </a> ";  
            }
         }


         $text = strip_tags($comments[$commentsloopnum][0][2][1]); 
         $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);
         $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="profile?u=$1" target="_blank">$0</a>', $text); 
 
         echo "<div class='text-border'> <p style='font-size:17px; '> ". $text ."</p> </div>"; 
   
         echo '</div>'; 
 
         echo '<br>';

   $commentsloopnum = $commentsloopnum + 1;  
}   

?>