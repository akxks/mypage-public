
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php  
require('db.php');  
$sessionUserID = $_SESSION['id']; 
$sql = $con->query("SELECT language FROM users WHERE id = '$sessionUserID'") or die($con->error);    
while($row = mysqli_fetch_assoc($sql)) {
   $lang[] = $row['language'];
}
$_SESSION['lang'] = $lang[0];

if (!isset($_SESSION['lang'])) {
   $_SESSION['lang'] = "en";
}
require('lang/'.$_SESSION["lang"].'.php');
// 1. Use emojis that are already made in English
// 2. Use whitespaces - do not remove them
// 3. When you see two variables with 1,2 after them, it means its a sentence that is split in two because there is a number or something between them.
// May 9 2021 - Adrian K 
?>