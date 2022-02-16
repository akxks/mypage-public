
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<?php 
require('lang.php');  
?>
<style> 
.atsign {
    background-color: green;
    color: #FFFFFF;
    padding: 0px 2px;
}
</style> 
 
<div id='tooMuch'> </div>

<form action="" method="post" name="sendpost" enctype="multipart/form-data"> 
<textarea id="postText" spellcheck="true" autocomplete="off" type="posttext" maxlength="500" name="posttext" class="form-control" rows="2" onkeydown="autoGrow(this);" placeholder="<?php echo $lang_post_whatwouldulike;?><?php if(preg_match("/[a-z]/i", $_SESSION['firstname'])){ echo $_SESSION['firstname']; } else { echo $_SESSION['username']; }  ?>?" ></textarea>
     <div style="border: 3px solid transparent;"> </div>
    <div> 
        <input class="float" style=" position:relative;float:right;margin:0px;margin-bottom:20px !important;margin-left:20px;" id="postbutton" name="submit" type="submit" onclick="cooldown()" value="Post" /> 
        <!-- <button style="float:right; font-size:28px;border:none;background-color:transparent;cursor:pointer;" class="float">💰</button> -->
        <label class="postCounterColor" id="counterPost" style="display:none;float:right; margin-right:20px;" ><span id="current">0</span> <span id="maximum">/ 500</span></label>
        <label style="padding: 11px !important;margin-top:0px !important; cursor: pointer;" class='float' for="fileToUpload"><?php echo $lang_post_upload;?></label> 
        <textarea id="hide600" spellcheck="false" autocomplete="off" type="locationtext" maxlength="23" name="locationtext" class="form-control" style=" width:110px;float:left;padding:5px;margin-left:5px; line-height:30px;" rows="1" placeholder="🌍" ></textarea>
        <input type="file" name="fileToUpload" id="fileToUpload" style="opacity: 0 !important;  padding:0px !important;  margin: 0px !important;" > 
        <p class="file-name"  ></p>
        
    </div>
</form>

<?php  
require('db.php');   
if(!isset($_SESSION["id"])){
	exit;
}
$fileupload = 0;

if (isset($_SESSION['lastTryUpload'])) {

    $date1 = (DateTime::createFromFormat('Y-m-d H:i:s', ($_SESSION['lastTryUpload'])));  
    $date2 = new DateTime(date("Y-m-d H:i:s"));

    $interval = $date1->diff($date2); 

    // echo $interval->s.' seconds<br>';

    var_dump($interval->s);
    if ($interval->s > 60) {

        unset ($_SESSION['lastTryUpload']);
        $dontTryUpload = 0;
        unset ($_SESSION['postsUploaded']);

    }

    if ($dontTryUpload == 1) {


        echo '
  
        <script>  
        var modal = document.getElementById("cooldownBoxPost");  
        modal.style.display = "none";
        document.getElementById("body").style.overflow = "scroll";
        document.getElementById("body").style.overflowX = "hidden";
      
      
        function closeModal() { 
          var modal = document.getElementById("cooldownBoxPost");  
          modal.style.display = "none";
          document.getElementById("body").style.overflow = "scroll";
          document.getElementById("body").style.overflowX = "hidden";
        } 
      
        </script> 
         
        <div id="cooldownBoxPost" style="display:none;" class="modal">  
          <div id="cooldownBoxModalPost" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
           <h2> Slow Down 🦥 </h2> 
        
           <p> You are posting too fast. Try again in a minute. </p>
      
           <p> </p>
       
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

        echo '
        
        <script> 
         
            var modal = document.getElementById("cooldownBoxPost");  
            modal.style.display = "block"; 

            var modal = document.getElementById("cooldownBoxModalPost");  
            modal.classList.add("push") ;

            document.getElementById("body").style.overflow = "hidden";
          
        </script> 

        ';

    }

}

