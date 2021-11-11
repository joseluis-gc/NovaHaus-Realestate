<?php

require_once("classes/Property.php");
$response = new Property();

if (isset($response)) {
    if ($response->errors) {
        foreach ($response->errors as $error) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function(event) {
                        swal.fire('Error!','$error','error');
                    });
                </script>
            ";
        }
    }
    if ($response->messages) {
        foreach ($response->messages as $message) {
            $property_id = implode(',',$response->property_return);
            echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                
                swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: '$message',
                    type: 'success'
                }).then(function() {
                    window.location = 'index.php?page=property_gallery&property_id=$property_id';
                });
            });
        </script>
        ";

        }
    }
}
if( !is_numeric($_GET['id'])){
  die("Invalid parameter.");
}
$query = "SELECT * FROM property WHERE id = {$_GET['id']}";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_array($result);

?>
<form method="POST" class="form-horizontal"  id="imageUploadForm" enctype="multipart/form-data">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img style="width: 100%;" id="blah" class="profile-user-img img-fluid"
                       src="<?php echo $data['imagen_principal'] ?>"
                       alt="User profile picture">
                </div>

                <h3 id="username-card" class="profile-username text-center">Propiedad</h3>

                <p class="text-muted text-center"><span id="firstname-card"></span> <span id="lastname-card"></span></p>

               
                <ul class="list-group list-group-unbordered mb-3 text-center">
                  <li style="border-color:transparent" class="list-group-item">
                    <b id="email-card"></b>
                  </li>
                </ul>
                
                <div class="custom-file">
                      <input type='file' class="custom-file-input" name="property_image" id="imgInp" />
                      <label class="custom-file-label" for="customFile">Imagen</label>
                </div>

                <!--
                <a href="#" class="btn btn-primary btn-block"><b>Select Picture</b></a>
                -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Propiedad</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">

                <div class="tab-content">

                  <div class="tab-pane active" id="settings">
                    
                    
                        <div class="row">

                            <div class="form-group col-lg-12">
                                <label for="inputName" class="col-sm-12 col-form-label">Titulo</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" value="<?php $e1 =(isset($_POST['name'])) ? ($name = $_POST['name']) : ($name = $data['name']); echo $name ?>" id="titulo" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputName3" class="col-sm-12 col-form-label">Tipo</label>
                                <div class="col-sm-12">
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="">Seleccione</option>
                                    <?php 
                                    $query = "SELECT * FROM property_category";
                                    $result = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_array($result)):
                                    ?>
                                        <option <?php if($data['tipo']==$row['cat_id']){echo "selected";}else{echo"";} ?> value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="inputName3" class="col-sm-12 col-form-label">Venta o Renta</label>
                                <div class="col-sm-12">
                                <select class="form-control" name="vor">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['vor'] == 'v'){echo "selected";}else{echo "";} ?> value="v">Venta</option>
                                    <option <?php if($data['vor'] == 'r'){echo "selected";}else{echo "";} ?> value="r">Renta</option>
                                    <option <?php if($data['vor'] == 't'){echo "selected";}else{echo "";} ?> value="t">Traspaso</option>
                                </select>
                                </div>
                            </div>





                        </div>
                        



                        <div class="row">

                        
                            <div class="form-group col-lg-4">
                                <label for="inputName2" class="col-sm-12 col-form-label">Calle</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="street" placeholder="Calle" value="<?php $street =(isset($_POST['street'])) ? ($street = $_POST['street']) : ($street = $data['street']); echo $street ?>">
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Numero</label>
                                <div class="col-sm-12">
                                <input type="text" id="phone" name="number" class="form-control" value="<?php $numero =(isset($_POST['number'])) ? ($numero = $_POST['number']) : ($numero = $data['number']); echo $numero ?>">
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Colonia</label>
                                <div class="col-sm-12">
                                <input type="text" id="phone" name="section" class="form-control" value="<?php $section =(isset($_POST['section'])) ? ($section = $_POST['section']) : ($section = $data['section']); echo $section ?>">
                                </div>
                            </div>
                            
                        </div>


                        <div class="row">
                        
                          
                          <div class="form-group col-lg-4">
                              <label for="inputName2" class="col-sm-12 col-form-label">Pais</label>
                              <div class="col-sm-12">
                                  <select class="form-control" name="country_id" id="country">
                                      <option value="">Seleccione</option>
                        
                                      <?php 
                                      $countries = getAll('country');
                                      foreach($countries as $country):
                                      ?>             
                                        <option <?php if($data['country_id'] == $country['country_id']){echo "selected";}else{echo"";} ?> value="<?php echo $country['country_id'] ?>"><?php echo $country['country'] ?></option>
                                      <?php endforeach ?>                                      
                                  </select>
                              </div>
                          </div>


                          <div class="form-group col-lg-4">
                              <label for="inputName4" class="col-sm-12 col-form-label">Estado</label>
                              <div class="col-sm-12">

                              <select class="form-control" id="state" name="state_id">
                                      
                              </select>


                              </div>
                          </div>

                          <div class="form-group col-lg-4">
                              <label for="inputName4" class="col-sm-12 col-form-label">Colonia</label>
                              <div class="col-sm-12">

                              <select class="form-control" id="city" name="city_id">                                      
                              </select>

                              </div>
                          </div>

                        </div>





                        <div class="row">



                        <div class="form-group col-lg-4">
                                <label for="inputName2" class="col-sm-12 col-form-label">Recamaras</label>
                                <div class="col-sm-12">
                                <input type="number" class="form-control" name="recamaras" value="<?php $recamaras =(isset($_POST['recamaras'])) ? ($recamaras = $_POST['recamaras']) : ($recamaras = $data['recamaras']); echo $recamaras ?>">
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Baños</label>
                                <div class="col-sm-12">
                                <input type="number" id="phone" name="bathrooms" class="form-control" value="<?php $bath =(isset($_POST['bathrooms'])) ? ($bath = $_POST['bathrooms']) : ($bath = $data['bathrooms']); echo $bath ?>">
                                </div>
                            </div>



                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Cocina</label>
                                <div class="col-sm-12">
                                  <select  name="cocina" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['cocina'] == 1){echo "selected";}else{echo "";} ?> value="1">Si</option>
                                    <option <?php if($data['cocina'] == 0){echo "selected";}else{echo "";} ?> value="0">No</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Cochera</label>
                                <div class="col-sm-12">
                                  <select  name="cochera" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['cochera'] == 1){echo "selected";}else{echo "";} ?> value="1">Si</option>
                                    <option <?php if($data['cochera'] == 0){echo "selected";}else{echo "";} ?> value="0">No</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Patio</label>
                                <div class="col-sm-12">
                                  <select  name="patio" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['patio'] == 1){echo "selected";}else{echo "";} ?> value="1">Si</option>
                                    <option <?php if($data['patio'] == 0){echo "selected";}else{echo "";} ?> value="0">No</option>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Alberca</label>
                                <div class="col-sm-12">
                                  <select  name="alberca" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['alberca'] == 1){echo "selected";}else{echo "";} ?> value="1">Si</option>
                                    <option <?php if($data['alberca'] == 0){echo "selected";}else{echo "";} ?> value="0">No</option>
                                  </select>
                                </div>
                            </div>


                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Terreno</label>
                                <div class="col-sm-12">
                                <input type="number" name="terreno" class="form-control" value="<?php $terreno =(isset($_POST['terreno'])) ? ($terreno = $_POST['terreno']) : ($terreno = $data['terreno']); echo $terreno ?>">
                                </div>
                            </div>
                            
                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Construcción</label>
                                <div class="col-sm-12">
                                <input type="number" id="phone" name="construccion" class="form-control" value="<?php $cons =(isset($_POST['construccion'])) ? ($cons = $_POST['construccion']) : ($cons = $data['construccion']); echo $cons ?>">
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Precio</label>
                                <div class="col-sm-12">
                                <input type="number" id="phone" name="precio" class="form-control" value="<?php $precio =(isset($_POST['precio'])) ? ($precio = $_POST['precio']) : ($precio = $data['precio']); echo $precio?>">
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Precio Interno</label>
                                <div class="col-sm-12">
                                <input type="number" id="phone" name="precio_interno" class="form-control" value="<?php $precioi =(isset($_POST['precio_interno'])) ? ($precioi = $_POST['precio_interno']) : ($precioi = $data['precio_interno']); echo $precioi ?>">
                                </div>
                            </div>
                        

                            
                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Moneda</label>
                                <div class="col-sm-12">
                                  <select  name="moneda" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option <?php if($data['moneda'] == "MXN"){echo "selected";}else{echo "";} ?>  value="MXN">Pesos</option>
                                    <option <?php if($data['moneda'] == "USD"){echo "selected";}else{echo "";} ?> value="USD">Dolares</option>
                                  </select>
                                </div>
                            </div>
                            

                            <div class="form-group col-lg-12">
                              <label>Asignar un agente</label>
                              <select class="form-control select2" id="usertype" name="agente" style="width: 100%;">
                                <option value="">Select</option>
                                <?php 
                                $get_agents = "SELECT * FROM users WHERE user_type = 's'";
                                $run = mysqli_query($connection, $get_agents);
                                while($row = mysqli_fetch_array($run)):
                                ?>
                                  <option  value="<?php echo $row['user_id'] ?>"><?php echo $row['user_firstname'] . " " . $row['user_lastname'] ?></option>
                                <?php endwhile; ?>
                              </select>
                            </div>


                        </div>

                        
                </div>

                <button name="create_property" class="btn btn-primary">Guardar</button>
                 
                </div>
                <!-- /.tab-content -->


  
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </form>
