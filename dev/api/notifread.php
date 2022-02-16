
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require "db.php"; 
require "auth.php";
$query = "UPDATE notifications SET `read` = 1 WHERE userid = $_SESSION[id];"; 
$execute = MySQLi_query($con, $query);  
?>