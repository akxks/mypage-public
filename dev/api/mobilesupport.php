
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
<script type='application/javascript' src='../fastclick.js'></script>
<script>
$(function() {
	FastClick.attach(document.body);
});

var lastTouchEnd = 0;
document.addEventListener('touchend', function (event) {
  var now = (new Date()).getTime();
  if (now - lastTouchEnd <= 300) {
    event.preventDefault();
  }
  lastTouchEnd = now;
}, false);  

document.addEventListener("DOMContentLoaded", function(){
  var arr = document.getElementById("hider");
  arr.classList.remove("hider");
});
</script>  