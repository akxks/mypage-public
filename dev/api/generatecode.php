
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php  
require('db.php'); 
require('auth.php');
$sessionUserID = $_SESSION['id'];

function random_str(
   int $length = 64,
   string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string { 
 
   $pieces = [];
   $max = mb_strlen($keyspace, '8bit') - 1;
   for ($i = 0; $i < $length; ++$i) {
       $pieces []= $keyspace[random_int(0, $max)];
   }

   $code = implode('', $pieces); 
   include('db.php');
   $checkinv = $con->query("SELECT id FROM invites WHERE code='$code'") or die($con->error);    
   while($row = mysqli_fetch_assoc($checkinv)) { 
      $invcode = ($row['id']);
   } 
   if(isset($invcode)) {
      random_str(5); 
   } 
   else { 
      return $code;
   }
}

$sql = $con->query("SELECT COUNT(*) AS codemaker FROM invites WHERE codemaker = $sessionUserID;" ) or die($con->error); 
while($row = mysqli_fetch_assoc($sql)) { 
   $countinvitesmade = ($row['codemaker']);  
} 


$ifadmin = $con->query("SELECT admin FROM users WHERE id = $sessionUserID;") or die($con->error);    
while($ifadmin2 = mysqli_fetch_assoc($ifadmin)) { 
   $admin = ($ifadmin2['admin']);  
}   

if ($admin == 1) {

   $code = random_str(5); 
   $sqlmakeinvite = "INSERT INTO `invites` (codemaker, codeuser, code, used, use_date, create_date)
   VALUES ($sessionUserID, 0, '$code', 0, NOW(), NOW())";  
   $result = mysqli_query($con,$sqlmakeinvite);  
   if($result){ 
      header("Location: ../invite");
      exit;
   } 
   exit; 
   
}

else {

   if ($countinvitesmade < 20) {  
      $code = random_str(5); 
      $sqlmakeinvite = "INSERT INTO `invites` (codemaker, codeuser, code, used, use_date, create_date)
      VALUES ($sessionUserID, 0, '$code', 0, NOW(), NOW())";  
      $result = mysqli_query($con,$sqlmakeinvite);  
      if($result){ 
         header("Location: ../invite");
         exit;
      } 
      exit;
   } 

}

?>