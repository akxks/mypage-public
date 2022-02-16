
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
date_default_timezone_set('Europe/London'); 

error_reporting(0);  
ini_set("display_errors", 0); 
$con = mysqli_connect("localhost","root","","mypage"); 
//if (mysqli_connect_errno()) { echo "Uh-oh, we encountered a big problem... " . mysqli_connect_error(); exit; }
if (mysqli_connect_errno()) { echo "Fatal connection Error", exit; }
?>