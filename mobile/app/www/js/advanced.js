 $(document).ready(function(){
      var myEl = document.getElementById('search_advanced');
      var vor = "";
      var recamaras = "";
      var tipo = "";
      var precio = "";
      var url = "https://smartlaboratory.tech/novahaus/api/v2/advanced_search.php";
      var limit = 3;
      var start = 0;
      var action = 'inactive';

      myEl.addEventListener('click', function() { 
        vor = $('#vor').val();
        tipo = $('#tipo').val();
        recamaras = $('#recamaras').val();
        precio = $('#precio').val();

        
        if(vor != "" || tipo != "" || $precio !="" || recamaras != "")
        {
          start = 0;
          $('#load_data').html("");
          $('#main_title').html("Resultados de la busqueda:");
          url = "https://smartlaboratory.tech/novahaus/api/v2/advanced_search.php?transaction="+vor+"&br="+recamaras+"&t="+tipo+"&p="+precio;
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
                    $('#load_data_message').html("<div><button style='width:100%' class='btn deep-purple'>No hay mas propiedades</button></div>");
                    action = 'active';
                }
                else
                {
                    $('#load_data_message').html("<div><button style='width:100%' class='btn deep-purple'>Cargando, por favor espere...</button></div>");
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