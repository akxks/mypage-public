<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->
 
<?php 
$fetchTrend = 'home'; 
include 'api/trending.php'; 
unset($fetchTrend);
?> 

<div class='footermargin'> 
<?php include 'api/mobilefooter.php'; ?> 
</div>