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
<title>Welcome to mypage </title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

<script> 
function openLogin() {
  document.getElementById("mainPhone").style.display = "none";
  document.getElementById("mainPhoneLogin").style.display = "block";
}

function openRegister() {
  document.getElementById("mainPhone").style.display = "none";
  document.getElementById("mainPhoneRegister").style.display = "block";
}

function openFirstMenu() {
  document.getElementById("mainPhone").style.display = "block";
  document.getElementById("mainPhoneRegister").style.display = "none";
  document.getElementById("mainPhoneLogin").style.display = "none";
}
</script> 

<style>  
 
@media only screen and (max-width: 800px) { 
  #mainPhone {
  display:block;
  }  
  #mainPhoneLogin {
  display:block;
  }  
  #mainPhoneRegister {
  display:block;
  }  
  #mainnophone {
    display:none;
  }  
}
@media only screen and (min-width: 880px) { 
  #mainPhone {
  display:none;
  }  
  #mainPhoneLogin {
  display:none;
  }  
  #mainPhoneRegister {
  display:none;
  }  
  #mainnophone {
    display:block;
  }  
}

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
<body id="body">

<div id="mainnophone"> 
  <div style = "margin:-8px; -webkit-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);-moz-box-shadow: 0 6px 4px -4px rgba(0,0,0,0.42);box-shadow: 0 6px 4px -4px rgba(0,0,0,0.465); "> 
      <div class="header" style = "width: auto;overflow: hidden;position:static; opacity: 1; height:90px;">
      <div class="left" style="float:left;">
          <img class="nodrag opacityHover" src="image/logo.png" height= "auto;" width="95px;;"  style="border-radius:6px;margin-top:15px;margin-right:60px;" alt="Logo"> 
          </div>
          <div class="left" style="float:left; "> </div>
          <div class="right" style="font-size:2vh;float:right;border: 3px solid transparent; border-radius:2px; ">
          <?php include 'api/login.php';?>
          </div> 
          </div>     
  </div> 

  <div class="main width-center" style = "margin-top:20px;width: auto;overflow: hidden;border: 0px solid red; padding-top:20px; "> 
      <div class="row">

      <div class="column" id="regHide" style="width: 50%; border: 0px solid red;"> 
          <div class="form" style="width:100%;height:69vh;"> 
        <img class="nodrag dark" src="image/firstWhite.png" height= "auto;" width="460px;" style="float:right; border-radius:6px;  padding-right:120px;" alt="Intro Image">
        <img class="nodrag white" src="image/firstDark.png" height= "auto;" width="460px;" style="float:right; border-radius:6px; padding-right:120px;" alt="Intro Image">
        </div> 
    </div>   

      <div class="column " style="float:left;display: inline; max-width:500px;border: 0px solid red; padding-left:160px; padding-top:85px;"> 
        <div class="form" style="width:100%;height:69vh; border: 0px solid red;"> 

       <h1>Sign up 🎉 </h1>   
       <p style = "float:left; margin-top:-15px; max-width:290px;">Join mypage now, a new social media that supports your favourite creators and friends. Donate to your favourite creators with superlike tips! Join for <b> free. </b> </p>  
 
          <?php include 'api/register.php';?> 
          <p style="font-size:15px;"> By registering you accept the <a href="about?terms"> Terms of Service </a> and certify that you are 18 years of age or older. </p> 
        </div> 
      </div>
      </div>
  </div> 
  <br>
  <hr>
  <br>


<script>  
$(document).ready(function() { 

if (window.location.hash == "#deletedAccount") { 

  var modal = document.getElementById("deleteacc"); 

  modal.style.display = "block"; 

  var modal = document.getElementById("deleteAccmodal");  
  modal.classList.add('push') ;
  
  document.getElementById("body").style.overflow = "hidden";
  
  document.getElementById("forgotBox").style.display = "none";

}
});

function closeModalReport() { 
  var modal = document.getElementById("deleteacc");  
  modal.style.display = "none";

  document.getElementById("body").style.overflow = "scroll";
  document.getElementById("body").style.overflowX = "hidden";

} 

</script> 
  
<div id="deleteacc" style="display:none;" class="modal">  
  <div id="deleteAccmodal" class="modal-content internetOffline internetOfflineText" style="max-width:650px !important; ">  
     <h2> Account Deleted </h2>  
     <p> Your account has been deleted forever! </p>   
    <center> <h3> <a onclick="closeModalReport()" > <input class="float" id="postbutton" name="submit" type="submit" value="Okay" /> </input> </a> </h3> </center> 
  </div> 
</div> 


