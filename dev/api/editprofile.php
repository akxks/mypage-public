
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->


<style>
.circle-grid {  

  float:left; 
  display: grid;
  place-items: center; 
  grid-template-rows: repeat(10, 1fr);
  grid-template-columns: repeat(10, 1fr); 
  width: min(100vmin, 141px);
  height: min(100vmin, 145px);
  
  margin:-22px;
  margin-left:3px;
  margin-top: 12px; 
}

.circle-grid img {
  grid-column: 3 / span 5;
  grid-row: 3 / span 5;
  place-self: center;
  margin-bottom:18px;
  width: 88px; 
  height: 88px;
  
  border-radius: 50%; 
}

.circle-grid div {
  height: 100%;
  width: 100%;
  border-radius: 50%; 
}

.circle-grid div:where(:nth-of-type(1), :nth-of-type(3)){
  grid-row: 2;
}

.circle-grid div:first-of-type {
  grid-column: 2; 
}

.circle-grid div:nth-of-type(2){
  grid-column: 5;
}

.circle-grid div:nth-of-type(3) {
  grid-column: 8;
}

.circle-grid div:where(:nth-of-type(4), :nth-of-type(5)){
  grid-row: 5;
}

.circle-grid div:nth-of-type(5){
  grid-column: 9;
}

.circle-grid div:nth-last-of-type(-n+2){
  grid-row: 8;
}

.circle-grid div:nth-last-of-type(2){
  grid-column: 3;
}

.circle-grid div:last-of-type{
  grid-column: 7;
}
</style>

<?php 
require('db.php');  
if(!isset($_SESSION["id"])) { exit; } 
$sessionUserID = $_SESSION['id']; 
echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:30px;margin-bottom:100px;'>";   
 
  echo "<div class='systemcolor-Noborder' style='padding:10px;padding-bottom:0px;padding-top:0px;width:100%;'>";   
  echo "<div> <p style='margin:-10px !important;padding:0px !important;font-size:18px;'> ";  

 $contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$sessionUserID'") or die($con->error); 
 while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 

  $sql = $con->query("SELECT id,firstname,lastname,bio,create_date,verified,private,birthday,score,location,relationshipId,song,emojistyle,username FROM users WHERE id = '$sessionUserID';" ) or die($con->error);  
  $info = array();
  
  while($row = mysqli_fetch_assoc($sql)) {
     $info[] = array (
        array("UserId",$row['id']),
        array("Firstname",$row['firstname']),
        array("Lastname",$row['lastname']),
        array("Bio",$row['bio']), 
        array("CreateDate",$row['create_date']),
        array("Verified",$row['verified']),
        array("Private",$row['private']),
        array("Birthday",$row['birthday']),
        array("Score",$row['score']),
        array("Location",$row['location']),
        array("Relationshipid",$row['relationshipId']),
        array("Song",$row['song']),
        array("Emojistyle",$row['emojistyle']),
        array("Username",$row['username'])
      ); 
  }  
?>

<div style='float:left;height:50px;margin-bottom:35px !important;  '> 

<?php 
$contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$sessionUserID'") or die($con->error); 
while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; } 

$emojiStyle = $con->query("SELECT emojistyle FROM users WHERE id = '$sessionUserID'") or die($con->error); 
while($rowsID = mysqli_fetch_assoc($emojiStyle)) { $emojiStyleEmoji = $rowsID['emojistyle']; } 
?>  

<div class="circle-grid">
<?php  $emojiRound = $emojiStyleEmoji; ?>

<img class="imageshadow float nodrag" src="<?php echo $contenturlimg; ?> " height= "90px;" width="90px;" style="display:block;float:left; border-radius:50%; margin: -35px; " alt="Profile Picture">

    <div style="  transform: rotate(20deg); font-size:18px; "><?php echo $emojiRound; ?></div> 
    <div style=" margin-top: -15px;transform: rotate(29deg); font-size:17px; ">  </div>  
    <div style=" margin-right: 5px; transform: rotate(-50deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
    <div style=" transform: rotate(-17deg); font-size:16px; "><?php echo $emojiRound; ?></div> 
    <div style=" margin-right: 15px; transform: rotate(28deg); font-size:19px; "><?php echo $emojiRound; ?></div> 
    <div style=" margin-bottom: 15px; transform: rotate(-71deg); font-size:20px; "><?php echo $emojiRound; ?></div> 
    <div style=" transform: rotate(22deg); font-size:16px; ">  </div> 
