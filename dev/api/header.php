
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style> 
#leftbox {
   float:left;  
   width:25%;  
} 
#middlebox {
   float:left;  
   width:50%;  
} 

#rightbox{
   float:right; 
   width:25%;  
} 
</style> 
<?php
ob_start();
require('api/lang.php'); 
require('api/db.php');   
if(!isset($_SESSION["id"])){
	exit;
}
 
$url = $_SERVER['REQUEST_URI']; 
if (strpos($url,'profile') !== false) {
   if (strpos($url,$_SESSION['id']) !== false) {
   $boldfinish2 = "</b>";
   $bold2 = "<b>";
   }
   else {
   $boldfinish2 = "";
   $bold2 = "";
   }
} else {
   $boldfinish2 = "";
   $bold2 = "";
}

if (strpos($url,'home') !== false) {
   $boldfinish = "</b>";
   $bold = "<b>";
} else {
   $boldfinish = "";
   $bold = "";
}   
if (strpos($url,'invite') !== false) {
   $boldfinish3 = "</b>";
   $bold3 = "<b>";
} else {
   $boldfinish3 = "";
   $bold3 = "";
}   
?> 
 
<!DOCTYPE html>
<html lang="en"> 

<script> 
var conn = new WebSocket('ws://localhost:8080');

<?php echo $_SESSION['id']; ?> 
conn.onopen = function(e) {
   console.log("CONNECTION ESTABLISHED.");
}
conn.onerror = function(e) {
   console.log("CONNECTION TO MYPAGE SERVERS FAILED.");
};

conn.onmessage = function(e) {
   console.log(e.data);
};
</script> 

<style>

@media (prefers-color-scheme: dark) {

   .glowHeader {
      box-shadow: 0px 0px 20px rgba(222, 22, 65, 0.7);
   }

}

</style>
<div style="margin-bottom: 80px;"> 
<div id="mobileheader" class="mobileHeader glowHeader sticky" style = " margin-left:-8px;visibility:visible; height:72px;max-height:72px;width: 100%;margin-bottom:10px; border-radius: 0px; background-image: linear-gradient(#ff3b5c, #de1641); ">
<?php 
//Translucent glass design

