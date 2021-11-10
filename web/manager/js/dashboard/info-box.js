$(document).ready(function(){

    $.ajax({
        url: "functions/dashboard/info_box.php",
        method: "GET",
        success: function(data) {
          
          
            var dataObj = JSON.parse(data);
            
            console.log(total, pending, working);


            $("#total").html(dataObj.total);
            $("#pending").html(dataObj.pending);
            $("#working").html(dataObj.working);


        },
        error: function(data) {
            console.log("error" + data);
        }
    });

});