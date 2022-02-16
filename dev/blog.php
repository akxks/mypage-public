

<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<?php
require('api/db.php'); 
require('api/button.php'); 
require('api/lang.php'); 
session_start();
if(!isset($_SESSION["id"])){
  $_SESSION['id'] = 0; 
  $_SESSION['newuser'] = 1;
}
else {
  if($_SESSION['id'] !== 0) {
    unset($_SESSION['newuser']);
  }
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<body> 
  
<div id='hider' class="wrapper hider">
<?php  
    if (!isset($_SESSION['newuser'])) { 
      include 'api/header.php'; 
    }
    else {
      include 'api/headernew.php';
    }
    ?> 
    </div>
    <script> 
      $(document).ready(function(){ 
        $(window).scroll(function() {
          var top_of_element = $("#showMore").offset().top;
          var bottom_of_element = $("#showMore").offset().top + $("#showMore").outerHeight();
          var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
          var top_of_screen = $(window).scrollTop();

          if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){ 
             // console.log('invisible');
          } else { 
             // console.log('visible');
              var bottom = 1; 
          }  
        if( bottom == 1 ){ 
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        var rowperpage = 3;
        row = row + rowperpage; 
        var type = "notFirstLoad"; 
        if(row <= allcount){
          $('#row').val(row);
          $.ajax({
          url: 'api/fetchblog',
          type: 'post',
          data: {row:row, type:type},
          success: function(response){ 
            $(".post:last").after(response).show().fadeIn(2900); 
          }
          });
        }
        }  
      }); 
      }); 
    </script> 

    <div class="main width-center">
        <div id="hideSmallerScreen" class="column" style=" width: 25% ; ">
          <div style="width:100%;max-width:350px; float:right;">
          </div>
        </div>
        <div id="hideSmallerScreenMain" class="column" style="width:50%">
         <div style="width:100%;max-width:700px;display: block;margin-left: auto;margin-right: auto;">
         <div id='showMore' style='background-color:transparent;'> </div>
            <h2>Blog</h2>  
                <?php require("api/fetchblog.php"); ?> 
                <input type="hidden" id="row" value="0">
                <input type="hidden" id="all" value="<?php echo $allcount; ?>">  
                <?php 
                        
                  $allcount_query = "SELECT count(*) as allcount FROM blogPosts";
                  $allcount_result = mysqli_query($con,$allcount_query);
                  $allcount_fetch = mysqli_fetch_array($allcount_result);
                  $allcount = $allcount_fetch['allcount'];

                  if ($allcount != 0) {
                    if (isset($_SESSION['newuser'])) { echo '<center> <p> ☁️ View more blog posts by logging in </p> </center>'; } 
                  }
                     
                ?>
            <p style="text-decoration:none;color:gray;font-size:15px;">   <?php include('api/links.php'); ?>  </p>  
          </div>
      </div>
    </div>  
</div>
<script type="text/javascript" src="api/mobilesupport"></script>  
</body>
</html>