
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php 
require('db.php');   
if (isset($_POST['submitRegister'])) {
   # Publish-button was clicked 
   // If form submitted, insert values into the database.
   if (isset($_REQUEST['email'])){  

      $email = stripslashes($_REQUEST['email']); 
      $email = htmlspecialchars($email);
      $email = mysqli_real_escape_string($con,$email); 

      $sanitized_a = filter_var($email, FILTER_SANITIZE_EMAIL);

      if (!filter_var($sanitized_a, FILTER_VALIDATE_EMAIL)) {
         echo " <h3>That email address is not accepted.</h3> "; 
         $emailStop = true;
      } 

      //Checking if email already exists, then not creating another login.
      $query = "SELECT * FROM `users` WHERE email='$email'";
      $result = mysqli_query($con,$query) or die(mysqli_error($con));
      $rows = mysqli_num_rows($result); 
      if($rows>=1){ 
         echo " <h3>An account with that email already exists.</h3> ";  
      }
      elseif ((strlen($_REQUEST['password'])) < 4) {
         echo " <h3>Password must be at least 4 characters.</h3> ";  
      } 
      else { 

         if (isset($_REQUEST['invite'])){  
            $invite = stripslashes($_REQUEST['invite']); 

            $invite = htmlspecialchars($invite);
            $invite = mysqli_real_escape_string($con,$invite); 

            $checkinv = $con->query("SELECT id FROM invites WHERE code='$invite' AND used = 0;") or die($con->error);    
            while($row = mysqli_fetch_assoc($checkinv)) { 
               $invcode = ($row['id']);
            }  

            if (!isset($invcode)) { 
               echo " <h3>Unable to accept invite.</h3> ";  
            }

            else { 

               $username = stripslashes($_REQUEST['firstname']); 
               $username = htmlspecialchars($username);
               $username = mysqli_real_escape_string($con,$username);

               $username = preg_replace('/\s+/', '', $username); // to remove whitespaces including tabs and line ends 
               $username = preg_replace('~\x{00a0}~','',$username); // to remove  non-breaking spaces

               $checkUsername = $con->query("SELECT id FROM users WHERE username='$username';") or die($con->error);    
               while($row = mysqli_fetch_assoc($checkUsername)) { 
                  $usernameCheckd = ($row['id']);
               }  

               if (isset($usernameCheckd)) { 
                  echo " <h3>That username already exists.</h3> ";  
                  
               }

 
               else { 
 
                  if (preg_match('/[^A-Za-z0-9]/', $username)) // '/[^a-z\d]/i' should also work.
                  {
                
                     echo " <h3>Username must only contain characters and numbers</h3> ";  
                  
                  }

                  else { 

                     if ($emailStop != true) {
                        
                     //if ((strlen($username)) > 14) {
                     //   echo " <h3>Username cannot be longer than 14 characters.</h3> ";  
                     //} 
                     
                        

                           //$sql = $con->query("SELECT id FROM accVerify WHERE email = '$email';" ) or die($con->error); 

                           //while($rowsID = mysqli_fetch_assoc($sql)) { 
                           //$reports[] = array($rowsID['id']); 
                           //} 
                           
                           //if (empty($reports)) { 
                           
                              //$tokenGenerated = bin2hex(random_bytes(360/2)); 
                           
                              //$sql = $con->query("INSERT INTO `accVerify`(`email`, `token`, `success`, `create_date`) VALUES ($email, $tokenGenerated, false, NOW()); " ) or die($con->error); 
                           

                           //   $firstname = stripslashes($_REQUEST['firstname']); 
                           //   $firstname = htmlspecialchars($firstname);
                           //   $firstname = mysqli_real_escape_string($con,$firstname); 
                           //   $firstname = strtolower($firstname);
                           //   $firstname = ucfirst($firstname);

                           //   $lastname = stripslashes($_REQUEST['lastname']); 
                           //   $lastname = strtolower($lastname);
                           //   $lastname = ucfirst($lastname);
                              
                           //$lastname = htmlspecialchars($lastname);
                           //$lastname = mysqli_real_escape_string($con,$lastname);  
 

                           $password = stripslashes($_REQUEST['password']);
                           $password = htmlspecialchars($password);
                           $password = mysqli_real_escape_string($con,$password);
                           $score = 0; 
                           $create_date = date("Y.m.d");
                           $bio = "No bio";
                           $verified = 0;
                           $private = 0; 
                           $feedtype = 1;
                           $registration = 1; 
                           $pfpurl = "image/default.jpeg"; 
                           $coverurl = "image/cover.jpeg";
                           $admin = 0;
                           $language = "en";
                           $profileViews = 0;

                           $token = bin2hex(random_bytes(360/2));  
                           $query = "INSERT into `users` (firstname, lastname, username, email, password, bio, score, verified, admin, private, registration, create_date, pfpurl, coverurl, feedtype, profileViews, language, accountToken, hideAccount)
                           VALUES ('', '', '$username', '$email', '".password_hash($password, PASSWORD_DEFAULT)."', '$bio', '$score', '$verified', '$admin', '$private', '$registration', '$create_date', '$pfpurl', '$coverurl', '$feedtype', '$profileViews', '$language', '$token', '0')"; 
                           
                           $result = mysqli_query($con,$query); 
  
                           if($result){ 
  
                                    $_SESSION['username'] = $username; 
                                    $_SESSION['email'] = $email; 
                                    $_SESSION['id'] = mysqli_insert_id($con);
                                    $sessionUserID = $_SESSION['id']; 
 
                                    // add into settings
                                    $query = "INSERT into `settings` (userid, safetynsfw, privacy, disablerelationships, featurestime)
                                    VALUES ('$sessionUserID', 0, 0, 0, 0)"; 

                                    $resultSettings = mysqli_query($con,$query); 

                                    $sqluserid = (int)$sessionUserID; 
                                    $con->query("UPDATE `invites` SET `codeuser`='$sqluserid', `used`=1, `use_date`=NOW() WHERE `code`='$invite'") or die($con->error); 

                                    $checkmaker = $con->query("SELECT codemaker FROM invites WHERE code='$invite'") or die($con->error);    
                                    while($row = mysqli_fetch_assoc($checkmaker)) { 
                                       $inviter = ($row['codemaker']);
                                    } 
 
                                    $sql = $con->query("INSERT INTO `friends`(`userid`, `useridFriend`, `friendstate`, `since_date`) VALUES ($inviter,$sessionUserID,'Friends',NOW());" ) or die($con->error); 
                                    $sql2 = $con->query("INSERT INTO `friends`(`userid`, `useridFriend`, `friendstate`, `since_date`) VALUES ($sessionUserID,$inviter,'Friends',NOW());" ) or die($con->error);

                                    $notif = "". ("$username") . " has joined MyPage with your invite!" . "";  
                                    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($inviter,'Inviter','$notif','0',NOW());" ) or die($con->error);
 
                                    $getInviterName = $con->query("SELECT username FROM users WHERE id='$inviter';") or die($con->error);    
                                    while($row = mysqli_fetch_assoc($getInviterName)) { 
                                       $usernameINVITER = ($row['username']); 
                                    } 
                                    $notif = " You have joined mypage with ". ("$usernameINVITER") . "''s invite!"; 
                                    $sql2 = $con->query("INSERT INTO `notifications`(`userid`, `type`, `post`, `read`, `create_date`) VALUES ($sessionUserID,'Invited','$notif','0',NOW());" ) or die($con->error);
            
                                    // Redirect user to home
                                    header("Location: home");
                                    exit;  
                     }

                           }  
                        
                        }
                        
                     exit;

                     }

               }

               } 
            }

      } 
}  
?> 

