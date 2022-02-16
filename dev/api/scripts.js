function fill(Value) { 
    $('#search').val(Value); 
    $('#display').hide();
    $('#mySearch').hide();
}
 $(document).ready(function() { 
    $("#search").keyup(function() { 
        var name = $('#search').val(); 
        if (name == "") { 
            $("#display").html("");
            $("#mySearch").html("");
        } 
        else { 
            $.ajax({ 
                type: "POST", 
                url: "api/searchajax", 
                data: { 
                    search: name
                }, 
                success: function(html) { 
                    $("#display").html(html).show();
                    $("#mySearch").html(html).show(); 
                }
            });
        }
    });
 });