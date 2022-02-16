var data = {session_id,fetchid,account_token,mobileordesktop,mobileordesktop2};  
$(document).ready(function() { 
    
  $(function(){  
    
        function loadLatestResults(type){ 
          $.ajax({
            type: "POST",
            cache : false,
            data: data,
            url : 'api/notifFetchHeader',
            success : function(data){
              $('#fetchNotifs').html(data);
              if (type !== "nodropdown") { 
                document.getElementById(type).classList.add("show"); 
              } 
            }  
          });
        } 
         
        window.setInterval(function(){ 
          if (document.getElementById('friends').classList.contains("show")) { loadLatestResults("friends"); var dropdowntrue = 1 }
          if (document.getElementById('notifications').classList.contains("show")) { loadLatestResults("notifications");  var dropdowntrue = 1 } 

          if ( dropdowntrue !== 1 ) { loadLatestResults("nodropdown");  }
          var dropdowntrue = 0; 

        }, 4000);  
      });

    }); 