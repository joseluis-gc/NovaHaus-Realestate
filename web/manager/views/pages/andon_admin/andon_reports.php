<?php
require_once("classes/AndonResponse.php");
$response = new AndonResponse();

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
           
            echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                
                swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: '$message',
                    type: 'success'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>
        ";

        }
    }
}


?>



<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Andon Alerts</h3>
        </div>
            <div class="card-body">

                <div class="row">

                        <div class="form-group col-lg-3">
                            <label for="exampleInputBorder">From <code>Start Date</code></label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control form-control-border datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker"/>
                            </div>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="exampleInputBorder">To <code>End Date</code></label>
                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                <input type="text" class="form-control form-control-border datetimepicker-input" data-target="#reservationdate2" data-toggle="datetimepicker"/>
                            </div>
                        </div>

                        <div class="form-group col-lg-3">
                            <button  id="searchButton" class="btn btn-primary">Search</button>
                        </div>
                        


                </div>
                

                <table  id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Plant</th>
                    <th>Area</th>
                    <th>Alert</th>
                    <th>Alert Spec</th>
                    <th>Machine</th>
                    <th>Work Center</th>
                    <th>Part No.</th>
                    <th>Order No.</th>
                    <th>Shift</th>
                    <th>Start</th>
                    <th>Atention</th>
                    <th>Solution</th>
                    <th>Attn Time</th>
                    <th>Sol Time</th>
                    <th>Responded</th>
                    <th>Solved</th>
                    <th>Details</th>
                    </tr>
                    </thead>
                    <!--
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM andon LEFT JOIN site ON andon.andon_site_id = site.site_id LEFT JOIN plant ON site.plant_id = plant.plant_id LEFT JOIN alerts ON andon.andon_alert_main = alerts.alert_id LEFT JOIN alert_child ON alert_child.child_id = andon.andon_alert_child LEFT JOIN assets ON assets.asset_id = andon.andon_asset_id LEFT JOIN users AS response ON response.user_id = andon.andon_response_user LEFT JOIN users AS solution ON solution.user_id = andon.andon_end_user;";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_array($result)):
                    ?>  
                    <tr>
                        <td><?php echo $row['andon_id'] ?></td>
                        <td><?php echo $row['plant_name'] ?></td>
                        <td><?php echo $row['site_name'] ?></td>
                        <td><?php echo $row['alert_name'] ?></td>
                        <td><?php echo $row['child_name'] ?></td>
                        <td><?php echo $row['asset_name'] ?></td>
                        <td><?php echo $row['asset_work_center'] ?></td>
                        <td><?php echo $row['andon_partno'] ?></td>
                        <td><?php echo $row['andon_orderno'] ?></td>
                        <td><?php echo $row['andon_orderno'] ?></td>
                        <td><?php echo date_format(date_create($row['andon_start']), "d/m/Y H:i:s")  ?></td>
                        <td><?php echo date_format(date_create($row['andon_response']), "d/m/Y H:i:s") ?></td>
                        <td><?php echo date_format(date_create($row['andon_end']), "d/m/Y H:i:s") ?></td>
                        <td><?php echo timeDiff($row['andon_start'], $row['andon_response']) ?></td>
                        <td><?php echo timeDiff($row['andon_start'], $row['andon_end']) ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['user_name'] ?></td>
                        <td><?php echo $row['andon_id'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                    -->
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
