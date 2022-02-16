
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<!DOCTYPE html>
<?php  
require 'api/db.php';
require 'api/lang.php';
include 'api/internetalive.php';
?>
<html lang="en"> 
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $lang_core_html_titles_about;?></title>
<link rel="stylesheet" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">   
  $(document).ready(function() { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('divIDbranding').style.display = 'none';
      document.getElementById('divIDterms').style.display = 'none';
      document.getElementById('divIDcommitments').style.display = 'none';
      document.getElementById('divIDprivacy').style.display = 'none'; 
      document.getElementById('divIDcopyright').style.display = 'none'; 
      document.getElementById('divIDwhatsnew').style.display = 'none'; 
      document.getElementById('divIDrules').style.display = 'none'; 

      document.getElementById('hrefIDabout').style.fontWeight = "normal";
    if (window.location.href.indexOf("about") > -1) { 
      document.getElementById('divIDabout').style.display = 'block';
      document.getElementById('hrefIDabout').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("branding") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDbranding').style.display = 'block';
      document.getElementById('hrefIDbranding').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("terms") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDterms').style.display = 'block';
      document.getElementById('hrefIDterms').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("commitments") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDcommitments').style.display = 'block';
      document.getElementById('hrefIDcommitments').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("copyright") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDcopyright').style.display = 'block';
      document.getElementById('hrefIDcopyright').style.fontWeight = "900";
    }
    if (window.location.href.indexOf("rules") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDrules').style.display = 'block';
      document.getElementById('hrefIDrules').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("privacy") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDprivacy').style.display = 'block';
      document.getElementById('hrefIDprivacy').style.fontWeight = "900";
    }  
    if (window.location.href.indexOf("new") > -1) { 
      document.getElementById('divIDabout').style.display = 'none';
      document.getElementById('hrefIDabout').style.fontWeight = "normal";
      document.getElementById('divIDwhatsnew').style.display = 'block';
      document.getElementById('hrefIDwhatsnew').style.fontWeight = "900";
    }  
  });
</script>

<body> 
  <div class="wrapper">
  <div style="background-color:#22c2f2;margin:-8px; -webkit-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);-moz-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);box-shadow: 0 6px 4px -4px rgba(0,0,0,0.465); ">
 
  <div style="overflow:relative;"> 
  <div class="header width-center" style = "height:75px;max-height:10vh;width: 100%; overflow: hidden;">
  <div class="left" style="float:left;">
  <style> .opacityHover:hover { opacity: 0.75; } </style> 
        <a href="home"> <img class="nodrag opacityHover" src="image/logo.png" height= "auto;" width="100px;" style="border-radius:6px;margin-top:10px;margin-bottom:15px;margin-right:20px;" alt="Logo"> </a>
          </div>
      <div class="left" style="float:left; "> 
          </div> 
      <div class="right" style="float:right;">
      <button  class="hoverAnimation"  onclick="location.href='home';" style="margin-top:10px;cursor:pointer;font-size:19px;background-color: transparent;color:white;border: 3px solid transparent;" class="dropbtn">Back </p> </button>    
      </div>
  </div> 
  </div> 
  </div>  
    <div class="main width-center" style = "margin-top:2vh;width: auto;">  
    <div class="width-center"> 
      <div class="row"> 
      <div class="column" style="width: 10%;height:100%;margin-top:10vh;">  
          <div class="row"> 
          <div class=" " style="height:47.6vh;"> 
          </div>
          </div> 
      </div>   
      <div class="column" style="width: 20%;height:100%;">  
      <h2><?php echo $lang_core_about_about;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:auto;">
              <a id="hrefIDabout" style="color: inherit;text-decoration: inherit;" href = "about?about"><?php echo $lang_core_about_about;?></a> </p>
              <a id="hrefIDbranding"  style="color: inherit;text-decoration: inherit;" href = "about?branding"><?php echo $lang_core_about_branding;?></a>  </p>
              <a id="hrefIDcopyright"  style="color: inherit;text-decoration: inherit;" href = "about?copyright"><?php echo $lang_core_about_copyright;?></a>  </p>
              <a id="hrefIDprivacy" style="color: inherit;text-decoration: inherit;" href = "about?privacy"><?php echo $lang_core_about_privacy;?></a>  </p>
              <a id="hrefIDterms" style="color: inherit;text-decoration: inherit;" href = "about?terms"><?php echo $lang_core_about_terms;?></a> </p>
              <a id="hrefIDcommitments" style="color: inherit;text-decoration: inherit;" href = "about?commitments"><?php echo $lang_core_about_commitments;?></a> </p> 
              <a id="hrefIDrules" style="color: inherit;text-decoration: inherit;" href = "about?rules"><?php echo $lang_core_about_rules;?></a> </p> 
              <a id="hrefIDwhatsnew" style="color: inherit;text-decoration: inherit;" href = "about?news"><?php echo $lang_core_about_news;?></a> </p>
              <hr>
              <br> 
              <a style="color: inherit;text-decoration: inherit;" href = "support">Support</a> </p>
          </div>
          </div> 
          <p style="color:gray;font-size:15px;"> <?php echo $lang_core_about_editedlast;?></p> 
      </div> 
      <div class="column" id="divIDabout" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_about;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:100%;"> 
              <p><?php echo $lang_core_about_about_desc;?></p>  
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDbranding" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_branding;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:47.6vh; "> 
              <p><?php echo $lang_core_about_branding_desc;?></p>  
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDwhatsnew" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_new;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:47.6vh; ">  
          <p><?php echo $lang_core_about_new_desc;?></p> 
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDcopyright" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_copyright;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:47.6vh; "> 
              <p><?php echo $lang_core_about_copyright_desc;?></p>  
          </div>
          </div> 
      </div>        
        <div class="column" id="divIDrules" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_rules;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:auto; "> 
              <p><?php echo $lang_core_about_rules_desc;?></p>  
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDprivacy" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_privacy;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:auto;"> 
              <p><?php echo $lang_core_about_privacy_desc;?></p>  
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDterms" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_terms;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:auto; "> 
              <p><?php echo $lang_core_about_terms_desc;?></p>  
          </div>
          </div> 
      </div>    
      <div class="column" id="divIDcommitments" style="width: 60%;height:100%;"> 
          <h2><?php echo $lang_core_about_commitments;?></h2>
          <div class="row">
          <div class="card-no-hover systemcolor" style="height:auto; "> 
              <p><?php echo $lang_core_about_commitments_desc;?></p>  
          </div>
          </div> 
      </div>    
      </div>
    </div>
    </div> 
</div> 
<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>