
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>
.img-with-text {
   text-align: justify;
   width: 0px;
} 

img.emojione { 
  margin: 0px !important;
  display: inline !important;
  
  height: auto;
  width: 50px;
}

p#wrong-test {
  border-top: 1px solid black;
  border-bottom: 1px solid black;
  display: inline-block;
}

span.emoji {
  font-size: 44px;
  vertical-align: middle;
  line-height: 2;
}

</style>
<?php 
require('db.php');  
if(!isset($_SESSION["id"])) { exit; } 
$sessionUserID = $_SESSION['id'];   
echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   

$languageEmoji = array("🇬🇧", "🇭🇺", "🇪🇸", "🇷🇺", "🇷🇴", "🇫🇷", "🇵🇱", "🇩🇪", "🇨🇳", "🇬🇷");
$languageName = array("English (english)","Hungarian (magyar)",  "Spanish (español)", "Russian (русский)", "Romanian (română)", "French (français)", "Polish (polski)", "German (deutsche)", "Chinese (中国)", "Greek (elinika)");
$languageCode = array("en","hu", "es", "ru", "ro", "fr", "pl", "de-ch", "zh", "el");

$sql = $con->query("SELECT language FROM users WHERE id = $sessionUserID") or die($con->error);    
while($row = mysqli_fetch_assoc($sql)) {
   $lang[] = $row['language'];
}

$i = -1;
foreach ($languageEmoji as $languageNumber) { 
   $i++;  
   if ($i != 0) { echo '<hr>';  } else { echo '<hr> <hr>'; }
   echo "<a style='text-decoration:none;' href='api/changelanguage?lang=" . $languageCode[$i] . "'>"; 
   echo "<div class='systemcolor-Noborder hoverLang' style='padding:40px;padding-bottom:0px;padding-top:0px;width:100%;'>";   
  
   if ($lang[0] == $languageCode[$i]) {
      echo "<div> <p style='margin:-10px !important;padding:0px !important;'> <span class='emoji'> ". $languageNumber  ." </span> ". $languageName[$i] ." ", " <span style='float:right;font-size:25px;padding:25px;color:#ff2449;'> ✅ </span> <br> </form> </p> </div>"; 
   }
   else {
      echo " <p style='margin:-10px !important;padding:0px !important;'> <span class='emoji'> ". $languageNumber  ." </span> ". $languageName[$i] ." ", " <br> </form> </p>  "; 
   }
   echo '</div> </a>'; 
   echo '<hr>';  
}

echo '</div>'; 
?>