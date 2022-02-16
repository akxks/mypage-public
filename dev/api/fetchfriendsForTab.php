
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<div class=" " style="width:100%;">
<div style="width:100%;  float:left;"> 
<div class="row"> 

                <div id="friendsfetching" style="display:block;">  
                  <script type="text/javascript">
                      var session_id = '<?php echo $_SESSION["id"];?>';
                      var fetchid = 'home'; 
                      
                      var account_token = '<?php echo $_COOKIE["accountToken"]; ?> ';; 

                  </script> 
                  <script type="text/javascript" src="api/friendslist.js"></script> 
                  <h2><?php echo $lang_core_index_friends;?></h2> 
                  <div style="border: 0px solid transparent;" id='fetchfriends' class="friends "> 
                    <?php 
                    $requestedID = $_SESSION['id']; 
                    $personid = 1; 
                    $fetch = "home";
                    $accountToken = $_POST['account_token']; 
                    include 'api/friendsfetch.php';?> 
                  </div>   
                  </div>
                  
                  <h2><?php echo $lang_core_index_suggestedfriends;?></h2>  
                  <div class="friends-content card-no-hover systemcolor-noborder" style="width: 100%; padding: 8px;border-radius: 6px;"> 
                  <?php 
                  $requestedID = $_SESSION['id']; 
                  $fetch = "home";
                  include 'api/suggestedfriends.php';?> 
                  </div>  
                  <div class='footermargin'> 
                  <div class='footermargin'> 
            <?php   
              include 'api/mobilefooter.php'; 
            ?>   
            </div>
      </div>   
      </div>   
    </div> 
</div>

</div> 
