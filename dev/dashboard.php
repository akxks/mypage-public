
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php  
require("api/auth.php");
include("api/button.php");
require('api/lang.php'); 
?>

<?php
$ifadmin = $con->query("SELECT admin FROM users WHERE id = $_SESSION[id];") or die($con->error);    
while($ifadmin2 = mysqli_fetch_assoc($ifadmin)) { 
   $admin = ($ifadmin2['admin']);  
}

if ($admin != 1) {
  header("Location: home");
  exit;
}
?> 

<!DOCTYPE html>
<html lang="en">  
<head>
<meta
  name="description"           
  content="A new generation social media
          network built for Privacy, Security
          and communication.">
<link rel="manifest" href="manifest.json" crossorigin="use-credentials">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" /> 
<meta name="HandheldFriendly" content="true"> 
<meta name="theme-color" content="#ff2449"/>
<link rel="apple-touch-icon" href="/icons/apple-icon-180.png">
<title><?php echo $lang_core_html_titles_language;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body> 
<?php 
include("api/internetalive.php");
?>
<div id='hider' class="wrapper hider">
    <?php include 'api/header.php';?>  
    <div class="main width-center">
        <div class="column" style=" width: 25% ; ">
          <div style="width:100%;max-width:350px; float:right;">
          </div>
        </div>
        <div class="column" style="width:50%">
         <div style="width:100%;max-width:1000px;display: block;margin-left: auto;margin-right: auto;">
            <h2>Admin Dashboard</h2>  
            <div class="row"> 
            </div>   
            
            <?php include('api/links.php'); ?>
            
          </div>
        </div>
        </div>  
        <div class="column" style="width:25%;">
        <div style="width:100%;max-width:350px; float:left;"> 
            </div> 
          </div>
        </div>
      </div>
    </div>
    </div> 
</div> 

<script type="text/javascript" src="api/mobilesupport"></script>  

</body>
</html>