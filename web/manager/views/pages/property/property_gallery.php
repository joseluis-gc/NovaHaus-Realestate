<?php
require_once("classes/Property.php");
$user = new Property();

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
?>

<section class="content">
      <div class="container-fluid">
        <div class="row">
        
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Galeria</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                
              <form class="form-horizontal"  id="imageUploadForm">

                <div class="tab-content">

                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                    <input type="hidden" name="property_id" value="<?php echo $_GET['property_id'] ?>">
                    
                    
                    <div id="imageUpload" class="dropzone"></div>
                    
                    <div style="margin-top: 15px;" class="form-group">
                      <button style="float: right;" id="uploaderBtn" type="button" class="btn btn-primary">Guardar</button>
                    </div>
              </form>

                    <!-- /.post -->

                    <div style="margin-top:80px;" id="fileList">
                        <div class="row">

                            <?php 
                            $query = "SELECT * FROM property_images WHERE property_id = {$_GET['property_id']} ORDER BY image_id DESC";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($result)):    
                            ?>
                                  <div class="col-lg-3 d-flex align-items-stretch">
                                      <div class="card" style="width: 100%;">
                                      <form style="width: 100% !important;" method="post">

                                          <input type="hidden" name="property_id" value="<?php echo $_GET['property_id'] ?>">
                                          <input type="hidden" name="image_id" value="<?php echo $row['image_id'] ?>">
                                          <img style="height:180px" class="card-img-top" src="<?php echo substr($row['image_url'],6);?>" alt="Image">
                                          <div class="card-body">
                                              <h5 class="card-title">Image</h5>
                                              <p class="card-text">Image Options.</p>
                                              <button type="submit" name="delete_image" class="btn btn-danger btn-block">Delete</button>
                                          </div>
                                      </form>
  
                                      </div>
                                  </div>
                                
                                

                            <?php endwhile; ?>



                        </div>
                    </div>


                  </div>
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