<script> 
$(document).ready(function(){ 
  $(document).scroll(function() { 
    $("#statis1").fadeIn(1400);
    $("#statis2").fadeIn(1400); 
  });
});
</script> 

  <div class="main width-center"  style = "margin-top:20px;width: auto;overflow: hidden;border: 0px solid red; padding-top:20px; "> 
   
  <b> <center> <p style='font-size:40px;'>Statistics </p> </center>  </b>
  
  <br>
  <br>
  
  <div class="row" style='border: 0px solid red; margin-left:2%;margin-left:12%;'> 

 
  <div class="column" id="statis1" style="width: 50%; border: 0px solid red; display:none;"> 
  
      <div class="form" style="width:100%;height:80vh;"> 


      <div style='padding-right:30px; border:0px solid blue; height: 20vh;float: right;'> 
      <div style='  float: right;
          width: 100%;' >  
          
          <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> 😍</p>

          <p style='font-size:30px;'>159,992,110+ <br> <b> Site Views </b></p> 

        </div> 
        
          
        <div style='  float: right;
        width: 100%;' >  
        
        <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> ⭐</p>

        <p style='font-size:30px;'>100,992 <br> <b> Featured Creators </b></p> 

      </div> 
        
          
      <div style='  float: right;
          width: 100%;' >  
          
          <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> 💰</p>

          <p style='font-size:30px;'>$9,669,992,110 <br> <b> Paid Out </b></p> 
      
        </div>
           
      </div>

    </div> 
</div>   
<div class="column" id="statis2" style="width: 50%; border: 0px solid red; display:none;"> 
  
  <div class="form" style="width:100%;height:80vh;"> 


  <div style='padding-right:30px; border:0px solid blue; height: 20vh;'> 
  <div style='  float: right;
      width: 100%;' >  
      
      <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> ❤️</p>

      <p style='font-size:30px;'>159,992,110+ <br> <b> Superlikes </b></p> 

    </div> 
    
      
    <div style='  float: right;
    width: 100%;' >  
    
    <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> 😀</p>

    <p style='font-size:30px;'><?php 
    include('db.php'); 
    $sql = $con->query("SELECT COUNT(*) AS id FROM users;") or die($con->error);    
    while($row = mysqli_fetch_assoc($sql)) { 
    $param = ($row['id']);
    }
    $num = $param;
    $formattedNum = number_format($num); 

    echo $formattedNum;
    ?><br> <b> Users Registered </b></p> 

  </div> 
    
      
  <div style='  float: right;
      width: 100%;' >  
      
      <p style='font-size:90px;; float:left; border-radius:6px;  margin-top:8px; margin-right:15px;'> ✉️</p>

      <p style='font-size:30px;'><?php 
    include('db.php'); 
    $sql = $con->query("SELECT COUNT(*) AS id FROM posts;") or die($con->error);    
    while($row = mysqli_fetch_assoc($sql)) { 
    $param = ($row['id']);
    }
    $num = $param;
    $formattedNum = number_format($num); 

    echo $formattedNum;?><br> <b> Posts </b></p> 
  
    </div>
    
      
  </div>

</div>  
 
</div> 
 
</div> 
</div> 
</div> 
</div> 
 
  <hr>
  <br>
 
  <center> <?php include('api/links.php'); ?> </center>

</div> 

<div id="mainPhone"> 
  <div style=" position:fixed; padding:0; margin:0; top:0; left:0; width: 100%; height: 100%; ;background-image: linear-gradient(#ff3b5c, #de1641);"> 
  <center>   <img class="nodrag" src="image/logo.png" height= "auto;" width="155px;"  style="border-radius:6px;margin-top:50%; margin-left:10px; " alt="Logo">  </center> 
  <button style=" margin-top: 35%; width: 100%; height: 10%; background-color: transparent; outline: none !important; border: none; font-size:22px; color: white;" onclick="openLogin()"> Login </button>  
  <button style=" margin-top:20px; width: 100%; height: 10%; background-color: transparent; outline: none !important; border: none; font-size:22px; color: white;" onclick="openRegister()"> Sign up </button>  
  </div> 
</div> 

<div id="mainPhoneRegister" style="display:none;height:100%; ">  
  <div style=" position:fixed; padding:0; margin:0; top:0; left:0; width: 100%; height: 100%; ;background-image: linear-gradient(#ff3b5c, #de1641); overflow-y: scroll; "> 
    <center> <img onclick="openFirstMenu()" class="nodrag" src="image/logo.png" height= "auto;" width="155px;"  style="border-radius:6px;margin-top:20%; margin-left:10px; " alt="Logo">  </center> 
    <div class="column " style="float:right;display: inline; max-width:400px; overflow-y: scroll;">
          <div class="form" style="width:100%;height:100%; overflow-y: scroll;" > 
          <br>
          <br>
            <?php include 'api/register.php';?> 
            <center> <p style="font-size:19px; color: white !important;"> By registering you accept our <a href="about?terms" style="color:white;"> Terms Of Service </a>🔓</p> </center> 
          </div> 
        </div>
    </div> 
</div> 

<div id="mainPhoneLogin" style="display:none;"> 
<div style=" position:fixed; padding:0; margin:0; top:0; left:0; width: 100%; height: 100%; ;background-image: linear-gradient(#ff3b5c, #de1641); overflow-y: scroll; "> 
    <center> <img onclick="openFirstMenu()" class="nodrag" src="image/logo.png" height= "auto;" width="155px;"  style="border-radius:6px;margin-top:20%; margin-left:10px; " alt="Logo">  </center> 
    <div class="column " style="float:right;display: inline; max-width:400px; overflow-y: scroll;">
          <div class="form" style="width:100%;height:100%; overflow-y: scroll;" > 
            <?php include 'api/login.php';?> 
          </div> 
        </div>
    </div> 
</div>  

<script type="text/javascript" src="api/mobilesupport"></script>   
</body>
</html>