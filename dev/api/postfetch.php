
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->
 
 <style> 
 .noselect {  
   -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; }

</style> 

<script>  
let current = 0;

function switchPost(all, action) {

   if (action == 1) { //back

      if (current !== 0) { 
         var element = document.getElementById("post" + all[current]);
         element.classList.add("hidePostPinned"); 

         var element = document.getElementById("post" + all[current - 1]);
         element.classList.remove("hidePostPinned"); 

         current = current - 1; 
      }

      document.getElementById("changenumberPinnedSwitching").innerHTML = "📌 Pinned posts • " + (current +1 ) + "/" + all.length;
   
   }

   if (action == 0) { // forward

      if (all.length !== current + 1) { 
         var element = document.getElementById("post" + all[current]);
         element.classList.add("hidePostPinned"); 
         
         var element = document.getElementById("post" + all[current + 1]);
         element.classList.remove("hidePostPinned"); 

         current = current + 1; 

      }
 

      document.getElementById("changenumberPinnedSwitching").innerHTML = "📌 Pinned posts • " + (current +1 ) + "/" + all.length;

   }  

} 

$(function(){

   var touchtime = 0;
   $("[id^='postImage']").on('click', function(e){
      if (touchtime == 0) { 
         touchtime = new Date().getTime();
      } else { 
         if (((new Date().getTime()) - touchtime) < 800) { 
               var ret = $(this).attr('id').replace('postImage','');  

               var theRandomNumber = Math.floor(Math.random() * 45) + 1;

               if (theRandomNumber > 25) {
                  var randn = 'rotate(' + theRandomNumber + 'deg)';

               }
               else {
                  var randn = 'rotate(-' + theRandomNumber + 'deg)';
               } 

               var text = (document.getElementById("likebutton"+ret).getAttribute("style"));  

               if (text == "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") {
               
                  likeImagebypress('<?php echo $sessionUserID; ?>', ret, '<?php echo $_COOKIE['accountToken']; ?>' ); 

               } else {
                  if (text == null) {
                     likeImagebypress('<?php echo $sessionUserID; ?>', ret, '<?php echo $_COOKIE['accountToken']; ?>' ); 

                  }
               }

               $('#postEmojihologram'+ret)
                  .show()
                  .text('👍')
                  .css({ "pointer-events": "none",
                      position: "absolute", transform: randn,  left: e.pageX - 20 , top: e.pageY - 40 
                     
               });


               setTimeout(() => { 
                  
                  $('#postEmojihologram'+ret).fadeOut('fast', function()
                  
                  { 
                     $('#postEmojihologram'+ret).hide( ); 
                  }

               ); }, 2500);  

               
               
               touchtime = 0;
         } else { 
               touchtime = new Date().getTime();
         }
      }
   });

 
}); 

</script> 

<script>  


function likeImagebypress(name, postid, account_token) { 

   $('#postEmojihologram' + postid).hide(); 

   actionPost(name, postid, postid, "home", "LikeImagePress", account_token );  


}


function comments(name, postid, account_token) { 
   $.ajax({ 
      type: "GET", 
      url: "api/comment", 
      data: { 
         userid: name,
         postid: postid,
         account_token: account_token
      }, 
   success: function(response) {

      $('#commentsDiv').html(response);
         var comments = document.getElementById("commentmodal");  
         comments.style.display = "block";


         var modal = document.getElementById("commentsmodalbox");  
         modal.classList.add('push') 

         document.getElementById("body").style.overflow = "hidden";

    }
   });  
}  


function share(name, postid, account_token) { 

$.ajax({ 
   type: "GET", 
   url: "api/modalsShareAjax", 
   data: { 
      userid: name,
      postid: postid,
      account_token: account_token
   }, 
success: function(response) { 
   $('#shareBox').html(response);
      var modal = document.getElementById("sharePost");  
      modal.style.display = "block";  

      var modal = document.getElementById("shareModal");  
      modal.classList.add('push') 
      document.getElementById("body").style.overflow = "hidden"; 
 }
});  
}   

function reportPost(name, postid, account_token) { 

$.ajax({ 
   type: "GET", 
   url: "api/modalsReportPost", 
   data: { 
      userid: name,
      postid: postid,
      account_token: account_token
   }, 
success: function(response) { 
   $('#shareBox').html(response);
      var modal = document.getElementById("reportPost");  
      modal.style.display = "block"; 

      var modal = document.getElementById("reportPostBox");  
      modal.classList.add('push') 

      document.getElementById("body").style.overflow = "hidden";
 }
});  
}   

function hidePost(name, postid, account_token) { 
 

$.ajax({ 
   type: "GET", 
   url: "api/hidepost", 
   data: { 
      userid: name,
      postid: postid,
      account_token: account_token
   }, 
success: function(response) { 
   
      document.getElementById("post"+postid).style.display = "none";

    
   }
});  
}   
  

function deletePost(name, postid, useridpost, account_token) { 

$.ajax({ 
   type: "POST", 
   url: "api/deletepost", 
   data: { 
      userid: name,
      postid: postid,
      useridpost: useridpost,
      account_token: account_token
   }, 
success: function(response) { 
  
   document.getElementById("post"+postid).style.display = "none";
   
 }
}); 

} 

function pinPost(name, postid, account_token) { 

   $.ajax({ 
      type: "POST", 
      url: "api/pinpost", 
      data: { 
         userid: name,
         postid: postid,
         account_token: account_token
      }, 
   success: function(response) { 
 
      document.getElementById("pinnedPostText"+postid).style.display = "block";

      document.getElementById("pinPost"+postid).style.display = "none";

      document.getElementById("unpinPost"+postid).style.display = "block";

   } 

   }); 

} 

function unpinPost(name, postid, account_token) { 

   $.ajax({ 
      type: "POST", 
      url: "api/unpinpost", 
      data: { 
         userid: name,
         postid: postid,
         account_token: account_token
      }, 
   success: function(response) { 

      document.getElementById("pinnedPostText"+postid).style.display = "none";

      document.getElementById("pinPost"+postid).style.display = "block";

      document.getElementById("unpinPost"+postid).style.display = "none";

   } 

   }); 

} 

function superLike(name, postid, account_token) { 

$.ajax({ 
   type: "GET", 
   url: "api/modalsSuperLikeAjax", 
   data: { 
      userid: name,
      postid: postid,
      account_token: account_token
   }, 
success: function(response) { 
   $('#shareBox').html(response);
      var modal = document.getElementById("superPost");  
      modal.style.display = "block"; 


      var modal = document.getElementById("superPostBox");  
      modal.classList.add('push') 


      document.getElementById("body").style.overflow = "hidden";
 }
});  
}   

