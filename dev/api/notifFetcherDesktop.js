var data = {session_id,fetchid,account_token,mobileordesktop,mobileordesktop2};  
$(document).ready(function() { 
    
  $(function(){  
    
        function loadLatestResults(type){ 
          $.ajax({
            type: "POST",
            cache : false,
            data: data,
            url : 'api/notifFetchHeaderDesktop',
            success : function(data){
              $('#fetchNotifsDesktop').html(data);
              if (type !== "nodropdown") { 
                document.getElementById(type).classList.add("show"); 
              } 
            }  
          });
        } 
         
        window.setInterval(function(){ 
          if (document.getElementById('friendsDesk').classList.contains("show")) { loadLatestResults("friendsDesk"); var dropdowntrue = 1 }
          if (document.getElementById('notificationsDesk').classList.contains("show")) { loadLatestResults("notificationsDesk");  var dropdowntrue = 1 } 

          if ( dropdowntrue !== 1 ) { loadLatestResults("nodropdown");  }
          var dropdowntrue = 0; 

        }, 4000);  
         });

}); 