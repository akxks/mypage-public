
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<?php  
function datedifference($date) { 
  $date1 = (DateTime::createFromFormat('Y-m-d H:i:s', ($date)));  
  $date2 = new DateTime(date("Y-m-d H:i:s"));
  $interval = $date1->diff($date2); 
  if (($interval->y) == 0) {
    if (($interval->m) == 0) {
      if (($interval->d) == 0) {
        if (($interval->h) == 0) {
          $return = $interval->i . "m";
        }
        else {
          $return = $interval->h . "h";
        } 
      }
      else {
        $return = $interval->d . "d";
      } 
    }
    else {
      $return = $interval->m . "mo";
    } 
  }
  else {
    $return = $interval->y . "yr";
  }
  return $return; 
} 
?>