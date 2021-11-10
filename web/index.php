<?php require_once "modules/header.php"; ?>
<?php require_once "modules/navigation.php"; ?>  

  <header class="white-text valign-wrapper">
    <div style="position: relative;" class="container">
      
      <h1 class="app-title">Busca y encuentra tu nueva casa</h1>
      <p class="app-subtitle white-text ">Novahaus cuenta con el mejor catalogo de propiedades de la región!</p>


      <form class="s12" id="search_form" method="POST" action="">
      <div class="row">

      

        <div class="input-field col s12 m8 interactive-search">
          <input style="background-color: white;" placeholder="Busca por ubicación, ciudad, calle, etc." id="search"  type="text" class="validate" autocomplete="off">
          <span id="display"></span>
        </div>

        <div  class="input-field col s12 m4">
          <select style="background-color: white; padding-left:15px;" id="vor">
              <option value=""selected>  Venta o Renta</option>
              <option value="v"> Venta</option>
              <option value="r"> Renta</option>
              <option value="t"> Traspaso</option>
          </select>          
        </div>

       

      
      </div>
      </form>

      <button id="search_button" class="deep-purple waves-effect waves-light btn btn-large">Buscar</button>
      <a href="search.php" class=" white deep-purple-text waves-effect waves-dark btn-large">Busqueda Avanzada</a>
    </div>
  </header>



  
  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">

        <div class="col l12">
          <h3 id="main_title" style="margin-bottom: 5px;">Nuestro Catalogo</h3>
          <p>Explora nuestro catalogo, compara propiedades y encuentra tu nuva casa.</p>
        </div>
      </div>
      <div >
        <div class="">

          <div class="row" id="load_data"></div>

          <div id="load_data_message"></div>

          <br>
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

      
         
        </div>

       
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Busca y encuentra tu casa nueva con nuestra ayuda.</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/images/background2.jpg" alt="Unsplashed background img 2"></div>
  </div>

<?php require_once "modules/footer.php"; ?>

  
