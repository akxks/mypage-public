
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
require('auth.php');

$sessionUserID = $_SESSION['id']; 
$word = htmlspecialchars(stripslashes($_POST['name']));

if ($word != " " or "  ") {
 
    if(preg_match("^[a-zA-Z0-9]+$", $word) != false) { exit; }

    $sql = $con->query("SELECT id FROM blockedWords WHERE id = '$sessionUserID' AND word = '$word';" ) or die($con->error); 
    while($rowsID = mysqli_fetch_assoc($sql)) { 
       $blocked[] = array($rowsID['id']); 
    }  
    
    if (empty($blocked)) {   
    
        $sql = $con->query("INSERT INTO `blockedWords`(`userid`, `word`) VALUES ('$sessionUserID', '$word');" ) or die($con->error); 
        
        header("Location:../settings?blockedwords"); 
    
    }
    else {
        exit;  
    }

}

?> 