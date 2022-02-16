
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
include("api/auth.php");
include("api/button.php");
include("api/lang.php");
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
<title><?php echo $lang_core_html_titles_search;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body> 
<div id='hider' class="wrapper hider">
    <?php include 'api/header.php';?>  
    <div class="main width-center">
        <div class="column" style=" width: 25% ; ">
          <div style="width:100%;max-width:350px; float:right;">
          </div>
        </div>
        <div id="hideSmallerScreenMain" class="column" style="width:50%">
         <div style="width:100%;max-width:1000px;display: block;margin-left: auto;margin-right: auto;"> 
            <h2><?php echo $lang_core_searchpage_search; ?></h2>  
            <div class="row"> 
            <div class='card-no-hover systemcolor' style='margin-top:20px; margin-bottom:20px;border: 10px solid transparent !important; padding-bottom: 5px !important;border-radius: 5px;'> 
            <?php include 'api/search.php'; 
 
            if (isset($_GET['q'])) {
            
              echo '<input style="outline:none;font-size:17px;width:100%; background-color:transparent;color:white;outline:none;border:none;" type="text" id="search" value="'. $_GET['q'] .'" placeholder=" 🔍 Search '. $formattedNum - 1 .' users" autocomplete="off"/>  
              '; 

            } 

            else {
              echo '<input style="outline:none;font-size:17px;width:100%; background-color:transparent;color:white;outline:none;border:none;" type="text" id="search" placeholder=" 🔍 Search '. $formattedNum - 1 .' users" autocomplete="off"/>  
              '; 
            }
 
            echo ' <div class="search-container smallsearchformobile" style = "margin-top:2px; margin-top: 20px; position: absolute; display:block;  width: 400px; margin-left:-10px;"  >  
            <div id="mySearch" class="search-content systemcolor-noborder smallsearchformobile" style="width: 400px; max-height: auto;  "> 
           
            <div id="display"> </div>  
            </div> 
            </div>   
            '; 
            

            ?>
            </div> 

            <?php 
            if (isset($_GET['q'])) {
              
              echo " 
              <div class='card-no-hover systemcolor' style='margin-top:20px;margin-bottom:20px;border: 35px solid transparent; border-radius: 5px;'> 
              
              </div>  
              ";

            }
            ?>

            </div>   
            <p id="hide600" style="text-decoration:none;color:gray;font-size:15px;">   <?php include('api/links.php'); ?>  </p>  
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
    <div class='footermargin'> <div class='footermargin'> <div class='footermargin'>  <?php include 'api/mobilefooter.php';  ?> </div>
</div> 
<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>