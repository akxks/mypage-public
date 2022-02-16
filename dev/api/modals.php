
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
 
function reportPerson($name, $sessionUserID) {

  include 'db.php';

  $sqlReport = $con->query("SELECT username FROM users WHERE id = '$name';") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($sqlReport)) { 
    $firstnameofReported = $rowNames['username'];   
  } 

  $sessionUserID = $sessionUserID;

  $_SESSION['firstnameofReported'] = $firstnameofReported; 

  echo '
  
  <script>  
  var modal = document.getElementById("reportPerson");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";


  function closeModalReportPerson() { 
    var modal = document.getElementById("reportPerson");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";

  } 

  </script> 
   
  <div id="reportPerson" style="display:none;" class="modal">  
    <div id="reportPersonBox" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
     <h2>Report an issue. </h2> 

     <form name="reporting" action="api/reportperson?person='. $name .'" method="post">

     <p>Why are you reporting @'. $firstnameofReported .' ? </p> 
     
    <label><input class="me" type="radio" id="report" name="report" value="report" style="width:18px;
    height:18px; padding: 10px; " /> Spam account </label> </input><br><br><br>

    <label><input type="radio" id="report" name="report" value="hacked" style="width:18px;
    height:18px; padding: 10px; " /> Hacked account </label> </input><br><br><br>

    <label><input type="radio" id="report" name="report" value="pretend" style="width:18px;
    height:18px; padding: 10px; " /> Pretending to be me/someone </label> </input><br><br><br>
 
    <label><input type="radio" id="report" name="report" value="harmful" style="width:18px;
    height:18px; padding: 10px; " /> Harmful or abusive content </label> </input> <br><br><br>
 
    <label><input type="radio" id="report" name="report" value="hateful" style="width:18px;
    height:18px; padding: 10px; " /> Harrassment against individual or group </label> </input> <br><br><br>

     <br>  

     <input class="float" style="float:right;   position:relative;float:right;margin:0px;margin-bottom:0px !important;margin-left:20px;   padding: 10px 25px 8px;" id="postbutton" name="submitReport" type="submit" value="Report" /> </input>
     
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
     
     " id="postbutton" name=" " type=" " onclick="closeModalReportPerson()" value="Close" readonly/> </input>

    
    </form> 

   </a> 
    </div>   
  </div> 
  
  '; 
}

function sharePerson($name, $sessionUserID) {

  include 'db.php';

  $sqlReport = $con->query("SELECT username FROM users WHERE id = '$name';") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($sqlReport)) { 
    $firstnameofSharing = $rowNames['username'];  
  } 

  $sessionUserID = $sessionUserID;

  $_SESSION['firstnameofSharing'] = $firstnameofSharing; 

  echo '
  
  <script>  
  var modal = document.getElementById("sharePerson");  
  modal.style.display = "none"; 
  document.getElementById("body").style.overflow = "scroll"; 
  document.getElementById("body").style.overflowX = "hidden";

  function closeModal() { 
    var modal = document.getElementById("sharePerson");  

    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";
  } 

  </script> 


  <script>
  function setClipboard(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = "https://mypage.com/user/'.$firstnameofSharing.'";
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.getElementById("copyLinkButton").value = "Copied";
    document.body.removeChild(tempInput);
}
  </script>
   
  <div id="sharePerson" style="display:none;" class="modal">  
    <div id="sharePersonBox" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">   
     <h2>Share @'. $firstnameofSharing.'\'s profile </h2>  
    <p> Share @'. $firstnameofSharing.'\'s profile with others </p>
    <center>

    <input id="idInputLog" style="width:100% !important;  border-radius: 4px; 
    border: 1px solid #CCC;
    padding: 10px;
    color: #333;
    font-size: 14px;
    margin-top: 10px;outline-width: 0;" value="https://mypage.com/user/'.$firstnameofSharing.'" readonly/>
    
    </center> 

     <br>  
     
     <img id="copyLinkButton" onclick="setClipboard()" src="image/copy.svg" width="35px" height="auto" class="float" style="margin-top:3px;cursor: pointer; filter: brightness(6);">

     
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
     
     " id="postbutton" name=" " type=" " onclick="closeModal()" value="Close" readonly/> </input>

    
    </form> 

   </a> 
    </div>   
  </div> 
  
  '; 
}

function welcomePerson($getNameofInviter) {

  echo '
  <script>  
  var modal = document.getElementById("newuser");  
  modal.style.display = "block"; 
  document.getElementById("body").style.overflow = "hidden";
  document.getElementById("body").style.overflowX = "hidden";

  function closeModal() { 
    var modal = document.getElementById("newuser");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";
  } 

  </script> 
   
  <div id="newuser" style="display:block;" class="modal">  
    <div class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;"> 
    <h2>Welcome! 👋 </h2>
    <h3>You were invited by '. $getNameofInviter .' </h3> 
    <h4 style="float:left;">By pressing Okay you confirm that you have read the <a href="about?rules">Community Guidelines.<h4></a> 
    <h3> <a onclick="closeModal()" > <input class="float" id="postbutton" name="submit" type="submit" style="float:right;"value="Okay" /> </input> </a> </h3>
    </div> 
  </div> ';  

}

function successReport() {

  echo '
  <script>  
  var modal = document.getElementById("newuser");  
  modal.style.display = "block"; 
  document.getElementById("body").style.overflow = "hidden";
  document.getElementById("body").style.overflowX = "hidden";

  function closeModalreportuser() {  
    var modal = document.getElementById("newuser");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";

  } 

  </script> 
   
  <div id="newuser" style="display:block;" class="modal">  
    <div class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  "> 
     <h2>Success! 👍 </h2>  
     <p> We will review your report soon. </p>   
     <center> <h3> <a onclick="closeModalreportuser()" > <input class="float" id="postbutton" name="submit" type="submit"  onclick="closeModalreportuser()" value="Okay!" /> </input> </a> </h3> </center> 
    </div> 
  </div> ';  

  unset($_SESSION['reported']);

}


function successShare() {

  echo '
  <script>  
  var modal = document.getElementById("newuser");  
  modal.style.display = "block"; 
  document.getElementById("body").style.overflow = "hidden";

  function closeModal() { 
    var modal = document.getElementById("newuser");  
    modal.style.display = "none";
  } 

  </script> 
   
  <div id="newuser" style="display:block;" class="modal">  
    <div class="modal-content internetOffline internetOfflineText" style="max-width:650px !important; "> 
     <h2>Success! 👍 </h2>  
     <p> Your shared a post. </p>   
     <center> <h3> <a onclick="closeModal()" > <input class="float" id="postbutton" name="submit" type="submit" value="Okay" /> </input> </a> </h3> </center> 
    </div> 
  </div> ';  

  unset($_SESSION['shared']);

}
?>