function actionPost(session_id, userid_post, post_id, location, interaction, account_token) { 
   var data = {session_id, userid_post, post_id, location, interaction, account_token};


   if (interaction == "LikeImagePress") { 
      
      interaction = "Like";
      wasimagepress = true; 
      
   }


   $(document).ready(function() {  
         $.ajax({ 
               type: "GET", 
               cache: false,

               data: data,
               url: "api/actionpost",  
               success: function(html) {  
                   
                  if (interaction == "Like") { 
                     var str = document.getElementById("likebutton" + post_id).value;

                     if ( str.includes('K') || str.includes('M') || str.includes('B') )  { 

                        var includes = true; 

                     } 
 
                     if (includes != true) { 

                       var stringArray = str.split(/(\s+)/);  
                       var newNum = parseInt(stringArray[0]); 
                  
                     }

                     var text = (document.getElementById("likebutton" + post_id).getAttribute("style")); 
                     var other = (document.getElementById("dislikebutton" + post_id).getAttribute("style"));

                     (newNum = newNum || 0);
                     if (text == null) {

                        if (other !== "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") { 

                           var strOther = document.getElementById("dislikebutton" + post_id).value;
                           var stringArrayOther = strOther.split(/(\s+)/);  
                           var newNumOther = parseInt(stringArrayOther[0]);

                           var text = (document.getElementById("dislikebutton" + post_id).getAttribute("style")); 

                           (newNumOther = newNumOther || 0);
                           if (newNumOther == 1) {
                              document.getElementById("dislikebutton" + post_id).value = (" 👎"); 
                           }

                           document.getElementById("dislikebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                        }

                        if (includes != true) {  document.getElementById("likebutton" + post_id).value = ((newNum + 1) + " 👍"); 
                        }  
                        document.getElementById("likebutton" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 
                     }
                     else {

                        if (text == "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") {
                           if (includes != true) { document.getElementById("likebutton" + post_id).value = ((newNum + 1) + " 👍");   }
                           document.getElementById("likebutton" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 

                           if (other !== "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") { 

                              var strOther = document.getElementById("dislikebutton" + post_id).value;
                              var stringArrayOther = strOther.split(/(\s+)/);  
                              var newNumOther = parseInt(stringArrayOther[0]);

                              var text = (document.getElementById("dislikebutton" + post_id).getAttribute("style")); 

                              (newNumOther = newNumOther || 0);
                              if (newNumOther == 1) {
                                 document.getElementById("dislikebutton" + post_id).value = (" 👎"); 
                           }

                           document.getElementById("dislikebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
 
                           if (newNumOther !== 1) { 
                              document.getElementById("dislikebutton" + post_id).value = ((newNumOther - 1) + " 👎");    
                           }
                         
                         }

                        }
                        else {
                           
                           if (newNum == 1) {
                              document.getElementById("likebutton" + post_id).value = (" 👍"); 
                           }
                           else {
                              if (includes != true) { document.getElementById("likebutton" + post_id).value = ((newNum - 1) + " 👍");  }
                           }
                             
                           document.getElementById("likebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                           if (waslikeimagepress != true) { document.getElementById("postEmojihologram" + post_id).style.display = "none"; }

                        }
                        
                     }
                     
                  }

                  
                  if (interaction == "Dislike") { 
                     var str = document.getElementById("dislikebutton" + post_id).value;

                     if ( str.includes('K') || str.includes('M') || str.includes('B') )  { 

                        var includes = true; 

                     } 
 
                     if (includes != true) { 

                       var stringArray = str.split(/(\s+)/);  
                       var newNum = parseInt(stringArray[0]); 
                  
                     }

                     var text = (document.getElementById("dislikebutton" + post_id).getAttribute("style")); 
                     var other = (document.getElementById("likebutton" + post_id).getAttribute("style"));

                     (newNum = newNum || 0);
                     if (text == null) {

                        if (other !== "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") { 

                           var strOther = document.getElementById("likebutton" + post_id).value;
                           var stringArrayOther = strOther.split(/(\s+)/);  
                           var newNumOther = parseInt(stringArrayOther[0]);

                           var text = (document.getElementById("likebutton" + post_id).getAttribute("style")); 

                           (newNumOther = newNumOther || 0);
                           if (newNumOther == 1) {
                              document.getElementById("likebutton" + post_id).value = (" 👍"); 
                           }

                           document.getElementById("likebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                        }

                        if (includes != true) {  document.getElementById("dislikebutton" + post_id).value = ((newNum + 1) + " 👎"); 
                        }  
                        document.getElementById("dislikebutton" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 
                     }
                     else {

                        if (text == "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") {
                           if (includes != true) { document.getElementById("dislikebutton" + post_id).value = ((newNum + 1) + " 👎");   }
                           document.getElementById("dislikebutton" + post_id).style = "text-shadow: 0px 0px 17px rgba(247, 155, 67, 0.9); "; 

                           if (other !== "text-shadow: rgba(0, 0, 0, 0) 0px 0px 0px;") { 

                              var strOther = document.getElementById("likebutton" + post_id).value;
                              var stringArrayOther = strOther.split(/(\s+)/);  
                              var newNumOther = parseInt(stringArrayOther[0]);

                              var text = (document.getElementById("likebutton" + post_id).getAttribute("style")); 

                              (newNumOther = newNumOther || 0);
                              if (newNumOther == 1) {
                                 document.getElementById("likebutton" + post_id).value = (" 👍"); 
                           }

                           document.getElementById("likebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                           if (newNumOther !== 1) { 
                              document.getElementById("likebutton" + post_id).value = ((newNumOther - 1) + " 👍");    
                          
                           }
                         
                         }

                        }
                        else {
                           
                           if (newNum == 1) {
                              document.getElementById("dislikebutton" + post_id).value = (" 👎"); 
                           }
                           else {
                              if (includes != true) { document.getElementById("dislikebutton" + post_id).value = ((newNum - 1) + " 👎");  }
                           }
                             
                           document.getElementById("dislikebutton" + post_id).style = "text-shadow: 0px 0px 0px rgba(0, 0, 0, 0); "; 
                           if (waslikeimagepress != true) { document.getElementById("postEmojihologram" + post_id).style.display = "none"; }

                        }
                        
                     }
                     
                  }
                  
                  }
         }); 
   });
} 
</script>

<div id="shareBox"></div>

<div id="commentsDiv"></div> 

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
function displayTextWithLinks($s) {
   return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $s);
 }

function displayTextWithMention($s) { 

  return preg_replace('/[@]+([A-Za-z0-9-_]+)/', '<a href="profile?u=$1" target="_blank">$0</a>', $s);

}

require('db.php');  
require('lang.php'); 
include('button.php'); 


//if (isset($_SESSION['shared'])) { successShare(); }; 

if(!isset($_SESSION["id"])){
	exit;
}

function mysqli_result($search, $row, $field){
   $i=0; while($results=mysqli_fetch_array($search)){
   if ($i==$row){$result=$results[$field];}
   $i++;}
   return $result;}

// unsetting the variables, for a fresh Home page -- with no errors

unset($names);
//getting the session user id 
$sessionUserID = $_SESSION['id']; 
//assigning the posts array
unset($posts);
$posts = array();

$postEach = array();  
if ($fetch == "home") {
   // GETTING FRIENDS for POSTS array 
   $sql = $con->query("SELECT userid FROM friends WHERE useridFriend = '$sessionUserID' AND friendstate = 'Friends'; " ) or die($con->error); 
   $friends = array(); 
   while($row = mysqli_fetch_assoc($sql)) { 
      $friends[] = $row['userid']; 
   }  
   // ADDING YOU TO THE FRIENDS So you can see your own posts, within Home
   array_push($friends, $sessionUserID);

   // FETCHING FRIENDS POSTS
   // COUNTING FRIENDS FOR THE LOOP
   $friendscount = count($friends);   
   $loopnum = $friendscount - 1;    
   // LOOPING THE FRIENDS AND ADDING THEIR POSTS TO POSTS 
   while ($friendscount != 0) {  
      $individualfriend = $friends[$loopnum]; 
      $sql = $con->query("SELECT * FROM posts WHERE userid = '$individualfriend'") or die($con->error);   
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
         array("Imgurl",$row['imgurl']),
         array("isShare",$row['isShare']),
         array("sharePostId",$row['sharePostId'])  
          ) 
           ); 
      }  
      $friendscount = $friendscount - 1; 
      $loopnum = $loopnum - 1; 
   } 
   // SORTING THEM BY TIME 
   // $size of posts 
   $size = count($posts)-1;


   // GET WHAT TO SORT , LIKES OR TIME
   $sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['feedtype'];
   }
   if ($preference == 0) { 
      // like - bubble sort loop 
      for ($i=0; $i<$size; $i++) {
         for ($j=0; $j<$size-$i; $j++) {
            //Bubble Sort Adding
            $k = $j+1; 
            // CHECKING THE DATE, WHICH IS NEWER
            if ($posts[$k][0][3][1] > $posts[$j][0][3][1]) {
               // SWAPPING THE VARIABLES AND PLACING THEM IN THE RIGHT PLACE
               list($posts[$j], $posts[$k]) = array($posts[$k], $posts[$j]);
            } 
         }
      } 
   }
   else {
      // time - bubble sort loop 
      for ($i=0; $i<$size; $i++) {
         for ($j=0; $j<$size-$i; $j++) {
            //Bubble Sort Adding
            $k = $j+1; 
            // CHECKING THE DATE, WHICH IS NEWER
            if ((DateTime::createFromFormat('Y-m-d H:i:s', ($posts[$k][0][6][1]))) > (DateTime::createFromFormat('Y-m-d H:i:s', ($posts[$j][0][6][1])))) {
               // SWAPPING THE VARIABLES AND PLACING THEM IN THE RIGHT PLACE
               list($posts[$j], $posts[$k]) = array($posts[$k], $posts[$j]);
            } 
         }
      }  
   }  

   //FINALLY SORTED $posts 
} 
elseif ($fetch == "ID") {  
   // GET WHAT TO SORT , LIKES OR TIME
   $sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
   while($row = mysqli_fetch_assoc($sql)) {
      $preference = $row['feedtype'];
   }
   
   $posts = $posts;
   // for specific people (Ids) for specific profiles, we can use the ORDER BY create_date DESCENDING function of MySQL, it makes the process simpler.
   if ($requestedID == $sessionUserID) {
      if ($preference == 0) { 
         $sql = $con->query("SELECT * FROM posts WHERE userid = '$sessionUserID' ORDER BY likes DESC;" ) or die($con->error);
      }
      else {
         $sql = $con->query("SELECT * FROM posts WHERE userid = '$sessionUserID' ORDER BY create_date DESC;" ) or die($con->error); 
      }
   }
   else {
      //Check if friend
      $result = $con->query("SELECT userid FROM friends WHERE useridFriend = '$requestedID' AND userid = '$sessionUserID' AND friendstate = 'Friends'; " ) or die($con->error); 
      $resultFriends = mysqli_fetch_row($result);

      if (isset($resultFriends)) {
         $sql = $con->query("SELECT * FROM posts WHERE userid = '$requestedID' ORDER BY create_date DESC;" ) or die($con->error); 
      }
      else { 
         if ($private == 0) {
            echo ' <div id="change" class="card-no-hover systemcolor" style="height:100px; "> ';   
            echo $lang_postfetch_theirpostsareprivate; 
            echo ' </div> ';  
         }
         else {
            if ($preference == 0) { 
               $sql = $con->query("SELECT * FROM posts WHERE userid = '$requestedID' ORDER BY likes DESC;" ) or die($con->error); 
            }
            else {
               $sql = $con->query("SELECT * FROM posts WHERE userid = '$requestedID' ORDER BY create_date DESC;" ) or die($con->error); 
            } 
         }
      } 
   } 
   while($row = mysqli_fetch_assoc($sql)) {   
      $sqlNames = $con->query("SELECT firstname, lastname, username FROM users WHERE id = '$row[userid]';" ) or die($con->error);    
      while($rowNames = mysqli_fetch_assoc($sqlNames)) {   
         $names[] = array (
            array($rowNames['firstname']),
            array($rowNames['lastname']), 
            array($rowNames['username']) 
          ); 
      } 
      $posts[] = array ( array("Post", 
         array("UserID",$row['userid']),
         array("Posts",$row['post']),
         array("Likes",$row['likes']),
         array("Shares",$row['shares']),
         array("Comments",$row['comments']),
         array("CreateDate",$row['create_date']),
         array("PostID",$row['id']),
         array("type",$row['type']),
         array("imgurl",$row['imgurl']), 
         array("isShare",$row['isShare']),
         array("sharePostId",$row['sharePostId'])  
         )
       ); 
   } 
     
   //pinned posts checking
   $pinnedPosts = array();  
   $useridpostTemp = $requestedID;

   $sql = $con->query("SELECT postid FROM pinPosts WHERE userid = '$useridpostTemp' ;" ) or die($con->error); 

   while($rowsID = mysqli_fetch_assoc($sql)) { 
      array_push($pinnedPosts, $rowsID['postid']);       
   }

   // Sorting pinned to first 

   if (!empty($pinnedPosts)) {
      $size = count($posts)-1;
 
      
      for ($i=0; $i<$size; $i++) {
         for ($j=0; $j<$size-$i; $j++) {
            //Bubble Sort Adding
            $k = $j+1; 
            // CHECKING IF ITS A PINNED POST, if it is then placing it first :P

            if (in_array($posts[$k][0][7][1], $pinnedPosts)) { 
               list($posts[$j], $posts[$k]) = array($posts[$k], $posts[$j]);
            } 
   
         }
         
      }  
 
   }

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
// 11 isShare 
// 12 sharePostId  

if (empty($posts)) {
   if ($private != 0) {
      echo ' <div class="card-no-hover systemcolor"> '; 
      if ($fetch != "ID") { 
         echo ' <p>'.$lang_postfetch_nomoremakefriend.'</p> ';
      }
      else {
         echo ' <p> '.$lang_postfetch_nonefound .' </p> ';
      }  
      echo ' </div> '; 
   }
   else {
      if ($fetch != "ID") { 
         echo ' <div class="card-no-hover systemcolor"> '; 
         echo ' <p> '.$lang_postfetch_nonefound .'</p> ';
         echo ' </div> '; 
     }  
     else { 
      if (isset($resultFriends)) {  
         echo ' <div class="card-no-hover systemcolor"> '; 
         echo ' <p> '.$lang_postfetch_nonefound .' </p> ';
         echo ' </div> '; 
      }
      if ($sessionUserID == $requestedID) { 
         echo ' <div class="card-no-hover systemcolor"> '; 
         echo ' <p> '.$lang_postfetch_nonefound .' </p> ';
         echo ' </div> ';  
      }
   }
}

 } else { 

   $blockedWords = array();

   $sql = $con->query("SELECT word FROM blockedWords WHERE userid = '$sessionUserID' ;" ) or die($con->error); 
   while($rowsID = mysqli_fetch_assoc($sql)) { 
      array_push($blockedWords, $rowsID['word']); 
   }  

   $blockedIds = array();

   $sql = $con->query("SELECT postid FROM hidePosts WHERE userid = '$sessionUserID' ;" ) or die($con->error); 
   while($rowsID = mysqli_fetch_assoc($sql)) { 
      array_push($blockedIds, $rowsID['postid']); 
   }  

   $postnum = count($posts); 
   $postsloopnum = 0; 

   include_once 'api/datedifference.php';

   while ($postsloopnum != $postnum) { 

      unset($names);     
      unset($returndata);
      unset($date);
      unset($locationdata);
      unset($fetchedLocation);
      unset($namesRel);
      unset($shared);
      unset($namesShared);
      unset($postsShared);
      unset($useridofsharedPost);
      unset($namesOfShared);
      unset($isSharedAlready);
      unset($temppostid);
      unset($at);
      unset($requestedid);
      unset($arr);

      $userid = $posts[$postsloopnum][0][1][1]; 
      $sqlNames = $con->query("SELECT firstname, lastname, verified, private, username FROM users WHERE id = '$userid';" ) or die($con->error);  
      while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
         $names[] = array (
            array($rowNames['firstname']),
            array($rowNames['lastname']), 
            array($rowNames['verified']),
            array($rowNames['private']),
            array($rowNames['username']) 
            ); 
      }   
      $date = $posts[$postsloopnum][0][6][1]; 
      $returndata = datedifference($date); 

      if ($userid == $sessionUserID) {  
         $margin = 'margin-top:-8px;';
         if ($fetch == "ID") {
            $margin = 'margin-top:10px;';
         }
      }
      else {
         $margin = 'margin-top:10px;';
      }
      
      $postid = $posts[$postsloopnum][0][7][1];
 
      //check if postid is in hidePosts list due to Iveseen this or I dont like it 

      $owned_urls2= $blockedIds;
      $string2 = $posts[$postsloopnum][0][7][1]; 
      
      $url_string2 = end(explode(' ', $string2));

      if (in_array($url_string2,$owned_urls2)){
         $postsloopnum = $postsloopnum + 1; 
         continue(1); 
      }  

      //check hidePosts end 

      // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= 

      //check if contains block word then skp 
      $owned_urls= $blockedWords;
      //var_dump($blockedWords);

      $string = $posts[$postsloopnum][0][2][1]; 
      
      $url_string = end(explode(' ', $string));
      
      if (in_array($url_string,$owned_urls)){
         $postsloopnum = $postsloopnum + 1; 
         continue(1); 
      }  
      //check block word end

      // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= 


      if ($postsloopnum === 0) {
         
         if ($fetch == "ID") {  

            $pinnedPosts = array();  
            $useridpostTemp = $requestedID;
         
            $sql = $con->query("SELECT postid FROM pinPosts WHERE userid = '$useridpostTemp' ;" ) or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($sql)) { 
               array_push($pinnedPosts, $rowsID['postid']); 
            } 

            if (!empty($pinnedPosts)) { 
      
               echo '<div class="card systemcolorPost mobilePost fit-image" id="pinnedPosts" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important; padding: 15px;">';  
      
               echo "<p id='changenumberPinnedSwitching' style=' margin-left:5px;margin-top:-15px !important;'> 📌 Pinned posts • 1/".count($pinnedPosts)." </p> ". $shared; 
 
 
               $reversed = ($pinnedPosts);
 
               if (count($pinnedPosts) != 1) {
                  

                  echo '
                 
                  <button onclick="switchPost('.htmlspecialchars(json_encode($reversed)).',1)" style="border-radius:50%;width:50px;height:50px; font-size:20px;"> < </button>
                  
                  <button onclick="switchPost('.htmlspecialchars(json_encode($reversed)).',0)" style="border-radius:50%;width:50px;height:50px; font-size:20px; outline:none;"> > </button>
                  
                   '; 
                   
               } 


               //$arr = $pinnedPosts;
             //  $loopnum = 0;
               //foreach ($arr as &$value) { 
                //  echo 'e';
                  
              // }
 
               // $arr is now array(2, 4, 6, 8)
              // unset($value); // break the reference with the last element

            }
 
         }


      }

      //if ($fetch == "ID") {  
 
            //check if contains pin post then skp 
       //     $owned_urls= $pinnedPosts;
            //var_dump($blockedWords);

         //   $string = $posts[$postsloopnum][0][7][1]; 
            
           // $url_string = end(explode(' ', $string));
            
           // if (in_array($url_string,$owned_urls)){
            //   $postsloopnum = $postsloopnum + 1; 
             //  continue(1); 
            //}  
            //check pin post end

     // }
      
      // CHECKING IF SHARED POST IF ALLOWED TO SEE
      if ($posts[$postsloopnum][0][10][1] == 1) { 
 
         $postIdofSharedpost = $posts[$postsloopnum][0][11][1];
 

         $sqlNames = $con->query("SELECT userid from posts WHERE id = '$postIdofSharedpost';" ) or die($con->error);  
         while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
            $idPostCheckPriv = $rowNames['userid'];
         } 
         
         $sqlNames = $con->query("SELECT private from users WHERE id = '$idPostCheckPriv';" ) or die($con->error);  
         while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
            $checkPrivuserShared = $rowNames['private'];
         } 
   
         if ($checkPrivuserShared == 1) {
            
            // check if not friends 

            $result = $con->query("SELECT userid FROM friends WHERE useridFriend = '$idPostCheckPriv' AND userid = '$sessionUserID' AND friendstate = 'Friends'; " ) or die($con->error); 
            $resultFriends = mysqli_fetch_row($result);
      
            if (!isset($resultFriends)) {
               // skip post because not authorised 
               $postsloopnum = $postsloopnum + 1;  

               continue(1); 
            }

            // check if blocked

            //if u blocked them, dont show  
            $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$idPostCheckPriv' AND useridBlocker = '$sessionUserID';" ) or die($con->error);  
            $infoBlocked = array();
            
            while($row = mysqli_fetch_assoc($sqlBlocked)) {
               $infoBlocked[] = array (
                  array("UserID",$row['id']));
               }
            if (!empty($infoBlocked)) { 
               // skip post because not authorised 
               $postsloopnum = $postsloopnum + 1;  

               continue(1); 
               
            }   

            // if they blocked you, dont show. 
            $sqlBlocked = $con->query("SELECT id FROM blocked WHERE useridblocked = '$sessionUserID' AND useridBlocker = '$idPostCheckPriv';" ) or die($con->error);  
            $infoBlocked2 = array();
            
            while($row = mysqli_fetch_assoc($sqlBlocked)) {
               $infoBlocked2[] = array (
                  array("UserID",$row['id']));
               } 
            if (!empty($infoBlocked2)) { 
               // skip post because not authorised 
               $postsloopnum = $postsloopnum + 1;  

               continue(1); 

            }   

         }

      }


      if ($posts[$postsloopnum][0][8][1] != 4) {

         if ($fetch == "ID") {

            // we do this so the first pinned post is already shown, then the user can scroll if there is more..
            if ($postsloopnum == 0) { 


               echo '<div class="card systemcolorPost mobilePost fit-image " id="post'.$postid.'" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important;">';  

               
            }

            else {

               if (in_array($posts[$postsloopnum][0][7][1], $pinnedPosts)) {
                  echo '<div class="card systemcolorPost mobilePost fit-image hidePostPinned" id="post'.$postid.'" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important;">';  
      
               } 
               else {
                  echo '<div class="card systemcolorPost mobilePost fit-image " id="post'.$postid.'" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important;">';  
               }

            }


         }
         
         else { 

            echo '<div class="card systemcolorPost mobilePost fit-image " id="post'.$postid.'" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important;">';  

         }


         $poster = $posts[$postsloopnum][0][1][1]; 
         $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$poster'") or die($con->error); 
         while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
 

         $useridtemp = $posts[$postsloopnum][0][1][1]; 
         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$useridtemp';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
           $requestedUsername = ($row['username']);
         } 


         if ($posts[$postsloopnum][0][10][1] == 1) { 
             
            $sharedPostt = $posts[$postsloopnum][0][11][1];

            $sqlNames = $con->query("SELECT userid FROM posts WHERE id = '$sharedPostt';" ) or die($con->error);  
            while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
               $useridofsharedPost = $rowNames['userid']; 
            }   
   
            $sqlNames = $con->query("SELECT firstname, lastname, verified, private, username FROM users WHERE id = '$useridofsharedPost';" ) or die($con->error);  
            while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
               $namesOfShared[] = array (
                  array($rowNames['firstname']),
                  array($rowNames['lastname']), 
                  array($rowNames['verified']),
                  array($rowNames['private']) ,
                  array($rowNames['username']) 
                  ); 
            } 

            if (!isset($namesOfShared[0][0][0])) {
               $shared = ' shared a post. ';
            }
            else {
               if ($namesOfShared[0][2][0] == 1) {  $imgVerif = ' <img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker"> '; }  
               
               $shared = ' shared <p style="color:gray;display:inline;"> @'. $namesOfShared[0][4][0] . $imgVerif. '</p>\'s Post ';

               
               if (isset($shared)) { 

                  echo "<p style='color:gray;display:inline;margin-left:20px;padding-top:-15px !important;'> 🔁 @" . $names[0][4][0] . " </p> ". $shared; 
                  echo "<br> <br> ";
   
               }

            }

         }

         echo "<div  id='pinnedPostText".$postid."' style='display:none;'> ";

         echo "<p style='  margin-left:20px;margin-top:-225px !important; margin-bottom:15px;display:inline-block;'> 📌 Pinned <p style='color:gray; display:inline-block; margin-left:5px;'>  (refresh to see in your pinned)</p> </p> ". $shared; 
 
         echo '</div>'; 

         echo "<div style='border-left: 22px solid'> <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg."' height= '55px;' width='55px;' style=' margin-bottom:20px;float:left;margin-right:20px;border-radius:50%;' alt='Profile Picture'> </a> </div>";
 
         unset($contenturlimg); 

         $fetchedLocation = $con->query("SELECT `location` FROM posts WHERE id = '$postid +';" ) or die($con->error); 
         $fetchedLocation = mysqli_result($fetchedLocation, 0, "location"); 
   
         if (isset($fetchedLocation)) { 
            if ($fetchedLocation != "") {
               $locationdata = '• 🌎 ' . $fetchedLocation .'';
            }
         }
         
         if ($posts[$postsloopnum][0][1][1] == $sessionUserID) { 
     

            echo '
            
            <div class="dropbtn hoverColor smallerDotMarginForMobile" style="border: 5px solid transparent; cursor: pointer; float: right !important; margin-right:13px; margin-top: -20px;" onclick="menu(\'postMenu'.$postid.'\')" >
            <p class="dot dropbtn smallerDotMarginForMobile" id="dotColored" style="font-size:0px !important;padding: 0px !important;  " onclick="menu(\'postMenu'.$postid.'\')" ></p>
            <p class="dot dropbtn smallerDotMarginForMobile" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'postMenu'.$postid.'\')" ></p>
            <p class="dot dropbtn smallerDotMarginForMobile" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'postMenu'.$postid.'\')" ></p> 
            </div>
   
            <div class="dropdown" style="z-index:998;"> 

            <div id="postMenu'.$postid.'" style="left:25em; width: 170px; margin-top:-20px;"  class="dropdown-content systemcolor-noborder mobilePlacingpostMenu" >  
      
            ';

            if (isset($pinnedPosts)) {

               if (in_array($posts[$postsloopnum][0][7][1], $pinnedPosts)) { 
                     
                  echo ' 
                  <a id="pinPost'.$postid.'" onclick="pinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer;  display:none;" > 📌 Pin </a>  
                  <a id="unpinPost'.$postid.'" onclick="unpinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 📌 Unpin </a>  

                  <a onclick="deletePost(\''.$sessionUserID.'\',\''. htmlspecialchars($posts[$postsloopnum][0][7][1]) .'\',\''. htmlspecialchars($posts[$postsloopnum][0][1][1]) .'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 🗑️ Delete </a>  

               ';

               } else {

                  echo '
                  <a id="pinPost'.$postid.'" onclick="pinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 📌 Pin </a>  
                  <a id="unpinPost'.$postid.'" onclick="unpinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer;  display:none;" > 📌 Unpin </a>  

                  <a onclick="deletePost(\''.$sessionUserID.'\',\''. htmlspecialchars($posts[$postsloopnum][0][7][1]) .'\',\''. htmlspecialchars($posts[$postsloopnum][0][1][1]) .'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 🗑️ Delete </a>  
   
                 ';
               }
               
            }

            else {

               $pinposts = $con->query("SELECT `userid` FROM pinPosts WHERE postid = '$postid';" ) or die($con->error); 
               $pinposts = mysqli_result($pinposts, 0, "userid"); 
         
               if (isset($pinposts)) { 

                  echo ' 
                  <a id="pinPost'.$postid.'" onclick="pinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; display:none; " > 📌 Pin </a>  
                  <a id="unpinPost'.$postid.'" onclick="unpinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer;   " > 📌 Unpin </a>  

                  <a onclick="deletePost(\''.$sessionUserID.'\',\''. htmlspecialchars($posts[$postsloopnum][0][7][1]) .'\',\''. htmlspecialchars($posts[$postsloopnum][0][1][1]) .'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 🗑️ Delete </a>  
   
               ';

               }
               else {

                  echo '
                  <a id="pinPost'.$postid.'" onclick="pinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer;  " > 📌 Pin </a>  
                  <a id="unpinPost'.$postid.'" onclick="unpinPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer;  display:none; " > 📌 Unpin </a>  

                  <a onclick="deletePost(\''.$sessionUserID.'\',\''. htmlspecialchars($posts[$postsloopnum][0][7][1]) .'\',\''. htmlspecialchars($posts[$postsloopnum][0][1][1]) .'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 🗑️ Delete </a>  
   
                 '; 
               } 
            }
             

                 echo ' 



            </div> 
            </div> 

            ' ; 
 

            echo '<p style="margin-bottom:-5px;"> </p>';
            if ($returndata == "0m") { 
               if((preg_match("/^[a-zA-Z0-9]+$/", $names[0][0][0]) && (preg_match("/^[a-zA-Z0-9]+$/", $names[0][1][0])))) {
                  echo "<b> <p style='". $margin .";display:inline;'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> ", "<p style='color:gray;display:inline;'> @" .$names[0][4][0]. "</p>"; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ".$lang_just_now." ". $locationdata . " </br> <br></p>  ";  

               }
               else {
                  echo "<b> <p style='". $margin ."'> ". $names[0][4][0], "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }    echo " <br> ".$lang_just_now." ". $locationdata . " </br> <br></p>  ";  

               }
            }
            else {
               if((preg_match("/^[a-zA-Z0-9]+$/", $names[0][0][0]) && (preg_match("/^[a-zA-Z0-9]+$/", $names[0][1][0])))) {
                  echo "<b> <p style='". $margin .";display:inline;'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> ", "<p style='color:gray;display:inline;'> @" .$names[0][4][0]. "</p>"; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }      echo " <br> ". $returndata . " ago ". $locationdata . " </br> <br></p>  ";  
               }
               else {
                  echo "<b> <p style='". $margin ."'> ". $names[0][4][0], "</b> "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ". $returndata . " ago ". $locationdata . " </br> <br></p>  ";  
 
               }
            }
         } 
         else { 

            echo '
            
            <div class="dropbtn hoverColor" style="border: 5px solid transparent; cursor: pointer; float: right !important; margin-right:13px; margin-top: -20px;" onclick="menu(\'postMenu'.$postid.'\')" >
            <p class="dot dropbtn smallerDotMarginForMobile2" id="dotColored" style="font-size:0px !important;padding: 0px !important;  " onclick="menu(\'postMenu'.$postid.'\')" ></p>
            <p class="dot dropbtn smallerDotMarginForMobile2" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'postMenu'.$postid.'\')" ></p>
            <p class="dot dropbtn smallerDotMarginForMobile2" id="dotColored" style="font-size:0px !important;padding: 0px !important;"  onclick="menu(\'postMenu'.$postid.'\')" ></p> 
            </div>
   
            <div class="dropdown" style="z-index:998;"> 

            <div id="postMenu'.$postid.'" class="dropdown-content systemcolor-noborder mobilePlacingpostMenu" style="left:25em; width: 170px; margin-top:-20px;">  

                  <a onclick="reportPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 📝 Report </a>  
      
                  <a onclick="hidePost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 👎 I don\'t like this </a>  
      
                  <a onclick="hidePost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', )" class="hrefColor " style="cursor:pointer; " > 🙄 I\'ve seen this </a>  
      
                 ';

                 echo ' 

            </div> 
            </div> 

            ' ; 

            echo '<p style="margin-bottom:-5px;"> </p>';
            if ($returndata == "0m") { 
               if((preg_match("/^[a-zA-Z0-9]+$/", $names[0][0][0]) && (preg_match("/^[a-zA-Z0-9]+$/", $names[0][1][0])))) {
 
                  echo "<b> <p style='". $margin .";display:inline;'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> ", "<p style='". $margin .";color:gray;display:inline;'> @" .$names[0][4][0]. "</p>"; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; } echo " <br> ".$lang_just_now. "". $locationdata . " </br> <br></p>  ";  

               }
               else {
                  echo "<p style='". $margin .";color:gray;'> @". $names[0][4][0]; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }     echo " <br> ".$lang_just_now. "". $locationdata . " </br> <br></p>  ";  

               }
           }
            else {
               if((preg_match("/^[a-zA-Z0-9]+$/", $names[0][0][0]) && (preg_match("/^[a-zA-Z0-9]+$/", $names[0][1][0])))) {
                 
                  echo "<b>  <p style='". $margin .";display:inline;'> ". $names[0][0][0], " " .$names[0][1][0]. "</b> ", "<p style='". $margin .";color:gray;display:inline;'> @" .$names[0][4][0]. "</p>"; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }    echo " <br> ". $returndata . " ago ". $locationdata . "</br> <br></p>  ";  

               }
               else {
                  echo "<p style='". $margin .";color:gray;'> @". $names[0][4][0] ." "; if ($names[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }   echo " <br> ". $returndata . " ago ". $locationdata . "</br> <br></p>  ";  

               }
            }
         }  

         if ($posts[$postsloopnum][0][8][1] == 0) { 
            if (strlen(trim($posts[$postsloopnum][0][2][1])) == 0) {
            }
            else {
               $text = strip_tags($posts[$postsloopnum][0][2][1]); 
               $text = displayTextWithLinks($text); 
               // checking Mentions 
               if (str_contains($text, "@")) {

                  $at = substr($text, strpos($text, "@") + 1);   
                  
                  if (str_contains($at, ' ')) {

                     $arr = explode(' ',trim($at));

                     $at = $arr[0];
                     
                  } 
                  $reqid = $con->query("SELECT id FROM users WHERE username='$at';") or die($con->error);    
                  while($row = mysqli_fetch_assoc($reqid)) { 
                     $requestedid = ($row['id']);
                  } 
                  
                  if (isset($requestedid)) {
                     $text = displayTextWithMention($text);
                  } 
               }

               echo "<div class='text-border'> <p id='postSizeMobile' style='font-size:19px; '> ". $text ."</p> </div>";   
            } 
 

            $postIDforLike = $posts[$postsloopnum][0][7][1];
     

            echo "<div style=' margin-left:none;border: none !important;'>  
 
            <center> <img id='postImage$postIDforLike' style='cursor: pointer; width:100%;margin-top:10px;border-radius: 3px;' class='nodrag' src='". $posts[$postsloopnum][0][9][1]. "'> </a> </center> </div> <br>
              
            <div id='postEmojihologram$postIDforLike' style='width:auto;display:none;font-size: 88px; margin-left: 5px; text-shadow: 0px 0px 23px rgba(247, 155, 67, 1) !important;text-shadow: 0px 0px 23px rgba(247, 155, 67, 1) ; '></div>"; 

         }
         elseif ($posts[$postsloopnum][0][8][1] == 3) {
            
            if (strlen(trim($posts[$postsloopnum][0][2][1])) == 0) {
            }
            else {
               $text = strip_tags($posts[$postsloopnum][0][2][1]); 
               $text = displayTextWithLinks($text);
               // checking Mentions 
               if (str_contains($text, "@")) {

                  $at = substr($text, strpos($text, "@") + 1);   
                  
                  if (str_contains($at, ' ')) {

                     $arr = explode(' ',trim($at));

                     $at = $arr[0];
                     
                  } 
                  $reqid = $con->query("SELECT id FROM users WHERE username='$at';") or die($con->error);    
                  while($row = mysqli_fetch_assoc($reqid)) { 
                     $requestedid = ($row['id']);
                  } 
                  
                  if (isset($requestedid)) {
                     $text = displayTextWithMention($text);
                  } 
               }


               echo "<div class='text-border'>  <p id='postSizeMobile' style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
            } 
 
            $postIDforLike = $posts[$postsloopnum][0][7][1];

            echo  "<div style='position:relative;margin-left:0px;border: none !important;'> <center> <video loop onclick='likeImagebypress(\"$sessionUserID\", \"$postIDforLike\", \"$_COOKIE[accountToken]\")'  id='postImage".$postIDforLike."' style='max-width:355px;outline:none;margin-top:20px;margin-bottom:10px;border-radius: 3px;' autoplay controls muted> <source src='". $posts[$postsloopnum][0][9][1]. "'> </video></center> </div> " ; 
            echo "<script> $('videoID').get(0).play(); </script>
            
            <div id='postEmojihologram$postIDforLike' style='width:auto;display:none;font-size: 88px; margin-left: 5px; text-shadow: 0px 0px 23px rgba(247, 155, 67, 1) !important;text-shadow: 0px 0px 23px rgba(247, 155, 67, 1) ; '></div>

            
            ";

            

         }
         else { 
            $text = strip_tags($posts[$postsloopnum][0][2][1]); 
            $text = displayTextWithLinks($text);  
            
            // checking Mentions 
            if (str_contains($text, "@")) {

               $at = substr($text, strpos($text, "@") + 1);   
               
               if (str_contains($at, ' ')) {

                  $arr = explode(' ',trim($at));

                  $at = $arr[0];
                  
               } 
               $reqid = $con->query("SELECT id FROM users WHERE username='$at';") or die($con->error);    
               while($row = mysqli_fetch_assoc($reqid)) { 
                  $requestedid = ($row['id']);
               } 
                
               if (isset($requestedid)) {
                  $text = displayTextWithMention($text);
               } 
            }

            echo "<div class='text-border'> <p id='postSizeMobile' style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>"; 
         } 

         if (isset($shared)) { 
            //assigning the posts array
         
               $postsShared = array(); 
               $sql = $con->query("SELECT * FROM posts WHERE id = '$sharedPostt'") or die($con->error);   
               while($row = mysqli_fetch_assoc($sql)) { 
               // POSTS ARRAY With all the posts variables
               $postsShared[] = array ( array("Post", 
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
               
               if (!isset($postsShared[0][0][1][1])) {
                  
                  echo '<div class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto; border-bottom: 15px !important;margin: 15px !important; margin-bottom:15px; ">';  
                  echo '<p style="padding:20px; margin-top:-40px !important;"> 🚫 The original post could not be found. </p>';
                  echo '</div>';
               }

               else {
               //var_dump($postsShared[1][0][1][1]); // user id 
               //var_dump($postsShared[1][0][2][0]); // posts 
               //var_dump($postsShared[1][0][3][0]); // likes 
               //var_dump($postsShared[1][0][4][0]); // shares 
               //var_dump($postsShared[1][0][5][0]); // comments 
               //var_dump($postsShared[1][0][6][0]);  // create date 
               //var_dump($postsShared[1][0][7][0]);  // postid 
               // 8 type
               // 9 imgurl 
               // 10 state  
            
               $userid = $postsShared[0][0][1][1]; 
               $sqlNames = $con->query("SELECT firstname, lastname, verified, private FROM users WHERE id = '$userid';" ) or die($con->error);  
               while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
                  $namesShared[] = array (
                     array($rowNames['firstname']),
                     array($rowNames['lastname']), 
                     array($rowNames['verified']),
                     array($rowNames['private']) 
                     ); 
               } 

               $date = $postsShared[0][0][6][1]; 

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
               
               $postid = $sharedPostt;
         
               if ($postsShared[0][0][8][1] != 4) {
                     
                  echo '<div class="card-no-hover systemcolorPost mobilePost fit-image" id="post'.$postid.'" style="margin-top:20px;height:auto; border-bottom: 15px !important;margin: 15px !important; margin-bottom:15px;">';  
            
                  $poster = $postsShared[0][0][1][1]; 
                  $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$poster'") or die($con->error); 
                  while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  
            

                  $useridtemp =$postsShared[0][0][1][1];
                  $usernameReqe = $con->query("SELECT username FROM users WHERE id='$useridtemp';") or die($con->error);    
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
                        echo "<b> <p style='". $margin ."'> ". $namesShared[0][0][0], " " .$namesShared[0][1][0]. "</b> "; if ($namesShared[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ".$lang_just_now. "". $locationdata . " </br> <br></p>  ";  
                     }
                     else {
                        echo "<b> <p style='". $margin ."'> ". $namesShared[0][0][0], " " .$namesShared[0][1][0]. "</b> "; if ($namesShared[0][2][0] == 1) {  echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker">'; }  echo " <br> ". $returndata . " ago ". $locationdata . "</br> <br></p>  ";  
                     }

                  if ($postsShared[0][0][8][1] == 0) { 
                     if (strlen(trim($postsShared[0][0][2][1])) == 0) {
                     }
                     else {
                        $text = strip_tags($postsShared[0][0][2][1]);
                        
                        $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                        echo "<div class='text-border'> <p id='postSizeMobile' style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                     } 
                     echo "<div style=' margin-left:none;border: none !important; margin:-20px;padding-bottom:20px !important;'> <center> <img style='width:300px;border-radius: 3px;' class='nodrag' src='". $postsShared[0][0][9][1]. "' alt='Post'> </a> </center> </div> <br>"; 
                  }
                  elseif ($postsShared[0][0][8][1] == 3) {
      
                     if (strlen(trim($postsShared[0][0][2][1])) == 0) {
                     }
                     else {
                        $text = strip_tags($postsShared[0][0][2][1]); 
                        $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                        echo "<div class='text-border'>  <p id='postSizeMobile' style='font-size:19px;margin-top:5px;'> ". $text ."</p> </div>";   
                     } 
                     echo  "<div style='position:relative;margin-left:-35px;border: none !important; margin:-15px;padding-bottom:20px !important;'> <center> <video loop style='width:300px;outline:none;margin-top:20px;border-radius: 3px;' autoplay controls muted> <source src='". $postsShared[0][0][9][1]. "'> </video></center> </div> " ; 
                     echo "<script> $('videoID').get(0).play(); </script>";
                  }
                  else { 
                     $text = strip_tags($postsShared[0][0][2][1]); 
                     $text = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank" rel="noopener">$1</a>', $text);

                     echo "<div class='text-border'> <p id='postSizeMobile' style='font-size:19px;margin-top:0px;padding-bottom:20px !important;'> ". $text ."</p> </div>"; 
                  }  
            
                  $postid = $postsShared[0][0][7][1];
      
                  ECHO '</div>'; 
               } 
                     
         }
         } 

         echo '<div style="display: flex; justify-content: center; margin-top: -20px !important; ">' ;
     
         $postid = $posts[$postsloopnum][0][7][1];
   
         $fetchedLike = $con->query("SELECT `likes` FROM posts WHERE id = '$postid';" ) or die($con->error); 
         $fetchedLike=mysqli_result($fetchedLike, 0, "likes"); 
   
         $fetchedDislike = $con->query("SELECT dislikes FROM posts WHERE id = '$postid';" ) or die($con->error); 
         $fetchedDislikes=mysqli_result($fetchedDislike, 0, "dislikes"); 
   
         $fetchedShare = $con->query("SELECT shares FROM posts WHERE id = '$postid';" ) or die($con->error); 
         $fetchedShares=mysqli_result($fetchedShare, 0, "shares"); 
   
         $fetchedComments = $con->query("SELECT comments FROM posts WHERE id = '$postid';" ) or die($con->error); 
         $fetchedComments=mysqli_result($fetchedComments, 0, "comments"); 
   
         echo '<div style="margin: 0 auto; padding-bottom:-30px;">'; 
   
         include_once 'numberformat.php';
         $fetchedComments = nice_number($fetchedComments); 
         $fetchedShares = nice_number($fetchedShares); 
         $fetchedLike = nice_number($fetchedLike); 
         $fetchedDislikes = nice_number($fetchedDislikes); 
   
         if ($fetchedComments == 0) { 
            $fetchedComments = " ";
         }
         if ($fetchedLike == 0) { 
            $fetchedLike = " ";
         }
         if ($fetchedDislikes == 0) { 
            $fetchedDislikes = " ";
         }
         if ($fetchedShares == 0) { 
            $fetchedShares = " ";
         }
   
         
         $temppostid = $posts[$postsloopnum][0][7][1];
         
         echo "
        
     "; 
         
         if (!isset($_SESSION['newuser'])) {  
   
            $temppostid = $posts[$postsloopnum][0][7][1];
            $isCommentedAlready = $con->query("SELECT id FROM comments WHERE postId = '$temppostid' AND userid = $sessionUserID;" ) or die($con->error); 
            $isCommentedAlready=mysqli_result($isCommentedAlready, 0, "id"); 
       
            if (isset($isCommentedAlready)) {
               
               echo '
               <input id="commentButton" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" style="text-shadow: 0px 0px 13px rgba(255, 255, 255, 0.9) !important;"  onclick="comments(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\',);" type="submit" style="" name="submit" value=" '. $fetchedComments .' 💬" > </form> </a>
               '; 
            }

            else {
               echo '   
                 <input id="commentButton" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" onclick="comments(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\',);" type="submit" name="submit" value=" '. $fetchedComments .' 💬"> </form> </a>

               '; 
            }   


            if ($sessionUserID != $posts[$postsloopnum][0][1][1]) {

               $temppostid = $posts[$postsloopnum][0][7][1];
               $isSharedAlready = $con->query("SELECT id FROM posts WHERE sharePostId = '$temppostid' AND userId = $sessionUserID;" ) or die($con->error); 
               $isSharedAlready=mysqli_result($isSharedAlready, 0, "id"); 
         
               if (isset($isSharedAlready)) {
                  echo '
                  <a> <input id="shareButton" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" style="text-shadow: 0px 0px 17px rgba(70, 135, 222, 0.9) !important;" type="submit" name="submit" value=" '. $fetchedShares .' 🔁 "> </form> </a>
                  '; 
               }
   
               else {
                  echo '   
                  <a onclick="share(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\', );" > <input id="shareButton" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value=" '. $fetchedShares .' 🔁 "> </form> </a>
                  '; 
               }  

            }

            
            $isDisLikedAlready = $con->query("SELECT id FROM interactions WHERE postid = '$temppostid' AND userid = $sessionUserID AND type = 'Dislike';" ) or die($con->error); 
            $isDisLikedAlready=mysqli_result($isDisLikedAlready, 0, "id"); 
      
            if (isset($isDisLikedAlready)) {
               echo '
               <a class="interactPost" onclick="actionPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$temppostid.'\',\''."home".'\',\''."Dislike".'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="dislikebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedDislikes.' 👎" style="text-shadow: 0px 0px 13px rgba(247, 155, 67, 0.9) !important;"> </form> </a>

             '; 
            }

            else { 
               
               echo ' 
               <a class="interactPost" onclick="actionPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$temppostid.'\',\''."home".'\',\''."Dislike".'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="dislikebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedDislikes.' 👎"> </form> </a>
               
 
               '; 
            } 

            $isLikedAlready = $con->query("SELECT id FROM interactions WHERE postid = '$temppostid' AND userid = $sessionUserID AND type = 'Like';" ) or die($con->error); 
            $isLikedAlready=mysqli_result($isLikedAlready, 0, "id"); 
      
            if (isset($isLikedAlready)) {
               echo '

               <a class="interactPostTwo" onclick="actionPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$temppostid.'\',\''."home".'\',\''."Like".'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="likebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedLike.' 👍" style="text-shadow: 0px 0px 13px rgba(247, 155, 67, 0.9) !important;"> </form> </a>
 
               '; 
            }

            else {
               echo '
               <a class="interactPostTwo" onclick="actionPost(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][1][1].'\',\''.$temppostid.'\',\''."home".'\',\''."Like".'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="likebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedLike.' 👍"> </form> </a>
 
               '; 
            } 

            $fetchedSuperLikes = 1;

            $isSuperLikedAlready = $con->query("SELECT id FROM interactions WHERE postid = '$temppostid' AND userid = $sessionUserID AND type = 'Dislike';" ) or die($con->error); 
            $isSuperLikedAlready=mysqli_result($isSuperLikedAlready, 0, "id"); 
      
            if (isset($isSuperLikedAlready)) {
              // echo '
              // <a class="interactPost" onclick="superLike(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="dislikebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedSuperLikes.' ❤️" style="text-shadow: 0px 0px 13px rgba(255, 0, 0, 0.9) !important;"> </form> </a>

            // '; 
            }

            else { 
               
              // echo ' 
              // <a class="interactPost" onclick="superLike(\''.$sessionUserID.'\',\''.$posts[$postsloopnum][0][7][1].'\',\''.$_COOKIE["accountToken"].'\',)">  <input id="dislikebutton'.$temppostid.'" class="postAction floatAction scaled inputPostActionColor unscaledForMobile" type="submit" name="submit" value="'. $fetchedSuperLikes.' ❤️" style="text-shadow: 0px 0px 13px rgba(255, 0, 0, 0.9) !important;"> </form> </a>
               
 
              // '; 
            } 

            
         } 
         else {
            echo '<br> <p> </p>';
         }
   
         echo '</div>';
         echo '<br><br>';
         echo '</div>';
   
         
             
         echo "</div>  "; 
         echo '<br>';
      }
      else { 
         echo '<div id="postOnFeed" class="card-no-hover systemcolorPost mobilePost fit-image" style="margin-top:20px;height:auto;width:100%; border-bottom: 15px !important;">';  
         echo ' <div>  ' ; 
            
            echo "  <b><div style='border-left: 22px solid transparent;margin-top:-20px;'> <p > ". $names[0][0][0], " " .$names[0][1][0]. "</b> ";
             
            if ($names[0][2][0] == 1) { echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker"> '; }  
            
            echo "is in a relationship with <b>";


            $useridOfRel = $posts[$postsloopnum][0][2][1]; 
            $sqlNames = $con->query("SELECT username,verified FROM users WHERE id = '$useridOfRel';" ) or die($con->error);  
            while($rowNames = mysqli_fetch_assoc($sqlNames)) { 
               $namesRel[] = array ( 
                  array($rowNames['username']),
                  ); 
            }   
 
            echo $namesRel[0][0][0] . "</b> "; 

            if ($names[0][2][0] == 1) { echo '<img class="float nodrag" src="image/verified.png" height= "auto;" width="22px;" style="float:none; " alt="Verified Sticker"> '; }  

            if ($returndata == "0m") { 
               echo " <br> ".$lang_just_now." ". $locationdata . "  </p>  ";  
            }
            else {
               echo " <br> ".$returndata." ". $locationdata . "  </p></div>  ";   
            }
        
            echo "</div>"; 

         echo "<div style=' 
         margin:auto;
         width: 35%; 
         padding: 0px;
         border-left:0px;  '>"; 

         $personid1 = $posts[$postsloopnum][0][1][1];
         $personid2 = $posts[$postsloopnum][0][2][1];

         $contentURL1 = $con->query("SELECT pfpurl FROM users WHERE id = '$personid1'") or die($con->error); 
         while($rowsID = mysqli_fetch_assoc($contentURL1)) { $contenturlimg1 = $rowsID['pfpurl']; }  

         $contentURL2 = $con->query("SELECT pfpurl FROM users WHERE id = '$personid2'") or die($con->error); 
         while($rowsID = mysqli_fetch_assoc($contentURL2)) { $contenturlimg2 = $rowsID['pfpurl']; }  

         $useridtemp = $posts[$postsloopnum][0][1][1];
         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$useridtemp';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
         $requestedUsername = ($row['username']);
         }

         $useridtemp2 = $posts[$postsloopnum][0][2][1]; 
         $usernameReqe2 = $con->query("SELECT username FROM users WHERE id='$useridtemp2';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe2)) { 
         $requestedUsername2 = ($row['username']);
         }

         echo "<div style='margin-left:-20px;'> <a href='profile?u=" .$requestedUsername. "'><img class='float nodrag imageshadow' src='".$contenturlimg1."' height= '80px;' width='80px;' style='float:left; border-radius:50%;  ' alt='Profile Picture'> </a> </div>";
         echo " <p style='margin-left:85px;position:absolute;font-size:24px;'> ❤️ </p> ";
         echo "<div style='margin-left:-20px;'> <a href='profile?u=" .$requestedUsername2. "'><img class='float nodrag imageshadow' src='".$contenturlimg2."' height= '80px;' width='80px;' style='float:right; border-radius:50%;  ' alt='Profile Picture'> </a> </div>";
         echo "</div>";
 
         unset($contenturlimg1);
         unset($contenturlimg2); 

         unset($personid1);
         unset($personid2); 
 
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";
         echo "<br>";

         echo "<br> </div> <br> ";
         echo "</div> ";
         echo "</div> ";
      }

      if ($postsloopnum + 1 == $postnum) {
      echo ' <div class="card-no-hover systemcolor" style="margin-top:20px; "> ';
        
      if ($fetch != "ID") {
         echo ' <p> '.$lang_postfetch_nomoremakefriend.'</p> ';
      }
      else {
         echo ' <p> '. $lang_postfetch_nonefound.'</p>';
      } 
      echo ' </div> ';
      }   

      if ($fetch == "ID") { if (($postsloopnum + 1) == count($pinnedPosts)) { echo '</div> <br>'; }  }

     $postsloopnum = $postsloopnum + 1;  
   }  
}
?>