</div>  


<?php unset($contenturlimg); ?> 

</div>


<form action="" method="post" name="editProfileData" enctype="multipart/form-data"> 

<div class="column " style="float:right; max-width:400px;">
<div class="form" style="padding-top: 20px; width:100%; "> 


<?php if (isset($_GET['success'])) { echo ' ✅ Your profile was updated! '; } ?>
<?php if (isset($_GET['error'])) { echo ' ❌ Your profile was not updated! '; } ?>
<?php if (isset($_GET['cooldown'])) { 
  
  
  echo ' ❌ Your profile was not updated, you are going too fast! '; 
  

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
  
     <p> You are editing your profile too many times. Try again in a minute. </p>

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
  
  } ?>


<h2> Your information </h2>
<?php 

if ($info[0][6][1] != 1) {
    echo '<p> Your information is visible to anyone. Set your account to private in settings, if you want to limit the amount of information about you. </p> ';
}
else {
    echo '<p> Your information is only visible to people who are on your friends list, except your name and bio. 🔒 </p> ';
}

?>

<div style='border:0px solid red;'> 
 
    <label style="width:100%;opacity:0.6; ">😄 Username <br> <input style="margin-right:20px; width:100%; outline-width: 0;" type="name" name="firstname" placeholder="Username" value="@<?php echo $info[0][13][1]; ?>" readonly /> </label>  
  
    <label style="width:100%;">😄 First Name <br> <input style="margin-right:20px; width:100%; "  type="name" name="firstname" placeholder="Firstname" value="<?php echo $info[0][1][1]; ?>" required /> </label>  
  
    <label style="width:100%;">😄 Last Name <br> <input style="margin-right:20px;width:100%;  " type="name" name="lastname" placeholder="Lastname" value="<?php echo $info[0][2][1]; ?>" required /> </label>   
 
    <label style="width:100%;">⚙️ Bio  <br> <input style="margin-right:20px; width:100%; " type="name" name="bio" placeholder="Bio" value="<?php echo $info[0][3][1]; ?>" /> </label>         
  
    <label style="width:100%;">🦋 Profile Style  <br> <input maxlength="2" style="margin-right:20px; width:100%; " type="name" name="profilestyle" placeholder="Profile Style Emoji" value="<?php echo $info[0][12][1]; ?>"/> </label>         
 
    <label style="width:100%;">🎶 Favourite Song  <br> <input style="margin-right:20px; width:100%; " type="name" name="favsong" placeholder="Name of your favourite song" value="<?php echo $info[0][11][1]; ?>"/> </label>   
    <?php 
      if ($info[0][7][1] != "0000-00-00 00:00:00") { 
        $bday = $info[0][7][1]; 
      }
      else {
        $bday = '';
      }
    ?>
    <label style="width:100%;">🎁 Birthday  <br> <input style="margin-right:20px; width:100%;  " type="name" name="birthday" placeholder="Birthday" value="<?php echo $bday; ?>" /> </label>  

    <label style="width:100%;">🌎 Location  <br> <input style="margin-right:20px;width:100%;  " type="name" name="loc" placeholder="Location" value="<?php echo $info[0][9][1]; ?>" /> </label>     

</form> 

<?php 
echo "<div class=' ' style='border-radius:6px;  float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:0px;margin-bottom:-60px;'>";   
echo "<div class='systemcolor-Noborder' style='padding:0px;padding-bottom:0px;padding-top:0px;width:100%;'>";   
echo "<div> <p style='margin:-20px !important;padding:0px !important;font-size:18px;'> ";  
?>


<?php list($one, $two) = explode(" ", $info[0][4][1], 2);?> 
<?php  

echo '<br>';
echo '<br>';
echo "<p style='padding-top:-20px;opacity:0.6;'> ".$lang_get_profile_joined."" . $one . " </p> "; 
if (isset($onebday)) {
echo ' <p style="padding-top:-20px;opacity:0.6;"> '.$emoji.' '.$lang_get_profile_birthday.' '. $onebday .' </p>';
}

if ($info[0][6][1] == 1) {
echo ' <p style="padding-top:-20px;opacity:0.6;"> '.$lang_get_profile_privateaccount.'</p>';
}  

