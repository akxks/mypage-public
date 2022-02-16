
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');  
require('auth.php');
$sessionUserID = $_SESSION['id'];  
$lang = htmlspecialchars(stripslashes($_GET['lang'])); 
 
if (strlen($lang) > 5) {
   exit;
}
$sql = "UPDATE users SET language = '$lang' WHERE id = '$sessionUserID'";
if (mysqli_query($con, $sql)) { 
  header("Location:../language"); 
}
?>