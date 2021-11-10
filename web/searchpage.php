<?php require_once "includes/header.php"; ?>
<header class="black-text valign-wrapper">
    <div style="position: relative;" class="container">
      

        <div class="col s12 m6">
          <div class="card-panel">
          
            <div class="input-field">
                <select id="tipo">
                    <option value="" disabled selected>Tipo</option>
                    <option value="1">Casa</option>
                    <option value="2">Departamento</option>
                    <option value="3">Local comercial</option>
                    <option value="4">Terreno</option>
                    <option value="4">Industrial</option>
                </select>
            <label>Tipo</label>
            </div>

            <div class="input-field">
            <select id="vor">
                <option value="" disabled selected>Venta o Renta</option>
                <option value="v">Venta</option>
                <option value="r">Renta</option>
                <option value="t">Traspaso</option>
            </select>
            <label>Venta o Renta</label>
            </div>
            <div class="input-field">
            <select id="recamaras">
                <option value="" disabled selected>Recamaras</option>
                <option value="1">1-3</option>
                <option value="2">3-5</option>
                <option value="5">5+</option>
            </select>
            <label>Recamaras</label>
            </div>
            <div class="input-field">
            <select id="precio">
                <option value=""selected>Todos</option>
                <option value="5000">Hasta $5,000 </option>
                <option value="10000">Hasta $10,000 </option>
                <option value="20000">Hasta $20,000 </option>
                <option value="100000">Hasta $100,000 </option>
                <option value="1000000">Hasta $1,000,000 </option>
                <option value="2000000">Hasta $2,000,000 </option>
                <option value="5000000">Hasta $5,000,000 </option>
                <option value="10000000">Hasta $10,000,000 o mas </option>

            </select>
            <label>Precio</label>
            </div>
            <!--
            <br>
            <div class="input-field">
            <div id="test-slider"></div>
            <label>Precio</label>
            </div>  
            -->
            <!--
            <p class="range-field">
      <input type="range" id="test5" min="0" max="20000000" />
    </p>
-->

            <button style="width: 100%;" name="search_button" id="search_button" type="submit" class="btn deep-purple waves waves-light btn-large">Buscar</button>
          </div>
        </div>



        
     

     
    </div>
  </header>

  
  <div class="container">
    <div class="section">


      <div class="row">

        <div class="col">
          l
        </div>

        <div class="col l12">
          <h1 id="main_title" style="margin-bottom: 85px;"></h1>
        </div>
      </div>
      <div>
        <div class="">
            <div class="row" id="load_data"></div>

            <div id="load_data_message"></div>

            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>


    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/images/background2.jpg" alt="Unsplashed background img 2"></div>
  </div>


  <?php require_once "includes/footer.php"; ?>

  <script>
    $(document).ready(function(){
      var myEl = document.getElementById('search_button');
      var vor = "";
      var recamaras = "";
      var tipo = "";
      var precio = "";
      var url = "api/v1/advanced_search.php";
      var limit = 3;
      var start = 0;
      var action = 'inactive';

      myEl.addEventListener('click', function() {
        vor = $('#vor').val();
        tipo = $('#tipo').val();
        recamaras = $('#recamaras').val();
        precio = $('#precio').val();

        //alert('Hello world'+search_input);
        
        if(vor != "")
        {
          start = 0;
          $('#load_data').html("");
          $('#main_title').html("Resultados de la busqueda:");
          url = "api/v1/advanced_search.php?transaction="+vor+"&br="+recamaras+"&t="+tipo+"&p="+precio;
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
  </script>