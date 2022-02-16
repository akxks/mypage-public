var data = {session_id,fetchid,personid,account_token};  
$(document).ready(function() { 
    $(function(){ 
        function loadLatestResults(){ 
          $.ajax({
            type: "POST",
            cache : true,
            async: true,
            data: data,
            url : 'api/friendsfetch',
            success : function(data){
              $('#fetchfriends').html(data);
            }
          });
        } 
        window.setInterval(function(){
          loadLatestResults();
        }, 5000);  
      });
});