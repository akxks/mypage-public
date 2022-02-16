
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


?>
<h3 class='hrefColor' style='margin-top:110px;'> Creator Dashboard </h3>


<div class="form card-no-hover systemcolor-noborder profilePhone" style="width:70%;height:auto;padding:30px; float:left; border-radius:6px;">  
            <?php 
            $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$requestedID'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 

            $emojiStyle = $con->query("SELECT emojistyle FROM users WHERE id = '$requestedID'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($emojiStyle)) { $emojiStyleEmoji = $rowsID['emojistyle']; } 
            ?>  

            <div class="circle-grid">
            <?php  $emojiRound = $emojiStyleEmoji; ?>

            <img class="imageshadow float nodrag profileimage " src="<?php echo $contenturlimg; ?>" height= "90px;" width="90px;" style=" border-radius:50%; margin-top:8px !important;" alt="Profile Picture">
              <div style="  transform: rotate(20deg); font-size:18px; "><?php echo $emojiRound; ?></div> 
               <div style=" margin-top: -15px;transform: rotate(29deg); font-size:17px; ">  </div>  
              <div style=" margin-right: 5px; transform: rotate(-50deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
              <div style=" transform: rotate(-17deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
              <div style=" margin-right: 15px; transform: rotate(28deg); font-size:19px; "><?php echo $emojiRound; ?></div> 
              <div style=" margin-bottom: 15px; transform: rotate(-71deg); font-size:20px; "><?php echo $emojiRound; ?></div> 
              <div style=" transform: rotate(22deg); font-size:16px; ">  </div> 
            </div>  
  
 
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

    <div class="form card-no-hover systemcolor-noborder profilePhone" style="width:28%;height:auto;padding:30px; float:right; border-radius:6px;">  
 
 
        <div> 
                    
                  
          <p style='font-size:22px;'> $9,669,992,110 </p> 
           
          <p> Your Balance </p> 


        </div>  

    </div>

    <div id="profileInfo" style="float:left;width:38%;margin-top:1.5vw;margin-right:10px;">
    
    <?php 

  echo ' <div class="card-no-hover systemcolor"> '; 
  echo ' <p> test </p> ';
  echo ' </div> ';  
  ?> 
      
      </div>    

<div id='profilePosts' style="float:right;width:60%;margin-top:1.5vw;">  

  <?php 

  echo ' <div class="card-no-hover systemcolor"> '; 
  echo ' <p> test </p> ';
  echo ' </div> ';  
  ?>

</div> 
</div>
<br>

<div class="form card-no-hover systemcolor-noborder profilePhone" style="width:100%;height:auto;padding:30px;  border-radius:6px;">  
<style>  

#reverse-data-example-1 {
  height: 250px;
  max-width: 800px;
  margin: 0 auto;
}
</style> 

<table id="data-example-6" class="charts-css area">

<table id="reverse-data-example-1" class="charts-css column show-labels hide-data"><caption> Reverse Data Example #1 </caption> <thead><tr><th scope="col"> Month </th> <th scope="col"> Progress </th></tr></thead> <tbody><tr><th scope="row"> Jan </th> <td style="--size:0.3;"><span class="data"> 30 </span></td></tr> <tr><th scope="row"> Feb </th> <td style="--size:0.5;"><span class="data"> 50 </span></td></tr> <tr><th scope="row"> Mar </th> <td style="--size:0.8;"><span class="data"> 80 </span></td></tr> <tr><th scope="row"> Apr </th> <td style="--size:1;"><span class="data"> 100 </span></td></tr> <tr><th scope="row"> May </th> <td style="--size:0.65;"><span class="data"> 65 </span></td></tr> <tr><th scope="row"> Jun </th> <td style="--size:0.45;"><span class="data"> 45 </span></td></tr> <tr><th scope="row"> Jul </th> <td style="--size:0.15;"><span class="data"> 15 </span></td></tr> <tr><th scope="row"> Aug </th> <td style="--size:0.32;"><span class="data"> 32 </span></td></tr> <tr><th scope="row"> Sep </th> <td style="--size:0.6;"><span class="data"> 60 </span></td></tr> <tr><th scope="row"> Oct </th> <td style="--size:0.9;"><span class="data"> 90 </span></td></tr> <tr><th scope="row"> Nov </th> <td style="--size:0.55;"><span class="data"> 55 </span></td></tr> <tr><th scope="row"> Dec </th> <td style="--size:0.4;"><span class="data"> 40 </span></td></tr></tbody></table>
</div>

</div>



</div> 


</div> 
