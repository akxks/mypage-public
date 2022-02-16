
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<h2>Messaging</h2> 

<div class="card-no-hover systemcolor" style=" border: 0px solid transparent !important; background-image: linear-gradient(#ff3b5c, #de1641) !important; border-radius: 4px;">  

<?php 
require('db.php');

echo "<a style='cursor:pointer;' id='backtofriends'>  <p> Back </p>  </a>";
$sessionUserID = $_GET['userid']; 
$uid = $_GET['personid']; 

if (!is_numeric($uid)) {
	exit; 
}

//if (!isset($uid)) { $uid = -1; }

$contentURL = $con->query("SELECT pfpurl FROM users WHERE id = '$uid'") or die($con->error); 

while($rowsID = mysqli_fetch_assoc($contentURL)) { $contenturlimg = $rowsID['pfpurl']; }  

echo "<div style='padding: 5px;  '> <img src='".$contenturlimg."' height= '41px;' width='41px;' style='border-radius:50%;float:left; ' class='imageshadow nodrag' alt='Profile Picture' ><p style='padding-left:10px;float:left;'> ". $username, '<img class="float nodrag" src="image/verified.png" height= "auto;" width="20px;" style="float:none; " alt="Verified Sticker">'."</p> <br> <br> </div>";

?>
</div> 

<div class="card-no-hover systemcolor" style="border: 15px solid transparent !important;">  

<center>  
<img class="nodrag" id="logo" src="image/logo.png" height= "auto;" width="125px;" style="
text-align: center;
display: block; margin-left: auto; margin-right: auto;  padding-top:15px !important; " alt="Logo"> </img>

<div id="offlineActions">
	<div><input type="text" style="visibility:hidden;" id="conn_str" value="ws://127.0.0.1:8080/"/></div>  
</div>

<div id="statusBox">
	<span id="status" class="label label-warning">Loading </span>
	<button onclick='toggleConnect();' class="connect">Connect</button>
</div> 

</center>  
<div id="chatTarget" style="overflow-x: none; height:200px; max-height: 200px;">
</div>
 
</div>
<div class="card-no-hover systemcolor" style="border: 15px solid transparent !important;">  
<div id="onlineActions" class="display: none">
	<input type="text" id="message"/>
	<button onclick='send();' class="send">Send Message</button>
</div>
</div>  


<script> 
var conn = null;
var isConnected = false;

$(function() {
	setOffline();
});

function setOnline() {
	$("#status").removeClass("label-warning");
	$("#status").addClass("label-success");
	$("#status").html("Connected");
	$("button.connect").html("Disconnect");
	$("#offlineActions").hide();
	$("#onlineActions").show();
	isConnected = true;
}

function setOffline() {
	$("#status").addClass("label-warning");
	$("#status").removeClass("label-success");
	$("#status").html("Disconnected");
	$("button.connect").html("Connect");
	$("#offlineActions").show();
	$("#onlineActions").hide();
	isConnected = false;
}

function send() {
	msg = $("#message").val();
	if (msg == "") {
		//alert("Can't send an empty message");
		return;
	}
	conn.send(msg);
	$("#chatTarget").prepend("<p> Me: " + msg + "<br/> </p>");
	$("#message").val("");
}

function toggleConnect() {
	var uri = $("#conn_str").val();
	if (isConnected) {
		setOffline();
		return;
	}
	conn = new WebSocket(uri);

	conn.onmessage = function(e) {
		$("#chatTarget").prepend("<p> Not me: " + e.data + "<br/> </p> ");
	}

	conn.onopen = function(e) {
		console.log(e);
		setOnline();
		console.log("Connected");
		isConnected = true;
	};

	conn.onclose = function(e) {
		console.log("Disconnected");
		setOffline();
	}; 
}  
</script>  