if ($_SESSION['postsUploaded'] > 7) {
 
    $dontTryUpload = 1;
  
  }

  if (isset($_POST['submit'])) {   

    $_SESSION['postsUploaded'] = $_SESSION['postsUploaded'] + 1;
  
    if (isset($_SESSION['postsUploaded'])) {
   
      if ($_SESSION['postsUploaded'] > 7) {
  

        echo '
  
        <script>  
        var modal = document.getElementById("cooldownBoxPost");  
        modal.style.display = "none";
        document.getElementById("body").style.overflow = "scroll";
        document.getElementById("body").style.overflowX = "hidden";
      
      
        function closeModal() { 
          var modal = document.getElementById("cooldownBoxPost");  
          modal.style.display = "none";
          document.getElementById("body").style.overflow = "scroll";
          document.getElementById("body").style.overflowX = "hidden";
        } 
      
        </script> 
         
        <div id="cooldownBoxPost" style="display:none;" class="modal">  
          <div id="cooldownBoxModalPost" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important;  ">  
           <h2> Slow Down 🦥 </h2> 
        
           <p> You are posting too fast. Try again in a minute. </p>
      
           <p> </p>
       
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

        echo '
        
        <script> 
         
            var modal = document.getElementById("cooldownBoxPost");  
            modal.style.display = "block"; 

            var modal = document.getElementById("cooldownBoxModalPost");  
            modal.classList.add("push") ;

            document.getElementById("body").style.overflow = "hidden";
          
        </script> 

        ';
        
        $dontTryUpload = 1;
  
        $_SESSION['lastTryUpload'] = date("Y-m-d H:i:s");
        
        // $_SERVER['REMOTE_ADDR'];
  
      }
  
    }
  

    if (!isset($dontTryUpload)) {

        if (isset($_POST['submit'])) {   
            if (basename($_FILES["fileToUpload"]["size"] > 30000000)) { 
                echo 'Sorry, the file you uploaded is too big! ';
            } 
            else {
                $target_file = "user-content/profile/" . (bin2hex(random_bytes(120))) . ".png";
                
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
                // Check file size 
        
                $filetype = 0;
        
                // Check if file already exists
                // if (file_exists($target_file)) { 
                // $uploadOk = 0;
                // }
        
                // Allow certain file formats
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "webm" || $imageFileType == "bmp" || $imageFileType == "webp" || $imageFileType == "jpeg" || $imageFileType == "gif" || $imageFileType == "tiff" || $imageFileType == "mp4" || $imageFileType == "mov" || $imageFileType == "mpeg-4"  || $imageFileType == "mp3" || $imageFileType == "wmv" || $imageFileType == "avi" || $imageFileType == "flv" || $imageFileType == "m4v" || $imageFileType == "3gp") {  
                    $uploadOk = 1;  
                }  
                else {
                    $uploadOk = 0;
                }
                if($imageFileType == "mp4" || $imageFileType == "mov" || $imageFileType == "mpeg-4"  || $imageFileType == "mp3" || $imageFileType == "wmv" || $imageFileType == "avi" || $imageFileType == "flv" || $imageFileType == "m4v" || $imageFileType == "3gp") {
                    $filetype = 1;
                } 
        
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    if ($_FILES["fileToUpload"]["size"] != 0) {
                        echo "Sorry, your file was not uploaded.";
                    } 
                // if everything is ok, try to upload file
                } 
                else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    $fileupload = 1;
                    $userid = $_SESSION['id']; 
                    $userid = mysqli_real_escape_string($con,$userid);   
                    $likes = 0;
                    $comments = 0;
                    $shares = 0;
                    $dislikes= 0;
                    $post = stripslashes($_REQUEST['posttext']); 
                    if (isset($_REQUEST['locationtext'])) {
                        $locationtext = stripslashes($_REQUEST['locationtext']); 
                    } 
                    else {
                        $locationtext = NULL;
                    }
                    $state = 'Public';
    
                    $postURI = $target_file;
                    $create_date = date("Y-m-d H:i:s"); 
                    
                    if ($filetype == 0) {
                        $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
                        VALUES ('$userid', '0', '$postURI', '$likes', '$comments', '$shares', '$dislikes', '$post','$state', '$create_date', '$locationtext', 0, 0)";
                        $result = mysqli_query($con,$query);  
                    }
                    else {
                        $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
                        VALUES ('$userid', '3', '$postURI', '$likes', '$comments', '$shares', '$dislikes', '$post', '$state', '$create_date', '$locationtext', 0, 0)";
                        $result = mysqli_query($con,$query);  
                    } 
         
                    $sqlSCORE = $con->query("SELECT score FROM users WHERE id = '$userid';" ) or die($con->error);  
                    $scoreinfo = array(); 
                    while($row = mysqli_fetch_assoc($sqlSCORE)) {
                    $scoreinfo[] = array (array("Score",$row['score'])); } 
                    $no = ($scoreinfo[0][0][1] + 2);
                    $con->query("UPDATE users SET score = $no WHERE id = '$userid';") or die($con->error); 
    
                    if (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) {
    
     
                        $usernameReqe = $con->query("SELECT username FROM users WHERE id='$userid';") or die($con->error);    
                        while($row = mysqli_fetch_assoc($usernameReqe)) { 
                        $requestedUsername = ($row['username']);
                        } 
    
    
                        header("Location:profile?u=$requestedUsername"); 
                    } 
                    else {
                        header('Location:home');
                    } 
        
                } else {
                  //  echo "Sorry, there was an error uploading your file.";
                }
                } 
            } 
        if (isset($_SESSION['email'])){ 
            if ((strlen($_REQUEST['posttext'])) < 2) {
            }  
            else {
                if (strlen(trim($_REQUEST['posttext'])) == 0) {
                }
                else {
                    if ($fileupload != 1) { 
    
                        $userid = $_SESSION['id'];  
    
                        $username = $con->query("SELECT username FROM users WHERE id='$userid';") or die($con->error);    
                        while($row = mysqli_fetch_assoc($username)) { 
                          $usernameId = ($row['username']);
                        } 
    
                        $sqlSCORE = $con->query("SELECT score FROM users WHERE id = '$userid';" ) or die($con->error);  
                        $scoreinfo = array(); 
                        while($row = mysqli_fetch_assoc($sqlSCORE)) {
                        $scoreinfo[] = array (array("Score",$row['score'])); } 
                        $no = ($scoreinfo[0][0][1] + 2);
                        $con->query("UPDATE users SET score = $no WHERE id = '$userid';") or die($con->error); 
                    
                        $userid = mysqli_real_escape_string($con,$userid);   
                        $likes = 0;
                        $comments = 0;
                        $shares = 0;
                        $dislikes = 0;
                        $post = stripslashes($_REQUEST['posttext']);
                        $state = 'Public';
                        $post = htmlspecialchars($post);
                        $post = mysqli_real_escape_string($con,$post);
                        if (isset($_REQUEST['locationtext'])) {
                            $locationtext = stripslashes($_REQUEST['locationtext']); 
                        } 
                        else {
                            $locationtext = NULL;
                        }
                        $create_date = date("Y-m-d H:i:s"); 
                        $query = "INSERT into `posts` (userid, type, imgurl, likes, comments, shares, dislikes, post, state, create_date, location, isShare, sharePostId)
                        VALUES ('$userid', '1', ' ', '$likes', '$comments', '$shares', '$dislikes', '$post', '$state', '$create_date', '$locationtext', 0, 0)";
                        $result = mysqli_query($con,$query); 
    
                        $usernameReqe = $con->query("SELECT username FROM users WHERE id='$userid';") or die($con->error);    
                        while($row = mysqli_fetch_assoc($usernameReqe)) { 
                        $requestedUsername = ($row['username']);
                        } 
    
                        if (str_contains($post, "@")) {
      
                            $at = substr($post, strpos($post, "@") + 1);   
                             
                            if (str_contains($at, ' ')) {
    
                                $arr = explode(' ',trim($at));
    
                                $at = $arr[0];
                                
                            }
    
                            
                            $reqid = $con->query("SELECT id FROM users WHERE username='$at';") or die($con->error);    
                            while($row = mysqli_fetch_assoc($reqid)) { 
                              $requestedid = ($row['id']);
                            } 
                            
    
                            if (isset($requestedid)) {
    
                                if ($requestedid != $sessionUserID) {
    
                                    $notif = "" . $usernameId . " has mentioned you in their post ";
    
                                
                                    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($requestedid,'Mentions','$notif','0',NOW());" ) or die($con->error);
            
                                }
    
                            }
       
                        }
    
                        if (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) {
                            header("Location:profile?u=$requestedUsername"); 
                        } 
                        else {
                            header("Location:home");
                            
                        } 
                    }
                }
                } 
            }  
    }else{ 
    }  

    }

  }


?> 


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script> 
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

$("#postText").keyup(function() { 
    var characterCount = $(this).val().length,
        current = $('#current'),
        maximum = $('#maximum'),
        theCount = $('#the-count');
    current.text(characterCount); 
    document.getElementById("counterPost").style.display = "none";
    if (characterCount >= 400) {
    document.getElementById("counterPost").style.display = "block";
    maximum.css('color', '#ff4040');
    current.css('color', '#ff4040');
    theCount.css('font-weight','bold');
  } else { 
    theCount.css('font-weight','normal');
  } 
  });
  

const file = document.querySelector('#fileToUpload');
    file.addEventListener('change', (e) => { 
    const [file] = e.target.files; 
    const { name: fileName, size } = file; 
    const fileSize = (size / 1000000).toFixed(3); 
    if (fileSize > 50) { 
        const fileNameAndSize = `${fileName} - ${fileSize}MB ✖ `;
        document.querySelector('.file-name').textContent = fileNameAndSize;
    } else { 
        const fileNameAndSize = `${fileName} - ${fileSize}MB ✔`;
        document.querySelector('.file-name').textContent = fileNameAndSize;
    } 
}); 
</script> 