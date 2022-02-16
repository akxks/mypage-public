
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id'];  
$currentpassword = htmlspecialchars(stripslashes($_POST['password'])); 
$newpassword = htmlspecialchars(stripslashes($_POST['newpassword'])); 
$newpasswordConfirm = htmlspecialchars(stripslashes($_POST['newpasswordConfirm'])); 
 
$answer = $_POST['logoutofallotherdevices'];  

if ($newpasswordConfirm == $newpassword) {

  if ($currentpassword != $newpasswordConfirm) {

     if ((strlen($_POST['newpasswordConfirm'])) > 4) { 
 
        $newpasswordConfirm = mysqli_real_escape_string($con,$newpasswordConfirm);
 
        $sql = "UPDATE users SET password = '".password_hash($newpasswordConfirm, PASSWORD_DEFAULT)."' WHERE id = '$sessionUserID'";
 
        if ($answer == "logout") {          
          
            $token = bin2hex(random_bytes(360/2)); 
   
            setcookie("accountToken", "", time() - 3600); // delete cookie

            setcookie("accountToken", $token, time() + (86400 * 183), "/"); // 86400 = 1 day (x 183 thats a year) // MAKE NEW COOKIE WITH NEW TOKEN
 
            $sql = "UPDATE users SET accountToken = '$token' WHERE id = '$sessionUserID'";

        } 

        if (mysqli_query($con, $sql)) { 
      
          header("Location:../settings?success"); 
      
        }
  
    } 
    
    else {

      header("Location:../settings?errorLess"); 

    }
  
  }

  else {
    
   header("Location:../settings?errorSame"); 

  }

} else {

  header("Location:../settings?errorNotSame"); 

}
    
?>