<footer class="page-footer deep-purple">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Nosotros</h5>
          <p class="grey-text text-lighten-4 justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam aut voluptatibus minus pariatur? Itaque ad, dolorem reprehenderit vero rem labore laboriosam aut impedit placeat quibusdam voluptas facere vel nulla recusandae.</p>


        </div>
        <div class="col l3 s12">
          <!--
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Link 1</a></li>
            <li><a class="white-text" href="#!">Link 2</a></li>
            <li><a class="white-text" href="#!">Link 3</a></li>
            <li><a class="white-text" href="#!">Link 4</a></li>
          </ul>
          -->
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


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="assets/js/materialize.js"></script>
  <script src="assets/js/init.js"></script>
  <script src="assets/vendor/node_modules/nouislider/dist/nouislider.js"></script>

  <script>
     document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
  });

  var slider = document.getElementById('test-slider');
  noUiSlider.create(slider, {
   start: [0, 80],
   connect: true,
   step: 1000,
   orientation: 'horizontal', // 'horizontal' or 'vertical'
   tooltips:true,
   range: {
     'min': 0,
     'max': 10000000
   }
  });

  var x = document.getElementById("test5").step = "5000";

  </script>

  </body>
</html>