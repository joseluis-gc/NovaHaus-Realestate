<section class="content">
      <div class="container-fluid">
      

        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Estadisticas</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="index.php" class="dropdown-item">Sync</a>
                      <a class="dropdown-divider"></a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->


              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Estadisticas para: <?php echo date("d M Y"); ?> a las <?php echo date("h:i"); ?> </strong>
                    </p>

                    <div style="height: 300px !important;" class="chart">
                      <canvas id="mycanvas" height="180" style="height: 180px !important;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->



                  </div>
                  <!-- /.col -->


                  
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Alertas</strong>
                    </p>

                  
                    <div class="info-box mb-3 bg-warning">
                      <span class="info-box-icon"><i class="fas fa-bell"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Prospectos</span>
                        <span id="total" class="info-box-number">
                        
                        <?php 
                        $query = "SELECT COUNT(*) AS inquiry_num FROM inquiry;";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_array($result);
                        echo $num_notifications =  $row['inquiry_num'];
                        ?>


                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>


                    <div class="info-box mb-3 bg-danger">
                      <span class="info-box-icon"><i class="far fa-comments"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Mensajes</span>
                        <span id="pending" class="info-box-number">
                        <?php 
                        $query = "SELECT COUNT(*) AS numeroMensajes FROM messages;";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_array($result);
                        echo $num_msj =  $row['numeroMensajes'];
                        ?>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>



                    <!--
                    <div class="info-box mb-3 bg-success">
                      <span class="info-box-icon"><i class="fas fa-wrench"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Working</span>
                        <span id="working" class="info-box-number"></span>
                      </div>
                    </div>
                    -->


                   

                    <!--
                    <div class="info-box mb-3 bg-info">
                      <span class="info-box-icon"><i class="far fa-comment"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Direct Messages</span>
                        <span class="info-box-number">163,921</span>
                      </div>
                      
                    </div>
                    info-box-content -->



                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> </span>
                      <h5 class="description-header">
                      
                      <?php 
                      $query = "SELECT SUM(precio) AS total FROM property;";
                      $result = mysqli_query($connection, $query);
                      $row = mysqli_fetch_array($result);
                      $total =  $row['total'];
                      echo $total_format =  number_format($row['total']);
                      ?>


                      </h5>
                      <span class="description-text">VALOR TOTAL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  
                  
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-up"></i></span>
                      <h5 class="description-header">
                      <?php 
                      $query = "SELECT SUM(precio_interno) AS total_interno FROM property;";
                      $result = mysqli_query($connection, $query);
                      $row = mysqli_fetch_array($result);
                      $total_i =  $row['total_interno'];
                      echo $total_i_format =  number_format($row['total_interno']);
                      ?>
                      </h5>
                      <span class="description-text">PRECIO INTERNO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  
                  
                  
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?php echo number_format(100 -((100*$total_i)/$total),2); ?>%</span>
                      <h5 class="description-header"><?php echo number_format($total-$total_i); ?></h5>
                      <span class="description-text">GANANCIAS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  
                  
                  
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-up"></i> </span>
                      <h5 class="description-header">
                      <?php 
                      $mes = date("Y-m");
                      $inicio = $mes."-01";
                      $fin = $mes."-30";
                      $query = "SELECT SUM(precio_interno) AS total_interno FROM property WHERE date_created BETWEEN '$inicio' AND '$fin';";
                      $result = mysqli_query($connection, $query);
                      $row = mysqli_fetch_array($result);
                      $total_i =  $row['total_interno'];
                      echo $total_i_format =  number_format($row['total_interno']);
                      ?>
                      </h5>
                      <span class="description-text">MES ACTUAL</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
     
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->





