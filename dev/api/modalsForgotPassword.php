
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->



<script>  

function closeModalReport() { 
  var modal = document.getElementById("resetps");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";

} 

</script> 
  
<div id="resetps" style="display:none;" class="modal">  
  <div class="modal-content internetOffline internetOfflineText" style="max-width:650px !important; ">  
     <h2>Success! ✉️ </h2>  
     <p> Check your email address for further password reset instructions. </p>   
    <center> <h3> <a onclick="closeModalReport()" > <input class="float" id="postbutton" name="submit" type="submit" value="Okay" /> </input> </a> </h3> </center> 
  </div> 
</div> 

<?php 
 
  echo '
  
  <script>  
  var modal = document.getElementById("forgotBox");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";


  function closeModal() { 
    var modal = document.getElementById("forgotBox");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";
  } 

  </script> 
   
  <div id="forgotBox" style="display:none;" class="modal">  
    <div id="forgotBoxModal" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
     <h2>Reset password 🔐</h2> 
  
     <p> To reset your password type your Email Address that is associated with your account, then press reset. An email should be sent to your email account, with further reset instructions. </p>


     <script>
 
     function resetPS() {
      
       var email = document.getElementById("psEmail").value;

       $.ajax({ 
    
         type: "POST", 
         cache: false,
         data: email,
         url: "api/resetPasswordFinal", 

         success: function(html) { 
        
          closeModal();
          
          var modal = document.getElementById("resetps"); 

          modal.style.display = "block"; 

          document.getElementById("body").style.overflow = "hidden";

          document.getElementById("forgotBox").style.display = "none";

        }
        
       }); 
    
     } 
    
    </script>


    <form class="resetform" action="" method="post" name="reste"> 

      <input id="psEmail" type="email" name="email" placeholder="Your Email" style="width:60% !important;" required />

    </form>
 
    <br>
    <br> 

     <input onclick="resetPS()" class="float" style="float:right; 
     
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
     width:100px;
     outline: none; 
     box-shadow: 0 0 12px #ff2449;
     
     
     " id="postbutton" value="Reset" readonly/> </input>
     
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
     width:100px;
     outline: none; 
     box-shadow: 0 0 12px #ff2449;  "
     
     " id="postbutton" name=" " type=" " onclick="closeModal()" value="Close" readonly> </input>

    
    </form> 

   </a> 
    </div>   
  </div> 
  
  '; 
 
?>