//box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);   
// border-radius: 5px;
//  background-color: rgba(255, 255, 255, .10);
//  -webkit-backdrop-filter: blur(10px);
//  backdrop-filter: blur(10px);
?> 
<div> 
   <div id = "leftbox"> 
      <script type="text/javascript">
               var session_id = '<?php echo $_SESSION["id"];?>';
               var fetchid = 'home'; 
               var account_token = '<?php echo $_COOKIE['accountToken']; ?> ';
               var mobileordesktop = 'mobile';

         </script> 
         <script type="text/javascript" src="api/notifFetcher.js"></script> 

         <?php // ajax refresher for Friends Reqs and Notifications. ?>
         <div style=" float:left;height:15px;margin-right:50px; " id='fetchNotifs'> 
            <?php 
            $sessionUserID = $_SESSION['id'];  
            $accountToken = $_COOKIE['accountToken']; 
            $mobileordesktop = 'mobile';
            include 'api/notifFetchHeader.php';?> 
         </div> 
   </div>  
   </div>  
   <div id = "middlebox">
     <a href="home"> <img class="nodrag opacityHover" id="logo" src="image/logo.png" height= "auto;" width="125px;" style="
        text-align: center;
        display: block; margin-left: auto; margin-right: auto;  padding-top:15px !important;   -webkit-tap-highlight-color: transparent;
  outline: none;
  -ms-touch-action: manipulation;
  touch-action: manipulation; " alt="Logo"> </img>
  
   </a>  
   </div>  
   
   <div id = "rightbox" style='border: 0px solid blue;'>
 
   <button id=" "  onclick="menu('menuMobile')" style="  float: right;  
      margin-top:1px; transform: scale(1.38); 
      background-color: transparent;text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6);
      -webkit-tap-highlight-color: transparent;
      outline: none;
      -ms-touch-action: manipulation;
      touch-action: manipulation; " class="dropbtn hoverColor" > ⚙️ </button>  
 
      <button id=" " onclick="window.location='invite';" style="  position: absolute; float: left;  
      margin-top:1px; transform: scale(1.38); 
      background-color: transparent;text-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6);
      -webkit-tap-highlight-color: transparent;
      outline: none;
      -ms-touch-action: manipulation;
      touch-action: manipulation; margin-left: -10px;" class="dropbtn-home"> ✉️ </button> 

            <div id="menuMobile" class="dropdown-content systemcolor-noborder" style="margin-left:200px;width: 170px;"> 
               
               <!--  <a href="creator" class="hrefColor"  style='margin:3px; font-size:17px;'> <p style='display:inline; '> 🤑 </p> Wallet </a>  !--> 
               <hr>
               
               <a href="settings" class="hrefColor" ><?php echo $lang_header_dropdown_settings ;?> </a>
               <a href="edit" class="hrefColor" >🏷️ Edit Profile </a>
               <!-- <a href="find" class="hrefColor" ><?php echo $lang_header_dropdown_findfriends ;?></a>  !--> 
               <a href="language" class="hrefColor" ><?php echo $lang_header_dropdown_language;?></a>
             <!--   <a href="card" class="hrefColor" >💳 Add Payment</a>  !--> 
               <hr>  
               <a href="support" class="hrefColor" >⛑️ Support </a>
               
               <?php 
               $ifadmin = $con->query("SELECT admin FROM users WHERE id = $_SESSION[id];") or die($con->error);    
               while($ifadmin2 = mysqli_fetch_assoc($ifadmin)) { 
                  $admin = ($ifadmin2['admin']);  
               }   

               if ($admin == 1) {
                  echo '<a href="dashboard" class="hrefColor" >🍒 Dashboard </a> ' ;
               }
               ?> 
               <a href="api/logout" class="hrefColor" ><?php echo $lang_header_dropdown_logout ;?> </a>  
               <center><p class="noselect" style="font-size:15px;color:gray;cursor:default;"> MyPage © 2021 </p></center>
               
            </div> 



    </div> 
   </div> 
</div>
</div>
</div> 
</div> 

