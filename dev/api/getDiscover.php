
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

<h2 class='hrefColor' style="display:inline-block;margin-top:30px;"> Discover </h2>  
<p style="font-size:12px; padding-left:5px; color:#ff2e7b; display:inline-block;"> NEW </p>
 
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 25%;
  padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}
 
.card { 
  padding: 16px;  
}
</style>
</head> 

<?php 

$discoverPosts = 1;

if ($discoverPosts == 0) {

  echo "
  
  <div style='  float: right;  width: 100%;' >  

  <p style='font-size:62px !important; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> 💭</p>

  <p style='font-size:20px !important;'> No posts found, <br> please check back later. </p> 

  </div> 
  
  ";

}
else {

  echo '<div class="row">';

  echo ' 
  <div class="column">
  <div class="card float systemcolor-noborder" style="border-radius:5px; padding:25px; height:auto; width:auto;">
    <h3>Card 1</h3>
    <p>Some text</p>
    <p>Some textssss</p>
  </div>
  </div>';

  echo '</div>';

}

?>
<center> 
<?php include("api/links.php"); ?>
</center>