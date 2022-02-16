
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
---> 

<?php 

require('db.php');  
require('lang.php'); 
require('modals.php'); // for success

$sessionUserID = $_GET['userid'];
$postId = $_GET['postid'];

if (!is_numeric($sessionUserID)) {
  exit; 
}

if (!is_numeric($postId)) {
  exit; 
}

$sql = $con->query("SELECT userid FROM posts WHERE id='$postId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $personId = ($row['userid']);
} 

$sql = $con->query("SELECT username FROM users WHERE id='$personId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $usernamePerson = ($row['username']);
} 

?>

<script> 


</script>

<?php  
  echo ' 
  <script>
  var modal = document.getElementById("commentmodal");
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
      document.getElementById("body").style.overflow = "scroll";
      document.getElementById("body").style.overflowX = "hidden";

    }
  }

  function modalClose () {
    var modal = document.getElementById("commentmodal");  
      modal.style.display = "none";
      document.getElementById("body").style.overflow = "scroll";
      document.getElementById("body").style.overflowX = "hidden";

  }

  </script>

  <div id="commentmodal" style="display:none;" class="modal">  
    <div id="commentsmodalbox" class="modal-content internetOffline internetOfflineText" style="height: auto; max-height:600px; width: 50%; max-width: 800px; overflow: scroll;  overflow-x:hidden; "> 

    '; 

    if ($sessionUserID == $personId) {
      echo ' 
       <h2>Comment on your post </h2>  
       
  
       ';
      } else { 

      echo ' 
      <h2>Comment on '.$usernamePerson.'\'s post </h2>  
      
 
      ';
    }

     //getting the session user id 
     $sessionUserID = $sessionUserID;
     //assigning the posts array
 
      $posts = array(); 
      $sql = $con->query("SELECT * FROM posts WHERE id = '$postId'") or die($con->error);   
      while($row = mysqli_fetch_assoc($sql)) { 
        // POSTS ARRAY With all the posts variables
        $posts[] = array ( array("Post", 
        array("UserID",$row['userid']),
        array("Posts",$row['post']),
        array("Likes",$row['likes']),
        array("Shares",$row['shares']),
        array("Comments",$row['comments']),
        array("CreateDate",$row['create_date']),
        array("PostID",$row['id']),
        array("Type",$row['type']),
        array("Imgurl",$row['imgurl'])
          ) 
          ); 
      } 
      
      //var_dump($posts[1][0][1][1]); // user id 
      //var_dump($posts[1][0][2][0]); // posts 
      //var_dump($posts[1][0][3][0]); // likes 
      //var_dump($posts[1][0][4][0]); // shares 
      //var_dump($posts[1][0][5][0]); // comments 
      //var_dump($posts[1][0][6][0]);  // create date 
      //var_dump($posts[1][0][7][0]);  // postid 
      // 8 type
      // 9 imgurl 
      // 10 state  
     
          $userid = $posts[0][0][1][1]; 
          $sqlNames = $con->query("SELECT username, verified, private FROM users WHERE id = '$userid';" ) or die($con->error);  
          while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
            $names[] = array (
                array($rowNames['username']), 
                array($rowNames['verified']),
                array($rowNames['private']) 
                ); 
          } 

         $date = $posts[0][0][6][1]; 

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
 
           if ($userid == $sessionUserID) {  
              $margin = 'margin-top:-8px;';
              if ($fetch == "ID") {
                 $margin = 'margin-top:10px;';
              }
              $marginImg = 'margin-top:-14px;';
           }
           else {
              $margin = 'margin-top:10px;';
              $marginImg = 'margin-top:0px ;';
           }
           
           $postid = $postId;
     
           if ($posts[0][0][8][1] != 4) {
                 
              echo '<div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; border-bottom: 15px !important;margin: 15px !important; padding-bottom: 3px !important; ">';  
      
              $poster = $posts[0][0][1][1]; 
              $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$poster'") or die($con->error); 
              while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
      
              echo "<div style='border-left: 22px solid'> <a href='profile?u=" .$posts[0][0][1][1]. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '55px;' width='55px;' style='float:left;margin-right:20px;border-radius:50%;margin-top:10px;$marginImg' alt='Profile Picture'> </a> </div>";
      
              unset($contenturlimg); 
     
              $fetchedLocation = $con->query("SELECT `location` FROM posts WHERE id = '$postid';" ) or die($con->error); 
              while($rowsID = mysqli_fetch_assoc($fetchedLocation)) { $fetchedLocationr = $rowsID['location']; }  

              if (isset($fetchedLocatior)) { 
                 if ($fetchedLocationr != "") {
                    $locationdata = '• 🌎 ' . $fetchedLocationr .'';
                 }
              }
      
                if ($returndata == "0m") { 
                  echo "<b> <p style='". $margin ."'> ". $names[0][0][0] .  "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ".$lang_just_now. "". $locationdata . " </br> <br></p>  ";  
                }
                else {
                  echo "<b> <p style='". $margin ."'> ". $names[0][0][0] . "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ". $returndata . " ago ". $locationdata . "</br> <br></p>  ";  
                }

              if ($posts[0][0][8][1] == 0) { 
                 if (strlen(trim($posts[0][0][2][1])) == 0) {
                 }
                 else {
                    $text = strip_tags($posts[0][0][2][1]);
                    $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);
                    $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="profile?u=$1" target="_blank">$0</a>', $text); 
 
                    echo "<div class='text-border'> <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                 } 
                 echo "<div style=' margin-left:none;border: none !important; margin:-20px;'> <center> <img style='width:200px;border-radius: 3px;  margin-bottom: 5px; margin-top:15px;' class='nodrag' src='". $posts[0][0][9][1]. "' alt='Post'> </a> </center> </div> <br>"; 
              }
              elseif ($posts[0][0][8][1] == 3) {
 
                 if (strlen(trim($posts[0][0][2][1])) == 0) {
                 }
                 else {
                    $text = strip_tags($posts[0][0][2][1]); 
                    $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text); 
                    $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="profile?u=$1" target="_blank">$0</a>', $text); 
 
                    echo "<div class='text-border'>  <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                 } 
                 echo  "<div style='position:relative;margin-left:-35px;border: none !important; margin:-15px;'> <center> <video loop style='width:200px;outline:none;margin-top:20px;border-radius: 3px; margin-bottom:20px;' controls muted> <source src='". $posts[0][0][9][1]. "'> </video></center> </div> " ; 
                 echo "<script> $('videoID').get(0).play(); </script>";
              }
              else { 
                 $text = strip_tags($posts[0][0][2][1]); 
                 $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text); 
                 $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="profile?u=$1" target="_blank">$0</a>', $text); 

                 echo "<div class='text-border'> <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>"; 
              }  
        
              $postid = $posts[0][0][7][1];

              echo ' 

              </div>';
            echo '
            
            ';

 
            $sql = $con->query("SELECT * FROM comments WHERE postId = '$postid' ORDER BY create_date DESC;" ) or die($con->error); 
 
            while($row = mysqli_fetch_assoc($sql)) {   

               $comments[] = array ( array("Comment", 
                  array("UserID",$row['userid'])
                  )
                ); 
            } 
            
            if (!isset($comments)) {
 
              echo ' 
              
              <div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; margin: 15px !important; border-bottom: 0px !important;">

              <center> <p style="margin-top:-10px;"> Comments • 0 </p> </center>
              <hr> <br>
              <div id="commentsection"> </div>

              ';
              
            }

            else {


              $count = count($comments);
              

              echo '

              <div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; margin: 15px !important; border-bottom: 0px !important;">


              <script>
              $(document).ready(function() {     
  
                var session_id = '.$sessionUserID.';
                var account_token = "'.$_COOKIE['accountToken'].'";
                var postid = '.$postId.';
    
                var data = {session_id, postid, account_token};
    
                $.ajax({ 
                  type: "GET", 
                  cache: false,
                  data: data,
                  url: "api/commentsFetch",  
                  success: function(html) {$("#commentsection").html(html).show();   }
                }); 
    
              });
              
              </script>
              
              <center> <p style="margin-top:-10px;"> Comments • '.$count.' </p> </center>
              
              <hr> <br>

              <div id="commentsection"> </div>
              
              ';

            }

 

            echo '
            
            </div>
        
            <form name="sharing" action="api/commentPost" method="post">
        
            ';
            
            $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$sessionUserID'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
    
            echo ' 



            <div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; border-bottom: 15px !important;margin: 15px !important;">

            <script>

            $("#commenttext").on("change keyup paste", function(){
              
              var inputtx = document.getElementById("commenttext"); 

              if (inputtx.value.length == 0) { 
                  document.getElementById("postCommentButton").style.display = "none";
              }  	
              else { 
                document.getElementById("postCommentButton").style.display = "block";
              }  

            })
            
            </script>

            <style>
            .aligned {
                display: flex;
                align-items: center;
                margin-top: -20px;
                width:100% !important;
            }

              
            span {
                padding: 0px;
                position: relative;
            }
        </style>

            <div class="aligned">
                
              <img class="float nodrag imageshadow" src="'.$contenturlimg.'" height= "40px;" width="40px;" style="  margin: 10px; border-radius:50%; margin-top: -5px; " alt="Profile Picture"> 
               
              </img> 
                  
            ';

            $sql = $con->query("SELECT userid FROM comments WHERE postId = '$postId' ORDER BY create_date DESC;" ) or die($con->error); 
            while($row = mysqli_fetch_assoc($sql)) {   
              
              $comments[] = array ( array("Comment", 
                 array("UserID",$row['userid']) 
                 )
               ); 
           } 
        

            if (isset($comments) == 0) {
              echo ' <span style="width:100%;"> <textarea id="commenttext" spellcheck="true" autocomplete="off" type="commenttext" maxlength="500" name="commenttext" class="form-control" rows="2" onkeydown="autoGrow(this);" style=" position: relative; width: 100%; " placeholder="Add first comment " ></textarea>
              ';
            }
            else {
              echo ' <span style="width:100%;"> <textarea id="commenttext" spellcheck="true" autocomplete="off" type="commenttext" maxlength="500" name="commenttext" class="form-control" rows="2" onkeydown="autoGrow(this);" style=" width: 100% important; " placeholder="Add comment " ></textarea>
              ';
            }
            echo '  
            </span>
        </div>
        ';

            echo ' 

            
            <div>
            
            <input class="float" style="position:relative;display:none; " id="text" name="postid" type="postid" value="'.$postId.'" /> 
            
            <input class="float" style="position:relative;display:none; " id="text" name="loc" type="loc" value="home" /> 
            
            <input class="float" style="position:relative;display:none; " id="text" name="sessionuserid" type="sessionuserid" value="'.$sessionUserID.'" /> 

            <input class="float" style="position:relative;display:none; " id="text" name="account_token" type="account_token" value="'.$_COOKIE['accountToken'].'" /> 
            
            <script> 


                  function commentNew() { 
 
                    var session_id = '.$sessionUserID.';
                    var account_token = "'.$_COOKIE['accountToken'].'";
                    var postid = '.$postId.'; 
                    var comment = document.getElementById("commenttext").value; 
                    
                    var dataforsuccess = {session_id, postid, account_token};

                    $.ajax({ 
                      type: "POST", 
                      url: "api/commentPost", 
                      data: { 
                          sessionuserid: session_id,
                          postid: postid,
                          account_token: account_token,
                          commenttext: comment,
                          loc: "home"
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

            </script>  

            <input class="float" style=" 
            
            position:relative;float:right;margin:0px;margin-bottom:0px !important;margin-left:20px;   padding: 10px 25px 8px;
            color: #fff;
            background-color: #ff2449;
            text-shadow: rgba(0,0,0,0.24) 0 1px 0;
            font-size: 16px; 
            border: 2px solid #ff2449;
            box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
            border-radius: 3px;
            margin-top: 0px;
            cursor:pointer; 
            width:125px;
            outline: none; 
            
            box-shadow: 0 0 12px #ff2449;
            " id="postCommentButton" onclick="commentNew()" value="Comment" readonly/> </input> 

              <input class="float" style=" 
              
              position:relative;float:right;margin:0px;margin-bottom:0px !important;margin-left:20px;   padding: 10px 25px 8px;
              color: #fff;
              background-color: #ff2449;
              text-shadow: rgba(0,0,0,0.24) 0 1px 0;
              font-size: 16px; 
              border: 2px solid #ff2449;
              box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
              border-radius: 3px;
              margin-top: 0px;
              cursor:pointer; 
              width:105px;
              outline: none; 
              
              box-shadow: 0 0 12px #ff2449; " id="postbutton" name="submit" type=" " onclick="modalClose()" value="Cancel" readonly/> 
              </form> 
              <div style="margin-top:15px;"></div>

              
              </div></div>';
              echo '<br><br>

              <div class="commentfootermarginMobile">  </div>';
              echo '</div>'; 
              echo "</div>  ";  
           }

           unset($contenturlimg); 

     echo ' 
 
     </div> 
    </div> 
  </div>
  '; 


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
} 

function autoGrow(oField) {
  if (oField.scrollHeight > oField.clientHeight) {
    oField.style.height = oField.scrollHeight + "px";
  }
}

$('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});

</script> 