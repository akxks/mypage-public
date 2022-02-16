
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('lang.php');  
?>
<style> 
#leftbox {
   float:left;  
   width:25%;  
} 
#middlebox {
   float:left;  
   width:50%;  
} 

#rightbox{
   float:right; 
   width:25%;  
} 
</style>   
</div> 
</div>
<div style="background-color:#ff2449;margin:-8px;-webkit-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);-moz-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);box-shadow: 0 6px 4px -4px rgba(0,0,0,0.465); ">
<div class=" " id="header" style = "
  padding-top: 1vh; background-image: linear-gradient(#ff3b5c, #de1641); display:block;height:72px;max-height:20vh;width: 100%;"> 
<div> 
   <div id = "leftbox">
      <button onclick="window.location='first';" style=" float:right; background-color: transparent;color:white;" class="dropbtn-home hoverAnimation"> <?php echo  $lang_header_new_signin;?></button> 
            <div class="dropdown" style="z-index:998;"> 
      <?php 
      if ($countnotifsExist == 0) {   
         echo '<div id="notificationsMobile" class="dropdown-content systemcolor-noborder" style="width: 230px;">' ; 
      }
      else {
         echo '<div id="notificationsMobile" class="dropdown-content systemcolor-noborder" style="width: 400px;">'  ;
      } 
      ?>  
   </div> 
   </div>  </div>  
   <div id = "middlebox">
      <img class="nodrag opacityHover" id="logo" src="image/logo.png" height= "auto;" width="125px;" style="
        text-align: center;
        display: block; margin-left: auto; margin-right: auto;  padding-top:10px !important; " alt="Logo"> </img> 
   </div>  
   </div>  
   <div id = "rightbox">
      <button onclick="window.location='first';" style=" float:left; background-color: transparent;color:white;" class="dropbtn-home hoverAnimation"> <?php echo $lang_header_new_signup?></button> 
      </div>  
   </div>
   </div> 
</div>
</div>
</div>    
