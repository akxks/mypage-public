
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require("api/auth.php");
include("api/button.php");
require("api/db.php");
require('api/lang.php'); 
?>
<!DOCTYPE html>
<html lang="en">  
<head>
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
<title><?php echo $lang_core_html_titles_settings;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<?php 
include('api/internetalive.php');
?>
<script type='application/javascript' src='fastclick.js'></script>
<script>
$(function() {
	FastClick.attach(document.body);
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript"> 
  $(document).ready(function() { 
    document.getElementById('hrefIDaccount').style.fontWeight = "900";
    document.getElementById('divIDprivacy').style.display = 'none'; 
    document.getElementById('divIDappearance').style.display = 'none';
    document.getElementById('divIDfeatures').style.display = 'none';
    document.getElementById('divIDnotifications').style.display = 'none'; 
    document.getElementById('divIDblockedUsers').style.display = 'none'; 
    document.getElementById('divIDblockedWords').style.display = 'none'; 
    if (window.location.href.indexOf("account") > -1) { 
      document.getElementById('divIDaccount').style.display = 'block';
      document.getElementById('hrefIDaccount').style.fontWeight = "900";
    }
    if (window.location.href.indexOf("privacy") > -1) { 
      document.getElementById('divIDprivacy').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDprivacy').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
    if (window.location.href.indexOf("appearance") > -1) { 
      document.getElementById('divIDappearance').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDappearance').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
    if (window.location.href.indexOf("features") > -1) { 
      document.getElementById('divIDfeatures').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDfeatures').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
    if (window.location.href.indexOf("blockedusers") > -1) { 
      document.getElementById('divIDblockedUsers').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDblockedUsers').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
    if (window.location.href.indexOf("blockedwords") > -1) { 
      document.getElementById('divIDblockedWords').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDblockedWords').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
    if (window.location.href.indexOf("notifications") > -1) { 
      document.getElementById('divIDnotifications').style.display = 'block';
      document.getElementById('divIDaccount').style.display = 'none'; 
      document.getElementById('hrefIDnotifications').style.fontWeight = "900";
      document.getElementById('hrefIDaccount').style.fontWeight = "normal";
    }
  });
</script> 


<script> 

function revealSetting(name) {

  var state = document.getElementById(name).style.display; 

  if (state == 'none') {
    document.getElementById(name).style.display = 'block'; 
  }
  else {
    document.getElementById(name).style.display = 'none'; 
  }
}

</script> 

<body>  
  <?php include 'api/header.php';?> 
  <div class="width-center"> 
    <div class="row"> 
    <div class="column" style="width: 10%;height:100%;margin-top:10vh;">  
        <div class="row"> 
        <div class=" " style="height:47.6vh;"> 
        </div>
        </div> 
    </div>  
    <div  id="hide600" class="column" style="width: 20%;height:100%;">
        <h2><?php echo $lang_core_settings_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:auto;">
 
            <a id="hrefIDaccount" style="color: inherit;text-decoration: inherit;" href = "settings?account"><?php echo $lang_core_settings_account;?></a> </p>
            <a id="hrefIDprivacy"  style="color: inherit;text-decoration: inherit;" href = "settings?privacy"><?php echo $lang_core_settings_privacy;?></a>  </p>
            <a id="hrefIDappearance"  style="color: inherit;text-decoration: inherit;" href = "settings?appearance"><?php echo $lang_core_settings_appearance;?></a>  </p>
            <a id="hrefIDblockedUsers"  style="color: inherit;text-decoration: inherit;" href = "settings?blockedusers"><?php echo $lang_core_settings_blockedusers;?></a>  </p>
            <a id="hrefIDblockedWords"  style="color: inherit;text-decoration: inherit;" href = "settings?blockedwords"><?php echo $lang_core_settings_blockedwords;?></a>  </p>
            <a id="hrefIDnotifications" style="color: inherit;text-decoration: inherit;" href = "settings?notifications"><?php echo $lang_core_settings_notifications;?></a>  </p>
            <a id="hrefIDfeatures" style="color: inherit;text-decoration: inherit;" href = "settings?features"><?php echo $lang_core_settings_features;?></a> </p>
        </div>
        </div> 
        <p style="text-decoration:none;color:gray;font-size:15px;">  <?php include('api/links.php'); ?> </p>  
    </div> 
    <div class="column" id="divIDaccount" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_account_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:auto; "> 
            <p><?php echo $lang_core_settings_account_desc;?></p>  
                        
            <?php if (isset($_GET['success'])) { echo ' ✅ Your password was updated! <br><br>  '; } ?>
            <?php if (isset($_GET['errorNotSame'])) { echo ' ❌ The new password does not match the confirmed new password <br> <br> '; } ?> 
            <?php if (isset($_GET['errorLess'])) { echo ' ❌ Your password cannot be less than four characters <br> <br> '; } ?>
            <?php if (isset($_GET['errorSame'])) { echo ' ❌ Your new password cannot be the same as your current password <br> <br> '; } ?>  

            <a onclick="revealSetting('changepass');" style="cursor:pointer;"> Change Password </a>
            
            <div id="changepass" style='display:none;margin-bottom:-10px;'>
             
                <form name="changepassword" action="api/changepassword" method="post">
 
                  <input id="idInput" type="password" name="password" placeholder="Current Password" required /> <br>  
                  <input id="idInput" type="password" name="newpassword" placeholder="New Password" required /> <br>
                  <input id="idInput" type="password" name="newpasswordConfirm" placeholder="Confirm New Password" required />
                  <br> <br>
                  <input id="idInput" type="radio" name="logoutofallotherdevices" value="logout"   />  Log out of all other Devices

                  <br><br> 

                  <?php 
                   echo '<input id="idInput" class="float" style="  width: 305px;" type="submit" name="submitchangepass" value="Change password" />'; 
                
                  ?> 
                </form>  
               
            </div>

            <?php echo "<br> <p style = ' '>Delete your account <a href='api/deleteAccount'> Delete </a>"; ?>
            <?php echo "<br> <p style = ' '>Request your data<a href=''> Request </a>"; ?>
        </div> 
        </div> 
    </div> 
    <div class="column" id="divIDprivacy" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_privacy_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:400px; "> 
            <p><?php echo $lang_core_settings_privacy_desc;?></p>  <br>  
            <?php 
            $sessionUserID = $_SESSION['id'];
            $sql = $con->query("SELECT `private` FROM users WHERE id = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
               $preference = $row['private'];
            }  
            if ($preference == 0) {
              echo "<p>".$lang_core_settings_changeprivacy."<a href='api/settingschange?setting=changeprivate'> ".$lang_core_settings_changeprivacy_on." </a>"; 
            }
            else {
              echo "<p>".$lang_core_settings_changeprivacy."<a href='api/settingschange?setting=changeprivate'> ".$lang_core_settings_changeprivacy_off." </a>"; 
            }    
            ?> 

            <?php 
            $sessionUserID = $_SESSION['id'];
            $sql = $con->query("SELECT `disablerelationships` FROM settings WHERE userid = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
               $preference = $row['disablerelationships'];
            }  
            if ($preference == 0) {
              echo "<p> Relationships: <a href='api/settingschange?setting=disablerelationships'> Disable relationships for your account. </a>"; 
            }
            else {
              echo "<p> Relationships: <a href='api/settingschange?setting=disablerelationships'> Enable relationships for your account. </a>"; 
            }    
            ?> 

            <?php 
            $sessionUserID = $_SESSION['id'];
            
            $sql = $con->query("SELECT `hideAccount` FROM users WHERE id = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
               $preference = $row['hideAccount'];
            }  

            if ($preference == 0) {
              echo "<p> Account Discoverability: <a href='api/settingschange?setting=hideAcc'> Hide your account from Search </a>"; 
            }
            else {
              echo "<p> Account Discoverability: <a href='api/settingschange?setting=hideAcc'> Make your account visible in Search </a>"; 
            } 
            ?> 

            <?php 
            $sessionUserID = $_SESSION['id'];
            
            $sql = $con->query("SELECT `likedposts` FROM settings WHERE userid = '$sessionUserID';") or die($con->error);
            while($row = mysqli_fetch_assoc($sql)) {
               $preference = $row['likedposts'];
            }  

            if ($preference == 1) {
              echo "<p> Show liked posts: <a href='api/settingschange?setting=likedposts'> Enable liked posts for others to see  </a>"; 
            }
            else {
              echo "<p> Show liked posts: <a href='api/settingschange?setting=likedposts'> Disable liked posts for others to see </a>"; 
            } 
            ?> 
        </div>
        </div> 
    </div>    
    <div class="column" id="divIDappearance" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_appearance_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:400px; "> 
            <p><?php echo $lang_core_settings_appearance_desc;?></p>  <br> 
            <?php echo "<p style = ' '> Dark or Light mode:<a href=''> On </a>"; ?>
        </div>
        </div> 
    </div>    
    <div class="column" id="divIDblockedUsers" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_blockedusers_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="min-height:400px; height:auto; "> 
            <p><?php echo $lang_core_settings_blockedusers_desc;?></p>  <br>   
            <?php include 'api/fetchblocked.php'; ?>
        </div>
        </div> 
    </div>    
    <div class="column" id="divIDblockedWords" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_blockedwords_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:400px; ">  


            <div id="blockwords" style='display:block;margin-bottom:-10px;'>
            
                <form name="blockwords" action="api/blockword" method="post">
                
                <script>  
                
                    function deleteblockedword(name, word, account_token) {  

                      $.ajax({ 
                        type: "GET", 
                        url: "api/deleteblockedword", 
                        data: { 
                            userid: name,
                            word: word,
                            account_token: account_token
                        }, 
                      success: function(response) {  location.reload(); }
                      });  
                    }   
 
                </script> 

                <?php  

                  $sql = $con->query("SELECT word FROM blockedWords WHERE userid = '$sessionUserID' ;" ) or die($con->error); 
                  while($rowsID = mysqli_fetch_assoc($sql)) { 
                    $blocked[] = array($rowsID['word']); 
                  }  

                ?>

                    <?php
                    
                    $acctokencookie = $_COOKIE['accountToken'];
 
                    if (!empty($blocked)) { echo '<p> The list of blocked words are: </p> '; }

                    
                  foreach ($blocked as $value) {
                    
                    echo "<a onclick=\"deleteblockedword('$sessionUserID', '$value[0]', '$acctokencookie')\" > $value[0] </a>";
                    
                  }
 
                 ?>   

                  <br>

                  <input id="idInput" type="name" name="name" style="width:auto;" placeholder="Block Word" required />  
                  <input id="idInput" class="float" style="width:auto;margin-top:0px !important;" type="submit" name="submitchangepass" value="Add " /> 
                  
                </form>  
               
            </div>


        </div>
        </div> 
    </div>    
    <div class="column" id="divIDnotifications" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_notifs_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:400px;"> 
            <p><?php echo $lang_core_settings_notifs_desc;?></p>  <br> 
        </div>
        </div> 
    </div>    
    <div class="column" id="divIDfeatures" style="width: 60%;height:100%;"> 
        <h2><?php echo $lang_core_settings_features_title;?></h2>
        <div class="row">
        <div class="card-no-hover systemcolor" style="height:400px; "> 
            <p><?php echo $lang_core_settings_features_desc;?></p>  <br> 
            <?php echo "<p style = ' '> Show test Posts (does not work) :<a href=''> Off </a>"; ?>
        </div>
        </div> 
    </div>    
    </div>
    <?php include 'api/mobilefooter.php';?>  
  </div> 
<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>
