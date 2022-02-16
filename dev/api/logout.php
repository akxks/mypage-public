
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
session_start(); 
if(session_destroy()) { 
header("Location: ../first");
exit; }
?>