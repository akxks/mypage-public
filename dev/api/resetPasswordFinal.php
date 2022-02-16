<?php
require('db.php');  
require('auth.php');

// valid email check start 

$email = htmlspecialchars(stripslashes($_POST['email'])); 

$sanitized_a = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {
    echo 'FATAL ERROR';
} else {
    //echo "This (a) sanitized email address is considered valid.\n";
    //valid.
}

// valid email check end  

$sql = $con->query("SELECT id FROM resetPassword WHERE email = '$email';" ) or die($con->error); 

while($rowsID = mysqli_fetch_assoc($sql)) { 
  $reports[] = array($rowsID['id']); 
} 

if (empty($reports)) { 

    $tokenGenerated = bin2hex(random_bytes(360/2)); 

    $sql = $con->query("INSERT INTO `resetPassword`(`email`, `token`, `success`, `create_date`) VALUES ($email, $tokenGenerated, false, NOW()); " ) or die($con->error); 

    // Send Mail -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 
    $to = $email;
    $subject = "Resetting Your Password";
      
    $message = "

    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body style='background-color:white;'>
    
    <style>
    
    #middlebox {
        float:left;  
        width:100%;  
     } 
     
    body {
        font-family:Arial, Sans-Serif; 
    }
    
    .card {  
        box-shadow: 0 2px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;   
        }
    .card:hover {
    box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
        } 
    
    .float, .floatAction {
    display: inline-block;
    vertical-align: middle;  
    -webkit-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-transition-property: transform; 
    transition-property: transform;
    -webkit-transition-timing-function: ease-out;
    transition-timing-function: ease-out;
    }
    .float:hover, .float:focus, .float:active { 
    -webkit-transform: scale(1.05);
    transform: scale(1.05); 
    }
    </style>
    
    <div class='card' style='background-image: linear-gradient(#ff3b5c, #de1641); height: 10%;  border-radius: 5px;'> 
    
    
    "
    
    . 
    
    '
    <div id = "middlebox">
    <a href="home"> <img class="nodrag" id="logo" src="../image/logo.png" height= "auto;" width="125px;" style="
       text-align: center;
       display: block; margin-left: auto; margin-right: auto;  padding-top:15px !important;   -webkit-tap-highlight-color: transparent;
    outline: none;
    -ms-touch-action: manipulation;
    touch-action: manipulation; " alt="Logo"> </img>
    
    </a>  
    </div>  
    
    '
    
    .
    " 
    </div> 
    
    
    <div class='card' style='background-color:white; height: 45%; margin:22%; margin-bottom:50px; margin-top:50px; border-radius: 5px;'> 
    
    <div> 
    <br>
    <h2 style='margin:30px;'> Reset password 🔑 </h2 >
     
    <p style='font-size:19px; margin:30px;'> 
    
    Hi Andrea,  </p>
    
    <p style='font-size:18px;margin:30px;'> 
    
    You requested a password reset for your account. To continue, press the button below.
    If this was not you, please ignore this email. 
     
    
     <center> 
    
     <a href='mypage.com/reset?t=".$tokenGenerated."'> 
    
    <button class='float' style='
    position:relative;margin:0px;margin-bottom:0px !important;margin-left:20px;
    padding: 10px 25px 8px;
    color: #fff;
    background-color: #ff2449;
    text-shadow: rgba(0,0,0,0.24) 0 1px 0;
    font-size: 18px; 
    border: 2px solid #ff2449;
    box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
    border-radius: 3px;
    margin-top: 0px;
    cursor:pointer; 
    width:230px;
    outline: none; 
    box-shadow: 0 0 12px #ff2449;
    
    '> Reset Password </button> </center> </a>
    </p> 
    </div>
    
    </div> 
    <center>
    
    
    <p style='font-size:15px;'> 
    To receive more help on this issue, please go to <a href='mypage.com/help' style='color:#ff2449;text-decoration: none; '> mypage.com/help </a>
    <br>  
    
    <br>
    
    <a href='mypage.com/about?tos' style='color:#ff2449;text-decoration: none; '> Terms of Service  </a> · <a href='mypage.com/about?privacy' style='color:#ff2449;text-decoration: none; '>  Privacy  </a> · </a> © Mypage 2021 </a> 
    
    </p> </center>
    
    </body>
    </html>
    ";
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    
    $headers .= 'From: <webmaster@mypage.com>' . "\r\n";

    //  $headers .= 'Cc: myboss@example.com' . "\r\n";
    
    mail($to,$subject,$message,$headers);
 
    // Send Mail End -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 
}
else { 

    exit; 

    // Already reset. Awaiting.
 
}
  

?>