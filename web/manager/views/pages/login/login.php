<div style="margin-top: 80px;" class="login-box mx-auto">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Nova</b>Manager</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Inicia sesión para administrar propiedades.</p>

      <form action="index.php" method="post">
        <div class="form-group">
          <input type="text" name="user_name" class="form-control" placeholder="Email">
          <div class="input-group-append">
            
          </div>
        </div>
        <div class="form-group mb-3">
          <input type="password" name="user_password" class="form-control" placeholder="Contraseña">
          <div class="input-group-append">
           
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <br><br>
     
      <p class="mb-1">
        <a href="#">Olvide mi contraseña</a>
      </p>
      <!--
      <p class="mb-0">
        <a href="register.html" class="text-center">Registrar nuevo usuario</a>
      </p>
      -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->