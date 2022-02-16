<!DOCTYPE html>
<html lang="en">  
<head>
<meta
  name="description"           
  content="A new generation social media
          network built for Privacy, Security
          and communication.">
<link rel="manifest" href="manifest.json" crossorigin="use-credentials">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" /> 
<meta name="HandheldFriendly" content="true"> 
<meta name="theme-color" content="#ff2449"/>
<link rel="apple-touch-icon" href="/icons/apple-icon-180.png">
<title>Support </title>
  
<?php include('api/lang.php'); ?>

<style>  

@media (prefers-color-scheme: dark) {
  html {
    background-color: #1a1a1a !important;  
  }
  body { 
    margin-bottom: 33px;
  } 
  h1,h2,h3 {
    color:#dedede;
  } 
  .colorDiv {
    color:#dedede;
  }
  p {
    color:#dedede;
  }

  .white {
    display: none;
  }

  .dark {
    display: block;
  }
} 
@media (prefers-color-scheme: light) {
  body {
    background-color: #FAFAFA;
    margin-bottom: 33px;
  } 
  h1,h2,h3 {
    color:black;
  }
  .colorDiv {
    color:black;
  }

  p {
    color:black;
  }
  .dark {
    display: none;
  }

  .white {
    display: block;
  }
}
</style>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="image/favicon.ico" /> 
</head>  
<body>

