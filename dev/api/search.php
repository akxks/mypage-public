

<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script type="text/javascript" src="api/scripts.js"></script> 
<?php  
include('db.php'); 
$sql = $con->query("SELECT COUNT(*) AS id FROM users;") or die($con->error);    
while($row = mysqli_fetch_assoc($sql)) { 
$param = ($row['id']);
}  

$sqlB = $con->query("SELECT COUNT(*) AS id FROM blocked WHERE useridBlocker = '$_SESSION[id]';") or die($con->error);    
while($row = mysqli_fetch_assoc($sqlB)) { 
$amount = ($row['id']);
}

$num = $param - $amount;
$formattedNum = number_format($num); 
?>