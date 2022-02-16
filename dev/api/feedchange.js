var data = {session_id, setting, account_token};
$(document).ready(function() {      
    $("#changefeed2").click(function() {  
        $.ajax({ 
            type: "GET", 
            cache: false,
            data: data,
            url: "api/settingspostTypechange",  
            success: function(html) {$("#changefeed").html(html).show(); location.reload(); }
        });  
    });
}); 