
<!---- 
// mypage project 
// Created by Adrian Koszpek on 2021  
// Copyright © 2021 Adrian Koszpek. All rights reserved.
--->

<script> 

function menu(type) {
  var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) { 
      var openDropdown = dropdowns[i]; 
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }

    if (type !== "report") {

      if (type == "reportPost") {
        var modal = document.getElementById("reportPost");  
        modal.style.display = "block"; 
        
       document.getElementById("body").style.overflow = "hidden";
      }

      if (type !== "sharePerson") {
        document.getElementById(type).classList.toggle("show"); 
      } 
      else {
        var modal = document.getElementById("sharePerson");  
        modal.style.display = "block"; 
 
        var modal = document.getElementById("sharePersonBox");  
        modal.classList.add('push') 


        document.getElementById("body").style.overflow = "hidden";
      }
  }
  else { 
  // document.getElementById('report').classList.toggle("show");
    var modal = document.getElementById("reportPerson");  
    modal.style.display = "block"; 


    var modal = document.getElementById("reportPersonBox");  
    modal.classList.add('push') 

    document.getElementById("body").style.overflow = "hidden";
  }
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>