
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 

session_start(); 

if(!isset($_SESSION["id"]) or (isset($_SESSION['newuser']))) {
    
    header("Location: first"); 
    session_destroy(); 
    unset($_SESSION['newuser']); 
    exit();
    
} 

if (isset($_SESSION["id"])) {

    if(!isset($_COOKIE["accountToken"])) {
        
        header("Location: first"); 
        session_destroy(); 
        unset($_SESSION['newuser']); 
        exit();

    }  

    // Else, Account Token is set. 

}
?> 