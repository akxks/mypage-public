
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<style>

@media (prefers-color-scheme: light) {

    .hovertrend:hover {
        background-color: #ddd !important;border-radius:6px;
    }

}

@media (prefers-color-scheme: dark) {

    .hovertrend:hover {
        background-color: #383838 !important;border-radius:6px;
    }

}


@media (prefers-color-scheme: dark) {

.hovertrend:hover {
    background-color: #383838 !important;border-radius:6px;
}

}

@media only screen and (min-width: 800px) { 

    .smallerForPC {
    max-width:300px; 
}

}
</style>

<?php 

if ($fetchTrend == 'home') { 

    echo '<div class="smallerForPC" style="width:100%; float:left; " id="hideSmallerScreenMain" >
    <h2 style="display:inline-block;"> Discover </h2>  
    <p style="font-size:12px; padding-left:5px; color:#ff2e7b; display:inline-block;"> NEW </p>
    '; 

    echo "<a class='hovertrend' href='discover' style='cursor:pointer; '>    "; 
    echo '<div class="card systemcolor-noborder friends-content " style="width: 100% !important; padding: 8px;border-radius: 5px; 
     border: 0px solid #de1641; 
      box-shadow: 0px 0px 4px #de1641, 
      inset 0px 0px 4px #de1641; 
    "> ';  
  
 
    echo " <div style='padding: 5px;width: 100% !important; ' class='hrefColor' > 💎 🔍 Discover posts, gifs, profiles </div> </a>";
 
    echo "</div>";  

    echo '</div>';
 

    // trending
    echo '<div class="smallerForPC" style="width:100%; float:left; " id="hideSmallerScreenMain" >
    <h2>' . $lang_core_index_trending . ' </h2>  
    <div class="row">
    <div class="card-no-hover systemcolor" style="height:auto;  border: 5px solid transparent !important; ">'; 

    $trending = 1; 

    if (!isset($trending)) {

        echo '<p> 💭 Nothing is trending at the moment. </p> ';

    }

    else {   
        echo "<a class='hovertrend' href='trending' style='cursor:pointer; '>    "; 
        echo '<div class="systemcolor-noborder friends-content " style="width: 100% !important; padding: 3px;border-radius: 5px; "> ';  
        //FETCHING FOR HOME PAGES 
        //  while ($friendsnum != -1) {  
        $emoji  = '22K  ';
        $emojiFirst  = '    ';
        // $glow = 'text-shadow: 0px 0px 17px white;';
    
        echo " <div style='padding: 5px;width: 100% !important; '> <p style='padding-left:10px;font-size:18px;margin-top:15px;float:left;'> $emojiFirst minecraft <p class='glowEmoji' style=' font-size:17px; ". $glow ." float:right; margin-right:10px; '> " , $emoji , " </p> <br> <br> <br> </div> </a>";
    
        //  $friendsnum = $friendsnum - 1;   
        // }
        echo "</div>";  
    }

    echo '</div> </div>  ';
    
    include('api/links.php'); 
    
    echo '</div> '; 

}

?> 