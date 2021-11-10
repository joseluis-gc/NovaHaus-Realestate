<?php
require_once("classes/User.php");
$user = new User();

if (isset($user)) {
    if ($user->errors) {
        foreach ($user->errors as $error) {
            echo $error;
        }
    }
    if ($user->messages) {
        foreach ($user->messages as $message) {
            echo $message;
        }
    }
}

if(!is_numeric($_GET['id'])){
  die("Invalid parameter");
}

$get_data = "SELECT * FROM users WHERE user_id = {$_GET['id']}";
$result = mysqli_query($connection, $get_data);
$data = mysqli_fetch_array($result);

?>
<form class="form-horizontal" method="POST" enctype="multipart/form-data">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img id="blah" class="profile-user-img img-fluid img-circle"
                       src="<?php echo $data['user_image']; ?>"
                       alt="User profile picture">
                </div>

                <h3 id="username-card" class="profile-username text-center">User Name</h3>

                <p class="text-muted text-center"><span id="firstname-card"></span> <span id="lastname-card"></span></p>

               
                <ul class="list-group list-group-unbordered mb-3 text-center">
                  <li style="border-color:transparent" class="list-group-item">
                    <b id="email-card"></b>
                  </li>
                </ul>
                
                <div class="custom-file">
                      <input type='file' class="custom-file-input" name="user_image" id="imgInp" />
                      <label class="custom-file-label" for="customFile">Choose file</label>
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
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Tipo</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
              

                <div class="tab-content">






                <div class="tab-pane active" id="settings">
                    
                    
                        <div class="row">

                            <div class="form-group col-lg-4">
                                <label for="inputName" class="col-sm-12 col-form-label">UserName</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="user_name" id="username" value="<?php echo $data['user_name'] ?>" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName3" class="col-sm-12 col-form-label">Name</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="first_name" id="firstname" value="<?php echo $data['user_firstname'] ?>" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="inputName4" class="col-sm-12 col-form-label">Last Name</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="last_name" id="lastname" value="<?php echo $data['user_lastname'] ?>" placeholder="Name">
                                </div>
                            </div>

                        </div>
                        



                        <div class="row">

                        
                            <div class="form-group col-lg-6">
                                <label for="inputName2" class="col-sm-12 col-form-label">Email</label>
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="user_email" id="email" value="<?php echo $data['user_email'] ?>" placeholder="Name">
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-6">
                                <label for="inputName4" class="col-sm-12 col-form-label">Phone</label>
                                <div class="col-sm-12">
                                <input type="text" id="phone" name="user_phone" class="form-control"data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask value="<?php echo $data['user_phone'] ?>">
                                </div>
                            </div>
                            
                        </div>


                        <div class="row">

                        
                            <div class="form-group col-lg-6">
                                <label for="inputName2" class="col-sm-12 col-form-label">Password</label>
                                <div class="col-sm-12">
                                <input type="password" name="password" class="form-control" id="inputName1" placeholder="Name">
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-6">
                                <label for="inputName2" class="col-sm-12 col-form-label">Repeat Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password_repeat" class="form-control" id="inputName2" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <div class="col-lg-12">
                                    <div class="custom-control custom-switch ">
                                        <input type="checkbox" name="admin" class="custom-control-input" id="admin">
                                        <label class="custom-control-label" for="admin">Admin Privileges</label>
                                    </div>
                                </div>    
                            </div>

                            
                            <div class="form-group col-lg-12">
                                <div class="col-lg-12">
                                    <div class="custom-control custom-switch ">
                                        <input type="checkbox" name="super" class="custom-control-input" id="super">
                                        <label class="custom-control-label" for="super">Super Admin Privileges</label>
                                    </div>
                                </div>    
                            </div>
                            
                        </div>

                        
                </div>




                  <div class=" tab-pane" id="activity">
                    <!-- Post -->


                    


                    <div class="post">

                    <div class="form-group">
                      <label>Tipo de Usuario</label>
                      <select class="form-control select2" id="usertype" name="user_type" style="width: 100%;">
                        <option value="">Select</option>
                        <option <?php if($data['user_type'] == 'v'){echo "selected";}else{echo"";} ?> value="v">Visitante</option>
                        <option <?php if($data['user_type'] == 's'){echo "selected";}else{echo"";} ?> value="s">Agente de Ventas</option>
                        <option <?php if($data['user_type'] == 'a'){echo "selected";}else{echo"";} ?> value="a">Administrador</option>
                      </select>
                    </div>
                          


                    <button class="btn btn-primary" type="submit" name="edit_user">Editar</button>

                   
                  </div>
                  <!-- /.tab-pane -->
                  
                  
                  
                  
                  
                  
             
                  <!-- /.tab-pane -->
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
