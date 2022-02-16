
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php
function nice_number($n) { 
  $n = (0+str_replace(",","",$n));   
    if($n>=1000000000) {
      $n = round(($n/1000000000),1).'B';
    } 
    else if($n>=1000000) {
      $n = round(($n/1000000),1).'M';
    } 
    else if($n>=1000) {
      $n = round(($n/1000),1).'K'; 
    } 
    return $n;  
}
?>
