
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('lang.php');
?>
<script>
window.addEventListener('online',  updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus); 
var modal = document.getElementById("offline"); 
function updateOnlineStatus(event) {
  var condition = navigator.onLine ? "online" : "offline";
  if (condition == "offline") {
   // DISABLED BECAUSE OF PWA.
   modal.style.display = "none";
   //var audio = new Audio('../sound/offline.mp3');
   //audio.play();
  }
  if (condition == "online") {
   modal.style.display = "none"; 
  }
}
</script> 
 
<div id="offline" class="modal">  
  <div class="modal-content internetOffline internetOfflineText"> 
   <center> <h2><?php echo $lang_internetalive1;?></h2> </center>
   <center> <p><?php echo $lang_internetalive2;?></p> </center>
   <center> <p><?php echo $lang_internetalive3;?></p> </center>
  </div> 
</div> 

<style> 
.modal {
  display: none;
  position: fixed;
  z-index: 999; 
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.8);
}
.modal-content { 
  margin: auto;
  padding: 20px; 
  width: 35%;
  overflow: hidden;
  border-radius: 5px;
} 
</style>