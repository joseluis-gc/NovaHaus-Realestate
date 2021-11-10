<?php require_once "modules/header.php"; ?>
<?php require_once "modules/navigation.php"; ?>  


<header class="black-text valign-wrapper">
    <div style="position: relative;" class="container">
      

        <div class="col s12 m6">
          <div class="card-panel">
          
            <div class="input-field">
                <select id="tipo">
                    <option value=""selected>Tipo</option>
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
                <option value=""selected>Venta o Renta</option>
                <option value="v">Venta</option>
                <option value="r">Renta</option>
                <option value="t">Traspaso</option>
            </select>
            <label>Venta o Renta</label>
            </div>
            <div class="input-field">
            <select id="recamaras">
                <option value=""selected>Recamaras</option>
                <option value="1">1-3</option>
                <option value="3">3-5</option>
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
            
            <button style="width: 100%;" name="search_button" id="search_advanced" type="submit" class="btn deep-purple waves waves-light btn-large">Buscar</button>
          </div>
        </div>



        
     

     
    </div>
  </header>

  
  <div class="container">
    <div class="section">


      <div class="row">

        <div class="col l12">
          <h3 id="main_title" style="margin-bottom: 85px;">Busca propiedades</h3>
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


  <?php require_once "modules/footer.php"; ?>  



  <!--
  <footer class="page-footer deep-purple">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Nosotros</h5>
          <p class="grey-text text-lighten-4 justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam aut voluptatibus minus pariatur? Itaque ad, dolorem reprehenderit vero rem labore laboriosam aut impedit placeat quibusdam voluptas facere vel nulla recusandae.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!"><i class="fab fa-facebook-square"></i></a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      <a class="white-text text-lighten-3" href="#">&copy; jlgc-xyz <?php echo date("Y"); ?></a>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/init.js"></script>
  <script src="assets/vendor/node_modules/nouislider/dist/nouislider.js"></script>
  <script>
    //$(document).ready(function(){
      /*
      var myEl = document.getElementById('search_advanced');
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

        
        if(vor != "" || tipo != "" || $precio !="" || recamaras != "")
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
    */
  </script>
    
</div>
  -->