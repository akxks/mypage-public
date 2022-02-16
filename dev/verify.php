
<?php

$getToken = $_GET['t'];

//if token not set
if (!isset($getToken)) {
  header("Location: first");  exit; 
}

//if token is NOT a token A-z-0-9
if(preg_match("^[a-z0-9]+$", $getToken) != false) {  header("Location: first");   exit; }


//if TOKEN is not in DB
$query = "SELECT `id` FROM `verifyAcc` token='$getToken'";

$result = mysqli_query($con,$query) or die(mysqli_error($con)); 

$rows = mysqli_num_rows($result);  

if($rows!=1){   
  header("Location: first"); exit;
} 


?>  