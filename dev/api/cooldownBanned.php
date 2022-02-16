
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 

  echo '
  
  <script>  
  var modal = document.getElementById("bannedBox");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";


  function closeModal() { 
    var modal = document.getElementById("bannedBox");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";
  } 

  </script> 
   
  <div id="bannedBox" style="display:none;" class="modal">  
    <div id="bannedBoxModal" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
     <h2> Account Banned </h2> 
  
     <p> Your account has been banned for violating our <a href="about?rules"> Community Guidelines. </a> </p>

     <p> Take a look at our <a href="support"> help centre</a> for more information. If you feel like this was a mistake, you may request an appeal by contacting <a href="support"> support. </a> </p>

     <hr>
     <p>  </p>


    <br>
    <br> 

    
     <input class="float"style="
 
     position:relative;float:right;margin:0px;margin-bottom:0px !important;margin-left:20px;   padding: 10px 25px 8px;
     color: #fff;
     background-color: #ff2449;
     text-shadow: rgba(0,0,0,0.24) 0 1px 0;
     font-size: 16px; 
     border: 2px solid #ff2449;
     box-shadow: 0 4px 16px 0 rgba(0,0,0,0.2);
     border-radius: 3px;
     margin-top: 0px;
     cursor:pointer; 
     width:95px;
     outline: none; 
     box-shadow: 0 0 12px #ff2449;  "
     
     " id="postbutton" name=" " type=" " onclick="closeModal()" value="Okay" readonly> </input>

    
    </form> 

   </a> 
    </div>   
  </div> 
  
  '; 
 
?>