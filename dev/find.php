
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
include("api/auth.php");
include("api/button.php");
require('api/lang.php'); 
?>

<style>
#mydiv {
  position: absolute;
  cursor: move; 
  z-index: 9;   
}
 
</style>

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
<title><?php echo $lang_core_html_titles_friends;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head> 
<body> 
<?php
include('api/internetalive.php');
?>
<div id='hider' class="wrapper hider">
<?php include 'api/header.php';?>  
<div class="main width-center">
    <div class="column" style=" width: 20% ; "> </div>
    <div id="hideSmallerScreenMain" class="column" style="width:60%">
    <div class="column" style=" width: 25% ; "> 
    
          
    <div class="row" id="hide600">  
    <?php //include //'api/fetchfriendsfind.php';?>  
    </div>   
    
    </div>
      <div id="hideSmallerScreenMain" class="column" style="width:50%">
        <div style="width:100%; display: block;margin-left: auto;margin-right: auto;"> 

        <h2>Find </h2>   
        <div class="row">

        <div id="mydiv" class="card-no-hover systemcolor" style="height:auto; width: 350px; ">   
        <center> <img class="float nodrag imageshadow" src="image/default.jpeg" style="width:115px;height:115px;border-radius:50%;"> </img> </center>
        <center> 
        
        <h2> Adrian Koszpek <img class="float nodrag" src="image/verified.png" height= "auto;" width="30px;" style=" " alt="Verified Sticker"> </h2>
        </center> 
        <p> " 17. Change your thoughts, and you change the world. " </p>
        <hr> 
                <p> 
                
        💭 Joined 2021-04-13 <br> <br> 

        🎁 Birthday 2003-09-28<br> <br> 

        🌎 Test <br> <br> 

        🔒 Private account<br> <br> 

        🎶 Mr.Kitty - After Dark<br> <br> 

        💯 59,222,436<br>  
        
        </div>  


        <?php //include //'api/fetchfriendsfind.php';?>  
        </div>   
 
 
         </div>
      </div></div>
      <div class="column" style="width:25%;"> 
      
      <div class="row"id="hide600">
       
      <?php //include //'api/fetchfriendsfind.php';?>  
      </div>   
      
      </div>  
    </div>  
    <div class="column" style="width:20%;"> </div>  
</div> 
</div>  

  
<script>
//Make the DIV element draggagle:
dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>

<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>