<style> 

@media only screen and (max-width: 800px) { 
  #idInput {
  width:100% !important;
  height:55px !important;
  font-size: 22px;
  }   
  #idInputButton { 
    font-size: 22px;
    text-align: center;
  }
}
@media only screen and (min-width: 880px) { 
  #idInput {
  max-width: 100% !important; 
  }   
  #idInputButton {
    display:block;
    font-size:15px;
    float:right;
  }
}
</style>  

<form name="registration" action="" method="post">
   <input id="idInput" type="username" name="firstname" placeholder="Username" required /> 
   <input id="idInput" style="position:static;" type="email" name="email" placeholder="Your Email" required />
   <input id="idInput" type="password" name="password" placeholder="New Password" required />
   <?php 
   
   if (!isset($invcode)) {
      echo '<input id="idInput" type="name" style="  width: 305px;" name="invite" placeholder="Invite Code" autocomplete="off" required /> '; 
   }

   else {
      echo '<input style="display:none;" type="name" style="  width: 305px;" name="invite" value="'. $invcode . '" placeholder="Invite Code" autocomplete="off" required /> '; 
    
   }

   ?> 
   <br><br> 

   <?php 
   
   if (!isset($invcode)) {
      echo '<input id="idInput" class="float" style="  width: 305px;" type="submit" name="submitRegister" value="Sign Up " />'; 
   }
   
   else {
      echo ' <input class="float" style="  width: 305px;" type="submit" name="submitRegister" value="Sign Up with '. $firstnameofInviter . 's Invite 😁" /> '; 
   }

   ?> 
</form>  

<script>
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
</script>