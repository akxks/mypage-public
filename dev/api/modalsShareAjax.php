
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>

</style> 

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

$sql = $con->query("SELECT userid FROM posts WHERE id='$postId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $personId = ($row['userid']);
} 

$sql = $con->query("SELECT username FROM users WHERE id='$personId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $firstnamePerson = ($row['username']);
} 

?>

<?php  
  echo ' 
  <script>
  var modal = document.getElementById("sharePost");
  window.onclick = function(event) {
    if (event.target == modal) {
      
      modal.style.display = "none"; 
      document.getElementById("body").style.overflow = "scroll";
      document.getElementById("body").style.overflowX = "hidden";

    }
  }

  function modalClose () {
    var modal = document.getElementById("sharePost"); 
  
       modal.style.display = "none"; 
 
      document.getElementById("body").style.overflow = "scroll";
      document.getElementById("body").style.overflowX = "hidden";

  }

  </script>

  <div id="sharePost" style="display:none;" class="modal">  
    <div id="shareModal" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important; "> 
     <h2>Share '.$firstnamePerson.'\'s post </h2>  
     
     <form name="sharing" action="api/sharePost" method="post">
 
     <textarea id="shareText" spellcheck="true" autocomplete="off" type="sharetext" maxlength="500" name="sharetext" class="form-control" rows="2" onkeydown="autoGrow(this);" placeholder="Add comment " ></textarea>
     <hr> 
         <div>
             <label class="postCounterColor" id="counterPost" style="display:none;float:right;margin-top:-15px;margin-right:20px;" ><span id="current">0</span> <span id="maximum">/ 500</span></label>
         </div>

     <div> 

     ';

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
           $sqlNames = $con->query("SELECT firstname, lastname, verified, private FROM users WHERE id = '$userid';" ) or die($con->error);  
           while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
              $names[] = array (
                 array($rowNames['firstname']),
                 array($rowNames['lastname']), 
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
           }
           else {
              $margin = 'margin-top:10px;';
           }
           
           $postid = $postId;
     
           if ($posts[0][0][8][1] != 4) {
                 
              echo '<div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; border-bottom: 15px !important;margin: 15px !important;">';  
      
              $poster = $posts[0][0][1][1]; 
              $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$poster'") or die($con->error); 
              while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  

              $temppostidforusername = $posts[0][0][1][1];
              $usernameReqe = $con->query("SELECT username FROM users WHERE id='$temppostidforusername';") or die($con->error);    
              while($row = mysqli_fetch_assoc($usernameReqe)) { 
              $requestedUsername = ($row['username']);
              } 

              echo "<div style='border-left: 22px solid'> <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '55px;' width='55px;' style='float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'> </a> </div>";
      
              unset($contenturlimg); 
     
              $fetchedLocation = $con->query("SELECT `location` FROM posts WHERE id = '$postid';" ) or die($con->error); 
              while($rowsID = mysqli_fetch_assoc($fetchedLocation)) { $fetchedLocationr = $rowsID['location']; }  

              if (isset($fetchedLocatior)) { 
                 if ($fetchedLocationr != "") {
                    $locationdata = '• 🌎 ' . $fetchedLocationr .'';
                 }
              }
      
                if ($returndata == "0m") { 
                  echo "<b> <p style='". $margin ."'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ".$lang_just_now. "". $locationdata . " </br> <br></p>  ";  
                }
                else {
                  echo "<b> <p style='". $margin ."'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ". $returndata . " ago ". $locationdata . "</br> <br></p>  ";  
                }

              if ($posts[0][0][8][1] == 0) { 
                 if (strlen(trim($posts[0][0][2][1])) == 0) {
                 }
                 else {
                    $text = strip_tags($posts[0][0][2][1]);
                    
                    $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                    echo "<div class='text-border'> <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                 } 
                 echo "<div style=' margin-left:none;border: none !important; margin:-20px;'> <center> <img style='width:100px;border-radius: 3px;' class='nodrag' src='". $posts[0][0][9][1]. "' alt='Post'> </a> </center> </div> <br>"; 
              }
              elseif ($posts[0][0][8][1] == 3) {
 
                 if (strlen(trim($posts[0][0][2][1])) == 0) {
                 }
                 else {
                    $text = strip_tags($posts[0][0][2][1]); 
                    $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                    echo "<div class='text-border'>  <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                 } 
                 echo  "<div style='position:relative;margin-left:-35px;border: none !important; margin:-15px;'> <center> <video loop style='width:100px;outline:none;margin-top:20px;border-radius: 3px;' controls muted> <source src='". $posts[0][0][9][1]. "'> </video></center> </div> " ; 
                 echo "<script> $('videoID').get(0).play(); </script>";
              }
              else { 
                 $text = strip_tags($posts[0][0][2][1]); 
                 $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                 echo "<div class='text-border'> <p style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>"; 
              }  
        
              $postid = $posts[0][0][7][1];
 
             echo '<br> <p> </p> 
             
             ';  

              echo '  
              </div>
              
              <input class="float" style="position:relative;display:none; " id="text" name="postid" type="postid" value="'.$postId.'" /> 
            
              <input class="float" style="position:relative;display:none; " id="text" name="loc" type="loc" value="home" /> 
              
              <input class="float" style="position:relative;display:none; " id="text" name="sessionuserid" type="sessionuserid" value="'.$sessionUserID.'" /> 
              
              <input class="float" style=" position:relative;float:right;margin:0px;margin-bottom:20px !important;margin-left:20px;" id="postbutton" name="submit" type="submit" value="Share" /> '; 
              echo ' 

              </div>';
              echo '
              
              
              
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

 

              <script>
              function setClipboard(value) {
                var tempInput = document.createElement("input");
                tempInput.style = "position: absolute; left: -1000px; top: -1000px";
                tempInput.value = "https://mypage.com/post/'.$postId.'";
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.getElementById("copyLinkButton").value = "Copied";
                document.body.removeChild(tempInput);
            }
              </script>
              
              <img id="copyLinkButton" onclick="setClipboard()" src="image/copy.svg" width="35px" height="auto" class="float" style="margin-top:3px;cursor: pointer; filter: brightness(6);">

              </div>';
              echo '<br><br>';
              echo '</div>'; 
              echo "</div>  ";  
           }

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

$("#postText").keyup(function() { 
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
    current.text(characterCount); 
    document.getElementById("counterPost").style.display = "none";
    if (characterCount >= 400) {
    document.getElementById("counterPost").style.display = "block";
    maximum.css('color', '#ff4040');
    current.css('color', '#ff4040');
    theCount.css('font-weight','bold');
  } else { 
    theCount.css('font-weight','normal');
  } 
  });

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