<div class="" style="background-color:#ff2449;margin:-8px;-webkit-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);-moz-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);box-shadow: 0 6px 4px -4px rgba(0,0,0,0.465); ">
<div class="header glowHeader sticky" id="header" style = " height:72px;max-height:20vh;width: 100%;"> 
<div class="left" style=" float:left; ">
               <style>.opacityHover:hover { opacity: 0.75; } </style> 
    <a href="home"> <img class="nodrag opacityHover" id="logo" src="image/logo.png" height= "auto;" width="100px;" style="margin-top: 10px;" alt="Logo"> </img> </a></div>
     
     <div class="left" id="headerRemove" style="float:left; "> 
     
      <div class="search-container" id="hideSmallerScreen"  style = "margin-top:2px; "  > 
      <?php  
         if (strpos($url,'search') == false) {
            include 'api/search.php'; 
            echo ' <input style="outline:none;box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.4); width: auto; " type="text" id="search" placeholder=" 🔍 '.$lang_header_search.' '. $formattedNum - 1 .' '.$lang_header_search_users.'" autocomplete="off"/> ';

           // echo ' <a href="search" > <button class="hoverAnimation" type="submit" style="margin-left:13px;background-color: transparent;color:white;" >'.$lang_header_search.'</button> </a> ';

            echo ' <div class="search-container" style = "margin-top:2px; margin-top: 10px; position: absolute;"  >  
            <div id="mySearch" class="search-content systemcolor-noborder" style="width: 380px; max-height: 400px; overflow-y: scroll; top: 7vh !important; left: 0px !important; "> 
            <div id="display"> </div> 
            </div> 
            </div>  '; 

         } 
      ?>
      </div>
      </div>

   
    <div class="right mainpage" style="margin-right:0px;font-size:2vh;float:right; border: 3px solid transparent; border-radius:2px; "> 

         <script type="text/javascript">
               var session_id = '<?php echo $_SESSION["id"];?>';
               var fetchid = 'home'; 
               var mobileordesktop2 = 'desktop';
               var account_token = '<?php echo $_COOKIE["accountToken"]; ?> ';
         </script> 
         <script type="text/javascript" src="api/notifFetcherDesktop.js"></script> 

         <?php // ajax refresher for Friends Reqs and Notifications. ?>
         <div style=" float:left;height:15px;margin-right:50px; " id='fetchNotifsDesktop'> 
            <?php 
            $sessionUserID = $_SESSION['id'];  
            $accountToken = $_COOKIE['accountToken'];
            $mobileordesktop2 = 'desktop';
            include 'api/notifFetchHeaderDesktop.php';?> 
         </div> 

         <div style="margin-top:5px;width:460px;margin-left:0px;"> 

         <?php 
         
         $usernameReqe = $con->query("SELECT username FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
         while($row = mysqli_fetch_assoc($usernameReqe)) { 
         $requestedUsername = ($row['username']);
         } 

         ?>

         <button onclick="window.location='profile?u=<?php echo $requestedUsername; ?>';" style=" background-color: transparent;color:white;" class="dropbtn-home"><?php echo $bold2; ?><?php if(preg_match("/[a-z]/i", $_SESSION['firstname'])){ echo $_SESSION['firstname']; } else { echo $_SESSION['username']; } ?><?php echo $boldfinish2; ?></button>   
         <button onclick="window.location='home';" style=" background-color: transparent;color:white;" class="dropbtn-home"><?php echo $bold; ?><?php echo $lang_header_head_home;?><?php echo $boldfinish; ?></button> 
         <button onclick="window.location='invite';" style=" background-color: transparent;color:white;" class="dropbtn-home"><?php echo $bold3; ?><?php echo $lang_header_head_invite;?><?php echo $boldfinish3; ?></button>   
         <button onclick="menu('menu')" style=" background-color: transparent;color:white;" class="dropbtn"><?php echo $lang_header_head_more;?></button>
         <div class="dropdown" style="z-index:998;"> 
         <div id="menu" class="dropdown-content systemcolor-noborder" style="width: 170px;"> 
 
          <!--  <a href="creator" class="hrefColor"  style='margin:3px;  '> <p style='display:inline; '> 🤑 </p> Wallet </a> !-->
            <hr>
            <a href="settings" class="hrefColor" ><?php echo $lang_header_dropdown_settings ;?> </a>
            <a href="edit" class="hrefColor" >🏷️ Edit Profile </a>
           <!--   <a href="find" class="hrefColor" ><?php echo $lang_header_dropdown_findfriends ;?></a>  !--> 
            <a href="language" class="hrefColor" ><?php echo $lang_header_dropdown_language;?></a>
            <!-- <a href="card" class="hrefColor" >💳 Add Payment</a>  !--> 
            <hr>  
            <a href="support" class="hrefColor" >⛑️ Support </a>
            
            <?php 
            $ifadmin = $con->query("SELECT admin FROM users WHERE id = $_SESSION[id];") or die($con->error);    
            while($ifadmin2 = mysqli_fetch_assoc($ifadmin)) { 
               $admin = ($ifadmin2['admin']);  
            }   

            if ($admin == 1) {
               echo '<a href="dashboard" class="hrefColor" >🍒 Dashboard </a> ' ;
            }
            ?> 
            <a href="api/logout" class="hrefColor" ><?php echo $lang_header_dropdown_logout ;?> </a> 
            <center><p class="noselect" style="font-size:15px;color:gray;cursor:default;"> MyPage © 2021 </p></center>

         </div>  
        </div>   
      </div> 
</div> 
</div>
</div>
</div>    
</div>
</div>  