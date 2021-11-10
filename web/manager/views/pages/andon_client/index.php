<?php
require_once("classes/Trigger.php");
$trigger = new Trigger();

if (isset($trigger)) {
    if ($trigger->errors) {
        foreach ($trigger->errors as $error) {
            echo $error;
        }
    }
    if ($trigger->messages) {
        foreach ($trigger->messages as $message) {
            echo $message;
        }
    }
}
?>
<div class="container-fluid mt-5">

<div class="row">

    <?php 
    $query = "SELECT * FROM alerts";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)):
    ?>

    <div class="col-lg-3 col-md-6">
        <div class="card card-danger shadow-lg card-minimized">
            <div class="card-header">
            <h3 class="card-title"><?php echo $row['alert_name'] ?></h3>


                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                </div>

            </div>

            
            <div class="card-body">
                <?php echo $row['alert_name'] ?>

                <form action="" method="post">

                    <input type="hidden" name="alert_id" value="<?php echo $row['alert_id'] ?>">

                    <div class="form-group col-lg-4">
                        <label for="inputName3" class="col-sm-12 col-form-label planta">Plant</label>
                        <div class="col-sm-12">
                            <select name="plant" id="planta" class="form-control">
                                <option value="">Select</option>
                                <?php 
                                $query_plants = "SELECT * FROM plant";
                                $result_plants = mysqli_query($connection, $query_plants);
                                while($row_plants = mysqli_fetch_array($result_plants)):
                                ?>
                                    <option value="<?php echo $row_plants['plant_id'] ?>"><?php echo $row_plants['plant_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group col-lg-4">
                        <label for="inputName3" class="col-sm-12 col-form-label">Site</label>
                        <div class="col-sm-12">
                            <select id="state" name="site" class="form-control state">
                                <option value="">Select Site/Area</option>
                            </select>
                        </div>
                    </div>
                    

                    <div class="form-group col-lg-4">
                        <label for="inputName3" class="col-sm-12 col-form-label">Machine</label>
                        <div class="col-sm-12">
                            <select id="city" name="machine" class="form-control city">
                                <option value="">Select Machine/Asset</option>
                            </select>
                        </div>
                    </div>




                    
                    <div class="form-group col-lg-4">
                        <label for="inputName3" class="col-sm-12 col-form-label">Order Number</label>
                        <div class="col-sm-12">
                            <input name="orderno" class="form-control">
                        </div>
                    </div>




                    <div class="form-group col-lg-4">
                        <label for="inputName3" class="col-sm-12 col-form-label">Part Number</label>
                        <div class="col-sm-12">
                            <input name="partno" class="form-control">
                        </div>
                    </div>




                    <?php 
                    $custom_count = 0;
                    $query_custom_fields = "SELECT * FROM alert_custom_fields WHERE alert_id = {$row['alert_id']}";
                    $result_custom_fields = mysqli_query($connection, $query_custom_fields);
                    while($row_custom_fields = mysqli_fetch_array($result_custom_fields)):
                        $custom_count++;
                    ?>

                        <div class="form-group col-lg-4">
                            <label for="inputName3" class="col-sm-12 col-form-label"><?php echo $row_custom_fields['custom_name'] ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="<?php echo $custom_count;  ?>">
                            </div>
                        </div>


                    <?php 
                    endwhile; 
                    ?>

                    <input type="hidden" name="custom_count" value="<?php echo $custom_count; ?>">

                    <?php 
                    
                    $get_child = "SELECT * FROM alert_child WHERE alert_id = {$row['alert_id']}";
                    $result_child = mysqli_query($connection, $get_child);
                    $fields = mysqli_num_rows($result_child);
                    if($fields > 0):
                        //echo "<br>" . $fields;
                    ?>

                        <div class="form-group col-lg-4">
                            <label for="inputName3" class="col-sm-12 col-form-label">Specify Error</label>
                            <div class="col-sm-12">
                                <select name="child" class="form-control">
                                    <option value="">Errors</option>
                                    <?php while($row_child = mysqli_fetch_array($result_child)): ?>
                                        <option value="<?php echo $row_child['child_id'] ?>"><?php echo $row_child['child_name'];  ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>


                    <?php
                    endif; 
                    ?>


                    <div class="form-group col-lg-4">
                      <label>Report By</label>
                      <select class="form-control select2"  name="reportby" style="width: 100%;">
                        <?php 
                        $get_users = "SELECT * FROM users";
                        $result_users = mysqli_query($connection, $get_users);
                        while($row_users = mysqli_fetch_array($result_users)):
                        ?>
                            <option value="<?php echo $row_users['user_id'] ?>"><?php echo $row_users['user_firstname'] . " " . $row_users['user_lastname']; ?></option>
                        <?php endwhile ?>
                      </select>
                    </div>


                    <button class="btn btn-primary btn-lg" type="submit" name="trigger_alert">Trigger Alert</button>


                </form>

            </div>

        
        </div>
    </div>
    
    <?php 
    endwhile;
    ?>

    


</div>





</div>




