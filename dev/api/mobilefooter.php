
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>

@media (prefers-color-scheme: dark) {  
	.mobileFooter {
		text-shadow: 0px 0px 17px rgba(255, 255, 255, 0.8);
	} 
}
@media (prefers-color-scheme: light) {  
	.mobileFooter {
		text-shadow: 0px 0px 17px rgba(0, 0, 0, 0.8);
	} 
}

</style> 
<?php 
$usernameReqe = $con->query("SELECT username FROM users WHERE id='$_SESSION[id]';") or die($con->error);    
while($row = mysqli_fetch_assoc($usernameReqe)) { 
$requestedUsername = ($row['username']);
} 

?> 
<?php 
require('db.php');   
if(!isset($_SESSION["id"])){
	exit;
} 

$glowFriends = "";
$glowProfile = "";
$glowHome = "";
$glowSearch = "";

$url = $_SERVER['REQUEST_URI']; 
if (str_contains($url,'friends') !== false) {
	$glowFriends = "mobileFooter";
} 
 
if (str_contains($url,'home') !== false) {
	if (str_contains($url,'friends') !== true) {
		if (str_contains($url,'trending') !== true) {
			$glowHome = "mobileFooter";
		}
	}
} 
 
if (str_contains($url,'friends') !== false) {
	$glowFriends = "mobileFooter";
} 

if (str_contains($url,'profile') !== false) {
	$glowProfile = "mobileFooter";
} 

if (str_contains($url,'trending') !== false) {
	$glowTrend = "mobileFooter";
} 

if (str_contains($url,'search') !== false) {
	$glowSearch = "mobileFooter";
} 

?> 


<script> 
function scrollToTop(){
  window.scrollTo(0, 0);
}
</script>

<div class="footer" id="footer" style=' border-radius: 5px !important; width: 100% !important;
 box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);   
  border-radius: 5px;
  background-color: rgba(0, 0, 0, .10);
   -webkit-backdrop-filter: blur(15px);
  backdrop-filter: blur(15px); '> 
<div>   
<?php 
//Translucent glass design

?> 

<button id="footerbutton" onclick="window.location='search';" style=" transform: scale(1.1); background-color: transparent; touch-action: manipulation;" class="dropbtn-home <?php echo $glowSearch; ?>"> 🔍 </button> 
<div class="divider"> </div>
<button id="footerbutton" onclick="window.location='home?trending';" style=" transform: scale(1.1); background-color: transparent; touch-action: manipulation;  " class="dropbtn-home <?php echo $glowTrend; ?>"> 🔥 </button> 
<div class="divider"> </div>
  
<?php 

if (str_contains($glowHome,'mobileFooter') !== false) { 
	echo '<button id="footerbutton" onclick="scrollToTop()" style=" transform: scale(1.1); background-color: transparent; touch-action: manipulation; " class="dropbtn-home '. $glowHome .'"> 🏠 </button>  
	';
}
else {
	echo '<button id="footerbutton" onclick="window.location=\'home\';" style=" transform: scale(1.1); background-color: transparent; touch-action: manipulation; " class="dropbtn-home '. $glowHome .'"> 🏠 </button>  
';
}

?>

<div class="divider"> </div>
<button id="footerbutton" onclick="window.location='home?friends';" style=" transform: scale(1.1);  background-color: transparent; touch-action: manipulation; " class="dropbtn-home <?php echo $glowFriends; ?>"> 💬 </button>  
<div class="divider"> </div>

<button id="footerbutton" onclick="window.location='profile?u=<?php echo $requestedUsername; ?>';" style="transform: scale(1.1) !important;   background-color: transparent;color:#ff2449;  touch-action: manipulation; " class="dropbtn-home <?php echo $glowProfile; ?>"  > 👤 </button>   
</div> 
</div>  
</div> 