<div> 
  <div style = "margin:-8px; -webkit-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);-moz-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);box-shadow: 0 6px 4px -4px rgba(0,0,0,0.465); "> 
      <div class="header" style = "width: auto;overflow: hidden;position:static;  max-height:75px;">
      
      <div class="left" style="float:left;">
        <a href="home"> <img id="hide600" class="nodrag opacityHover" src="image/logo.png" height= "auto;" width="100px;" style="border-radius:6px;margin-top:15px;margin-bottom:15px;margin-right:20px;" alt="Logo"> </a>
          </div>
      <div class="left" style="float:left; "> 
          </div> 
      <div class="right" style="float:right;">
      <button  class="hoverAnimation" id="hide600" onclick="location.href='home';" style="margin-top:10px;cursor:pointer;font-size:19px;background-color: transparent;color:white;border: 3px solid transparent;" class="dropbtn">Back </p> </button>    
      </div> 
      </div> 
      </div>     
  </div>  

  <div class="main width-center" style = "margin-top:20px;width: auto; height:300px;overflow: hidden;border: 0px solid red; padding-top:20px; border: 0px solid red; "> 
      <div class="row">

      <div class="column" id="regHide" style="width: 50%; border: 0px solid red;"> 
          <div class="form" style="width:100%;height:500px;"> 
        <img class="nodrag dark" src="image/firstWhite.png" height= "auto;" width="300px;" style="float:right; border-radius:6px;  padding-top:20px;padding-right:120px;" alt="Intro Image">
        <img class="nodrag white" src="image/firstDark.png" height= "auto;" width="300px;" style="float:right; border-radius:6px; padding-top:20px;padding-right:120px;" alt="Intro Image">
        </div> 
    </div>   
      <div class="column " style="float:left;display: inline; max-width:500px;border: 0px solid red; padding-left:40px; padding-top:55px;"> 
        <div class="form" style="width:100%;height:69vh; border: 0px solid red;"> 
       <h1> <?php echo $lang_support_top_werehereforyou;?> </h1> 
       <p style = "float:left; margin-top:-15px; max-width:290px;"> <?php echo $lang_support_top_werehereforyou_explanation;?> </p>
        </div> 
      </div>
      </div>
      <hr>  
  </div> 
  <br>
  <hr>
  <br>

  <script> 

  function revealSupport (name) {

    var state = document.getElementById(name).style.display; 

    if (state == 'none') {
      document.getElementById(name).style.display = 'block'; 
    }
    else {
      document.getElementById(name).style.display = 'none'; 
    }
  }

  </script> 
  
  <style> 

  a {
    cursor: pointer;
  }

  </style> 

  <div class="main width-center" style = "
  
  
  margin-top:20px;width: auto; height:auto;overflow: hidden;
  
  padding-top:20px; border: 0px solid red;   margin: auto;
  width: 70%; max-width:1000px;"> 
  
            <h2> <?php echo $lang_support_headings_generalquestions;?> </h2>
            <p> <?php echo $lang_support_subheadings_generalquestions;?> </p>
           
            <a onclick="revealSupport('whatis');"> <?php echo $lang_support_question_heading_whatismypage;?> </a>
            <div class="colorDiv" id='whatis' style='display:none;margin-bottom:-10px;'><?php echo $lang_core_about_about_desc;?></div>
            <br>
            <br>
 
            <a onclick="revealSupport('understandingprivaccounts');"> <?php echo $lang_support_question_heading_understandingpriv;?> </a>
            <div class="colorDiv" id='understandingprivaccounts' style='display:none;margin-bottom:-10px ;'><?php echo $lang_support_question_explanation_understandingpriv;?> </div>
            <br>
            <br>
   
            <a onclick="revealSupport('app');"> <?php echo $lang_support_question_heading_app;?> </a>
            <div class="colorDiv" id='app' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_app;?> </div>
            <br>
            <br>
 
            <a onclick="revealSupport('whatisicon');"> <?php echo $lang_support_question_heading_whatisicon;?> </a>
            <div class="colorDiv" id='whatisicon' style='display:none;margin-bottom:-10px;'><?php echo $lang_support_question_explanation_whatisicon;?> </div>
            <br>
            <br>
 
            <a onclick="revealSupport('editprofile');"> <?php echo $lang_support_question_heading_editprofile;?></a>
            <div class="colorDiv" id='editprofile' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_editprofile;?></div>
            <br>
            <br>
 
            <a onclick="revealSupport('learningaboutscores');"> <?php echo $lang_support_question_heading_learningaboutscores;?></a>
            <div class="colorDiv" id='learningaboutscores' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_learningaboutscores;?></div>
            <br>
            <br>
 
            <a onclick="revealSupport('changinglanguage');"> <?php echo $lang_support_question_heading_changinglanguage;?></a>
            <div class="colorDiv" id='changinglanguage' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_changinglanguage;?> </div>

            <br> <br>  
            
            <a onclick="revealSupport('whatareverified');"> <?php echo $lang_support_question_heading_whatareverified;?></a> 
            <div class="colorDiv" id='whatareverified' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_whatareverified;?> </div>
            <br> <br> 
            <h2> <?php echo $lang_support_question_heading_account;?> </h2>
            <p> <?php echo $lang_support_question_explanation_account;?> </p> 
 
            <a onclick="revealSupport('personaldata');"> <?php echo $lang_support_question_heading_personaldata;?> </a>
            <div class="colorDiv" id='personaldata' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_personaldata;?> </div>

            <br>
            <br>
 
            <a onclick="revealSupport('deletingaccount');"><?php echo $lang_support_question_heading_deletingaccount;?> </a>
            <div class="colorDiv" id='deletingaccount' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_deletingaccount;?> </div>

            <br>
            <br>
 
            <a onclick="revealSupport('unabletologin');"> <?php echo $lang_support_question_heading_unabletologin;?></a>
            <div class="colorDiv" id='unabletologin' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_unabletologin;?> </div>
            <br>
            <br>
            
            <a onclick="revealSupport('logindenied');"> <?php echo $lang_support_question_heading_logindenied;?></a>
            <div class="colorDiv" id='logindenied' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_logindenied;?> </div>
            <br>
            <br>
 
            <a onclick="revealSupport('banned');"> <?php echo $lang_support_question_heading_banned;?></a>
            <div class="colorDiv" id='banned' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_banned;?> </div>
            <br>
            <br>
 
            <a onclick="revealSupport('forgotmyemail');"> <?php echo $lang_support_question_heading_forgotmyemail;?></a>
            <div class="colorDiv" id='forgotmyemail' style='display:none;margin-bottom:-10px;'><?php echo $lang_support_question_explanation_forgotmyemail;?></div>
            <br>
            <br>
 
            <a onclick="revealSupport('forgotmypassword');"> <?php echo $lang_support_question_heading_forgotmypassword;?></a>
            <div class="colorDiv" id='forgotmypassword' style='display:none;margin-bottom:-10px;'> </a> <?php echo $lang_support_question_explanation_forgotmypassword;?> </div>
            <br>
            <br>
 
            <a onclick="revealSupport('impersonation');"> <?php echo $lang_support_question_heading_impersonation;?></a>
            <div class="colorDiv" id='impersonation' style='display:none;margin-bottom:-10px;'>  <?php echo $lang_support_question_explanation_impersonation;?> </div>
  
            <br> <br> 

            <h2> <?php echo $lang_support_question_heading_payments;?> </h2>
            <p> <?php echo $lang_support_question_explanation_payments;?> </p> 
  
            <a onclick="revealSupport('whataresuperlikes');"> <?php echo $lang_support_question_heading_whataresuperlikes;?> </a>
            <div class="colorDiv" id='whataresuperlikes' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_whataresuperlikes;?>  </div>
            <br>
            <br>
            <a onclick="revealSupport('blurpost');"> <?php echo $lang_support_question_heading_blurpost;?> </a>
            <div class="colorDiv" id='blurpost' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_blurpost;?> </div>
            <br>
            <br>
            <a onclick="revealSupport('howcanisuperlikepost');"> <?php echo $lang_support_question_heading_howcanisuperlikepost;?> </a>
            <div class="colorDiv" id='howcanisuperlikepost' style='display:none;margin-bottom:-10px;'><?php echo $lang_support_question_explanation_howcanisuperlikepost;?></div>
            <br>
            <br>
            <a onclick="revealSupport('superlikelimits');"> <?php echo $lang_support_question_heading_superlikelimits;?> </a> 
            <div class="colorDiv" id='superlikelimits' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_superlikelimits;?> </div>

            <br>
            <br>
            <a onclick="revealSupport('howtoconnectpaymentoption');"> <?php echo $lang_support_question_heading_howtoconnectpaymentoption;?> </a>
            <div class="colorDiv" id='howtoconnectpaymentoption' style='display:none;margin-bottom:-10px;'>  <?php echo $lang_support_question_explanation_howtoconnectpaymentoption;?> </div>
            <br>
            <br>
            <a onclick="revealSupport('norefunds');"> <?php echo $lang_support_question_heading_norefunds;?> </a>
            <div class="colorDiv" id='norefunds' style='display:none;margin-bottom:-10px;'>  <?php echo $lang_support_question_explanation_norefunds;?> </div>
            <br>
            <br>
            <a onclick="revealSupport('withdrawmoney');"> <?php echo $lang_support_question_heading_withdrawmoney;?> </a>
            <div class="colorDiv" id='withdrawmoney' style='display:none;margin-bottom:-10px;'><?php echo $lang_support_question_explanation_withdrawmoney;?></div>
            <br>
            <br>

            <br> <br> 

            <h2> <?php echo $lang_support_question_heading_securityandsafety;?> </h2>
            <p> <?php echo $lang_support_question_explanation_securityandsafety;?> </p>  

            <a onclick="revealSupport('blockothers');"> <?php echo $lang_support_question_heading_blockothers;?>  </a>
            <div class="colorDiv" id='blockothers' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_blockothers;?> </div>
            <br>
            <br>
            <a onclick="revealSupport('changemailorpass');"> <?php echo $lang_support_question_heading_changemailorpass;?> </a>
            <div class="colorDiv" id='changemailorpass' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_changemailorpass;?>  </div>
            <br>
            <br>
            <a onclick="revealSupport('2faenable');"> <?php echo $lang_support_question_heading_2faenable;?>  </a>
            <div class="colorDiv" id='2faenable' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_2faenable;?>  </div>
            <br>
            <br>
            <a onclick="revealSupport('thisaccdoesntexist');"><?php echo $lang_support_question_heading_thisaccdoesntexist;?> </a>
            <div class="colorDiv" id='thisaccdoesntexist' style='display:none;margin-bottom:-10px;'><?php echo $lang_support_question_explanation_thisaccdoesntexist;?></div>
            <br>
            <br>
            <a onclick="revealSupport('reportingusersorposts');"> <?php echo $lang_support_question_heading_reportingusersorposts;?>  </a>
            <div class="colorDiv" id='reportingusersorposts' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_reportingusersorposts;?>  </div>
            <br>
            <br>
            <a onclick="revealSupport('errorupdatingprofileuploaderrors');"> <?php echo $lang_support_question_heading_errorupdatingprofileuploaderrors;?>  </a>
            <div class="colorDiv" id='errorupdatingprofileuploaderrors' style='display:none;margin-bottom:-10px;'> <?php echo $lang_support_question_explanation_errorupdatingprofileuploaderrors;?> </div>
 
            <br> <br> 

            <h2> <?php echo $lang_support_question_heading_termsprivacyandother;?> </h2>
            <p> <?php echo $lang_support_question_explanation_termsprivacyandother;?> </p>  

            <a href="about?terms"><?php echo $lang_support_question_heading_terms;?></a>
            <br>
            <br>
            <a href="about?rules"><?php echo $lang_support_question_heading_rules;?></a>
            <br>
            <br>
            <a href="about?privacy"><?php echo $lang_support_question_heading_privacy;?></a>
            <br>
            <br>
            <a href="about?copyright"><?php echo $lang_support_question_heading_copyright;?></a>
            <br>
            <br>
            <a href="about?branding"><?php echo $lang_support_question_heading_branding;?></a> 

            <br> <br> 

            <h2> <?php echo $lang_support_headings_stillneedhelp;?> </h2>
            <p> <?php echo $lang_support_headings_explanation_stillneedhelp;?> </p>
            <p> <?php echo $lang_support_headings_explanation_stillneedhelp2;?> </p>
            <br> <br> 
              
      </div> 
  </div>    

  <br> 
  <hr> 
  <br> 
  <center> <?php include('api/links.php'); ?> </center>

</div> 

<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>