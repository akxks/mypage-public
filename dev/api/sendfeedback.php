
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 

function reCaptcha($recaptcha){

  $secret = "6LdvZu0bAAAAAK9nX6148pS42aY6wtj4VQlkM8AB";
  $ip = $_SERVER['REMOTE_ADDR'];

  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
  $url = "https://www.google.com/recaptcha/api/siteverify";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $data = curl_exec($ch);
  curl_close($ch);

  return json_decode($data, true);

}

require('db.php');  
require('auth.php');

$fname = htmlspecialchars(stripslashes($_POST['firstname'])); 
$email = htmlspecialchars(stripslashes($_POST['email'])); 
$message = htmlspecialchars(stripslashes($_POST['posttext'])); 
$recaptcha = $_POST['g-recaptcha-response']; 

$res = reCaptcha($recaptcha);

if(!$res['success']){
  header("Location:../feedback?error"); 
  exit; 
} 

if (isset($_POST['contactChoice2'])) { 

  $sql = "INSERT into `feedback` (name, email, message, type, create_date)

  VALUES ('$fname', '$email', '$message', 'Suggestion', NOW())"; 

}

if (isset($_POST['contactChoice1'])) { 
  
  $sql = "INSERT into `feedback` (name, email, message, type, create_date)
  VALUES ('$fname', '$email', '$message', 'Bug', NOW())"; 

}

if (mysqli_query($con, $sql)) { 

  header("Location:../feedback?success");  

} 
else {

  header("Location:../feedback?error");  

}

?>