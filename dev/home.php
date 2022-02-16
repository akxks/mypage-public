
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('api/db.php');
require('api/auth.php'); 
require('api/lang.php');  
?> 
<!DOCTYPE html>
<html lang="en"> 
<head>
 
<?php include_once("config/analyticstracking.php") ?>

<meta
  name="description"           
  content="A new generation social media
          network built for Privacy, Security
          and communication.">
<link rel="manifest" href="manifest.json" crossorigin="use-credentials">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" /> 
<meta name="HandheldFriendly" content="true"> 
<meta name="theme-color" content="#ff2449"/>
<link rel="apple-touch-icon" href="/icons/apple-icon-180.png">
<title><?php echo $lang_core_html_titles_index;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head>  
<body id="body"> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<?php  
include('api/button.php');  
include('api/internetalive.php'); 
?> 
<script>
if ('serviceWorker' in navigator) {
navigator.serviceWorker.register('service-worker.js');
}
</script> 

<style>
.hideTab {
  display: none !important;
  border: 3px solid red;
}
</style>

<div id='hider' class="wrapper">  

<?php include 'api/header.php';?>  

<?php

$sql = $con->query("SELECT registration FROM users WHERE id='$_SESSION[id]';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
   $checkReg = ($row['registration']);
} 

if ($checkReg == 1) { 


  $sql = $con->query("SELECT codemaker FROM invites WHERE codeuser='$_SESSION[id]';") or die($con->error);   
  while($row = mysqli_fetch_assoc($sql)) { 
    $getCodeMaker = ($row['codemaker']);
  } 

  $sql = $con->query("SELECT username FROM users WHERE id='$getCodeMaker';") or die($con->error);   
  while($row = mysqli_fetch_assoc($sql)) { 
    $getNameofInviter = ($row['username']);
  } 
 
  include 'api/modals.php' ; 

  welcomePerson($getNameofInviter, $_SESSION['id']);

  $finishWelcomeMessage = $con->query("UPDATE users SET registration = 0 WHERE id='$_SESSION[id]';") or die($con->error);   

}
 
?>  
 
    <?php 

    $url = $_SERVER['REQUEST_URI']; 
    if (str_contains($url,'friends') !== false) {

      require 'api/fetchfriendsForTab.php';

      echo ' <div class="main width-center hideTab"> '; 

    }
    
    if (str_contains($url,'trending') !== false) { 
      
      require 'api/fetchtrendingForTab.php';

      echo ' <div class="main width-center hideTab"> '; 
    }

    else { 

      echo ' <div class="main width-center"> '; 

    }

    ?>

      <div class="column" id="hideSmallerScreen" style=" width: 25% ; border: 0px solid transparent;  " >
        <?php 
        $fetchTrend = 'home'; 
        include 'api/trending.php'; 
        unset($fetchTrend);
        ?>
      </div>
 
        <div id="hideSmallerScreenMain" class="column" id="posts" style="width:50%">
         <div style="width:100%;max-width:650px;display: block;margin-left: auto;margin-right: auto;"> 
            <?php 

            $sql = $con->query("SELECT feedtype FROM users WHERE id = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
              $preference = $row['feedtype'];
            } 
            if ($preference == 0) {
              $preference = 1;
              echo '<button id="changefeed2" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;padding:none !important;">💭</button>';
            }
            else {
              $preference = 0;
              echo '<button id="changefeed2" style="border: none;cursor: pointer;float:right; font-size:25px;background-color: transparent;color:white;padding:none !important;">💫</button>';
            } 
            ?>
             <div> <h2><?php echo $lang_core_index_posts;?> </h2> <script type="text/javascript"> var session_id = '<?php echo $_SESSION['id'];?>'; var setting = 'feedpreference'; </script> <script type="text/javascript" src="api/feedchange.js"></script> </div>  
            <article>
            <div class="row">
            <div class="card-no-hover systemcolor" style="border: 25px solid transparent !important; height:150px;margin-bottom:40px; ">   
                <?php include 'api/post.php';?>   
            </div>  
            <?php   
            $requestedID = $_SESSION['id']; 
            $fetch = "home";
            include 'api/postfetch.php';?> 
            </div> 
            </article>
            <div class='footermargin'> <?php include 'api/mobilefooter.php';?> </div>
          </div>
        </div>

        <script> 

        // $(window).scroll(function(){
        //  $("#ffstuff").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "fast" );
        // }); 
        //
        </script>

        <div class="column" id="hide600" style="width:25% ;  ">
           <div style="width:100%;max-width:350px; float:left;"> 
            <div class="row" id="ffstuff"> 
                <div id="msgfriends" style="border: 0px solid blue;">  

                <script type="text/javascript"> 

                  var session_id = '<?php echo $_SESSION["id"]; ?>'; 
                  var personid = '<?php echo $_SESSION["id"] + 1; ?>';  
                  var account_token = '<?php echo $_COOKIE['accountToken']; ?> '; 
                  var data = {session_id, personid, account_token};

                 // alert(session_id);

                  $.ajax({ 
                  type: "GET", 
                  url: "api/messaging", 
                  data: data,
                  success: function(response) { 
                      $('#messagebox').html(response);
                        //var modal = document.getElementById("sharePost");  
                        //modal.style.display = "block"; 
                    }
                  });  

                </script>
                <script type="text/javascript" src="api/messaging.js"></script>

                <div id="messagebox" class="messagebox" style="display:none; border: 0px solid pink; "> 
                    
                </div>
                </div> 
 
                <div id="friendsfetching" style="display:block;">  
                  <script type="text/javascript">
                      var session_id = '<?php echo $_SESSION["id"];?>';
                      var fetchid = 'home';  
                      var account_token = '<?php echo $_COOKIE["accountToken"]; ?> ';

                  </script> 
                  <script type="text/javascript" src="api/friendslist.js"></script> 
                  <h2><?php echo $lang_core_index_friends;?></h2> 
                  <div style="border: 0px solid transparent;" id='fetchfriends' class="friends "> 
                    <?php 
                    $requestedID = $_SESSION['id']; 
                    $personid = 1; 
                    $fetch = "home";
                    $accountToken = $_COOKIE['accountToken']; 
                    include 'api/friendsfetch.php';?> 
                  </div> 
                  </div> 
                </div> 
            </div>
            </div> 
            
            <div class="column" id="hide600" style="width:25% ;  ">
           <div style="width:100%;max-width:350px; float:left;"> 
            <h2><?php echo $lang_core_index_suggestedfriends;?></h2>  

            <div class="row"> 
                <div class="friends"> 
                <div class="friends-content card-no-hover systemcolor-noborder" style="width: 100%; padding: 8px;border-radius: 6px;"> 
                  <?php 
                  $requestedID = $_SESSION['id']; 
                  $fetch = "home";
                  include 'api/suggestedfriends.php';?> 
                  </div>  
                  <div class='footermargin'> 
                </div>  
                <div class='footermargin'> 
            </div>
            <div class='footermargin'> 
            </div>   
            <div class='footermargin'> 
          <?php include 'api/mobilefooter.php'; ?> 
        </div>
</div> 
</div> 
</body> 
</html>