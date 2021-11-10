$(document).ready(function(){
    var myEl = document.getElementById('search_button');
    var search_input = "";
    var vor = "";
    var url = "api/v1/fetch.php";
    var limit = 3;
    var start = 0;
    var action = 'inactive';

    myEl.addEventListener('click', function() {
        
        search_input = $('#search').val();
        vor = $('#vor').val();
        //alert('Hello world'+search_input);
        if(search_input != "" || vor != "")
        {
        start = 0;
        $('#load_data').html("");
        $('#main_title').html("Resultados de la busqueda: "+search_input);
        url = "api/v1/fetch.php?search="+search_input+"&vor="+vor;
        //action = active;
        load_data(limit, start);
        $('html, body').animate({
            scrollTop: $("#load_data").offset().top
        }, 2000);
        }
    }, false);




    

        
  
    function load_data(limit, start){
        $.ajax({
            url:url,
            method:"POST",
            data:{limit:limit, start:start},
            cache:false,
            success:function(data)
            {
                $('#load_data').append(data);
                if(data == '')
                {
                    $('#load_data_message').html("<div><button style='width:100%' class='btn deep-purple'>No Data Found</button></div>");
                    action = 'active';
                }
                else
                {
                    $('#load_data_message').html("<div><button style='width:100%' class='btn deep-purple'>Loading, Please Wait...</button></div>");
                    action = 'inactive';

                }
            }
        })
    }
  



    if(action == 'inactive')
    {
        action = 'active';
        load_data(limit, start);
    }
  
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') 
        {
        //alert("ya");
        action = 'active';
        start = start + limit;
        setTimeout(function(){
            load_data(limit,start);
        },2000);
        }
    });
  
});












//live search


//Getting value from "ajax.php".

function fill(Value) {

    //Assigning value to "search" div in "search.php" file.
    
    $('#search').val(Value);
    
    //Hiding "display" div in "search.php" file.
    
    $('#display').hide();
    
    }
    
    $(document).ready(function() {
    
    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    
    $("#search").keyup(function() {
    
        //Assigning search box value to javascript variable named as "name".
    
        var name = $('#search').val();
    
        //Validating, if "name" is empty.
    
        if (name == "") {
    
            //Assigning empty value to "display" div in "search.php" file.
    
            $("#display").html("");
    
        }
    
        //If name is not empty.
    
        else {
    
            //AJAX is called.
    
            $.ajax({
    
                //AJAX type is "Post".
    
                type: "POST",
    
                //Data will be sent to "ajax.php".
    
                url: "api/v1/livesearch.php",
    
                //Data, that will be sent to "ajax.php".
    
                data: {
    
                    //Assigning value of "name" into "search" variable.
    
                    search: name
    
                },
    
                //If result found, this funtion will be called.
    
                success: function(html) {
    
                    //Assigning result to "display" div in "search.php" file.
    
                    $("#display").html(html).show();
    
                }
            });
        }
    });    
});


