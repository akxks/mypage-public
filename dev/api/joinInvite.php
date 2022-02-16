
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<?php 
session_start();
if(isset($_SESSION["id"])){
  header("Location: home");
  exit;
}
?>

<style>
.img-with-text {
   text-align: justify;
   width: 0px;
} 
</style>
<?php  

  $invcode =  (htmlspecialchars(stripslashes($_GET['code'])));
  
  $sqlMakerName = $con->query("SELECT codemaker FROM invites WHERE code = '$invcode' AND used = 0;") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($sqlMakerName)) { 
     $codeMakerFromInv = $rowNames['codemaker'];   
  } 

  if (isset($codeMakerFromInv)) {

   $sqlMaker = $con->query("SELECT usernames FROM users WHERE id = '$codeMakerFromInv';") or die($con->error);    
   while($rowNames = mysqli_fetch_assoc($sqlMaker)) { 
      $firstnameofInviter = $rowNames['usernames'];   
   } 
 
  }
  else {
   $invcode = NULL;
  }

  if (isset($invcode)) {
      echo "
      <div class='card-no-hover systemcolor' style='margin-top:30px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
      <h2> Join with Invite Code 👋 </h2>   
      <p style='font-size:20px;'> Join mypage with ". $firstnameofInviter ."'s invite! A new social media network, focusing on privacy, and making new friends! </p> 
      </div> 
      ";    
   }

   else {
      echo "
      <div class='card-no-hover systemcolor' style='margin-top:30px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
      <h2> Join with Invite Code 👋 </h2>   
      <p style='font-size:20px;'> Join mypage with an invite code! A new social media network, focusing on privacy, and making new friends! </p> 
      </div> 
      ";   
   }

   echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:50px;'>";   

   echo '<hr>'; 
   echo "<div class='systemcolor-Noborder' style='padding:40px;padding-bottom:0px;padding-top:0px;width:100%; '>";   
   
   if (!isset($invcode)) {

      echo '<center> <p style="margin-top:35px;"> 💭 That invite code does not seem to work. </p> </center> ';
      
      exit;  

   }
   echo ' <center> <h3>Invited by '. $firstnameofInviter .'</h3>  </center> ';
   echo '<center>'; include 'api/register.php'; 
   echo '</center>'; 
   echo '</div>';   

   echo '<hr>'; 
   echo '</div>';
   
?>