if ($info[0][5][1] == 1) {
echo ' <p style="padding-top:-20px;opacity:0.6;"> 💖 Verified account </p>';
}  
if (isset($info[0][10][1])) { 
// if they in relationship with you 
if ($info[0][10][1] != -1) {
    if ($info[0][10][1] == $sessionUserID) { 
    echo ' <p style="padding-top:-20px;opacity:0.6;"> ❤️ You </p>';
    }
    else {  
    $relId = $info[0][10][1]; 
    $sqlNames = $con->query("SELECT firstname, lastname FROM users WHERE id = '$relId';" ) or die($con->error);    
    while($rowNames = mysqli_fetch_assoc($sqlNames)) {   
        $names[] = array (
            array($rowNames['firstname']),
            array($rowNames['lastname']) 
        ); 
    } 
    echo ' <p style="padding-top:-20px;opacity:0.6;"> ❤️ '. $names[0][0][0], " " .$names[0][1][0].  ' </p>'; 
    unset($names);
    }
} 
}  
$num = $info[0][8][1];   

echo "<p style='padding-top:-20px;opacity:0.6;'> 💯 ". number_format($num) . " </p> ";  

?>
 
<input class="float" style=" position:relative; margin:0px;margin-bottom:20px !important;margin-right:20px; float:right;" id="postbutton" name="submit" type="submit" onclick="cooldown()" value="Save" /> 
<label style="padding: 11px !important;margin-top:0px !important; cursor: pointer;" class='float' for="fileToUpload"><?php echo $lang_post_upload;?></label>  
<input type="file" name="fileToUpload" id="fileToUpload" style="opacity: 0 !important;  padding:0px !important;  margin: 0px !important;" > 
<p class="file-name"  ></p>

</div>
</div>
</div>
</div> 
</div>

<?php 

echo " <br> </form> </p> </div>"; 
echo '</div> </a>';
echo '</div>';  
?> 
 
<?php 
require('lang.php');  
?>

<?php 
require('db.php');   
if(!isset($_SESSION["id"])){
	exit;
}
$fileupload = 0;


if ($_SESSION['uploadTriesPfp'] > 4) {

  $dontTryUploadpfp = 1;

} 

