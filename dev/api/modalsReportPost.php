
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<script>  

function closeModalReport() { 
  var modal = document.getElementById("postreported");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";

} 

</script> 
  
<div id="postreported" style="display:none;" class="modal">  
  <div class="modal-content internetOffline internetOfflineText" style="max-width:650px !important; "> 
    <h2>Success! 👍 </h2>  
    <p> Your reported the post. Thanks for making mypage a better place. </p>   
    <p> Learn more about our Community Guidelines <a href="about?rules">here</a>. </p>
    <center> <h3> <a onclick="closeModalReport()" > <input class="float" id="postbutton" name="submit" type="submit" value="Okay" /> </input> </a> </h3> </center> 
  </div> 
</div> 


<?php 

require('db.php');  
require('lang.php'); 
require('modals.php'); // for success

$sessionUserID = $_GET['userid'];
$postId = $_GET['postid'];
$name = $postId;

if (!is_numeric($sessionUserID)) {
  exit; 
}

if (!is_numeric($postId)) {
  exit; 
}

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 

$accountToken = $_GET['account_token'];   
   
if(preg_match("^[a-z0-9]+$", $accountToken) != false) { exit; }
  
$query = "SELECT `id` FROM `users` WHERE id='$sessionUserID' AND accountToken='$accountToken'";

$result = mysqli_query($con,$query) or die(mysqli_error($con)); 

$rows = mysqli_num_rows($result);  

if($rows!=1){  
  // wrong details
    exit;
} 

// ! AUTH CHECK // If false, then not the same person as AccountToken does not match Account ID 


$sql = $con->query("SELECT userid FROM posts WHERE id='$postId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $personId = ($row['userid']);
} 

$sql = $con->query("SELECT username FROM users WHERE id='$personId';") or die($con->error);   
while($row = mysqli_fetch_assoc($sql)) { 
  $firstnamePerson = ($row['username']);
} 

?>

<?php 
  
  $postmakersql = $con->query("SELECT userid FROM posts WHERE id = '$name';") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($postmakersql)) { 
    $POSTmaker = $rowNames['userid'];  
  } 
 

  $sqlReport = $con->query("SELECT username FROM users WHERE id = '$POSTmaker';") or die($con->error);    
  while($rowNames = mysqli_fetch_assoc($sqlReport)) { 
    $firstnameofReported = $rowNames['username'];  
  } 

  $sessionUserID = $sessionUserID;

  $_SESSION['firstnameofReported'] = $firstnameofReported; 

  echo '
  
  <script>  
  var modal = document.getElementById("reportPost");  
  modal.style.display = "none";
  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";


  function closeModal() { 
    var modal = document.getElementById("reportPost");  
    modal.style.display = "none";
    document.getElementById("body").style.overflow = "scroll";
    document.getElementById("body").style.overflowX = "hidden";
  } 

  </script> 
   
  <div id="reportPost" style="display:none;" class="modal">  
    <div id="reportPostBox" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
     <h2>Report an issue. </h2> 
  
     <p>Why are you reporting '. $firstnameofReported .'s post ? </p> 
     
    <label><input id="report1" type="radio" id="report" name="report" value="report" style="width:18px;
    height:18px; padding: 10px; " /> I am not interested </label> </input><br><br><br>

    <label><input id="report2" type="radio" id="report" name="report" value="hacked" style="width:18px;
    height:18px; padding: 10px; " /> Spam/Hacked </label> </input><br><br><br>

    <label><input id="report3" type="radio" id="report" name="report" value="pretend" style="width:18px;
    height:18px; padding: 10px; " /> Harmful / Harassment </label> </input><br><br><br>
 
    <label><input id="report4"  type="radio" id="report" name="report" value="harmful" style="width:18px;
    height:18px; padding: 10px; " /> Illegal Activity </label> </input> <br><br><br> 
 
    <label><input id="report5"  type="radio" id="report" name="report" value="hateful" style="width:18px;
    height:18px; padding: 10px; " /> Pretending to be me </label> </input> <br><br><br>

     <br> 

     <script>
 
     function reportPostajax() {
      
       var session_id = '.$sessionUserID.';
       var account_token = "'.$_COOKIE['accountToken'].'";
       var postid = '.$postId.'; 

       if(document.getElementById("report1").checked) {
          var report = "notinterest"; 
       }
    
       if(document.getElementById("report2").checked) {
        var report = "spamhack"; 
       }
  
       if(document.getElementById("report3").checked) {
        var report = "harmfulharass"; 
       }
  
       if(document.getElementById("report4").checked) {
        var report = "illegal"; 
       }
  
       if(document.getElementById("report5").checked) {
        var report = "pretending"; 
      }
     
       var data = {session_id, postid, account_token, report}; 
       
       $.ajax({ 
    
         type: "POST", 
         cache: false,
         data: data,
         url: "api/reportpost",  
         success: function(html) { 
        
          closeModal();
          
          var modal = document.getElementById("postreported"); 
          modal.style.display = "block";   

          document.getElementById("body").style.overflow = "hidden";

          document.getElementById("post'.$postId.'").style.display = "none";

        }
        
       }); 
    
     } 
    
    </script>


     <input onclick="reportPostajax(\'click\')" class="float" style="float:right; 
     
 
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
     width:110px;
     outline: none; 
     box-shadow: 0 0 12px #ff2449;
     
     
     " id="postbutton" value="Report" readonly/> </input>
     
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