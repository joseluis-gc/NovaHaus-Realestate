
 
  <footer class="page-footer deep-purple">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Nosotros</h5>
          <p class="grey-text text-lighten-4 justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam aut voluptatibus minus pariatur? Itaque ad, dolorem reprehenderit vero rem labore laboriosam aut impedit placeat quibusdam voluptas facere vel nulla recusandae.</p>


        </div>
        <div class="col l3 s12">
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Siguenos</h5>
          <ul>
            <li><a class="white-text huge" href="#!"><i class="fab fa-facebook-square"></i></a></li>
            <li><a class="white-text huge" href="#!"><i class="fab fa-instagram"></i></a></li>
            <li><a class="white-text huge" href="#!"><i class="fab fa-linkedin"></i></a></li>
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


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/init.js"></script>
  <script src="js/ui.js"></script>
  <?php 
  if(basename($_SERVER['PHP_SELF']) == "search.php")
  {
      echo "<script src='js/advanced.js'></script>";
  }
  elseif(basename($_SERVER['PHP_SELF']) == "single.php")
  {
      echo "<script src='js/single.js'></script>";
  }
  else
  {
      echo '<script src="js/app.js"></script>';
  }
  ?>
</div>  
</body>

</html>