if (isset($_POST['submit'])) {   



  $_SESSION['uploadTriesPfp'] = $_SESSION['uploadTriesPfp'] + 1;

  if (isset($_SESSION['uploadTriesPfp'])) {
 
    if ($_SESSION['uploadTriesPfp'] > 6) {

      echo '
      
      <script> 
      
      document.getElementById("idInputButtonCentered").style.display = "none";

      </script>';
      
      $dontTryUploadpfp = 1;

      $_SESSION['lastTryUploadPfp'] = date("Y-m-d H:i:s");
      
      // $_SERVER['REMOTE_ADDR'];

    }

  }


  if (!isset($dontTryUploadpfp)) {
 
        $firstname = stripslashes($_REQUEST['firstname']); 
        $firstname = htmlspecialchars($firstname);
        $firstname = mysqli_real_escape_string($con,$firstname); 
        $firstname = strtolower($firstname);
        $firstname = ucfirst($firstname);

        $firstname = preg_replace('/\s+/', '', $firstname); // to remove whitespaces including tabs and line ends  
        $firstname = preg_replace('~\x{00a0}~','',$firstname); // to remove  non-breaking spaces
        $firstname = preg_replace("/[^a-zA-Z0-9\ ]+/", "", $firstname); // remove everything except a-z A-Z and 0-9

        $lastname = stripslashes($_REQUEST['lastname']); 
        $lastname = strtolower($lastname);
        $lastname = ucfirst($lastname);
        $lastname = htmlspecialchars($lastname);
        $lastname = mysqli_real_escape_string($con,$lastname);   

        $lastname = preg_replace('/\s+/', '', $lastname); // to remove whitespaces including tabs and line ends 
        $lastname = preg_replace('~\x{00a0}~','',$lastname); // to remove  non-breaking spaces
        $lastname = preg_replace("/[^a-zA-Z0-9\ ]+/", "", $lastname); // remove everything except a-z A-Z and 0-9

        $birthday = stripslashes($_REQUEST['birthday']); 
        $birthday = mysqli_real_escape_string($con,$birthday);   
        $birthday = htmlspecialchars($birthday);

        $location = stripslashes($_REQUEST['loc']); 
        $location = mysqli_real_escape_string($con,$location);   
        $location = htmlspecialchars($location);
        $location = preg_replace("/[^a-zA-Z0-9\ ]+/", "", $location); // remove everything except a-z A-Z and 0-9

        $emojistyle = stripslashes($_REQUEST['profilestyle']); 
        $emojistyle = mysqli_real_escape_string($con,$emojistyle);   
        $emojistyle = htmlspecialchars($emojistyle); 

        $song = stripslashes($_REQUEST['favsong']); 
        $song = mysqli_real_escape_string($con,$song);   
        $song = htmlspecialchars($song);
        $song = preg_replace("/[^a-zA-Z0-9\-\.\!\$\@\&\ ]+/", "", $song); // remove everything except a-z A-Z and 0-9 !$@&

        $bio = stripslashes($_REQUEST['bio']); 
        $bio = mysqli_real_escape_string($con,$bio);   
        $bio = htmlspecialchars($bio);
        $bio = preg_replace("/[^a-zA-Z0-9\-\.\!\$\@\&\ ]+/", "", $bio); // remove everything except a-z A-Z and 0-9 !$@&
 
        $con->query("UPDATE users 
        
        SET firstname = '$firstname',
        lastname = '$lastname',
        bio = '$bio',
        song = '$song',
        location = '$location',
        birthday = '$birthday',
        emojistyle = '$emojistyle'
        
        WHERE id = $sessionUserID" ) or die($con->error); 
        header('Location:edit?success'); 
        
        if ($_FILES["fileToUpload"]["size"] != 0) {

          if (basename($_FILES["fileToUpload"]["size"] > 10000000)) {  
            header('Location:edit?error'); 
        } 
        else {

            // to fix file uploads on Unix
            // sudo chmod -R 755 /Applications/XAMPP/xamppfiles/htdocs/
            // to fix it for profiles : sudo chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/social-media-project/htdocs/user-content/profile/  
            // to fix it for uploads : sudo chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/social-media-project/htdocs/user-content/uploads/  

            $target_dir = "user-content/profile/" . (bin2hex(random_bytes(120))) . ".png";

            $target_file = $target_dir;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
            // Check file size 
    
            $filetype = 0; 
            // Allow certain file formats
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "webm" || $imageFileType == "bmp" || $imageFileType == "webp" || $imageFileType == "jpeg" || $imageFileType == "gif") {  
                $uploadOk = 1;  
            } 
            else {
                $uploadOk = 0;
            } 
 
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                if ($_FILES["fileToUpload"]["size"] != 0) {
                   header('Location:edit?error'); 
                }  
            } 
            
            else {

            // delete old pfp 
            $userid = $_SESSION['id']; 
            $deleteContent = $con->query("SELECT pfpurl FROM users WHERE id = '$userid'") or die($con->error); 
            while($rowsID = mysqli_fetch_assoc($deleteContent)) { 
                $contenturl[] = array(array("Contenturl",$rowsID['pfpurl'])); 
            } 

            if ($contenturl[0][0][1] != "image/default.jpeg") { 
              unlink("../".$contenturl[0][0][1]);  
            } 

            // try upload new pfp 
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $con->query("UPDATE users SET pfpurl = '$target_file' WHERE id = '$userid'" ) or die($con->error); 
                header('Location:edit?success'); 
            } else {
                echo "Sorry, there was an error uploading your file.";
                header('Location:edit?error'); 
            }
            } 
        }

        } 
  } 
 
  if (isset($_SESSION['lastTryUploadPfp'])) {


    $date1 = (DateTime::createFromFormat('Y-m-d H:i:s', ($_SESSION['lastTryUploadPfp'])));  
    $date2 = new DateTime(date("Y-m-d H:i:s"));
  
    $interval = $date1->diff($date2); 
    
   // echo $interval->s.' seconds<br>';

    if ($interval->s > 100) {

      unset ($_SESSION['lastTryUploadPfp']);
      unset ($dontTryUploadpfp);
      unset ($_SESSION['uploadTriesPfp']);

    }
  
    if ($dontTryUploadpfp == 1) {

        $_SESSION['secondsTried'] = $interval->s ;
  
        header('Location:edit?cooldown'); 
  
    }
  
  }


} 
?>  
 
<script> 
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
 
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

<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>