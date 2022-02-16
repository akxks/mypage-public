<?php

require("db.php");  

if(!isset($_POST['type'])){ $type = "firstload"; }

if ($type == "firstload") {
  
   $rowperpage = 3;

   $allcount_query = "SELECT count(*) as allcount FROM blogPosts";
   $allcount_result = mysqli_query($con,$allcount_query);
   $allcount_fetch = mysqli_fetch_array($allcount_result);
   $allcount = $allcount_fetch['allcount'];

   if ($allcount == 0) {
 
     echo "<div class='card-no-hover systemcolor-noborder' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:0px;margin-bottom:40px;'>";   

     echo '<div style="padding:20px;">';

     echo '<center> <p> ☁️ No blog posts found at the moment. </p> </center>';

     echo '</div>'; 

    echo '</div>'; 

   }

   $query = "select * from blogPosts order by create_date desc limit 0,$rowperpage ";
   $result = mysqli_query($con,$query);

   while($row = mysqli_fetch_array($result)){

     $id = $row['id'];
     $title = $row['title'];
     $content = $row['post'];  
     $createdate = $row['create_date'];  

   ?>

      <div id="post_<?php echo $id; ?>" class='card-no-hover systemcolor-noborder post' style='border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:20px;margin-bottom:40px;'> 
      <div style="padding:20px;">
      <p style="float:right;"> <?php echo $createdate; ?> </p> 
        <h2><?php echo $title; ?></h2>
       <p> <?php echo $content; ?> </p> 
       </div> 
     </div>

   <?php
   }
   ?>

   <?php 

}
else {

   $row = 0;
   if(isset($_POST['row'])){ $row = mysqli_real_escape_string($con,$_POST['row']); }
   $rowperpage = 8;

   $query = 'SELECT * FROM blogPosts order by create_date desc limit '.$row.','.$rowperpage;
   $result = mysqli_query($con,$query);

   $html = ''; 

   while($row = mysqli_fetch_array($result)){
      
   $id = $row['id'];
   $title = $row['title'];
   $content = $row['post'];
   $createdate = $row['create_date'];


   //html
   $html .= '<div id="post_'.$id.'" class="card-no-hover systemcolor-noborder post" style="border-radius:6px; float:left;border:3px solid transparent;width:100%;height:auto;padding-bottom:20px;margin-bottom:40px;">';
   
   $html .= '<div style="padding:20px;">';

   $html .= '<p style="float:right;">'.$createdate.'</p>'; 

   $html .= '<h2>'.$title.'</h2>';
   $html .= '<p>'.$content.'</p>'; 

   $html .= '</div>';
   $html .= '</div>';

   } 
   echo $html; 
      
}

?>